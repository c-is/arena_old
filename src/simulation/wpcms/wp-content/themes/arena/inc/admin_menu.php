<?php

/**
 * 管理画面のメニュー表示を制御
 * 
 * 
 */
function remove_admin_menus() {
 	
	//if (!current_user_can('administrator')) :
 
        global $menu;
 
		/**
		 * WordPress標準メニュー
		 * 
		 * 
		 */
		
		// ダッシュボード -> unset($menu[2]);
		/*
		remove_menu_page('index.php');
		remove_submenu_page('index.php', 'index.php'); // ダッシュボード -> ホーム
		remove_submenu_page('index.php', 'update-core.php'); // ダッシュボード -> 更新
		*/
		
		// セパレータ1
		/*
		remove_menu_page('separator1');
		*/
		
		// 投稿 -> unset($menu[5]);
        /*
		if( !current_user_can('administrator') ):
			remove_menu_page('edit.php');
			remove_submenu_page('edit.php', 'edit.php'); // 投稿 -> 投稿一覧
			remove_submenu_page('edit.php', 'post-new.php'); // 投稿 -> 新規追加
			remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category'); // 投稿 -> カテゴリ
			remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag'); // 投稿 -> タグ
		endif;
        */
  
		// メディア -> unset($menu[10]);
		/*
		if( !current_user_can('administrator') ):
			remove_menu_page('upload.php');
			remove_submenu_page('upload.php', 'upload.php'); // メディア -> ライブラリ
			remove_submenu_page('upload.php', 'media-new.php'); // メディア -> 新規追加
		endif;
        */
		
		// リンク
		/*
		remove_menu_page('link-manager.php');
		remove_submenu_page('link-manager.php', 'link-manager.php'); // リンク -> すべてのリンク
		remove_submenu_page('link-manager.php', 'link-add.php'); // リンク -> 新規追加
		remove_submenu_page('link-manager.php', 'edit-tags.php?taxonomy=link_category'); // リンク -> リンクカテゴリー
		*/
		
		// 固定ページ -> unset($menu[20]);
		/*
		remove_menu_page('edit.php?post_type=page');
		remove_submenu_page('edit.php?post_type=page', 'edit.php?post_type=page'); // 固定ページ -> 固定ページ一覧
		remove_submenu_page('edit.php?post_type=page', 'post-new.php?post_type=page'); // 固定ページ -> 新規追加
		*/
		
		// コメント -> unset($menu[25]);
		remove_menu_page('edit-comments.php');
		
		
		// セパレータ1
		/*
		remove_menu_page('separator2');
		*/
		
		// 外観 -> unset($menu[60]);
		/*
		remove_menu_page('themes.php');
		remove_submenu_page('themes.php', 'themes.php'); // 外観 -> テーマ
		remove_submenu_page('themes.php', 'widgets.php'); // 外観 -> ウィジェット
		remove_submenu_page('themes.php', 'theme-editor.php'); // 外観 -> テーマ編集
		*/
		
		// プラグイン -> unset($menu[65]);
		/*
		remove_menu_page('plugins.php');
		remove_submenu_page('plugins.php', 'plugins.php'); // プラグイン -> インストール済みプラグイン
		remove_submenu_page('plugins.php', 'plugin-install.php'); // プラグイン -> 新規追加
		remove_submenu_page('plugins.php', 'plugin-editor.php'); // プラグイン -> プラグイン編集
		*/
		
		// ユーザー -> unset($menu[70]);
		/*
		remove_menu_page('users.php');
		remove_submenu_page('users.php', 'users.php'); // ユーザー -> ユーザー一覧
		remove_submenu_page('users.php', 'user-new.php'); // ユーザー -> 新規追加
		remove_submenu_page('users.php', 'profile.php'); // ユーザー -> プロフィール
		*/
		
		// ツール -> unset($menu[75]);
		/*
		if( !current_user_can('administrator') ):
			remove_menu_page('tools.php');
			remove_submenu_page('tools.php', 'tools.php'); // ツール -> 利用可能なツール
			remove_submenu_page('tools.php', 'import.php'); // ツール -> インポート
			remove_submenu_page('tools.php', 'export.php'); // ツール -> エクスポート
		endif;
        */
		
		// 設定 -> unset($menu[80]);
		/*
		remove_menu_page('options-general.php');
		remove_submenu_page('options-general.php', 'options-general.php'); // 設定 -> 一般
		remove_submenu_page('options-general.php', 'options-writing.php'); // 設定 -> 投稿設定
		remove_submenu_page('options-general.php', 'options-reading.php'); // 設定 -> 表示設定
		remove_submenu_page('options-general.php', 'options-discussion.php'); // 設定 -> ディスカッション
		remove_submenu_page('options-general.php', 'options-media.php'); // 設定 -> メディア
		remove_submenu_page('options-general.php', 'options-privacy.php'); // 設定 -> プライバシー
		remove_submenu_page('options-general.php', 'options-permalink.php'); // 設定 -> パーマリンク設定
		*/
		
		// プロフィール(管理者以外のユーザー用)
		/*
		remove_menu_page('profile.php');
		*/
		
		/**
		 * プラグイン、その他
		 * 
		 * 
		 */
		 
		// Contact Form 7
		/*
		if( !current_user_can('administrator') ):
			remove_menu_page('wpcf7');
		endif;
        */
		
    //endif;
}
add_action('admin_menu', 'remove_admin_menus');

