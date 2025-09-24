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
                                <h5 class="large-bold-heading">Services – Value Every Step of the Way</h5>
                                <p class="f-14">Property Acquisition. ANKEN’s unique ability to see the hidden potential in properties, has provided access to many opportunities in downtown Shanghai which have been overlooked.</p>
                                <p class="f-14">Design and Construction. Sensible Design is at the core of every ANKEN project. We strive to create authentic destinations that are suitable for the location, surrounding neighborhoods and user needs. Existing buildings are complex and often involve unknowns. ANKEN designs and manages this process, in order to reduce inefficiencies and react quickly when changes are required.</p>
                                <p class="f-14">Property Management. ANKEN believes in hassle free management. Our goal is to ensure that the cleanliness, upkeep and maintenance are taken care of in a professional, efficient and proactive way.</p>
                                <p class="f-14">Asset and Finance Management. Our asset and finance management approaches are focused on returning maximum value to our stakeholders, based on clear and transparent communication and collaboration.</p>
                            </div>
                        </div>
                        <div class="w-md-60 c-white-room pe-0">
                          <img src="<?= base_url() ?>themes/assets/images/services/Sensible.jpg" class="img-fluid pb-10 featureImg" alt="Interior">
                        </div>
                      </div>
                
                      <!-- Contact Form and Details -->
                        <div class="w-row bottom">
                            <div class="w-md-40 ps-0 pr-md-10 pb-sm-10 pb-md-0 bottom-item-img">
                              <img src="<?= base_url() ?>themes/assets/images/services/Air-T2-filter.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">
                            </div>
                            <div class="w-md-20 ps-0 pr-md-10 pb-sm-10 pb-md-0 bottom-item-img">
                              <img src="<?= base_url() ?>themes/assets/images/services/services.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">
                            </div>
                            <div class="w-md-40 ps-0 pr-0 pb-sm-10 pb-md-0 bottom-item-img">
                              <img src="<?= base_url() ?>themes/assets/images/services/JG-5-filter.jpg" class="img-fluid who_we_are_bottom_img" alt="Interior">
                            </div>
                        </div>
                      
                      
                  </div>
        </div>
    </div>
</div>


<?php $this->load->view('partials/footer')?>