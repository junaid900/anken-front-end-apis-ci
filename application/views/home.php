<?php

// echo "<pre>";
// print_r($news);
// exit;

?>


<?php $this->load->view('partials/header_white') ?>



<style>
body {
    overflow-x: hidden;
}

/* .anken_featuredutiesarea{
		overflow-x: hidden;
	} */
.anken_section_center>div {
    float: left;
    width: 100% !important;
    margin-top: 53px;
    margin-bottom: 7px !important;
}

.anken_featuredutiesarea h1 {
    width: 100%;
    margin-left: 0px !important;
}

.hero-bg-img {
    float: left;
    width: 100%;
    margin-top: 45px;
}

.hero-bg-img .hero-img {
    float: left;
    width: 69px;
    /* margin-left: calc(50% - 50px); */
    height: 17.5px;
}

.sec-1 .sec-1-left {
    padding: 5px !important;
}

.sec-1 .sec-1-left .sec-1-left-absolute {
    top: 10px;
    left: 5px;
}

.sec-1 .sec-1-left .heading a {
    font-size: 36px;
}

.sec-1 .sec-1-right {
    padding: 5px !important;

}

.sec-1-right-text>div {
    padding: 15px !important;
    padding-bottom: 25px !important;
    height: auto;
    min-height: 232px;
    height: 232px;
}

.lightWhite {
    background-color: #f9f7f4;
}

.lightWhite .content h2 {
    font-size: 22px;
    text-align: left;
    margin: 0 0 5px;
    line-height: 22px;
}

.lightWhite .content .sub-title {
    font-size: 12px;
    padding-bottom: 13px;
    /* text-align: left; */
}

.lightWhite .sec-1-right-text-desc {
    /* font-size: 14px; */
    /* text-align: left; */
    line-height: 18px;
}

/* .read-more{
		position: relative;
		width: 100%;
	} */

.read-more .more {
    position: absolute;
    text-decoration: none;
    bottom: 5px;
    right: 55px;
    font-size: 12px;
}

.read-more .more:after {
    content: '';
    height: 13px;
    width: 25px;
    background: url(../themes/default/images/more-grey.png) no-repeat center center;
    display: block;
    position: absolute;
    right: -40px;
    top: 3px;
}

.sec-1 .sec-1-1 {
    padding-top: 8px !important;
}

.sec-1-1-box {
    background-color: #f9f7f4;
    padding: 15px !important;
    padding-bottom: 25px !important;
}

.anken_section_center .hero-heading {
    width: 100% !important;
    margin-left: 0px !important;
    margin-top: 85px !important;
}

.img-box img {
    height: 228px !important;
}

.sec-2 .col-lg-7,
.sec-2 .col-lg-5 {
    padding: 5px !important;
}

.sec-2 .lightWhite .content h2 {
    line-height: 22px;
    margin: 0 auto 20px;
}

.sec-1-1-box .lightWhite .content h2 {
    line-height: 22px;
    margin: 0 auto 20px;
}

.sec-2-1 {
    padding: 15px !important;
    padding-bottom: 25px !important;
    background-color: #f9f7f4;
    height: 240px;
}

.sec-2-2 {
    padding: 20px !important;
    padding-top: 15px !important;
    padding-bottom: 10px !important;
    background-color: #5f6062;
    height: 240px;

}

.grey-clr li {
    /* width: 50%; */
    padding: 5px 5px;
}

.grey-clr li p {
    color: white;
    line-height: 14px;
    font-size: 12px;
}

.icon-img {
    width: 30px;
    /* min-height: 30px; */
}

.rela_div h2 {
    color: #5f6062;
}

.sec-2-3 h2 {
    top: 10px;
    left: 20px;
    text-align: start;
    /* width: 55%; */
}

.sec-2-3 h2 a {
    font-weight: 600 !important;
    font-size: 36px;
}

.wrapper,
nav .wrapper,
footer .wrapper {
    margin: 0 auto;
    position: relative;
    max-width: 1200px;
}

