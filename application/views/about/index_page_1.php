<?php 
// echo '<pre>';
// print_r($page);
// echo $page['page_description_en'];
// exit;
?>


<?php $this->load->view('partials/header_white')?>

<style>
  .c-white-room-height{
    height: 461px;
  }
</style>


<div class="anken_featuredutiesarea">

    <div class="hzgift_parent_center">

    	<div class="anken_section_center">

			<div class="page-container">

                  <div class="container-fluid page-content bg-light contact company">

                      <div class="w-row">

                        <div class="w-md-40 ps-0 pb-10 pr-md-10 pr-sm-0">

                            <div class="form-container c-left">
                                <?php 
                                 echo $page['page_description_'.s_lang()];
                                
                                ?>

                            </div>

                        </div>

                        <div class="w-md-60 c-white-room c-white-room-height pe-0">

                          <img src="<?= base_url() . $page['top_image']['path'] ?>" onerror="this.onerror=null; this.src='<?= base_url('themes/assets/images/31343C.svg'); ?>';" class="img-fluid pb-10 featureImg h-100" alt="Interior">

                        </div>

                      </div>

                

                      <!-- Contact Form and Details -->

                        <div class="w-row bottom">

                            <div class="w-md-40 ps-0 pr-md-10 pb-sm-10 pb-md-0 bottom-item-img">

                              <img src="<?= base_url() . $page['bottom_image1']['path'] ?>" onerror="this.onerror=null; this.src='<?= base_url('themes/assets/images/31343C.svg'); ?>';" class="img-fluid who_we_are_bottom_img" alt="Interior">

                            </div>

                            <div class="w-md-40 ps-0 pr-md-10 pb-sm-10 pb-md-0 bottom-item-img">

                              <img src="<?= base_url() . $page['bottom_image2']['path'] ?>" onerror="this.onerror=null; this.src='<?= base_url('themes/assets/images/31343C.svg'); ?>';" class="img-fluid who_we_are_bottom_img" alt="Interior">

                            </div>

                            <div class="w-md-20 ps-0 pr-0 pb-sm-10 pb-md-0 bottom-item-img">

                              <img src="<?= base_url() . $page['bottom_image3']['path'] ?>" onerror="this.onerror=null; this.src='<?= base_url('themes/assets/images/31343C.svg'); ?>';" class="img-fluid who_we_are_bottom_img" alt="Interior">

                            </div>

                        </div>

                      

                      

                  </div>

        </div>

    </div>

</div>




<?php $this->load->view('partials/footer')?>


<?php exit; ?>