<?php
require_once(APPPATH . 'core/ApiController.php');

class SecureApiController extends ApiController {

    public $current_user;

    public function __construct() {
        parent::__construct();
        $this->load->model('Token_model');
        $this->load->model('Admin_model');

        $headers = $this->input->request_headers();
        // var_dump($headers);
        $token = isset($headers['Token']) ? trim($headers['Token']) : null;

        if (!$token) {
            $this->unauthorized("Token not provided.");
        }

        $tokenData = $this->Token_model->validate_token($token);

        if (!$tokenData) {
            $this->unauthorized("Invalid or expired token.");
        }

        $user = $this->Admin_model->get_by_token($token);

        if (!$user) {
            $this->unauthorized("User not found for token.");
        }

        $this->current_user = $user;
    }

    private function unauthorized($message) {
        response(401, 1, $message);
        exit;
    }
}