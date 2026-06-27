<? $template = 4; include_once('../../subdominio_ini.php'); ?>
<!DOCTYPE html>
<html lang="en" lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

    <title><? echo $rowUSU['meta_titulo_en']; ?></title>

    <meta name="description" content="<? echo $rowUSU['meta_descripcion_en']; ?>" />
    <meta name="keywords" content="<? echo $rowUSU['meta_palabras_en']; ?>" />
    <meta name="author" content="<? echo $rowUSU['nombre'].' '.$rowUSU['apellidos']; ?>" />

    <!-- Para Facebook y otros -->
    <meta property="og:site_name" content="<? echo $rowUSU['meta_titulo_en']; ?>">
    <meta property="og:title" content="<? echo $rowUSU['meta_titulo_en']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://<? echo $rowADMIN['url_dominio']; ?>/landingpage/4/index_en.php?subdominio=<? echo $rowUSU['subdominio']; ?>">
    <meta property="og:image" content="http://<? echo $rowADMIN['url_dominio']; ?>/landingpage/4/fb_en.jpg">
    <meta property="og:description" content="<? echo $rowUSU['meta_descripcion_en']; ?>">

    <link rel="shortcut icon" href="../../favicon.ico" />
<!--    <link rel="stylesheet" href="css/foundation.css" />-->
    <link rel="stylesheet" href="css/estilos.css" />
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://farbelous.github.io/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" />

    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/modernizr.js"></script>
    <script src="https://farbelous.github.io/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js"></script>

    <script src="../../js/vendor/ckeditor/ckeditor.js"></script>
    <script src="../../js/vendor/ckeditor/ckeditor_config.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Custom Style -->
    <link href="css/template-style.css" rel="stylesheet">

    <?php
    include_once "../../usuarios/functions.php";
    echo getUserPixelCode($rowUSU["clave"], "fbpixel_lp");
    ?>

    <script type="text/javascript">
        $(document).ready(function () {
            /***
                Initialize textarea with CKEditor, pick the custom config and on any kind of change,
                call copyValue() to assign formatted text to landing page section
            ***/
            CKEDITOR.replace( 'mytextarea', {
                customConfig: '../../js/vendor/ckeditor/ckeditor_config.js',
                on: {
                    change: function() {
                        // Sync section with textarea formatted content.
                        copyValue();
                    }
                }
            });
            $("")
//            $('#cp4').colorpicker().on('changeColor', function(e) { $('body')[0].style.backgroundColor = e.color.toString( 'rgba'); });
        });
        function sectionEdit(section){
            $("div.section-bg").each(function(index){
                $(this).find("div:first").removeClass("activeSection");
            });
            var mainSection, contentSection = '';
            mainSection = (($("#"+section).parent(".edit-btn-container")).parent(".section-bg"));
            contentSection = mainSection.find("div:first");
            contentSection.addClass("activeSection");
            if(section != 'video'){ // Will not copy section {video} content to textarea
                $("#video_Tab").hide();
                $("#cke_mytextarea").show();
                 //uncaught exception: The editor instance "mytextarea" is already attached to the provided element.

                CKEDITOR.instances.mytextarea.setData(contentSection.html());
            }
            if(section == 'video'){
//                CKEDITOR.instances.mytextarea.destroy();
                $("#cke_mytextarea").hide();
                $("#video_Tab").show();
            }

//            if(section == "footer"){
                $('#cp4').css("display", "block");
                $('#cp4').colorpicker().on('changeColor', function(e) { $(".activeSection").parent(".section-bg")[0].style.backgroundColor = e.color.toString( 'rgba'); });
//                $('#cp4').colorpicker().on('changeColor', function(e) { $('body')[0].style.backgroundColor = e.color.toString( 'rgba'); });
//            }
        }

        function directSectionEdit(sectionId){
            $("#"+sectionId).addClass("directActiveSection");
        }

        function iFrameVideoChange(){
//            youtubeID, vimeoID, youtube-video, vimeo-video
            var videoIdValue = '';
            if($("#youtubeID").val() != ""){
                videoIdValue = $("#youtubeID").val();
                var val = "//www.youtube.com/embed/"+videoIdValue+"?rel=0&modestbranding=1&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;autohide=1";
//                    ?rel=0&modestbranding=1&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;autohide=1
                $("#youtube-video").attr('src', val);//https://www.youtube.com/embed/iJhMN49B3ig
                $("#vimeo-video").attr('src', val);//http://www.youtube.com/embed/rGHI4YBwbCo
            }
            if($("#vimeoID").val() != ""){
                videoIdValue = $("#vimeoID").val();
                var val = "https://player.vimeo.com/video/"+videoIdValue+"?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;badge=0";
//                autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;badge=0
                $("#youtube-video").attr('src', val);
                $("#vimeo-video").attr('src', val);
            }
        }

        function copyValue(){
            var data = CKEDITOR.instances.mytextarea.getData();
            $(".activeSection").html(data);
        }

        function openNav() {
            document.getElementById("mySidenav").style.width = "290px";
            document.getElementById("content").style.left = "290px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("content").style.left = "0";
        }

    </script>

</head>

