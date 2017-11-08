<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package WordPress
 * @subpackage arena CUSTOM ORDER
 * @since 1.0
 * @version 1.0
 */

?>

  <footer class="footer clear" role=contentinfo>
    <?php get_template_part( 'template/footer', '' ); ?>
  </footer><!-- .footer -->

<?php wp_footer(); ?>

<!-- Google Analytics -->
<script type="text/javascript">
  var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
  document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
  var pageTracker = _gat._getTracker("UA-978227-52");
  pageTracker._initData();
  pageTracker._trackPageview();
</script>

</body>
</html>
