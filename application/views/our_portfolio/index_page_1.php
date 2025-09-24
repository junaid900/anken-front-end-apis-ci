<?php $this->load->view( 'partials/header_white' )?>

<?php
// echo '<pre>';
// print_r( $page );
// // echo $page[ 'title_en' ];
// exit;
?>
<style>
h1 {
    font-family: 'SourceSansProSemiBold', Arial, sans-serif !important;
    color: #5f6062 !important;
    font-size: 24px !important;
    font-weight: 700 !important;
    margin: 0 auto 30px !important;
}

.newdiv {
    color: #fff;
}

.newdiv .grey {
    background: #5f6062;
    padding: 15px;
    color: #fff;
}

.newdiv h2 {
    padding-top: 5px;
    padding-bottom: 5px;
    background-position: 0 50% !important;
    margin-bottom: 18px !important;
    padding: 4px 0 3px 43px !important;
    font-size: 22px !important;
    color: #fff;
    font-weight: 600;
    text-align: left;
    margin: 0 auto 28px !important;
    line-height: 30px !important;
}
.large-bold-heading2{
    padding-top: 0px !important;
    padding-bottom: 25px !important;
    font-size: 22px !important;
}
@media(max-width:576px){
    .contact .featureImg{
        height: auto !important;
    }
    .anken_section_center{
        width: 100% !important;
    }
    #not_at_all{
        height: 70% !important;
    }
    .newdiv{
        height: auto !important;
    }
    #smart_header{
        height:auto !important;
    }
    .page-content .chart h2{
        line-height: 28px !important;
    }
}
</style>

