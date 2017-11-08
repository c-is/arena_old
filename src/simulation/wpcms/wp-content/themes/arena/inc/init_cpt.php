<?php
/**
 * Set Custom POST Type
 *
 * @package WordPress
 * @subpackage arena CUSTOM ORDER
 * @since 1.0
 * @version 1.0
 *  
 */


/**
 * リライトルールを指定
 *
 *
 */
function custom_rewrite_rule() {
  // FAQ
  //add_rewrite_rule('support/faq/?$', 'index.php?post_type=faq&', 'top');
  //add_rewrite_rule('support/faq/([^/]+)/?$', 'index.php?post_type=faq&faq=$matches[1]', 'top');
  
  // 検証
  //print '<code><pre>'; print_r(get_option( 'rewrite_rules' )); print '</pre></code>';
  
}
//add_action('init', 'custom_rewrite_rule', 10, 0);



/**
 * カスタム投稿(Post Type)・カスタム分類(Taxonomy)の編集後に一度だけ実行
 *  - 通常はコメントアウトのままにしておく
 *  - 管理者ページの「設定」－「パーマリンク設定」で「変更を更新」ボタンを押下で同じ効果
 * 
 */
//flush_rewrite_rules();



/**
 * 分類[category, tag]の編集
 *
 *
 */
function init_wp_post_types(){
  global $wp_post_types;
  foreach((array)$wp_post_types['post']->labels as $key => $val):
    $wp_post_types['post']->labels->$key = str_replace('投稿', '製品', $val);
  endforeach;
}
add_action( 'init', 'init_wp_post_types');
function init_wp_taxonomies(){
  global $wp_taxonomies;
  // カテゴリー
  foreach((array)$wp_taxonomies['category']->labels as $key => $val):
    $wp_taxonomies['category']->labels->$key = str_replace('カテゴリー', '製品分類', $val);
  endforeach;
  // タグ
  foreach((array)$wp_taxonomies['post_tag']->labels as $key => $val):
    $wp_taxonomies['post_tag']->labels->$key = str_replace('タグ', '対象者', $val);
  endforeach;
}
add_action( 'init', 'init_wp_taxonomies');


/**
 * カスタム分類[taxonomy]の追加
 *
 *
 */

/* taxonomy => size */
function register_size_to_post_taxonomy() {
    $defaults = array(
      'slug' => 'size',
      'display' => 'サイズ',
    );
    $args = array (
            'label' => $defaults['display'],
            'labels' => array (
                    'name' => $defaults['display'],
                    'singular_name' => $defaults['display'],
                    'search_items' => $defaults['display'] . 'を検索',
                    'popular_items' => '人気の' . $defaults['display'],
                    'add_new_item' => $defaults['display'] . 'を追加',
                    'edit_item' => $defaults['display']. 'の編集'
            ),
            'show_admin_column' => true,
            'hierarchical' => true,
            'query_var' => true,
            'rewrite' => array ('slug' => $defaults['slug'],'with_front' => false),
            'sort' => true,
            'show_in_rest' => true,
            'rest_base' => $defaults['slug'],
            'rest_controller_class' => 'WP_REST_Terms_Controller',
    );
    register_taxonomy($defaults['slug'], 'post', $args);
}
add_action('init', 'register_size_to_post_taxonomy', 10, 2);

/* taxonomy => material */
function register_material_to_post_taxonomy() {
    $defaults = array(
      'slug' => 'material',
      'display' => '素材',
    );
    $args = array (
            'label' => $defaults['display'],
            'labels' => array (
                    'name' => $defaults['display'],
                    'singular_name' => $defaults['display'],
                    'search_items' => $defaults['display'] . 'を検索',
                    'popular_items' => '人気の' . $defaults['display'],
                    'add_new_item' => $defaults['display'] . 'を追加',
                    'edit_item' => $defaults['display']. 'の編集'
            ),
            'show_admin_column' => true,
            'hierarchical' => true,
            'query_var' => true,
            'rewrite' => array ('slug' => $defaults['slug'],'with_front' => false),
            'sort' => true,
            'show_in_rest' => true,
            'rest_base' => $defaults['slug'],
            'rest_controller_class' => 'WP_REST_Terms_Controller',
    );
    register_taxonomy($defaults['slug'], 'post', $args);
}
add_action('init', 'register_material_to_post_taxonomy', 10, 2);

