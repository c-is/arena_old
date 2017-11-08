<?php
  $init_mark = null;
  if(isset($_GET['mark']) && $_GET['mark']):
    $init_mark = esc_js($_GET['mark']);
  endif;
?>
                <h4 class="custom-pick__title is-border">マークの名前</h4>
                <form class="custom-pick__input" data-cate="text">
                  <input class="js-mark-text" type="text" name="text-mark" placeholder="入力する" value="<?php echo ($init_mark)? $init_mark : ''; ?>">
                  <input class="js-mark-submit js-mark-popup-trigger" data-popup=".popup--mark-check" type="submit" name="" value="マークを確認する">
                  <div class="form-message"></div>
                </form>
