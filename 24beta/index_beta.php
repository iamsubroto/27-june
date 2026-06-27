<?
// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}




$template = 189;
include_once('../../subdominio_ini.php');
include('../../conexion_mysqli.php');
$edit_param = '';
if (isset($_GET['mode']) && $_GET['mode'] == 'edit') {
    $edit_param = "&mode=edit";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><? echo $rowUSU['meta_titulo']; ?></title>

        <meta name="description" content="<? echo $rowUSU['meta_descripcion']; ?>" />
        <meta name="keywords" content="<? echo $rowUSU['meta_palabras']; ?>" />
        <meta name="author" content="<? echo $rowUSU['nombre'] . ' ' . $rowUSU['apellidos']; ?>" />

        <!-- Para Facebook y otros -->
        <meta property="og:site_name" content="<? echo $rowUSU['meta_titulo']; ?>">
        <meta property="og:title" content="<? echo $rowUSU['meta_titulo']; ?>">
        <meta property="og:type" content="website">
        <!--    <meta property="og:url" content="http://--><? // echo $rowADMIN['url_dominio']; 
                                                            ?><!--/landingpage/4/index.php?subdominio=--><? // echo $rowUSU['subdominio']; 
                                                                                                            ?><!--">-->
        <!--    <meta property="og:image" content="http://--><? // echo $rowADMIN['url_dominio']; 
                                                                ?><!--/landingpage/4/fb.jpg">-->
        <meta property="og:description" content="<? echo $rowUSU['meta_descripcion']; ?>">

        <link rel="shortcut icon" href="../../favicon.ico" />
        <!--    <link rel="stylesheet" href="https://www.vioniko.com/landingpage/24beta/css/foundation.css" />-->
        <link rel="stylesheet" href="https://www.vioniko.com/landingpage/24beta/css/estilos.css" />
        <!--    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:700' rel='stylesheet' type='text/css'>-->
        <!--    <link href='http://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>-->
        <!--    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>-->
        <link rel="stylesheet" href="../../css/landingpage/bootstrap-colorpicker.min.css" />

        <script src="https://www.vioniko.com/landingpage/24beta/js/vendor/jquery.js"></script>
        <script src="https://www.vioniko.com/landingpage/24beta/js/vendor/modernizr.js"></script>
        <script src="https://www.vioniko.com/landingpage/24beta/js/foundation.min.js"></script>
        <script src="../../js/landinpage/bootstrap-colorpicker.js"></script>
        <script src="https://www.vioniko.com/landingpage/24beta/vendor/popper/popper.min.js"></script>
        <script src="https://www.vioniko.com/landingpage/24beta/vendor/bootstrap/js/bootstrap.min.js"></script>

        <script src="../../js/vendor/ckeditor/ckeditor.js"></script>
        <script src="https://vioniko.com/js/vendor/ckeditor/ckeditor_config.js"></script>
        <script src="../../js/landinpage/landing-page-editor-custom-es.js"></script>
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="../../css/landingpage/bootstrap_3.3.7_css_bootstrap.min.css">
        <!-- Template Custom Style -->
        <link href="https://www.vioniko.com/landingpage/24beta/css/template-style.css" rel="stylesheet">
        <?php
        include_once "../../usuarios/functions.php";
        echo getUserPixelCode($rowUSU["clave"], "fbpixel_lp");
        ?>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#logo").attr("onclick", "imageSectionEdit(this.id); openNav(); ");
            });
        </script>
        <style>
            .fieldDescription {
                text-align: left;
                font-size: 12px;
                margin-bottom: 0px;
            }

            .form-group {
                padding: 0px 20px;
            }

            .aiInputContent {
                background: #3f3a3a;
                border-radius: 10px;
                margin-top: 50px;
            }

            h3.gptChat {
                text-align: center;
                margin: 25px;
            }

            div#formContainer {
                padding-bottom: 20px;
            }
        </style>
        <?php include_once('../../chatHandeler.php'); ?>
    </head>

