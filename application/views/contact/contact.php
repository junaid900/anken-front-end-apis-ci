<?php $this->load->view('partials/header_white')?>
<style>
.mb-3 {
    margin-bottom: 10px !important;
}

.contact-form-item input {
    padding: 3px 5px !important;
}

.interAnker a {
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

    .intro_input input {
        width: 90% !important;
    }

    .INTRO2 input {
        float: right !important;
    }

    .INTRO2 label {
        margin-left: 21px;
    }
}

@media(max-width: 576px) {
    .contact .featureImg {
        height: auto !important;
    }

    .intro_image {
        padding: 0 !important;
    }

    .anken_section_center {
        width: 100%;
    }

    .intro_input input {
        width: 90% !important;
    }

    .INTRO2 input {
        float: right !important;
    }

    .INTRO2 label {
        margin-left: 21px;
    }

    .mob_padding {
        padding-left: 0 !important;
    }

    .mpob {
        background: #f9f7f4 !important;
        margin-bottom: 11px;
    }

    .contact-submit {
        margin-bottom: 40px;
    }

    #smp_padding {
        margin-bottom: 30px !important;
    }
}

<style>.captcha-container {
    margin-top: 15px;
}

.captcha-box {
    display: flex;
    align-items: center;
    gap: 10px;
}

#captchaInput {
    color: #333;
    border: none;
    border-radius: 0px;
    background: #dbdcdd;
    font-family: 'SourceSansPro', Arial, sans-serif;
    font-style: normal;
    font-weight: 700;
    text-transform: uppercase;
    padding: 3px 5px;
    width: 80%;
    display: block;
    margin: auto;
    margin-top: 5px;
    outline: none;
    -webkit-transition: all 300ms;
    -moz-transition: all 300ms;
    -o-transition: all 300ms;
    transition: all 300ms;

}

.captcha-text {
    /* background: #f3f3f3; */
    /* border: 1px solid #ccc; */
    font-weight: bold;
    /* font-size: 22px; */
    letter-spacing: 5px;
    padding: 6px 12px;
    border-radius: 4px;
    user-select: none;
    font-family: auto;
    font-weight: bolder;
}

.refresh-btn {
    border: none;
    background: none;
    cursor: pointer;
    font-size: 18px;
}

/* .captcha-input {
    margin-top: 10px;
} */

.error-message {
    color: red;
    /* font-size: 14px;÷÷ */
    margin-top: 5px;
    display: none;
}


