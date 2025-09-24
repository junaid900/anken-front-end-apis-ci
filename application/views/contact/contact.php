<?php $this->load->view('partials/header_white')?>
<style>
  .mb-3 {
    margin-bottom: 10px !important;
}
.contact-form-item input{
  padding: 3px 5px !important;
}
.interAnker a{
  color: #5f6062 !important;
}

@media (min-width: 768px) and (max-width: 1600px) {
  .col-md-5 {
        flex: 0 0 auto;
        width: 39.66666667% !important;
    }
.col-md-7 {
        flex: 0 0 auto;
        width: 60.33333333% !important;
    }
    .intro_input input{
      width: 90% !important;
    }
    .INTRO2 input{
      float: right !important;
    }
    .INTRO2 label{
      margin-left: 21px;
    }
}

@media(max-width: 576px){
  .contact .featureImg{
    height: auto !important;
  }
  .intro_image{
    padding: 0 !important;
  }
  .anken_section_center {
    width: 100%;
}
.intro_input input{
      width: 90% !important;
    }
    .INTRO2 input{
      float: right !important;
    }
    .INTRO2 label{
      margin-left: 21px;
    }
    .mob_padding{
      padding-left: 0 !important;
    }
    .mpob{
      background: #f9f7f4 !important;
      margin-bottom: 11px;
    }
    .contact-submit{
     margin-bottom: 40px;
    }
    #smp_padding{
          margin-bottom: 30px !important;
    }
}
.contact-submit{
  text-transform: uppercase;
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

                  <div class="container-fluid page-content bg-light contact">

                      <div class="row">

                        <div class="col-md-7 ps-0 intro_image">

                          <img src="<?= base_url() ?>themes/assets/images/woman.jpg" class="img-fluid mb-3 featureImg" alt="Office Image">

                        </div>

                        <div class="col-md-5 c-white-room pe-0">

                          <img src="<?= base_url() ?>themes/assets/images/white-room.jpg" class="img-fluid mb-3 featureImg" alt="Interior">

                        </div>

                      </div>

                

                      <!-- Contact Form and Details -->

                      <div class="row bg-white">

                        <div class="col-md-5 p-0 mpob">

                          <form>

                              <div class="form-container">

                                  <h5 class="bold-heading">Get in Touch with us</h5>

                                   <div class="row">

                                      <div class="form-group col-6 p-0 contact-form-item intro_input">

                                        <label>Name & Surname*</label>

                                        <input type="text" class="form-control">

                                      </div>

                                      <!-- <div class="col-md-2"></div> -->

                                      <div class="form-group col-6 p-0 contact-form-item intro_input INTRO2">

                                        <label>Phone*</label>

                                        <input type="text" class="form-control">

                                      </div>

                                    

                                        <div class="form-group col-md-12 p-0 mt-3 contact-form-item">

                                          <label>Email*</label>

                                          <input type="email" class="form-control">

                                        </div>

                                        <div class="form-group col-md-12 p-0 mt-3 contact-form-item message">

                                          <label>Message</label>

                                          <textarea cols="40" rows="5" class="form-control" rows="4"></textarea>

                                          <div class="txt-required-field">

                                              *Required Field

                                          </div>

                                        </div>

                                    </div>

                              </div>

                           

                            <div class="form-group ps-3 pe-4 col-md-12 contact-form-item">

                              <label class="m-0">What district is ANKENs office in? </label>

                              <input type="text" class="form-control">

                            </div>

                            <!--<button class="btn btn-dark px-4 mt-2">SUBMIT</button>-->

                            <div class="pe-4">

                                <input class="contact-submit mt-2" type="submit" value="Submit">

                            </div>

                          </form>

                        </div>

                

                        <div class="col-md-7 pe-0 mob_padding">

                            <div class="form-container row">

                                <div class="col-md-5 col-5 p-3">

                                        <h5 class="large-bold-heading"><strong>ANKEN Group’s <br> Contact Details</strong></h5>

                                        <p class="bold-heading fw-bold">安垦集团联系方式</p>

                                        <p class="pb-2">4A ANKEN Xuhui – 50 Puhuitang Road, Xuhui District, Shanghai 200030</p>

                                        <p class="pb-3">安垦XUHUI – 上海市徐汇区蒲汇塘路50号4A室200030</p>

                                </div>

                                <div class="row p-2">

                                            <div class="col-sm-4 pb-4 ps-3 mt-4">

                                              <h6 class="small-bold-heading">Leasing Enquiries</h6>

                                              <p class="small-bold-heading">租赁咨询</p>

                                              <p class="interAnker"><a href="mailto:events@ankengroup.com">events@ankengroup.com</a> / <a href="tel:+8613764691254">+8613764691254</a></p>

                                            </div>

                                            <div class="col-sm-4 mt-4">

                                              <h6 class="small-bold-heading">Events Space</h6>

                                              <p class="small-bold-heading">活动场地咨询</p>

                                              <p class="interAnker"><a href="mailto:events@ankengroup.com">events@ankengroup.com</a> / <a href="tel:+8615921045017">+8615921045017</a></p>

                                            </div>

                                            <div class="col-sm-4 pe-3 mt-4" id="smp_padding">

                                              <h6 class="small-bold-heading">Employment</h6>

                                              <p class="small-bold-heading">招聘纳士</p>

                                              <p class="interAnker"><a href="mailto:events@ankengroup.com">events@ankengroup.com</a> / <a href="tel:+8613764691254">+8613661471487</a></p>

                                            </div>

                                        </div>

                                  

                            </div>

                        </div>

                      </div>

                    </div>

                  </div>

        </div>

    </div>

</div>





<?php $this->load->view('partials/footer')?>