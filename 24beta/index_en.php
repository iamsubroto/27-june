<? $template = 4; include_once('../../subdominio_ini.php'); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
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
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/estilos.css" />
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Caption:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
    <script src="js/vendor/modernizr.js"></script>

 <!-- C�digo del pixel de facebook para la p�gina de captura -->
    <?//= $rowUSU['fbpixel_lp']; ?>
    
    <?php
      include_once "../../usuarios/functions.php";
      echo getUserPixelCode($rowUSU["clave"], "fbpixel_lp");
    ?>
       
  </head>

  <body>
    <!-- AddThis Smart Layers BEGIN -->
  <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5581eaa373923e3c" async="async"></script>
<script type="text/javascript">
  addthis.layers({
    'theme' : 'light',
    'share' : {
      'position' : 'left',
      'services' : 'facebook,twitter,linkedin,google_plusone_share,more'
    },
  'thankyou' : false
  });
</script>
    <style>
        .configuration {
            line-height: 7px;
            position: absolute;
            right: 4px;
            top: -2px;
        }
        .configuration a {
            background-color: #f5f5f5;
            border: 1px solid #dddddd;
            border-radius: 0px 0px 0px 10px;
            color: #9da0a4;
            content: "Container";
            font-size: 12px;
            font-weight: bold;
            left: -1px;
            padding: 3px 7px;
            top: -1px;
            /*color: #DDDDDD;*/
            /*border: 1px solid #DDDDDD;*/
            /*border-radius: 4px;*/
            /*background-color: #F5F5F5;*/
        }
        .popup{
            background: #4f7b9a none repeat scroll 0 0;
            border: 1px solid #ccc;
            display: block;
            height: 100%;
            padding: 97px 60px;
            position: absolute;
            width: 100%;
            z-index: 99999;
        }
    </style>
<!-- AddThis Smart Layers END -->
    <div class="" style="display: block;">
        <textarea id="mytextarea" name="mytextarea"></textarea>
        <input onclick="getAndAssignData()" type="button" value="Ok" />
        <input onclick="$('.popup').hide()" type="button" value="Cancel" />
    </div>
   <header>
      <div class="row">
      <div class="large-12 columns cont-datos" align="right">
             <span><? if ($landing) $url='index.php?landing='.$landing;
   elseif ($usuario AND $version) $url='index.php?usuario='.$usuario.'&v='.$version;
   else $url='index.php?subdominio='.$subdominio; ?>
<a href="<?= $url; ?>" class="emaillink"><img src="img/es.png" width="16" height="11" alt=""> Español</a>
</span>
          </div> 
             <div class="large-12 columns main-text middle editable"><?= $titulo_en; ?>
                 <div class="configuration" style="display: none;">
                     <a href="#" class="drag btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i>EDIT</a>
                 </div>
             </div>
      </div>
    </header>
    <div class="header-line"></div>
    <div class="divider"></div>
     <div id="videocontainer">    
      <div id="videobox">   
        <div class="row">
          <div class="large-12 columns editable">
            <!-- COMIENZA VIDEO-->
             <? if ($videos=='Y') { ?>
             <iframe id="videoclip" style="border: solid 0px #121212; background: #000000;" src="http://www.youtube.com/embed/<?= $video_en; ?>?rel=0&modestbranding=1&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;autohide=1" frameborder="0" allowfullscreen></iframe>
             <? } elseif ($videos=='V') { ?>
             <iframe id="videoclip" style="border: solid 0px #121212; background: #000000;" src="https://player.vimeo.com/video/<?= $video_en; ?>?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;badge=0" frameborder="0" ></iframe>
            <? } ?>
            <!-- TERMINA VIDEO-->
              <div class="configuration" style="display: none;">
                  <a class="drag btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i>EDIT</a>
              </div>
          </div> 
        </div>
      </div>  
     </div>       

  
           		<!-- Start Banner Optin Form-->
				<form method="post" action="<?php echo $result ?>" class="cf op-optin-validation" data-abide>
					<div class="banner-optin" align="center">
						<div class="row">
                            </br>
                            
							<div class="form-group col-md-4 name-field">
    <label>
        <div class="editable"><input type="text" required pattern="[a-zA-Z]+" name="nombre" id="nombre" class="form-control" placeholder="Enter your name">
            <div class="configuration" style="display: none;">
                <a class="drag btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i>EDIT</a>
            </div>
        </div>
    </label>
    <small class="error">You must enter your name.</small>
	</div>
							
    <div class="form-group col-md-4 email-field">
    <label>
        <div class="editable"><input name="email" id="email" type="text" class="form-control" placeholder="Enter your e-mail" required>
            <div class="configuration" style="display: none;">
                <a class="drag btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i>EDIT</a>
            </div>
        </div>
    </label>
    <small class="error">You must enter a e-mail.</small>
	</div>
							<div class="form-group col-md-4">
                                <div class="editable"><button type="submit" class="boton"><?= $boton_en; ?></button>
                                    <div class="configuration" style="display: none;">
                                        <a class="drag btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i>EDIT</a>
                                    </div>
