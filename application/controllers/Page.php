<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Page extends CI_Controller
 {

    protected $libraryPath;

    public function __construct()
 {
        parent::__construct();
        $this->load->library( 'session' );
        // $this->load->helper('url');
        $this->libraryPath = 'uploads/file_library';

        $this->load->database();
        $lang = $this->session->userdata( 'lang' );
        if ( $lang == 'ch' ) {
            $this->session->set_userdata( 'lang', 'ch' );
            $this->langtype = '_ch';
        } else {
            $this->session->set_userdata( 'lang', 'en' );
            $this->langtype = '_en';
        }
    }
    
    public function get_pages_slugs(){
        return [];
    }

    public function build_more() {
        $data = [];
        $data[ 'page_title' ] = 'Build More With Less';
        $this->load->view( 'about/build_more_with_less', $data );
    }

    public function index( $slug ) {
        // echo "slug";
        $this->db->where( 'slug', $slug ); 
        $main_about = $this->db->get( 'anken_about_page' )->row();
        //  echo '<pre>';
        //  print_r( $main_about );
        //  exit;
        if ( $main_about->page_type == 'about_page_detail' ) {
            $this->db->select( '
            apd.page_description_en, 
            apd.page_description_ch, 
            apd.top_image as about_top_image,
            apd.bottom_image1, 
            apd.bottom_image2, 
            apd.bottom_image3,
    
    
            f.id as top_image_id,
            f.file as top_image_file,
            f.directory_id as top_image_dir,
    
            f1.id as bottom_image1_id,
            f1.file as bottom_image1_file,
            f1.directory_id as bottom_image1_dir,
    
            f2.id as bottom_image2_id,
            f2.file as bottom_image2_file,
            f2.directory_id as bottom_image2_dir,
    
            f3.id as bottom_image3_id,
            f3.file as bottom_image3_file,
            f3.directory_id as bottom_image3_dir
        ' );

            $this->db->from( 'anken_about_page_detail apd' );
            // $this->db->join( 'anken_about_page_detail apd', 'p.about_page_id = apd.id', 'left' );
            $this->db->join( 'anken_file_library f', 'apd.top_image = f.id', 'left' );
            $this->db->join( 'anken_file_library f1', 'apd.bottom_image1 = f1.id', 'left' );
            $this->db->join( 'anken_file_library f2', 'apd.bottom_image2 = f2.id', 'left' );
            $this->db->join( 'anken_file_library f3', 'apd.bottom_image3 = f3.id', 'left' );
            // $this->db->where( 'p.slug', $slug );

            $row = $this->db->get()->row();

            if ( !$row ) {
                show_404();
            }

            $rowArray = ( array ) $row;

            $buildImage = function ( $id, $file, $dir ) {
                if ( !$id ) return null;
                $path = ( $dir == 0 ) ? "{$this->libraryPath}/{$file}" : "{$this->libraryPath}/{$dir}/{$file}";
                return [ 'id' => $id, 'file' => $file, 'directory_id' => $dir, 'path' => $path ];
            };

            $rowArray[ 'top_image' ]        = $buildImage( $row->top_image_id, $row->top_image_file, $row->top_image_dir );
            $rowArray[ 'bottom_image1' ]    = $buildImage( $row->bottom_image1_id, $row->bottom_image1_file, $row->bottom_image1_dir );
            $rowArray[ 'bottom_image2' ]    = $buildImage( $row->bottom_image2_id, $row->bottom_image2_file, $row->bottom_image2_dir );
            $rowArray[ 'bottom_image3' ]    = $buildImage( $row->bottom_image3_id, $row->bottom_image3_file, $row->bottom_image3_dir );

            // $rowArray[ 'leasing_page' ] = [
            //     'title_en' => $row->leasing_title_en,
            //     'title_ch' => $row->leasing_title_ch,
            //     'slug'     => $row->leasing_slug,
            // ];

            unset(
                $rowArray[ 'top_image_id' ], $rowArray[ 'top_image_file' ], $rowArray[ 'top_image_dir' ],
                $rowArray[ 'bottom_image1_id' ], $rowArray[ 'bottom_image1_file' ], $rowArray[ 'bottom_image1_dir' ],
                $rowArray[ 'bottom_image2_id' ], $rowArray[ 'bottom_image2_file' ], $rowArray[ 'bottom_image2_dir' ],
                $rowArray[ 'bottom_image3_id' ], $rowArray[ 'bottom_image3_file' ], $rowArray[ 'bottom_image3_dir' ],
                $rowArray[ 'leasing_title_en' ], $rowArray[ 'leasing_title_ch' ], $rowArray[ 'leasing_slug' ]
            );

            $rowArray[ 'page_title' ] = $slug;

            $page_data[ 'page' ] = $rowArray;

            // echo '<pre>';
            // print_r( $page_data );

            $this->load->view( 'about/index_page_1', $page_data );
            exit;

        } else if ( $main_about->page_type == 'property_page' ) {

            $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
            $this->db->from('anken_leasing_page p');
            $this->db->join('anken_file_library f', 'p.top_image = f.id', 'left');
            $this->db->where('p.id', $main_about->leasing_page_id);
            $row = $this->db->get()->row();

            if ( !$row ) {
                response( 404, 1, 'Leasing page not found.', [] );
            }

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
        
            $rowArray['top_image'] = $file;
            
            $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
            $this->db->from('anken_leasing_properties p');
            $this->db->join('anken_file_library f', 'p.image = f.id', 'left');
            $this->db->where('p.leasing_page_id', $row->id);
            $results = $this->db->get()->result();
            $rowArray[ 'properties' ] = $results;
            
            $rowArray[ 'page_title' ] = $slug;

            $page_data[ 'page' ] = $rowArray;
            $this->load->view( 'about/places_made_of_people', $page_data );
            exit;

        }

    }

    // public function places_made_of_people() {
    //     $data = [];
    //     $data[ 'page_title' ] = 'Places Made Of People';
    //     $this->load->view( 'about/places_made_of_people', $data );
    // }

    function checkexists() {
        echo 0;
    }

}