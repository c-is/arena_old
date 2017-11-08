<?php

$term_slug = array();
$categories = get_the_terms($post->ID, 'category');
foreach((array)$categories as $key => $value):
  $term_slug['categories'] = $value->slug;
endforeach;
$tags = get_the_terms($post->ID, 'post_tag');
foreach((array)$tags as $key => $value):
  $term_slug['tags'] = $value->slug;
endforeach;

$arg = array (
  'posts_per_page' => -1,
  'post_status' => 'publish',
  'post_type' => 'post',
  'tax_query' => array(
      'relation' => 'AND',
      array(
          'taxonomy' => 'category',
          'field' => 'slug',
          'terms' => $term_slug['categories'],
          'operator' => 'IN'
      ),
      array(
          'taxonomy' => 'post_tag',
          'field' => 'slug',
          'terms' => $term_slug['tags'],
          'operator' => 'IN'
      )
  )
);

?>
                <h4 class="custom-pick__title">TYPE</h4>
                <ul class="custom-pick__list js-wear-type clear">
                <?php 
                  foreach((array)$terms = get_posts($arg) as $key => $post):
                    setup_postdata($post);
                ?>
                  <li>
                    <a href="<?php echo get_permalink(); ?>" id="post_thumbnail_<?php the_ID(); ?>" class="<?php echo ($wp_query->post->ID == $post->ID)? 'active' : ''; ?>" data-svg="<?php echo $post->post_title; ?>">
                    <?php 
                      if(has_post_thumbnail($post->ID)):
                        echo get_the_post_thumbnail();
                      else:
                        echo '<img src="/simulation/assets/images/customisation/custom-none.png" alt="top">';
                      endif; 
                    ?>
                    </a>
                  </li>
                <?php 
                  endforeach; 
                  wp_reset_postdata();
                ?>
                </ul>
