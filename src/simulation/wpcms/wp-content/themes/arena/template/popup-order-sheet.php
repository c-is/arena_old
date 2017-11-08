<?php
  $styles = get_query_var('styles');
  $keys = get_query_var('keys');
?>
            <p class="order-sheet__head">オーダーシート作成希望のStyleを選択してください。</p>
            <a class="popup-close js-popup-close"></a>
            <ul class="order-sheet__list js-order-sheet-list">
            <?php
              $i = 0;
              foreach((array)$styles as $key => $value): 
                $i++;
                $spec = ($value)? explode(',', rawurldecode($value)) : null;
                if(!is_array($spec)) continue;
                $txt = null;
                foreach((array)$spec as $colum => $data):
                  switch($keys[$colum]):
                    case 'style':
                      $txt .= strtoupper($data);
                      $item = get_page_by_path(mb_strtolower($data), "OBJECT", "post");
                      break;
                    case 'bcol':
                      $txt .= ', ' . strtoupper($data);
                      break;
                    case 'pos':
                      //$txt .= ($data) ? strtoupper($data) . ', ' : null;
                      break;
                    case 'font':
                      $term = get_term_by('slug', 'mrk' . $data, 'mark-font');
                      //$txt .= ($term)? $term->name . ', ' : null;
                      break;
                    case 'col':
                      $term = get_term_by('slug', $data, 'mark-color');
                      //$txt .= ($term)? $term->name . ', ' : null;
                      break;
                    case 'mark':
                      //$txt .= ($data)? rawurldecode($data) : null;
                      break;
                    default:
                      $txt .= null;
                      break;
                  endswitch;
                endforeach;
                $data = ($spec)? $key . '=' . rawurldecode($value) : null;
            ?>
              <li data-number="<?php echo $i; ?>" data-style="<?php echo $data; ?>">
                <div class="order-sheet__image">
                  <?php if(is_array($spec)): ?>
                  <iframe src="/simulation/item/?type=<?php echo $spec[0]; ?>&bcol=<?php echo $spec[1]; ?>" id="" name="" title="" width="58px" height="58px" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"></iframe>
                  <?php else: ?>
                  <img src="/simulation/assets/images/noimage-style-save.png" alt="ITEM">
                  <?php endif; ?>
                </div>
                <div class="order-sheet__text">
                  <strong class="order-sheet__title"><?php echo ucfirst($key); ?></strong>
                  <p class="order-sheet__desc">
                  <?php 
                    if(is_array($spec)):
                      echo $txt . '<br>' . "\n";
                      echo ($item)? wp_strip_all_tags($item->post_content) : '';
                    endif;
                  ?>
                  </p>
                  <?php if($value): ?><span class="order-sheet__pick js-order-sheet-pick"></span><?php endif; ?>
                </div>
              </li>
            <?php endforeach; ?>
            </ul>
            <div class="button-container u-text-center">
              <a class="button button--order-sheet js-order-link-make" href="" data-send="<?php echo add_query_arg(array('module' => 'Flash', 'action' => 'CreateStyle'), '//custom.arena-jp.com/order/') ?>">選択したStyleのオーダーシートを作る</a>
            </div>