<body style="background: none !important;">
    <?php
    if (isset($_GET['blp_id'])) {
        $beta_landing_page_id = $_GET['blp_id'];
    }
    $video_src = '';
    if (file_exists("./../../images/landingpage/bg/" . $usuario . "/" . $usuario . ".mp4")) {
        $video_src = '../../images/landingpage/bg/' . $usuario . '/' . $usuario . '.mp4';
    }
    if ($video_src == '' && $background_image_library_url != '') {
        if (strstr($background_image_library_url, ".mp4")) {
            $video_src = $background_image_library_url;
        }
    }

    if ($youtube_bg != "") {
        $video_src = $youtube_bg;
    ?>
        <iframe id="background-video" frameborder="0" allowfullscreen="1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" width="640" height="360" src="https://www.youtube.com/embed/<?php echo $video_src; ?>?autohide=1&rel=0&autoplay=1&iv_load_policy=3&modestbranding=1&controls=0&showinfo=0&disablekb=1&enablejsapi=1&widgetid=1&mute=1&loop=1&playlist=<?php echo $video_src; ?>&origin=https://www.vioniko.com&modestbranding=1" style="position: fixed; inset: 0px; width: 1527.2px; height: 1259.05px; max-width: none; max-height: none; margin: -450.525px 0px 0px; z-index: -1; transform: translateY(60.2px) translateZ(0px);"></iframe>
    <?php
    } else if ($video_src != "") { ?>
        <video id="background-video1" style="min-width: 100%; min-height: 100%; position: fixed; z-index: -1; <?php if ($video_src != "") { ?>display: block;<?php } else { ?> display: none; <?php } ?>" src="<?php if ($video_src != "") {
                                                                                                                                                                                                                    echo $video_src;
                                                                                                                                                                                                                } ?>" autoplay="" loop="">
        </video>
    <?php }
    ?>

    <div id="mySidenav" class="sidenav" style="display: none;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="pane-content">
            <textarea id="mytextarea" name="mytextarea" style="display: none;"></textarea>

            <? include_once('../videoEditor.php'); ?>

            <div id="change-background-color-section">
                <div class="title">
                    <p class="pane-section-title">
                        Change Section Background Color
                    </p>
                </div>
                <div class="upload-input">
                    <div class="box-beta">
                        <a style="display: none; font-size: 15px;" href="#" class="btn-green" id="cp4">
                            Change color
                        </a>
                    </div>
                </div>

            </div>

            <form action="../../landingpage_data_save_en.php" method="post" enctype="multipart/form-data" name="forma" id="forma" class="form-horizontal">
                <input name='subdominio_titulo' class='subdominio_titulo' id='subdominio_titulo' value='<?= htmlentities($titulo); ?>' type='hidden'><!-- landing page title-->
                <input name='subdominio_subtitulo' id='subdominio_subtitulo' value='<?= htmlentities($subtitulo); ?>' type='hidden'><!-- landing page sub title-->
                <input name='subdominio_descripcion' id='subdominio_descripcion' value='<?= htmlentities($descripcion); ?>' type='hidden'><!-- landing page textarea-->
                <input name='subdominio_puntos' id='subdominio_puntos' value='<?= htmlentities($puntos); ?>' type='hidden'><!-- landing page bullet area-->
                <input name='subdominio_tituloformulario' id='subdominio_tituloformulario' value='<?= $titulo_formulario; ?>' type='hidden'><!-- landing page form title-->
                <input name='subdominio_textoformulario' id='subdominio_textoformulario' value='<?= $texto_formulario; ?>' type='hidden'><!-- landing page form sub title-->
                <input name='subdominio_boton' id='subdominio_boton' value='<?= $boton; ?>' type='hidden'><!-- landing page form submit button-->
                <input name='subdominio_video' id='subdominio_video' value='<?= $video; ?>' type='hidden'><!-- landing page iframe video-->
                <input name='videos' id='videos' value='<?= $videos; ?>' type='hidden'><!-- landing page video source -->
                <input name='language' id='language' value='esp' type='hidden'>

                <input name='subdominio_logo_bg' id='subdominio_logo_bg' value='<?php echo $logo_section_bg; ?>' type='hidden'>
                <input name='subdominio_titulo_bg' id='subdominio_titulo_bg' value='<?php echo $title_section_bg; ?>' type='hidden'>
                <input name='subdominio_subtitulo_bg' id='subdominio_subtitulo_bg' value='<?php echo $subtitle_section_bg; ?>' type='hidden'>
                <input name='subdominio_textarea_bg' id='subdominio_textarea_bg' value='<?php echo $textarea_section_bg; ?>' type='hidden'>
                <input name='subdominio_puntos_bg' id='subdominio_puntos_bg' value='<?php echo $bulleted_area_section_bg; ?>' type='hidden'>
                <input name='subdominio_form_bg' id='subdominio_form_bg' value='<?php echo $form_section_bg; ?>' type='hidden'>
                <input name='subdominio_tituloformulario_bg' id='subdominio_tituloformulario_bg' value='<?php echo $form_subtitle_bg; ?>' type='hidden'>
                <input name='subdominio_textoformulario_bg' id='subdominio_textoformulario_bg' value='<?php echo $form_subtitle_bg; ?>' type='hidden'>
                <input name='subdominio_footer_bg' id='subdominio_footer_bg' value='<?php echo $footer_section_bg; ?>' type='hidden'>
                <input name='subdominio_avatar_bg' id='subdominio_avatar_bg' value='' type='hidden'>
                <input name='subdominio_author_info_bg' id='subdominio_author_info_bg' value='' type='hidden'>
                <input name='subdominio_form_name_placeholder' id='subdominio_form_name_placeholder' value='<?php echo $form_input_name_placeholder; ?>' type='hidden'>
                <input name='subdominio_form_email_placeholder' id='subdominio_form_email_placeholder' value='<?php echo $form_input_email_placeholder; ?>' type='hidden'>
                <input name='subdominio_form_whatsapp_placeholder' id='subdominio_form_whatsapp_placeholder' value='<?php echo $form_input_whatsapp_placeholder; ?>' type='hidden'>
                <input name='subdominio_form_whatsapp_visible' id='subdominio_form_whatsapp_visible' value='<?php echo $form_input_whatsapp_visible; ?>' type='hidden'>
                <input name='subdominio_background_image_library_url' id='subdominio_background_image_library_url' value='<?php echo $background_image_library_url; ?>' type='hidden'>
                <input name='bg_LIBRARY_change_time_en' id='bg_LIBRARY_change_time_en' value='0' type='hidden'>
                <input name='bg_UPLOAD_change_time_en' id='bg_UPLOAD_change_time_en' value='0' type='hidden'>
                <input name='subdominio_form_submit_button' id='subdominio_form_submit_button' value='<?php echo $form_submit_button_bg; ?>' type='hidden'>
                <!--            <input name='beta_landing_page_id' id='beta_landing_page_id' value='--><?php //echo $beta_landing_page_id; 
                                                                                                        ?><!--' type='hidden'>-->
                <input name='beta_landing_page_id' id='beta_landing_page_id' value='92' type='hidden'>
                <input name='template_id' id='template_id' value='<?php echo $tem; ?>' type='hidden'>
                <input name='short_length_cta_button_text' id='short_length_cta_button_text' value='<?php echo $short_length_cta_button_text; ?>' type='hidden'>
                <input name='full_length_cta_button_text' id='full_length_cta_button_text' value='<?php echo $full_length_cta_button_text; ?>' type='hidden'>
                <input name='short_length_cta_button_bg' id='short_length_cta_button_bg' value='<?php echo $short_length_cta_button_bg; ?>' type='hidden'>
                <input name='full_length_cta_button_bg' id='full_length_cta_button_bg' value='<?php echo $full_length_cta_button_bg; ?>' type='hidden'>
                <input name='subdominio_textarea1' id='subdominio_textarea1' value='<?php echo $subdominio_textarea1; ?>' type='hidden'>
                <input name='subdominio_textarea1_bg' id='subdominio_textarea1_bg' value='<?php echo $subdominio_textarea1_bg; ?>' type='hidden'>
                <input name='subdominio_textarea2' id='subdominio_textarea2' value='<?php echo $subdominio_textarea2; ?>' type='hidden'>
                <input name='subdominio_textarea2_bg' id='subdominio_textarea2_bg' value='<?php echo $subdominio_textarea2_bg; ?>' type='hidden'>
                <input name='slider_images_list' id='slider_images_list' value='<?php echo $slider_images_list; ?>' type='hidden'>
                <input name='subdominio_box1_image' id='subdominio_box1_image' value='<?php echo $subdominio_box1_image; ?>' type='hidden'>
                <input name='subdominio_box2_image' id='subdominio_box2_image' value='<?php echo $subdominio_box2_image; ?>' type='hidden'>
                <input name='subdominio_box3_image' id='subdominio_box3_image' value='<?php echo $subdominio_box3_image; ?>' type='hidden'>
                <input name='subdominio_body_background_color' id='subdominio_body_background_color' value='<?php echo $subdominio_body_background_color; ?>' type='hidden'>

                <div id="change-logo-section">
                    <div class="title">
                        <p class="pane-section-title">
                            Change Logo
                        </p>
                    </div>
                    <div class="upload-input">
                        <label>Change Section logo</label>
                        <input type="file" name="sectionImageUpload" class="imageUpload" id="sectionImageUpload">
                    </div>

                </div>
                <div id="change-avatar-section">
                    <div class="title">
                        <p class="pane-section-title">
                            Change Avatar
                        </p>
                    </div>
                    <div class="upload-input">
                        <label>Change Footer Avatar</label>
                        <input type="file" name="sectionAvatarUpload" class="imageUpload" id="sectionAvatarUpload">
                    </div>

                </div>
                <div id='change-bg-section'>
                    <div class="title">
                        <p class="pane-section-title">
                            Change Background
                        </p>
                    </div>
                    <div class="upload-input">
                        <div class="box-beta">
                            <a class="btn-green" href="#popup1">Choose Image From Library</a>
                        </div>
                    </div>
                    <div class="upload-input">
                        <div class="box-beta">
                            <a style="display: none;" href="#" class="btn-green" id="cp_background">
                                Set Background color with opactiy
                            </a>
                        </div>
                    </div>
                    <div class="or-seperator">
                        <p class="text-center or">
                            <span>OR</span>
                        </p>
                    </div>
                    <div class="upload-input">
                        <div class="box-beta">
                            <a class="btn-green" href="#popup-video">Choose Video From Library</a>
                        </div>
                    </div>
                    <div class="or-seperator">
                        <p class="text-center or">
                            <span>OR</span>
                        </p>
                    </div>
                    <div class="upload-input">
                        <label>Upload Background Image</label>
                        <!--                    Warning: POST Content-Length of 48387348 bytes exceeds the limit of 8388608 bytes in Unknown on line 0-->
                        <input type="file" accept="video/*,image/*" name="backgroundImageUpload" class="imageUpload" id="backgroundImageUpload" onchange='recordDateTime("bg_UPLOAD_change_time_en");'>
                    </div>
                    <div class="or-seperator">
                        <p class="text-center or">
                            <span>OR</span>
                        </p>
                    </div>
                    <div class="upload-input">
                        <label>Background Youtube video ID</label>
                        <input type="text" class="form-control" id="youtube_bg" name="youtube_bg" placeholder="Enter a Background Youtube video ID" value="">
                    </div>
                </div>
            </form>
        </div>

        <div>
            <div>
                <div id="popup1" class="overlay">
                    <div class="popup-beta">
                        <span class="close-bg"><a class="close" href="#">&times;</a></span>
                        <div class="select-file">
                            <div class="popup-inner">
                                <?php
                                $dirname = "../../images/bg/thumbnail/";
                                $images = glob($dirname . "*.jpg");
                                //                                echo '<pre>'; print_r($images); exit;
                                foreach ($images as $image) {
                                    //                                    echo $image."<br/>";
                                    echo '<div class="popup-img">';
                                    echo '<input type="checkbox" name="">';
                                    echo '<img class="img-responsive" src="' . $image . '"/>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div>
                <div id="popup-video" class="overlay">
                    <div class="popup-beta">
                        <span class="close-bg"><a class="close" href="#">&times;</a></span>
                        <div class="select-file">
                            <div class="popup-inner">
                                <?php
                                // $dirname = "../../videos/bg/thumbnail/";
                                //$images = glob($dirname."*.jpg");
                                include_once('../youtube_library.php');
                                //                            $images = ['fL2Xvkd-9JA', '6sgF_aqN4rM', 'Fgi1YOJT7gs', 'G8QnduC7_SU', 'R9TPrwJtKkI', 'uhc-Eh2DyR8', 'sNGQru0Egrs', 'MdTqMCNxRfY'];
                                foreach ($images as $image) {
                                    echo '<div class="popup-img">';
                                    echo '<input type="checkbox" name="" class="video-responsive" data-title="' . $image . '" data-id="https://www.youtube.com/embed/' . $image . '?autohide=1&rel=0&autoplay=1&iv_load_policy=3&modestbranding=1&controls=0&showinfo=0&disablekb=1&enablejsapi=1&widgetid=1&mute=1&loop=1&playlist=' . $image . '&origin=https://www.vioniko.com&modestbranding=1">';
                                ?>
                                    <iframe id="youtube-video" src="//www.youtube.com/embed/<?= $image; ?>" width="100%" height="220px" frameborder="0"></iframe>
                                <?php
                                    //  echo '<img class="video-responsive" src="'.$image.'"/>';
                                    //                                echo '<video class="video-responsive" src="'.$image.'"></video>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Page Content -->
    <?php
    $usuario_temperory = $usuario;
    $usuario = ($usuario_temp != "") ? $usuario_temp : $usuario_temperory;
    //echo $usuario." | ".$background_image_library_url; exit;
    $bacgkground_image_src = '';
    if (file_exists("./../../images/landingpage/bg/" . $usuario . "/" . $usuario . "" . ".jpg")) {
        $bacgkground_image_src = '../../images/landingpage/bg/' . $usuario . '/' . $usuario . '' . '.jpg';
        $bacgkground_image_src = 'background-image: url("' . $bacgkground_image_src . '")';
    } else if (file_exists("./../../images/landingpage/bg/" . $usuario . "/" . $usuario . "" . ".jpeg")) {
        $bacgkground_image_src = '../../images/landingpage/bg/' . $usuario . '/' . $usuario . '' . '.jpeg';
        $bacgkground_image_src = 'background-image: url("' . $bacgkground_image_src . '")';
    } else if (file_exists("./../../images/landingpage/bg/" . $usuario . "/" . $usuario . "" . ".png")) {
        $bacgkground_image_src = '../../images/landingpage/bg/' . $usuario . '/' . $usuario . '' . '.png';
        $bacgkground_image_src = 'background-image: url("' . $bacgkground_image_src . '")';
    } else if (file_exists("./../../images/landingpage/bg/" . $usuario . "/" . $usuario . "" . ".gif")) {
        $bacgkground_image_src = '../../images/landingpage/bg/' . $usuario . '/' . $usuario . '' . '.gif';
        $bacgkground_image_src = 'background-image: url("' . $bacgkground_image_src . '")';
    }
    //echo "here".$background_image_library_url; exit;
    if ($bacgkground_image_src == '' && $background_image_library_url != '') {
        $bacgkground_image_src = 'background-image: url("' . $background_image_library_url . '")';
    }

    //code for defualt values
    if ($bacgkground_image_src == '') {

        if (file_exists("./../../images/default/bg/1317/1317.jpg")) {
            $bacgkground_image_src = '../../images/default/bg/1317/1317.jpg';
            $bacgkground_image_src = 'background-image: url("' . $bacgkground_image_src . '")';
        } else if (file_exists("./../../images/default/bg/1317/1317.jpeg")) {
            $bacgkground_image_src = '../../images/default/bg/1317/1317.jpeg';
            $bacgkground_image_src = 'background-image: url("' . $bacgkground_image_src . '")';
        } else if (file_exists("./../../images/default/bg/1317/1317.png")) {
            $bacgkground_image_src = '../../images/default/bg/1317/1317.png';
            $bacgkground_image_src = 'background-image: url("' . $bacgkground_image_src . '")';
        } else if (file_exists("./../../images/default/bg/1317/1317.gif")) {
            $bacgkground_image_src = '../../images/default/bg/1317/1317.gif';
            $bacgkground_image_src = 'background-image: url("' . $bacgkground_image_src . '")';
        }

        if ($bacgkground_image_src == '') {
            $bacgkground_image_src = 'background-image: url("' . $background_image_library_url_default . '")';
        }
    }
    $usuario = $usuario_temperory;
    //echo $bacgkground_image_src; exit;
    ?>
    <div class="content" id="content" <?php if ($video_src != "") { ?> style="background: none; background-image: none;" <?php } ?> <?php if ($bacgkground_image_src != '') { ?> style='<?php echo $bacgkground_image_src; ?>' <?php } ?>>
        <div class="layer" <?php if ($subdominio_body_background_color != "") { ?> style="background-color: <?php echo $subdominio_body_background_color; ?>;" <?php } ?>>
            <div style="padding: 40px">
                <div class="container-fluid">
                    <!-- <div class="row">
            <div class="large-12 columns cont-datos" align="right">
             <span><? if ($landing) $url = 'index_en_beta.php?landing=' . $landing . $edit_param;
                    elseif ($usuario and $version) $url = 'index_en_beta.php?usuario=' . $usuario . '&v=' . $version . $edit_param;
                    else $url = 'index_en_beta.php?subdominio=' . $subdominio . $edit_param; ?>
                 <a href="<?= $url; ?>" class="emaillink"><img src="img/gb.png" width="16" height="11" alt=""> English</a>
            </span>
            </div>
        </div> -->

                    <!-- Template Header starts -->
                    <div class="row">
                        <div class="section-bg">
                            <div class="temp-header hover-edit">
                                <?php //echo $logo_section_bg; exit; 
                                ?>
                                <div class="logo-section" data-id="landing-page-logo" <?php if ($logo_section_bg != '') { ?> style="background: <?php echo $logo_section_bg; ?>" <?php } ?>>
                                    <?= $logotipo; ?>
                                </div>
                                <!-- Edit Starts -->
                                <div class="edit-btn-container">
                                    <a id="logo" onclick="imageSectionEdit(this.id); openNav();" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </div>
                                <!-- Edit Ends -->
                            </div>
                            <div class="hover-edit">
                                <div class="temp-title" data-id="landing-page-title" <?php if ($title_section_bg != '') { ?> style="background: <?php echo $title_section_bg; ?>" <?php } ?>>
                                    <?php
                                    echo $titulo;
                                    ?>
                                </div>
                                <!-- Edit Starts -->
                                <div class="edit-btn-container">
                                    <a id="title" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </div>
                                <!-- Edit Ends -->
                            </div>
                            <div class="hover-edit">
                                <div class="temp-subtitle" data-id="landing-page-sub-title" <?php if ($subtitle_section_bg != '') { ?> style="background: <?php echo $subtitle_section_bg; ?>" <?php } ?>>
                                    <?php
                                    echo $subtitulo; ?>
                                </div>
                                <!-- Edit Starts -->
                                <div class="edit-btn-container">
                                    <a id="sub-title" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </div>
                                <!-- Edit Ends -->
                            </div>
                        </div>
                    </div>
                    <!-- Template Header Ends -->
                    <div class="space"></div>
                    <!-- Video/Form section Starts -->
                    <form action="../../registro_prospecto_subdominio_getresponse24beta.php" method="post" id="prospectoForm" class="cf op-optin-validation" data-abide>
                        <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-12"></div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <? include_once('../videoPlayer.php'); ?>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="section-bg">
                                    <div class="form-new new" data-id="landing-page-whole-form" <?php if ($form_section_bg != "") { ?> style="background: <?php echo $form_section_bg; ?>" <?php } ?>>
                                        <!-- Edit Starts -->
                                        <div class="edit-btn-container">
                                            <a id="whole-form" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <!-- Edit Ends -->
                                        <div class="temp-form">
                                            <div class="hover-edit">
                                                <div class="form-title" data-id="landing-page-form-title" <?php if ($form_title_bg != '') { ?> style="background: <?php //echo $form_title_bg;
                                                                                                                                                                    ?>" <?php } ?>>
                                                    <h2><?= $titulo_formulario; ?></h2>
                                                </div>
                                                <!-- Edit Starts -->
                                                <div class="edit-btn-container">
                                                    <a id="form-title" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </div>
                                                <!-- Edit Ends -->
                                            </div>
                                            <div class="hover-edit">
                                                <div class="form-subtitle" data-id="landing-page-form-sub-title" <?php if ($form_subtitle_bg != '') { ?> style="background: <?php //echo $form_subtitle_bg;
                                                                                                                                                                            ?>" <?php } ?>>
                                                    <h6><?= $texto_formulario; ?></h6>
                                                </div>
                                                <!-- Edit Starts -->
                                                <div class="edit-btn-container">
                                                    <a id="form-subtitle" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </div>
                                                <!-- Edit Ends -->
                                            </div>

                                            <div class=" hover-edit">
                                                <div class="form-group">
                                                    <input type="text" name="nombre" class="form-control" id="name" required placeholder="<?php echo ($form_input_name_placeholder != "") ? $form_input_name_placeholder : 'Ingresa tu Nombre' ?>" data-id="form-name-placeholder">
                                                    <small class="error-beta" style="display: none;">You must enter your name.</small>
                                                </div>
                                                <!-- Edit Starts -->
                                                <div class="edit-btn-container">
                                                    <a id="form-name" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </div>
                                                <!-- Edit Ends -->
                                            </div>
                                            <div class=" hover-edit">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-control" required id="e-mail" placeholder="<?php echo ($form_input_email_placeholder != "") ? $form_input_email_placeholder : 'Ingresa tu E-mail' ?>" data-id="form-email-placeholder">
                                                    <small class="error-beta" style="display: none;">You must enter a e-mail.</small>
                                                </div>
                                                <!-- Edit Starts -->
                                                <div class="edit-btn-container">
                                                    <a id="form-email" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </div>
                                                <!-- Edit Ends -->
                                            </div>
                                            <?php //if($form_input_whatsapp_visible != '1'){ 
                                            ?>
                                            <div class="hover-edit" id="whatsapp_field_div" <?php if ($form_input_whatsapp_visible == '1') { ?> style="display: none" <?php } ?>>
                                                <div class="form-group">
                                                    <input type="tel" name="telefono_casa" class="form-control" id="whatsapp" placeholder="<?php echo ($form_input_whatsapp_placeholder != "") ? $form_input_whatsapp_placeholder : 'Ingresa tu whatsapp' ?>" data-id="form-whatsapp-placeholder">
                                                </div>
                                                <!-- Edit Starts -->
                                                <div class="edit-btn-container">
                                                    <a id="form-whatsapp" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <a href="javascript:void(0);" onclick="(($(this).parent('.edit-btn-container')).parent('.hover-edit')).hide(); $('#whatsapp_field_div').hide();$('#whatsapp_show_again').removeAttr('checked'); $('#whatsapp_show_again_div').show(); $('#subdominio_form_whatsapp_visible').val(1);" class="dlt-btn"><i class="fa fa-trash"></i></a>
                                                </div>
                                                <!-- Edit Ends -->
                                            </div> <!-- Till This section -->


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-12"></div>
                        </div> <!--End Row-->
                        <div class="row aiInputContent" <?php if ($form_section_bg != "") { ?> style="background: <?php echo $form_section_bg; ?>" <?php } ?>>

                            <h3 class="gptChat">INTELIGENCIA ARTIFICIAL</h3>
                            <div id="formContainer">
                                <?php
                                function obfuscateApiKey($apiKey)
                                {
                                    return base64_encode($apiKey);
                                }

                                function fixSpanishCode($inputString)
                                {
                                    $outPutString = mb_convert_encoding($inputString, "UTF-8", "iso-8859-1");
                                    return $outPutString;
                                }

                                if (isset($rowTEM['subdominio']) && $grupal == TRUE)
                                    $subdominio = $rowTEM['subdominio'];

                                $sql = "SELECT description, gptAPIKey, gptModel FROM gptapi g, usuario u WHERE g.userid=u.clave AND subdominio='$subdominio' AND name='prompt'";
                                $result = $conn->query($sql);
                                $gptapi = $result->fetch_assoc();
                                $prompt = $gptapi['description'];
                                $gptAPIKey = obfuscateApiKey($gptapi['gptAPIKey']);
                                $gptModel = $gptapi['gptModel'];

                                $sql = "SELECT id, name, description FROM gptapi g, usuario u WHERE g.userid=u.clave AND subdominio='$subdominio' AND name!='prompt'";
                                $result = $conn->query($sql);
                                $columnCount = 0;
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        if ($columnCount % 3 == 0) {
                                            echo '<div class="row">';
                                        }
                                ?>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <!-- <label for="<?= strtolower($row['name']) ?>" class=""><?= $row['name'] ?></label> -->
                                                <p class="fieldDescription"><?= $row['description'] ?></p>
                                                <input type="text" name="<?php echo strtolower($row['name']) . "_" . $row['id']; ?>" class="form-control" id="<?= strtolower($row['name']) ?>" required placeholder="<?= $row['name'] ?>" data-id="form-name-placeholder">

                                                <small class="error-beta" style="display: none;">You must enter your name.</small>
                                            </div>
                                        </div>

                                <?php
                                        $columnCount++;

                                        // Close the row if the current row has 3 columns
                                        if ($columnCount % 3 == 0) {
                                            echo '</div>';
                                        }
                                    }
                                } else {
                                    echo "0 results";
                                }

                                $conn->close();
                                ?>
                            </div>
                            <!-- End GPT -->
                            <?php //if($form_input_whatsapp_visible == '1'){ 
                            ?>
                            <div class="hover-edit12" id="whatsapp_show_again_div" <?php if ($form_input_whatsapp_visible == '1') { ?> style="display: block;" <?php } ?> style="display: none;">
                                <div class="form-group">
                                    <input type="checkbox" style="opacity:1; position: relative;" name="whatsapp_show_again" id="whatsapp_show_again" value="whatsapp_show_again">Show whatsapp field
                                </div>
                            </div>
                            <?php //} 
                            ?>
                            <div class="hover-edit">
                                <div class="form-group">
                                    <button <?php if ($form_submit_button_bg != '') { ?> style="background: <?php echo $form_submit_button_bg; ?>" <?php } ?> type="submit" data-id="landing-page-form-submit-button" class="btn btn-default btn-submit"><?= $boton; ?></button>
                                </div>
                                <!-- Edit Starts -->
                                <div class="edit-btn-container">
                                    <a id="form-submit" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <!--                                        <a href="#" class="dlt-btn"><i class="fa fa-trash"></i></a>-->
                                </div>
                                <!-- Edit Ends -->
                            </div>

                            <!-- TERMINA TITULO DEL BOTON DEL FORMULARIO-->
                            <input type="hidden" name="pais" id="pais" value="<? echo $geo["geoplugin_countryName"]; ?>">
                            <input type="hidden" name="ciudad" id="ciudad" value="<? echo $geo["geoplugin_city"]; ?>">
                            <input type="hidden" name="estado" id="estado" value="<? echo $geo["geoplugin_regionName"]; ?>">
                            <input type="hidden" name="usuario" id="usuario" value="<?= $usuario; ?>">
                            <input type="hidden" name="template" id="template" value="<?= $template; ?>">
                            <input type="hidden" name="idioma" id="idioma" value="es">
                            <div id="inputContainer"></div>
                            <div id="inputContainerPrompt"></div>

                        </div> <!-- End Row aiInputContent -->
                    </form>
                    <!-- Video/Form section Ends -->
                    <!-- footer starts -->
                    <!-- footer ends -->
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <?php include_once('../restore-content.php'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#prospectoForm').submit(function(event) {
                event.preventDefault();
                $('.gptChat').html("Loading... <br >" + "Estamos procesando con IA tu informaci&oacute;n. &iexcl;Danos un momento, por favor!");
                const apiKeyVioniko = "<?= $gptAPIKey ?>"; // Replace with your OpenAI API key
                const apiUrl = "https://api.openai.com/v1/chat/completions";
                var formValues = $('#formContainer :input').serializeArray();
                const apiKey = atob(apiKeyVioniko);
                // console.log(formValues);
                <?php
                $prompt = str_replace("\n", ' ', $prompt);
                ?>
                var longSentence = '<?= $prompt ?>';
                var formObject = {};
                formValues.forEach(function(item) {
                    var newKey = item.name.replace(/_\d+$/, ''); // Remove underscore and digits at the end
                    formObject[newKey] = item.value;
                });
                // console.log(formObject);
                // Replace every occurrence of variables with their respective values
                $.each(formObject, function(variable, value) {
                    // Remove those variable which have (variable) or ( variable )
                    var regex = new RegExp('\\(' + variable + '\\)', 'gi');
                    longSentence = longSentence.replace(regex, value);

                    regex = new RegExp('\\(\\s*' + variable + '\\s*\\)', 'gi');
                    longSentence = longSentence.replace(regex, value);

                    // var regex = new RegExp(variable, "gi");
                    // longSentence = longSentence.replace(regex, value);
                });
                // console.log(longSentence);
                var userMessage = longSentence.replace(/\(\s*(.*?)\s*\)/g, "$1");
                // console.log(userMessage);
                // alert(userMessage);
                // return;  

                // Call OpenAI API
                $.ajax({
                    type: "POST",
                    url: apiUrl,
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: "Bearer " + apiKey,
                    },
                    data: JSON.stringify({
                        model: "<?= $gptModel ?>",
                        messages: [{
                                role: "system",
                                content: "You are a helpful assistant."
                            },
                            {
                                role: "user",
                                content: userMessage
                            },
                        ],
                    }),
                    success: function(response) {
                        const assistantResponse =
                            response.choices[0]?.message?.content || "No response";
                        // alert(assistantResponse);
                        // return;

                        // Create a new input field and append it to the container
                        var newInput = $('<input>')
                            .attr({
                                type: 'hidden',
                                name: 'gptResponse',
                                value: assistantResponse,
                            });

                        var newInputPrompt = $('<input>')
                            .attr({
                                type: 'hidden',
                                name: 'inputContainerPrompt',
                                value: userMessage,
                            });
                        // console.log(assistantResponse);
                        // console.log(userMessage);
                        // exit();
                        $('#inputContainer').replaceWith(newInput);
                        $('#inputContainerPrompt').replaceWith(newInputPrompt);
                        // return;
                        $('#prospectoForm').off('submit').submit();
                    },
                    error: function(error) {
                        console.error("Error:", error);
                    },
                });

            });
        });
    </script>
</body>

</html>