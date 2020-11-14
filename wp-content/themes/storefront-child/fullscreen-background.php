<?php
/**
 * Template name: Fullscreen Background
 *
 * This template sets the selected featured image as fullscreen background, and
 * centers the content both horizontally and vertically.
 */

wp_head(); ?>

  <div id="primary" class="content-area fullscreen" style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);">
    <main id="main" class="site-main" role="main">
      <?php
        while (have_posts()):
          the_post();
          get_template_part( 'content', 'page' );
        endwhile;
      ?>
    </main><!-- #main -->
  </div><!-- #primary -->
<?php
