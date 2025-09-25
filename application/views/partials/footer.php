<style>
    @media screen and (max-width: 600px) {

        .anken_footer_area {
            padding: 25px 0px 25px 0px;
        }

    }

    @media screen and (min-width: 600px) {

        .anken_footer_area {
            padding: 25px 0px 25px 0px;
        }

    }



    .anken_footer_area {
        position: relative;
        float: left;
        width: 100%;
        z-index: 40;
    }

    .anken_footer_area .grouplist {
        float: left;
        width: 100%;
        text-align: center;
        font-size: 12px;
        line-height: 35px;
        color: white;
    }
    .anken_section_center.footer-sec>div {
    margin-top: 0px !important;
}

    .social ul {
        float: right;
         margin: -35px 0 0;
    }
    .social ul li .icon {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    margin: 0 6px;
    border: 2px solid #231f20;
    opacity: 1;
    font-size: 18px;
    line-height: 18px;
    text-align: center;
    padding: 7px 0;
    color:#2e2729;
    display: block;
    transition: all 400ms ease-in-out;
}
    .social ul li .icon:hover {
    color: #fff;
    opacity: 1;
    border: 2px solid #fff;
}

@media (max-width: 480px) {
    .anken_section_center.footer-sec {
        height: auto;
        background-color: black;
    }
    
    .social ul {
        display: flex;
        width: 100%;
        margin: auto 0 0;
        align-items: center;
        justify-content: center;
    }
    .anken_section_centerr{
    width: 100%;
}
}
.anken_section_centerr{
    width: 96%;
}
    .anken_footer_area {
        padding: 8px 0px 25px 0px;
    }
</style>



<div class="anken_footer_area">

    <div class="hzgift_parent_center">

        <div class="anken_section_centerr footer-sec my-0 ">

            <div class="grouplist mt-0 mb-sm-0 mb-3">
 
                <?php echo get_phrase('anken_group_cap'); ?> &copy;  <?php echo get_phrase('all_rights_reserved'); ?> 2003-2025

            </div>
            <div class="social mt-0 mb-3">
                <ul class="list-unstyled d-flex float-right">
                    <li><a target="_blank" class="icon" href="https://www.linkedin.com/company/anken-group"><i class="fa fa-linkedin"></i></a></li>  
                    <li class="qrBtn"><a target="_blank" class="icon" href="https://47.242.120.2/wp-content/uploads/anken-general-CUT.jpg" data-rel="qrLightbox"><i class="fa fa-weixin"></i></a></li>
                    <li><a target="_blank" class="icon" href="https://instagram.com/ankengroup/"><i class="fa fa-instagram"></i></a></li>
                    <li><a target="_blank" class="icon" href="https://www.weibo.com/ankengreen"><i class="fa fa-weibo"></i></a></li>
                </ul>
            </div>

        </div>

    </div>

</div>
 
<script src="<?= base_url() ?>themes/default/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const toggleBtn = document.getElementById('aboutAnkenBtn');

        const megaMenu = document.getElementById('aboutAnkenMenu');



        toggleBtn.addEventListener('click', function(e) {

            e.preventDefault();

            megaMenu.style.display = (megaMenu.style.display === 'block') ? 'none' : 'block';

            megaMenu.style.opacity = 0;

            setTimeout(() => {

                megaMenu.style.opacity = 1;

            })



        });







        ptoggleBtn = document.getElementById('portfolioAnkenBtn');

        pmegaMenu = document.getElementById('portfolioAnkenMenu');

        ptoggleBtn.addEventListener('click', function(e) {

            e.preventDefault();

            pmegaMenu.style.display = (pmegaMenu.style.display === 'flex') ? 'none' : 'flex';

            pmegaMenu.style.opacity = 0;

            setTimeout(() => {

                pmegaMenu.style.opacity = 1;

            })

        });

        document.addEventListener('click', function(e) {

            if (!toggleBtn.contains(e.target) && !megaMenu.contains(e.target)) {

                megaMenu.style.display = 'none';

                megaMenu.style.opacity = 0;

            }

            if (!ptoggleBtn.contains(e.target) && !pmegaMenu.contains(e.target)) {

                pmegaMenu.style.display = 'none';

                pmegaMenu.style.opacity = 0;

            }

        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Toggle mobile mega menu

        // .mobile-mega-menu

        const mobileMenuToggles = document.querySelectorAll('.mobile-menu-toggle');

        mobileMenuToggles.forEach(toggle => {

            toggle.addEventListener('click', function(e) {

                e.preventDefault();

                const megaMenu = this.nextElementSibling;

                if (megaMenu.style.display === 'block') {

                    megaMenu.style.display = 'none';

                } else {

                    megaMenu.style.display = 'block';

                }

            });

        });

        const megaMenu = document.querySelectorAll('.mobile-menu-title');



        megaMenu.forEach(menuItem => {

            const megaMenu = menuItem.nextElementSibling;

            megaMenu.style.display = 'none';

            menuItem.addEventListener('click', function(e) {

                if (megaMenu.style.display == "none") {

                    megaMenu.style.display = 'block';

                } else {

                    megaMenu.style.display = 'none';

                }

            })

        })

        // Desktop mega menu hover effect

        // const aboutAnkenBtn = document.getElementById('aboutAnkenBtn');

        // const aboutAnkenMenu = document.getElementById('aboutAnkenMenu');



        // if (aboutAnkenBtn && aboutAnkenMenu) {

        //     aboutAnkenBtn.addEventListener('mouseenter', function() {

        //         if(aboutAnkenMenu.style.display == 'flex')

        //         aboutAnkenMenu.style.display = 'flex';

        //     });



        //     aboutAnkenMenu.addEventListener('mouseleave', function() {

        //         aboutAnkenMenu.style.display = 'none';

        //     });

        // }

    });
</script>
<!-- language code start from here -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script>
    $('documant').ready(function() {
       let session_lang = '<?= $this->session->userdata('current_language') ?>';
        if(session_lang == 'english') {
            $('#language_changer').text('中文');
        } else {
            $('#language_changer').text('EN');
        }
    });
    $('#language_changer').on('click', function() {

        // let selectedLang = $('#language_changer').text().trim();
        // console.log(selectedLang);
        let lang = '<?= $this->session->userdata('current_language') ?>' || 'english';
        if (lang == 'english') {
            lang = 'chinese';
        } else {
            lang = 'english';
        }
        $.ajax({
            url: "<?= base_url() ?>language",
            type: "POST",
            data: { lang: lang },
            success: function(response) {
                console.log("Language changed to: " + lang);
                
                console.log(response);
                location.reload();
                
            }
        });
    });
</script>



<!-- language code end frm here  -->

<script src="https://kit.fontawesome.com/fb160fa803.js" crossorigin="anonymous"></script>

</body>

</html>
