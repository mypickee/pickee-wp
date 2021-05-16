<?php /* Template Name: Fullwidth Page */
/**
 * The template fullwidth pages
 *
 * This template includes fullwidth-header.php, which has no breadcrumbs.
 * and doesn't have a div.col-full wrapper for content.
 */

get_header('fullwidth'); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main fullwidth-page" role="main">

      <?php while ( have_posts() ) : the_post();

        do_action( 'storefront_page_before' );
        remove_action('storefront_page', 'storefront_page_header');

        get_template_part( 'content', 'page' );

        /**
         * Functions hooked in to storefront_page_after action
         *
         * @hooked storefront_display_comments - 10
         */
        do_action( 'storefront_page_after' );

      endwhile; // End of the loop. ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php
do_action( 'storefront_sidebar' );
get_footer();

