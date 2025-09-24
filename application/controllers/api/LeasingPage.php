<?php
require_once(APPPATH.'core/SecureApiController.php');

class LeasingPage extends SecureApiController {
    
    public function add() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());
    
        if (!$request->en_title) {
            response(403, 1, 'English title cannot be empty.', []);
        }
        if (!$request->ch_title) {
            response(403, 1, 'Chinese title cannot be empty.', []);
        }
        if (!$request->leasing_slug) {
            response(403, 1, 'Slug cannot be empty.', []);
        }
        if (!$request->short_description_en) {
            response(403, 1, 'Short Description EN cannot be empty.', []);
        }
        if (!$request->short_description_ch) {
            response(403, 1, 'Short Description CH cannot be empty.', []);
        }
        if (!$request->page_description_en) {
            response(403, 1, 'Page Description EN cannot be empty.', []);
        }
        if (!$request->page_description_ch) {
            response(403, 1, 'Page Description CH cannot be empty.', []);
        }
        if (!$request->top_image) {
            response(403, 1, 'Top image cannot be empty.', []);
        }
        
        $data = [
            'title_en' => $request->en_title,
            'title_ch' => $request->ch_title,
            'slug' => $request->leasing_slug,
            'short_description_en' => $request->short_description_en,
            'short_description_ch' => $request->short_description_ch,
            'page_description_en' => $request->page_description_en,
            'page_description_ch' => $request->page_description_ch,
            'top_image' => $request->top_image,
            'status' => 1,
        ];
        if($request->id && $request->id != 0){
            $this->db->where('id', $request->id);
            $this->db->update('anken_leasing_page', $data);
            response(200, 0, 'Page updated successfully.', []);
            return;
        }else{
            $res = $this->db->insert('anken_leasing_page', $data);    
        }
        
    
        if ($res) {
            response(200, 0, 'Page added successfully.', []);
        } else {
            response(403, 1, 'Failed to insert data.', []);
        }
    }
    public function get() {
        $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
        $this->db->from('anken_leasing_page p');
        $this->db->join('anken_file_library f', 'p.top_image = f.id', 'left');
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
    
            $rowArray['top_image'] = $file;
    
            unset($rowArray['file_id'], $rowArray['file'], $rowArray['directory_id']);
    
            $final[] = $rowArray;
        }
    
        if ($final) {
            response(200, 0, 'Leasing pages fetched successfully.', $final);
        } else {
            response(200, 0, 'No leasing pages found.', []);
        }
    }
    public function edit($id) {
        if (!$id) {
            response(400, 1, 'ID is required to fetch a leasing page.', []);
        }
    
        $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
        $this->db->from('anken_leasing_page p');
        $this->db->join('anken_file_library f', 'p.top_image = f.id', 'left');
        $this->db->where('p.id', $id);
        $row = $this->db->get()->row();
    
        if (!$row) {
            response(404, 1, 'Leasing page not found.', []);
        }
    
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
    
        $rowArray['top_image'] = $file;
    
        unset($rowArray['file_id'], $rowArray['file'], $rowArray['directory_id']);
    
        response(200, 0, 'Leasing page fetched successfully.', $rowArray);
    }
    public function delete($id) {
        if (!$id) {
            response(400, 1, 'ID is required to delete a page.', []);
        }
    
        $exists = $this->db->get_where('anken_leasing_page', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'Leasing page not found.', []);
        }
    
        $deleted = $this->db->delete('anken_leasing_page', ['id' => $id]);
    
        if ($deleted) {
            response(200, 0, 'Leasing page deleted successfully.', []);
        } else {
            response(500, 1, 'Failed to delete leasing page.', []);
        }
    }
}