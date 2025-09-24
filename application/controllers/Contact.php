<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        
        $lang = $this->session->userdata('lang');
        if($lang == 'ch'){
            $this->session->set_userdata('lang', 'ch');
            $this->langtype = '_ch';
        }else{
            $this->session->set_userdata('lang', 'en');
            $this->langtype = '_en';
        }
    }
    
    public function index(){
        $data = [];
        $data["page_title"] = "Contact";
        $this->load->view('contact/contact', $data);
    }
    
    function checkexists(){
        echo 0;
    }


}