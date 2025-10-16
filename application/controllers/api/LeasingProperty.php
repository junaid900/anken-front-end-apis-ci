<?php
require_once(APPPATH.'core/SecureApiController.php');

class LeasingProperty extends SecureApiController {
    
    public function add() {
         $user = $this->current_user;
        // Get token from Authorization header
        $request = new SafeRequest($this->get_json_input());
        $data = [];
        
        if(!$request->en_property_title){
            response(403, 1, 'Title cannot be empty', []);
        }
        if(!$request->en_property_short_desc){
            response(403, 1, 'Short Description cannot be empty', []);
        }
        if(!$request->en_property_description){
            response(403, 1, 'Description cannot be empty', []);
        }
        
        
        if(!$request->ch_property_title){
            response(403, 1, 'Chinese Title cannot be empty', []);
        }
        if(!$request->ch_property_short_desc){
            response(403, 1, 'Chinese Short Description cannot be empty', []);
        }
        if(!$request->ch_property_description){
            response(403, 1, 'Chinese Description cannot be empty', []);
        }
        
        if(!$request->propertyImage){
            response(403, 1, 'Property image cannot be empty', []);
        }
        
        if(!$request->leasing_page_id){
            response(403, 1, 'Cannot find connected page.', []);
        }
        
        $data = [
            'title_en' => $request->en_property_title,
            'title_ch' => $request->ch_property_title,
            'short_description_en' => $request->en_property_short_desc,
            'short_description_ch' => $request->ch_property_short_desc,
            'description_en' => $request->en_property_description,
            'description_ch' => $request->ch_property_description,
            'image' => $request->propertyImage,
            'leasing_page_id' => $request->leasing_page_id,
            ];
        if($request->id && $request->id != 0){
            $this->db->where('id', $request->id);
            $this->db->update('anken_leasing_properties', $data);
            response(200, 0, 'Property updated successfully.', []);
            return;
        }else{
            $res = $this->db->insert('anken_leasing_properties', $data);
        }
        
        if($res){
            response(200, 0, 'successful added.', []);        
        }else{
            response(403, 1, 'Cannot insert data.', []);        
        }
    }
    public function get($pageId) {
        if (!$pageId) {
            response(400, 1, 'ID is required to delete a property.', []);
        }
        $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
        $this->db->from('anken_leasing_properties p');
        $this->db->join('anken_file_library f', 'p.image = f.id', 'left');
        $this->db->where('p.leasing_page_id', $pageId);
        $this->db->order_by('p.position', 'ASC');
        $results = $this->db->get()->result();
        $final = [];
        
        foreach ($results as $row) {
            $rowArray = (array) $row;
        
            // Build the full file object if exists
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
        
            // Replace `image` field with full file object
            $rowArray['image'] = $file;
        
            // Optionally remove the joined columns (they're now in 'image')
            unset($rowArray['file_id'], $rowArray['file_name'], $rowArray['dir_id']);
        
            $final[] = $rowArray;
        }
    
        if ($final) {
            response(200, 0, 'Properties fetched successfully.', $final);
        } else {
            response(200, 0, 'No properties found.', []);
        }
    }
    public function delete($id) {
    
        if (!$id) {
            response(400, 1, 'ID is required to delete a property.', []);
        }
    
        $exists = $this->db->get_where('anken_leasing_properties', ['id' => $id])->row();
        if (!$exists) {
            response(404, 1, 'Property not found.', []);
        }
    
        $deleted = $this->db->delete('anken_leasing_properties', ['id' => $id]);
    
        if ($deleted) {
            response(200, 0, 'Property deleted successfully.', []);
        } else {
            response(500, 1, 'Failed to delete property.', []);
        }
    }
}