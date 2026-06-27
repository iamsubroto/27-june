<? $template = 4; include_once('../../subdominio_ini.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><? echo $rowUSU['meta_titulo']; ?></title>

    <meta name="description" content="<? echo $rowUSU['meta_descripcion']; ?>" />
    <meta name="keywords" content="<? echo $rowUSU['meta_palabras']; ?>" />
    <meta name="author" content="<? echo $rowUSU['nombre'].' '.$rowUSU['apellidos']; ?>" />

    <!-- Para Facebook y otros -->
    <meta property="og:site_name" content="<? echo $rowUSU['meta_titulo']; ?>">
    <meta property="og:title" content="<? echo $rowUSU['meta_titulo']; ?>">
    <meta property="og:type" content="website">
    <!--    <meta property="og:url" content="http://--><?// echo $rowADMIN['url_dominio']; ?><!--/landingpage/4/index.php?subdominio=--><?// echo $rowUSU['subdominio']; ?><!--">-->
    <!--    <meta property="og:image" content="http://--><?// echo $rowADMIN['url_dominio']; ?><!--/landingpage/4/fb.jpg">-->
    <meta property="og:description" content="<? echo $rowUSU['meta_descripcion']; ?>">

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
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../css/landingpage/bootstrap_3.3.7_css_bootstrap.min.css">
    <!-- Template Custom Style -->
    <link href="css/template-style.css" rel="stylesheet">
    <?php
    include_once "../../usuarios/functions.php";
    echo getUserPixelCode($rowUSU["clave"], "fbpixel_lp");
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
//            var top = $(document).scrollTop();
//            $("#mySidenav").scrollTop( top );
            /***
             Initialize textarea with CKEditor, pick the custom config and on any kind of change,
             call copyValue() to assign formatted text to landing page section
             ***/
            $(".img-responsive").click(function () {
                $('#background-video').css('display', "none");
                $('#background-video').attr('src', '');
                $("#content").css("background-image",'url('+$(this).attr("src")+')');
                $("#subdominio_background_image_library_url").val($(this).attr("src"));
                recordDateTime('bg_LIBRARY_change_time_en');
            });

            $(".video-responsive").click(function () {
                $("#content").css("background",'none');
                $("#content").css("background-image",'none');
                $('#background-video').css('display', "block");
                $('#background-video').attr('src', $(this).attr("src"));
//                $("#content").css("background-image",'url('+$(this).attr("src")+')');
                $("#subdominio_background_image_library_url").val($(this).attr("src"));
                recordDateTime('bg_LIBRARY_change_time_en');
            });
            $(".popup-img").click(function (){
                var current = $(this);
//                $(this) = '';
//                alert("current"+current);
                $(".popup-inner .pupup-img").each( function() {
//                    alert("here"+$(this));
                    $(this).find('input').removeAttr("checked");
                    $(this).find('input').attr("checked", "");
                });
                current.find("input").attr("checked", "checked");
            })
            CKEDITOR.replace( 'mytextarea', {
                customConfig: '../../js/vendor/ckeditor/ckeditor_config.js',
//                format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;address;div',
                on: {
                    change: function() {
                        // Sync section with textarea formatted content.
                        copyValue();
                    }
                }
            });
            $("#sectionImageUpload").change(function(){
                readURLSection(this);
            });

            $("#sectionAvatarUpload").change(function(){
                readURLSection(this);
            });

            $("#backgroundImageUpload").change(function(){
                readURL(this);
            });
            $('#whatsapp_show_again').click(function(){
                $("#whatsapp_field_div").show();
                $("#whatsapp_show_again_div").hide();
                $('#subdominio_form_whatsapp_visible').val(0);
            })
//            else{
//                $("#whatsapp_field_div").hide();
//                $("#whatsapp_show_again_div").show();
//            }
//            $("#")
//            $('#change-background-image').colorpicker().on('changeColor', function(e) { $('body')[0].style.backgroundColor = e.color.toString( 'rgba'); });
        });
        $(document).foundation();
        function sectionEdit(section){
//            alert(section);
            var top = $(document).scrollTop();
            $("#mySidenav").css("top", top);
            $("#change-logo-section").hide();
            $("#change-avatar-section").hide();
//            $("#sectionImageUploadSpan").hide();
//            $("#cke_mytextarea").val('');
//            CKEDITOR.instances.mytextarea.setData('');
            $("div.hover-edit").each(function(index){
                $(this).find("div:first").removeClass("activeSection");
                $(this).find("div:first").find("input").removeClass("activeSection");
                $(this).find("div:first").find("button").removeClass("activeSection");
                $(".new").removeClass("activeSection");
                $(".temp-footer").removeClass("activeSection");
            });
            $(".temp-footer").removeClass("activeSection");
            var mainSection, contentSection = '';
            mainSection = (($("#"+section).parent(".edit-btn-container")).parent(".hover-edit"));
            if(section == 'whole-form'){
                var mainSection12 = ($("#"+section).parent(".edit-btn-container")).parent(".new");
                mainSection12.addClass("activeSection");
                $("#cke_mytextarea").hide();
            }
            if(section == 'footer-whole-section'){
                var mainSection12 = ($("#"+section).parent(".edit-btn-container")).parent(".temp-footer");
                mainSection12.addClass("activeSection");
                $("#cke_mytextarea").hide();
            }
            if(section != 'whole-form' && section != 'footer-whole-section') {
                if (section == "form-name" || section == "form-email" || section == "form-whatsapp") {
                    contentSection = mainSection.find("input");
                    contentSection.addClass("activeSection");
                    contentSection = contentSection.attr("placeholder");
                } else if (section == "form-submit") {
                    contentSection = mainSection.find("button");
                    contentSection.addClass("activeSection");
//              contentSection = contentSection.attr("placeholder");
                }
                else {
                    contentSection = mainSection.find("div:first");
                    contentSection.addClass("activeSection");
                }
//            CKEDITOR.instances.mytextarea.setData('');
                if (section != 'video') { // Will not copy section {video} content to textarea
                    $("#video_Tab").hide();
                    $("#cke_mytextarea").show();
                    //uncaught exception: The editor instance "mytextarea" is already attached to the provided element.
//                alert(contentSection.html());

                    if (section == "form-name" || section == "form-email" || section == "form-whatsapp") {
                        CKEDITOR.instances.mytextarea.setData(contentSection);
                    } else {
//                        alert(contentSection.html());
                        CKEDITOR.instances.mytextarea.setData(contentSection.html());
                    }
                }
                if (section == 'video') {
//                CKEDITOR.instances.mytextarea.destroy();
                    $("#cke_mytextarea").hide();
                    $("#video_Tab").show();
                }
            } //section != 'whole-form' end
            $('#cp4').css("display", "block");
            if(section == 'whole-form'){
//                alert(section);
                $('#cp4').colorpicker().on('changeColor', function(e) {
                    $(".activeSection")[0].style.backgroundColor = e.color.toString( 'rgba');
                    copySectionBGToFormFields(e.color.toString( 'rgba'));
                });

            }else{
                $('#cp4').colorpicker().on('changeColor', function(e) {
                    $(".activeSection")[0].style.backgroundColor = e.color.toString( 'rgba');
                    copySectionBGToFormFields(e.color.toString( 'rgba'));
                });
            }
        }

        function imageSectionEdit(sectionId){
            $("#change-logo-section").hide();
            $("#change-avatar-section").hide();
            if(sectionId == 'logo'){
                $("#change-logo-section").show();
            }
            if(sectionId == 'footer-avatar'){
                $("#change-avatar-section").show();
            }
//            $("#sectionImageUploadSpan").show();
            var top = $(document).scrollTop();
            $("#mySidenav").css("top", top);
            $("#cke_mytextarea").hide();
            $("div.hover-edit").each(function(index){
                $(this).find("div:first").removeClass("activeSection");
                $(this).find("div:first").find("input").removeClass("activeSection");
                $(this).find("div:first").find("button").removeClass("activeSection");
            });
            $(".new").removeClass("activeSection");
            $(".temp-footer").removeClass("activeSection");
            mainSection = (($("#"+sectionId).parent(".edit-btn-container")).parent(".hover-edit"));
            contentSection = mainSection.find("div:first");
            contentSection.addClass("activeSection");

            $('#cp4').css("display", "block");
            $('#cp4').colorpicker().on('changeColor', function(e) {
                $(".activeSection")[0].style.backgroundColor = e.color.toString( 'rgba');
                copySectionBGToFormFields(e.color.toString( 'rgba'));
            });
//            $("#"+sectionId).addClass("activeSection");
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
//                alert(input.files[0].type );
                var reader = new FileReader();
//var value1 = input;
//alert("here"+input.files);
//console.log("here"+input.files);
                reader.onload = function (e) {
//                    alert(e.target.result);
//                    $('.activeSection img').attr('src', e.target.result);
//                    $('body').css("background", e.target.result);
//                    $("body").css("background-image",'url('+e.target.result+')');
                    if(input.files[0].type == "video/mp4"){
                        $('#background-video').css('display', "block");
                        $('#background-video').attr('src', URL.createObjectURL(input.files[0]));
                        $("#content").css("background",'none');
                        $("#content").css("background-image",'none');
                    }else{
                        $('#background-video').css('display', "none");
                        $('#background-video').attr('src', '');
                    $("#content").css("background-image",'url('+e.target.result+')');
                    $("#background_image").val(e.target.result);
                    }

//                    $('body').css("background-color", "white");
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLSection(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
//                var value1 = input;
//                alert("here"+input.files);
//                console.log("here"+input.files);
                reader.onload = function (e) {
                    $('.activeSection img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function iFrameVideoChange(videoId){
//            youtubeID, vimeoID, youtube-video, vimeo-video
            var videoIdValue = '';
//            if($("#youtubeID").val() != ""){
            if(videoId == "Y"){
                videoIdValue = $("#youtubeID").val();
                $("#videos").val("Y");
                $("#subdominio_video").val(videoIdValue);
                var val = "//www.youtube.com/embed/"+videoIdValue+"?rel=0&modestbranding=1&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;autohide=1";
//                    ?rel=0&modestbranding=1&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;autohide=1
                $("#youtube-video").attr('src', val);//https://www.youtube.com/embed/iJhMN49B3ig
                $("#vimeo-video").attr('src', val);//http://www.youtube.com/embed/rGHI4YBwbCo
            }
            if(videoId == "V"){
                videoIdValue = $("#vimeoID").val();
                $("#videos").val("V");
                $("#subdominio_video").val(videoIdValue);
                var val = "https://player.vimeo.com/video/"+videoIdValue+"?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;badge=0";
//                autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;badge=0
                $("#youtube-video").attr('src', val);
                $("#vimeo-video").attr('src', val);
            }
        }

        function copyValue(){
//            alert(data);
            var attr = $(".activeSection").attr("placeholder");
//            alert(attr);
//            var button_attr = $("button.activeSection").attr("type");
            if( typeof attr !== 'undefined' || attr != null){
//                alert("1");
                var data = CKEDITOR.instances.mytextarea.document.getBody().getText();
                copySectionValuesToFormFields(data);
                $(".activeSection").attr("placeholder", data);
                $(".activeSection").html(data);
            }else{
//                alert("2");
                if($(".activeSection").attr("data-id") == 'landing-page-bullet-area'){
//                    var data = CKEDITOR.instances.mytextarea.document.getBody().getText();

                    var data = CKEDITOR.instances.mytextarea.getData();
//                    alert(data);
                    copySectionValuesToFormFields(data);
                    $(".activeSection").html(data);
                }else{
                    var data = CKEDITOR.instances.mytextarea.getData();
                    copySectionValuesToFormFields(data);
                    $(".activeSection").html(data);
                }
            }
        }

        function copySectionBGToFormFields(bg){
            var sectionId = $(".activeSection").attr("data-id");
            if(sectionId == 'landing-page-title'){
                $("#subdominio_titulo_bg").val(bg);
            }
            if(sectionId == 'landing-page-logo'){
                $("#subdominio_logo_bg").val(bg);
            }
            if(sectionId == 'landing-page-sub-title'){
                $("#subdominio_subtitulo_bg").val(bg);
            }
            if(sectionId == 'landing-page-form-title'){
                $("#subdominio_tituloformulario_bg").val(bg);
            }
            if(sectionId == 'landing-page-form-sub-title'){
                $("#subdominio_textoformulario_bg").val(bg);
            }
//            if(sectionId == 'landing-page-form-submit-button'){
//                $("#subdominio_boton").val(bg);
//            }
            if(sectionId == 'landing-page-text-area'){
                $("#subdominio_textarea_bg").val(bg);
            }
            if(sectionId == 'landing-page-bullet-area'){
                $("#subdominio_puntos_bg").val(bg);
            }
            if(sectionId == 'landing-page-whole-footer'){
                $("#subdominio_footer_bg").val(bg);
            }
            if(sectionId == 'landing-page-whole-form'){
                $("#subdominio_form_bg").val(bg);
            }
            if(sectionId == 'landing-page-form-submit-button'){
                $("#subdominio_form_submit_button").val(bg);
            }
        }

        function copySectionValuesToFormFields(value){
            var sectionId = $(".activeSection").attr("data-id");
            if(sectionId == 'landing-page-title'){
                $("#subdominio_titulo").val(value);
            }
            if(sectionId == 'landing-page-sub-title'){
                $("#subdominio_subtitulo").val(value);
            }
            if(sectionId == 'landing-page-form-title'){
                $("#subdominio_tituloformulario").val(value);
            }
            if(sectionId == 'landing-page-form-sub-title'){
                $("#subdominio_textoformulario").val(value);
            }
            if(sectionId == 'landing-page-form-submit-button'){
                $("#subdominio_boton").val(value);
            }
            if(sectionId == 'form-name-placeholder'){
                $("#subdominio_form_name_placeholder").val(value);
            }
            if(sectionId == 'form-email-placeholder'){
                $("#subdominio_form_email_placeholder").val(value);
            }
            if(sectionId == 'form-whatsapp-placeholder'){
                $("#subdominio_form_whatsapp_placeholder").val(value);
            }

            if(sectionId == 'landing-page-text-area'){
                $("#subdominio_descripcion").val(value);
            }
            if(sectionId == 'landing-page-bullet-area'){
                $("#subdominio_puntos").val(value);
            }
        }
        var comparsionValueForLU = 0;
        function recordDateTime(libraryORuploadId) {
//            var today = new Date();
//            alert(today);
            comparsionValueForLU++;
//            alert(comparsionValueForLU);
            $("#"+libraryORuploadId).val(comparsionValueForLU);
        }


        function openNav() {
            document.getElementById("mySidenav").style.position = "absolute";
            document.getElementById("mySidenav").style.display = "block";
            document.getElementById("content").style.left = "320px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.position = "static";
            document.getElementById("mySidenav").style.display = "none";
            document.getElementById("content").style.left = "0";
        }

    </script>
</head>
<body style="background: none !important;">
<?php
$video_src = '';
if(file_exists("./../../images/landingpage/bg/".$usuario."/".$usuario.".mp4")){
    $video_src = '../../images/landingpage/bg/'.$usuario.'/'.$usuario.'.mp4';
//    $video_src = 'background-image: url('.$video_src.')';
}
if ($video_src == '' && $background_image_library_url != ''){
    $video_src = $background_image_library_url;
}
?>
<video id="background-video" style="min-width: 100%; min-height: 100%; position: fixed; z-index: -1; <?php if($video_src != ""){ ?>display: block;<?php } else{ ?> display: none; <?php } ?>" src="<?php if($video_src != ""){ echo $video_src; }?>" autoplay="" loop="">
</video>
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
            <!--            <div class="or-seperator">-->
            <!--                <p class="text-center or">-->
            <!--                    <span>OR</span>-->
            <!--                </p>-->
            <!--            </div>-->
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

        <!--        <span id="sectionImageUploadSpan">Change Section logo/image</span>-->
        <!--        <input type="file" name="sectionImageUpload" class="imageUpload" id="sectionImageUpload" value="">-->
        <!--        <form action="../../landingpage_data_save.php" method="post" enctype="multipart/form-data" name="uploadbgLogo" id="uploadbgLogo" class="form-horizontal">-->
<?php //echo $descripcion; exit;?>
        <form action="../../landingpage_data_save_en.php" method="post" enctype="multipart/form-data" name="forma" id="forma" class="form-horizontal">
            <input name='subdominio_titulo' class='subdominio_titulo' id='subdominio_titulo' value='<?= $titulo; ?>' type='hidden'><!-- landing page title-->
            <input name='subdominio_subtitulo' id='subdominio_subtitulo' value='<?= $subtitulo; ?>' type='hidden'><!-- landing page sub title-->
            <input name='subdominio_descripcion' id='subdominio_descripcion' value='<?= $descripcion; ?>' type='hidden'><!-- landing page textarea-->
            <input name='subdominio_puntos' id='subdominio_puntos' value='<?= $puntos; ?>' type='hidden'><!-- landing page bullet area-->
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
            <input name='subdominio_form_submit_button' id='subdominio_form_submit_button' value='' type='hidden'>

            <!--            <input name="logo_image" id="logo_image" value="" type="hidden">-->
            <!--            <input name="background_image" id="background_image" value="" type="hidden">-->

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
                    <label>Upload Background Image/video</label>
<!--                    Warning: POST Content-Length of 48387348 bytes exceeds the limit of 8388608 bytes in Unknown on line 0-->
                    <input type="file" accept="video/*,image/*" name="backgroundImageUpload" class="imageUpload" id="backgroundImageUpload" onchange='recordDateTime("bg_UPLOAD_change_time_en");'>
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
                            $dirname = "../../images/bg/";
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
                            $dirname = "../../videos/bg/";
                            $images = glob($dirname."*.mp4");
                            //                                echo '<pre>'; print_r($images); exit;
                            foreach ($images as $image){
//                                    echo $image."<br/>";
                                echo '<div class="popup-img">';
                                echo '<input type="checkbox" name="">';
                                echo '<video class="video-responsive" src="'.$image.'"></video>';
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
//echo "./../../images/landingpage/bg/".$usu_valido."/".$usu_valido."".".png"; exit;
$bacgkground_image_src = '';
if(file_exists("./../../images/landingpage/bg/".$usuario."/".$usuario."".".jpg")){
    $bacgkground_image_src = '../../images/landingpage/bg/'.$usuario.'/'.$usuario.''.'.jpg';
    $bacgkground_image_src = 'background-image: url('.$bacgkground_image_src.')';
}else if(file_exists("./../../images/landingpage/bg/".$usuario."/".$usuario."".".jpeg")){
    $bacgkground_image_src = '../../images/landingpage/bg/'.$usuario.'/'.$usuario.''.'.jpeg';
    $bacgkground_image_src = 'background-image: url('.$bacgkground_image_src.')';
}else if(file_exists("./../../images/landingpage/bg/".$usuario."/".$usuario."".".png")){
    $bacgkground_image_src = '../../images/landingpage/bg/'.$usuario.'/'.$usuario.''.'.png';
    $bacgkground_image_src = 'background-image: url('.$bacgkground_image_src.')';
}else if(file_exists("./../../images/landingpage/bg/".$usuario."/".$usuario."".".gif")){
    $bacgkground_image_src = '../../images/landingpage/bg/'.$usuario.'/'.$usuario.''.'.gif';
    $bacgkground_image_src = 'background-image: url('.$bacgkground_image_src.')';
}
if ($bacgkground_image_src == '' && $background_image_library_url != ''){
    $bacgkground_image_src = 'background-image: url('.$background_image_library_url.')';
}
//echo "here".$bacgkground_image_src; exit;
?>
<div class="content" id="content" <?php if($video_src != ""){ ?> style="background: none; background-image: none;" <?php } ?> <?php if ($bacgkground_image_src != ''){?> style="<?php echo $bacgkground_image_src; ?>" <?php } ?> >
    <!--    <a href="#" class="btn btn-default" id="cp4">Change background color</a> <script> $(function() { $('#cp4').colorpicker().on('changeColor', function(e) { $('body')[0].style.backgroundColor = e.color.toString( 'rgba'); }); }); </script>-->
    <div class="container-fluid">
        <div class="row">
            <div class="large-12 columns cont-datos" align="right">
             <span><? if ($landing) $url='index_en_beta.php?landing='.$landing;
                 elseif ($usuario AND $version) $url='index_en_beta.php?usuario='.$usuario.'&v='.$version;
                 else $url='index_en_beta.php?subdominio='.$subdominio; ?>
                 <a href="<?= $url; ?>" class="emaillink"><img src="img/gb.png" width="16" height="11" alt=""> English</a>
            </span>
            </div>
        </div>

        <!-- Template Header starts -->
        <div class="row">
            <div class="section-bg">
                <div class="temp-header hover-edit">
                    <?php //echo $logo_section_bg; exit; ?>
                    <div class="logo-section" data-id="landing-page-logo" <?php if($logo_section_bg != ''){ ?> style="background: <?php echo $logo_section_bg;?>" <?php } ?>>
                        <?= $logotipo; ?>
                        <!--                        <a href="#" class="logo">-->
                        <!--                            <img width="150" height="47" src="../../img/logo.png">-->
                        <!--                        </a>-->
                    </div>
                    <!-- Edit Starts -->
                    <div class="edit-btn-container">
                        <a id="logo" onclick="imageSectionEdit(this.id); openNav();" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                    <!-- Edit Ends -->
                </div>
                <div class="hover-edit">
                    <div class="temp-title" data-id="landing-page-title" <?php if($title_section_bg != ''){ ?> style="background: <?php echo $title_section_bg;?>" <?php } ?>>
                        <?php
                        $titulo = str_replace('<h1></h1>', '', $titulo);
                        if(strpos($titulo, 'h1') == false){
                            echo '<h1>'.$titulo.'</h1>';
                        }else{
                            echo $titulo;
                        }
                        ?>
                    </div>
                    <!-- Edit Starts -->
                    <div class="edit-btn-container">
                        <a id="title" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </div>
                    <!-- Edit Ends -->
                </div>
                <div class="hover-edit">
                    <div class="temp-subtitle" data-id="landing-page-sub-title" <?php if($subtitle_section_bg != ''){ ?> style="background: <?php echo $subtitle_section_bg;?>" <?php } ?>>
                        <?php
                        $subtitulo = str_replace('h6', 'delete', $subtitulo);
                        $subtitulo = str_replace('<delete>', '', $subtitulo);
                        echo '<h6>'.$subtitulo.'</h6>';
                        ?>
                        <?php str_replace('<h6></h6>', '', $subtitulo); ?>
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
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12"></div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="section-bg">
                    <div class="hover-edit ">
                        <div class="flex-video">
                            <? if ($videos=='Y') { //rGHI4YBwbCo?>
                                <iframe id="youtube-video" src="//www.youtube.com/embed/<?= $video; ?>?rel=0&modestbranding=1&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;autohide=1" width="100%" height="220px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            <? } elseif ($videos=='V') { //127297879?>
                                <iframe id="vimeo-video" src="https://player.vimeo.com/video/<?= $video; ?>?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;badge=0" width="100%" height="225px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>
                            <? } ?>
                            <!--                            <iframe autoplay="false" src="https://player.vimeo.com/video/120790929?title=0&amp;byline=0&amp;portrait=0&amp;badge=0" frameborder="0"></iframe>-->
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
                    <div class="new" data-id="landing-page-whole-form" <?php if($form_section_bg != "") { ?> style="background: <?php echo $form_section_bg; ?>" <?php } ?> >
                        <!--                        <div></div>-->
                        <!-- Edit Starts -->
                        <div class="edit-btn-container">
                            <a id="whole-form" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </div>
                        <!-- Edit Ends -->
                        <div class="temp-form">
                            <div class="hover-edit">
                                <div class="form-title" data-id="landing-page-form-title" <?php if($form_title_bg != ''){ ?> style="background: <?php //echo $form_title_bg;?>" <?php } ?>>
                                    <h2><?= $titulo_formulario; ?></h2>
                                </div>
                                <!-- Edit Starts -->
                                <div class="edit-btn-container">
                                    <a id="form-title" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </div>
                                <!-- Edit Ends -->
                            </div>
                            <div class="hover-edit">
                                <div class="form-subtitle" data-id="landing-page-form-sub-title" <?php if($form_subtitle_bg != ''){ ?> style="background: <?php //echo $form_subtitle_bg;?>" <?php } ?>>
                                    <h6><?= $texto_formulario; ?></h6>
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
                                        <input type="text" name="nombre" class="form-control" id="name" required pattern="[a-zA-Z]+" placeholder="<?php echo ($form_input_name_placeholder != "") ? $form_input_name_placeholder : 'Ingresa tu Nombre' ?>" data-id="form-name-placeholder">
                                        <small class="error-beta" style="display: none;">You must enter your name.</small>
                                    </div>
                                    <!-- Edit Starts -->
                                    <div class="edit-btn-container">
                                        <a id="form-name" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn">
                                            <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <!--                                        <a href="#" class="dlt-btn"><i class="fa fa-trash"></i></a>-->
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
                                        <!--                                        <a href="#" class="dlt-btn"><i class="fa fa-trash"></i></a>-->
                                    </div>
                                    <!-- Edit Ends -->
                                </div>
                                <?php //if($form_input_whatsapp_visible != '1'){ ?>
                                    <div class="hover-edit" id="whatsapp_field_div" <?php if($form_input_whatsapp_visible == '1'){ ?> style="display: none" <?php }?>>
                                        <div class="form-group">
                                            <input type="tel" class="form-control" id="whatsapp" placeholder="<?php echo ($form_input_whatsapp_placeholder != "") ? $form_input_whatsapp_placeholder : 'Ingresa tu whatsapp' ?>" data-id="form-whatsapp-placeholder">
                                        </div>
                                        <!-- Edit Starts -->
                                        <div class="edit-btn-container">
                                            <a id="form-whatsapp" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="javascript:void(0);" onclick="(($(this).parent('.edit-btn-container')).parent('.hover-edit')).hide(); $('#whatsapp_field_div').hide();$('#whatsapp_show_again').removeAttr('checked'); $('#whatsapp_show_again_div').show(); $('#subdominio_form_whatsapp_visible').val(1);" class="dlt-btn"><i class="fa fa-trash"></i></a>
                                        </div>
                                        <!-- Edit Ends -->
                                    </div>
                                <?php if($form_input_whatsapp_visible == '1'){ ?>
                                <div class="hover-edit12" id="whatsapp_show_again_div">
                                    <div class="form-group">
                                        <input type="checkbox" style="opacity:1; position: relative;" name="whatsapp_show_again" id="whatsapp_show_again" value="whatsapp_show_again">Show whatsapp field
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="hover-edit">
                                    <div class="form-group">
                                        <button <?php if($form_submit_button_bg != '') { ?> style="background: <?php echo $form_submit_button_bg; ?>" <?php } ?> type="submit" data-id="landing-page-form-submit-button" class="btn btn-default btn-submit"><?= $boton; ?></button>
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
                            <div class="temp-text" data-id="landing-page-text-area" <?php if($textarea_section_bg != ""){ ?> style="background: <?php echo $textarea_section_bg;?>" <?php } ?> >
                                <?= $descripcion; ?>
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
                            <div class="temp-bullets" data-id="landing-page-bullet-area" <?php if($bulleted_area_section_bg != ""){ ?> style="background: <?php echo $bulleted_area_section_bg;?>" <?php } ?> >
                                <?  echo $puntos;
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
        <div class="space"></div>
        <!-- footer starts -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-bg">
                    <div class="row temp-footer" data-id="landing-page-whole-footer" <?php if($footer_section_bg != '') { ?> style="background: <?php echo $footer_section_bg; ?>" <?php } ?>>
                        <!--                        <div></div>-->
                        <div class="edit-btn-container">
                            <a id="footer-whole-section" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <div class="hover-edit">
                                <div class="author-img">
                                    <? if (file_exists('./../../images/avatars/'.$rowUSU['clave'].'.jpg'))
                                        echo '<img src="../../images/avatars/'.$rowUSU['clave'].'.jpg" class="imagen">';
                                    else if(file_exists('./../../images/avatars/'.$rowUSU['clave'].'.jpeg'))
                                        echo '<img src="../../images/avatars/'.$rowUSU['clave'].'.jpeg" class="imagen">';
                                    else if(file_exists('./../../images/avatars/'.$rowUSU['clave'].'.png'))
                                        echo '<img src="../../images/avatars/'.$rowUSU['clave'].'.png" class="imagen">';
                                    else if(file_exists('./../../images/avatars/'.$rowUSU['clave'].'.gif'))
                                        echo '<img src="../../images/avatars/'.$rowUSU['clave'].'.gif" class="imagen">';
                                    ?>
                                    <!--                                    <img src="../../images/avatars/3.jpg" class="img-circle">-->
                                </div>
                                <div class="edit-btn-container">
                                    <a id="footer-avatar" onclick="imageSectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-xs-12">
                            <div class="hover-edit12">
                                <div class="author-desc">
                                    <p class="author-name"><? echo $rowUSU['nombre'].' '.$rowUSU['apellidos']; ?></p>
                                    <p class="author-phone"><? if (!empty($rowUSU['telefono_oficina']) AND $rowUSU['pubtel']==1) echo ''.$rowUSU['telefono_oficina']; ?></p>
                                    <p class="author-mail">
                                        <a href="mailto:<? echo $rowUSU['email']; ?>" class=""><? echo $rowUSU['email']; ?></a>
                                    </p>
                                    <p>
                                        <a href="skype:<?= $rowUSU['telefono_ip']; ?>?call">
                                            <img src="http://<? echo $rowADMIN['url_dominio']; ?>/images/logo-skype2.png" style="border: none;" width="25" height="25" alt="Call by Skype" />
                                        </a>
                                        <!--                                        <a href="#"><i class="fa fa-2x fa-skype" aria-hidden="true"></i></a>-->
                                    </p>
                                </div>
                                <div class="edit-btn-container">
                                    <a id="footer-author-info" onclick=" sectionEdit(this.id);openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space"></div>
        </div>
        <!-- footer ends -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <button class="save-btn pull-right" onclick='$("#forma").submit();'>
                    SAVE CHANGES
                </button>
            </div>
        </div>
    </div>
</div>
<!--<form action="../../landingpage_data_save.php" method="post" enctype="multipart/form-data" name="forma" id="forma" class="form-horizontal">-->
<!--    <input name="subdominio_titulo" class="subdominio_titulo" id="subdominio_titulo" value="--><?//= $titulo; ?><!--" type="hidden"><!-- landing page title-->
<!--    <input name="subdominio_subtitulo" id="subdominio_subtitulo" value="--><?//= $subtitulo; ?><!--" type="hidden"><!-- landing page sub title-->
<!--    <input name="subdominio_descripcion" id="subdominio_descripcion" value="--><?//= $descripcion; ?><!--" type="hidden"><!-- landing page textarea-->
<!--    <input name="subdominio_puntos" id="subdominio_puntos" value="--><?//= $puntos; ?><!--" type="hidden"><!-- landing page bullet area-->
<!--    <input name="subdominio_tituloformulario" id="subdominio_tituloformulario" value="--><?//= $titulo_formulario; ?><!--" type="hidden"><!-- landing page form title-->
<!--    <input name="subdominio_textoformulario" id="subdominio_textoformulario" value="--><?//= $texto_formulario; ?><!--" type="hidden"><!-- landing page form sub title-->
<!--    <input name="subdominio_boton" id="subdominio_boton" value="--><?//= $boton; ?><!--" type="hidden"><!-- landing page form submit button-->
<!--    <input name="subdominio_video" id="subdominio_video" value="--><?//= $video; ?><!--" type="hidden"><!-- landing page iframe video-->
<!--    <input name="videos" id="videos" value="--><?//= $videos; ?><!--" type="hidden"><!-- landing page video source -->
<!--    <input name="language" id="language" value="eng" type="hidden">-->
<!--    <input name="logo_image" id="logo_image" value="" type="hidden">-->
<!--    <input name="background_image" id="background_image" value="" type="hidden">-->
<!--</form>-->
<!-- Bootstrap core JavaScript -->
<!--<script src="vendor/jquery/jquery.min.js"></script>-->
<!--<script src="vendor/popper/popper.min.js"></script>-->
<!--<script src="vendor/bootstrap/js/bootstrap.min.js"></script>-->
</body>
</html>