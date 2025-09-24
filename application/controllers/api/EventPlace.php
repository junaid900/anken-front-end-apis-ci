<?php
require_once(APPPATH.'core/SecureApiController.php');

class EventPlace extends SecureApiController {

    public function add() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());

        // Validation
        if (!$request->title_en) {
            response(403, 1, 'English title cannot be empty.', []);
        }
        if (!$request->title_ch) {
            response(403, 1, 'Chinese title cannot be empty.', []);
        }
        if (!$request->location_en) {
            response(403, 1, 'Location EN cannot be empty.', []);
        }
        if (!$request->location_ch) {
            response(403, 1, 'Location CH cannot be empty.', []);
        }
        if (!$request->short_description_en) {
            response(403, 1, 'Short description EN cannot be empty.', []);
        }
        if (!$request->short_description_ch) {
            response(403, 1, 'Short description CH cannot be empty.', []);
        }
        if (!$request->image) {
            response(403, 1, 'Image is required.', []);
        }
        if (!$request->event_page_id) {
            response(403, 1, 'Event Page ID is required.', []);
        }

        // Prepare data
        $data = [
            'title_en' => $request->title_en,
            'title_ch' => $request->title_ch,
            'location_en' => $request->location_en,
            'location_ch' => $request->location_ch,
            'short_description_en' => $request->short_description_en,
            'short_description_ch' => $request->short_description_ch,
            'image' => $request->image,
            'event_page_id' => $request->event_page_id,
            'status' => 1,
            'position' => $request->position ?? 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($request->id && $request->id != 0) {
            // Update existing
            $this->db->where('id', $request->id);
            $this->db->update('anken_event_places', $data);
            response(200, 0, 'Event place updated successfully.', []);
        } else {
            // Insert new
            $data['created_at'] = date('Y-m-d H:i:s');
            $res = $this->db->insert('anken_event_places', $data);
            if ($res) {
                response(200, 0, 'Event place added successfully.', []);
            } else {
                response(500, 1, 'Failed to insert event place.', []);
            }
        }
    }

    public function get($eventPageId) {
        if (!$eventPageId) {
            response(400, 1, 'Event Page ID is required.', []);
        }

        $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
        $this->db->from('anken_event_places p');
        $this->db->join('anken_file_library f', 'p.image = f.id', 'left');
        $this->db->where('p.event_page_id', $eventPageId);
        $this->db->order_by('p.position', 'ASC');
        $results = $this->db->get()->result();

        $final = [];

        foreach ($results as $row) {
            $rowArray = (array) $row;

            $file = null;
            if (!empty($row->file_id)) {
                $filePath = ($row->directory_id == 0)
                    ? "{$this->libraryPath}/{$row->file}"
                    : "{$this->libraryPath}/{$row->directory_id}/{$row->file}";

                $file = [
                    'id' => $row->file_id,
                    'file' => $row->file,
                    'directory_id' => $row->directory_id,
                    'path' => $filePath
                ];
            }

            $rowArray['image'] = $file;
            unset($rowArray['file_id'], $rowArray['file'], $rowArray['directory_id']);

            $final[] = $rowArray;
        }

        if ($final) {
            response(200, 0, 'Event places fetched successfully.', $final);
        } else {
            response(200, 0, 'No event places found.', []);
        }
    }

    public function delete($id) {
        if (!$id) {
            response(400, 1, 'ID is required to delete an event place.', []);
        }

        $exists = $this->db->get_where('anken_event_places', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'Event place not found.', []);
        }

        $deleted = $this->db->delete('anken_event_places', ['id' => $id]);
        if ($deleted) {
            response(200, 0, 'Event place deleted successfully.', []);
        } else {
            response(500, 1, 'Failed to delete event place.', []);
        }
    }
}

