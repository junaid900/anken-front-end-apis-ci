<?php $this->load->view('partials/header_white')?>
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
                      <div class="w-row">
                        <div class="w-md-40 ps-0 pb-10 pr-md-10 pr-sm-0">
                            <div class="form-container c-left">
                                <h5 class="large-bold-heading">ANKEN = Cultivate with Care</h5>
                                <p class="f-14">We believe that by caring for people’s quality of life we can cultivate environments where communities and neighbourhoods thrive. Our “people-first” system in placemaking generates dynamic and sustainable places for businesses to grow.</p>
                                <p class="f-14">+ ANKEN Extra / Quality of Life. Having a happy team is critical to business health. We care about things that others often don’t necessarily think are important or have an effect on the experience of tenants and their teams.</p>
                                <p class="f-14">x Support Network / Business Growth. Our tenancy curation enables diversity in businesses in all stages to feed into the ecosystem of fast-growing industries.</p>
                                <!--<p class="f-15">Established in Shanghai in 2006, ANKEN manages every aspect of urban renewal real estate, from sourcing buildings to undertaking redevelopment and asset management. Since our inception, we have delivered over 138,000 sq m of high quality, unique office space in Shanghai’s core areas, across 28 projects.</p>-->
                            </div>
                        </div>
                        <div class="w-md-60 c-white-room pe-0">
                          <img src="<?= base_url() ?>themes/assets/images/cultivate-with-care/Prop-Manage-1.jpg" class="img-fluid pb-10 featureImg" alt="Interior">
                        </div>
                      </div>
                
                      <!-- Contact Form and Details -->
                        <div class="w-row bottom">
                            <div class="w-md-40 ps-0 pr-md-10 pb-sm-10 pb-md-0 bottom-item-img">
                              <img src="<?= base_url() ?>themes/assets/images/cultivate-with-care/AVE-Transform-2-filter.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">
                            </div>
                            <div class="w-md-20 ps-0 pr-md-10 pb-sm-10 pb-md-0 bottom-item-img">
                              <img src="<?= base_url() ?>themes/assets/images/cultivate-with-care/AA14.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">
                            </div>
                            <div class="w-md-40 ps-0 pr-0 pb-sm-10 pb-md-0 bottom-item-img">
                              <img src="<?= base_url() ?>themes/assets/images/cultivate-with-care/Cultivate-with-Care.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">
                            </div>
                        </div>
                      
                      
                  </div>
        </div>
    </div>
</div>


<?php $this->load->view('partials/footer')?>