@media (max-width: 576px) {
    .anken_section_center .hero-heading h1 {
        font-size: 20px;
        line-height: 24px;
        bottom: 135px;
    }

    .anken_section_center {
        width: 100% !important;
        height: 55vh;
        background-color: black;
    }

    /* ------------------------ */
    .sec-1 .sec-1-1 {
        padding-top: 0rem !important;
    }

    .sec-1 .sec-1-left .heading a strong {
        font-size: 21px !important;
    }

    .sec-1-left img {
        height: auto !important;
        object-fit: contain !important;
    }

    .grey-clr li p {
        padding-left: 13px !important;
    }

    .initial_word a strong {
        font-size: 25px;
    }

    .hero-bg-img .hero-img {
        float: left;
        width: 30px !important;
        /* margin-left: calc(50% - 50px); */
        height: 8px !important;
    }

    .sec-1-right-text-desc {
        margin-bottom: 0px !important;
    }

    .sec-2-2 {
        padding: 10px !important;
        padding-bottom: 30px !important;
    }

    .get-in-touch .h_link h2 span {
        font-size: 25px;
    }

    .grey-clr li {
        padding: 5px 0px !important;
    }

    .lightWhit.grey-clr .content {
        padding-left: 0px !important;
    }

    .sec-1-1-img {
        margin-top: 10px !important;
        padding: 0px !important;
    }

    .lightWhit.grey-clr .text-white {
        padding-bottom: 15px !important;
    }

    /* .col_slider_home .bx-viewport .bannerscfff li{
	width: 270px !important;
} */
}

@media (max-width: 767px) {

    .sec-1-right-text,
    .sec-1-right-text-desc {
        margin-bottom: 25px;
    }

    .wrapper .home {
        margin-top: 0px !important;
        width: 100% !important;
    }

    .sec-1-right-text>div,
    .sec-2-1 {
        height: auto !important;
    }

    .sec-2 .sec-2-col {
        margin-top: 5px !important;
        padding: 0px !important;
    }

    .sec-2-2 {
        height: auto !important;
    }

    .sec-2-2 .row .col-md-6 {
        padding-left: 0px !important;
    }

    .img-box img {
        height: auto !important;
    }

    .sec-2-3 h2 {
        left: 17px;
        text-align: start;
    }

    .sec-2-3 h2 a {
        font-size: 26px;
    }

}

@media (min-width:481px) and (max-width: 788px) {
    .sec-2 .sec-2-3 {
        display: flex !important;
    }

    .rela_div {
        width: 100%;
    }

    .img-box img {
        height: 100% !important;
    }

    .sec-2-4 {
        margin-top: 0px !important;
    }

    .sec-2-2 {
        height: 250px;
    }

}

@media only screen and (max-width: 768px) {
    .bannerscfff {
        width: auto !important;
        display: flex !important;
        flex-wrap: nowrap !important;
        overflow-x: auto !important;
        overflow-y: hidden;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
    }

    .bannerscfff li {
        flex: 0 0 auto;
        scroll-snap-align: start;

        margin-right: 10px;
    }

    /* .bx-controls-direction {
		display: none !important; 
	} */

    .bx-viewport {
        overflow-x: auto !important;
        overflow-y: hidden;
    }
}

.hide_cursor {
    cursor: default;
}

.sec-2-3 h2 a h5,
.sec-2-3 h2 a p,
.initial_word a p,
.heading a {
    font-weight: 600 !important;
    font-size: 36px;
    z-index: 999;
    position: relative;
    color: rgba(var(--bs-white-rgb), var(--bs-text-opacity)) !important;
    color: white !important;
}

.bx-clone.slider-list-item {
    width: 236px;
}

.headingBottom {
    position: static !important;
}

.img-box img {
    object-fit: cover;
}

/* .white_space{
white-space: pre-line !important;
} */
/* .six_lines{
	 display: -webkit-box;
    -webkit-line-clamp: 6; 
    -webkit-box-orient: vertical;
	
     overflow: hidden;
}
.one_lines{
	 display: -webkit-box;
    -webkit-line-clamp: 1; 
    -webkit-box-orient: vertical;
     overflow: hidden;
} */
.bx-wrapper .bx-controls {
    position: absolute;
    width: 37%;
}

.slider-list-item a {
    font-size: 11px;
}

.slider-list-item h3 {
    font-size: 22px;
}

.f-22 {
    font-size: 22px;
}

.initial_word a strong {
    font-family: 'SourceSansProSemiBold', Arial, sans-serif !important;
}

