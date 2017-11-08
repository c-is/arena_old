<?php

/**
* Order Custom Post Type
* 
* WordPressのWP_Queryでよく使うコードスニペット
* http://sole-color-blog.com/blog/php/265/
* 
*/
function order_custom_post_type( $wp_query ) {

  global $pagenow, $current_user;
  
  $currnet_date = current_time('Y/m/d');
  set_query_var('the_beginning_of_this_year', current_time('Y') . '/1/1');
  
  set_query_var('help', get_bookmark(1));
  set_query_var('endpoints', array());
  
  // 管理画面またはメインではない場合
  if (is_admin() || !$wp_query->is_main_query()):
    return;
  endif;
  
  /**
  * メインクエリに対する処理
  * 
  */
  // 納入先全てを取得して$wp_queryに追加 
  if(is_home()):
  endif;
  // テンプレート別の処理
  if(is_home()):
    /*
    $wp_query->set('post_type', 'news');
    $wp_query->set('posts_per_page', -1);
    $wp_query->set('order', 'ASC');
    $wp_query->set('orderby', 'menu_order');
    */
  elseif(is_archive()):
    // アーカイブ
    if(is_post_type_archive()):
    elseif(is_tax()):
      if($wp_query->tax_query->queries):
        //var_dump($wp_query);
      endif;
    endif;
  elseif(is_singular()):
    if(is_single()):
      //var_dump($wp_query);
    elseif(is_page()):
      //var_dump($wp_query);
    endif;
  elseif(is_search()):
    //var_dump($wp_query);
  elseif(is_404()):
    wp_redirect(home_url());
    exit ;
  else:
    //var_dump($wp_query);
  endif;
}
add_action( 'pre_get_posts', 'order_custom_post_type' );

?>