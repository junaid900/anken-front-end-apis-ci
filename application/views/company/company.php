

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

                                <h5 class="large-bold-heading">Company Overview – Background</h5>

                                <p>When we founded our urban design and architecture practice in 2003, we faced the problem of finding an inspiring and affordable workplace, so we decided to create our own.</p>

                                <p>Today, we have cultivated a thriving business built on the same guiding principles that catalysed our journey almost 20 years ago.</p>

                                <p>As our business expanded, we have brought new thinking to each stage of the property lifecycle, from financial models, partnerships, architecture, management and leasing strategies. ANKEN Group is now a multi-faceted business in the areas of development, property management and investment and still we approach every new project asking the right questions: how can we create a viable, sustainable place where people want to be?</p>

                            </div>

                        </div>

                        <div class="col-md-7 c-white-room pe-0">

                          <img src="<?= base_url() ?>themes/assets/images/company_img.jpg" class="img-fluid mb-2 featureImg" alt="Interior">

                        </div>

                      </div>

                

                      <!-- Contact Form and Details -->

                      <div class="form-container c-company-bottom">

                        <div class="d-flex flex-wrap pb-4 mb-4">

                          <div class="col-5th p-2">

                              <div>

                                  <h6>PARTNERS</h6>

                                  <p></p>

                              </div>

                          </div>

                          <div class="col-5th p-2">

                              <div>

                                  <h6>ANKEN Boyue Management Co</h6>

                                  <p>Group Company</p>

                              </div>

                          </div>

                          <div class="col-5th p-2">

                              <div>

                                  <h6>ENCLAVE Planning Landscape Architecture</h6>

                                  <p>Group Company</p>

                              </div>

                          </div>

                            <div class="col-5th p-2">

                                <div>

                                    <h6>Hola Daisy</h6>

                                    <p>Group Company</p>

                                </div>

                            </div>

                          <div class="col-5th p-2"></div>

                          <div class="mb-3 w-100"></div>

                          <div class="col-5th p-2">

                              <div>

                                  <h6>SHANGTEX</h6>

                                  <p>Development Partner</p>

                              </div>

                          </div>

                          <div class="col-5th p-2">

                              <div>

                                  <h6>Goodland Holdings</h6>

                                  <p>Development Partner</p>

                              </div>

                          </div>

                          <div class="col-5th p-2">

                              <div>

                                  <h6>Asia Value Capital</h6>

                                  <p>Investment Partner</p>

                              </div>

                          </div>

                            <div class="col-5th p-2">

                                <div>

                                    <h6>Asia Green Real Estate</h6>

                                    <p>Investment Partner</p>

                                </div>

                            </div>

                          <div class="col-5th p-2">

                                <div>

                                    <h6>Shanghai Jingtai</h6>

                                    <p>Investment Partner</p>

                                </div>

                          </div>

                        </div>

                      </div>

                      

                  </div>

        </div>

    </div>

</div>





<?php $this->load->view('partials/footer')?>