.get-in-touch .h_link h2 span {
    font-size: 36px !important;
}

.sec-2-3 h2 {
    top: 21px;
    font-weight: 600;
}

.anken_section_center {
    width: 50%;
}

@media (min-width: 999px) and (max-width: 1600px) {
    .col-lg-5 {
        flex: 0 0 auto;
        width: 39.66666667% !important;
    }

    .col-lg-7 {
        flex: 0 0 auto;
        width: 60.33333333% !important;
    }

    .get-in-touch {
        margin-top: .79rem !important;
    }
    .sec-1-right-text>div{
        min-height: 238.5px;
    }
}

@media(max-width:576px) {
    .anken_section_center {
        height: 273px !important;
    }

    .navbar {
        height: 65px !important;
    }

    .anken_section_center>div {
        margin-top: 50px !important;
    }

    .navbar .navbar-toggler {
        padding: 0 !important;
        outline: none !important;
        border: none !important;
    }

    .navbar-toggler-icon:focus-visible {
        outline: none !important;
        box-shadow: none !important;
        border: none !important;
        border-color: transparent !important;
    }

    .navbar-toggler-icon:focus {
        outline: none !important;
        box-shadow: none !important;
        border: none !important;
        border-color: transparent !important;
    }

    .anken_section_center .hero-heading {
        margin-top: 70px !important;
    }

    .anken_section_center>div {
        margin-top: 40px !important;
    }

    .navbar-toggler:focus {
        text-decoration: none;
        outline: 0;
        box-shadow: none !important;
    }

    /* slider */
    .bx-wrapper .bx-controls {
        position: absolute;
        width: 29%;
    }

    .bx-wrapper .bx-controls a.bx-prev,
    .home .bx-wrapper .bx-controls a.bx-next {
        color: #FFF;
        width: 43%;
        margin: 0;
        height: 70px;
        float: left;
        text-align: center;
        text-indent: -9999px;
    }

    .bx-wrapper .bx-controls {
        right: -4% !important;
    }

    .bx-controls.bx-has-controls-direction {
        max-width: 25% !important;
    }

    .slider-list-item h3 {
        font-size: 18px;
    }

    .getingSpace {
        margin-top: 10px !important;
    }

    .into_margin {
        margin-top: 4.5px !important;
    }

    .bx-viewport {
        height: fit-content !important;
    }
    /* .bannerscfff{
        overflow-x: scroll !important;  } */

}
</style>

