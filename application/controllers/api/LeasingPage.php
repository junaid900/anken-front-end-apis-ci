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
            'page_description1_ch' => $request->page_description_ch,
            
            "description_type" => $request->description_type ?? 'one',
            'page_description1_en' => $request->page_description1_en,
            'page_description1_ch' => $request->page_description1_ch,
            'description_image1_caption_en' => $request->description_image1_caption_en,
            'description_image1_caption_ch' => $request->description_image1_caption_ch,
            'description_image2_caption_en' => $request->description_image2_caption_en,
            'description_image2_caption_ch' => $request->description_image2_caption_ch,
            'description_image1' => $request->description_image1,
            'description_image2' => $request->description_image2,
            
            // description_image1_caption_en
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
        // Validate ID
        if (!$id || !is_numeric($id)) {
            response(400, 1, 'Valid ID is required to fetch a leasing page.', []);
        }
    
        try {
            // Select all necessary fields
            $this->db->select('
                p.*, 
                f_top.id as top_image_file_id, 
                f_top.file as top_image_file, 
                f_top.directory_id as top_image_directory_id,
                f_desc1.id as desc_image1_file_id,
                f_desc1.file as desc_image1_file,
                f_desc1.directory_id as desc_image1_directory_id,
                f_desc2.id as desc_image2_file_id,
                f_desc2.file as desc_image2_file,
                f_desc2.directory_id as desc_image2_directory_id
            ');
            $this->db->from('anken_leasing_page p');
            
            // Join for top image
            $this->db->join('anken_file_library f_top', 'p.top_image = f_top.id', 'left');
            
            // Join for description image 1
            $this->db->join('anken_file_library f_desc1', 'p.description_image1 = f_desc1.id', 'left');
            
            // Join for description image 2
            $this->db->join('anken_file_library f_desc2', 'p.description_image2 = f_desc2.id', 'left');
            
            $this->db->where('p.id', $id);
            $query = $this->db->get();
            
            if ($query->num_rows() === 0) {
                response(404, 1, 'Leasing page not found.', []);
            }
    
            $row = $query->row();
            $result = (array) $row;
    
            // Process top image
            $result['top_image'] = $this->processImageFile(
                $row->top_image_file_id, 
                $row->top_image_file, 
                $row->top_image_directory_id
            );
    
            // Process description image 1
            $result['description_image1'] = $this->processImageFile(
                $row->desc_image1_file_id, 
                $row->desc_image1_file, 
                $row->desc_image1_directory_id
            );
    
            // Process description image 2
            $result['description_image2'] = $this->processImageFile(
                $row->desc_image2_file_id, 
                $row->desc_image2_file, 
                $row->desc_image2_directory_id
            );
    
            // Remove temporary fields
            $this->removeTemporaryFields($result);
    
            response(200, 0, 'Leasing page fetched successfully.', $result);
    
        } catch (Exception $e) {
            log_message('error', 'Error fetching leasing page: ' . $e->getMessage());
            response(500, 1, 'An error occurred while fetching the leasing page.', []);
        }
    }
    
    /**
     * Process image file data and return structured array
     */
    private function processImageFile($fileId, $fileName, $directoryId) {
        if (empty($fileId)) {
            return null;
        }
    
        $filePath = ($directoryId == 0)
            ? "{$this->libraryPath}/{$fileName}"
            : "{$this->libraryPath}/{$directoryId}/{$fileName}";
    
        return [
            'id' => $fileId,
            'file' => $fileName,
            'directory_id' => $directoryId,
            'path' => $filePath
        ];
    }
    
    /**
     * Remove temporary fields from result array
     */
    private function removeTemporaryFields(&$result) {
        $tempFields = [
            'top_image_file_id', 'top_image_file', 'top_image_directory_id',
            'desc_image1_file_id', 'desc_image1_file', 'desc_image1_directory_id',
            'desc_image2_file_id', 'desc_image2_file', 'desc_image2_directory_id'
        ];
        
        foreach ($tempFields as $field) {
            if (array_key_exists($field, $result)) {
                unset($result[$field]);
            }
        }
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