/* taxonomy => color-code */
/*
function register_color_code_to_post_taxonomy() {
    $defaults = array(
      'slug' => 'color-code',
      'display' => 'カラーコード',
    );
    $args = array (
            'label' => $defaults['display'],
            'labels' => array (
                    'name' => $defaults['display'],
                    'singular_name' => $defaults['display'],
                    'search_items' => $defaults['display'] . 'を検索',
                    'popular_items' => '人気の' . $defaults['display'],
                    'add_new_item' => $defaults['display'] . 'を追加',
                    'edit_item' => $defaults['display']. 'の編集'
            ),
            'show_admin_column' => true,
            'hierarchical' => true,
            'query_var' => true,
            'rewrite' => array ('slug' => $defaults['slug'],'with_front' => false),
            'sort' => true,
            'show_in_rest' => true,
            'rest_base' => $defaults['slug'],
            'rest_controller_class' => 'WP_REST_Terms_Controller',
    );
    register_taxonomy($defaults['slug'], 'post', $args);
}
add_action('init', 'register_color_code_to_post_taxonomy', 10, 2);
*/

/* taxonomy => mark-position */
function register_mark_position_to_post_taxonomy() {
    $defaults = array(
      'slug' => 'mark-position',
      'display' => 'マークの位置',
    );
    $args = array (
            'label' => $defaults['display'],
            'labels' => array (
                    'name' => $defaults['display'],
                    'singular_name' => $defaults['display'],
                    'search_items' => $defaults['display'] . 'を検索',
                    'popular_items' => '人気の' . $defaults['display'],
                    'add_new_item' => $defaults['display'] . 'を追加',
                    'edit_item' => $defaults['display']. 'の編集'
            ),
            'show_admin_column' => true,
            'hierarchical' => true,
            'query_var' => true,
            'rewrite' => array ('slug' => $defaults['slug'],'with_front' => false),
            'sort' => true,
            'show_in_rest' => true,
            'rest_base' => $defaults['slug'],
            'rest_controller_class' => 'WP_REST_Terms_Controller',
    );
    register_taxonomy($defaults['slug'], 'post', $args);
}
add_action('init', 'register_mark_position_to_post_taxonomy', 10, 2);
 
/* taxonomy => mark-font */
function register_mark_font_to_post_taxonomy() {
    $defaults = array(
      'slug' => 'mark-font',
      'display' => 'マークの書体',
    );
    $args = array (
            'label' => $defaults['display'],
            'labels' => array (
                    'name' => $defaults['display'],
                    'singular_name' => $defaults['display'],
                    'search_items' => $defaults['display'] . 'を検索',
                    'popular_items' => '人気の' . $defaults['display'],
                    'add_new_item' => $defaults['display'] . 'を追加',
                    'edit_item' => $defaults['display']. 'の編集'
            ),
            'show_admin_column' => true,
            'hierarchical' => true,
            'query_var' => true,
            'rewrite' => array ('slug' => $defaults['slug'],'with_front' => false),
            'sort' => true,
            'show_in_rest' => true,
            'rest_base' => $defaults['slug'],
            'rest_controller_class' => 'WP_REST_Terms_Controller',
    );
    register_taxonomy($defaults['slug'], 'post', $args);
}
add_action('init', 'register_mark_font_to_post_taxonomy', 10, 2);