/**
 * 投稿画面内のメニュー表示を制御
 * 
 * 
 */
function remove_admin_edit_menus() {
    if (!current_user_can('administrator')) {
		//remove_meta_box('postexcerpt','post','normal');       // 抜粋
		//remove_meta_box('trackbacksdiv','post','normal');     // トラックバック送信
		//remove_meta_box('postcustom','post','normal');        // カスタムフィールド
		//remove_meta_box('commentstatusdiv','post','normal');  // ディスカッション
		//remove_meta_box('commentsdiv','post','normal');       // コメント
		//remove_meta_box('slugdiv','post','normal');           // スラッグ
		//remove_meta_box('authordiv','post','normal');         // 作成者
		//remove_meta_box('revisionsdiv','post','normal');      // リビジョン
		//remove_meta_box('formatdiv','post','normal');         // フォーマット
		//remove_meta_box('categorydiv','post','normal');       // カテゴリー
	}
}
add_action('admin_menu', 'remove_admin_edit_menus');

/**
 * 管理ツールバーの表示項目
 * 
 * 
 */
function remove_admin_bar_menu( $wp_admin_bar ) {
	//if (!current_user_can('administrator')) :
		
		/**
		 * WordPressシンボルマークを非表示
		 * 
		 * 
		 */
		$wp_admin_bar->remove_menu( 'wp-logo' );
		
		/**
		 * 「新規」のサブメニューを削除
		 * 
		 * 
		 */
		/*
		$wp_admin_bar->remove_node('edit');
		$wp_admin_bar->remove_node('new-page');
		$wp_admin_bar->remove_node('new-media');
		$wp_admin_bar->remove_node('new-page');
		$wp_admin_bar->remove_node('new-pickup');
		*/
		
		/**
		 * マイアカウントを非表示
		 * 
		 * 
		 */
		//$wp_admin_bar->remove_menu('my-account');
		
	//endif;
}
add_action( 'admin_bar_menu', 'remove_admin_bar_menu', 1000 );

/**
 * 表示の順序を変える
 * 
 * 
 */
function push_menus () {
    global $menu;
	/**
	 * [メディア]を表示項目の一番下に移動する。
	 * 
	 * 
	 */
    array_push($menu, $menu[10]);
    unset($menu[10]);
}
add_action('admin_menu', 'push_menus');

?>