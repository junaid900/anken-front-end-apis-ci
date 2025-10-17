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
        width: 75px;
        /* margin-left: calc(50% - 50px); */
        height: 19.8px;
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
        padding: 3px 5px;
    }
    
    .grey-clr li p {
        color: white;
        line-height: 16px;
        font-size: 12px;
        padding-left: 10px;
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
            padding-bottom: 12px !important;
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
        width: 100%;
    }
    .sustainable-heading{
        font-size:22px;
    }
    
    @media (min-width: 999px) and (max-width: 1600px) {
        .col-lg-5 {
            flex: 0 0 auto;
            width: 40% !important;
        }
    
        .col-lg-7 {
            flex: 0 0 auto;
            width: 60% !important;
        }
    
        .get-in-touch {
            margin-top: .79rem !important;
        }
        .sec-1-right-text>div{
            min-height: 238.5px;
        }
        #main_image_div .col-md-4,
        #intro_data_div .col-md-4{
            width: 32.333333% !important;
        }
        #main_image_div .col-md-8,
         #intro_data_div .col-md-8
         {
            width: 67.666667%;
        }
        #main_image_div .intro_div{
            padding: 24px 36px !important;
            padding-top:14px !important;
        }
    }
    .h_link.h2 span{
        font-size: 36px !important;
        font-weight: 600;
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
        .get-in-touch .h_link h2 span {
            font-size: 25px !important;
        }
        .h_link.h2 span{
              font-size: 25px !important;
        }
        #main_image_div .intro_div{
            padding: 14px 14px !important;
            padding-top:14px !important;
        }
        /* .bannerscfff{
            overflow-x: scroll !important;  } */
    }
    .anken_about_data_text {
        font-size: 36px !important;
    }
    
    .content h3{
        line-height: 24px !important;
    }
    .content .custom-group{
        font-size: 12px !important;
    }
    .white_space{
        white-space: pre-line !important;
    }
    
    
    @media(min-width:1600px){
        .hero-bg-img .hero-img {
                float: left;
                width: 89px;
                height: 25px;
        }
    }
    
    .bx-viewport { overflow: hidden; position: relative; }
    .bannerscfff.scroller {
      display: flex;
      padding: 0;
      margin: 0;
      list-style: none;
      /* keep jQuery animate margin-left working */
      will-change: margin-left;
      box-sizing: border-box;
    }
    .bx-clone.slider-list-item {
      flex: 0 0 auto; /* width set by JS */
      box-sizing: border-box;
      padding: 0;
      margin: 0;
      height: 70px;
      display: flex;
      align-items: center;
    }
    .bx-clone.slider-list-item a { display:block; padding: 0 10px; text-decoration:none; }
    /**/
    .bx-clone.slider-list-item a {
      display: block;
      width: 100%;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      box-sizing: border-box;
    }
    
    /* Make sure the title and short description both respect width */
    .bx-clone.slider-list-item h3 {
      margin: 0;
      /*font-size: 16px;*/
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
    }
    
    .bx-clone.slider-list-item p,
    .bx-clone.slider-list-item span,
    .bx-clone.slider-list-item div {
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
      margin: 0;
      display: block;
    }
    .short-description {
      display: block;
      overflow: hidden;
      white-space: nowrap;
      text-overflow: ellipsis;
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
                                            <?php
                                            if($location['is_home'] != 1){
                                                continue;
                                            }else{
                                            ?>
                                            <li class="bx-clone slider-list-item"
                                                style="float: left; list-style: none; position: relative;;padding:0px;margin:0px;outline:0px;height:70px;display: flex;flex-direction: row;justify-content:left;align-items: center;">
                                                <a class="black"
                                                    href="<?= base_url().$location['slug'] ?>">
                                                    <h3><?= $location['title_'.s_lang()]?></h3>
                                                    <span class="short-description"><?= $location['short_description_'.s_lang()] ?></span>
                                                </a>
                                            </li>
                                            <?php } ?>
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
               

(function($){
  // ================= VARIABLES ==================
  const $viewport = $('.bx-viewport');
  const $list = $('.bannerscfff.scroller');
  let $items = $list.find('.bx-clone.slider-list-item');
  const sliderContainer = document.querySelector('.col_slider_home') || document.querySelector('.bx-viewport');

  let itemCount = $items.length;
  let itemsPerView = 4;
  let slideWidth = 236;
  let current = 0;
  let maxIndex = Math.max(0, itemCount - itemsPerView);
  let autoPlayInterval = null;

  const AUTOPLAY_DELAY = 10000;
  const ANIM_SPEED = 800;

  // ================= HELPERS ==================
  function calculateItemsPerView() {
    const w = window.innerWidth;
    if (w <= 576) return 1; // phone
    if (w <= 768) return 2; // small tablet
    if (w <= 992) return 3; // tablet
    return 4; // desktop
  }

  function layout() {
    let containerWidth = $viewport.width() || $list.parent().width();
    // const adjustButtonsWidth = $('.bx-prev').width() + $('.bx-next').width();
    // containerWidth = containerWidth - adjustButtonsWidth
    itemsPerView = calculateItemsPerView();
    slideWidth = Math.floor(containerWidth / itemsPerView);
    $items.each(function(i, el){ $(el).css('width', slideWidth + 'px'); });

    itemCount = $items.length;
    maxIndex = Math.max(0, itemCount - itemsPerView);
    if (current > maxIndex) current = maxIndex;
    slideToCurrent(false);
  }

  function slideToCurrent(animate = true) {
    const ml = -(current * slideWidth);
    if (animate) $list.stop().animate({'margin-left': ml + 'px'}, ANIM_SPEED);
    else $list.css('margin-left', ml + 'px');
  }

  // ================= SLIDER CONTROLS ==================
  function tonext() {
    if (current >= maxIndex) current = 0;
    else current++;
    slideToCurrent(true);
    resetAutoPlay();
  }

  function toprev() {
    if (current <= 0) current = maxIndex;
    else current--;
    slideToCurrent(true);
    resetAutoPlay();
  }

  // ================= AUTOPLAY ==================
  function startAutoPlay() {
    stopAutoPlay();
    autoPlayInterval = setInterval(tonext, AUTOPLAY_DELAY);
  }

  function stopAutoPlay() {
    if (autoPlayInterval) {
      clearInterval(autoPlayInterval);
      autoPlayInterval = null;
    }
  }

  function resetAutoPlay() {
    stopAutoPlay();
    startAutoPlay();
  }

  // ================= SWIPE SUPPORT ==================
  function addTouchSupport() {
    if (!sliderContainer) return;
    let startX = 0, startY = 0, endX = 0, endY = 0, isSwiping = false;

    sliderContainer.addEventListener('touchstart', function(e){
      startX = e.touches[0].clientX;
      startY = e.touches[0].clientY;
      endX = startX; endY = startY;
      isSwiping = true;
      stopAutoPlay();
    }, {passive:true});

    sliderContainer.addEventListener('touchmove', function(e){
      if (!isSwiping) return;
      endX = e.touches[0].clientX;
      endY = e.touches[0].clientY;
    }, {passive:true});

    sliderContainer.addEventListener('touchend', function(){
      if (!isSwiping) return;
      const diffX = startX - endX;
      const diffY = startY - endY;
      if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 40) {
        if (diffX > 0) tonext(); else toprev();
      }
      isSwiping = false;
      resetAutoPlay();
    });
  }

  // ================= HOVER (PAUSE AUTOPLAY ON DESKTOP) ==================
  const hoverTarget = $('.col_slider_home').length ? $('.col_slider_home') : $viewport;
  hoverTarget.hover(stopAutoPlay, resetAutoPlay);

  // ================= INIT ==================
  $(document).ready(function(){
    layout();
    window.addEventListener('resize', debounce(layout, 150));
    addTouchSupport();
    startAutoPlay();
  });

  // ================= UTIL ==================
  function debounce(fn, wait){
    let t;
    return function(){ clearTimeout(t); t = setTimeout(fn, wait); };
  }

  // ✅ expose globally so HTML onclick works
  window.tonext = tonext;
  window.toprev = toprev;

})(jQuery);

                    </script>



                    <section>
                        <div class="row w-100 sec-1" id="intro_data_div">
                            <div class="col-lg-7 col-12 sec-1-left">
                                <div class="position-relative   w-100">
                                    <a href="<?php echo $all_data['leasing_url'] ?>" class="<?php echo $all_data['leasing_url'] != '#' ? '' : 'hide_cursor' ; ?>">
                                    <img src="<?php echo base_url() . $all_data['leasing_image']['path'] ?>"
                                        style="height: 470px; object-fit: cover;" class="img-fluid w-100" alt=""></a>
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
                                        <a href="<?php echo $all_data['places_url']; ?>" class="<?php echo $all_data['places_url'] != '#' ? '' : 'hide_cursor' ; ?>">
                                        <img src="<?php echo base_url() . $all_data['places_image']['path'] ?>"
                                            class="img-fluid w-100" alt=""></a>
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
                                            <h3 class="h2 f-22 d-introduction_<?php echo $k ?>">
                                                <b><?= $new['date'] ?></b><br>
                                                <b><?= htmlspecialchars($new['title_'.s_lang()]) ?></b>
                                            </h3>

                                            <div class="sec-1-right-text-desc w-100 float-left mt-0 six_lines">
                                                <?= $new['short_description_'.s_lang()] ?>
                                            </div>

                                            <div class="read-more text-uppercase pt-2">
                                                <a href="<?= base_url('events') ?>" class="more"><?php echo get_phrase('read_more'); ?></a>
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
                                <div class="row" id="main_image_div">
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
                                        <div class="sec-2-2 position-relative mt-0 intro_div">
                                            <div class="lightWhit grey-clr  ">
                                                <div class="content px-2">
                                                    <h2 class="h4 ps-lg-2 mb-lg-3 text-white text-start sustainable-heading">
                                                        <?php echo get_phrase('sustainable_by_design'); ?>
                                                        <br />
                                                    </h2>

                                                    <div class="row w-100">
                                                        <?php 
																$features = array_slice($all_data['icon_features'], 0, 8); // limit to 8 only

																foreach ($features as $fecture) {
																?>
                                                        <div class="w-md-50 w-sm-100 p-0">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="d-flex align-items-start">
                                                                    <span class="icon-img d-block">
                                                                        <img src="<?= base_url() . $fecture->greenIcon['path'] ?>"
                                                                            width="30px" alt="">
                                                                    </span>
                                                                    <p class=""><?php echo s_lang() == 'en' ? $fecture->text : $fecture->text_ch; ?></p>
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

                                    <h2 class="position-absolute"><span style="z-index:999;"
                                            class="h_link h2 position-relative   <?php echo $all_data['bottom_cover3_url'] != '#' ? '' : 'hide_cursor' ; ?>"><?php echo $all_data['bottom_cover3_description_'.s_lang()] ?></span>
                                    </h2>
                                    <a href="<?php echo base_url() . $all_data['bottom_cover3_url'] != '#' ? $all_data['bottom_cover3_url'] : 'javascript:void(0)' ; ?>"
                                        class="img-box <?php echo $all_data['bottom_cover3_url'] != '#' ? '' : 'hide_cursor' ; ?>"><img
                                            src="<?php echo base_url() . $all_data['bottom_cover3']['path'] ?>"
                                            class="img-fluid h-100 w-100 " alt=""></a>

                                </div>
                                <div class="w-100 mt-2 sec-2-4 position-relative get-in-touch">
                                    <h2 class="position-absolute" style="z-index: 999;">
                                        <span
                                            class="h_link h2 anken_about_data_text  <?php echo $all_data['bottom_cover4_url'] != '#' ? '' : 'hide_cursor' ; ?>"><?php echo $all_data['bottom_cover4_description_'.s_lang()] ?></span>
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