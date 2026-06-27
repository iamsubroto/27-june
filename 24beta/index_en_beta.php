<? $template = 165; 
include_once('../../subdominio_ini.php');



$edit_param = '';
if(isset($_GET['mode']) && $_GET['mode'] == 'edit'){
    $edit_param = "&mode=edit";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><? echo $rowUSU['meta_titulo_en']; ?></title>

    <meta name="description" content="<? echo $rowUSU['meta_descripcion_en']; ?>" />
    <meta name="keywords" content="<? echo $rowUSU['meta_palabras_en']; ?>" />
    <meta name="author" content="<? echo $rowUSU['nombre'].' '.$rowUSU['apellidos']; ?>" />

    <!-- Para Facebook y otros -->
    <meta property="og:site_name" content="<? echo $rowUSU['meta_titulo_en']; ?>">
    <meta property="og:title" content="<? echo $rowUSU['meta_titulo_en']; ?>">
    <meta property="og:type" content="website">
<!--    <meta property="og:url" content="http://--><?// echo $rowADMIN['url_dominio']; ?><!--/landingpage/4/index_en.php?subdominio=--><?// echo $rowUSU['subdominio']; ?><!--">-->
<!--    <meta property="og:image" content="http://--><?// echo $rowADMIN['url_dominio']; ?><!--/landingpage/4/fb_en.jpg">-->
    <meta property="og:description" content="<? echo $rowUSU['meta_descripcion_en']; ?>">

    <link rel="shortcut icon" href="../../favicon.ico" />
<!--    <link rel="stylesheet" href="css/foundation.css" />-->
    <link rel="stylesheet" href="css/estilos.css" />
<!--    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:700' rel='stylesheet' type='text/css'>-->
<!--    <link href='http://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>-->
<!--    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>-->
    <link rel="stylesheet" href="../../css/landingpage/bootstrap-colorpicker.min.css" />

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/modernizr.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="../../js/landinpage/bootstrap-colorpicker.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="../../js/vendor/ckeditor/ckeditor.js"></script>
    <script src="../../js/vendor/ckeditor/ckeditor_config.js"></script>
    <script src="../../js/landinpage/landing-page-editor-custom-en.js"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../css/landingpage/bootstrap_3.3.7_css_bootstrap.min.css">
    <!-- Template Custom Style -->
    <link href="css/template-style.css" rel="stylesheet">
    <?php
    include_once "../../usuarios/functions.php";
    echo getUserPixelCode($rowUSU["clave"], "fbpixel_lp");
    ?>
</head>
<body style="background: none !important;" class="test">
	
<?php
	

	
	
if(isset($_GET['blp_id'])){
    $beta_landing_page_id = $_GET['blp_id'];
}
$video_src = '';
if(file_exists("./../../images/landingpage/bg/".$usuario."/".$usuario."_en.mp4")){
    $video_src = '../../images/landingpage/bg/'.$usuario.'/'.$usuario.'_en.mp4';
}
if ($video_src == '' && $background_image_library_url_en != ''){
if(strstr($background_image_library_url_en, ".mp4")) {
        $video_src = $background_image_library_url_en;
    }
}
	
if($youtube_bg_en != ""){
    $video_src = $youtube_bg_en;
    ?>
            <iframe id="background-video" frameborder="0" allowfullscreen="1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" width="640" height="360" src="https://www.youtube.com/embed/<?php echo $video_src; ?>?autohide=1&rel=0&autoplay=1&iv_load_policy=3&modestbranding=1&controls=0&showinfo=0&disablekb=1&enablejsapi=1&widgetid=1&mute=1&loop=1&playlist=<?php echo $video_src; ?>&origin=https://www.vioniko.com&modestbranding=1" style="position: fixed; inset: 0px; width: 1527.2px; height: 1259.05px; max-width: none; max-height: none; margin: -450.525px 0px 0px; z-index: -1; transform: translateY(60.2px) translateZ(0px);"></iframe>
<?php
}else if($video_src != ""){ ?>
    <video id="background-video1" style="min-width: 100%; min-height: 100%; position: fixed; z-index: -1; <?php if($video_src != ""){ ?>display: block;<?php } else{ ?> display: none; <?php } ?>" src="<?php if($video_src != ""){ echo $video_src; }?>" autoplay="" loop="">
</video>
<?php }
?>

<div id="mySidenav" class="sidenav" style="display: none;">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="pane-content">
        <textarea id="mytextarea" name="mytextarea" style="display: none;"></textarea>

        <div class="tab-pane videoTab active" id="video_Tab" style="display: none;">
            <?php if ($videos=='Y') { ?>
            <div class=" youtube-vd-link">
                <label>Youtube ID:</label>
                <input type="text" class="form-control" id="youtubeID" placeholder="Enter a Youtube video ID" value="">
            </div>
                <button onclick="iFrameVideoChange('Y');" type="button" class="btn btn-green btn-save-style" id="saveStyling" style="display: block;"><span class="fui-check-inverted"></span> Apply Changes</button>
            <?php } ?>
            <?php if ($videos=='V') { ?>
            <div class=" vimeo-vd-link">
                <label>Vimeo ID:</label>
                <input type="text" class="form-control" id="vimeoID" placeholder="Enter a Vimeo video ID" value="">
            </div>
                <button onclick="iFrameVideoChange('V');" type="button" class="btn btn-green btn-save-style" id="saveStyling" style="display: block;"><span class="fui-check-inverted"></span> Apply Changes</button>
            <?php } ?>
        </div>

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
            <input name='subdominio_titulo_en' class='subdominio_titulo_en' id='subdominio_titulo_en' value='<?= htmlentities($titulo_en); ?>' type='hidden'><!-- landing page title-->
            <input name='subdominio_subtitulo_en' id='subdominio_subtitulo_en' value='<?= htmlentities($subtitulo_en); ?>' type='hidden'><!-- landing page sub title-->
            <input name='subdominio_descripcion_en' id='subdominio_descripcion_en' value='<?= htmlentities($descripcion_en); ?>' type='hidden'><!-- landing page textarea-->
            <input name='subdominio_puntos_en' id='subdominio_puntos_en' value='<?= htmlentities($puntos_en); ?>' type='hidden'><!-- landing page bullet area-->
            <input name='subdominio_tituloformulario_en' id='subdominio_tituloformulario_en' value='<?= $titulo_formulario_en; ?>' type='hidden'><!-- landing page form title-->
            <input name='subdominio_textoformulario_en' id='subdominio_textoformulario_en' value='<?= $texto_formulario_en; ?>' type='hidden'><!-- landing page form sub title-->
            <input name='subdominio_boton_en' id='subdominio_boton_en' value='<?= $boton_en; ?>' type='hidden'><!-- landing page form submit button-->
            <input name='subdominio_video_en' id='subdominio_video_en' value='<?= $video_en; ?>' type='hidden'><!-- landing page iframe video-->
            <input name='videos' id='videos' value='<?= $videos; ?>' type='hidden'><!-- landing page video source -->
            <input name='language' id='language' value='eng' type='hidden'>

            <input name='subdominio_logo_bg_en' id='subdominio_logo_bg_en' value='<?php echo $logo_section_bg_en; ?>' type='hidden'>
            <input name='subdominio_titulo_bg_en' id='subdominio_titulo_bg_en' value='<?php echo $title_section_bg_en; ?>' type='hidden'>
            <input name='subdominio_subtitulo_bg_en' id='subdominio_subtitulo_bg_en' value='<?php echo $subtitle_section_bg_en; ?>' type='hidden'>
            <input name='subdominio_textarea_bg_en' id='subdominio_textarea_bg_en' value='<?php echo $textarea_section_bg_en; ?>' type='hidden'>
            <input name='subdominio_puntos_bg_en' id='subdominio_puntos_bg_en' value='<?php echo $bulleted_area_section_bg_en; ?>' type='hidden'>
            <input name='subdominio_form_bg_en' id='subdominio_form_bg_en' value='<?php echo $form_section_bg_en; ?>' type='hidden'>
            <input name='subdominio_tituloformulario_bg_en' id='subdominio_tituloformulario_bg_en' value='<?php echo $form_subtitle_bg_en; ?>' type='hidden'>
            <input name='subdominio_textoformulario_bg_en' id='subdominio_textoformulario_bg_en' value='<?php echo $form_subtitle_bg_en; ?>' type='hidden'>
            <input name='subdominio_footer_bg_en' id='subdominio_footer_bg_en' value='<?php echo $footer_section_bg_en; ?>' type='hidden'>
            <input name='subdominio_avatar_bg_en' id='subdominio_avatar_bg_en' value='' type='hidden'>
            <input name='subdominio_author_info_bg_en' id='subdominio_author_info_bg_en' value='' type='hidden'>
            <input name='subdominio_form_name_placeholder_en' id='subdominio_form_name_placeholder_en' value='<?php echo $form_input_name_placeholder_en; ?>' type='hidden'>
            <input name='subdominio_form_email_placeholder_en' id='subdominio_form_email_placeholder_en' value='<?php echo $form_input_email_placeholder_en; ?>' type='hidden'>
            <input name='subdominio_form_whatsapp_placeholder_en' id='subdominio_form_whatsapp_placeholder_en' value='<?php echo $form_input_whatsapp_placeholder_en; ?>' type='hidden'>
            <input name='subdominio_form_whatsapp_visible_en' id='subdominio_form_whatsapp_visible_en' value='<?php echo $form_input_whatsapp_visible_en; ?>' type='hidden'>
            <input name='subdominio_background_image_library_url_en' id='subdominio_background_image_library_url_en' value='<?php echo $background_image_library_url_en; ?>' type='hidden'>
            <input name='bg_LIBRARY_change_time_en' id='bg_LIBRARY_change_time_en' value='0' type='hidden'>
            <input name='bg_UPLOAD_change_time_en' id='bg_UPLOAD_change_time_en' value='0' type='hidden'>
            <input name='subdominio_form_submit_button_en' id='subdominio_form_submit_button_en' value='<?php echo $form_submit_button_bg_en; ?>' type='hidden'>
            <input name='short_length_cta_button_text_en' id='short_length_cta_button_text_en' value='<?php echo $short_length_cta_button_text_en; ?>' type='hidden'>
            <input name='full_length_cta_button_text_en' id='full_length_cta_button_text_en' value='<?php echo $full_length_cta_button_text_en; ?>' type='hidden'>
            <input name='short_length_cta_button_bg_en' id='short_length_cta_button_bg_en' value='<?php echo $short_length_cta_button_bg_en; ?>' type='hidden'>
            <input name='full_length_cta_button_bg_en' id='full_length_cta_button_bg_en' value='<?php echo $full_length_cta_button_bg_en; ?>' type='hidden'>
            <input name='beta_landing_page_id' id='beta_landing_page_id' value='92' type='hidden'>
            <input name='template_id' id='template_id' value='<?php echo $tem; ?>' type='hidden'>
<!--            <input name='beta_landing_page_id' id='beta_landing_page_id' value='--><?php //echo $beta_landing_page_id; ?><!--' type='hidden'>-->
            <input name="slider_images_list_en" id="slider_images_list_en" value="<?php echo $slider_images_list_en; ?>" type="hidden">
            <input name='subdominio_textarea1_en' id='subdominio_textarea1_en' value='<?php echo $subdominio_textarea1_en; ?>' type='hidden'>
            <input name='subdominio_textarea1_bg_en' id='subdominio_textarea1_bg_en' value='<?php echo $subdominio_textarea1_bg_en; ?>' type='hidden'>
            <input name='subdominio_textarea2_en' id='subdominio_textarea2_en' value='<?php echo $subdominio_textarea2_en; ?>' type='hidden'>
            <input name='subdominio_textarea2_bg_en' id='subdominio_textarea2_bg_en' value='<?php echo $subdominio_textarea2_bg_en; ?>' type='hidden'>
            <input name='subdominio_box1_image_en' id='subdominio_box1_image_en' value='<?php echo $subdominio_box1_image_en; ?>' type='hidden'>
            <input name='subdominio_box2_image_en' id='subdominio_box2_image_en' value='<?php echo $subdominio_box2_image_en; ?>' type='hidden'>
            <input name='subdominio_box3_image_en' id='subdominio_box3_image_en' value='<?php echo $subdominio_box3_image_en; ?>' type='hidden'>
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
<!--                <label>Select Background Image</label>-->
<!--                <input type="file" name="backgroundImageUpload" class="imageUpload" id="backgroundImageUpload" value="">-->
            </div>
			<div class="upload-input">
                    <div class="box-beta">
                        <a style="display: none;" href="#" class="btn-green" id="color_opacity_background">
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
                <!--                <label>Select Background Image</label>-->
                <!--                <input type="file" name="backgroundImageUpload" class="imageUpload" id="backgroundImageUpload" value="">-->
            </div>
            <div class="or-seperator">
                <p class="text-center or">
                    <span>OR</span>
                </p>
            </div>
            <div class="upload-input">
                <label>Upload Background Image</label>
                <input type="file" accept="video/*,image/*" name="backgroundImageUpload" class="imageUpload" id="backgroundImageUpload" onchange='recordDateTime("bg_UPLOAD_change_time_en");'>
            </div>
			<div class="or-seperator">
                    <p class="text-center or">
                        <span>OR</span>
                    </p>
                </div>
                <div class="upload-input">
                    <label>Background Youtube video ID</label>
                    <input type="text" class="form-control" id="youtube_bg_en" name="youtube_bg_en" placeholder="Enter a Background Youtube video ID" value="">
                </div>
        </div>
        </form>
<!--        </form>-->
<!--        Change Background Image<input type="file" name="backgroundImageUpload" class="imageUpload" id="backgroundImageUpload" value="">-->
    </div>

    <div>

        <div>
<!--            <div class="box-beta">-->
<!--                <a class="button" href="#popup1">Library</a>-->
<!--            </div>-->
            <div id="popup1" class="overlay">
                <div class="popup-beta">
                    <span class="close-bg"><a class="close" href="#">&times;</a></span>
                    <div class="select-file">
                        <div class="popup-inner">
                            <?php
                                $dirname = "../../images/bg/thumbnail/";
                                $images = glob($dirname."*.jpg");
//                                echo '<pre>'; print_r($images); exit;
                                foreach ($images as $image){
//                                    echo $image."<br/>";
                                    echo '<div class="popup-img">';
                                    echo '<input type="checkbox" name="">';
                                    echo '<img class="img-responsive" src="'.$image.'"/>';
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
            <!--            <div class="box-beta">-->
            <!--                <a class="button" href="#popup1">Library</a>-->
            <!--            </div>-->
            <div id="popup-video" class="overlay">
                <div class="popup-beta">
                    <span class="close-bg"><a class="close" href="#">&times;</a></span>
                    <div class="select-file">
                        <div class="popup-inner">
                            <?php
                           // $dirname = "../../videos/bg/thumbnail/";
                            //$images = glob($dirname."*.jpg");
							include_once('../youtube_library.php');
                          //  $images = ['fL2Xvkd-9JA', '6sgF_aqN4rM', 'Fgi1YOJT7gs', 'G8QnduC7_SU', 'R9TPrwJtKkI', 'uhc-Eh2DyR8', 'sNGQru0Egrs', 'MdTqMCNxRfY'];
                            foreach ($images as $image){
                                echo '<div class="popup-img">';
                                echo '<input type="checkbox" name="" class="video-responsive" data-title="'.$image.'" data-id="https://www.youtube.com/embed/'. $image .'?autohide=1&rel=0&autoplay=1&iv_load_policy=3&modestbranding=1&controls=0&showinfo=0&disablekb=1&enablejsapi=1&widgetid=1&mute=1&loop=1&playlist='.$image.'&origin=https://www.vioniko.com&modestbranding=1">';
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
$usuario = $usuario = ($usuario_temp != "") ? $usuario_temp : $usuario_temperory;;
$bacgkground_image_src = '';
if(file_exists("./../../images/landingpage/bg/".$usuario."/".$usuario."_en".".jpg")){
    $bacgkground_image_src = '../../images/landingpage/bg/'.$usuario.'/'.$usuario.'_en'.'.jpg';
    $bacgkground_image_src = 'background-image: url('.$bacgkground_image_src.')';
}else if(file_exists("./../../images/landingpage/bg/".$usuario."/".$usuario."_en".".jpeg")){
    $bacgkground_image_src = '../../images/landingpage/bg/'.$usuario.'/'.$usuario.'_en'.'.jpeg';
    $bacgkground_image_src = 'background-image: url('.$bacgkground_image_src.')';
}else if(file_exists("./../../images/landingpage/bg/".$usuario."/".$usuario."_en".".png")){
    $bacgkground_image_src = '../../images/landingpage/bg/'.$usuario.'/'.$usuario.'_en'.'.png';
    $bacgkground_image_src = 'background-image: url('.$bacgkground_image_src.')';
}else if(file_exists("./../../images/landingpage/bg/".$usuario."/".$usuario."_en".".gif")){
    $bacgkground_image_src = '../../images/landingpage/bg/'.$usuario.'/'.$usuario.'_en'.'.gif';
    $bacgkground_image_src = 'background-image: url('.$bacgkground_image_src.')';
}
if ($bacgkground_image_src == '' && $background_image_library_url_en != ''){
    $bacgkground_image_src = 'background-image: url('.$background_image_library_url_en.')';
}
$usuario = $usuario_temperory;
?>
<div class="content" id="content" <?php if($video_src != ""){ ?> style="background: none; background-image: none;" <?php } ?> <?php if ($bacgkground_image_src != ''){?> style="<?php echo $bacgkground_image_src; ?>" <?php } ?> >
	<div class="layer" <?php if($subdominio_body_background_color != ""){ ?> style="background-color: <?php echo $subdominio_body_background_color; ?>;" <?php } ?>>
        <div style="padding: 40px">
    <div class="container-fluid">
        <div class="row">
            <div class="large-12 columns cont-datos" align="right" style="padding-right: 7px;">
<span><? if ($landing) $url='index_beta.php?landing='.$landing.$edit_param;
    elseif ($usuario || $version) $url='index_beta.php?usuario='.$usuario.'&v='.$version.$edit_param;
    else $url='index_beta.php?subdominio='.$subdominio.$edit_param; ?>
    <a href="<?= $url; ?>" class="emaillink"><img src="img/es.png" width="16" height="11" alt="">  Espa&ntilde;ol</a></span>
            </div>
        </div>

        <!-- Template Header starts -->
        <div class="row">
            <div class="section-bg">
                <div class="temp-header hover-edit">
                    <?php //echo $logo_section_bg_en; exit; ?>
                    <div class="logo-section" data-id="landing-page-logo" <?php if($logo_section_bg_en != ''){ ?> style="background: <?php echo $logo_section_bg_en;?>" <?php } ?>>
                        <?= $logotipo_en; ?>
                    </div>
                    <!-- Edit Starts -->
                    <div class="edit-btn-container">
                        <a id="logo" onclick="imageSectionEdit(this.id); openNav();" href="javascript:void(0);" class="edit-btn1"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
					<?php //echo "here"; exit; ?>
                    <!-- Edit Ends -->
                </div>
                <div class="hover-edit">
                    <div class="temp-title" data-id="landing-page-title" <?php if($title_section_bg_en != ''){ ?> style="background: <?php echo $title_section_bg_en;?>" <?php } ?>>
                        <?php
                        $titulo_en = str_replace('<h1></h1>', '', $titulo_en);
                        if(strpos($titulo_en, 'h1') == false){
                            echo '<h1>'.$titulo_en.'</h1>';
                        }else{
                            echo $titulo_en;
                        }
                        ?>
                    </div>
                    <!-- Edit Starts -->
                    <div class="edit-btn-container">
                        <a id="title" onclick="sectionEdit(this.id); openNav();" href="javascript:void(0);" class="edit-btn1"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                    <!-- Edit Ends -->
                </div>
                <div class="hover-edit">
                    <div class="temp-subtitle" data-id="landing-page-sub-title" <?php if($subtitle_section_bg_en != ''){ ?> style="background: <?php echo $subtitle_section_bg_en;?>" <?php } ?>>
                        <?php
                        $subtitulo_en = str_replace('h6', 'delete', $subtitulo_en);
                        $subtitulo_en = str_replace('<delete>', '', $subtitulo_en);
                        echo '<h6>'.$subtitulo_en.'</h6>';
                        ?>
                        <?php str_replace('<h6></h6>', '', $subtitulo_en); ?>
                    </div>
                    <!-- Edit Starts -->
                    <div class="edit-btn-container">
                        <a id="sub-title" onclick="sectionEdit(this.id); openNav();" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                    <!-- Edit Ends -->
                </div>
            </div>
        </div>
        <!-- Template Header Ends -->
        <div class="space"></div>
        <!-- Video/Form section Starts -->
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12"></div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="section-bg">
                    <div class="hover-edit ">
                        <div class="flex-video">
                            <? if ($videos=='Y') { //rGHI4YBwbCo?>
                                <iframe id="youtube-video" src="//www.youtube.com/embed/<?= $video_en; ?>?rel=0&modestbranding=1&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;autohide=1" width="100%" height="220px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            <? } elseif ($videos=='V') { //127297879?>
                                <iframe id="vimeo-video" src="https://player.vimeo.com/video/<?= $video_en; ?>?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;badge=0" width="100%" height="225px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>
                            <? } ?>
                        </div>
                        <!-- Edit Starts -->
                        <div class="edit-btn-container">
                            <a id="video" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </div>
                        <!-- Edit Ends -->
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="section-bg">
                    <div class="form-new new" data-id="landing-page-whole-form" <?php if($form_section_bg_en != "") { ?> style="background: <?php echo $form_section_bg_en; ?>" <?php } ?> >
<!--                        <div></div>-->
                        <!-- Edit Starts -->
                        <div class="edit-btn-container">
                            <a id="whole-form" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </div>
                        <!-- Edit Ends -->
                        <div class="temp-form">
                            <div class="hover-edit">
                                <div class="form-title" data-id="landing-page-form-title" <?php if($form_title_bg_en != ''){ ?> style="background: <?php //echo $form_title_bg_en;?>" <?php } ?>>
                                    <h2><?= $titulo_formulario_en; ?></h2>
                                </div>
                                <!-- Edit Starts -->
                                <div class="edit-btn-container">
                                    <a id="form-title" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </div>
                                <!-- Edit Ends -->
                            </div>
                            <div class="hover-edit">
                                <div class="form-subtitle" data-id="landing-page-form-sub-title" <?php if($form_subtitle_bg_en != ''){ ?> style="background: <?php //echo $form_subtitle_bg_en;?>" <?php } ?>>
                                    <h6><?= $texto_formulario_en; ?></h6>
                                </div>
                                <!-- Edit Starts -->
                                <div class="edit-btn-container">
                                    <a id="form-subtitle" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </div>
                                <!-- Edit Ends -->
                            </div>
                            <form action="<?php echo $result ?>" method="post" class="cf op-optin-validation" data-abide>
                                <div class=" hover-edit">
                                    <div class="form-group">
                                        <input type="text" name="nombre" class="form-control" id="name" required pattern="[a-zA-Z]+" placeholder="<?php echo ($form_input_name_placeholder_en != "") ? $form_input_name_placeholder_en : 'Enter your name' ?>" data-id="form-name-placeholder">
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
                                        <input type="email" name="email" class="form-control" required id="e-mail" placeholder="<?php echo ($form_input_email_placeholder_en != "") ? $form_input_email_placeholder_en : 'Enter your e-mail' ?>" data-id="form-email-placeholder">
                                        <small class="error-beta" style="display: none;">You must enter a e-mail.</small>
                                    </div>
                                    <!-- Edit Starts -->
                                    <div class="edit-btn-container">
                                        <a id="form-email" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    </div>
                                    <!-- Edit Ends -->
                                </div>
                                <div class="hover-edit" id="whatsapp_field_div" <?php if($form_input_whatsapp_visible_en == '1'){ ?> style="display: none" <?php }?>>
                                    <div class="form-group">
                                        <input type="tel" name="telefono_casa" class="form-control" id="whatsapp" placeholder="<?php echo ($form_input_whatsapp_placeholder_en != "") ? $form_input_whatsapp_placeholder_en : 'Enter your whatsapp' ?>" data-id="form-whatsapp-placeholder">
                                    </div>
                                    <!-- Edit Starts -->
                                    <div class="edit-btn-container">
                                        <a id="form-whatsapp" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <a href="javascript:void(0);" onclick="(($(this).parent('.edit-btn-container')).parent('.hover-edit')).hide(); $('#whatsapp_field_div').hide();$('#whatsapp_show_again').removeAttr('checked'); $('#whatsapp_show_again_div').show(); $('#subdominio_form_whatsapp_visible_en').val(1);" class="dlt-btn"><i class="fa fa-trash"></i></a>
                                    </div>
                                    <!-- Edit Ends -->
                                </div>
                                <?php //if($form_input_whatsapp_visible_en == '1'){ ?>
                                <div class="hover-edit12" id="whatsapp_show_again_div" <?php if($form_input_whatsapp_visible_en == '1'){ ?> style="display: block;" <?php } ?> style="display: none;">
                                        <div class="form-group">
                                            <input type="checkbox" style="opacity:1; position: relative;" name="whatsapp_show_again" id="whatsapp_show_again" value="whatsapp_show_again">Show whatsapp field
                                        </div>
                                    </div>
                                <?php //} ?>
                                <div class="hover-edit">
                                    <div class="form-group">
                                        <button <?php if($form_submit_button_bg_en != '') { ?> style="background: <?php echo $form_submit_button_bg_en; ?>" <?php } ?> type="submit" data-id="landing-page-form-submit-button" class="btn btn-default btn-submit"><?= $boton_en; ?></button>
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
                                <input type="hidden" name="idioma" id="idioma" value="en">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-12"></div>
        </div>
        <!-- Video/Form section Ends -->
        <div class="space"></div>
        <!-- Text section Starts -->
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="section-bg">
                        <div class="hover-edit">
                            <div class="temp-text" data-id="landing-page-text-area" <?php if($textarea_section_bg_en != ""){ ?> style="background: <?php echo $textarea_section_bg_en;?>" <?php } ?> >
                                <?= $descripcion_en; ?>
                            </div>
                            <!-- Edit Starts -->
                            <div class="edit-btn-container">
                                <a id="text-area" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </div>
                            <!-- Edit Ends -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-xs-12">
                    <div class="section-bg">
                        <div class=" hover-edit">
                            <div class="temp-bullets" data-id="landing-page-bullet-area" <?php if($bulleted_area_section_bg_en != ""){ ?> style="background: <?php echo $bulleted_area_section_bg_en;?>" <?php } ?> >
                                <?  echo $puntos_en;
                                //                                    for ($i=0; $i<count($array_puntos); $i++) {
                                //                                        $renglon = trim($array_puntos[$i]);
                                //                                        if (!empty($renglon) AND $renglon!=chr(13))
                                //                                            echo '<li style=\'background-image:url("vineta.png");background-repeat:no-repeat;\'>'.$renglon.'</li>';
                                //                                    }
                                ?>
                            </div>
                            <!-- Edit Starts -->
                            <div class="edit-btn-container">
                                <a id="bullets-area" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </div>
                            <!-- Edit Ends -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
        <!-- Text section Ends -->

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
</body>
</html>