<?php

/**
 * メニューをサポート
 *
 *
 */
add_theme_support('title-tag');

/**
 * 抜粋の変更
 *
 *
 */
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * メニューをサポート
 *
 *
 */
add_theme_support('menus');

/**
 * アイキャッチ画像をサポート
 *
 *
 */
add_theme_support('post-thumbnails');

/**
 * アイキャッチ画像のサイズ指定
 *
 *
 */
//set_post_thumbnail_size( 300, 9999, false );

/**
 * 追加の画像サイズ（アップロード時に生成）
 *
 *
 */
//add_image_size( 'thumb_list', 200, 9999, false);

/**
 * フィードへのリンクをサポート
 *
 *
 */
//add_theme_support('automatic-feed-links');

/**
 * 投稿タイプ（post）での「順序」を有効化
 *
 *
 */
add_post_type_support( 'post', 'page-attributes' );

/**
 * 固定ページの抜粋を有効化
 *
 *
 */
add_post_type_support( 'page', 'excerpt' );

?>