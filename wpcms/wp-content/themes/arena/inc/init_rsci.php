<?php 

/**
 * Really Simple CSV Importer Save Post
 *
 */
function rsci_post_filter($post, $is_update){
  return $post;
}
add_filter('really_simple_csv_importer_save_post', 'rsci_post_filter', 10, 2);



/**
 * Really Simple CSV Importer Save META
 *
 */
function rsci_meta_filter($meta, $post, $is_update){
  /*
  echo '<pre>';
  print_r($meta);
  echo '</pre>';
  */
  $meta_array = array();
  /**
   * CSV file : import-posts.csv
   * ACF key  : 'price' => field_587f8d77a114d
   *
   * META情報が「price」から始まるCSVの場合
   * 
   * 
   */
  if(isset($meta['price']) && $meta['price']):
    foreach($meta as $key => $value):
      if($key == 'page-attributes'):
        
      elseif($key == 'price'):
        $meta_array['field_587f8d77a114d'] = $value;
      elseif($key == 'select'):
        //$meta_array['field_xxxxxxxxxxxxx'] = preg_split(&quot; /, + / &quot;, $value);
      else:
        $meta_array[$key] = $value;
      endif;
    endforeach;
  endif;
  /**
   * CSV file : import-color-code.csv
   * ACF key  : 'codes' => field_587f8dbfa114e
   *
   * META情報が「code1」から始まるCSVの場合は、codeX と codeX-color の繰り返し
   * 
   * 
   */
  if(isset($meta['code1']) && $meta['code1']):
    $acf_codes_array = array();
    $i = 0;
    foreach($meta as $key => $value):
      if(!$value) continue;
      if($i == 0 || $i%2 == 0):
        $acf_codes_array[$i]['name'] = $value;
      else:
        $txt = explode(',', $value);
        foreach($txt as $n => $data):
          if(!$data) continue;
          if($n == 0 || $n%2 == 0):
              $acf_codes_array[$i-1]['colors'][$n]['label'] = $data;
            else:
              $acf_codes_array[$i-1]['colors'][$n-1]['hex'] = $data;
            endif;
        endforeach;
      endif;
      $i++;
    endforeach;
    if($acf_codes_array) $meta_array['field_587f8dbfa114e'] = $acf_codes_array;
  endif;
  /*
  echo '<pre>';
  print_r($meta_array);
  echo '</pre>';
  */
  return $meta_array;
}
add_filter('really_simple_csv_importer_save_meta', 'rsci_meta_filter', 10, 3); 



/**
 * Really Simple CSV Importer Save Taxonomy
 *
 */
function rsci_taxonomy_filter($tax, $post, $is_update){
  return $tax;
}
add_filter('really_simple_csv_importer_save_tax', 'rsci_taxonomy_filter', 10, 3);



/**
 * Really Simple CSV Importer Save Post Thumbnail
 *
 */
function rsci_thumbnail_filter($post_thumbnail, $post, $is_update){
  return $post_thumbnail;
}
add_filter('really_simple_csv_importer_save_thumbnail', 'rsci_thumbnail_filter', 10, 3);





?>