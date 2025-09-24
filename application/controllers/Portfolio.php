<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Portfolio extends CI_Controller

{
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

    
        
    public function index($slug){
        // show_404();
        // -------------------------------------------------------------- 
       

    }

    

    function checkexists(){

        echo 0;

    }



    




}