<?php
  $styles = get_query_var('styles');
  $keys = get_query_var('keys');

  $rand = $i = 1;
  foreach((array)$styles as $key => $value): 
    if(isset($_COOKIE[$key]) && $_COOKIE[$key] == 0):
      $rand = $i;
      break;
    endif;
    $i++;
  endforeach;

?>
              <a href="" class="button button--close js-order-info-close--sp u-sp u-tb"></a>
              <ul>
                <li><a class="order-info__link js-order-save" data-style="<?php echo $post->post_title; ?>">この内容で保存する</a></li>
                <li><a class="order-info__link js-order-sheet js-popup-trigger" data-popup=".popup--order-sheet">保存したStyleからオーダーシートを作る</a></li>
                <li><a class="order-info__link js-order-sheet-direct" href="https://custom.arena-jp.com/order/index.php?module=Flash&action=CreateStyle&style1=">この内容でオーダーシートを作る</a></li>
                <!--
                <li>
                  <a class="order-info__link js-modal" href="" data-modal=".modal--share">この組み合わせを仲間と共有する</a>
                  <div class="modal modal--share">
                    <a class="icon icon--line" href=""></a>
                    <a class="icon icon--twitter" href=""></a>
                  </div>
                </li>
                -->
              </ul>
