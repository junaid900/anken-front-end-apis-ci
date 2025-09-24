<?php
class Nav_model extends CI_Model {

     public function __construct()
    {
        parent::__construct(); 
    }

    public function get_maga_menu_title() {
        return $this->db->get('anken_location_page')->result();
    }

}