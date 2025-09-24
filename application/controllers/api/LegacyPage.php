<?php
require_once(APPPATH.'core/SecureApiController.php');

class LegacyPage extends SecureApiController {
    
    public function add() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());

        if (!$request->title_en) {
            response(403, 1, 'English title cannot be empty.', []);
        }
        if (!$request->title_ch) {
            response(403, 1, 'Chinese title cannot be empty.', []);
        }
        if (!$request->page_short_description_en) {
            response(403, 1, 'Short Description EN cannot be empty.', []);
        }
        if (!$request->page_short_description_ch) {
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
            'title_en' => $request->title_en,
            'title_ch' => $request->title_ch,
            'slug' => $request->slug,
            'page_short_description_en' => $request->page_short_description_en,
            'page_short_description_ch' => $request->page_short_description_ch,
            'page_description_en' => $request->page_description_en,
            'page_description_ch' => $request->page_description_ch,
            'top_image' => $request->top_image,
            'status' => 1,
        ];
        
        if($request->id && $request->id != 0){
            $this->db->where('id', $request->id);
            $this->db->update('anken_legacy_page', $data);
            response(200, 0, 'Page updated successfully.', []);
            return;
        }else{
            $res = $this->db->insert('anken_legacy_page', $data);    
        }
        
        if ($res) {
            response(200, 0, 'Page added successfully.', []);
        } else {
            response(403, 1, 'Failed to insert data.', []);
        }
    }

    public function get() {
        $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
        $this->db->from('anken_legacy_page p');
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
            response(200, 0, 'Legacy pages fetched successfully.', $final);
        } else {
            response(200, 0, 'No legacy pages found.', []);
        }
    }

    public function edit($id) {
        if (!$id) {
            response(400, 1, 'ID is required to fetch a legacy page.', []);
        }

        $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
        $this->db->from('anken_legacy_page p');
        $this->db->join('anken_file_library f', 'p.top_image = f.id', 'left');
        $this->db->where('p.id', $id);
        $row = $this->db->get()->row();

        if (!$row) {
            response(404, 1, 'Legacy page not found.', []);
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

        response(200, 0, 'Legacy page fetched successfully.', $rowArray);
    }

    public function delete($id) {
        if (!$id) {
            response(400, 1, 'ID is required to delete a page.', []);
        }

        $exists = $this->db->get_where('anken_legacy_page', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'Legacy page not found.', []);
        }

        $deleted = $this->db->delete('anken_legacy_page', ['id' => $id]);

        if ($deleted) {
            response(200, 0, 'Legacy page deleted successfully.', []);
        } else {
            response(500, 1, 'Failed to delete legacy page.', []);
        }
    }
    
    
    //  Legacy Page Item Content
    public function pageItemAdd() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());
        
        // Validate required fields
        if (!$request->title_en) {
            response(403, 1, 'English title cannot be empty', []);
        }
        if (!$request->title_ch) {
            response(403, 1, 'Chinese title cannot be empty', []);
        }
        if (!$request->description_en) {
            response(403, 1, 'English description cannot be empty', []);
        }
        if (!$request->description_ch) {
            response(403, 1, 'Chinese description cannot be empty', []);
        }
        if (!$request->legacy_page_id) {
            response(403, 1, 'Cannot find connected legacy page', []);
        }
        if (empty($request->images) || !is_array($request->images)) {
            response(403, 1, 'At least one image is required', []);
        }

        // Start transaction for multiple database operations
        $this->db->trans_start();

        // Main item data
        $itemData = [
            'title_en' => $request->title_en,
            'title_ch' => $request->title_ch,
            'description_en' => $request->description_en,
            'description_ch' => $request->description_ch,
            'legacy_page_id' => $request->legacy_page_id
        ];

        if ($request->id && $request->id != 0) {
            // Update existing item
            $this->db->where('id', $request->id);
            $this->db->update('anken_legacy_page_item', $itemData);
            $itemId = $request->id;
            
            // Delete existing images if we're updating
            $this->db->delete('anken_legacy_page_slider', ['legacy_page_item_id' => $itemId]);
        } else {
            // Insert new item
            $this->db->insert('anken_legacy_page_item', $itemData);
            $itemId = $this->db->insert_id();
        }

        // Insert new images
        foreach ($request->images as $k => $image) {
            $imageData = [
                'image' => $image['id'],
                'type' => $image['slider_type'] ?? null,
                'url' => $image['url'] ?? null,
                'legacy_page_item_id' => $itemId,
                'position' => $k,
            ];
            $this->db->insert('anken_legacy_page_slider', $imageData);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            response(500, 1, 'Failed to save legacy page item', []);
        } else {
            response(200, 0, 'Legacy page item saved successfully', ['id' => $itemId]);
        }
    }

    public function pageItemGet($pageId) {
        if (!$pageId) {
            response(400, 1, 'Legacy page ID is required', []);
        }

        // Get all items for the page
        $this->db->select('i.*');
        $this->db->from('anken_legacy_page_item i');
        $this->db->where('i.legacy_page_id', $pageId);
        $items = $this->db->get()->result();

        $final = [];
        foreach ($items as $item) {
            $itemArray = (array) $item;
            
            // Get all images for this item
            $this->db->select('s.*, s.type as slider_type, f.id as file_id, f.file, f.directory_id, f.type as file_type');
            $this->db->from('anken_legacy_page_slider s');
            $this->db->join('anken_file_library f', 's.image = f.id', 'left');
            $this->db->where('s.legacy_page_item_id', $item->id);
            $images = $this->db->get()->result();
            
            $itemImages = [];
            foreach ($images as $image) {
                $filePath = ($image->directory_id == 0)
                    ? "{$this->libraryPath}/{$image->file}"
                    : "{$this->libraryPath}/{$image->directory_id}/{$image->file}";
                
                $itemImages[] = [
                    'type' => $image->file_type,
                    'slider_type' => $image->slider_type,
                    'url' => $image->url,
                    'slider_item_id' => $image->id,
                    'id' => $image->file_id,
                    'file' => $image->file,
                    'directory_id' => $image->directory_id,
                    'path' => $filePath
                ];
            }
            
            $itemArray['images'] = $itemImages;
            $final[] = $itemArray;
        }
        // print_r($final);

        if ($final) {
            response(200, 0, 'Legacy page items fetched successfully', $final);
        } else {
            response(200, 0, 'No legacy page items found', []);
        }
    }

    public function pageItemEdit($id) {
        if (!$id) {
            response(400, 1, 'Item ID is required', []);
        }

        // Get the item
        $this->db->select('i.*');
        $this->db->from('anken_legacy_page_item i');
        $this->db->where('i.id', $id);
        $item = $this->db->get()->row();

        if (!$item) {
            response(404, 1, 'Legacy page item not found', []);
        }

        $itemArray = (array) $item;
        
        // Get all images for this item
        $this->db->select('s.*, f.id as file_id, f.file, f.directory_id');
        $this->db->from('anken_legacy_page_slider s');
        $this->db->join('anken_file_library f', 's.image = f.id', 'left');
        $this->db->where('s.legacy_page_item_id', $id);
        $this->db->order_by('s.position', 'ASC');
        $images = $this->db->get()->result();
        
        $itemImages = [];
        foreach ($images as $image) {
            $filePath = ($image->directory_id == 0)
                ? "{$this->libraryPath}/{$image->file}"
                : "{$this->libraryPath}/{$image->directory_id}/{$image->file}";
            
            $itemImages[] = [
                // 'id' => $image->id,
                'type' => $image->type,
                'url' => $image->url,
                'id' => $image->file_id,
                'file' => $image->file,
                'directory_id' => $image->directory_id,
                'path' => $filePath
            ];
        }
        
        $itemArray['images'] = $itemImages;
        response(200, 0, 'Legacy page item fetched successfully', $itemArray);
    }

    public function pageItemDelete($id) {
        if (!$id) {
            response(400, 1, 'Item ID is required', []);
        }

        // Check if item exists
        $exists = $this->db->get_where('anken_legacy_page_item', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'Legacy page item not found', []);
        }

        // Start transaction
        $this->db->trans_start();
        
        // Delete all images first
        $this->db->delete('anken_legacy_page_slider', ['legacy_page_item_id' => $id]);
        
        // Then delete the item
        $this->db->delete('anken_legacy_page_item', ['id' => $id]);
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            response(500, 1, 'Failed to delete legacy page item', []);
        } else {
            response(200, 0, 'Legacy page item deleted successfully', []);
        }
    }
    
}