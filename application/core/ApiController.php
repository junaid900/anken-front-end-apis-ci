<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ApiController extends CI_Controller {

    protected $json_data = [];
    protected $libraryPath = 'uploads/file_library';

    public function __construct() {
        parent::__construct();
        $this->load->database();

        // Allow only your frontend domain
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Authorization, token, X-Requested-With");
        // header("Access-Control-Allow-Credentials: true");

        // ✅ For preflight OPTIONS, still send headers
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }

        // Handle input parsing
        if (in_array($this->input->method(TRUE), ['POST', 'PUT', 'PATCH'])) {
            $raw = file_get_contents('php://input');
            if (!empty($raw)) {
                $data = json_decode(trim($raw), true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    response(400, 1, 'Invalid JSON: ' . json_last_error_msg(), []);
                    exit;
                }
                $this->json_data = $data;
            }
        }

        foreach ([$_GET, $_POST, $_REQUEST] as $arr) {
            foreach ($arr as $k => $v) {
                $this->json_data[$k] = $v;
            }
        }
    }

    protected function get_json_input($key = null, $default = null) {
        if ($key === null) {
            return $this->json_data;
        }
        return $this->json_data[$key] ?? $default;
    }
}
