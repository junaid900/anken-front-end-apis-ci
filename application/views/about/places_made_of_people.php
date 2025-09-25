
<?php 
// echo '<pre>';
// print_r($page);
// exit;
?>



<?php $this->load->view('partials/header_white')?>

<style>
.custom-popup {
  display: none;
  position: fixed;
  z-index: 9999;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100vw;
  background: transparent; /* glass dark effect */
  overflow-y: auto;
}
.c-popup-content{
    padding: 30px;
    position: relative;
    max-width: 600px;
    height: 70vh;  
    background: rgba(0, 0, 0, 0.85);
    margin: 5% auto;
    overflow: hidden;
}
.popup-content {
  color: white;
  border-radius: 0px;
  width: 100%;
    height: 63vh;
  overflow: auto; 
}

.close-btn {
  position: absolute;
  top: 0px;
  right: 8px;
  font-size: 28px;
  cursor: pointer;
  color: white;
}
#popupOverlay{
  background: rgba(0, 0, 0, 0.4);
}
 .contact .featureImg{
    height: 100% !important;
  }
/*==================================== */
#hover_card .card .static-overlay{
  background: rgba(0, 0, 0, 0.4);
}
@media(max-width: 576px){
  .anken_section_center{
    width: 100% !important;
  }
  .contact .featureImg{
    height: 100% !important;
  }
  .bottom .bottom-item-img{
    height: 100% !important;
  }
  #hover_card .card{
     height: 100% !important;
  }
  .c-popup-content{
    width: 340px !important;
  }
}
</style>


<div class="anken_featuredutiesarea">

    <div class="hzgift_parent_center">

    	<div class="anken_section_center">

			<div class="page-container">

                  <div class="container-fluid page-content bg-light contact company p-5">

                      <div class="w-row">

                        <div class="w-md-40 p-5">

                            <div class="form-container c-left">

                                <!--<h5 class="large-bold-heading"><?php echo $page['short_description_'.s_lang()]?></h5>-->

                                <?php echo $page['page_description_'.s_lang()]?>

                                <!--<p class="f-14">Asset and Finance Management. Our asset and finance management approaches are focused on returning maximum value to our stakeholders, based on clear and transparent communication and collaboration.</p>-->

                            </div>

                        </div>

                        <div class="w-md-60 c-white-room p-5">

                          <img src="<?= base_url() . $page['top_image']['path'] ?>" onerror="this.onerror=null; this.src='<?= base_url('themes/assets/images/31343C.svg'); ?>';"  class="img-fluid featureImg" alt="Interior">

                        </div>

                      </div>

                

                      <!-- Contact Form and Details -->

                        <div class="w-row  bottom" id="hover_card">

                         <?php foreach($page['properties'] as $data): ?>
                                <div class="w-sm-50 w-md-25 w-lg-20 p-5">
                                    <div class="bottom-item-img card p-0 m-0">
                                        <img 
                                            src="<?= base_url().$data["image"]["path"] ?>" 
                                            class="img-fluid who_we_are_bottom_img" 
                                            alt="Interior"
                                            onerror="this.onerror=null; this.src='<?= base_url('themes/assets/images/placeholder.jpg') ?>';"
                                        >
                                        <?php if(isset($data["title_" . s_lang()]) && $data["title_" . s_lang()] != '#'){ ?>
                                        <div class="static-overlay">
                                            <div class="txt_name"><?= $data["title_" . s_lang()] ?></div>
                                            <div class="txt_desig"><?= $data["short_description_".s_lang()] ?></div>
                                            <div class="txt_link">
                                                <a data-rel="pop_disp_1" class="open-popup" href="#"><?= get_phrase("MORE") ?><span class="txt_name_img"></span></a>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php if(isset($data["title_" . s_lang()]) && $data["title_" . s_lang()] != '#'){ ?>
                                <div id="popupOverlay" class="custom-popup">
                                    <div class="c-popup-content">
                                        <div class="popup-content">
                                            <span class="close-btn">&times;</span>
                                             <?= $data["description_".s_lang()] ?>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

                            <?php endforeach; ?>


                        </div>

                      

                      

                  </div>

        </div>

    </div>

</div>


<script>
// document.querySelectorAll(".open-popup").forEach(function(link) {
//   link.addEventListener("click", function(e) {
//     e.preventDefault();
//     document.getElementById("popupOverlay").style.display = "block";
//   });
// });

// document.querySelector(".close-btn").addEventListener("click", function() {
//   document.getElementById("popupOverlay").style.display = "none";
// });
document.querySelectorAll(".open-popup").forEach(function(link) {
  link.addEventListener("click", function(e) {
    e.preventDefault();
    // Find the popup next to this card
    let popup = link.closest(".w-sm-50, .w-md-25, .w-lg-20").nextElementSibling;
    popup.style.display = "block";
  });
});

document.querySelectorAll(".custom-popup .close-btn").forEach(function(btn) {
  btn.addEventListener("click", function() {
    btn.closest(".custom-popup").style.display = "none";
  });
});
window.addEventListener("click", function(e) {
  const popup = document.getElementById("popupOverlay");
  if (e.target === popup) {
    popup.style.display = "none";
  }
});
</script>



<?php $this->load->view('partials/footer')?>

<?php exit;?>