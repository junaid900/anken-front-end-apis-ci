




<?php $this->load->view('partials/header_white')?>

<style>
    @media(max-width: 576px){
    .who_we_are_bottom_img {
          height: auto !important;
          max-height: auto !important;
    }
    .middle .middle-item-img{
        height: auto !important;
        margin-bottom: 10px;
    }
    .page-content .chart li{
        width: 100% !important;
        margin-bottom: 8px !important;
    }
    .bottom .bottom-item-img{
        height: auto !important;
    }
    .w-row.middle.pb-10{
        padding-bottom: 0px !important;
    }
    .common_mobile_class{
        height: auto !important;
    }
    .common_bottom{
        margin-bottom: 8px !important;
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

			<div class="page-container build-more">

                  <div class="container-fluid page-content bg-light contact company">

                      <div class="w-row">

                        <div class="w-md-40 ps-0 pb-10 pr-md-10 pr-sm-0">

                            <div class="form-container c-left">
                                 
                                <?= $page['page_description_'.s_lang()] ?>

                            </div>

                        </div>

                        <div class="w-md-60 pb-10 c-white-room pe-0">

                            <?php if($page['middle_image1']) {?>

                                <img src="<?= base_url() . $page['top_image']["path"] ?>" class="img-fluid who_we_are_bottom_img" alt="Interior" style="max-height: 450px">

                            <?php } ?>

                        </div>

                      </div>
 
                        <div class="w-row middle pb-10">

                            <div class="w-lg-40 w-md-50 ps-0 pr-md-10 pb-sm-10 pb-md-0 middle-item-img">

                              <img src="<?= base_url() ?>themes/assets/images/build-more/Events-1E.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">

                            </div>

                            <div class="w-lg-40 w-md-50 pr-md-0 pr-lg-10 pb-sm-10 pb-md-0 middle-item-img">

                              <div class="chart about_listing">

                                <h2>Our Sustainable Practices Include</h2>

                                    <ul>

                                        <?php

                                            foreach($page['icon_features'] as $feature){

                                        ?>

                                        <li><span class="icon_img"> <img src="<?= base_url() . $feature->greenIcon["path"] ?>" alt=""></span><?= $feature->{"text_".s_lang()}?></li>

                                        <?php } ?>

                                </div>

                            </div>

                            <div class="w-lg-20 w-md-100 pl-0 pr-0 pb-sm-10 pb-lg-0 middle-item-img">

                                <div class="pb-10 h-50 common_mobile_class">

                                    <?php if($page['middle_image2']) {?>

                                    <img src="<?= base_url() . $page['middle_image2']["path"] ?>" class="img-fluid who_we_are_bottom_img" alt="Interior">

                                    <?php } ?>

                                </div>

                                <div class="mb-10 h-50 pb-sm-10 pb-lg-0 common_mobile_class">

                                    <?php if($page['middle_image3']) {?>

                                    <img src="<?= base_url() . $page['middle_image3']["path"] ?>" class="img-fluid who_we_are_bottom_img" alt="Interior">

                                    <?php } ?>

                                </div>

                              

                              

                            </div>

                        </div>

                      <!-- Contact Form and Details -->

                        <div class="w-row bottom">

                            <div class="w-md-40 ps-0 pr-md-10 pb-sm-10 pb-md-0 bottom-item-img common_bottom">

                                <?php if($page['bottom_image1']) {?>

                                <img src="<?= base_url() . $page['bottom_image1']["path"] ?>" class="img-fluid who_we_are_bottom_img" alt="Interior">

                                <?php } ?>

                            </div>

                            <div class="w-md-20 ps-0 pr-md-10 pb-sm-10 pb-md-0 bottom-item-img common_bottom">

                              <!--<img src="<?= base_url() ?>themes/assets/images/build-more/SAS-A-filter.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">-->

                              <?php if($page['bottom_image2']) {?>

                                <img src="<?= base_url() . $page['bottom_image2']["path"] ?>" class="img-fluid who_we_are_bottom_img" alt="Interior">

                                <?php } ?>

                            </div>

                            <div class="w-md-40 ps-0 pr-0 pb-sm-10 pb-md-0 bottom-item-img ">

                              <!--<img src="<?= base_url() ?>themes/assets/images/build-more/AA13.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">-->

                              <?php if($page['bottom_image3']) {?>

                                <img src="<?= base_url() . $page['bottom_image3']["path"] ?>" class="img-fluid who_we_are_bottom_img" alt="Interior">

                                <?php } ?>

                            </div>

                        </div>

                      

                      

                  </div>

        </div>

    </div>

</div>





<?php $this->load->view('partials/footer')?>


<?php 
    exit;
?>