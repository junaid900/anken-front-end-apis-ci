<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slug_router extends CI_Controller { 
    
    
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


    public function index($slug = null)
    {
        // $this->load->database();
           
            // echo 'About Page: ' . $slug;
            // exit;

        // if (!$slug) {
        //     show_404();
        // }
         $slug = $this->uri->uri_string();

        // 🔹 Check About pages
        $exists = $this->db->where('slug', $slug)->count_all_results('anken_about_page');
        if ($exists > 0) {
            // Call About controller and keep clean URL
          

            // ===============================================================================================================

              $this->db->where( 'slug', $slug );
              $main_about = $this->db->get( 'anken_about_page' )->row();

              $this->about_data($main_about , $slug); 
       
               
        }

        // 🔹 Check Portfolio pages
        $exists = $this->db->where('slug', $slug)->count_all_results('anken_location_page');
        if ($exists > 0) {
            // Call Portfolio controller and keep clean URL
           $this->property_page($slug);
        }
// ===========================================================================================================================================




        // 🔹 Check Portfolio pages
        $exists = $this->db->where('slug', $slug)->count_all_results('anken_leasing_page');
        if ($exists > 0) {
            $this->place_made_of_people($slug);
        }


        
        $exists = $this->db->where('slug', $slug)->count_all_results('anken_legacy_page');
        if ($exists > 0) {
            $this->legacy_page($slug);
        }

     



// ============================================================================================================================================
        // 🔹 Nothing matched → show 404
        show_404();
    }




// ***********************************************************************************************************

public function about_data($main_about , $slug){
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
            $this->db->where('apd.id', $main_about->about_page_id);
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
                $rowArray[ 'bottom_image3_id' ], $rowArray[ 'bottom_image3_file' ], $rowArray[ 'bottom_image3_dir' ]
                // $rowArray[ 'leasing_title_en' ], $rowArray[ 'leasing_title_ch' ], $rowArray[ 'leasing_slug' ]
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
                show_404();
                // response( 404, 1, 'Leasing page not found.', [] );
            }
            

            $pageData = (array) $row;
    
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
        
            $pageData['top_image'] = $file;
            
            // $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
            // $this->db->from('anken_leasing_properties p');
            // $this->db->join('anken_file_library f', 'p.image = f.id', 'left');
            // $this->db->where('p.leasing_page_id', $row->id);
            // $results = $this->db->get()->result();
            $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
            $this->db->from('anken_leasing_properties p');
            $this->db->join('anken_file_library f', 'p.image = f.id', 'left');
            $this->db->where('p.leasing_page_id', $row->id);
            $results = $this->db->get()->result();
            $final = [];
            
            foreach ($results as $row) {
                $rowArray = (array) $row;
            
                // Build the full file object if exists
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
            
                // Replace `image` field with full file object
                $rowArray['image'] = $file;
            
                // Optionally remove the joined columns (they're now in 'image')
                unset($rowArray['file_id'], $rowArray['file_name'], $rowArray['dir_id']);
            
                $final[] = $rowArray;
            }
            
            $pageData[ 'properties' ] = $final;
            
            $pageData[ 'page_title' ] = $slug;

            $page_data[ 'page' ] = $pageData;

            // echo '<pre>';
            // print_r( $page_data );

            $this->load->view( 'about/places_made_of_people', $page_data );
            exit;

        } else if ( $main_about->page_type == 'build_more_page' ) {
            // echo $main_about->page_type;
            // exit;

           $this->db->select('
                p.*,
                
                f1.id as top_image_id, f1.file as top_image_file, f1.directory_id as top_image_dir,
                f2.id as middle_image1_id, f2.file as middle_image1_file, f2.directory_id as middle_image1_dir,
                f3.id as middle_image2_id, f3.file as middle_image2_file, f3.directory_id as middle_image2_dir,
                f4.id as middle_image3_id, f4.file as middle_image3_file, f4.directory_id as middle_image3_dir,
                f5.id as bottom_image1_id, f5.file as bottom_image1_file, f5.directory_id as bottom_image1_dir,
                f6.id as bottom_image2_id, f6.file as bottom_image2_file, f6.directory_id as bottom_image2_dir,
                f7.id as bottom_image3_id, f7.file as bottom_image3_file, f7.directory_id as bottom_image3_dir
            ');
        
            $this->db->from('anken_build_more_page p');
            $this->db->join('anken_file_library f1', 'p.top_image = f1.id', 'left');
            $this->db->join('anken_file_library f2', 'p.middle_image1 = f2.id', 'left');
            $this->db->join('anken_file_library f3', 'p.middle_image2 = f3.id', 'left');
            $this->db->join('anken_file_library f4', 'p.middle_image3 = f4.id', 'left');
            $this->db->join('anken_file_library f5', 'p.bottom_image1 = f5.id', 'left');
            $this->db->join('anken_file_library f6', 'p.bottom_image2 = f6.id', 'left');
            $this->db->join('anken_file_library f7', 'p.bottom_image3 = f7.id', 'left');
            $this->db->where('p.id', $main_about->build_more_page);
        
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
        
            $rowArray['top_image'] = $buildImage($row->top_image_id, $row->top_image_file, $row->top_image_dir);
            $rowArray['middle_image1'] = $buildImage($row->middle_image1_id, $row->middle_image1_file, $row->middle_image1_dir);
            $rowArray['middle_image2'] = $buildImage($row->middle_image2_id, $row->middle_image2_file, $row->middle_image2_dir);
            $rowArray['middle_image3'] = $buildImage($row->middle_image3_id, $row->middle_image3_file, $row->middle_image3_dir);
            $rowArray['bottom_image1'] = $buildImage($row->bottom_image1_id, $row->bottom_image1_file, $row->bottom_image1_dir);
            $rowArray['bottom_image2'] = $buildImage($row->bottom_image2_id, $row->bottom_image2_file, $row->bottom_image2_dir);
            $rowArray['bottom_image3'] = $buildImage($row->bottom_image3_id, $row->bottom_image3_file, $row->bottom_image3_dir);
            
            // Unset raw image fields
            unset(
                $rowArray['top_image_id'], $rowArray['top_image_file'], $rowArray['top_image_dir'],
                $rowArray['middle_image1_id'], $rowArray['middle_image1_file'], $rowArray['middle_image1_dir'],
                $rowArray['middle_image2_id'], $rowArray['middle_image2_file'], $rowArray['middle_image2_dir'],
                $rowArray['middle_image3_id'], $rowArray['middle_image3_file'], $rowArray['middle_image3_dir'],
                $rowArray['bottom_image1_id'], $rowArray['bottom_image1_file'], $rowArray['bottom_image1_dir'],
                $rowArray['bottom_image2_id'], $rowArray['bottom_image2_file'], $rowArray['bottom_image2_dir'],
                $rowArray['bottom_image3_id'], $rowArray['bottom_image3_file'], $rowArray['bottom_image3_dir']
            );
        
            // Get icon features
            $this->db->select("aif.*, 
                f1.id as icon_id, f1.file as icon_file, f1.directory_id as icon_dir,
            ");
            $this->db->from('anken_icon_feature aif')
                ->join('anken_file_library f1', 'aif.icon = f1.id', 'left')
                ->where(['aif.ref_id' => $row->id, 'aif.type' => 'build_more_page'])
                ->order_by('position', 'asc');
            
            $icon_features = $this->db->get()->result();
                
            $final_icon_features = [];
            foreach($icon_features as $f_icon) {
                $f_icon->text_en = $f_icon->text;
                $f_icon->greenIcon = $buildImage($f_icon->icon_id, $f_icon->icon_file, $f_icon->icon_dir);
                $final_icon_features[] = $f_icon;
            }
        
            $rowArray['icon_features'] = $final_icon_features;
            
            $rowArray[ 'page_title' ] = $slug;

            $page_data[ 'page' ] = $rowArray;

            // echo '<pre>';
            // print_r( $page_data );

            $this->load->view( 'about/build_more_with_less', $page_data );
            // exit;

        } else if ( $main_about->page_type == 'legacy_page' ) {
            $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
            $this->db->from('anken_legacy_page p');
            $this->db->join('anken_file_library f', 'p.top_image = f.id', 'left');
            $this->db->where('p.id', $main_about->legacy_page);
            $row = $this->db->get()->row();
    
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
    
            unset($rowArray['file_id'], $rowArray['file'], $rowArray['directory_id']);
            
            $legacyPage = $rowArray;
            
            //  GET SLIDER AND ITEMS
            $this->db->select('i.*');
            $this->db->from('anken_legacy_page_item i');
            $this->db->where('i.legacy_page_id', $legacyPage['id']);
            $items = $this->db->get()->result();
            
            $final = [];
            foreach ($items as $item) {
                $itemArray = (array) $item;
                
                // Get all images for this item
                $this->db->select('s.*, s.type as slider_type, f.id as file_id, f.file, f.directory_id, f.type as file_type');
                $this->db->from('anken_legacy_page_slider s');
                $this->db->join('anken_file_library f', 's.image = f.id', 'left');
                $this->db->where('s.legacy_page_item_id', $item->id);
                $images = $this->db->get()->result();
                
                foreach ($images as $image) {
                    $itemImages = [];
                    $filePath = ($image->directory_id == 0)
                        ? "{$this->libraryPath}/{$image->file}"
                        : "{$this->libraryPath}/{$image->directory_id}/{$image->file}";
                    
                    $itemImages = [
                        'type' => $image->file_type,
                        'slider_type' => $image->slider_type,
                        'url' => $image->url,
                        'slider_item_id' => $image->id,
                        'id' => $image->file_id,
                        'file' => $image->file,
                        'directory_id' => $image->directory_id,
                        'path' => $filePath
                    ];
                    
                    if($image->slider_type == 'before'){
                        $itemArray['before'][] = $itemImages;    
                    }else{
                        $itemArray['after'][] = $itemImages;    
                    }
                }
                $final[] = $itemArray;
            }
            
            $legacyPage['slider'] = $final;
            
            $page_data[ 'page_title' ] = $slug;//((array)$main_about)['title_'.s_lang()];

            $page_data[ 'page' ] = $legacyPage;
            // echo 123;
            $this->load->view( 'about/positive_impact', $page_data );
            // exit;

        }



            // ===============================================================================================================
            return;
}


// ************************************************************************************

public function property_page($slug){
    //    --------------------------------------------------------------------------------------------------------------------


            
         $this->db->select('
            p.*,
    
            f1.id as top_image1_id, f1.file as top_image1_file, f1.directory_id as top_image1_dir,
            f2.id as top_image2_id, f2.file as top_image2_file, f2.directory_id as top_image2_dir,
            f3.id as available_leasing_image_id, f3.file as available_leasing_image_file, f3.directory_id as available_leasing_image_dir,
            f4.id as bottom_image1_id, f4.file as bottom_image1_file, f4.directory_id as bottom_image1_dir,
            f5.id as bottom_image2_id, f5.file as bottom_image2_file, f5.directory_id as bottom_image2_dir,
            f6.id as bottom_image3_id, f6.file as bottom_image3_file, f6.directory_id as bottom_image3_dir,
            f7.id as available_leasing_image2_id, f7.file as available_leasing_image2_file, f7.directory_id as available_leasing_image2_dir,
        ');
    
        $this->db->from('anken_location_page p');
        $this->db->join('anken_file_library f1', 'p.top_image1 = f1.id', 'left');
        $this->db->join('anken_file_library f2', 'p.top_image2 = f2.id', 'left');
        $this->db->join('anken_file_library f3', 'p.available_leasing_image = f3.id', 'left');
        $this->db->join('anken_file_library f4', 'p.bottom_image1 = f4.id', 'left');
        $this->db->join('anken_file_library f5', 'p.bottom_image2 = f5.id', 'left');
        $this->db->join('anken_file_library f6', 'p.bottom_image3 = f6.id', 'left');
        $this->db->join('anken_file_library f7', 'p.available_leasing_image2 = f7.id', 'left');
        $this->db->where('p.slug', $slug);
        $this->db->order_by('p.position', 'ASC');
        $row = $this->db->get()->row();
         
        if (!$row) {
            show_404();
        }
        $id = $row->id;
        $rowArray = (array) $row;
    
        $buildImage = function ($id, $file, $dir) {
            if (!$id) return null;
            $path = ($dir == 0) ? "{$this->libraryPath}/{$file}" : "{$this->libraryPath}/{$dir}/{$file}";
            return ['id' => $id, 'file' => $file, 'directory_id' => $dir, 'path' => $path];
        };
    
        $rowArray['top_image1'] = $buildImage($row->top_image1_id, $row->top_image1_file, $row->top_image1_dir);
        $rowArray['top_image2'] = $buildImage($row->top_image2_id, $row->top_image2_file, $row->top_image2_dir);
        $rowArray['available_leasing_image'] = $buildImage($row->available_leasing_image_id, $row->available_leasing_image_file, $row->available_leasing_image_dir);
        $rowArray['bottom_image1'] = $buildImage($row->bottom_image1_id, $row->bottom_image1_file, $row->bottom_image1_dir);
        $rowArray['bottom_image2'] = $buildImage($row->bottom_image2_id, $row->bottom_image2_file, $row->bottom_image2_dir);
        $rowArray['bottom_image3'] = $buildImage($row->bottom_image3_id, $row->bottom_image3_file, $row->bottom_image3_dir);
        $rowArray['available_leasing_image2'] = $buildImage($row->available_leasing_image2_id, $row->available_leasing_image2_file, $row->available_leasing_image2_dir);
        // Unset raw image fields
        unset(
            $rowArray['top_image1_id'], $rowArray['top_image1_file'], $rowArray['top_image1_dir'],
            $rowArray['top_image2_id'], $rowArray['top_image2_file'], $rowArray['top_image2_dir'],
            $rowArray['available_leasing_image_id'], $rowArray['available_leasing_image_file'], $rowArray['available_leasing_image_dir'],
            $rowArray['bottom_image1_id'], $rowArray['bottom_image1_file'], $rowArray['bottom_image1_dir'],
            $rowArray['bottom_image2_id'], $rowArray['bottom_image2_file'], $rowArray['bottom_image2_dir'],
            $rowArray['bottom_image3_id'], $rowArray['bottom_image3_file'], $rowArray['bottom_image3_dir']
        );
    
        // Get text features
        $text_features = $this->db
            ->order_by('position', 'asc')
            ->get_where('anken_text_feature', ['ref_id' => $id, 'type' => 'location_page'])
            ->result();
    
        // Get icon features
        $this->db->select("aif.*, 
            f1.id as icon_id, f1.file as icon_file, f1.directory_id as icon_dir,
        ");
        $this->db->from('anken_icon_feature aif')
            ->join('anken_file_library f1', 'aif.icon = f1.id', 'left')
            ->where(['aif.ref_id' => $id, 'aif.type' => 'location_page'])
            ->order_by('position', 'asc');
        
        $icon_features = $this->db->get()->result();
            
        $final_icon_features = [];
        foreach($icon_features as $f_icon){
            $f_icon->greenIcon = $buildImage($f_icon->icon_id, $f_icon->icon_file, $f_icon->icon_dir);
            $final_icon_features[] = $f_icon;
        }
    
        $rowArray['text_features'] = $text_features;
        $rowArray['icon_features'] = $icon_features;
        
        // --------------------------------------------------------------
        $rowArray["page_title"] = $slug;    

        $page_data['page'] = $rowArray;
        

        $this->load->view('our_portfolio/index_page_1', $page_data);


        
        //    --------------------------------------------------------------------------------------------------------------------
            return;
}

// ***********************************************************************************************************************************

public function place_made_of_people($slug){
    // Call Portfolio controller and keep clean URL
        //    --------------------------------------------------------------------------------------------------------------------
            $this->db->where( 'slug', $slug );
            $leasing = $this->db->get( 'anken_leasing_page' )->row();
            $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
            $this->db->from('anken_leasing_page p');
            $this->db->join('anken_file_library f', 'p.top_image = f.id', 'left');
            $this->db->where('p.id', $leasing->id);
            $row = $this->db->get()->row();

            if ( !$row ) {
                show_404();
                // response( 404, 1, 'Leasing page not found.', [] );
            }
            

            $pageData = (array) $row;
    
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
        
            $pageData['top_image'] = $file;
            
            // $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
            // $this->db->from('anken_leasing_properties p');
            // $this->db->join('anken_file_library f', 'p.image = f.id', 'left');
            // $this->db->where('p.leasing_page_id', $row->id);
            // $results = $this->db->get()->result();
            $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
            $this->db->from('anken_leasing_properties p');
            $this->db->join('anken_file_library f', 'p.image = f.id', 'left');
            $this->db->where('p.leasing_page_id', $row->id);
            $results = $this->db->get()->result();
            $final = [];
            
            foreach ($results as $row) {
                $rowArray = (array) $row;
            
                // Build the full file object if exists
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
            
                // Replace `image` field with full file object
                $rowArray['image'] = $file;
            
                // Optionally remove the joined columns (they're now in 'image')
                unset($rowArray['file_id'], $rowArray['file_name'], $rowArray['dir_id']);
            
                $final[] = $rowArray;
            }
            
            $pageData[ 'properties' ] = $final;
            
            $pageData[ 'page_title' ] = $slug;

            $page_data[ 'page' ] = $pageData;

            // echo '<pre>';
            // print_r( $page_data );

            $this->load->view( 'about/places_made_of_people', $page_data );
            exit;

       



        //    --------------------------------------------------------------------------------------------------------------------
            return;
}


public function legacy_page($slug){
    // Call Portfolio controller and keep clean URL
        //    --------------------------------------------------------------------------------------------------------------------
            $this->db->where( 'slug', $slug );
            $legacy = $this->db->get( 'anken_legacy_page' )->row();
            // echo "<pre>";
            // print_r($legacy);
            // exit;
            

             
            $this->db->select('p.*, f.id as file_id, f.file, f.directory_id');
            $this->db->from('anken_legacy_page p');
            $this->db->join('anken_file_library f', 'p.top_image = f.id', 'left');
            $this->db->where('p.id', $legacy->id);
            $row = $this->db->get()->row();
    
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
    
            unset($rowArray['file_id'], $rowArray['file'], $rowArray['directory_id']);
            
            $legacyPage = $rowArray;
            
            //  GET SLIDER AND ITEMS
            $this->db->select('i.*');
            $this->db->from('anken_legacy_page_item i');
            $this->db->where('i.legacy_page_id', $legacyPage['id']);
            $items = $this->db->get()->result();
            
            $final = [];
            foreach ($items as $item) {
                $itemArray = (array) $item;
                
                // Get all images for this item
                $this->db->select('s.*, s.type as slider_type, f.id as file_id, f.file, f.directory_id, f.type as file_type');
                $this->db->from('anken_legacy_page_slider s');
                $this->db->join('anken_file_library f', 's.image = f.id', 'left');
                $this->db->where('s.legacy_page_item_id', $item->id);
                $images = $this->db->get()->result();
                
                foreach ($images as $image) {
                    $itemImages = [];
                    $filePath = ($image->directory_id == 0)
                        ? "{$this->libraryPath}/{$image->file}"
                        : "{$this->libraryPath}/{$image->directory_id}/{$image->file}";
                    
                    $itemImages = [
                        'type' => $image->file_type,
                        'slider_type' => $image->slider_type,
                        'url' => $image->url,
                        'slider_item_id' => $image->id,
                        'id' => $image->file_id,
                        'file' => $image->file,
                        'directory_id' => $image->directory_id,
                        'path' => $filePath
                    ];
                    
                    if($image->slider_type == 'before'){
                        $itemArray['before'][] = $itemImages;    
                    }else{
                        $itemArray['after'][] = $itemImages;    
                    }
                }
                $final[] = $itemArray;
            }
            
            $legacyPage['slider'] = $final;
            
            $page_data[ 'page_title' ] = $slug;//((array)$main_about)['title_'.s_lang()];

            $page_data[ 'page' ] = $legacyPage;
            // echo "<pre>";
            // print_r($page_data[ 'page' ]);
            // exit;
            // echo 123;
            $this->load->view( 'about/positive_impact', $page_data );
            exit;
            // return;
    


    }




}