<body>
<!-- AddThis Smart Layers BEGIN -->
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5581eaa373923e3c" async="async"></script>-->
<script type="text/javascript">
//    addthis.layers({
//        'theme' : 'light',
//        'share' : {
//            'position' : 'left',
//            'services' : 'facebook,twitter,linkedin,google_plusone_share,more'
//        },
//        'thankyou' : false
//    });
</script>
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div style="margin: 54px 0px;">
        <textarea id="mytextarea" name="mytextarea" style="display: none;"></textarea>

        <div class="tab-pane videoTab active" id="video_Tab" style="display: none;">
            <label>Youtube ID:</label>
            <input type="text" class="form-control margin-bottom-20" id="youtubeID" placeholder="Enter a Youtube video ID" value="">
            <p class="text-center or">
                <span>or</span>
            </p>
            <label>Vimeo ID:</label>
            <input type="text" class="form-control margin-bottom-20" id="vimeoID" placeholder="Enter a Vimeo video ID" value="">

            <button onclick="iFrameVideoChange();" type="button" class="btn btn-primary btn-embossed btn-sm btn-block" id="saveStyling" style="display: block;"><span class="fui-check-inverted"></span> Apply Changes</button>
        </div>

        <a style="display: none; font-size: 15px; margin-left: -26px;" href="#" class="btn btn-default" id="cp4">Change section background color</a>
        <a style="display: block; font-size: 15px; margin-left: -26px;" href="#" class="btn btn-default" id="cp4">Change background image:</a>
        <input type="file" name="backgroundImageUpload" id="backgroundImageUpload" value="Change ">
    </div>
</div>
<!--<input id="slide-sidebar" type="checkbox" role="button" />-->
<!--<label for="slide-sidebar"><span>close</span></label>-->
<!--<div class="sidebar">-->
<!--    <textarea id="mytextarea" name="mytextarea"></textarea>-->
<!--    <a style="display: none;" href="#" class="btn btn-default" id="cp4">Change section background color</a>-->
<!--</div>-->
<!-- Page Content -->
<div id="content" class="content">
    <div class="container">
        <!-- logo section starts -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-bg ">
                    <div class="logo-section">
                        <a href="#" class="logo">LOGO</a>
                    </div>
                    <div class="edit-btn-container">
                        <a id="logo" href="#" class="edit-btn" onclick="sectionEdit(this.id); openNav();">EDIT</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- logo section ends -->
        <!-- template title starts -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-bg">
                    <div class="temp-title"><?= $titulo_en; ?></div>
                    <div class="edit-btn-container">
                        <a id="title" href="#" class="edit-btn" onclick="sectionEdit(this.id); openNav();">EDIT</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- template title ends -->
        <!-- template sub-title starts -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-bg">
                    <div class="temp-subtitle"><?= $subtitulo_en; ?></div>
                    <div class="edit-btn-container">
                        <a id="sub-title" href="#" class="edit-btn" onclick="sectionEdit(this.id); openNav();">EDIT</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- template sub-title ends -->
        <!-- 2 col section starts -->
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="section-bg">
                    <div class="temp-video">
                        <div>
                            <? if ($videos=='Y') { //rGHI4YBwbCo?>
                                <iframe id="youtube-video" src="http://www.youtube.com/embed/<?= $video_en; ?>?rel=0&modestbranding=1&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;autohide=1" width="100%" height="220px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            <? } elseif ($videos=='V') { //127297879?>
                                <iframe id="vimeo-video" src="https://player.vimeo.com/video/<?= $video_en; ?>?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;badge=0" width="100%" height="225px" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen ></iframe>
                            <? } ?>
                        </div>
                    </div>
                    <div class="edit-btn-container">
                        <a id="video" href="#" class="edit-btn" onclick="sectionEdit(this.id); openNav();">EDIT</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-bg">
                    <div class="temp-form">
                        <div>
                            <div class="form-title">
                                <h1>Form Title</h1>
                            </div>
                            <div class="form-subtitle">
                                <h3>Form Title</h3>
                            </div>
                            <form>
                                <div class="form-group">
<!--                                    <label for="email">Email address:</label>-->
                                    <input type="text" class="form-control" id="email" placeholder="Enter your name">
                                </div>
                                <div class="form-group">
<!--                                    <label for="pwd">Password:</label>-->
                                    <input type="email" class="form-control" id="pwd" placeholder="Enter your e-mail">
                                </div>
<!--                                <div class="checkbox">-->
<!--                                    <label><input type="checkbox"> Remember me</label>-->
<!--                                </div>-->
                                <button type="submit" class="btn btn-default">Click HERE to see Videos NOW</button>
                            </form>
                        </div>
                    </div>
                    <div class="edit-btn-container">
                        <a id="form" href="#" class="edit-btn" onclick="sectionEdit(this.id);">EDIT</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 2 col section ends -->
        <!-- 2 col section starts -->
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="section-bg">
                    <div class="temp-text">In times of change, learners inherit the earth, while the learned find themselves beautifully equipped to deal with a world that no longer exists.</div>
                    <div class="edit-btn-container">
                        <a id="text-area" href="#" class="edit-btn" onclick="sectionEdit(this.id); openNav();">EDIT</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-bg">
                    <div class="temp-bullets">
                        The Only Constant in Life is Change
                    </div>
                    <div class="edit-btn-container">
                        <a id="bullets-area" href="#" class="edit-btn" onclick="sectionEdit(this.id); openNav();">EDIT</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- 2 col section ends -->
        <!-- footer starts -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-bg">
                    <div class="temp-footer">FOOTER</div>
                    <div class="edit-btn-container">
                        <a id="footer" href="#" class="edit-btn" onclick="sectionEdit(this.id); openNav();">EDIT</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer ends -->

    </div>
</div>



<!-- Bootstrap core JavaScript -->
<!--<script src="vendor/jquery/jquery.min.js"></script>-->
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>


</body>

</html>
