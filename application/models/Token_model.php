<?php

class Token_model extends CI_Model {

    public function create_token($token, $expiry, $admin_id) {
        $this->db->insert('anken_access_token', [
            'token' => $token,
            'expiry' => $expiry,
            'create_time' => date('Y-m-d H:i:s')
        ]);
    }

    public function validate_token($token) {
        $expiry = time();
        return $this->db->where('token', $token)
            ->where('expiry >=', $expiry)
            ->get('anken_access_token')
            ->row();
    }
}