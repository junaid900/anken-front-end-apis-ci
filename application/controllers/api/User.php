<?php
require_once(APPPATH.'core/SecureApiController.php');

class User extends SecureApiController {

    public function profile() {
        $user = $this->current_user;
        response(200, 0, 'Success' ,  [
                    'id' => $user->id,
                    'username' => $user->username,
                    'avatar' => $user->avatar,
                    'name' => $user->name
                ]);
    }
    public function logout() {
        // Get token from Authorization header
        $headers = $this->input->request_headers();
        $token = isset($headers['Token']) ? trim($headers['Token']) : null;
    
        if (!$token) {
            response(400, 1, 'Authorization token missing.');
        }
    
        // Delete the token from DB (or set expired flag)
        $this->db->where('token', $token);
        $deleted = $this->db->delete('anken_access_token');
    
        // if ($deleted) {
        response(200, 1, 'Logout successful.', []);
        // } else {
        //     response(401, 0, 'Invalid token or already logged out.', []);
        // }
    }
}