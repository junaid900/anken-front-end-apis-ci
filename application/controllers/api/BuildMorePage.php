<?php
require_once(APPPATH.'core/SecureApiController.php');

class BuildMorePage extends SecureApiController {
   
    public function add() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());
        
        // Required fields
        $required = [
            'title_en', 'title_ch', 'slug', 
            'short_description_en', 'short_description_ch',
            'page_description_en', 'page_description_ch',
            'top_image'
        ];
        
        foreach ($required as $field) {
            if (!$request->$field) {
                response(403, 1, ucfirst(str_replace('_', ' ', $field)) . ' is required.', []);
            }
        }
    
        // Build data array from all relevant fields
        $data = [
            'title_en' => $request->title_en,
            'title_ch' => $request->title_ch,
            'slug' => $request->slug,
            'short_description_en' => $request->short_description_en,
            'short_description_ch' => $request->short_description_ch,
            'page_description_en' => $request->page_description_en,
            'page_description_ch' => $request->page_description_ch,
            
            'top_image' => $request->top_image,
            'middle_image1' => $request->middle_image1 ?? null,
            'middle_image2' => $request->middle_image2 ?? null,
            'middle_image3' => $request->middle_image3 ?? null,
            'bottom_image1' => $request->bottom_image1 ?? null,
            'bottom_image2' => $request->bottom_image2 ?? null,
            'bottom_image3' => $request->bottom_image3 ?? null,
            
            'status' => $request->status ?? 1,
            'position' => $request->position ?? 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    
        if ($request->id && $request->id != 0) {
            // Update existing
            $this->db->where('id', $request->id);
            $this->db->update('anken_build_more_page', $data);
            $page_id = $request->id;
    
            // Clear old icon features
            $this->db->where(['ref_id' => $page_id, 'type' => 'build_more_page'])->delete('anken_icon_feature');
        } else {
            // Insert new
            $this->db->insert('anken_build_more_page', $data);
            $page_id = $this->db->insert_id();
        }
    
        // Save icon features
        if (!empty($request->icon_features)) {
            foreach ($request->icon_features as $k => $item) {
                if (!empty($item['text']) || !empty($item['greenIcon'])) {
                    $this->db->insert('anken_icon_feature', [
                        'text' => $item['text'] ?? '',
                        'text_ch' => $item['text_ch'] ?? '',
                        'icon' => $item['greenIcon'] ?? '',
                        'position' => $k ?? 0,
                        'type' => 'build_more_page',
                        'ref_id' => $page_id
                    ]);
                }
            }
        }
    
        response(200, 0, 'Build More page saved successfully.', ['id' => $page_id]);
    }
    
    public function get() {
        $this->db->select('
            p.*,
            
            f1.file as top_image_file, f1.directory_id as top_image_dir, f1.id as top_image_id,
            f2.file as middle_image1_file, f2.directory_id as middle_image1_dir, f2.id as middle_image1_id,
            f3.file as middle_image2_file, f3.directory_id as middle_image2_dir, f3.id as middle_image2_id,
            f4.file as middle_image3_file, f4.directory_id as middle_image3_dir, f4.id as middle_image3_id,
            f5.file as bottom_image1_file, f5.directory_id as bottom_image1_dir, f5.id as bottom_image1_id,
            f6.file as bottom_image2_file, f6.directory_id as bottom_image2_dir, f6.id as bottom_image2_id,
            f7.file as bottom_image3_file, f7.directory_id as bottom_image3_dir, f7.id as bottom_image3_id
        ');
        
        $this->db->from('anken_build_more_page p');
        $this->db->join('anken_file_library f1', 'p.top_image = f1.id', 'left');
        $this->db->join('anken_file_library f2', 'p.middle_image1 = f2.id', 'left');
        $this->db->join('anken_file_library f3', 'p.middle_image2 = f3.id', 'left');
        $this->db->join('anken_file_library f4', 'p.middle_image3 = f4.id', 'left');
        $this->db->join('anken_file_library f5', 'p.bottom_image1 = f5.id', 'left');
        $this->db->join('anken_file_library f6', 'p.bottom_image2 = f6.id', 'left');
        $this->db->join('anken_file_library f7', 'p.bottom_image3 = f7.id', 'left');
    
        $results = $this->db->get()->result();
        $final = [];

        foreach ($results as $row) {
            $rowArray = (array) $row;
            $final[] = $rowArray;
        }
    
        response(200, 0, 'Build More pages fetched successfully.', $final);
    }
    
    public function edit($id) {
        if (!$id) {
            response(400, 1, 'ID is required to fetch a page.', []);
        }
    
        $this->db->select('
            p.*,
            
            f1.id as top_image_id, f1.file as top_image_file, f1.directory_id as top_image_dir,
            f2.id as middle_image1_id, f2.file as middle_image1_file, f2.directory_id as middle_image1_dir,
            f3.id as middle_image2_id, f3.file as middle_image2_file, f3.directory_id as middle_image2_dir,
            f4.id as middle_image3_id, f4.file as middle_image3_file, f4.directory_id as middle_image3_dir,
            f5.id as bottom_image1_id, f5.file as bottom_image1_file, f5.directory_id as bottom_image1_dir,
            f6.id as bottom_image2_id, f6.file as bottom_image2_file, f6.directory_id as bottom_image2_dir,
            f7.id as bottom_image3_id, f7.file as bottom_image3_file, f7.directory_id as bottom_image3_dir
        ');
    
        $this->db->from('anken_build_more_page p');
        $this->db->join('anken_file_library f1', 'p.top_image = f1.id', 'left');
        $this->db->join('anken_file_library f2', 'p.middle_image1 = f2.id', 'left');
        $this->db->join('anken_file_library f3', 'p.middle_image2 = f3.id', 'left');
        $this->db->join('anken_file_library f4', 'p.middle_image3 = f4.id', 'left');
        $this->db->join('anken_file_library f5', 'p.bottom_image1 = f5.id', 'left');
        $this->db->join('anken_file_library f6', 'p.bottom_image2 = f6.id', 'left');
        $this->db->join('anken_file_library f7', 'p.bottom_image3 = f7.id', 'left');
        $this->db->where('p.id', $id);
    
        $row = $this->db->get()->row();
    
        if (!$row) {
            response(404, 1, 'Build More page not found.', []);
        }
    
        $rowArray = (array) $row;
    
        $buildImage = function ($id, $file, $dir) {
            if (!$id) return null;
            $path = ($dir == 0) ? "{$this->libraryPath}/{$file}" : "{$this->libraryPath}/{$dir}/{$file}";
            return ['id' => $id, 'file' => $file, 'directory_id' => $dir, 'path' => $path];
        };
    
        $rowArray['top_image'] = $buildImage($row->top_image_id, $row->top_image_file, $row->top_image_dir);
        $rowArray['middle_image1'] = $buildImage($row->middle_image1_id, $row->middle_image1_file, $row->middle_image1_dir);
        $rowArray['middle_image2'] = $buildImage($row->middle_image2_id, $row->middle_image2_file, $row->middle_image2_dir);
        $rowArray['middle_image3'] = $buildImage($row->middle_image3_id, $row->middle_image3_file, $row->middle_image3_dir);
        $rowArray['bottom_image1'] = $buildImage($row->bottom_image1_id, $row->bottom_image1_file, $row->bottom_image1_dir);
        $rowArray['bottom_image2'] = $buildImage($row->bottom_image2_id, $row->bottom_image2_file, $row->bottom_image2_dir);
        $rowArray['bottom_image3'] = $buildImage($row->bottom_image3_id, $row->bottom_image3_file, $row->bottom_image3_dir);
        
        // Unset raw image fields
        unset(
            $rowArray['top_image_id'], $rowArray['top_image_file'], $rowArray['top_image_dir'],
            $rowArray['middle_image1_id'], $rowArray['middle_image1_file'], $rowArray['middle_image1_dir'],
            $rowArray['middle_image2_id'], $rowArray['middle_image2_file'], $rowArray['middle_image2_dir'],
            $rowArray['middle_image3_id'], $rowArray['middle_image3_file'], $rowArray['middle_image3_dir'],
            $rowArray['bottom_image1_id'], $rowArray['bottom_image1_file'], $rowArray['bottom_image1_dir'],
            $rowArray['bottom_image2_id'], $rowArray['bottom_image2_file'], $rowArray['bottom_image2_dir'],
            $rowArray['bottom_image3_id'], $rowArray['bottom_image3_file'], $rowArray['bottom_image3_dir']
        );
    
        // Get icon features
        $this->db->select("aif.*, 
            f1.id as icon_id, f1.file as icon_file, f1.directory_id as icon_dir,
        ");
        $this->db->from('anken_icon_feature aif')
            ->join('anken_file_library f1', 'aif.icon = f1.id', 'left')
            ->where(['aif.ref_id' => $id, 'aif.type' => 'build_more_page'])
            ->order_by('position', 'asc');
        
        $icon_features = $this->db->get()->result();
            
        $final_icon_features = [];
        foreach($icon_features as $f_icon) {
            $f_icon->greenIcon = $buildImage($f_icon->icon_id, $f_icon->icon_file, $f_icon->icon_dir);
            $final_icon_features[] = $f_icon;
        }
    
        $rowArray['icon_features'] = $final_icon_features;
    
        response(200, 0, 'Build More page fetched successfully.', $rowArray);
    }
    
    public function delete($id) {
        if (!$id) {
            response(400, 1, 'ID is required to delete a page.', []);
        }
    
        $exists = $this->db->get_where('anken_build_more_page', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'Build More page not found.', []);
        }
    
        // Start DB transaction to ensure atomic delete
        $this->db->trans_start();
    
        // Delete icon features
        $this->db->delete('anken_icon_feature', [
            'ref_id' => $id,
            'type' => 'anken_build_more_page'
        ]);
    
        // Delete the page
        $this->db->delete('anken_build_more_page', ['id' => $id]);
    
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === FALSE) {
            response(500, 1, 'Failed to delete Build More page and its related features.', []);
        } else {
            response(200, 0, 'Build More page deleted successfully along with related features.', []);
        }
    }
}