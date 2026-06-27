<? $template = 190;
include_once('../../subdominio_ini.php');
$edit_param = '';
if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
  $edit_param = "&mode=edit";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="shortcut icon" href="../../favicon.ico" />

  <meta name="description" content="<?php echo (!empty($rowUSU['meta_descripcion'])) ? $rowUSU['meta_descripcion'] : 'vioniko.com - Document'; ?>" />


  <script src="js/vendor/jquery.js"></script>
  <?php if (!empty($edit_param)): ?>
    <script src="../../js/landinpage/bootstrap-colorpicker.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="../../js/vendor/ckeditor/ckeditor.js"></script>
    <script src="../../js/vendor/ckeditor/ckeditor_config.js"></script>
    <script src="../../js/landinpage/landing-page-editor-custom-es.js"></script>

  <?php endif; ?>
  <!-- Template Custom Style -->
  <link href="css/template-style.css" rel="stylesheet">
  <link rel="stylesheet" href="output.css" />
  <link rel="stylesheet" href="style.css" />

  <?php
  include_once "../../usuarios/functions.php";
  echo getUserPixelCode($rowUSU["clave"], "fbpixel_lp");
  ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#logo").attr("onclick", "imageSectionEdit(this.id); openNav(); ");
      $("#box-1").attr("onclick", "imageSectionEdit(this.id); openNav(); ");
      $("#box-2").attr("onclick", "imageSectionEdit(this.id); openNav(); ");
      $("#box-3").attr("onclick", "imageSectionEdit(this.id); openNav(); ");
      $("#footer-avatar").attr("onclick", "imageSectionEdit(this.id); openNav(); ");

    });
  </script>
  <script>
    $(document).ready(function() {
      $(document).on("mouseleave", function(event) {
        if (!event.relatedTarget || event.relatedTarget.nodeName === "HTML") {
          //   $(".popup-inner").css("height", "600px");
          $("#mySidenav").css("z-index", "99");
          $('#popup-form').css({
            'visibility': 'visible',
            'opacity': '1'
          });

          $(document).off("mouseleave");
        }
      });

      $(".show-popup-form").click(function() {
        $("#mySidenav").css("z-index", "99");
        $('#popup-form').css({
          'visibility': 'visible',
          'opacity': '1'
        });
      });

      $(".innerInput").focusout(function() {
        if ($(this).val() === "") {
          $(this).css("border-color", "red");
        } else {
          $(this).css("border-color", "");
        }
      });

      $(".close").click(function() {
        $('#popup-form').css({
          'visibility': 'hidden',
          'opacity': '0'
        });
      });
    });
  </script>
  <?php if (empty($edit_param)): ?>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".edit-btn-container").forEach(function(el) {
          el.style.display = "none";
        });
        document.querySelectorAll(".hover-edit").forEach(function(el) {
          el.classList.remove("hover-edit");
        });
        document.querySelectorAll(".new").forEach(function(el) {
          el.addEventListener("mouseover", function() {
            var editBtn = el.querySelector(".edit-btn-container:nth-child(1)");
            if (editBtn) {
              editBtn.style.opacity = 0;
            }
          });
        });
        document.querySelectorAll(".temp-footer").forEach(function(el) {
          el.addEventListener("mouseover", function() {
            var editBtn = el.querySelector(".edit-btn-container:nth-child(1)");
            if (editBtn) {
              editBtn.style.opacity = 0;
            }
          });
        });
        document.querySelectorAll(".section-bg").forEach(function(el) {
          el.querySelectorAll(".new").forEach(function(child) {
            child.classList.remove("new");
          });
          el.querySelectorAll(".temp-footer").forEach(function(child) {
            child.classList.remove("temp-footer");
          });
        });
        document.querySelectorAll(".save-btn").forEach(function(el) {
          el.style.display = "none";
        });
        var popupInner = document.querySelector(".popup-inner");
        if (popupInner) {
          popupInner.style.height = "450px";
        }
        var whatsappShowAgainDiv = document.getElementById("whatsapp_show_again_div");
        if (whatsappShowAgainDiv) {
          whatsappShowAgainDiv.style.display = "none";
        }
      });
    </script>
  <?php endif; ?>
