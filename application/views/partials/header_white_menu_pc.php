<?php
   
//    echo s_lang();
//    exit;
    $menu = $this->session->userdata('menu');

  
$CI =& get_instance();
$CI->load->database(); 
$CI->load->model('Nav_model');
$portfolio_data = $CI->Nav_model->portfolio_model();
$about_data = $CI->Nav_model->about_model();
$portfolio_url = base_url();
$about_url =  base_url() ;
?>

<style>
.navbar-dark {
    background-color: #000 !important;
}

.navbar {
    height: 140px;
    align-items: start;
}

.navbar-dark .nav-link,
.mega-menu .dropdown-item {
    color: #fff;
    font-size: 14px;
    font-weight: bold;
}

.navbar-dark .nav-link:hover {
    color: #333 !important;
}

.mega-menu {
    display: none;
    position: absolute;
    left: 0;
    top: 100%;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    padding: .5rem .5rem;
    z-index: 999;
}

.mega-menu {
    transition: opacity ease .8s;
}

.mega-item {
    margin: 0 0 6px;
    padding-bottom: 8px;
    border-bottom: 1px solid #fff;
}

.mega-menu-section {
    padding: 25px;
    padding-top: 48px !important;
}

.mega-sec-menu-title {
    color: #FFF;
    padding-bottom: 20px;
    margin-bottom: 20px;
    border-bottom: 2px solid #FFF;
    font-size: 22px;
    font-weight: bold;
    line-height: 24px;
    text-transform: uppercase;
}

.navbar-toggler {
    border-color: rgba(255, 255, 255, 0.1);
}
header nav .wrapper .navDrop li a{
        font-weight: bold !important;
}

.logo {
    display: block;
    float: left;
    background-size: 100%;
    margin: 32.5px 0 0;
    width: 250px;
    height: 75px;
    text-indent: -99999px;
}

.btn-white-outline {
    border: 1px solid #fff;
    color: #fff;
    background: transparent;
    padding: 4px 12px;
    font-size: 14px;
    margin-left: 10px;
}

.btn-white-outline:hover {
    background: #222;
    color: #fff;
}

.btn-main-nav {
    /*margin-right: 0 !important;*/
}

.nav-link {
    display: block !important;
    color: #FFF !important;
    font-size: 16px !important;
    margin: 58px 18.6px 0;
    padding: 0px !important;
    text-transform: uppercase !important;
    text-decoration: none !important;
}

.institut_menu {
    border-right: none;
    margin-left: 25px;
    margin: 29px 0 0;
}

.m-wrapper {
    margin: 0 auto;
    position: relative;
    max-width: 1200px;
    width: 96%;
}

.logoarea {
    width: min-content !important;
}

/* Mobile Drawer Styles */
.offcanvas {
    background-color: #000;
    color: #fff;
}
ul li {
    list-style: none !important;
}
.offcanvas-header {
    padding: 20px;
    border-bottom: 1px solid #333;
}

.offcanvas-body {
    padding: 0;
}

.mobile-nav-item {
    padding: 15px 20px;
    border-bottom: 1px solid #333;
    font-size: 16px;
    text-transform: uppercase;
}

.mobile-nav-item a {
    color: #fff;
    text-decoration: none;
    display: block;
}

.mobile-mega-menu {
    padding-left: 20px;
    padding-top: 12px;
    display: none;
}

.mobile-mega-menu a {
    padding: 10px 0;
    display: block;
    color: #ccc;
    font-size: 14px;
}

.mobile-menu-title {
    cursor: pointer;
}

.navbar .navbar-toggler {
    float: right;
    margin-top: 25px;
}
.navbar-nav .nav-item .nav-link{
    font-weight: 600 !important;
}

.dropdown-item

.navbar li {
    list-style: none;
}

@media (max-width: 1140px) {
    .logo {
        margin: 20px 0 0;
        width: 130px !important;
        height: 39px !important;
    }

    .nav-link {
        margin: 27px 16px 0;
    }

    .navbar-collapse {
        display: none !important;
    }
}

@media (min-width: 1141px) {
    .navbar-toggler {
        display: none !important;
    }

    .offcanvas {
        display: none !important;
    }
}
.nav-link li {
    cursor: pointer;
}


