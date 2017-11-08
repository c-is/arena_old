<?php
  
  // $_GET
  $item = (isset($_GET['type']) && $_GET['type'])? esc_js($_GET['type']) : '';
  $bcol = (isset($_GET['bcol']) && $_GET['bcol'])? esc_js($_GET['bcol']) : '';
  $style = (isset($_GET['style']) && $_GET['style'])? esc_js($_GET['style']) : 0;
  
  // POST & JSON
  $item_post = get_page_by_path(mb_strtolower($item), "OBJECT", "post");
  $url = (isset($item_post->post_title))? get_bloginfo('url') . '/wp-json/wp/v2/posts/?slug=' . $item_post->post_title : '';
  if(empty($url) || !$url):
    return;
    throw new Exception($error = "Internal error");
  endif;
  try{
    $basic_auth = array('user' => 'ccv', 'pass' => 'shunlock');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERPWD, $basic_auth['user'] . ":" . $basic_auth['pass']);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    $result = curl_exec($ch);
    $curlErrno = curl_errno($ch);
    if($curlErrno):
      throw new Exception($curlError = curl_error($ch));
    endif;
    curl_close($ch);
  } catch(Exception $e){
    echo "Exception-".$e->getMessage();
  }
  $json = json_decode($result, true);
  $code = ($bcol && isset($json[0]['meta']['codes'][$bcol]))? $json[0]['meta']['codes'][$bcol] : '';
  
  // Get SVG
  $basic_auth = array('user' => 'ccv', 'pass' => 'shunlock');
  $url = $json[0]['meta']['svg']['front'];
  if(empty($url)){
    throw new Exception($error = "Internal error");
  }
  try{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $basic_auth['user'] . ":" . $basic_auth['pass']);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    $result = curl_exec($ch);
    curl_close($ch);
    $svg = $result;
  } catch(Exception $e){
    echo "Exception-".$e->getMessage();
  }
  
  
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 user-scalable=no">
<meta name="referrer" content="unsafe-url">
<meta name="theme-color" content="#000">
<meta name="description" content="<?php echo (is_single() && get_post_type() == 'post')? $post->post_content : get_bloginfo('description') ?>">
<meta name="keywords" content="<?php echo (is_single() && get_post_type() == 'post')? wp_strip_all_tags(get_the_term_list($post->ID, 'material', null, ',', '')) : ''; ?>">
<meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?>（<?php bloginfo('description'); ?>）">
<meta property="og:type" content="website">
<meta property="og:url" content="<?php bloginfo('url'); ?>">
<meta property="og:image" content="<?php echo (is_single() && get_post_type() == 'post' && has_post_thumbnail($post->ID))? wp_get_attachment_url(get_post_thumbnail_id($post->ID)) : bloginfo('url') . '/assets/img/ogp/og_image.png'; ?>">
<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
<meta property="og:description" content="<?php bloginfo('description'); ?>" />
<link rel="shortcut icon" href="/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<?php //wp_head(); ?>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script><script>window.html5 || document.write('<script src="/assets/vendor/html5shiv/3.7.3/html5shiv.min.js"><\/script>')</script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><script>window.respond || document.write('<script src="/assets/vendor/respond/1.4.2/respond.min.js"><\/script>')</script><![endif]-->

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" type="text/css" media="screen" />
<style type="text/css">  
<!--
  html, body {
    height: 100%;
    background: transparent;
  }
<?php 
  $alphabet = str_split('abcdefghijklmnopqrstuvwxhz');
  foreach((array)$code as $key => $value): 
?>
  svg #<?php echo $alphabet[$key]; ?>-color path {
    fill: <?php echo $value['hex']; ?> !important;
  }
<?php endforeach; ?>
-->
  svg { 
    height: 100%; 
    width: 100%;
  }
</style>
</head>
<body id="pagetop" <?php body_class(); ?>>
<!--
<?php
  var_dump($bcol, $code);
?>
-->
<?php echo $svg; ?>

<?php /*
<canvas id="style" width="500" height="500"></canvas>
<script>
var img = new Image();
img.src = '<?php echo $url; ?>';
img.onload = function() {
    var c = document.getElementById('style');
    var ctx = c.getContext('2d');
    ctx.drawImage(img, 0, 0, 75, 125);
}
</script>
*/ ?>

</body>
</html>