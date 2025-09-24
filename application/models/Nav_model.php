<?php
class Nav_model extends CI_Model {

     public function __construct()
    {
        parent::__construct(); 
    }

    public function portfolio_model() {
        $this->db->order_by('position',"ASC");
        return $this->db->get('anken_location_page')->result_array();
    }

    public function about_model() {
        $this->db->order_by('position',"ASC");
        return $this->db->get('anken_about_page')->result_array();
    }

}