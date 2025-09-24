<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        
         $this->libraryPath = 'uploads/file_library';
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
        $id = 1;
        $this->db->select('p.*, 
            f1.id as file_id1, f1.file as file1, f1.directory_id as dir1,
            f2.id as file_id2, f2.file as file2, f2.directory_id as dir2');
        $this->db->from('anken_event_page p');
        $this->db->join('anken_file_library f1', 'p.top_image1 = f1.id', 'left');
        $this->db->join('anken_file_library f2', 'p.top_image2 = f2.id', 'left');
        $this->db->where('p.id', $id);
        $row = $this->db->get()->row();

        if (!$row) {
            show_404();
        }

        $rowArray = (array) $row;

        $topImage1 = null;
        if (!empty($row->file_id1)) {
            $filePath1 = ($row->dir1 == 0)
                ? "{$this->libraryPath}/{$row->file1}"
                : "{$this->libraryPath}/{$row->dir1}/{$row->file1}";
            $topImage1 = [
                'id' => $row->file_id1,
                'file' => $row->file1,
                'directory_id' => $row->dir1,
                'path' => $filePath1
            ];
        }

        $topImage2 = null;
        if (!empty($row->file_id2)) {
            $filePath2 = ($row->dir2 == 0)
                ? "{$this->libraryPath}/{$row->file2}"
                : "{$this->libraryPath}/{$row->dir2}/{$row->file2}";
            $topImage2 = [
                'id' => $row->file_id2,
                'file' => $row->file2,
                'directory_id' => $row->dir2,
                'path' => $filePath2
            ];
        }

        $rowArray['top_image1'] = $topImage1;
        $rowArray['top_image2'] = $topImage2;
        
        $data["page"] = $rowArray;
        
        $this->db->from('anken_events');
        $this->db->order_by('position', 'ASC');
        $data["events"] = $this->db->get()->result_array();
        
        $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
        $this->db->from('anken_event_places p');
        $this->db->join('anken_file_library f', 'p.image = f.id', 'left');
        $this->db->where('p.event_page_id', $row->id);
        $this->db->order_by('p.position', 'ASC');
        $results = $this->db->get()->result();

        $final = [];

        foreach ($results as $row) {
            $rowArray = (array) $row;

            $file = null;
            if (!empty($row->file_id)) {
                $filePath = ($row->directory_id == 0)
                    ? "{$this->libraryPath}/{$row->file}"
                    : "{$this->libraryPath}/{$row->directory_id}/{$row->file}";

                $file = [
                    'id' => $row->file_id,
                    'file' => $row->file,
                    'directory_id' => $row->directory_id,
                    'path' => $filePath
                ];
            }

            $rowArray['image'] = $file;
            unset($rowArray['file_id'], $rowArray['file'], $rowArray['directory_id']);

            $final[] = $rowArray;
        }
        $data["event_places"]=$final;
        $data["page_title"] = "Event";
        // var_dump($data);
        // exit;
        $this->load->view('events/event', $data);
    }
    
    function checkexists(){
        echo 0;
    }


}