<?php

/**
 * WP Email Login
 * ユーザーID に加えてメールアドレスでもログイン可能
 */
function login_with_email_address( &$username ) {
	$user = get_user_by('email',$username);
	if(!empty($user->user_login)):
		$username = $user->user_login;
	endif;
	return $username;
}
//add_action('wp_authenticate', 'login_with_email_address');

function change_username_text($text){
	if( in_array($GLOBALS['pagenow'], array('wp-login.php')) ):
		if ($text == 'ユーザー名'):
			$text = 'メールアドレス';
		endif;
	endif;
	return $text;
}
//add_filter( 'gettext', 'change_username_text' );


/**
 * プラグインのアップデート通知を非表示
 *
 * 【対象】管理者権限以外
 *
 */
function remove_update_counts () {
	//if (!current_user_can('administrator')) :
		global $menu, $submenu;
		if (isset($submenu['index.php'][10])) :
			$submenu['index.php'][10][0] = 'Updates';
		endif;
	//endif;
}
//add_action('admin_menu', 'remove_update_counts');

/**
 * メディア挿入時のデフォルトのリンク先を「なし」に設定する
 *
 *
 */
function custom_default_noimagelink() {
    $custom_default_imagelink = get_option( 'image_default_link_type' );
    if ($custom_default_imagelink !== 'none') {
        update_option('image_default_link_type', 'none');
    }
}
add_action('admin_init', 'custom_default_noimagelink', 10);

/**
 * デバッグメッセージをログファイルに出力する関数
 *
 * @param string $output  出力したい文字列
 * @param string $path    出力先のパス（未指定時はテンプレートと同じディレクトリのlog.txt）
 * @see [030] WordPress のデバッグ | WordPress experiment – twentyten customize- http://experiment.street-square.com/2010/10/04/debug/#more-923
 */
function my_log_message($output, $path = null) {
  if (is_array($output)) {
    ob_start();
    print_r($output);
    $str = ob_get_contents();
    ob_end_clean();
  } else {
    $str = var_export($output, true);
  }
  $path = isset($path) ? $path : TEMPLATEPATH . '/log/debug.txt';
  $fp = fopen($path, 'a');
  fwrite($fp, "{$str}\n");
  fclose($fp);
}

/**
 * 自動保存の停止
 */
function disable_autosave() {
    wp_deregister_script('autosave');
}
add_action( 'wp_print_scripts', 'disable_autosave' );

?>