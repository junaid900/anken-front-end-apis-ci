<?php $this->load->view('partials/header_white')?>

<style>
   @media(max-width: 576px){
     .contact .featureImg , #hover_card .card{
        height:auto !important;
    }
    .anken_section_center{
        width: 100% !important;
    }
    .bg_changer_event {
        background: #5f6062;
        color: white;
    }
    .bg_changer_event .bold-heading {
        /* background: #5f6062; */
        color: white;
    }
    #hover_card .card{
        margin-right: 0px !important;
    }
    #hover_card{
        margin-top: 8px !important;
    }
    .bg_changer_event{
         padding-bottom: 1.5rem !important;
         padding-top: 1rem !important;
    }
    .content_hide_div{
           display: inline-block !important;
    }
    #mob_fler{
        display: flex !important;
        flex-direction: column !important;
    }
    #mob_fler .order_n_2{
        order:2 !important;
    }
    #hover_card .card .overlay {
    position: absolute;
    bottom: -77%;
    }
    #hover_card {
        padding: 0 5px !important;
    }
   }
</style>


<?php
    $menu = $this->session->userdata('menu');
    $get_str='';
    if($_GET){
        $arr = geturlparmersGETS();
        for($i=0;$i<count($arr);$i++){
            if(isset($_GET[$arr[$i]])){
                if($get_str!=""){$get_str .='&';}else{$get_str .='?';}
                $get_str .=$arr[$i].'='.$_GET[$arr[$i]];
            }
        }
    }
    $current_url_encode = str_replace('/','slash_tag',base64_encode(current_url().$get_str));
?>
<div class="anken_featuredutiesarea">
    <div class="hzgift_parent_center">
    	<div class="anken_section_center">
			<div class="page-container">
                  <div class="container-fluid page-content bg-light contact events p-5">
                      <div class="w-row">
                        <div class="w-sm-100 w-md-40 p-5">
                          <img src="<?= base_url() ?>themes/assets/images/events-1.jpg" class="img-fluid featureImg" alt="Office Image">
                        </div>
                        <div class="w-sm-100 w-md-60 p-5">
                          <img src="<?= base_url() ?>themes/assets/images/events-2.jpg" class="img-fluid featureImg" alt="Interior">
                        </div>
                      </div>
                
                      <!-- Contact Form and Details -->
                      <div class="w-row h-100">
                        <div class="w-sm-100 w-md-20" id="mob_fler">
                            <div class="h-md-50 p-5 order_n_2">
                                <div class="form-container h-100 p-2">
                                    <div class="title_arrow p-1">
                                        <div class="content_hide_div ">
                                            <h2 class="bold-heading text-start events-heading">Latest News <br>&amp; Events</h2>
                                            <p class="p-1"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!--<div class="pb-10"></div>-->
                            <div class="h-md-50 p-5 order_n_1">
                                <div class="form-container h-100 p-2  bg_changer_event">
                                    <div class="title_arrow p-1">
                                        <div class="content_hide_div">
                                            <h2 class="bold-heading text-start events-heading">Book an Event Space</h2>
                                            <p class="p-1">Discover versatile event spaces at ANKEN ideal for any occasion - from large exhibitions to intimate gatherings. CLICK HERE to enquire about space today.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php foreach($events as $event){ ?>
                        <div class="w-sm-100 w-md-20 c-latest-event-item p-5">
                            <div class="h-100">
                                <div class="form-container h-100">
                                    <div class="">
                                        <div class="content_hide_div">
                                            <h2 class="bold-heading text-start events-heading mb-1"><?= $event['date'] ?><br><?=$event['title_'.s_lang()]?></h2>
                                            <p><?= $event['description_'.s_lang()] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <!---->
                        <div class="d-flex flex-wrap w-100" id="hover_card">
                            <div class="col-5th">
                              <div class="card bg-dark-grey p-3 h-100">
                                  <h4 class="places-made-heading"><?php echo get_phrase('PLACES'); ?><br><?php echo get_phrase('MADE_OF'); ?><br><?php echo get_phrase('PEOPLE'); ?></h4>
                              </div>  
                            </div>
                        <?php foreach($event_places as $place){ ?>
                           <div class="col-5th">
                                <div class="card">
                                    <img src="<?= base_url() . $place["image"]["path"] ?>" alt="Card Image">
                                    <div class="overlay">
                                        <h4 class="small-bold-heading c-white"><?= $place["title_".s_lang()] ?></h4>
                                        <h6><?= $place["location_".s_lang()] ?></h6>
                                        <p><?= $place["short_description_".s_lang()] ?> </p>
                                    </div>
                                </div>
                           </div>
                           <?php } ?>
                           
                           <!---->
                        </div>
                        <!---->
                      </div>
                    </div>
                  </div>
        </div>
    </div>
</div>


<?php $this->load->view('partials/footer')?>