
<?php 
// echo "<pre>";
// print_r($page);
// exit;
?>

<?php $this->load->view('partials/header_white')?>
<style>
  .carousel-label {
    position: absolute;
    /*top: 15px;*/
    /*left: 15px;*/
    background: #231f20;
    color: #fff;
    padding: 9px 13px;
    font-size: 13px;
    text-transform: uppercase;
    z-index: 10;
  }

  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-image: none;
  }

  .custom-arrow {
    font-size: 24px;
    color: #fff;
    padding: 4px 8px;
    /*border-radius: 2px;*/
  }
  .custom-arrow img{
      width: 20px;
      height: 26px;
  }

  .carousel-control-prev,
  .carousel-control-next {
    width: auto;
    top: auto;
    bottom: 0px;
  }

  .carousel-control-prev {
    right: 36px;
    left: auto;
    background: #5f6062;
    opacity: 1;
  }

  .carousel-control-next {
    right: 0px;
    background: #231f20;
    opacity: 1;
  }

  .carousel-item img {
    width: 100%;
    /*height: auto;*/
    object-fit: cover;
    height: 100%;
  }
  @media(max-width: 576px){
    .anken_section_center{
      width:100% !important;
    }
    .w-row{
      gap: 9px !important;
    }
    .mob_bottom{
      margin-bottom: 0 !important;
      padding-bottom: 0 !important;
    }
  }
</style>

<div class="anken_featuredutiesarea">
    <div class="hzgift_parent_center">
    	<div class="anken_section_center">
			<div class="page-container">
                  <div class="container-fluid page-content bg-light contact company pb-0">
                        <div class="w-row">
                            <div class="w-md-40 ps-0 pb-10 pr-md-10 pr-sm-0 mob_bottom">
                                <div class="form-container c-left">
                                    <!--<h5 class="large-bold-heading"><?= $page['title_'.s_lang()] ?></h5>-->
                                    <?= $page['page_description_'.s_lang()] ?>
                                </div>
                            </div>
                            <div class="w-md-60 c-white-room pe-0">
                              <img src="<?= base_url().$page['top_image']["path"] ?>" class="img-fluid pb-10 featureImg h-100" alt="Interior">
                            </div>
                        </div>
                       
                        <?php 
                            if (!empty($page['slider']) && is_array($page['slider'])){
                                foreach($page['slider'] as $i => $project){
                        ?>
                            <div class="w-row pb-10">
                                <div class="w-md-20 pr-md-10 pb-sm-10 pb-md-0">
                                     <div class="form-container h-100 p-2">
                                        <div class="title_arrow p-1">
                                            <div class="content_hide_div">
                                                <h2 class="bold-heading text-start events-heading"><?= $project["title_".s_lang()] ?></h2>
                                                <p class="p-1"><?= $project["description_".s_lang()] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-md-40 pr-md-10 pb-sm-10 pb-md-0">
                                     <div id="customBeforeCarousel<?= $i ?>" class="carousel slide position-relative h-100" data-bs-ride="false">
                                          <div class="carousel-inner h-100">
                                                <div class="carousel-label">Before</div>
                                                <?php foreach($project["before"] as $k => $before_image){ ?>
                                                    <div class="carousel-item <?= $k === 0 ? 'active' : '' ?> h-100">
                                                      <img src='<?= base_url().$before_image['path'] ?>' class="d-block w-100" alt="Before Image">
                                                    </div>
                                                <?php } ?>
                                          </div>
                                        
                                          <!-- Arrows -->
                                          <button class="carousel-control-prev" type="button" data-bs-target="#customBeforeCarousel<?= $i ?>" data-bs-slide="prev">
                                            <span class="custom-arrow"><img src="<?=base_url()?>themes/assets/images/left_s_arrow.png" /></span>
                                          </button>
                                          <button class="carousel-control-next" type="button" data-bs-target="#customBeforeCarousel<?= $i ?>" data-bs-slide="next">
                                            <span class="custom-arrow"><img src="<?=base_url()?>themes/assets/images/right_s_arrow.png" /></span>
                                          </button>
                                        </div>
                                    </div>
                                     <div class="w-md-40 p-0 pb-sm-10 pb-md-0">
                                        <div id="customAfterCarousel<?= $i ?>" class="carousel slide position-relative h-100" data-bs-ride="false">
                                            <div class="carousel-label">After</div>
                                             <div class="carousel-inner h-100">
                                                <?php foreach($project["after"] as $k => $after_image){ ?>
                                                    <div class="carousel-item <?= $k === 0 ? 'active' : '' ?> h-100">
                                                      <img src='<?= base_url().$after_image['path'] ?>' class="d-block w-100" alt="Before Image">
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        
                                              <!-- Arrows -->
                                              <button class="carousel-control-prev" type="button" data-bs-target="#customAfterCarousel<?= $i ?>" data-bs-slide="prev">
                                                <span class="custom-arrow"><img src="<?=base_url()?>themes/assets/images/left_s_arrow.png" /></span>
                                              </button>
                                              <button class="carousel-control-next" type="button" data-bs-target="#customAfterCarousel<?= $i ?>" data-bs-slide="next">
                                                <span class="custom-arrow"><img src="<?=base_url()?>themes/assets/images/right_s_arrow.png" /></span>
                                              </button>
                                        </div>
                                    </div>
                            </div>
                            <?php } 
                            } ?>
                             
                    </div>
                        
                      <!-- Contact Form and Details -->
                        <!--<div class="row">-->
                        <!--    <div class="col-md-5 ps-0 pe-10">-->
                        <!--      <img src="<?= base_url() ?>themes/assets/images/who_we_are_bottom_1.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">-->
                        <!--    </div>-->
                        <!--    <div class="col-md-5 ps-0 pe-10">-->
                        <!--      <img src="<?= base_url() ?>themes/assets/images/who_we_are_bottom_2.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">-->
                        <!--    </div>-->
                        <!--    <div class="col-md-2 ps-0 pe-0">-->
                        <!--      <img src="<?= base_url() ?>themes/assets/images/who_we_are_bottom_3.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">-->
                        <!--</div>-->
                      
                      
                  </div>
        </div>
    </div>
</div>
<?php $this->load->view('partials/footer')?>

<?php 
exit;

?>