<!--                                    <textarea style="display: block;" id="mytextarea"></textarea>-->
                                </div>
<input type="hidden" name="pais" id="pais" value="<? echo $geo["geoplugin_countryName"]; ?>">
<input type="hidden" name="ciudad" id="ciudad" value="<? echo $geo["geoplugin_city"]; ?>">
<input type="hidden" name="estado" id="estado" value="<? echo $geo["geoplugin_regionName"]; ?>">
<input type="hidden" name="usuario" id="usuario" value="<?= $usuario; ?>">
<input type="hidden" name="template" id="template" value="<?= $template; ?>">
<input type="hidden" name="idioma" id="idioma" value="en">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-10">
							<div class="form-process"></div><!-- Displays status when submitting form -->
						</div>
					</div>
				</form>
				<!-- End Banner Optin Form -->
 <div class="divider"></div>
  <div class="content-bg">
  <div class="row">
      <div class="subtitulo"><h1><?= $subtitulo_en; ?></h1></div>
      <br>
      <div class="large-6 columns descripcion"><?= str_replace(chr(10),'<br />',$descripcion_en); ?></div>
      <div class="large-6 columns lista">
          <!-- RENGLONES DEL TEXTO DESCRIPTIVO CON VI�ETA -->
          <ul class="bullet-list 1">
          <?  for ($i=0; $i<count($array_puntos_en); $i++) {
		$renglon = trim($array_puntos_en[$i]);
		if (!empty($renglon) AND $renglon!=chr(13))
			echo '<li style=\'background-image:url("vineta.png");background-repeat:no-repeat;\'>'.$renglon.'</li>';
	}
?>
          </ul>
          <!-- TERMINA TEXTO DESCRIPTIVO-->
      </div>
  </div>
 </div> 
  <div class="content-line"></div>
  <div class="contact-bg">
    <div class="row">
        <div class="large-6 columns cont-datos" align="center">
        <!-- COMIENZA DATOS DE AFILIADO-->
        <table>
          <tr>
           <td style="padding-left:10px;"><? if (file_exists('./../../images/avatars/'.$rowUSU['clave'].'.jpg')) echo '<img src="../../images/avatars/'.$rowUSU['clave'].'.jpg" class="imagen">'; ?></td>
<td style="padding-left:10px;"><span><? echo $rowUSU['nombre'].' '.$rowUSU['apellidos']; ?><br>
<? if (!empty($rowUSU['telefono_oficina']) AND $rowUSU['pubtel']==1) echo ''.$rowUSU['telefono_oficina']; ?><br>
<a href="skype:<?= $rowUSU['telefono_ip']; ?>?call">
<img src="http://<? echo $rowADMIN['url_dominio']; ?>/images/logo-skype2.png" style="border: none;" width="25" height="25" alt="Call by Skype" />
</a><br>
<a href="mailto:<? echo $rowUSU['email']; ?>" class="emaillink"><? echo $rowUSU['email']; ?></a></span>
</td></tr></table>
          <!-- TERMINA DATOS DE AFILIADO-->
        </div>
        <div class="large-6 columns cont-datos" align="center">
         <!-- COMIENZA LOGO-->
        <p><?= $logotipo_en; ?></p>
        <!-- TERMINA LOGO-->
        </div>
    </div>
  </div>
  <div class="footer-line"></div>  
  <div class="footer">
     <div class="row">
    <? include('footer_en.php'); ?></div>
  </div>
    
    <script src="js/vendor/jquery.js"></script>
<!--    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>-->
<!--    <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>-->
    <script src="../../js/vendor/ckeditor/ckeditor.js"></script>
    <script src="../../js/vendor/ckeditor/ckeditor_config.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.replace( 'mytextarea', {
                customConfig: 'js/vendor/ckeditor/ckeditor_config.js'
            });
            $(".editable").hover(function () {
                $(this).css({"border": "1px solid #DDDDDD", "position": "relative"});
                $(this).find("div.configuration").css("display", "block");
            }, function () {
                $(this).css("border", "0px");
                $(this).find("div.configuration").css("display", "none");
            });
            $("div.configuration a").click(function () {
//                display: block; width: 100%; height: 100%; position: absolute;
//                openPopupTextArea();
                $(".popup").css({"display": "block", "width": "100%", "height": "100%", "position": "absolute"});
                openPopupTextArea();
            });
        });
        function getAndAssignData(){
            var data = CKEDITOR.instances.mytextarea.getData();
            alert(data);
        }
        function openPopupTextArea(){
            CKEDITOR.replace( 'mytextarea', {
//                customConfig: '../../js/vendor/ckeditor/ckeditor_config.js'
            });
//            tinyMCE.init({
//                selector: '#mytextarea'
////                mode: "none",
////                theme: "simple"
//            });
        }
    </script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
    
    <? if (!empty($rowUSU['chat_id']) AND $rowUSU['chat_custom']==1) { ?>
    <!-- TINICIA CHAT-->
    <? include('../../chat.php'); ?>
    <? } ?>
    
  </body>
</html>