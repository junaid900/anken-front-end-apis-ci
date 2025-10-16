<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Welcome extends CI_Controller

{

   protected $libraryPath;

    public function __construct()

    {

        parent::__construct();

        $this->load->library('session');
        $this->load->database();
        
         $this->libraryPath = 'uploads/file_library';
        // ✅ First-time load check
        if (!$this->session->userdata('current_language')) {
            $ip = $this->input->ip_address();
            $country = get_country_by_ip($ip);

            if ($country == "china") {
                $this->session->set_userdata('current_language', 'Chinese');
                $this->session->set_userdata('language_country', 'Chinese');
                $this->session->set_userdata('controller_name', 'ch');
                $this->session->set_userdata('lang', 'ch');
                $this->langtype = '_ch';
            } else {
                $this->session->set_userdata('current_language', 'english');
                $this->session->set_userdata('language_country', 'english');
                $this->session->set_userdata('controller_name', 'en');
                $this->session->set_userdata('lang', 'en');
                $this->langtype = '_en';
            }
        } else {
            // If session already exists, just set langtype
            $lang = $this->session->userdata('lang');
            $this->langtype = ($lang == 'ch') ? '_ch' : '_en';
        }

    }

    

    public function index(){

         $this->db->select('
            p.*,
    
            f1.id as leasing_image_id, f1.file as leasing_image_file, f1.directory_id as leasing_image_dir,
            f2.id as places_image_id, f2.file as places_image_file, f2.directory_id as places_image_dir,
            f3.id as bottom_image1_id, f3.file as bottom_image1_file, f3.directory_id as bottom_image1_dir,
            f4.id as bottom_cover1_id, f4.file as bottom_cover1_file, f4.directory_id as bottom_cover1_dir,
            f5.id as bottom_cover2_id, f5.file as bottom_cover2_file, f5.directory_id as bottom_cover2_dir,
            f6.id as bottom_cover3_id, f6.file as bottom_cover3_file, f6.directory_id as bottom_cover3_dir,
            f7.id as bottom_cover4_id, f7.file as bottom_cover4_file, f7.directory_id as bottom_cover4_dir
        ');
    
        $this->db->from('anken_home_page p');
        $this->db->join('anken_file_library f1', 'p.leasing_image = f1.id', 'left');
        $this->db->join('anken_file_library f2', 'p.places_image = f2.id', 'left');
        $this->db->join('anken_file_library f3', 'p.bottom_image1 = f3.id', 'left');
        $this->db->join('anken_file_library f4', 'p.bottom_cover1 = f4.id', 'left');
        $this->db->join('anken_file_library f5', 'p.bottom_cover2 = f5.id', 'left');
        $this->db->join('anken_file_library f6', 'p.bottom_cover3 = f6.id', 'left');
        $this->db->join('anken_file_library f7', 'p.bottom_cover4 = f7.id', 'left');
        $this->db->where('p.id', 1);
    
        $row = $this->db->get()->row();
    
        if (!$row) {
           show_404();
        }
    
        $rowArray = (array) $row;
    
        $buildImage = function ($id, $file, $dir) {
            if (!$id) return null;
            $path = ($dir == 0) ? "{$this->libraryPath}/{$file}" : "{$this->libraryPath}/{$dir}/{$file}";
            return ['id' => $id, 'file' => $file, 'directory_id' => $dir, 'path' => $path];
        };
    
        $rowArray['leasing_image']      = $buildImage($row->leasing_image_id, $row->leasing_image_file, $row->leasing_image_dir);
        $rowArray['places_image']       = $buildImage($row->places_image_id, $row->places_image_file, $row->places_image_dir);
        $rowArray['bottom_image1']      = $buildImage($row->bottom_image1_id, $row->bottom_image1_file, $row->bottom_image1_dir);
        $rowArray['bottom_cover1']      = $buildImage($row->bottom_cover1_id, $row->bottom_cover1_file, $row->bottom_cover1_dir);
        $rowArray['bottom_cover2']      = $buildImage($row->bottom_cover2_id, $row->bottom_cover2_file, $row->bottom_cover2_dir);
        $rowArray['bottom_cover3']      = $buildImage($row->bottom_cover3_id, $row->bottom_cover3_file, $row->bottom_cover3_dir);
        $rowArray['bottom_cover4']      = $buildImage($row->bottom_cover4_id, $row->bottom_cover4_file, $row->bottom_cover4_dir);
    
        // Unset raw image fields
        unset(
            $rowArray['leasing_image_id'], $rowArray['leasing_image_file'], $rowArray['leasing_image_dir'],
            $rowArray['places_image_id'], $rowArray['places_image_file'], $rowArray['places_image_dir'],
            $rowArray['bottom_image1_id'], $rowArray['bottom_image1_file'], $rowArray['bottom_image1_dir'],
            $rowArray['bottom_cover1_id'], $rowArray['bottom_cover1_file'], $rowArray['bottom_cover1_dir'],
            $rowArray['bottom_cover2_id'], $rowArray['bottom_cover2_file'], $rowArray['bottom_cover2_dir'],
            $rowArray['bottom_cover3_id'], $rowArray['bottom_cover3_file'], $rowArray['bottom_cover3_dir'],
            $rowArray['bottom_cover4_id'], $rowArray['bottom_cover4_file'], $rowArray['bottom_cover4_dir']
        );
        
        
        $this->db->select("aif.*, 
            f1.id as icon_id, f1.file as icon_file, f1.directory_id as icon_dir,
        ");
        $this->db->from('anken_icon_feature aif')
            ->join('anken_file_library f1', 'aif.icon = f1.id', 'left')
            ->where(['aif.ref_id' => 1, 'aif.type' => 'home_page'])
            ->order_by('position', 'asc');
        
        $icon_features = $this->db->get()->result();
            
        $final_icon_features = [];
        foreach($icon_features as $f_icon){
            $f_icon->greenIcon = $buildImage($f_icon->icon_id, $f_icon->icon_file, $f_icon->icon_dir);
            $final_icon_features[] = $f_icon;
        }
        $rowArray['icon_features'] = $final_icon_features;

        $data['all_data'] = $rowArray;
        
        $this->db->order_by('home_position', 'asc');
        $data['locations'] = $this->db->get_where('anken_location_page',['is_home' => 1])->result_array();
        $this->db->limit(4);
        $data['news'] = $this->db->get('anken_events')->result_array();

        $this->load->view('home' , $data);

    }

    

    function checkexists(){

        echo 0;

    }





}