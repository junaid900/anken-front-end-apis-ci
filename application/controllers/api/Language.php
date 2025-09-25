<?php
require_once(APPPATH.'core/SecureApiController.php');

class Language extends SecureApiController {
    
    public function update() {
        $user = $this->current_user;
        $request = new SafeRequest($this->get_json_input());
        
        $data = [];
        
        if($request->en){
            $data['english'] = $request->en;
        }
        if($request->ch){
            $data['Chinese'] = $request->ch;
        }
        if(empty($data)){
            response(403, 1, 'Nothing to update.', []);
        }
        $this->db->where('phrase_id', $request->id);
        $res = $this->db->update('language', $data);
        if ($res) {
            response(200, 0, 'Page updated successfully.', []);
        } else {
            response(403, 1, 'Failed to insert data.', []);
        }
    }
    public function get() {
        $this->db->select('*');
        $this->db->from('language l');
        $results = $this->db->get()->result();
        if ($results) {
            response(200, 0, 'Leasing pages fetched successfully.', $results);
        } else {
            response(200, 0, 'No leasing pages found.', []);
        }
    }

}