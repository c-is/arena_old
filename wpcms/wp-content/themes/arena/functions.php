<?php

/**
 * arena CUSTOM ORDER Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link http://codex.wordpress.org/Theme_Development
 * @link http://codex.wordpress.org/Child_Themes
 * 
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 * 
 * @package WordPress
 * @subpackage arena CUSTOM ORDER
 * @since 1.0
 * @version 1.0
 */

/*
 * タイトル文字を変更する。
 *
 * @return string title.
 *
 * @since WordPress 4.4.0
 * License: GPLv2 or later
 */
function custom_wp_title( $title ) {
    /* 
        ここで、いろいろ $title内を変更
    */
    return $title;
}
add_filter('pre_get_document_title', 'custom_wp_title' );



/*
 * タイトルの区切り線を | にする
 *
 * @since WordPress 4.4.0
 * License: GPLv2 or later
 */
function custom_title_separator( $sep ){
    $sep = '|';
    return $sep;
}
add_filter( 'document_title_separator', 'custom_title_separator' );



/**
 * 個別のCSSを追加
 * jQueryプラグインの追加
 * その他、外部読込みファイルの追加
 */
function add_theme_scripts_stylesheet() {
  global $wp_scripts, $wp_styles, $post_type, $is_IE, $is_iphone;
    /* Style Sheet */
    if ( !is_admin() ):
      /*
       * Register Template CSS
       */
      wp_register_style('style', get_bloginfo('url') . '/style.css', false, null, 'all');
      wp_register_style('print', get_template_directory_uri() . '/print.css', false, null, 'print');
      /*
       * Enqueue
       */
      wp_enqueue_style('style');
      wp_enqueue_style('print');
      
    endif;
    
    /* javascript */
    if(!is_admin()):
      /*
       * Deregister
       * 
       */
      wp_deregister_script('jquery');
      /*
       * Register
       * 
       */
      wp_register_script('modernizr', get_bloginfo('url') . '/assets/js/vendor/modernizr.js', false, null, false);
      wp_register_script('jsapi', '//www.google.com/jsapi', false, NULL, true);
      wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, null, false);
      /* jQuery Plugins */
      wp_register_script('jquery_cookie', get_bloginfo('url') . '/assets/js/cookie/jquery.cookie.min.js', array('jquery'), null, true);
      wp_register_script('jquery_easing', get_bloginfo('url') . '/assets/js/easing/jquery.easing.min.js', array('jquery'), null, true);
      /* canvas */
      wp_register_script('jquery_canvg', get_bloginfo('url') . '/assets/js/canvg/canvg.js', array('jquery'), null, true);
      wp_register_script('jquery_rgbcolor', get_bloginfo('url') . '/assets/js/canvg/rgbcolor.js', array('jquery'), null, true);
      wp_register_script('jquery_stackblur', get_bloginfo('url') . '/assets/js/canvg/StackBlur.js', array('jquery'), null, true);
      /* theme */
      wp_register_script('theme_scripts', get_bloginfo('url') . '/assets/js/scripts.min.js', array('jquery'), null, true);
      wp_register_script('theme_init', get_bloginfo('url') . '/assets/js/init.js', array('jquery'), null, true);
      /*
       * Enqueue
       * 
      */
      wp_enqueue_script('modernizr');
      //wp_enqueue_script('jsapi');
      //wp_enqueue_script('jquery');
      //wp_enqueue_script('jquery_cookie');
      //wp_enqueue_script('jquery_easing');
      wp_enqueue_script('theme_scripts');
      wp_enqueue_script('jquery_canvg');
      wp_enqueue_script('jquery_rgbcolor');
      wp_enqueue_script('jquery_stackblur');
      wp_enqueue_script('theme_init');

    endif;

}
add_action('wp_enqueue_scripts', 'add_theme_scripts_stylesheet');









/**
 * WPを初期化
 * 
 * 
 */
require_once( TEMPLATEPATH . "/inc/init_wp.php" );                  // WordPress Settings


/**
 * 管理画面・テーマを初期化
 * 
 * 
 */
require_once( TEMPLATEPATH . "/inc/init_admin.php" );               // Admin Panel Default Settings
require_once( TEMPLATEPATH . "/inc/init_theme.php" );               // Theme Default Settings

/**
 * カスタム投稿・分類の初期化
 * 
 * 
 */
require_once( TEMPLATEPATH . "/inc/init_cpt.php" );                 // Register Custom Post Type & Taxonomy 

/**
 * WP REST APIの初期化
 * 
 * 
 */
require_once( TEMPLATEPATH . "/inc/init_wp-rest-api.php" );         // Register WP REST API 

/**
 * 情報取得の初期化
 * 
 * 
 */
require_once( TEMPLATEPATH . "/inc/init_wp_query.php" );            // pre_get_posts() Setting 

/**
 * CSV Import の設定
 * 
 * 
 */
require_once( TEMPLATEPATH . "/inc/init_rsci.php" );            // Really Simple CSV Importer Setting 

/**
 * 管理画面のカスタマイズ
 * 
 * 
 */
require_once( TEMPLATEPATH . "/inc/admin.php" );             // WordPress Custom Admin
require_once( TEMPLATEPATH . "/inc/admin_menu.php" );        // WordPress Custom Admin Panel Menu



?>