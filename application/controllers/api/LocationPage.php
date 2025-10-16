<?php
require_once(APPPATH.'core/SecureApiController.php');

class LocationPage extends SecureApiController {
    
   public function add() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());
        // var_dump($request);
        // var_dump($request->text_features);
        // Required fields
        $required = [
            'title_en', 'title_ch', 'slug', 
            'short_description_en', 'short_description_ch',
            'page_description_en', 'page_description_ch',
            'description_bottom_en', 'description_bottom_ch',
            'feature_description_bottom_en', 'feature_description_bottom_ch',
            'available_leasing_type',
            // 'available_leasing_title_en', 'available_leasing_title_ch',
            //'available_leasing_description_en','available_leasing_description_ch',
            'top_image1', 'top_image2', //'bottom_image1', 'bottom_image2', 'bottom_image3',
        ];
        
        foreach ($required as $field) {
            if (!$request->$field) {
                response(403, 1, ucfirst(str_replace('_', ' ', $field)) . ' is required.', []);
            }
        }
        if($request->available_leasing_type == 'image'){
            if(!$request->available_leasing_image2){
                response(403, 1, 'Available leasing image 2 is required.', []);
            }
        }else{
            if(!$request->available_leasing_title_en){
                response(403, 1, ucfirst(str_replace('_', ' ', 'available_leasing_title_en')) . ' is required.', []);
            }
            if(!$request->available_leasing_title_ch){
                response(403, 1, ucfirst(str_replace('_', ' ', 'available_leasing_title_ch')) . ' is required.', []);
            }
            if(!$request->available_leasing_description_en){
                response(403, 1, ucfirst(str_replace('_', ' ', 'available_leasing_description_en')) . ' is required.', []);
            }
            if(!$request->available_leasing_description_ch){
                response(403, 1, ucfirst(str_replace('_', ' ', 'available_leasing_description_ch')) . ' is required.', []);
            }
        }
        
    
        // Build data array from all relevant fields (optional fields allowed)
        $data = [
            'title_en' => $request->title_en,
            'title_ch' => $request->title_ch,
            'slug' => $request->slug,
            'short_description_en' => $request->short_description_en,
            'short_description_ch' => $request->short_description_ch,
            'page_description_en' => $request->page_description_en,
            'page_description_ch' => $request->page_description_ch,
            'description_bottom_en' => $request->description_bottom_en ?? null,
            'description_bottom_ch' => $request->description_bottom_ch ?? null,
            'feature_description_bottom_en' => $request->feature_description_bottom_en ?? null,
            'feature_description_bottom_ch' => $request->feature_description_bottom_ch ?? null,
            
            'available_leasing_title_en' => $request->available_leasing_title_en ?? null,
            'available_leasing_title_ch' => $request->available_leasing_title_ch ?? null,
            'available_leasing_description_en' => $request->available_leasing_description_en ?? null,
            'available_leasing_description_ch' => $request->available_leasing_description_ch ?? null,
            
            'top_image1' => $request->top_image1,
            'top_image2' => $request->top_image2 ?? null,
            'available_leasing_image' => $request->available_leasing_image ?? null,
            'bottom_image1' => $request->bottom_image1 ?? null,
            'bottom_image2' => $request->bottom_image2 ?? null,
            'bottom_image3' => $request->bottom_image3 ?? null,
            
            // 'description_type' => $request->description_type ?? null,
            'available_leasing_image2' => $request->available_leasing_image2 ?? null,
            'available_leasing_type' => $request->available_leasing_type ?? null,
            'available_leasing_url' => $request->available_leasing_url ?? null,
            'bottom_image1_url' => $request->bottom_image1_url ?? null,
            'bottom_image2_url' => $request->bottom_image2_url ?? null,
            'bottom_image3_url' => $request->bottom_image3_url ?? null,
            
            'status' => $request->status ?? 1,
            'page_type' => $request->page_type ?? 'anken_properties',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        if($request->position){
            $data["position"] = $request->position;
        }
    
        if ($request->id && $request->id != 0) {
            // Update existing
            $this->db->where('id', $request->id);
            $this->db->update('anken_location_page', $data);
            $location_id = $request->id;
    
            // Clear old features
            $this->db->where(['ref_id' => $location_id, 'type' => 'location_page'])->delete('anken_text_feature');
            $this->db->where(['ref_id' => $location_id, 'type' => 'location_page'])->delete('anken_icon_feature');
    
        } else {
            // Insert new
            $this->db->insert('anken_location_page', $data);
            $location_id = $this->db->insert_id();
        }
    
        // Save text features 
        if (!empty($request->text_features) && is_array($request->text_features)) {
            foreach ($request->text_features as $k => $item) {
                if (!empty($item['text'])) {
                    $this->db->insert('anken_text_feature', [
                        'text' => $item['text'],
                        'text_ch' => $item['text_ch'],
                        'position' => $k ?? 0,
                        'type' => 'location_page',
                        'ref_id' => $location_id
                    ]);
                }
            }
        }
    
        // Save icon features
        if (!empty($request->icon_features) && is_array($request->icon_features)) {
            foreach ($request->icon_features as $k => $item) {
                if (!empty($item['text']) || !empty($item['greenIcon'])) {
                    $this->db->insert('anken_icon_feature', [
                        'text' => $item['text'] ?? '',
                        'text_ch' => $item['text_ch'],
                        'icon' => $item['greenIcon'] ?? '',
                        'position' => $k ?? 0,
                        'type' => 'location_page',
                        'ref_id' => $location_id
                    ]);
                }
            }
        }
    
        response(200, 0, 'Location page saved successfully.', ['id' => $location_id]);
    }
    public function get() {
        $this->db->select('
            p.*,
    
            f1.file as top_image1_file, f1.directory_id as top_image1_dir, f1.id as top_image1_id,
            f2.file as top_image2_file, f2.directory_id as top_image2_dir, f2.id as top_image2_id,
            f3.file as available_leasing_image_file, f3.directory_id as available_leasing_image_dir, f3.id as available_leasing_image_id,
            f4.file as bottom_image1_file, f4.directory_id as bottom_image1_dir, f4.id as bottom_image1_id,
            f5.file as bottom_image2_file, f5.directory_id as bottom_image2_dir, f5.id as bottom_image2_id,
            f6.file as bottom_image3_file, f6.directory_id as bottom_image3_dir, f6.id as bottom_image3_id
        ');
        
        $this->db->from('anken_location_page p');
        $this->db->join('anken_file_library f1', 'p.top_image1 = f1.id', 'left');
        $this->db->join('anken_file_library f2', 'p.top_image2 = f2.id', 'left');
        $this->db->join('anken_file_library f3', 'p.available_leasing_image = f3.id', 'left');
        $this->db->join('anken_file_library f4', 'p.bottom_image1 = f4.id', 'left');
        $this->db->join('anken_file_library f5', 'p.bottom_image2 = f5.id', 'left');
        $this->db->join('anken_file_library f6', 'p.bottom_image3 = f6.id', 'left');
    
        $results = $this->db->get()->result();
        $final = [];

        foreach ($results as $row) {
            $rowArray = (array) $row;
    
        //     $buildImage = function ($id, $file, $dir) {
        //         if (!$id) return null;
        //         $path = ($dir == 0) ? "{$this->libraryPath}/{$file}" : "{$this->libraryPath}/{$dir}/{$file}";
        //         return ['id' => $id, 'file' => $file, 'directory_id' => $dir, 'path' => $path];
        //     };
    
        //     // Replace image IDs with image objects
        //     $rowArray['top_image1'] = $buildImage($row->top_image1_id, $row->top_image1_file, $row->top_image1_dir);
        //     $rowArray['top_image2'] = $buildImage($row->top_image2_id, $row->top_image2_file, $row->top_image2_dir);
        //     $rowArray['available_leasing_image'] = $buildImage($row->available_leasing_image_id, $row->available_leasing_image_file, $row->available_leasing_image_dir);
        //     $rowArray['bottom_image1'] = $buildImage($row->bottom_image1_id, $row->bottom_image1_file, $row->bottom_image1_dir);
        //     $rowArray['bottom_image2'] = $buildImage($row->bottom_image2_id, $row->bottom_image2_file, $row->bottom_image2_dir);
        //     $rowArray['bottom_image3'] = $buildImage($row->bottom_image3_id, $row->bottom_image3_file, $row->bottom_image3_dir);
    
        //     // Remove raw file fields
        //     unset(
        //         $rowArray['top_image1_id'], $rowArray['top_image1_file'], $rowArray['top_image1_dir'],
        //         $rowArray['top_image2_id'], $rowArray['top_image2_file'], $rowArray['top_image2_dir'],
        //         $rowArray['available_leasing_image_id'], $rowArray['available_leasing_image_file'], $rowArray['available_leasing_image_dir'],
        //         $rowArray['bottom_image1_id'], $rowArray['bottom_image1_file'], $rowArray['bottom_image1_dir'],
        //         $rowArray['bottom_image2_id'], $rowArray['bottom_image2_file'], $rowArray['bottom_image2_dir'],
        //         $rowArray['bottom_image3_id'], $rowArray['bottom_image3_file'], $rowArray['bottom_image3_dir']
        //     );
    
        //     // Load text features
        //     $text_features = $this->db
        //         ->order_by('position', 'asc')
        //         ->get_where('anken_text_feature', ['ref_id' => $row->id, 'type' => 'location_page'])
        //         ->result();
    
        //     // Load icon features
        //     $icon_features = $this->db
        //         ->order_by('position', 'asc')
        //         ->get_where('anken_icon_feature', ['ref_id' => $row->id, 'type' => 'location_page'])
        //         ->result();
    
        //     $rowArray['text_features'] = $text_features;
        //     $rowArray['icon_features'] = $icon_features;
    
            $final[] = $rowArray;
        }
    
        response(200, 0, 'Location pages fetched successfully.', $final);
    }
    public function edit($id) {
        if (!$id) {
            response(400, 1, 'ID is required to fetch a page.', []);
        }
    
        $this->db->select('
            p.*,
    
            f1.id as top_image1_id, f1.file as top_image1_file, f1.directory_id as top_image1_dir,
            f2.id as top_image2_id, f2.file as top_image2_file, f2.directory_id as top_image2_dir,
            f3.id as available_leasing_image_id, f3.file as available_leasing_image_file, f3.directory_id as available_leasing_image_dir,
            f4.id as bottom_image1_id, f4.file as bottom_image1_file, f4.directory_id as bottom_image1_dir,
            f5.id as bottom_image2_id, f5.file as bottom_image2_file, f5.directory_id as bottom_image2_dir,
            f6.id as bottom_image3_id, f6.file as bottom_image3_file, f6.directory_id as bottom_image3_dir,
            f7.id as available_leasing_image2_id, f7.file as available_leasing_image2_file, f7.directory_id as available_leasing_image2_dir,
        ');
    
        $this->db->from('anken_location_page p');
        $this->db->join('anken_file_library f1', 'p.top_image1 = f1.id', 'left');
        $this->db->join('anken_file_library f2', 'p.top_image2 = f2.id', 'left');
        $this->db->join('anken_file_library f3', 'p.available_leasing_image = f3.id', 'left');
        $this->db->join('anken_file_library f4', 'p.bottom_image1 = f4.id', 'left');
        $this->db->join('anken_file_library f5', 'p.bottom_image2 = f5.id', 'left');
        $this->db->join('anken_file_library f6', 'p.bottom_image3 = f6.id', 'left');
        $this->db->join('anken_file_library f7', 'p.available_leasing_image2 = f7.id', 'left');
        $this->db->where('p.id', $id);
    
        $row = $this->db->get()->row();
    
        if (!$row) {
            response(404, 1, 'Location page not found.', []);
        }
    
        $rowArray = (array) $row;
    
        $buildImage = function ($id, $file, $dir) {
            if (!$id) return null;
            $path = ($dir == 0) ? "{$this->libraryPath}/{$file}" : "{$this->libraryPath}/{$dir}/{$file}";
            return ['id' => $id, 'file' => $file, 'directory_id' => $dir, 'path' => $path];
        };
    
        $rowArray['top_image1'] = $buildImage($row->top_image1_id, $row->top_image1_file, $row->top_image1_dir);
        $rowArray['top_image2'] = $buildImage($row->top_image2_id, $row->top_image2_file, $row->top_image2_dir);
        $rowArray['available_leasing_image'] = $buildImage($row->available_leasing_image_id, $row->available_leasing_image_file, $row->available_leasing_image_dir);
        $rowArray['bottom_image1'] = $buildImage($row->bottom_image1_id, $row->bottom_image1_file, $row->bottom_image1_dir);
        $rowArray['bottom_image2'] = $buildImage($row->bottom_image2_id, $row->bottom_image2_file, $row->bottom_image2_dir);
        $rowArray['bottom_image3'] = $buildImage($row->bottom_image3_id, $row->bottom_image3_file, $row->bottom_image3_dir);
        $rowArray['available_leasing_image2'] = $buildImage($row->available_leasing_image2_id, $row->available_leasing_image2_file, $row->available_leasing_image2_dir);
        // Unset raw image fields
        unset(
            $rowArray['top_image1_id'], $rowArray['top_image1_file'], $rowArray['top_image1_dir'],
            $rowArray['top_image2_id'], $rowArray['top_image2_file'], $rowArray['top_image2_dir'],
            $rowArray['available_leasing_image_id'], $rowArray['available_leasing_image_file'], $rowArray['available_leasing_image_dir'],
            $rowArray['bottom_image1_id'], $rowArray['bottom_image1_file'], $rowArray['bottom_image1_dir'],
            $rowArray['bottom_image2_id'], $rowArray['bottom_image2_file'], $rowArray['bottom_image2_dir'],
            $rowArray['bottom_image3_id'], $rowArray['bottom_image3_file'], $rowArray['bottom_image3_dir']
        );
    
        // Get text features
        $text_features = $this->db
            ->order_by('position', 'asc')
            ->get_where('anken_text_feature', ['ref_id' => $id, 'type' => 'location_page'])
            ->result();
    
        // Get icon features
        $this->db->select("aif.*, 
            f1.id as icon_id, f1.file as icon_file, f1.directory_id as icon_dir,
        ");
        $this->db->from('anken_icon_feature aif')
            ->join('anken_file_library f1', 'aif.icon = f1.id', 'left')
            ->where(['aif.ref_id' => $id, 'aif.type' => 'location_page'])
            ->order_by('position', 'asc');
        
        $icon_features = $this->db->get()->result();
            
        $final_icon_features = [];
        foreach($icon_features as $f_icon){
            $f_icon->greenIcon = $buildImage($f_icon->icon_id, $f_icon->icon_file, $f_icon->icon_dir);
            $final_icon_features[] = $f_icon;
        }
    
        $rowArray['text_features'] = $text_features;
        $rowArray['icon_features'] = $icon_features;
    
        response(200, 0, 'Location page fetched successfully.', $rowArray);
    }
    public function delete($id)
    {
        if (!$id) {
            response(400, 1, 'ID is required to delete a location page.', []);
        }
    
        $exists = $this->db->get_where('anken_location_page', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'Location page not found.', []);
        }
    
        // Start DB transaction to ensure atomic delete
        $this->db->trans_start();
    
        // Delete text features
        $this->db->delete('anken_text_feature', [
            'ref_id' => $id,
            'type' => 'location_page'
        ]);
    
        // Delete icon features
        $this->db->delete('anken_icon_feature', [
            'ref_id' => $id,
            'type' => 'location_page'
        ]);
    
        // Delete the location page
        $this->db->delete('anken_location_page', ['id' => $id]);
    
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === FALSE) {
            response(500, 1, 'Failed to delete location page and its related features.', []);
        } else {
            response(200, 0, 'Location page deleted successfully along with related features.', []);
        }
    }
}