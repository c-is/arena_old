<?php

/**
 * 不要な自動挿入コードを削除
 *
 *
 */
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
// Since 4.4
remove_action( 'wp_head', 'rest_output_link_wp_head' );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
// RSS
foreach ( array( 'rss2_head', 'commentsrss2_head', 'rss_head', 'rdf_header', 'atom_head', 'comments_atom_head', 'opml_head', 'app_head' ) as $action ) {
	remove_action( $action, 'the_generator' );
}

/**
 * バージョン非表示
 *
 *
 */

function remove_cssjs_ver( $src ) {
	if( !is_user_logged_in() && strpos( $src, '?ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );

/**
 * 絵文字を無効化
 *
 *
 */
function disable_emoji() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'disable_emoji' );

/**
 * wp_headのlink rel=”canonical”の出力を無効化
 *
 *
 */
remove_action('wp_head', 'rel_canonical');

/**
 * 自動挿入されるpタグを削除
 *
 *
 */
remove_filter('the_content', 'wpautop', 9);
remove_filter('the_excerpt', 'wpautop', 9);
remove_filter('acf_the_content', 'wpautop', 9);


/**
 * 絶対パスを相対パスに変換
 *
 *
 */
function make_href_root_relative($input) {
    return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
}
add_filter( 'the_permalink', 'root_relative_permalinks' );

/**
 * ファイル名を取得
 *
 *
 */
function get_filename($file) {
	return preg_replace("/(.+)(\.[^.]+$)/", "$1", $file);
}

/**
 * 子ページかどうかをチェック
 *
 *
 */
function is_subpage() {
    global $post;
	if ( is_page() && $post->post_parent ){
		$parentID = $post->post_parent;
		return $parentID;
	} else {
		return false;
	};
};

/**
 * 投稿表示ループの最初かを判定
 *
 *
 */
function isFirst(){
    global $wp_query;
    return ($wp_query->current_post === 0);
}

/**
 * 投稿表示ループの最後かを判定
 *
 *
 */
function isLast(){
    global $wp_query;
    return ($wp_query->current_post+1 === $wp_query->post_count);
}

/**
 * 投稿表示ループの奇数番目かを判定
 *
 *
 */
function isOdd(){
    global $wp_query;
    return ((($wp_query->current_post+1) % 2) === 1);
}

/**
 * 投稿表示ループの偶数番目かを判定
 *
 *
 */
function isEvery(){
    global $wp_query;
    return ((($wp_query->current_post+1) % 2) === 0);
}

/**
 * セッションを開始
 *
 *
 */
function is_session_started() {
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}
function init_session_start(){
	if ( is_session_started() === FALSE ) session_start();
}
add_action('init', 'init_session_start');

?>