/* taxonomy => mark-color */
function register_mark_color_to_post_taxonomy() {
    $defaults = array(
      'slug' => 'mark-color',
      'display' => 'マークの色',
    );
    $args = array (
            'label' => $defaults['display'],
            'labels' => array (
                    'name' => $defaults['display'],
                    'singular_name' => $defaults['display'],
                    'search_items' => $defaults['display'] . 'を検索',
                    'popular_items' => '人気の' . $defaults['display'],
                    'add_new_item' => $defaults['display'] . 'を追加',
                    'edit_item' => $defaults['display']. 'の編集'
            ),
            'show_admin_column' => true,
            'hierarchical' => true,
            'query_var' => true,
            'rewrite' => array ('slug' => $defaults['slug'],'with_front' => false),
            'sort' => true,
            'show_in_rest' => true,
            'rest_base' => $defaults['slug'],
            'rest_controller_class' => 'WP_REST_Terms_Controller',
    );
    register_taxonomy($defaults['slug'], 'post', $args);
}
add_action('init', 'register_mark_color_to_post_taxonomy', 10, 2);

/* taxonomy => color */
function register_color_to_post_taxonomy() {
    $defaults = array(
      'slug' => 'color',
      'display' => '色',
    );
    $args = array (
            'label' => $defaults['display'],
            'labels' => array (
                    'name' => $defaults['display'],
                    'singular_name' => $defaults['display'],
                    'search_items' => $defaults['display'] . 'を検索',
                    'popular_items' => '人気の' . $defaults['display'],
                    'add_new_item' => $defaults['display'] . 'を追加',
                    'edit_item' => $defaults['display']. 'の編集'
            ),
            'show_admin_column' => true,
            'hierarchical' => true,
            'query_var' => true,
            'rewrite' => array ('slug' => $defaults['slug'],'with_front' => false),
            'sort' => true,
            //'show_in_rest' => true,
            //'rest_base' => $defaults['slug'],
            //'rest_controller_class' => 'WP_REST_Terms_Controller',
    );
    register_taxonomy($defaults['slug'], 'post', $args);
}
//add_action('init', 'register_color_to_post_taxonomy', 10, 2);


/*
'name' - 投稿タイプの一般名、通常は複数形。省略すると $post_type_object->label と同じ値になる。
'singular_name' - この投稿タイプのオブジェクト 1 個の名前（単数形）。デフォルトは 'name' の値。
'menu_name' - メニュー名のテキスト。メニュー項目の名前を決める文字列です。デフォルトは 'name' の値。
'name_admin_bar' - 管理バーの「新規追加」ドロップダウンに入れる名前。デフォルトは、'singular_name' があればその値になり、無ければ 'name' の値になる。
'all_items' - メニューの「すべての〜」に使うテキスト。デフォルトは 'name' の値。
'add_new' - 「新規追加」のテキスト。デフォルトは階層あり／なしどちらの投稿タイプも "Add New"。この文字列を国際化対応にするには、gettext context を使って、投稿タイプをマッチさせてください。例： _x('Add New', 'product');
'add_new_item' - 「新規〜を追加」のテキスト。デフォルトは "Add New Post" または "Add New Page"。
'edit_item' - 「〜を編集」のテキスト。管理画面で、このラベルはカスタム投稿の編集パネルのメインヘッダーに表示されます。デフォルトは階層なしなら "Edit Post"、階層あり投稿タイプなら "Edit Page"。
'new_item' - 「新規〜」のテキスト。デフォルトは階層なしなら "New Post"、階層あり投稿タイプなら "New Page"。
'view_item' - 「〜を表示」のテキスト。デフォルトは "View Post" または "View Page"。
'search_items' - 「〜を検索」のテキスト。デフォルトは "Search Posts" または "Search Pages"。
'not_found' - 「〜が見つかりませんでした」のテキスト。デフォルトは "No posts found" または "No pages found"。
'not_found_in_trash' - 「ゴミ箱内に〜が見つかりませんでした」のテキスト。デフォルトは "No posts found in Trash" または "No pages found in Trash"。
'parent_item_colon' - 「親〜：」のテキスト。階層あり投稿タイプのときのみ使われる。デフォルトは "Parent Page"。
*/

?>