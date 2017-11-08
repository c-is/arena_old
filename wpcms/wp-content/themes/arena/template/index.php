<?php
/**
 * Template part for index.php
 *
 * @package WordPress
 * @subpackage arena CUSTOM ORDER
 * @since 1.0
 * @version 1.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <h2><?php the_title(); ?></h2>
  <?php the_content(); ?>
</article>
