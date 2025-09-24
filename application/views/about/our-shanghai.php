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
                                <h5 class="large-bold-heading">Our Shanghai – Creating Communities</h5>
                                <p class="f-14">We believe neighbourhooods should be mixed-used, for living, working and leisure, offering a convenient and vibrant urban experience. ANKEN seeks out under-performing buildings within well-connected, downtown areas, enabling their transformation and bringing new life to hidden pockets within the city.</p>
                                <p class="f-14">Shanghai is China’s most dynamic city – cool, creative, cosmopolitan and commercial. Its economic base is diverse and durable, with a wide sphere of influence across several sectors including finance, media, fashion, tech, professional services plus a strong entrepreneurial tradition.</p>
                                <p class="f-14">A proven destination for domestic and foreign investment, the Shanghai real estate market provides investors both income and growth opportunities, a liquid market and growing exit options to crystalise returns. Its relative value, growth opportunities and welcoming attitude to global businesses has cemented Shanghai’s place as the number one city in China for investment.</p>
                                <!--<p class="f-14">Asset and Finance Management. Our asset and finance management approaches are focused on returning maximum value to our stakeholders, based on clear and transparent communication and collaboration.</p>-->
                            </div>
                        </div>
                        <div class="w-md-60 c-white-room pe-0">
                          <img src="<?= base_url() ?>themes/assets/images/our-shanghai/Locations-17.jpg" class="img-fluid pb-10 featureImg" alt="Interior">
                        </div>
                      </div>
                
                      <!-- Contact Form and Details -->
                        <div class="w-row bottom">
                            <div class="w-md-40 ps-0 pr-md-10 pb-sm-10 pb-md-0 bottom-item-img">
                              <img src="<?= base_url() ?>themes/assets/images/our-shanghai/XTD-2-filter.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">
                            </div>
                            <div class="w-md-20 ps-0 pr-md-10 pb-sm-10 pb-md-0 bottom-item-img">
                              <img src="<?= base_url() ?>themes/assets/images/our-shanghai/JA-2-filter.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">
                            </div>
                            <div class="w-md-40 ps-0 pr-0 pb-sm-10 pb-md-0 bottom-item-img">
                              <img src="<?= base_url() ?>themes/assets/images/our-shanghai/Bund-2-filter.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">
                            </div>
                        </div>
                      
                      
                  </div>
        </div>
    </div>
</div>


<?php $this->load->view('partials/footer')?>