<?php
  
  $help = get_query_var('help');
  $styles = get_query_var('styles');
  $keys = get_query_var('keys');
  
  $style_list = array();
  foreach((array)$styles as $key => $value): 
    $keys[0] = $key;
    $url = $permalink = $query_arg = null;
    if($value):
      foreach($q = explode(',', rawurldecode($value)) as $k => $v):
        if($v === reset($q)):
          $post_data = get_page_by_path(mb_strtolower($v), "OBJECT", "post");
          $permalink = ($post_data)? get_permalink($post_data->ID) : null;
        endif;
        $query_arg[$keys[$k]] = $v;
      endforeach;
    endif;
    $url = ($query_arg && $permalink) ? add_query_arg($query_arg, $permalink) : null;
    $current_url = (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    $style_list[] = array(
                      'name' => ucfirst($key), 
                      'type' => (isset($post_data) && $post_data)? $post_data->post_title : null, 
                      'code' => (isset($query_arg['bcol']) && $query_arg['bcol'])? $query_arg['bcol'] : null, 
                      'info' => (isset($post_data) && $post_data)? $post_data->post_content : null, 
                      'url' => $url,
                      'active' => ($url == rawurldecode($current_url))? true : false
    );
  endforeach;
  
?>
  <a class=header__logo href="<?php echo get_bloginfo('url'); ?>"><img src="<?php echo get_bloginfo('url'); ?>/assets/images/common/header-logo.png" alt="<?php echo get_bloginfo('name'); ?>"> </a> <a class="navigation-trigger u-sp" id=navigation-trigger><i></i></a>
  <nav class="navigation u-sp" id=navigation role=navigation>
    <h5 class=navigation__head>ウェアの種類を選ぶ</h5>
    <ul class=navigation__wear-list>
      <li> <a href="/simulation/#item-swimwear" class=navigation-link>Swim Wear</a> </li>
      <li> <a href="/simulation/#item-teamwear" class=navigation-link>Team Wear</a> </li>
    </ul>
    <h5 class=navigation__head>保存したStyle</h5>
    <ul class=navigation-style__list>
    <?php foreach((array)$style_list as $key => $value): ?>
      <li class=active> <span class=navigation-style__head><?php echo $value['name']; ?></span>
        <p class=navigation-style__desc>
        <?php if($value['url']): ?>
          <a href="<?php echo $value['url']; ?>">
            <?php echo ($value['type'])? $value['type'] . ', ' : ''; ?>
            <?php echo ($value['code'])? $value['code'] . ', ' : ''; ?>
            <br>
            <?php echo ($value['info'])? $value['info'] : ''; ?>
          </a>
        <?php else: ?>- 未保存 -<?php endif; ?>
        </p>
        <?php if($value['url']): ?><a class="button button--remove">削除</a><?php endif; ?>
      </li>
    <?php endforeach; ?>
    </ul>
    <h5 class=navigation__head><?php echo $help->link_description; ?></h5> <a href="<?php echo $help->link_url; ?>" class="navigation-link navigation-link--help" target="_blank"><?php echo $help->link_name; ?></a>
  </nav>
  <div class=header__menu>
    <div class="header-style js-style-list">
      <p class=header-style__title>Style:</p>
      <ul class="clear header-style__list">
      <?php foreach((array)$style_list as $key => $value): ?>
        <li data-number="<?php echo $key+1; ?>"><a href="<?php echo ($value['url'])? $value['url'] : 'javascript:void(0);'; ?>" class="<?php if($value['url']): ?>registered<?php endif; ?> <?php if($value['active']): ?>active<?php endif; ?>"><?php echo $value['name']; ?></a><i class="icon icon--style-close"></i></li>
      <?php endforeach; ?>
      </ul>
    </div>
    <a href="<?php echo $help->link_url; ?>" target="_blank">・<?php echo $help->link_name; ?></a>
    <a href="javascript:void(0);" class="js-popup-trigger" data-popup=".popup--system-requirements">・動作環境</a>
  </div>
