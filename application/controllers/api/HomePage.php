<?php
require_once(APPPATH.'core/SecureApiController.php');
class HomePage extends SecureApiController {
    public function add() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());

        $required = [
            'title_en', 'title_ch',
            'leasing_innert_content_en', 'leasing_innert_content_ch',
            'leasing_url', 'leasing_image',
            'places_inner_content_en', 'places_inner_content_ch',
            'places_url', 'places_image',
            'page1_title_en', 'page1_title_ch', 'page1_url',
            'page1_description_en', 'page1_description_ch',
            'bottom_cover1', 'bottom_cover1_url', 'bottom_image1', 'bottom_image1_url',
            'page2_title_en', 'page2_title_ch', 'page2_description_en', 'page2_description_ch', 'page2_url',
            'bottom_cover2', 'bottom_cover2_url', 'bottom_cover3', 'bottom_cover3_url',
            'bottom_cover3_description_en', 'bottom_cover3_description_ch',
            'bottom_cover4', 'bottom_cover4_url',
            'bottom_cover4_description_en', 'bottom_cover4_description_ch'
        ];

        foreach ($required as $field) {
            if (!$request->$field) {
                response(403, 1, ucfirst(str_replace('_', ' ', $field)) . ' is required.', []);
            }
        }

        $data = [];
        foreach ($required as $field) {
            $data[$field] = $request->$field;
        }
        // $data['created_at'] = date('Y-m-d H:i:s');
        // $data['updated_at'] = date('Y-m-d H:i:s');

        if ($request->id && $request->id != 0) {
            $this->db->where('id', $request->id);
            $this->db->update('anken_home_page', $data);
            $home_id = $request->id;

            $this->db->where(['ref_id' => $home_id, 'type' => 'home_page'])->delete('anken_icon_feature');
        } else {
            $this->db->insert('anken_home_page', $data);
            $home_id = $this->db->insert_id();
        }

        if (!empty($request->icon_features) && is_array($request->icon_features)) {
            foreach ($request->icon_features as $k => $item) {
                if (!empty($item['text']) || !empty($item['greenIcon'])) {
                    $this->db->insert('anken_icon_feature', [
                        'text' => $item['text'] ?? '',
                        'text_ch' => $item['text_ch'],
                        'icon' => $item['greenIcon'] ?? '',
                        'position' => $k ?? 0,
                        'type' => 'home_page',
                        'ref_id' => $home_id
                    ]);
                }
            }
        }

        response(200, 0, 'Home page saved successfully.', ['id' => $home_id]);
    }

    public function get() {
        $results = $this->db->get('anken_home_page')->result();
        response(200, 0, 'Home pages fetched successfully.', $results);
    }

    public function edit($id) {
        if (!$id) {
            response(400, 1, 'ID is required to fetch a page.', []);
        }
    
        $this->db->select('
            p.*,
    
            f1.id as leasing_image_id, f1.file as leasing_image_file, f1.directory_id as leasing_image_dir,
            f2.id as places_image_id, f2.file as places_image_file, f2.directory_id as places_image_dir,
            f3.id as bottom_image1_id, f3.file as bottom_image1_file, f3.directory_id as bottom_image1_dir,
            f4.id as bottom_cover1_id, f4.file as bottom_cover1_file, f4.directory_id as bottom_cover1_dir,
            f5.id as bottom_cover2_id, f5.file as bottom_cover2_file, f5.directory_id as bottom_cover2_dir,
            f6.id as bottom_cover3_id, f6.file as bottom_cover3_file, f6.directory_id as bottom_cover3_dir,
            f7.id as bottom_cover4_id, f7.file as bottom_cover4_file, f7.directory_id as bottom_cover4_dir
        ');
    
        $this->db->from('anken_home_page p');
        $this->db->join('anken_file_library f1', 'p.leasing_image = f1.id', 'left');
        $this->db->join('anken_file_library f2', 'p.places_image = f2.id', 'left');
        $this->db->join('anken_file_library f3', 'p.bottom_image1 = f3.id', 'left');
        $this->db->join('anken_file_library f4', 'p.bottom_cover1 = f4.id', 'left');
        $this->db->join('anken_file_library f5', 'p.bottom_cover2 = f5.id', 'left');
        $this->db->join('anken_file_library f6', 'p.bottom_cover3 = f6.id', 'left');
        $this->db->join('anken_file_library f7', 'p.bottom_cover4 = f7.id', 'left');
        $this->db->where('p.id', $id);
    
        $row = $this->db->get()->row();
    
        if (!$row) {
            response(404, 1, 'Home page not found.', []);
        }
    
        $rowArray = (array) $row;
    
        $buildImage = function ($id, $file, $dir) {
            if (!$id) return null;
            $path = ($dir == 0) ? "{$this->libraryPath}/{$file}" : "{$this->libraryPath}/{$dir}/{$file}";
            return ['id' => $id, 'file' => $file, 'directory_id' => $dir, 'path' => $path];
        };
    
        $rowArray['leasing_image']      = $buildImage($row->leasing_image_id, $row->leasing_image_file, $row->leasing_image_dir);
        $rowArray['places_image']       = $buildImage($row->places_image_id, $row->places_image_file, $row->places_image_dir);
        $rowArray['bottom_image1']      = $buildImage($row->bottom_image1_id, $row->bottom_image1_file, $row->bottom_image1_dir);
        $rowArray['bottom_cover1']      = $buildImage($row->bottom_cover1_id, $row->bottom_cover1_file, $row->bottom_cover1_dir);
        $rowArray['bottom_cover2']      = $buildImage($row->bottom_cover2_id, $row->bottom_cover2_file, $row->bottom_cover2_dir);
        $rowArray['bottom_cover3']      = $buildImage($row->bottom_cover3_id, $row->bottom_cover3_file, $row->bottom_cover3_dir);
        $rowArray['bottom_cover4']      = $buildImage($row->bottom_cover4_id, $row->bottom_cover4_file, $row->bottom_cover4_dir);
    
        // Unset raw image fields
        unset(
            $rowArray['leasing_image_id'], $rowArray['leasing_image_file'], $rowArray['leasing_image_dir'],
            $rowArray['places_image_id'], $rowArray['places_image_file'], $rowArray['places_image_dir'],
            $rowArray['bottom_image1_id'], $rowArray['bottom_image1_file'], $rowArray['bottom_image1_dir'],
            $rowArray['bottom_cover1_id'], $rowArray['bottom_cover1_file'], $rowArray['bottom_cover1_dir'],
            $rowArray['bottom_cover2_id'], $rowArray['bottom_cover2_file'], $rowArray['bottom_cover2_dir'],
            $rowArray['bottom_cover3_id'], $rowArray['bottom_cover3_file'], $rowArray['bottom_cover3_dir'],
            $rowArray['bottom_cover4_id'], $rowArray['bottom_cover4_file'], $rowArray['bottom_cover4_dir']
        );
        
        
        $this->db->select("aif.*, 
            f1.id as icon_id, f1.file as icon_file, f1.directory_id as icon_dir,
        ");
        $this->db->from('anken_icon_feature aif')
            ->join('anken_file_library f1', 'aif.icon = f1.id', 'left')
            ->where(['aif.ref_id' => $id, 'aif.type' => 'home_page'])
            ->order_by('position', 'asc');
        
        $icon_features = $this->db->get()->result();
            
        $final_icon_features = [];
        foreach($icon_features as $f_icon){
            $f_icon->greenIcon = $buildImage($f_icon->icon_id, $f_icon->icon_file, $f_icon->icon_dir);
            $final_icon_features[] = $f_icon;
        }
        $rowArray['icon_features'] = $final_icon_features;
    
        response(200, 0, 'Home page fetched successfully.', $rowArray);
    }


    public function delete($id) {
        if (!$id) {
            response(400, 1, 'ID is required to delete the home page.', []);
        }

        $exists = $this->db->get_where('anken_home_page', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'Home page not found.', []);
        }

        $this->db->trans_start();
        $this->db->delete('anken_icon_feature', ['ref_id' => $id, 'type' => 'home_page']);
        $this->db->delete('anken_home_page', ['id' => $id]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            response(500, 1, 'Failed to delete home page and its related icon features.', []);
        } else {
            response(200, 0, 'Home page deleted successfully along with related icon features.', []);
        }
    }
}
