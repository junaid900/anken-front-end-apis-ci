<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(APPPATH . 'core/ApiController.php');
class Auth extends ApiController {
     public function __construct() {
        parent::__construct();
        // $this->load->model('Admin_model');
    }
    public function login() {
        $username = $this->get_json_input('username');
        $password = $this->get_json_input('password');
        $admin = $this->Admin_model->get_by_username($username);
        if ($admin && password_verify($password, $admin->password)) {
            $token = bin2hex(random_bytes(32));
            // $expiry = date('Y-m-d H:i:s', strtotime('+24 hours'));
            $expiry = time() + (24 * 60 * 60);
            $this->Token_model->create_token($token, $expiry, $admin->id);
            $this->Admin_model->update_token($admin->id, $token);

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'code' => 0,
                    'token' => $token,
                    'expires' => $expiry
                ]));
        }

        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'code' => 1,
                'message' => 'Invalid username or password'
            ]));
    }
}