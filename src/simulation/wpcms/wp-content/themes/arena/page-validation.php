<?php
  
  $array = null;
  
  if( isset( $_GET['json'] ) ||  $_GET['json'] == true || isset($_GET['callback']) ):
    
    if(isset($_GET['lang']) && isset($_GET['max']) && isset($_GET['text'])):
      
      $lang = ($_GET['lang'])? esc_js($_GET['lang']) : null;
      $max = ($_GET['max'])? esc_js($_GET['max']) : null;
      $text = ($_GET['text'])? esc_js($_GET['text']) : null;
      
      if(!$lang || !$max || !$text):
        $array['validate'] = false;
        $array['message'] = $max . 'マークの情報が不足しています';
      elseif($lang == 'en'):
        if(ctype_alnum($text)):
          $count = mb_strlen($text);
          if($count > $max):
            $array['validate'] = false;
            $array['message'] = $max . '文字以下で入力してください';
            $array['count'] = $count;
          else:
            $array['validate'] = true;
          endif;
        else:
          $array['validate'] = false;
          $array['message'] = '半角英数字で入力してください';
        endif;
      elseif($lang == 'em'):
        $count = mb_strlen($text);
        if($count > $max):
          $array['validate'] = false;
          $array['message'] = $max . '文字以下で入力してください';
          $array['count'] = $count;
        else:
          $array['validate'] = true;
        endif;
      else:
        $array['validate'] = false;
        $array['message'] = 'マークの情報の指定が不正です。';
      endif;
    else:
      $array['validate'] = false;
      $array['message'] = $max . 'マークの情報が不足しています';
    endif;
    
    $json = json_encode( $array ) ;
    
    if( isset( $_GET['callback'] ) ):
      header( "Content-Type: text/javascript; charset=utf-8" );
      echo $_GET['callback'] . "(" . $json . ")";
    else:
      header( "Content-Type: application/json; charset=utf-8" );
      echo $json;
    endif;
  
  else:
  
    get_header();
    
    get_footer();
    
  endif;
?>
