<?php
/**
 * The page template file
 *
 * @package WordPress
 * @subpackage arena CUSTOM ORDER
 * @since 1.0
 * @version 1.0
 */


get_header(); 

if(have_posts()): 
  while(have_posts()): the_post(); 
    the_content();
  endwhile;
else:
  get_template_part('template/', 'none');
endif;

get_footer();

?>