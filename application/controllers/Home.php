<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller { 
    
    
     protected $libraryPath;


    public function __construct()

    {

        parent::__construct();
        $this->libraryPath = 'uploads/file_library'; 
        $this->load->library('session');
        $this->load->database();

        

        $lang = $this->session->userdata('lang');

        if($lang == 'ch'){

            $this->session->set_userdata('lang', 'ch');

            $this->langtype = '_ch';

        }else{

            $this->session->set_userdata('lang', 'en');

            $this->langtype = '_en';

        }

    }



    public function change_language()

    {

        $lang = $this->input->post('lang');



        if ($lang == 'english') {

            $this->session->set_userdata('current_language', 'english');

            $this->session->set_userdata('language_country', 'english');

            $this->session->set_userdata('controller_name', 'en');

            // echo "english";

        } else {

            $this->session->set_userdata('current_language', 'Chinese');

            $this->session->set_userdata('language_country', 'Chinese');

            $this->session->set_userdata('controller_name', 'ch');
            // echo "chinese";

        }

    //   $this->load->view(strtolower($this->session->userdata('directory')) . '/index');

        exit;

    }





}