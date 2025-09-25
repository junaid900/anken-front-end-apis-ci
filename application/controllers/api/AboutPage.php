<?php
require_once(APPPATH.'core/SecureApiController.php');

class AboutPage extends SecureApiController {
    
   public function add() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());
    
        // Validation
        if (!$request->title_en) response(403, 1, 'English title cannot be empty.', []);
        if (!$request->title_ch) response(403, 1, 'Chinese title cannot be empty.', []);
        if (!$request->slug) response(403, 1, 'Slug cannot be empty.', []);
        if (!$request->short_description_en) response(403, 1, 'Short Description (EN) cannot be empty.', []);
        if (!$request->short_description_ch) response(403, 1, 'Short Description (CH) cannot be empty.', []);
        if (!$request->page_type) response(403, 1, 'Page type is required.', []);
    
        $page_type = $request->page_type;
        $page_id = $request->id ?? null;
        $aboutId = null;
    
        if ($page_type == 'about_page_detail') {
            if (!$request->page_description_en) response(403, 1, 'Page Description (EN) cannot be empty.', []);
            if (!$request->page_description_ch) response(403, 1, 'Page Description (CH) cannot be empty.', []);
            if (!$request->top_image) response(403, 1, 'Top image is required.', []);
            if (!$request->bottom_image1) response(403, 1, 'Bottom Image 1 is required.', []);
            if (!$request->bottom_image2) response(403, 1, 'Bottom Image 2 is required.', []);
            if (!$request->bottom_image3) response(403, 1, 'Bottom Image 3 is required.', []);
        }
    
        // Insert or Update
        if ($page_id) {
            // Fetch existing page
            $page = $this->db->where('id', $page_id)->get('anken_about_page')->row();
            if (!$page) response(404, 1, 'Page not found.', []);
    
            // Update about_page_detail if type is about_page_detail
            if ($page_type == 'about_page_detail' && $page->about_page_id) {
                $aboutPageData = [
                    'page_description_en' => $request->page_description_en,
                    'page_description_ch' => $request->page_description_ch,
                    'top_image' => $request->top_image,
                    'bottom_image1' => $request->bottom_image1,
                    'bottom_image2' => $request->bottom_image2,
                    'bottom_image3' => $request->bottom_image3,
                    'bottom_images_type' => $request->bottom_images_type ?? '1',
                ];
                $this->db->where('id', $page->about_page_id)->update('anken_about_page_detail', $aboutPageData);
                $aboutId = $page->about_page_id;
            }
    
            // Update anken_about_page (except page_type)
            $pageData = [
                'title_en' => $request->title_en,
                'title_ch' => $request->title_ch,
                'slug' => $request->slug,
                'short_description_en' => $request->short_description_en,
                'short_description_ch' => $request->short_description_ch,
                'about_page_id' => $aboutId ?? $page->about_page_id,
                'leasing_page_id' => $request->leasing_page_id ?? $page->leasing_page_id,
                'build_more_page' => $request->build_more_page ?? $page->build_more_page,
                'legacy_page' => $request->legacy_page ?? $page->legacy_page,
            ];
            $this->db->where('id', $page_id)->update('anken_about_page', $pageData);
    
            response(200, 0, 'Page updated successfully.', []);
        } else {
            // Insert into anken_about_page_detail if needed
            if ($page_type == 'about_page_detail') {
                $aboutPageData = [
                    'page_description_en' => $request->page_description_en,
                    'page_description_ch' => $request->page_description_ch,
                    'top_image' => $request->top_image,
                    'bottom_image1' => $request->bottom_image1,
                    'bottom_image2' => $request->bottom_image2,
                    'bottom_image3' => $request->bottom_image3,
                    'bottom_images_type' => $request->bottom_images_type ?? '1',
                ];
                $this->db->insert('anken_about_page_detail', $aboutPageData);
                $aboutId = $this->db->insert_id();
            }
    
            // Insert into anken_about_page
            $pageData = [
                'title_en' => $request->title_en,
                'title_ch' => $request->title_ch,
                'slug' => $request->slug,
                'short_description_en' => $request->short_description_en,
                'short_description_ch' => $request->short_description_ch,
                'page_type' => $page_type,
                'about_page_id' => $aboutId,
                'leasing_page_id' => $request->leasing_page_id ?? NULL,
                'build_more_page' => $request->build_more_page ?? NULL,
                'legacy_page' => $request->legacy_page ?? NULL,
                // build_more_page
            ];
    
            $res = $this->db->insert('anken_about_page', $pageData);
            if ($res) {
                response(200, 0, 'Page added successfully.', []);
            } else {
                response(403, 1, 'Failed to insert page.', []);
            }
        }
    }
    public function get() {
        $this->db->select('
            p.*, 
            
            apd.page_description_en, 
            apd.page_description_ch, 
            apd.top_image as about_top_image,
            apd.bottom_image1, 
            apd.bottom_image2, 
            apd.bottom_image3,
            
            l.title_en as leasing_title_en,
            l.title_ch as leasing_title_ch,
            l.slug as leasing_slug,
    
            f.file as top_image_file,
            f.directory_id as top_image_dir,
            f.id as top_image_id,
    
            f1.file as bottom_image1_file,
            f1.directory_id as bottom_image1_dir,
            f1.id as bottom_image1_id,
    
            f2.file as bottom_image2_file,
            f2.directory_id as bottom_image2_dir,
            f2.id as bottom_image2_id,
    
            f3.file as bottom_image3_file,
            f3.directory_id as bottom_image3_dir,
            f3.id as bottom_image3_id
        ');
    
        $this->db->from('anken_about_page p');
        $this->db->join('anken_about_page_detail apd', 'p.about_page_id = apd.id', 'left');
        $this->db->join('anken_leasing_page l', 'p.leasing_page_id = l.id', 'left');
        $this->db->join('anken_file_library f', 'apd.top_image = f.id', 'left');
        $this->db->join('anken_file_library f1', 'apd.bottom_image1 = f1.id', 'left');
        $this->db->join('anken_file_library f2', 'apd.bottom_image2 = f2.id', 'left');
        $this->db->join('anken_file_library f3', 'apd.bottom_image3 = f3.id', 'left');
    
        $results = $this->db->get()->result();
    
        $final = [];
    
        foreach ($results as $row) {
            $rowArray = (array) $row;
    
            $buildImage = function ($id, $file, $dir) {
                if (!$id) return null;
                $path = ($dir == 0) ? "{$this->libraryPath}/{$file}" : "{$this->libraryPath}/{$dir}/{$file}";
                return ['id' => $id, 'file' => $file, 'directory_id' => $dir, 'path' => $path];
            };
    
            $rowArray['top_image']        = $buildImage($row->top_image_id, $row->top_image_file, $row->top_image_dir);
            $rowArray['bottom_image1']    = $buildImage($row->bottom_image1_id, $row->bottom_image1_file, $row->bottom_image1_dir);
            $rowArray['bottom_image2']    = $buildImage($row->bottom_image2_id, $row->bottom_image2_file, $row->bottom_image2_dir);
            $rowArray['bottom_image3']    = $buildImage($row->bottom_image3_id, $row->bottom_image3_file, $row->bottom_image3_dir);
    
            $rowArray['leasing_page'] = [
                'title_en' => $row->leasing_title_en,
                'title_ch' => $row->leasing_title_ch,
                'slug'     => $row->leasing_slug,
            ];
    
            unset(
                $rowArray['top_image_id'], $rowArray['top_image_file'], $rowArray['top_image_dir'],
                $rowArray['bottom_image1_id'], $rowArray['bottom_image1_file'], $rowArray['bottom_image1_dir'],
                $rowArray['bottom_image2_id'], $rowArray['bottom_image2_file'], $rowArray['bottom_image2_dir'],
                $rowArray['bottom_image3_id'], $rowArray['bottom_image3_file'], $rowArray['bottom_image3_dir'],
                $rowArray['leasing_title_en'], $rowArray['leasing_title_ch'], $rowArray['leasing_slug']
            );
    
            $final[] = $rowArray;
        }
    
        response(200, 0, 'Pages fetched successfully.', $final);
    }
   public function edit($id) {
        if (!$id) {
            response(400, 1, 'ID is required to fetch a page.', []);
        }
    
        $this->db->select('
            p.*, 
            
            apd.page_description_en, 
            apd.page_description_ch, 
            apd.top_image as about_top_image,
            apd.bottom_image1, 
            apd.bottom_image2, 
            apd.bottom_image3,
            apd.bottom_images_type,
    
            l.title_en as leasing_title_en,
            l.title_ch as leasing_title_ch,
            l.slug as leasing_slug,
    
            f.id as top_image_id,
            f.file as top_image_file,
            f.directory_id as top_image_dir,
    
            f1.id as bottom_image1_id,
            f1.file as bottom_image1_file,
            f1.directory_id as bottom_image1_dir,
    
            f2.id as bottom_image2_id,
            f2.file as bottom_image2_file,
            f2.directory_id as bottom_image2_dir,
    
            f3.id as bottom_image3_id,
            f3.file as bottom_image3_file,
            f3.directory_id as bottom_image3_dir
        ');
    
        $this->db->from('anken_about_page p');
        $this->db->join('anken_about_page_detail apd', 'p.about_page_id = apd.id', 'left');
        $this->db->join('anken_leasing_page l', 'p.leasing_page_id = l.id', 'left');
        $this->db->join('anken_file_library f', 'apd.top_image = f.id', 'left');
        $this->db->join('anken_file_library f1', 'apd.bottom_image1 = f1.id', 'left');
        $this->db->join('anken_file_library f2', 'apd.bottom_image2 = f2.id', 'left');
        $this->db->join('anken_file_library f3', 'apd.bottom_image3 = f3.id', 'left');
        $this->db->where('p.id', $id);
    
        $row = $this->db->get()->row();
    
        if (!$row) {
            response(404, 1, 'Page not found.', []);
        }
    
        $rowArray = (array) $row;
    
        $buildImage = function ($id, $file, $dir) {
            if (!$id) return null;
            $path = ($dir == 0) ? "{$this->libraryPath}/{$file}" : "{$this->libraryPath}/{$dir}/{$file}";
            return ['id' => $id, 'file' => $file, 'directory_id' => $dir, 'path' => $path];
        };
    
        $rowArray['top_image']        = $buildImage($row->top_image_id, $row->top_image_file, $row->top_image_dir);
        $rowArray['bottom_image1']    = $buildImage($row->bottom_image1_id, $row->bottom_image1_file, $row->bottom_image1_dir);
        $rowArray['bottom_image2']    = $buildImage($row->bottom_image2_id, $row->bottom_image2_file, $row->bottom_image2_dir);
        $rowArray['bottom_image3']    = $buildImage($row->bottom_image3_id, $row->bottom_image3_file, $row->bottom_image3_dir);
    
        $rowArray['leasing_page'] = [
            'title_en' => $row->leasing_title_en,
            'title_ch' => $row->leasing_title_ch,
            'slug'     => $row->leasing_slug,
        ];
    
        unset(
            $rowArray['top_image_id'], $rowArray['top_image_file'], $rowArray['top_image_dir'],
            $rowArray['bottom_image1_id'], $rowArray['bottom_image1_file'], $rowArray['bottom_image1_dir'],
            $rowArray['bottom_image2_id'], $rowArray['bottom_image2_file'], $rowArray['bottom_image2_dir'],
            $rowArray['bottom_image3_id'], $rowArray['bottom_image3_file'], $rowArray['bottom_image3_dir'],
            $rowArray['leasing_title_en'], $rowArray['leasing_title_ch'], $rowArray['leasing_slug']
        );
    
        response(200, 0, 'Page fetched successfully.', $rowArray);
    }
    public function delete($id) {
        if (!$id) {
            response(400, 1, 'ID is required to delete a page.', []);
        }
    
        $exists = $this->db->get_where('anken_about_page', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'About page not found.', []);
        }
    
        $deleted = $this->db->delete('anken_about_page', ['id' => $id]);
    
        if ($deleted) {
            response(200, 0, 'About page deleted successfully.', []);
        } else {
            response(500, 1, 'Failed to delete about page.', []);
        }
    }
}