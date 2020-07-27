<?php

//Set thumbnail column number to 1 in single-product page.
add_filter('storefront_product_thumbnail_columns', 'custom_storefront_product_thumbnail_columns');
function custom_storefront_product_thumbnail_columns() {
  return 1;
}

//Hide stock information in the single-product page.
add_filter('woocommerce_get_stock_html', '__return_empty_string');

//Hide the product's weight and dimension in the single-product page.
add_filter('wc_product_enable_dimensions_display', '__return_false');

//Remove short description from it's default position in single-product page.
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

/**
  * The product description block (the blue section)
 */
add_action( 'woocommerce_after_single_product_summary', 'single_product_discription', 5);
function single_product_discription()
{
  ?>
    <div class="product-description-block clearfix">
      <div class="col-full">
        <div class="description-left">
          <h4>Description</h4>
          <?php
            global $post;
            the_content();
          ?>
        </div>
        <div class="description-right">
          <?php
            global $product;
            $attributes = array_filter($product->get_attributes(), 'wc_attributes_array_filter_visible');
          ?>
          <?php if ($attributes) : ?>
          <h4>Spec</h4>
          <div class="attribute-list">
            <!-- <?php $attributes_count = 1;?>
            <div class="row clearfix"> -->
              <?php foreach ($attributes as $attribute) : ?>
                <div class="attribute-item <?php // if (count($attributes) === 1) {echo 'full-width';}?>">
                  <span class="attribute-name"><?php echo wc_attribute_label( $attribute->get_name() ); ?></span>
                  <span class="attribute-content">
                    <?php
                      $values = $attribute->get_options();
                      foreach ( $values as &$value ) {
                        $value = make_clickable( esc_html( $value ) );
                      }
                      echo apply_filters('woocommerce_attribute', wptexturize(implode(', ', $values)), $attribute, $values);
                    ?>
                  </span>
                </div>
                <?php
                  /* if ($attributes_count % 2 === 0) {
                    echo '</div><div class="row clearfix">';
                  }
                  $attributes_count++;
                  */
                ?>
              <?php endforeach; ?>
            <!-- </div> -->
          </div>
          <?php endif;?>
          <?php if ($post->post_excerpt) : ?>
            <h4>Use&amp;Care</h4>
            <div>
              <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt); ?>
            </div>
          <?php endif;?>
        </div>
      </div>
    </div>
  <?php
}
/*
 * Hide product review block in single product page temporarily
 */
# add_action( 'woocommerce_after_single_product_summary', 'single_product_reviews', 10);

/*
 * Reference to woocommerc/templates/single-product-reviews
 */
function single_product_reviews()
{
  ?>
    <div class="product-review">
      <?php
        comments_template();
      ?>
    </div>
  <?php
}

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

// Move review rating hearts form "woocommerce_review_before_comment_meta" to "woocommerce_review_meta"
remove_action('woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating');
add_action('woocommerce_review_meta', 'woocommerce_review_display_rating', 20);

// Remove product data tabs from single-product page.
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs');

//Change related products number to 4
add_filter('woocommerce_output_related_products_args', 'related_products_args', 20);
function related_products_args($args) {
  $args['posts_per_page'] = 4;
  $args['columns'] = 4;
  return $args;
}

//Change upsells products number to 4
add_filter('woocommerce_upsell_display_args', 'upsells_args', 20);
function upsells_args($args) {
  $args['posts_per_page'] = 4;
  $args['columns'] = 4;
  return $args;
}