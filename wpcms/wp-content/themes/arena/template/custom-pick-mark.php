<?php 
  $mark = get_query_var('mark');
  $positions = $mark['positions'];
  $is_mark = (isset($_GET['pos']) && $_GET['pos'] && is_array($positions))? true : false ;
?>
                <ul class="custom-pick__mark clear js-mark-pick">
                  <li><?php if(is_array($positions)): ?><a class="<?php echo ($is_mark)? 'active' : ''; ?>" data-mark="on" data-value=""><i class="icon icon--tick"></i>マークあり</a><?php endif; ?></li>
                  <li><a class="<?php echo ($is_mark)? '' : 'active'; ?>" data-mark="off" data-value=""><i class="icon icon--tick"></i>マークなし</a></li>
                </ul>
