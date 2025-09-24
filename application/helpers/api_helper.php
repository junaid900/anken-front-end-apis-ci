<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function response($status, $code, $message = '', $response = []){
     $CI =& get_instance();
    $CI->output
            ->set_status_header($status)
            ->set_content_type('application/json')
            ->set_output(json_encode(['code' => $code, 'message' => $message, "response" => $response]))
            ->_display();    
    exit;
}