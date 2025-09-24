<?php
require_once(APPPATH.'core/SecureApiController.php');

class EventPage extends SecureApiController {

    public function add() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());

        // Required field validation
        $requiredFields = [
            'title_en' => 'English title',
            'title_ch' => 'Chinese title',
            'slug' => 'Slug',
            'short_description_en' => 'Short Description EN',
            'short_description_ch' => 'Short Description CH',
            'top_image1' => 'Top Image 1',
            'top_image2' => 'Top Image 2'
        ];

        foreach ($requiredFields as $field => $label) {
            if (!$request->$field) {
                response(403, 1, "$label cannot be empty.", []);
            }
        }

        $data = [
            'title_en' => $request->title_en,
            'title_ch' => $request->title_ch,
            'slug' => $request->slug,
            'short_description_en' => $request->short_description_en,
            'short_description_ch' => $request->short_description_ch,
            'top_image1' => $request->top_image1,
            'top_image2' => $request->top_image2,
            'status' => 1,
        ];

        if ($request->id && $request->id != 0) {
            $this->db->where('id', $request->id);
            $this->db->update('anken_event_page', $data);
            response(200, 0, 'Event page updated successfully.', []);
        } else {
            $res = $this->db->insert('anken_event_page', $data);
            if ($res) {
                response(200, 0, 'Event page added successfully.', []);
            } else {
                response(500, 1, 'Failed to insert event page.', []);
            }
        }
    }

    public function get() {
        $this->db->select('p.*, 
            f1.id as file_id1, f1.file as file1, f1.directory_id as dir1,
            f2.id as file_id2, f2.file as file2, f2.directory_id as dir2');
        $this->db->from('anken_event_page p');
        $this->db->join('anken_file_library f1', 'p.top_image1 = f1.id', 'left');
        $this->db->join('anken_file_library f2', 'p.top_image2 = f2.id', 'left');
        $results = $this->db->get()->result();
        $final = [];

        foreach ($results as $row) {
            $rowArray = (array) $row;

            $topImage1 = null;
            if (!empty($row->file_id1)) {
                $filePath1 = ($row->dir1 == 0)
                    ? "{$this->libraryPath}/{$row->file1}"
                    : "{$this->libraryPath}/{$row->dir1}/{$row->file1}";
                $topImage1 = [
                    'id' => $row->file_id1,
                    'file' => $row->file1,
                    'directory_id' => $row->dir1,
                    'path' => $filePath1
                ];
            }

            $topImage2 = null;
            if (!empty($row->file_id2)) {
                $filePath2 = ($row->dir2 == 0)
                    ? "{$this->libraryPath}/{$row->file2}"
                    : "{$this->libraryPath}/{$row->dir2}/{$row->file2}";
                $topImage2 = [
                    'id' => $row->file_id2,
                    'file' => $row->file2,
                    'directory_id' => $row->dir2,
                    'path' => $filePath2
                ];
            }

            $rowArray['top_image1'] = $topImage1;
            $rowArray['top_image2'] = $topImage2;

            unset(
                $rowArray['file_id1'], $rowArray['file1'], $rowArray['dir1'],
                $rowArray['file_id2'], $rowArray['file2'], $rowArray['dir2']
            );

            $final[] = $rowArray;
        }

        response(200, 0, 'Event pages fetched successfully.', $final);
    }

    public function edit($id) {
        if (!$id) {
            response(400, 1, 'ID is required to fetch an event page.', []);
        }

        $this->db->select('p.*, 
            f1.id as file_id1, f1.file as file1, f1.directory_id as dir1,
            f2.id as file_id2, f2.file as file2, f2.directory_id as dir2');
        $this->db->from('anken_event_page p');
        $this->db->join('anken_file_library f1', 'p.top_image1 = f1.id', 'left');
        $this->db->join('anken_file_library f2', 'p.top_image2 = f2.id', 'left');
        $this->db->where('p.id', $id);
        $row = $this->db->get()->row();

        if (!$row) {
            response(404, 1, 'Event page not found.', []);
        }

        $rowArray = (array) $row;

        $topImage1 = null;
        if (!empty($row->file_id1)) {
            $filePath1 = ($row->dir1 == 0)
                ? "{$this->libraryPath}/{$row->file1}"
                : "{$this->libraryPath}/{$row->dir1}/{$row->file1}";
            $topImage1 = [
                'id' => $row->file_id1,
                'file' => $row->file1,
                'directory_id' => $row->dir1,
                'path' => $filePath1
            ];
        }

        $topImage2 = null;
        if (!empty($row->file_id2)) {
            $filePath2 = ($row->dir2 == 0)
                ? "{$this->libraryPath}/{$row->file2}"
                : "{$this->libraryPath}/{$row->dir2}/{$row->file2}";
            $topImage2 = [
                'id' => $row->file_id2,
                'file' => $row->file2,
                'directory_id' => $row->dir2,
                'path' => $filePath2
            ];
        }

        $rowArray['top_image1'] = $topImage1;
        $rowArray['top_image2'] = $topImage2;

        unset(
            $rowArray['file_id1'], $rowArray['file1'], $rowArray['dir1'],
            $rowArray['file_id2'], $rowArray['file2'], $rowArray['dir2']
        );

        response(200, 0, 'Event page fetched successfully.', $rowArray);
    }

    public function delete($id) {
        if (!$id) {
            response(400, 1, 'ID is required to delete an event page.', []);
        }

        $exists = $this->db->get_where('anken_event_page', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'Event page not found.', []);
        }

        $deleted = $this->db->delete('anken_event_page', ['id' => $id]);
        if ($deleted) {
            response(200, 0, 'Event page deleted successfully.', []);
        } else {
            response(500, 1, 'Failed to delete event page.', []);
        }
    }
}

