<?php

function register_meta_for_wp_rest_api() {
  
  $args_register_post_meta = array(
    'single' => true,
    'show_in_rest' => true,
  );
  
  $args_register_term_meta = array(
    'single' => true,
    'show_in_rest' => true,
  );
  
  register_meta('post', 'price', $args_register_post_meta);
  register_meta('post', 'svg', $args_register_post_meta);
  register_meta('post', 'codes', $args_register_post_meta);

  register_meta('term', 'reference', $args_register_term_meta);
  register_meta('term', 'position', $args_register_term_meta);
  
  register_meta('term', 'parts', array(
    'show_in_rest' => true,
  ));
  register_meta('term', 'parts_0_color', array(
    'show_in_rest' => true,
  ));
  register_meta('term', 'parts_1_color', array(
    'show_in_rest' => true,
  ));
  register_meta('term', 'parts_2_color', array(
    'show_in_rest' => true,
  ));
  register_meta('term', 'parts_3_color', array(
    'show_in_rest' => true,
  ));
  register_meta('term', 'parts_4_color', array(
    'show_in_rest' => true,
  ));
  
}
add_action('rest_api_init', 'register_meta_for_wp_rest_api', 10, 2);

function filter_post_json($response, $post, $request){
  $params = $request->get_params();
  $response->data['params'] = $params;
  if(isset($params['id']) && $params['id']):
    //GET /wp/v2/posts/<id>
  elseif(isset($params['slug']) && $params['slug']):
    //GET /wp/v2/posts?slug=post-url-slug
  endif;
  
  if($response->data):
    foreach((array)$response->data as $key => $value):
      if($response->data[$key]):
        switch($key):
          // Defaults Unset
          case 'date':
          case 'date_gmt':
          case 'guid':
          case 'modified':
          case 'modified_gmt':
          case 'type':
          case 'excerpt':
          case 'author':
          case 'comment_status':
          case 'ping_status':
          case 'format':
            unset($response->data[$key]);
            break;
          // Custom
          case 'featured_media':
            $attachment = wp_get_attachment_image_src($value);
            $response->data[$key] = ($attachment)? $attachment[0] : false;
            break;
          // Categories 
          case 'categories':
            $categories = array();
            foreach((array)$response->data[$key] as $id):
              $categories[] = get_category($id);
            endforeach;
            $response->data[$key] = $categories;
            break;
          // Tags 
          case 'tags':
            $tags = array();
            foreach((array)$response->data[$key] as $id):
              $tags[] = get_tag($id);
            endforeach;
            $response->data[$key] = $tags;
            break;
          // Size 
          case 'size':
            $terms = array();
            foreach((array)$response->data[$key] as $id):
              $object = get_term($id);
              $terms[] = $object->name;
            endforeach;
            $response->data[$key] = $terms;
            break;
          // terms 
          case 'material':
            $terms = array();
            foreach((array)$response->data[$key] as $id):
              $terms[] = get_term($id);
            endforeach;
            $response->data[$key] = $terms;
            break;
          case 'mark-position':
            $terms = array();
            foreach((array)$response->data[$key] as $id):
              $object = get_term($id);
              $meta = get_term_meta($object->term_id);
              $position = array(
                'name'=> $object->name, 
                'slug'=> $object->slug, 
                'description'=> $object->description, 
                'img' => wp_get_attachment_url((int)$meta['position'][0]),
                'max-en' => (isset($meta['en']) && $meta['en'])? $meta['en'][0] : '',
                'max-em' => (isset($meta['em']) && $meta['em'])? $meta['em'][0] : ''
              );
              $terms[] = $position;
            endforeach;
            $response->data[$key] = $terms;
            break;
          // Mark Font 
          case 'mark-font':
            $terms = array();
            foreach((array)$response->data[$key] as $id):
              $object = get_term($id);
              $meta = get_term_meta($object->term_id);
              $font = array(
                'name' => $object->name,
                'slug' => $object->slug,
                'description' => $object->description,
                'img' => wp_get_attachment_url((int)$meta['reference'][0])
              );
              $terms[] = $font;
            endforeach;
            $response->data[$key] = $terms;
            break;
          // Mark Color 
          case 'mark-color':
            $terms = array();
            foreach((array)$response->data[$key] as $id):
              $object = get_term($id);
              $color = array( $object->name, '#' . $object->slug);
              $terms[] = $color;
            endforeach;
            $response->data[$key] = $terms;
            break;
          case 'meta':
            foreach((array)$value as $meta => $field):
              switch($meta):
                case 'price':
                  $response->data[$key][$meta] = number_format((int)$field);
                  break;
                case 'svg':
                  $response->data[$key][$meta] = array(
                                                  'front' => get_field('svg-front', $post->ID),
                                                  'back' => get_field('svg-back', $post->ID)
                                                );
                  break;
                case 'codes':
                  $codes = array();
                  while(have_rows($meta, $post->ID)): the_row();
                    $name = get_sub_field('name');
                    while(have_rows('colors', $post->ID)): the_row();
                      if(!get_sub_field('label')) continue;
                      $codes[$name][] = array('label' => get_sub_field('label'), 'hex' => get_sub_field('hex'));
                    endwhile;
                  endwhile;
                  $response->data[$key][$meta] = $codes;
                  break;
                default:
                  break;
              endswitch;
            endforeach;
            break;
          default:
            break;
        endswitch;
      endif;
    endforeach;
  endif;
  
  return $response;
}
add_action('rest_prepare_post', 'filter_post_json', 10, 3);


function filter_taxonomy_json($response, $taxonomy, $request){
  return $response;
}
add_action('rest_prepare_taxonomy', 'filter_taxonomy_json', 10, 3);

function filter_term_json($response, $term, $request){
  return $response;
}
add_action('rest_prepare_term', 'filter_term_json', 10, 3);

// rest_pre_serve_request

?>