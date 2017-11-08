<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="container">
 *
 * @package WordPress
 * @subpackage arena CUSTOM ORDER
 * @since 1.0
 * @version 1.0
 */
  
  // Style1〜5をセット
  $styles = array('style1' => '', 'style2' => '', 'style3' => '', 'style4' => '', 'style5' => '');
  foreach((array)$styles as $key => $value):
    $style_query = null;
    // Style保存クエリがあれば代入して、cookie を上書き
    if(isset($_GET[$key]) && $_GET[$key]):
      $style_query = esc_attr(strtoupper($_GET[$key]));
      $style_query .= (isset($_GET['bcol']) && $_GET['bcol'])? ',' . esc_attr($_GET['bcol']) : null;
      $style_query .= (isset($_GET['pos']) && $_GET['pos'])? ',' . esc_attr($_GET['pos']) : null;
      $style_query .= (isset($_GET['font']) && $_GET['font'])? ',' . esc_attr($_GET['font']) : null;
      $style_query .= (isset($_GET['col']) && $_GET['col'])? ',' . esc_attr($_GET['col']) : null;
      $style_query .= (isset($_GET['mark']) && $_GET['mark'])? ',' . esc_attr($_GET['mark']) : null;
      setcookie($key, rawurlencode($style_query), time()+10140, '/simulation/');
      //var_dump(rawurldecode($_COOKIE[$key]));
    else:
      // Style保存クエリがなく既にcookieがあればそのまま
      if(isset($_COOKIE[$key])):
        $style_query = $_COOKIE[$key];
      // cookie が存在しない場合は値を「0」でセット
      else:
        $style_query = 0;
        setcookie($key, $style_query, time()+10140, '/simulation/');
      endif;
    endif;
    $styles[$key] = $style_query;
  endforeach;
  set_query_var('styles', $styles);
  set_query_var('keys', array('style', 'bcol', 'pos', 'font', 'col', 'mark'));
    
  
  // WP REST JSON Endpoints
  $endpoints = array();
  if(is_single()):
    $categories = wp_get_post_terms($wp_query->post->ID, 'category');
    $tags = wp_get_post_terms($wp_query->post->ID, 'post_tag');
    $endpoints['term'] = get_rest_url(null, '/wp/v2/posts/' . add_query_arg(array('categories' => $categories[0]->term_id, 'tags' => $tags[0]->term_id), null));
    $endpoints['post'] = get_rest_url(null, '/wp/v2/posts/' . $wp_query->post->ID);
    $endpoints['svg-front'] = get_rest_url(null, '/wp/v2/media/' . get_post_meta($wp_query->post->ID, 'svg-front', true));
    $endpoints['svg-back'] = get_rest_url(null, '/wp/v2/media/' . get_post_meta($wp_query->post->ID, 'svg-back', true));
  endif;
  set_query_var('endpoints', $endpoints);

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

<?php wp_head(); ?>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script><script>window.html5 || document.write('<script src="/assets/vendor/html5shiv/3.7.3/html5shiv.min.js"><\/script>')</script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><script>window.respond || document.write('<script src="/assets/vendor/respond/1.4.2/respond.min.js"><\/script>')</script><![endif]-->

  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
  
<script>
  var endpoints = { <?php if($endpoints = get_query_var('endpoints')):
    foreach((array)$endpoints as $key => $value):
      echo "'" . $key . '\' : ' . '"' . $value . '"';
      if($value !== end($endpoints)) echo ', ';
    endforeach;
  endif; ?> };
</script>
  
</head>
<body id="pagetop" <?php body_class(); ?>>
  
  <!-- Google Tag Manager (noscript) -->
  <noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXX" height="0" width="0" style="display:none;visibility:hidden"></iframe>
  </noscript>
  <script src="<?php bloginfo('url'); ?>/assets/js/gtm.js"></script>
  <!-- End Google Tag Manager -->
  
  <header class="header clear" role=banner>
    <?php get_template_part( 'template/header', '' ); ?>
  </header>