/* =============== */
.institut_whitemenu .list #language_changer{
    padding: 20px;
}
.institut_whitemenu .list_off2 {
    padding-left: 27px !important;
    padding-right: 27px !important;
}
#language_changer {
    padding-left: 22px !important;
    padding-right: 22px !important;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark p-0">
    <div class="m-wrapper anken_menu_list">
        <a class="section navbar-brand logoarea" href="<?= base_url() ?>">
            <div class="logo">ANKEN Logo</div>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenuDrawer">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Desktop Menu -->
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <!-- about ANKEN with Mega Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="#" id="aboutAnkenBtn"><?= get_phrase("About_ANKEN") ?></a>
                    <div class="mega-menu row" id="aboutAnkenMenu">
                        <div class="col-md-3 mega-menu-section">
                            <div>
                                <p class="mega-sec-menu-title"><?= get_phrase("OUR_APPROACH") ?></p>
                            </div>
                            <?php foreach ($about_data as $item) : ?>
                            <div class="mega-item"><a class="dropdown-item"
                                    href="<?php echo $about_url . $item['slug']  ?>"><?php echo $item['title_'.s_lang()]; ?></a>
                            </div>
                            <?php endforeach; ?>
                            <!-- <div class="mega-item"><a class="dropdown-item"
                                    href="<?= base_url() ?>about-us/positive-impact">Positive Impact</a></div>
                            <div class="mega-item"><a class="dropdown-item"
                                    href="<?= base_url() ?>about-us/anken-milestones/">ANKEN Milestones</a></div>
                            <div class="mega-item"><a class="dropdown-item"
                                    href="<?= base_url() ?>about-us/services">Services</a></div>
                            <div class="mega-item"><a class="dropdown-item"
                                    href="<?= base_url() ?>about-us/our-shanghai">Our Shanghai</a></div>
                            <div class="mega-item"><a class="dropdown-item"
                                    href="<?= base_url() ?>about-us/cultivate-with-care">ANKEN = Cultivate with Care</a>
                            </div>
                            <div class="mega-item"><a class="dropdown-item"
                                    href="<?= base_url() ?>about-us/build-more-with-less">Build More with Less</a></div>
                            <div class="mega-item"><a class="dropdown-item"
                                    href="<?= base_url() ?>about-us/brand-stories">Places Made of People</a></div> -->
                        </div>
                    </div>
                </li>
                <?php
                $portMenuTitles = [
                            ["t" => "ANKEN Avenue", "url" => base_url() . "our-portfolio/anken-avenue/"],
                            ["t" => "ANKEN Air", "url" => base_url() . "our-portfolio/anken-air/"],
                            ["t" => "Australia House", "url" => base_url() . "our-portfolio/australia-house/"],
                            ["t" => "Warehouse Cafe – ANKEN Life", "url" => base_url() . "our-portfolio/warehouse-cafe/"],
                        
                            ["t" => "ANKEN Access", "url" => base_url() . "our-portfolio/anyuan/"],
                            ["t" => "363 Changping", "url" => base_url() . "our-portfolio/363-chang-ping/"],
                            ["t" => "ANKEN Alley", "url" => base_url() . "our-portfolio/anken-alley/"],
                            ["t" => "Warehouse Cafe – ANKEN Air", "url" => base_url() . "our-portfolio/warehouse-cafe-2/"],
                        
                            ["t" => "ANKEN XUHUI", "url" => base_url() . "our-portfolio/puhuitang/"],
                            ["t" => "ANKEN Life", "url" => base_url() . "our-portfolio/anken-life/"],
                            ["t" => "406-1 Jianguo Rd", "url" => base_url() . "our-portfolio/jianguo-lu/"],
                            ["t" => "Warehouse Cafe – ANKEN Green", "url" => base_url() . "our-portfolio/warehouse-cafe-2-2/"],
                        
                            ["t" => "ANKEN Green", "url" => base_url() . "our-portfolio/anken-green/"],
                            ["t" => "ANKEN Warehouse", "url" => base_url() . "our-portfolio/anken-warehouse/"],
                            ["t" => "2 Tianjin Rd", "url" => base_url() . "our-portfolio/tianjin-road-2/"],
                            ["t" => "Cafelito", "url" => base_url() . "our-portfolio/cafelito/"],
                        
                            ["t" => "Shanghai Antiques Museum", "url" => base_url() . "our-portfolio/shanghai-antiques-museum/"],
                            ["t" => "Jinxian Rd", "url" => base_url() . "our-portfolio/jinxian-road/"]
                        ];
                    ?>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="portfolioAnkenBtn"><?= get_phrase("Our_Portfolio") ?></a>
                    <div class="mega-menu p-20 w-row" id="portfolioAnkenMenu">
                        <div class="w-md-80 p-10 mega-menu-section">
                            <div class="me-3 ms-3">
                                <p class="mega-sec-menu-title"><?= get_phrase("Anken_Properties") ?></p>
                            </div>
                            <div class="row justify-content-center">
                              <?php foreach ($portfolio_data as $pMenuItem){ 
                                    if($pMenuItem['page_type'] != 'anken_properties') continue;
                              ?>
                                    <div class="col-md-3 pe-0 ps-0">
                                        <div class="mega-item me-3 ms-3">
                                            <a class="dropdown-item" href="<?= $portfolio_url . $pMenuItem["slug"] ?>">
                                                <?= $pMenuItem["title_".s_lang()] ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>


                            </div>
                        </div>
                        <div class="w-md-20 p-10 mega-menu-section">
                            <div class="">
                                <p class="mega-sec-menu-title border-0"><?= get_phrase("LATEST_RELEASE") ?></p>
                            </div>
                            <div class="row justify-content-center">
                                <?php foreach ($portfolio_data as $pMenuItem){ 
                                    if($pMenuItem['page_type'] != 'latest_release') continue;
                                ?>
                                <div class="col-md-12">
                                    <div class="mega-item"><a class="dropdown-item"
                                            href="<?= $portfolio_url . $pMenuItem["slug"] ?>"><?= $pMenuItem["title_".s_lang()] ?></a></div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="w-md-100 p-10 mega-menu-section">
                            <div class="me-0 ms-3">
                                <p class="mega-sec-menu-title" style="font-size: 16px"><?= get_phrase("Track_Records") ?></p>
                            </div>
                            <div class="w-row">
                                <?php foreach ($portfolio_data as $pMenuItem){ 
                                    if($pMenuItem['page_type'] != 'track_records') continue;
                                ?>
                                <div class="w-md-20 pe-0 ps-0">
                                    <div class="mega-item me-3 ms-3"><a class="dropdown-item"
                                            href="<?= $portfolio_url . $pMenuItem["slug"] ?>"><?= $pMenuItem["title_".s_lang()] ?></a></div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="w-md-100 pb-10"></div>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url("event") ?>"><?= get_phrase("News_&_Events") ?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url("our-company") ?>"><?= get_phrase("Our_Company") ?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url("contact") ?>"><?= get_phrase("Contact") ?></a></li>
                <ul class="nav-link mt-0 me-0">
                    <li class="nav-item institut_menu institut_whitemenu me-0" onclick="window.open('https://accounts.creams.io/login?change-login-account', '_self')">
                        <div class="list list_off2 fw-bold px-md-4" style="margin-left:-2px;"><?php echo get_phrase('login_txt') ?></div>
                    </li>
                    <li class="nav-item institut_menu institut_whitemenu">
                        <div class="list list_off2 fw-bold px-md-4" id="language_changer">中文</div>
                    </li>
                </ul>
            </ul>
        </div>
    </div>
</nav>

<!-- Mobile Menu Drawer -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenuDrawer">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">MENU</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="mobile-nav-item">
            <div class="mobile-menu-title">about ANKEN</div>
            <div class="mobile-mega-menu">
                <?php foreach ($about_data as $item) : ?>
                    <a href="<?php echo $about_url . $item['slug']  ?>"><?php echo $item['title_'.s_lang()]; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="mobile-nav-item">
            <a class="mobile-menu-title">Our Portfolio</a>
            <div class="mobile-mega-menu">
                <?php foreach($portfolio_data as $pitem){ ?>
                <a href="<?= $portfolio_url . $pitem["slug"] ?>"><?= $pitem['title_'.s_lang()]; ?></a>
                <?php } ?>
            </div>
        </div>
        <div class="mobile-nav-item">
            <a href="<?= base_url("event") ?>">News & Events</a>
        </div>
        <div class="mobile-nav-item">
            <a href="<?= base_url("our-company") ?>">Our Company</a>
        </div>
        <div class="mobile-nav-item">
            <a href="<?= base_url("contact") ?>">Contact Us</a>
        </div>
        <div class="mobile-nav-item">
            <a href="#">中文</a>
        </div>
        <div class="mobile-nav-item">
            <a href="#">Login</a>
        </div>
    </div>
</div>

<!-- JavaScript for Mobile Menu Toggle -->





