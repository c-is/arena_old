<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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