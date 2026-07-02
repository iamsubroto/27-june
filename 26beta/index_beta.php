<?php
header('Content-Type: text/html; charset=UTF-8');

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
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>De Cero a Inversionista &middot; Bolsa de NY</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Editor Scripts & Styles -->
  <link rel="stylesheet" href="../../css/landingpage/bootstrap-colorpicker.min.css" />
  <script src="../../js/landinpage/bootstrap-colorpicker.js"></script>
  <script src="../../js/vendor/ckeditor/ckeditor.js"></script>
  <script src="https://vioniko.com/js/vendor/ckeditor/ckeditor_config.js"></script>
  <script src="../../js/landinpage/landing-page-editor-custom-es.js"></script>
  <?php include_once('../../chatHandeler.php'); ?>
</head>
<body>

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
                                foreach ($images as $image) {
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
                                include_once('../youtube_library.php');
                                foreach ($images as $image) {
                                    echo '<div class="popup-img">';
                                    echo '<input type="checkbox" name="" class="video-responsive" data-title="' . $image . '" data-id="https://www.youtube.com/embed/' . $image . '?autohide=1&rel=0&autoplay=1&iv_load_policy=3&modestbranding=1&controls=0&showinfo=0&disablekb=1&enablejsapi=1&widgetid=1&mute=1&loop=1&playlist=' . $image . '&origin=https://www.vioniko.com&modestbranding=1">';
                                ?>
                                    <iframe id="youtube-video" src="//www.youtube.com/embed/<?= $image; ?>" width="100%" height="220px" frameborder="0"></iframe>
                                <?php
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

<!-- ============ NAVBAR ============ -->
<nav>
  <div class="wrap">
    <div class="logo">
      <img class="logoImg" src="logo.png" alt="De Cero a Inversionista">
    </div>
    <div class="navlinks">
      <a href="#metodo">M&eacute;todo</a>
      <a href="#resultados">Resultados</a>
      <a href="#historia">Historia</a>
      <a href="#faq">FAQ</a>
      <a href="#diagnostico" class="navcta">Diagn&oacute;stico</a>
    </div>
    <button class="burger" aria-label="Men&uacute;">&#9776;</button>
  </div>
</nav>

<!-- ============ HERO (portada de marca + velas animadas) ============ -->
<header class="hero">
  <div id="tickerBar"><div id="tickerRow"></div></div>

  <div class="heroStage">
    <div class="heroMedia">
      <div class="heroBg" role="img" aria-label="De cero a inversionista rentable en 3 meses, con toro alcista y gr&aacute;fico de la Bolsa de Nueva York."></div>
      <canvas id="mktCanvas" aria-hidden="true"></canvas>
      <div class="heroFade"></div>

      <div class="quoteCard">
        <div class="nyseBox">
          <div class="lbl">NYSE &middot; &Iacute;ndice en vivo</div>
          <div id="nysePrice">5,990.40</div>
          <div id="nyseChg" class="up">▲ +0.00 (0.00%)</div>
        </div>
      </div>

      <div class="heroBand">
        <div class="wrap">
          <div class="heroBandInner">
            <div>
              <p class="heroSub">Entrenamiento de 3 meses &middot; M&eacute;todo CERO &middot; Acompa&ntilde;amiento diario.</p>
              <p class="heroSub2">Sin promesas de riqueza f&aacute;cil: m&eacute;todo, disciplina y resultados que puedes comprobar.</p>
            </div>
            <div class="heroBtns">
              <a href="#diagnostico" class="btnPrimary">Hacer diagn&oacute;stico gratis &rarr;</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
</header>

<!-- ============ SECCI&Oacute;N 2 &middot; RESULTADOS ============ -->
<section class="results" id="resultados">
  <div class="wrap">
    <div class="head">
      <span class="eyebrow">Resultados</span>
      <h2>Resultados que respaldan el m&eacute;todo</h2>
      <p class="sub">No vendemos promesas. Mostramos datos.</p>
    </div>
    <div class="statGrid">
      <div class="stat"><div class="num">70%</div><div class="cap">alumnos rentables</div></div>
      <div class="stat"><div class="num">+300</div><div class="cap">alumnos formados</div></div>
      <div class="stat"><div class="num">~6&nbsp;m</div><div class="cap">para recuperar inversi&oacute;n</div></div>
    </div>
    <div class="countries">
      <div class="t">Una comunidad en 5 pa&iacute;ses</div>
      <div class="flagGrid">
        <div class="fc"><span class="fl">🇲🇽</span><span class="cn">M&eacute;xico</span></div>
        <div class="fc"><span class="fl">🇨🇴</span><span class="cn">Colombia</span></div>
        <div class="fc"><span class="fl">🇪🇸</span><span class="cn">Espa&ntilde;a</span></div>
        <div class="fc"><span class="fl">🇦🇺</span><span class="cn">Australia</span></div>
        <div class="fc"><span class="fl">🇺🇸</span><span class="cn">Estados Unidos</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ SECCI&Oacute;N 3 &middot; PROGRAMA ============ -->
<section class="programa">
  <div class="wrap">
    <span class="eyebrow" style="display:block;padding-top:80px;margin-bottom:14px;">El programa</span>
    <h2>3 fases. <em>3 meses.</em></h2>
    <p class="lead">As&iacute; te llevamos de cero a operar con seguridad, sin saltos al vac&iacute;o.</p>
    <div class="phaseGrid">
      <div class="phase">
        <div class="pn">01</div>
        <h3>Teor&iacute;a</h3>
        <p>Videos y conceptos clave dentro de la plataforma. Aprendes a leer el mercado y los 4 pilares del M&eacute;todo CERO.</p>
      </div>
      <div class="phase">
        <div class="pn">02</div>
        <h3>Simulaci&oacute;n</h3>
        <p>Practicas en UCharts con dinero NO real. Alertas diarias y clases en vivo los mi&eacute;rcoles operando con mentor.</p>
      </div>
      <div class="phase">
        <div class="pn">03</div>
        <h3>Cuenta real</h3>
        <p>Cuando dominas el m&eacute;todo, operas con tu capital. Acompa&ntilde;amiento 1 a 1 y sesi&oacute;n de dudas los viernes.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ SECCI&Oacute;N 4 &middot; M&Eacute;TODO CERO ============ -->
<section class="metodo" id="metodo">
  <div class="wrap">
    <span class="eyebrow">M&eacute;todo CERO</span>
    <h2 style="margin-top:10px;">El M&eacute;todo CERO</h2>
    <p class="lead">Cuatro pilares para dejar de improvisar y operar con consistencia.</p>
    <div class="ceroGrid">
      <div class="pilar"><div class="ic">🛡️</div><div><h3>Control</h3><p>Gestiona el riesgo, no lo dejes a la suerte.</p></div></div>
      <div class="pilar"><div class="ic">⚡</div><div><h3>Ejecuci&oacute;n</h3><p>Opera bajo reglas, no por emoci&oacute;n.</p></div></div>
      <div class="pilar"><div class="ic">📋</div><div><h3>Reglas</h3><p>Un plan claro que s&iacute; puedes seguir.</p></div></div>
      <div class="pilar"><div class="ic">🧠</div><div><h3>Objetividad</h3><p>Decide con datos, no con miedo ni euforia.</p></div></div>
    </div>
  </div>
</section>

<!-- ============ SECCI&Oacute;N 5 &middot; HISTORIA ============ -->
<section class="historia" id="historia">
  <div class="wrap">
    <div style="padding-top:84px;"></div>
    <div class="histGrid">
      <div>
        <span class="eyebrow">Historia / Equipo</span>
        <h2 style="margin-top:10px;">Nuestra historia</h2>
        <p class="lead">Dos personas, un mismo ideal.</p>
        <p>Osvaldo Mares fue empleado 25 a&ntilde;os y agente de seguros, vendiendo libertad financiera sin saber invertir. Hasta que se certific&oacute; y descubri&oacute; que el problema nunca fue la informaci&oacute;n, sino la falta de un proceso.</p>
        <p>En el camino conoci&oacute; a Alejandro Alberto, egresado de Harvard con maestr&iacute;a en negocios y sus mismos ideales. Hoy combinan el expertise en los mercados y la formaci&oacute;n con el dise&ntilde;o comercial y la expansi&oacute;n tecnol&oacute;gica internacional.</p>
      </div>
      <div class="teamCard">
        <div class="founder">
          <div class="av"><img style="object-position:center 25%;" src="data:image/jpeg;base64,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" alt="Osvaldo Mares"></div>
          <div><div class="nm">Osvaldo Mares</div><div class="rl">Experto en la Bolsa de NY &middot; Creador del M&eacute;todo CERO</div></div>
        </div>
        <div class="teamDiv"></div>
        <div class="founder">
          <div class="av"><img src="data:image/jpeg;base64,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" alt="Alejandro Alberto"></div>
          <div><div class="nm">Alejandro Alberto</div><div class="rl">Harvard MBA &middot; Dise&ntilde;o comercial y expansi&oacute;n internacional</div></div>
        </div>
        <div class="teamDiv"></div>
        <div class="teamQuote">"Del desastre al dominio financiero."</div>
      </div>
    </div>
  </div>
</section>

<!-- ============ SECCI&Oacute;N 6 &middot; TESTIMONIOS ============ -->
<section class="testi">
  <div class="wrap">
    <div style="padding-top:84px;"></div>
    <span class="eyebrow">Testimonios</span>
    <h2 style="margin-top:10px;">Lo que dicen nuestros alumnos</h2>
    <p class="lead">Historias reales de quienes pasaron de perder a sostener su cuenta.</p>
    <div class="testiGrid">
      <div class="tcard"><div class="q">&ldquo;</div><p>Llegu&eacute; despu&eacute;s de perder dinero solo. Hoy sostengo mi cuenta y opero con reglas, no por impulso.</p><div class="who">Alumno &middot; Monterrey</div></div>
      <div class="tcard"><div class="q">&ldquo;</div><p>Ten&iacute;a mi dinero parado en el banco. Aprend&iacute; a invertir para mi retiro, paso a paso y acompa&ntilde;ada.</p><div class="who">Alumna &middot; Guadalajara</div></div>
      <div class="tcard"><div class="q">&ldquo;</div><p>Ya sab&iacute;a la teor&iacute;a pero no era consistente. El m&eacute;todo y el acompa&ntilde;amiento diario lo cambiaron todo.</p><div class="who">Alumno &middot; CDMX</div></div>
    </div>
    <p class="testiNote">Espacio para testimonios reales en video o captura (sustituir cuando se recopilen).</p>
  </div>
</section>

<!-- ============ SECCI&Oacute;N 7 &middot; PARA QUI&Eacute;N ============ -->
<section class="paraquien">
  <div class="wrap">
    <div style="padding-top:84px;"></div>
    <span class="eyebrow">&iquest;Para qui&eacute;n es?</span>
    <h2 style="margin-top:10px;">&iquest;Es esto para ti?</h2>
    <p class="lead">Entrenamos a profesionales que se reconocen en alguna de estas situaciones.</p>
    <div class="pqGrid">
      <div class="pq"><div class="top"><div class="chk">✓</div><h3>Ya perdiste invirtiendo solo</h3></div><p>Lo intentaste por tu cuenta, perdiste dinero y ya no sabes en qui&eacute;n confiar. No fue falta de capacidad: fue falta de m&eacute;todo.</p></div>
      <div class="pq"><div class="top"><div class="chk">✓</div><h3>Quieres asegurar tu retiro</h3></div><p>Tu dinero lleva a&ntilde;os parado en el banco perdiendo contra la inflaci&oacute;n. Buscas hacerlo crecer con seguridad y acompa&ntilde;amiento.</p></div>
      <div class="pq"><div class="top"><div class="chk">✓</div><h3>Operas pero no eres consistente</h3></div><p>Sabes la teor&iacute;a, pero vives el ciclo de ganar y devolver. Te falta disciplina y un proceso que puedas repetir.</p></div>
      <div class="pq"><div class="top"><div class="chk">✓</div><h3>Buscas reinventarte</h3></div><p>Vienes de ventas, seguros o asesor&iacute;a y quieres dominar la inversi&oacute;n de verdad para diversificar tus ingresos.</p></div>
    </div>
  </div>
</section>

<!-- ============ SECCI&Oacute;N 8 &middot; FAQ ============ -->
<section class="faq" id="faq">
  <div class="wrap">
    <div style="padding-top:84px;"></div>
    <span class="eyebrow">Preguntas frecuentes</span>
    <h2 style="margin-top:10px;">Preguntas frecuentes</h2>
    <p class="lead">Las dudas m&aacute;s comunes, respondidas con honestidad.</p>
    <div class="faqGrid">
      <div class="qa"><button>&iquest;Puedo perder todo mi dinero?<span class="arr">+</span></button><div class="ans"><p>El riesgo existe, pero perderlo todo le pasa a quien opera sin control. El primer pilar del m&eacute;todo es justo gestionar el riesgo.</p></div></div>
      <div class="qa"><button>&iquest;A los 40 o 45 ya es tarde?<span class="arr">+</span></button><div class="ans"><p>No es tarde. A esa edad sueles tener m&aacute;s estabilidad y capacidad de ahorro, y eso juega a tu favor.</p></div></div>
      <div class="qa"><button>&iquest;Necesito mucho dinero para empezar?<span class="arr">+</span></button><div class="ans"><p>No. En acciones puedes empezar desde 10-30 USD, y primero entrenas en simulaci&oacute;n sin arriesgar capital real.</p></div></div>
      <div class="qa"><button>&iquest;Qu&eacute; pasa despu&eacute;s de los 3 meses?<span class="arr">+</span></button><div class="ans"><p>Puedes seguir con la membres&iacute;a y la comunidad para sostener tu progreso. No te quedas solo.</p></div></div>
      <div class="qa"><button>&iquest;Necesito saber de finanzas?<span class="arr">+</span></button><div class="ans"><p>No. El m&eacute;todo est&aacute; dise&ntilde;ado para gente com&uacute;n. Muchos alumnos ven&iacute;an de profesiones sin relaci&oacute;n con las finanzas.</p></div></div>
      <div class="qa"><button>&iquest;Qu&eacute; resultados puedo esperar?<span class="arr">+</span></button><div class="ans"><p>Sin promesas: 7 de cada 10 alumnos son rentables. El m&eacute;todo funciona, pero la disciplina la pones t&uacute;.</p></div></div>
    </div>
    <div class="faqAll"><a href="https://www.vioniko.com/deceroainversionista">Ver todas las preguntas &rarr;</a></div>
  </div>
</section>

<!-- ============ SECCI&Oacute;N 9 &middot; CTA ============ -->
<section class="ctaSec" id="diagnostico">
  <canvas id="ctaCanvas" aria-hidden="true"></canvas>
  <div class="veil"></div>
  <div class="inner wrap">
    <h2>Tu pr&oacute;xima inversi&oacute;n puede ser<br>la <span class="c">primera de muchas.</span></h2>
    <p>Agenda tu diagn&oacute;stico gratuito: revisamos d&oacute;nde est&aacute;s, qu&eacute; te frena, y si calificas para una beca. Sin compromiso ni venta de humo.</p>
    <a href="https://www.vioniko.com/deceroainversionista" class="btnPrimary">Hacer diagn&oacute;stico gratis &rarr;</a>
  </div>
</section>

<!-- ============ SECCIÓN VIDEO/FORM ============ -->
<section class="videoFormSec" id="videoForm">
  <div class="wrap">
    <!-- Video/Form section Starts -->
    <form action="../../registro_prospecto_subdominio_getresponse24beta.php" method="post" id="prospectoForm" class="cf op-optin-validation" data-abide>
      <div class="videoFormGrid">
        <div class="videoCol">
          <?php include_once('../videoPlayer.php'); ?>
        </div>
        <div class="formCol">
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
                  <div class="form-title" data-id="landing-page-form-title">
                    <h2><?= $titulo_formulario; ?></h2>
                  </div>
                  <!-- Edit Starts -->
                  <div class="edit-btn-container">
                    <a id="form-title" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                  </div>
                  <!-- Edit Ends -->
                </div>
                <div class="hover-edit">
                  <div class="form-subtitle" data-id="landing-page-form-sub-title">
                    <h6><?= $texto_formulario; ?></h6>
                  </div>
                  <!-- Edit Starts -->
                  <div class="edit-btn-container">
                    <a id="form-subtitle" onclick="sectionEdit(this.id); openNav()" href="javascript:void(0);" class="edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                  </div>
                  <!-- Edit Ends -->
                </div>

                <div class="hover-edit">
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
                <div class="hover-edit">
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
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
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
                                $prompt = fixSpanishCode($gptapi['description']);
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
                                                <p class="fieldDescription"><?= fixSpanishCode($row['description']) ?></p>
                                                <input type="text" name="<?php echo strtolower($row['name']) . "_" . $row['id']; ?>" class="form-control" id="<?= strtolower($row['name']) ?>" required placeholder="<?= fixSpanishCode($row['name']) ?>" data-id="form-name-placeholder">

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
  </div>
</section>

<!-- ============ SECCI&Oacute;N 10 &middot; FOOTER ============ -->
<footer>
  <div class="wrap">
    <div class="footGrid">
      <div class="footBrand">
        <div class="logo" style="color:#fff;">
          <img src="logo.png" alt="De Cero a Inversionista" style="height:64px;width:auto;background:#fff;border-radius:10px;padding:6px 10px;">
        </div>
        <p>Entrenamos profesionales para invertir en la Bolsa de NY con m&eacute;todo, disciplina y acompa&ntilde;amiento.</p>
      </div>
      <div class="footCol">
        <h4>Academia</h4>
        <a href="#metodo">M&eacute;todo CERO</a>
        <a href="#">El programa</a>
        <a href="#resultados">Resultados</a>
        <a href="#historia">Historia</a>
      </div>
      <div class="footCol">
        <h4>Recursos</h4>
        <a href="#faq">Preguntas frecuentes</a>
        <a href="#diagnostico">Diagn&oacute;stico gratis</a>
        <a href="#">Comunidad</a>
        <a href="#">Testimonios</a>
      </div>
      <div class="footCol">
        <h4>Legal y contacto</h4>
        <a href="#">Aviso de privacidad</a>
        <a href="#">T&eacute;rminos y condiciones</a>
      </div>
    </div>
    <div class="footDiv"></div>
    <div class="footLegal">
      <div class="copy">&copy; 2026 Academia De Cero a Inversionista &middot; Osvaldo Mares &amp; Alejandro Alberto. Todos los derechos reservados.</div>
      <div class="disc"><i>🔒</i><span>Aviso legal: invertir conlleva riesgo. Los resultados pasados no garantizan resultados futuros. El contenido es educativo y no constituye asesor&iacute;a financiera personalizada.</span></div>
    </div>
  </div>
</footer>

<script src="js/script.js"></script>
<?php include_once('../restore-content.php'); ?>
<script>
    $(document).ready(function() {
        $('#prospectoForm').submit(function(event) {
            event.preventDefault();
            $('.gptChat').html("Loading... <br >" + "Estamos procesando con IA tu informaci&oacute;n. &iexcl;Danos un momento, por favor!");
            const apiKeyVioniko = "<?= $gptAPIKey ?>";
            const apiUrl = "https://api.openai.com/v1/chat/completions";
            var formValues = $('#formContainer :input').serializeArray();
            const apiKey = atob(apiKeyVioniko);
            <?php
            $prompt = str_replace("\n", ' ', $prompt);
            ?>
            var longSentence = '<?= $prompt ?>';
            var formObject = {};
            formValues.forEach(function(item) {
                var newKey = item.name.replace(/_\d+$/, '');
                formObject[newKey] = item.value;
            });
            $.each(formObject, function(variable, value) {
                var regex = new RegExp('\\(' + variable + '\\)', 'gi');
                longSentence = longSentence.replace(regex, value);

                regex = new RegExp('\\(\\s*' + variable + '\\s*\\)', 'gi');
                longSentence = longSentence.replace(regex, value);
            });
            var userMessage = longSentence.replace(/\(\s*(.*?)\s*\)/g, "$1");
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
                    $('#inputContainer').replaceWith(newInput);
                    $('#inputContainerPrompt').replaceWith(newInputPrompt);
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