<div class='anken_featuredutiesarea'>

    <div class='hzgift_parent_center'>

        <div class='anken_section_center'>

            <div class='page-container'>

                <div class='container-fluid page-content bg-light contact portfolio p-5'>

                    <div class='w-row'>

                        <div class='w-md-60 p-5'>

                            <img src="<?= base_url() . $page['top_image1']['path'] ?>" class='img-fluid featureImg'
                                alt='Interior'>

                        </div>

                        <div class='w-md-40 c-white-room p-5'>

                            <img src="<?= base_url() . $page['top_image2']['path'] ?>" class='img-fluid featureImg'
                                alt='Interior'>

                        </div>

                    </div>

                    <!-- Contact Form and Details -->

                    <div class='w-row'>

                        <div class='w-sm-50 w-md-40 p-5'>
                            <div class='form-container d-flex flex-column'>

                                    <div class='flex-1'>
                                        <?php
                                            echo $page[ 'page_description_'.s_lang() ];
                                        ?>
                                        <!-- ------------------------------- -->

                                    </div>

                                    <!--<p class = 'f-14'>Asset and Finance Management. Our asset and finance management approaches are focused on returning maximum value to our stakeholders, based on clear and transparent communication and collaboration.</p>-->

                                    <div class='address pt-4'>

                                        <p class=' '><?php
                                            echo $page[ 'description_bottom_'.s_lang()] ? $page[ 'description_bottom_'.s_lang() ] : '';
                                        ?></p>

                                    </div>

                                </div>
                        </div>

                        <div class='w-sm-50 w-md-40 p-5'>

                            <div class='form-container d-flex flex-column'>

                                <h2 class='large-bold-heading2'> <?php
                                    echo get_phrase( 'Distinctive_Features' );
                                ?> </h2>

                                <ul class='feature-list flex-1'>
                                    <?php

                                        foreach ( $page[ 'text_features' ] as $key => $value ) {
                                            echo '<li>' . $value->text . '</li>';
                                        }
                                        ?>

                                </ul>

                                <div class='address'>

                                    <p class=' '><?php
                                            echo $page[ 'feature_description_bottom_'.s_lang() ] ? trim($page[ 'feature_description_bottom_'.s_lang() ]) : '';
                                        ?></p>

                                </div>

                            </div>

                        </div>

                        <div class='w-sm-100 w-md-20 h-min-100'>

                            <div class='h-100' id="smart_header">

                                <div class='h-50 p-5' id="not_at_all">

                                    <img class='w-100 h-100 object-fit-cover'
                                        src="<?= base_url() . $page['available_leasing_image']['path']  ?>"
                                        alt='Interior'>

                                </div>
                                
                                <div class='h-50 p-5 newdiv'>
                                    <?php 
                                        if($page['available_leasing_type'] == 'text'){
                                    ?>
                                    <a href=''>
                                        <div class='title_arrow  img_Div grey h-100'>
                                            <h2><?php
                                                echo $page[ 'available_leasing_title_'.s_lang() ];
                                            ?></h2>
                                            <?php
                                                echo $page[ 'available_leasing_description_'.s_lang() ];
                                            ?>
                                        </div>
                                    </a>
                                    <?php }else{ ?>
                                        <a href=''>
                                            <img src="<?= $page['available_leasing_image2'] ? base_url() . $page['available_leasing_image2']['path'] : "" ?>" class='w-100 h-100 object-fit-cover'
                                                alt='Interior'>
                                        </a>
                                    <?php } ?>    
                                </div>
                               
                                

                            </div>

                        </div>

                    </div>

                    <div class='w-row'>
                        <?php if(isset($page[ 'icon_features' ])){
                                if(count($page[ 'icon_features' ]) > 0){ ?>
                        <div class='w-sm-50 w-md-40 p-5'>

                            <div class='chart about_listing'>

                                <h2 class='mb-3'> <?php
                                        echo get_phrase( 'Key_green_features_of_this_property' );
                                        ?></h2>

                                <ul>
                                    <?php foreach ( $page[ 'icon_features' ] as $key => $value ) { ?>
                                    <li class='d-flex'>
                                        <span class='icon_img'>
                                            <img style='width: 26px; height: 26px;object-fit: contain;'
                                                src="<?= base_url() . $value->greenIcon['path'] ?>" alt=''>
                                        </span>
                                        <?=$value->text ?>
                                    </li>
                                    <?php } ?>
                                    <!-- <li><span class = 'icon_img'> <img src = '<?= base_url() ?>themes/assets/images/build-more/icons/adaptive.png' alt = ''></span>Adaptive Re-Use of an underutilised and abandoned building</li> -->

                                </ul>

                            </div>

                        </div>
                        <?php 
                            }
                        }
                         
                        if(isset($page['bottom_image1']['path']) || $page['bottom_image1']['path'] != ''){
                        ?>


                        <div class='w-sm-50 w-md-20 p-5'>

                            <img class='w-100 h-100 object-fit-cover'
                                src="<?= base_url() . $page['bottom_image1']['path']  ?>" class='img-fluid featureImg'
                                alt='Interior'>

                        </div>
                        <?php 
                           }
                        ?>
                        <?php 
                        
                         
                        if(isset($page['bottom_image2']['path']) || $page['bottom_image2']['path'] != ''){
                        ?>

                        <div class='w-sm-50 w-md-20 p-5'>

                            <img class='w-100 h-100 object-fit-cover'
                                src="<?= base_url() . $page['bottom_image2']['path']  ?>" class='img-fluid featureImg'
                                alt='Interior'>

                        </div>

                        <?php 
                           }
                        ?>

                        <?php 
                        
                         
                        if(isset($page['bottom_image3']['path']) || $page['bottom_image3']['path'] != ''){
                        ?>

                        <div class='w-sm-50 w-md-20 p-5'>

                            <img class='w-100 h-100 object-fit-cover'
                                src="<?= base_url() . $page['bottom_image3']['path']  ?>" class='img-fluid featureImg'
                                alt='Interior'>

                        </div>

                        <?php 
                           }
                        ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <?php $this->load->view( 'partials/footer' )?>


    <?php 
    exit;
    
    ?>