<div class="anken_featuredutiesarea home-page">

    <div class="hzgift_parent_center">

        <div class="anken_section_center ">

            <div class="hero-heading">

                <h1 class="white_space"><?php echo $all_data['title_'.s_lang()]; ?></h1>

            </div>
            <div class="hero-bg-img pt-5 d-flex align-items-center justify-content-center">

                <div class="hero-img"
                    style="background: url(<?php echo base_url() . 'themes/default/images/1.png' ?>) center center / cover no-repeat;">
                </div>

            </div>

        </div>


        <div id="content" style="opacity: 1;">

            <div class="wrapper">

                <div class="home"
                    style="float:left;width:calc(100%);padding: 5px !important;background:white;margin-top:119px;">

                    <div class="col home_s"
                        style="float:left;width:calc(100% - 10px);background:black;margin: 5px !important;padding:0px;">
                        <div class="col_slider_home">
                            <div class="bx-wrapper" style="max-width: 1000px; margin: 0px auto;">
                                <div class="bx-viewport"
                                    style="width: 100%; overflow: hidden; position: relative; height: 70px;">
                                    <ul class="bannerscfff scroller scroll"
                                        style="width: 1215%; position: relative;padding:0px;margin:0px;outline:0px;">
                                        <?php foreach($locations as $location){ ?>
                                        <li class="bx-clone slider-list-item"
                                            style="float: left; list-style: none; position: relative;;padding:0px;margin:0px;outline:0px;height:70px;display: flex;flex-direction: row;justify-content:left;align-items: center;">
                                            <a class="black"
                                                href="<?= base_url().$location['slug'] ?>">
                                                <h3><?= $location['title_'.s_lang()]?></h3>
                                                <?= $location['short_description_'.s_lang()] ?>
                                            </a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="bx-controls bx-has-controls-direction">
                                    <div class="bx-controls-direction"><a class="bx-prev" href="javascript:;"
                                            onclick="toprev()"><?php echo get_phrase('Prev'); ?></a><a class="bx-next"
                                            href="javascript:;" onclick="tonext()"><?php echo get_phrase('Next'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                   var current = 0;
var total = <?= count($locations) - 4 ?>; // Use actual count of items
var autoPlayInterval;
// ======================================================================
let current_width = 236; // default

function checkWidth() {
    if (window.matchMedia("(max-width: 576px)").matches) {
        let el = document.querySelector(".home_s");
        let li_width = document.querySelectorAll(".bx-clone.slider-list-item");
        let controler = document.querySelector('.bx-has-controls-direction');
        let controllerWidth = controler.clientWidth;
        if (el) {
            current_width = el.offsetWidth;
            // ===============================================
            li_width.forEach((li, index) => {
                if (index === li_width.length - 1) { // last element
                    li.style.width = (el.offsetWidth - 63) + "px";
                } else {
                    li.style.width = el.offsetWidth + 'px';
                }
                li.style.paddingRight = controllerWidth + 'px';
            });
        }
    }
}

// Run on page load
checkWidth();

// Run on window resize
window.addEventListener("resize", checkWidth);

// ======================================================================
function tonext() {
    if (current == total) {
        current = 0;
    } else {
        current = current + 1;
    }
    $('.bannerscfff').stop().animate({
        'margin-left': '-' + (current * current_width) + 'px'
    }, 800);

    resetAutoPlay();
}

function toprev() {
    if (current == 0) {
        current = total;
    } else {
        current = current - 1;
    }
    $('.bannerscfff').stop().animate({
        'margin-left': '-' + (current * current_width) + 'px'
    }, 800);

    resetAutoPlay();
}

function startAutoPlay() {
    autoPlayInterval = setInterval(function() {
        tonext();
    }, 3000); // 3 seconds
}

function resetAutoPlay() {
    clearInterval(autoPlayInterval);
    startAutoPlay();
}

// ======================================================================
// Swipe support for mobile (only 1 slide at a time)
let startX = 0;
let startY = 0;
let endX = 0;
let endY = 0;
let isSwiping = false;

const slider = document.querySelector('.col_slider_home');

if (slider) {
    slider.addEventListener('touchstart', function(e) {
        startX = e.touches[0].clientX;
        startY = e.touches[0].clientY;
        endX = startX;
        endY = startY;
        isSwiping = true;

        // Stop autoplay while swiping
        clearInterval(autoPlayInterval);
    }, { passive: true });

    slider.addEventListener('touchmove', function(e) {
        endX = e.touches[0].clientX;
        endY = e.touches[0].clientY;
    }, { passive: true });

    slider.addEventListener('touchend', function() {
        if (!isSwiping) return;

        let diffX = startX - endX;
        let diffY = startY - endY;

        // Sirf tab swipe hoga jab horizontal move > vertical move
        if (Math.abs(diffX) > Math.abs(diffY)) {
            if (diffX > 50) {
                tonext(); // left swipe
            } else if (diffX < -50) {
                toprev(); // right swipe
            }
        }

        isSwiping = false;

        // Resume autoplay
        resetAutoPlay();
    });
}

// ======================================================================
// Start autoplay when page loads
$(document).ready(function() {
    startAutoPlay();

    // Pause on hover (desktop only)
    $('.col_slider_home').hover(
        function() {
            clearInterval(autoPlayInterval);
        },
        function() {
            resetAutoPlay();
        }
    );
});

                    </script>



                    <section>
                        <div class="row w-100 sec-1">
                            <div class="col-lg-7 col-12 sec-1-left">
                                <div class="position-relative   w-100">
                                    <img src="<?php echo base_url() . $all_data['leasing_image']['path'] ?>"
                                        style="height: 470px; object-fit: cover;" class="img-fluid w-100" alt="">
                                    <div class="position-absolute  sec-1-left-absolute ">
                                        <h2 class="h2 heading  fw-bold w-100 ">
                                            <a href="<?php echo $all_data['leasing_url'] ?>"
                                                class="text-white"><?php echo $all_data['leasing_innert_content_'.s_lang()]; ?></a>
                                        </h2>
                                    </div>
                                </div>
                                <div class="row sec-1-1">
                                    <div class="col-md-4 col-12 sec-1-1-box position-relative getingSpace">
                                        <div class="lightWhite  ">
                                            <div class="content">
                                                <h3 class="f-22">
                                                    <b><?= $all_data['page1_title_'.s_lang()] ?></b>
                                                </h3>
                                                <h3 class="sub-title m-0"></h3>

                                                <div class="sec-1-right-text-desc w-100 float-left mt-0">
                                                    <?php
														$description4 = strip_tags($all_data['page1_description_'.s_lang()]); // Strip HTML for safety
														$words4 = explode(' ', $description4);

														if (count($words4) > 31) {
															$short_description4 = implode(' ', array_slice($words4, 0, 31)) . '...';
														} else {
															$short_description4 = $description4;
														}
														?>
                                                    <?= $short_description4 ?>

                                                </div>
                                                <div class="read-more text-uppercase pt-2">
                                                    <a href="<?= $all_data['page1_url'] ?>" class="more">
                                                        <?php echo get_phrase('read_more'); ?></a>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-12 pe-0 sec-1-1-img">
                                        <a href="<?php echo base_url() .  $all_data['bottom_cover1_url'] != '#' ? $all_data['bottom_cover1_url'] : 'javascript:void(0)' ; ?>"
                                            class="<?php echo $all_data['bottom_cover1_url'] != '#' ? '' : 'hide_cursor' ; ?>"><img
                                                src="<?php echo base_url() . $all_data['bottom_cover1']['path'] ?>"
                                                class="img-fluid h-100 w-100 " alt=""></a>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-5 col-12 sec-1-right">
                                <div class="w-100">
                                    <div class="position-relative">
                                        <img src="<?php echo base_url() . $all_data['places_image']['path'] ?>"
                                            class="img-fluid w-100" alt="">
                                        <div class="position-absolute bottom-0 h2 text-white fw-bold ps-2 initial_word">
                                            <a href="<?php echo $all_data['places_url']; ?>"
                                                class="text-decoration-none position-static">
                                                <?php echo html_entity_decode($this->security->xss_clean($all_data['places_inner_content_'.s_lang()])); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row sec-1-right-text" id="content">
                                    <?php foreach ($news as $k => $new): ?>
                                    <div class="col-md-6 col-12 lightWhite position-relative">
                                        <div class="content" style="max-height: 198px; overflow:hidden">
                                            <h3 class="h2 f-22">
                                                <b><?= $new['date'] ?></b><br>
                                                <b><?= htmlspecialchars($new['title_'.s_lang()]) ?></b>
                                            </h3>

                                            <div class="sec-1-right-text-desc w-100 float-left mt-0 six_lines">
                                                <?= $new['short_description_'.s_lang()] ?>
                                            </div>

                                            <div class="read-more text-uppercase pt-2">
                                                <a href="#" class="more"><?php echo get_phrase('read_more'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>


                            </div>
                        </div>
                    </section>

                    <section>
                        <div class="row sec-2">
                            <div class="col-lg-7 px-0">
                                <div class="row">
                                    <div class="col-md-4 col-12 m-0 p-0">
                                        <div class="img-box w-100">
                                            <a href="<?php echo base_url() . $all_data['bottom_image1_url'] != '#' ? $all_data['bottom_image1_url'] : 'javascript:void(0)' ; ?>"
                                                class="img-box <?php echo $all_data['bottom_image1_url'] != '#' ? '' : 'hide_cursor' ; ?>"><img
                                                    src="<?php echo base_url() . $all_data['bottom_image1']['path'] ?>"
                                                    class="img-fluid w-100 " alt=""></a>
                                        </div>
                                        <div class="sec-2-1 position-relative mt-sm-0 mt-2">
                                            <div class="lightWhite  ">
                                                <div class="content">
                                                    <h3 class="f-22">
                                                        <b><?= $all_data['page2_title_'.s_lang()];   ?></b>
                                                    </h3>
                                                    <h3 class="sub-title m-0"></h3>

                                                    <div class="sec-1-right-text-desc w-100 float-left mt-0">
                                                        <?php
														$description3 = strip_tags($all_data['page2_description_'.s_lang()]); // Strip HTML for safety
														$words3 = explode(' ', $description3);

														if (count($words3) > 30) {
															$short_description3 = implode(' ', array_slice($words3, 0, 30)) . '...';
														} else {
															$short_description3 = $description3;
														}
														?>
                                                        <?= $short_description3   ?>


                                                    </div>
                                                    <div class="read-more text-uppercase pt-2">
                                                        <a href="<?= $all_data['page2_url'];   ?>"
                                                            class="more"><?php echo get_phrase('read_more'); ?></a>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-8 col-12  pe-0 sec-2-col">
                                        <div class="img-box into_margin">
                                            <a href="<?php echo base_url() . $all_data['bottom_cover2_url'] != '#' ? $all_data['bottom_cover2_url'] : 'javascript:void(0)' ; ?>"
                                                class="img-box <?php echo $all_data['bottom_cover2_url'] != '#' ? '' : 'hide_cursor' ; ?>"><img
                                                    src="<?php echo base_url() . $all_data['bottom_cover2']['path'] ?>"
                                                    class="img-fluid h-100 w-100 " alt=""></a>
                                        </div>
                                        <div class="sec-2-2 position-relative mt-0">
                                            <div class="lightWhit grey-clr  ">
                                                <div class="content px-2">
                                                    <h2 class="h4 ps-lg-3 text-white text-start ">
                                                        <b><?php echo get_phrase('sustainable_by_design'); ?></b>
                                                        <br />
                                                    </h2>

                                                    <div class="row w-100">
                                                        <?php 
																$features = array_slice($all_data['icon_features'], 0, 8); // limit to 8 only

																foreach ($features as $fecture) {
																?>
                                                        <div class="col-md-6 col-12">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="d-flex align-items-start">
                                                                    <span class="icon-img d-block">
                                                                        <img src="<?= base_url() . $fecture->greenIcon['path'] ?>"
                                                                            width="30px" alt="">
                                                                    </span>
                                                                    <p class="ps-2"><?= $fecture->text ?></p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <?php 
																}
																?>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-12 sec-2-3">
                                <div class="rela_div  position-relative">

                                    <h2 class="position-absolute"><a href="#"
                                            class="h_link h2  <?php echo $all_data['bottom_cover3_url'] != '#' ? '' : 'hide_cursor' ; ?>"><?php echo $all_data['bottom_cover3_description_en'] ?></a>
                                    </h2>
                                    <a href="<?php echo base_url() . $all_data['bottom_cover3_url'] != '#' ? $all_data['bottom_cover3_url'] : 'javascript:void(0)' ; ?>"
                                        class="img-box <?php echo $all_data['bottom_cover3_url'] != '#' ? '' : 'hide_cursor' ; ?>"><img
                                            src="<?php echo base_url() . $all_data['bottom_cover3']['path'] ?>"
                                            class="img-fluid h-100 w-100 " alt=""></a>

                                </div>
                                <div class="w-100 mt-2 sec-2-4 position-relative get-in-touch">
                                    <h2 class="position-absolute" style="z-index: 999;">
                                        <a href="#"
                                            class="h_link h2  <?php echo $all_data['bottom_cover4_url'] != '#' ? '' : 'hide_cursor' ; ?>"><?php echo $all_data['bottom_cover4_description_en'] ?></a>
                                    </h2>

                                    <a href="<?php echo base_url() . $all_data['bottom_cover4_url'] != '#' ? $all_data['bottom_cover4_url'] : 'javascript:void(0)' ; ?>"
                                        class="img-box <?php echo $all_data['bottom_cover4_url'] != '#' ? '' : 'hide_cursor' ; ?>"><img
                                            src="<?php echo base_url() . $all_data['bottom_cover4']['path'] ?>"
                                            class="img-fluid h-100 w-100 " alt=""></a>
                                </div>
                            </div>
                        </div>
                    </section>





                </div>

            </div>

        </div>



    </div>

</div>

<?php
function formatDateToMonthYear($date)
{
    if (!$date) return '';

    $timestamp = strtotime($date);
    return date('m.Y', $timestamp);
}

?>
<?php $this->load->view('partials/footer') ?>