</head>

<body>
  <?php if (!empty($edit_param)): ?>
    <!-- Rich Editor -->
    <?php include_once('../../rich-editor.php'); ?>
  <?php endif; ?>
  <div id="popup-form" class="overlay">
    <div class="popup-beta">
      <span class="close-bg"><a class="close" href="#">&times;</a></span>
      <div class="popup-inner">
        <div class="form-new new" data-id="landing-page-whole-form123">

          <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
            <div class="edit-btn-container" style="right: 40px; top: 43px;">
              <a id="whole-form123" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i>
              </a>
            </div>
          <?php endif; ?>
          <div class="form popup-from-inner">
            <h3>Completa los datos para recibir la Guia Gratis</h3>
            <form action="<?php echo $result ?>" method="post" class="cf op-optin-validation" data-abide>
              <div class="outerInput">
                <div class="">
                  <div class="hover-edit">
                    <div class="form-subtitle" data-id="landing-page-form-sub-title">
                      <input
                        type="text"
                        name="nombre"
                        placeholder="<?php echo (trim($form_input_name_placeholder) != "") ? $form_input_name_placeholder : 'Ingresa tu Nombre' ?>"
                        value=""
                        id="name"
                        required
                        class="form-name innerInput"
                        data-id="form-name-placeholder" />
                    </div>

                    <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                      <div class="edit-btn-container">
                        <a id="form-name" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                      </div>
                      <!-- Edit Ends --> <?php endif; ?>

                  </div>
                </div>
              </div>
              <div class="outerInput">
                <div class="">
                  <div class="hover-edit">
                    <div class="form-subtitle" data-id="landing-page-form-sub-title">
                      <input
                        type="email"
                        name="email"
                        placeholder="<?php echo ($form_input_email_placeholder != "") ? $form_input_email_placeholder : 'Ingresa tu E-mail' ?>"
                        value=""
                        required
                        id="e-mail"
                        class="form-name innerInput"
                        data-id="form-email-placeholder" />
                    </div>

                    <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                      <div class="edit-btn-container">
                        <a id="form-email" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                      </div>
                      <!-- Edit Ends -->
                    <?php endif; ?>
                  </div>
                </div>
              </div>

              <div class="sc-eMRERa hoGAKy">
                <button <?php if ($form_submit_button_bg != '') { ?> style="border-radius: 15px; background: <?php echo $form_submit_button_bg; ?>" <?php } ?> type="submit" data-id="landing-page-form-submit-button" class="sc-bdVaJa iTNhmw">
                  <div class="sc-bwzfXH eqoTOr">
                    Enviar
                  </div>
                </button>
              </div>

              <p class="submitHint">Respetamos tu privacidad. No enviaremos spam.</p>
              <!-- TERMINA TITULO DEL BOTON DEL FORMULARIO-->
              <input type="hidden" name="pais" id="pais" value="<? echo $geo["geoplugin_countryName"]; ?>">
              <input type="hidden" name="ciudad" id="ciudad" value="<? echo $geo["geoplugin_city"]; ?>">
              <input type="hidden" name="estado" id="estado" value="<? echo $geo["geoplugin_regionName"]; ?>">
              <? include('../campana_user.php'); ?>
              <input type="hidden" name="usuario" id="usuario" value="<?= $usuario; ?>">
              <input type="hidden" name="template" id="template" value="<?= $template; ?>">
              <input type="hidden" name="idioma" id="idioma" value="es">
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- Page Content -->
  <!-- Hint: Here main is data-id="landing-page-bullet-area" and it will get from landing-page-editor-custom-es.js Other Id and class not so imp-->
  <div class="container1">
    <header class="bg-hBlue text-center text-white py-3 text-xl">
      <!-- subdominio_puntos -->

      <div class="hover-edit">
        <div class="puntos" data-id="landing-page-bullet-area">
          <?= $puntos; ?>
        </div>
        <?php if (!empty($edit_param)): ?>
          <!-- Edit Starts -->
          <div class="edit-btn-container">
            <a id="puntos" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
          </div>
        <?php endif; ?>
        <!-- Edit Ends -->
      </div>

    </header>

    <main>
      <div class="section1">
        <!-- Title -->
        <div class="hover-edit">
          <div class="temp-title text-center text-5xl font-bold text-allBlue" data-id="landing-page-title">
            <?= strip_tags($titulo); ?>
          </div>
          <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
            <div class="edit-btn-container">
              <a id="title" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </div>
            <!-- Edit Ends --> <?php endif; ?>
        </div>

        <!-- Sub Title  -->
        <div class="hover-edit">
          <div class="temp-subtitle text-center text-5xl" data-id="landing-page-sub-title">
            <?= strip_tags($subtitulo); ?>
          </div>
          <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
            <div class="edit-btn-container">
              <a id="sub-title" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </div>
            <!-- Edit Ends --> <?php endif; ?>
        </div>

        <div class="grid md:grid-cols-2">
          <div class="flex bookImage justify-center" style="align-items: center;">
            <?php
            $box_image_src = '';
            if (file_exists("../../images/landingpage/singleImage/" . $usuario . ".jpg")) {
              $box_image_src = "../../images/landingpage/singleImage/" . $usuario . ".jpg";
            } else if (file_exists("../../images/landingpage/singleImage/" . $usuario . ".jpeg")) {
              $box_image_src = "../../images/landingpage/singleImage/" . $usuario . ".jpeg";
            } else if (file_exists("../../images/landingpage/singleImage/" . $usuario . ".png")) {
              $box_image_src = "../../images/landingpage/singleImage/" . $usuario . ".png";
            } else {
              $box_image_src = "img/book-Image.png";
            }
            // var_dump($box_image_src, $usuario); exit;
            ?>
            <div class="hover-edit" style="border: 0px;">
              <div class="temp-text" data-id="box-single-image1">
                <img src="<?= $box_image_src ?>" alt="" srcset="" />
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="box-single-image1" onclick="imageSectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>

          </div>
          <div class="form py-16">
            <!-- Form Title  -->
            <div class="hover-edit">
              <div class="text-xl text-allBlue font-bold mb-4" data-id="landing-page-form-title">
                <?= strip_tags($titulo_formulario); ?>
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="form-title" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>

            <!-- Form Description  -->
            <div class="hover-edit">
              <div class="form-subtitle text-xl" data-id="landing-page-form-sub-title">
                <?= $texto_formulario ?>
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="form-subtitle" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>
            <?
            // var_dump($form_input_name_placeholder); exit();
            ?>
            <form action="<?php echo $result ?>" method="post" class="cf op-optin-validation" data-abide>
              <div class="outerInput">
                <div class="">
                  <div class="hover-edit">
                    <div class="form-subtitle" data-id="landing-page-form-sub-title">
                      <input
                        type="text"
                        name="nombre"
                        placeholder="<?php echo (trim($form_input_name_placeholder) != "") ? $form_input_name_placeholder : 'Ingresa tu Nombre' ?>"
                        value=""
                        id="name"
                        required
                        class="form-name innerInput"
                        data-id="form-name-placeholder" />
                    </div>
                    <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                      <div class="edit-btn-container">
                        <a id="form-name" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                      </div>
                      <!-- Edit Ends --> <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="outerInput">
                <div class="">
                  <div class="hover-edit">
                    <div class="form-subtitle" data-id="landing-page-form-sub-title">
                      <input
                        type="email"
                        name="email"
                        placeholder="<?php echo ($form_input_email_placeholder != "") ? $form_input_email_placeholder : 'Ingresa tu E-mail' ?>"
                        value=""
                        required
                        id="e-mail"
                        class="form-name innerInput"
                        data-id="form-email-placeholder" />
                    </div>
                    <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                      <div class="edit-btn-container">
                        <a id="form-email" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                      </div>
                      <!-- Edit Ends --> <?php endif; ?>
                  </div>
                </div>
              </div>


              <div class="sc-eMRERa hoGAKy">
                <div class="hover-edit">
                  <button <?php if ($form_submit_button_bg != '') { ?> style="background: <?php echo $form_submit_button_bg; ?>" <?php } ?> type="submit" data-id="landing-page-form-submit-button" class="sc-bdVaJa iTNhmw">
                    <div class="sc-bwzfXH eqoTOr">
                      <?= $boton; ?>
                    </div>
                  </button>
                  <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                    <div class="edit-btn-container">
                      <a id="form-submit" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                    <!-- Edit Ends --> <?php endif; ?>
                </div>
              </div>

              <p class="submitHint">Respetamos tu privacidad. No enviaremos spam.</p>
              <!-- TERMINA TITULO DEL BOTON DEL FORMULARIO-->
              <input type="hidden" name="pais" id="pais" value="<? echo $geo["geoplugin_countryName"]; ?>">
              <input type="hidden" name="ciudad" id="ciudad" value="<? echo $geo["geoplugin_city"]; ?>">
              <input type="hidden" name="estado" id="estado" value="<? echo $geo["geoplugin_regionName"]; ?>">
              <? include('../campana_user.php'); ?>
              <input type="hidden" name="usuario" id="usuario" value="<?= $usuario; ?>">
              <input type="hidden" name="template" id="template" value="<?= $template; ?>">
              <input type="hidden" name="idioma" id="idioma" value="es">
            </form>
          </div>
        </div>
      </div>

      <div class="section2 bg-allBlue border-y-4 border-allYellow">
        <div class="grid grid-cols-12">
          <div class="h-1 bg-allYellow col-start-2 col-span-10 my-5"></div>
        </div>
        <div
          class="grid grid-cols-12 gap-4 md:mx-16 bg-white rounded-lg overflow-hidden">
          <div
            class="col-span-12 md:col-span-4" style="display: flex; align-items: center;">
            <?php
            $box_image_src = '';
            // https://vioniko.com/images/landingpage/box1_3339.jpg
            if (file_exists("../../images/landingpage/box1_" . $usuario . ".jpg")) {
              $box_image_src = "../../images/landingpage/box1_" . $usuario . ".jpg";
            } else if (file_exists("../../images/landingpage/box1_" . $usuario . ".jpeg")) {
              $box_image_src = "../../images/landingpage/box1_" . $usuario . ".jpeg";
            } else if (file_exists("../../images/landingpage/box1_" . $usuario . ".png")) {
              $box_image_src = "../../images/landingpage/box1_" . $usuario . ".png";
            } else {
              $box_image_src = "img/luis.jpg";
            }
            // var_dump($box_image_src, $usuario); exit;
            ?>
            <div class="hover-edit" style="border: 0px;">
              <div class="temp-box flex justify-center self-center" data-id="landing-page-box-1">
                <img class="w-full" src="<?= $box_image_src ?>" alt="" srcset="" />
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="box-1" onclick="imageSectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>


          </div>
          <div
            class="col-span-12 md:col-span-8 pt-4 flex gap-2 flex-col mx-4 text-justify pb-4">
            <!-- Landing Page Description  -->
            <div class="hover-edit">
              <div class="text-area" data-id="landing-page-text-area">
                <?= $descripcion ?>
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="text-area" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="sc-eMRERa hoGAKy">
          <div class="hover-edit">
            <button <?php if ($form_submit_button_bg != '') { ?> style="background: <?php echo $form_submit_button_bg; ?>" <?php } ?> type="submit" data-id="landing-page-form-submit-button" class="sc-bdVaJa iTNhmw show-popup-form">
              <div class="sc-bwzfXH eqoTOr">
                <?= $boton; ?>
              </div>
            </button>
            <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
              <div class="edit-btn-container">
                <a id="form-submit" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
              </div>
              <!-- Edit Ends --> <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="section3 p-10 px-4 md:px-16">
        <!-- Section 3 Title  -->
        <div class="hover-edit">
          <div class="text-area1 text-center font-bold text-allBlue text-2xl mb-12" data-id="landing-page-text-area1">
            <?= strip_tags($subdominio_textarea1); ?>
          </div>
          <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
            <div class="edit-btn-container">
              <a id="text-area1" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </div>
            <!-- Edit Ends --> <?php endif; ?>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <!--  Promo 1  -->
          <div class="flex flex-col text-center">
            <div class="hover-edit">
              <div class="box-1-description text-center mb-12" data-id="landing-page-box-1-description">
                <?= $subdominio_box1_image_description ?>
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="box-1-description" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>
          </div>
          <div class="flex flex-col text-center">
            <div class="hover-edit">
              <div class="box-2-description text-center mb-12" data-id="landing-page-box-2-description">
                <?= $subdominio_box2_image_description ?>
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="box-2-description" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>
          </div>
          <div class="flex flex-col text-center">
            <div class="hover-edit">
              <div class="box-3-description text-center mb-12" data-id="landing-page-box-3-description">
                <?= $subdominio_box3_image_description ?>
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="box-3-description" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <div class="section4 bg-allBlue border-y-4 border-allYellow py-10">
        <div
          class="grid grid-cols-12 gap-4 md:mx-16 bg-white rounded-lg overflow-hidden">
          <div class="col-span-12 md:col-span-4 flex justify-center" style="align-items: center;">
            <?php
            $box_image_src = '';
            // https://vioniko.com/images/landingpage/box1_3339.jpg
            if (file_exists("../../images/landingpage/box2_" . $usuario . ".jpg")) {
              $box_image_src = "../../images/landingpage/box2_" . $usuario . ".jpg";
            } else if (file_exists("../../images/landingpage/box2_" . $usuario . ".jpeg")) {
              $box_image_src = "../../images/landingpage/box2_" . $usuario . ".jpeg";
            } else if (file_exists("../../images/landingpage/box2_" . $usuario . ".png")) {
              $box_image_src = "../../images/landingpage/box2_" . $usuario . ".png";
            } else {
              $box_image_src = "img/book-Image.png";
            }
            // var_dump($box_image_src, $usuario); exit;
            ?>
            <div class="hover-edit" style="border: 0px;">
              <div class="temp-box flex justify-center self-center" data-id="landing-page-box-2">
                <img class="w-full" src="<?= $box_image_src ?>" alt="" srcset="" />
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="box-2" onclick="imageSectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>
          </div>
          <div
            class="col-span-12 md:col-span-8 pt-4 flex gap-2 flex-col self-center px-4">
            <div class="hover-edit">
              <div class="image1-description mb-12" data-id="box-single-image1-description">
                <?= $subdominio_single_image_description ?>
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="image1-description" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>
            <div class="sc-eMRERa hoGAKy">
              <div class="hover-edit">
                <button <?php if ($form_submit_button_bg != '') { ?> style="background: <?php echo $form_submit_button_bg; ?>" <?php } ?> type="submit" data-id="landing-page-form-submit-button" class="sc-bdVaJa iTNhmw">
                  <div class="sc-bwzfXH eqoTOr">
                    <?= $boton; ?>
                  </div>
                </button>
                <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                  <div class="edit-btn-container">
                    <a id="form-submit" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                  </div>
                  <!-- Edit Ends --> <?php endif; ?>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="section5 p-4 md:p-16">
        <div class="flex">
          <div
            class="border-2 border-white bg-allBlue py-2 px-4 shadow-lg text-white text-center">
            <!-- Bottom one col section  -->
            <div class="hover-edit">
              <div class="text-area2" data-id="landing-page-text-area2">
                <?= $subdominio_textarea2 ?>
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="text-area2" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <div
        class="section6 bg-allBlue border-t-4 border-allYellow px-4 md:px-16 py-10">
        <div class="flex flex-col text-center text-white">
          <div class="text-allYellow">
            <!-- Footer Link  -->
            <div class="hover-edit">
              <div class="form-short-width-cta-button" data-id="form-short-width-cta-button">
                <?= $short_length_cta_button_text ?>
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="form-short-width-cta-button" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>
          </div>
          <div class="footer">
            <!-- Footer Link  -->
            <div class="hover-edit">
              <div class="landing-page-footer-description" data-id="landing-page-footer-description">
                <?= $subdominio_footer_description ?>
              </div>
              <!-- Edit Starts --> <?php if (!empty($edit_param)): ?>
                <div class="edit-btn-container">
                  <a id="landing-page-footer-description" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                </div>
                <!-- Edit Ends --> <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <?php include_once('../restore-content.php'); ?>
        </div>
      </div>
    </main>
  </div>
</body>

</html>