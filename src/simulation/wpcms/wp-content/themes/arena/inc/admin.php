<?php


/**
 * 管理画面の一覧表示に「順序」の列を追加
 */
function add_order_column($columns) {
  $columns['menu_order'] = '順序';
  return $columns;
}
add_filter('manage_edit-page_columns', 'add_order_column');
/* Display display value */
function display_order_value($column_name, $post_id) {
  if($column_name == 'menu_order'){
    echo get_post_field('menu_order', $post_id);
  }
}
add_action('manage_posts_custom_column', 'display_order_value', 10, 2);
add_action('manage_pages_custom_column', 'display_order_value', 10, 2);
/* Add column sortable */
function make_order_column_sortable( $columns ) {
  $columns['menu_order'] = 'menu_order';
  return $columns;
}
add_filter('manage_edit-page_sortable_columns', 'make_order_column_sortable');


/**
 * 管理画面フッターの文言（HTML）
 */
function custom_admin_footer() {
	echo 'Copyright &copy; DESCENTE LTD. All Rights Reserved.';
}
add_filter('admin_footer_text', 'custom_admin_footer');



/**
 * 管理画面専用のCSSとJSを読み込み
 */
function custom_admin_script() {
    wp_enqueue_style('custom_admin_css', get_template_directory_uri() . '/admin/style.css', false, null, 'all');
    wp_enqueue_script('custom_admin_js', get_template_directory_uri() . '/admin/script.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'custom_admin_script');



/**
 * ログイン画面のロゴを変更
 */
function custom_login_logo() {
    $fileName = 'logo_login.png';
	$filePath = get_template_directory_uri() . '/admin/' . $fileName;
	$serverPath = TEMPLATEPATH . '/admin/' . $fileName;
	if ( file_exists( $serverPath ) ) {
		echo '<style type="text/css">' . "\n";
		echo "\t" . 'body { background: linear-gradient(#CCCCCC, #FEFEFE); }' . "\n";
		echo "\t" . '.login h1 a { width: 300px; height: 60px; background: url(' .  $filePath . ') no-repeat center center !important; }' . "\n";
		echo '</style>' . "\n";
	}
}
add_action('login_head', 'custom_login_logo');



/**
 * ログイン画面のロゴのリンク先を変更
 */
function custom_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );



/**
 * ログイン画面のロゴのタイトル属性のテキストを変更
 */
function custom_login_logo_url_title() {
	return '&quot; ' . get_bloginfo('name') . '&quot; Powered by WordPress';
}
add_filter( 'login_headertitle', 'custom_login_logo_url_title' );



/**
 * ダッシュボードウィジェットの非表項目
 */
function custom_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);			// アクティビティ
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);		// 現在の状況
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);	// 最近のコメント
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);	// 被リンク
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);			// プラグイン
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);		// クイック投稿 remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);	// 最近の下書き
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);			// WordPressブログ
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);			// WordPressフォーラム
}
//add_action('wp_dashboard_setup', 'custom_remove_dashboard_widgets');


/**
 * 「リンク」を有効化
 * 
 * 
 */
add_filter( 'pre_option_link_manager_enabled', '__return_true' );


?>