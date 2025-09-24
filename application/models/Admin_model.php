<?php
class Admin_model extends CI_Model {

    public function get_by_username($username) {
        return $this->db
            ->where('username', $username)
            ->where('deleted', 0)
            ->get('anken_admin')
            ->row();
    }

    public function update_token($admin_id, $token) {
        $this->db->where('id', $admin_id);
        $this->db->update('anken_admin', [
            'token' => $token,
            'last_login_time' => date('Y-m-d H:i:s')
        ]);
    }

    public function get_by_token($token) {
        return $this->db
            ->where('token', $token)
            ->where('deleted', 0)
            ->get('anken_admin')
            ->row();
    }
}