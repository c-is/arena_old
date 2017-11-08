<?php
  $init_col = 'WHT';
  if(isset($_GET['col']) && $_GET['col']):
    $init_col = esc_js($_GET['col']);
  endif;
  $mark = get_query_var('mark');
  $colors = $mark['colors'];
?>
                <h4 class="custom-pick__title is-border">マークの色</h4>
                <div class="colour-section">
                  <ul class="custom-pick__colours js-colour js-colour--mark" data-cate="col" data-target="#position-n">
                  <?php foreach((array)$colors as $key => $value): $code = $value->description; ?>
                    <li class="colour--<?php echo mb_strtolower($code); ?> <?php echo ($code == $init_col)? 'active' : ''; ?>" data-colour="#<?php echo $value->slug; ?>" data-code="<?php echo $code; ?>" style="background-color:#<?php echo $value->slug; ?>"></li>
                  <?php endforeach; ?>
                  </ul>
                </div>
