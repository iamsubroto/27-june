<? $template = 4; include_once('../../subdominio_ini.php'); ?>
<!DOCTYPE html>
<html class="no-js" lang="es-ES">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

   <title><? echo $rowUSU['meta_titulo']; ?></title>
	<meta name="description" content="<? echo $rowUSU['meta_descripcion']; ?>" />
	<meta name="keywords" content="<? echo $rowUSU['meta_palabras']; ?>" />
	<meta name="author" content="<? echo $rowUSU['nombre'].' '.$rowUSU['apellidos']; ?>" />

    <!-- Para Facebook y otros -->
	<meta property="og:site_name" content="<? echo $rowUSU['meta_titulo']; ?>">
    <meta property="og:title" content="<? echo $rowUSU['meta_titulo']; ?>">
    <meta property="og:type" content="website">
	<meta property="og:url" content="http://<? echo $rowADMIN['url_dominio']; ?>/landingpage/4/index.php?subdominio=<? echo $rowUSU['subdominio']; ?>">
	<meta property="og:image" content="http://<? echo $rowADMIN['url_dominio']; ?>/landingpage/4/fb.jpg">
	<meta property="og:description" content="<? echo $rowUSU['meta_descripcion']; ?>">

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
<!--<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5581eaa373923e3c" async="async"></script>-->
<script type="text/javascript">
//  addthis.layers({
//    'theme' : 'light',
//    'share' : {
//      'position' : 'left',
//      'services' : 'facebook,twitter,linkedin,google_plusone_share,more'
//    },
//  'thankyou' : false
//  });

</script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".box").hover(function(){
                $(this).find("div.configuration").css("display", "block");
            }, function(){
                $(this).find("div.configuration").css("display", "none");
            })
        })
    </script>
    <style>.box, .lyrow {
            position: relative;

        }
        .box:hover{
            border: 2px dashed #89bdff;
        }
        .box .drag {
            top: 5px;
        }
        /*.box .configuration {*/
        /*line-height: 8px;*/
        /*position: absolute;*/
        /*right: 6px;*/
        /*top: 5px;*/
        /*white-space: nowrap;*/
        /*}*/
        .configuration{
            line-height: 8px;
            position: absolute;
            right: 6px;
            top: 5px;
            white-space: nowrap;
            display: block;
        }
        .box .view {
            display: block;
            padding-top: 30px;
        }
    </style>
<!-- AddThis Smart Layers END -->

   <header><div class="box box-element ui-draggable" data-type="paragraph" style="display: block;">
           <div class="view"> <p>Lorem ipsum  officia deserunt mollit anim id est laborum.</p> </div>
           <div class="configuration" style="display: none;">
               <a class="drag btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i></a>
           </div>

       </div>
      <div class="row">
      <div class="large-12 columns cont-datos" align="right">
             <span><? if ($landing) $url='index_en.php?landing='.$landing;
   elseif ($usuario AND $version) $url='index_en.php?usuario='.$usuario.'&v='.$version;
   else $url='index_en.php?subdominio='.$subdominio; ?>
   <a href="<?= $url; ?>" class="emaillink"><img src="img/gb.png" width="16" height="11" alt=""> English</a>
</span>
          </div>
<!--             <div class="large-12 columns main-text middle">--><?//= $titulo; ?>
<!--                 <div class="configuration">-->
<!--                            <a class="drag btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i></a>-->
<!--                       </div></div>-->

          <div class="box box-element ui-draggable" data-type="paragraph" style="display: block;">
              <div class="view"> <p>Lorem ipsum  officia deserunt mollit anim id est laborum.</p> </div>
              <div class="configuration" style="display: none;">
                  <a class="drag btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i></a>
              </div>

          </div>
      </div>
    </header>
    <div class="header-line"></div>
    <div class="divider"></div>
     <div id="videocontainer">
      <div id="videobox">
        <div class="row">
          <div class="large-12 columns">
            <!-- COMIENZA VIDEO-->
             <? if ($videos=='Y') { ?>
             <iframe id="videoclip" style="border: solid 0px #121212; background: #000000;" src="http://www.youtube.com/embed/<?= $video; ?>?rel=0&modestbranding=1&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;autohide=1" frameborder="0" allowfullscreen></iframe>
             <? } elseif ($videos=='V') { ?>
             <iframe id="videoclip" style="border: solid 0px #121212; background: #000000;" src="https://player.vimeo.com/video/<?= $video; ?>?autoplay=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;badge=0" frameborder="0" ></iframe>
            <? } ?>
            <!-- TERMINA VIDEO-->
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
	<input type="text" required pattern="[a-zA-Z]+" name="nombre" id="nombre" class="form-control" placeholder="Ingresa tu Nombre">
    </label>
    <small class="error">Se requiere tu nombre.</small>
	</div>

    <div class="form-group col-md-4 email-field">
    <label>
	<input name="email" id="email" type="text" class="form-control" placeholder="Ingresa tu E-mail" required>
    </label>
    <small class="error">Ingresa un e-mail valido.</small>
	</div>
							<div class="form-group col-md-4">
