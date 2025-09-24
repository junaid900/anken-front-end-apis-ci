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
                                <h5 class="large-bold-heading">ANKEN Milestones – Pioneering the Urban Fabric of Shanghai</h5>
                                <p class="f-14">Since our inception we have been bold enough to take risks and try new things. We’ve packed in many “first in Shanghai” and there’s more to come. We believe there ae endless opportunities to learn and improve and we are excited to embrace new challenges.</p>
                                <!--<p class="f-15">Established in Shanghai in 2006, ANKEN manages every aspect of urban renewal real estate, from sourcing buildings to undertaking redevelopment and asset management. Since our inception, we have delivered over 138,000 sq m of high quality, unique office space in Shanghai’s core areas, across 28 projects.</p>-->
                            </div>
                        </div>
                        <div class="w-md-60 c-white-room pe-0">
                          <img src="<?= base_url() ?>themes/assets/images/milestone/Shanghai-Firsts.jpg" class="img-fluid pb-10 featureImg" alt="Interior">
                        </div>
                      </div>
                
                      <!-- Contact Form and Details -->
                        <div class="w-row bottom">
                            <div class="w-md-40 ps-0 pr-md-10 pb-sm-10 pb-md-0 bottom-item-img">
                              <img src="<?= base_url() ?>themes/assets/images/milestone/Milestone-FL-4-filter-1.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">
                            </div>
                            <div class="w-md-20 ps-0 pr-md-10 pb-sm-10 pb-md-0 bottom-item-img">
                              <img src="<?= base_url() ?>themes/assets/images/milestone/Build-More-with-Less.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">
                            </div>
                            <div class="w-md-40 ps-0 pr-0 pb-sm-10 pb-md-0 bottom-item-img">
                              <img src="<?= base_url() ?>themes/assets/images/milestone/Milestone-AA11.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">
                            </div>
                        </div>
                      
                      
                  </div>
        </div>
    </div>
</div>


<?php $this->load->view('partials/footer')?>