.contact-submit {
    text-transform: uppercase;
}
.mt-5{
    margin-top: 4.6rem !important;
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

                            <img src="<?= base_url() ?>themes/assets/images/woman.jpg" class="img-fluid mb-3 featureImg"
                                alt="Office Image">

                        </div>

                        <div class="col-md-5 c-white-room pe-0">

                            <img src="<?= base_url() ?>themes/assets/images/white-room.jpg"
                                class="img-fluid mb-3 featureImg" alt="Interior">

                        </div>

                    </div>



                    <!-- Contact Form and Details -->

                    <div class="row bg-white">

                        <div class="col-md-5 p-0 mpob">

                            <form id="contactForm">

                                <div class="form-container">

                                    <h5 class="bold-heading"><?php echo get_phrase('get_in_touch_with_us'); ?></h5>

                                    <div class="row">

                                        <div class="form-group col-6 p-0 contact-form-item intro_input">

                                            <label><?php echo get_phrase('name_&_surname'); ?>*</label>

                                            <input type="text" class="form-control">

                                        </div>

                                        <!-- <div class="col-md-2"></div> -->

                                        <div class="form-group col-6 p-0 contact-form-item intro_input INTRO2">

                                            <label><?php echo get_phrase('Phone'); ?>*</label>

                                            <input type="text" class="form-control">

                                        </div>



                                        <div class="form-group col-md-12 p-0 mt-3 contact-form-item">

                                            <label><?php echo get_phrase('Email'); ?>*</label>

                                            <input type="email" class="form-control">

                                        </div>

                                        <div class="form-group col-md-12 p-0 mt-3 contact-form-item message">

                                            <label><?php echo get_phrase('Message'); ?></label>

                                            <textarea cols="40" rows="5" class="form-control" rows="4"></textarea>

                                            <div class="txt-required-field">

                                                *<?php echo get_phrase('Required_Field'); ?>

                                            </div>

                                        </div>

                                    </div>

                                </div>



                                <div class="form-group ps-3 pe-4 col-md-12 contact-form-item">

                                    <label class="m-0"><?php echo get_phrase('what_district_is_ANKENs_office_in'); ?>?
                                    </label>

                                    <input type="text" class="form-control">

                                </div>

                                <!--<button class="btn btn-dark px-4 mt-2">SUBMIT</button>-->
                                <!-- CAPTCHA -->



                                <div class="pe-4">
                                    
                                    <div class="mm position-relative ps-3 mt-5 d-flex align-items-start justify-content-end gap-5" >
                                        <input style="order:2;" class="contact-submit " type="submit" value="Submit">
                                        <div class="form-group col-md-12 captcha-container" style="width: 124px;">
                                            <label><?php echo get_phrase('Enter_display_letters') ?>:</label>
                                            <!-- <div class="row"> -->
                                            <div class="d-flex align-items-center justify-content-start p-0">
                                                <input type="text" id="captchaInput" class=" captcha-input" required>
                                            </div>
                                            <!-- </div> -->
                                           
                                            <!-- <br> -->
                                            <div class="captcha-box">
                                                <span id="captcha" class="captcha-text"></span>
                                                <!-- <button type="button" class="refresh-btn"
                                            onclick="generateCaptcha()">🔄</button> -->
                                            </div>


                                        </div>


                                    </div>

                                </div>

                            </form>


                        </div>



                        <div class="col-md-7 pe-0 mob_padding">

                            <div class="form-container row">

                                <div class="col-md-5 col-5 p-3">

                                    <h5 class="large-bold-heading"><strong><?php  ?>ANKEN Group’s <br> Contact
                                            Details</strong></h5>

                                    <p class="bold-heading fw-bold">安垦集团联系方式</p>

                                    <p class="pb-2">4A ANKEN Xuhui – 50 Puhuitang Road, Xuhui District, Shanghai 200030
                                    </p>

                                    <p class="pb-3">安垦XUHUI – 上海市徐汇区蒲汇塘路50号4A室200030</p>

                                </div>

                                <div class="row p-2">

                                    <div class="col-sm-4 pb-4 ps-3 mt-4">

                                        <h6 class="small-bold-heading">Leasing Enquiries</h6>

                                        <p class="small-bold-heading">租赁咨询</p>

                                        <p class="interAnker"><a
                                                href="mailto:events@ankengroup.com">events@ankengroup.com</a> / <a
                                                href="tel:+8613764691254">+8613764691254</a></p>

                                    </div>

                                    <div class="col-sm-4 mt-4">

                                        <h6 class="small-bold-heading">Events Space</h6>

                                        <p class="small-bold-heading">活动场地咨询</p>

                                        <p class="interAnker"><a
                                                href="mailto:events@ankengroup.com">events@ankengroup.com</a> / <a
                                                href="tel:+8615921045017">+8615921045017</a></p>

                                    </div>

                                    <div class="col-sm-4 pe-3 mt-4" id="smp_padding">

                                        <h6 class="small-bold-heading">Employment</h6>

                                        <p class="small-bold-heading">招聘纳士</p>

                                        <p class="interAnker"><a
                                                href="mailto:events@ankengroup.com">events@ankengroup.com</a> / <a
                                                href="tel:+8613764691254">+8613661471487</a></p>

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
<script>
let captchaText = "";

function generateCaptcha() {
    const chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    captchaText = "";
    for (let i = 0; i < 4; i++) {
        captchaText += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    document.getElementById("captcha").innerText = captchaText;
    // document.getElementById("captchaInput").style.border = "none";
}

document.getElementById("contactForm").addEventListener("submit", function(e) {
    e.preventDefault(); // stop form temporarily
    const userCaptcha = document.getElementById("captchaInput").value.trim().toUpperCase();

    if (userCaptcha === captchaText) {
        document.getElementById("captchaInput").style.border = "none";
        console.log("✅ Captcha verified successfully! Form submitted.");
        this.submit(); // now submit the form
    } else {
        document.getElementById("captchaInput").style.border = "1px solid red";
        document.getElementById("captchaInput").value = "";
        generateCaptcha();
    }
});

// Initialize on page load
generateCaptcha();
</script>




<?php $this->load->view('partials/footer')?>