<button type="submit" class="boton"><?= $boton; ?></button>
<input type="hidden" name="pais" id="pais" value="<? echo $geo["geoplugin_countryName"]; ?>">
<input type="hidden" name="ciudad" id="ciudad" value="<? echo $geo["geoplugin_city"]; ?>">
<input type="hidden" name="estado" id="estado" value="<? echo $geo["geoplugin_regionName"]; ?>">
<input type="hidden" name="usuario" id="usuario" value="<?= $usuario; ?>">
<input type="hidden" name="template" id="template" value="<?= $template; ?>">
<input type="hidden" name="idioma" id="idioma" value="es">
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
      <div class="subtitulo"><h1><?= $subtitulo; ?></h1></div>
      <br>
      <div class="large-6 columns descripcion"><?= str_replace(chr(10),'<br />',$descripcion); ?></div>
      <div class="large-6 columns lista">
          <!-- RENGLONES DEL TEXTO DESCRIPTIVO CON VI�ETA -->
          <ul class="bullet-list 1">
          <?  for ($i=0; $i<count($array_puntos); $i++) {
		$renglon = trim($array_puntos[$i]);
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
<img src="http://<? echo $rowADMIN['url_dominio']; ?>/images/logo-skype2.png" style="border: none;" width="25" height="25" alt="Llamar por Skype" />
</a><br>
<a href="mailto:<? echo $rowUSU['email']; ?>" class="emaillink"><? echo $rowUSU['email']; ?></a></span>
</td></tr></table>
          <!-- TERMINA DATOS DE AFILIADO-->
        </div>
        <div class="large-6 columns cont-datos" align="center">
         <!-- COMIENZA LOGO-->
        <p><?= $logotipo; ?></p>
        <!-- TERMINA LOGO-->
        </div>
    </div>
  </div>
  <div class="footer-line"></div>
  <div class="footer">
     <div class="row">
     <? include('footer.php'); ?></div>
  </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <style>
        .box, .lyrow {
            position: relative;

        }
        .box:hover{
            border: 2px dashed #89bdff;
        }
        .box .drag {
            top: 5px;
        }
        /*.box .configuration {*/
        /*line-height: 8px;*/
        /*position: absolute;*/
        /*right: 6px;*/
        /*top: 5px;*/
        /*white-space: nowrap;*/
        /*}*/
        .configuration{
            line-height: 8px;
            position: absolute;
            right: 6px;
            top: 5px;
            white-space: nowrap;
            display: block;
        }
        .box .view {
            display: block;
            padding-top: 30px;
        }


    </style>
    <script>
      $(document).foundation();
      $(document).ready(function(){
          $(".editable").hover(function(){
              $(this).removeClass("templete_section_unhover");
//              $(this).addClass("templete_section_hover");
//              $(this).append('<span class="configuration"> ' +
//                  '<a class="drag btn btn-default btn-xs"><i class="glyphicon glyphicon-pencil"></i></a>' +
//                      '</span>');
//              $(this).after('<div class="col-md-12 column ui-sortable">' +
//                  '<div class="box box-element ui-draggable" data-type="paragraph" style="display: block;"> ' +
//                  '<a href="#close" class="remove btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove">' +
//                  '</i></a> <a class="drag btn btn-default btn-xs"><i class="glyphicon glyphicon-move"></i></a>' +
//                  ' <span class="configuration"> <a class="btn btn-xs btn-warning settings" href="#"><i class="fa fa-gear"></i></a> </span> ' +
//                  '<div class="preview"> <i class="fa fa-font fa-2x"></i> <div class="element-desc">Paragraph</div> </div>' +
//                  ' <div class="view"> <p>Lorem  ex ea commodi id est laborum.</p> </div> </div></div>');
//          }, function () {
//              $(this).addClass("templete_section_unhover");
//              $(this).removeClass("templete_section_hover");
//              $(this).find("input.edit").css("display", "none");
          }
 );
      })
    </script>

   <? if (!empty($rowUSU['chat_id']) AND $rowUSU['chat_custom']==1) { ?>
    <!-- TINICIA CHAT-->
    <? include('../../chat.php'); ?>
    <? } ?>

  </body>
</html>
