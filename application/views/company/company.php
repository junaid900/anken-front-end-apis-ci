

<?php $this->load->view('partials/header_white')?>



<style>
    @media screen and (min-width: 768px) and (max-width: 1500px) {
    .col-md-5{
        width: 40% !important;
    }
    .col-md-7{
        width: 60% !important;
    }
    .p-2{
        padding-left: 0 !important;
    }
}
@media(max-width: 576px){
    .internal_padding{
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    .contact .featureImg{
        height: 100% !important;
    }
    .c-white-room{
        margin-bottom: 8px !important;
    }
    .anken_section_center{
        width:100% !important;
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

                  <div class="container-fluid page-content bg-light contact company">

                      <div class="row">

                        <div class="col-md-5 ps-0 pb-2 internal_padding">

                            <div class="form-container c-left">
                                <?php if($company['page_description_'.s_lang()]) {?>
                                    <?= $company['page_description_'.s_lang()] ?>
                                <?php } ?>
                            </div>

                        </div>

                        <div class="col-md-7 c-white-room pe-0">
                            <?php if($company['top_image_data']) {?>
                                <img src="<?= base_url() . $company['top_image_data']["path"] ?>" class="img-fluid mb-2 featureImg" alt="Interior">
                            <?php } ?>

                        </div>

                      </div>

                

                      <!-- Contact Form and Details -->

                      <div class="form-container c-company-bottom">

                        <div class="d-flex flex-wrap pb-4 mb-4">

                          <div class="col-5th p-2">

                              <div>

                                  <h6><?= get_phrase('PARTNERS') ?></h6>

                                  <p></p>

                              </div>

                          </div>
                            <?php foreach($partners as $partner) { 
                                    if($partner["type"] != 'partner'){
                                        continue;
                                    }
                            ?>
                              <div class="col-5th p-2">
                    
                                  <div>
    
                                      <h6><?= $partner['title_'.s_lang()] ?></h6>
    
                                      <p><?= $partner['company_name_'.s_lang()] ?></p>
    
                                  </div>
    
                              </div>
                            <?php  } ?>
                          

                          <div class="col-5th p-2"></div>

                          <div class="mb-3 w-100"></div>

                        </div>
                        <div class="d-flex flex-wrap pb-4 mb-4">
                             <div class="col-5th p-2">
    
                                  <div>
    
                                      <h6><?= get_phrase('SHANGTEX') ?></h6>
    
                                      <p><?= get_phrase('Development_Partner') ?></p>
    
                                  </div>
    
                              </div>
                                <?php foreach($partners as $partner) { 
                                    if($partner["type"] != 'development_partner'){
                                        continue;
                                    }
                                ?>
                                
                                <div class="col-5th p-2">
    
                                  <div>
                                    <?php if( isset($partner['title_'.s_lang()]) ){ ?>
                                      <h6><?= $partner['title_'.s_lang()] ?></h6>
                                    <?php } ?>
                                    <?php if( isset($partner['company_name_'.s_lang()]) ){ ?>
                                      <p><?= $partner['company_name_'.s_lang()] ?></p>
                                     <?php } ?>
    
                                  </div>
    
                                </div>
                                <?php } ?>
                          </div>
                      </div>
                  </div>
        </div>

    </div>

</div>





<?php $this->load->view('partials/footer'); exit;?>