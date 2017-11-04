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
    <div class="product-description-block">
      <div class="col-full">
        <div class="description-left">
          <h4>Description</h4>
          <?php
            global $post;
            the_content();
          ?>
        </div>
        <div class="description-right">
          <h4>SPEC</h4>
          <?php
            global $product;
            $attributes = array_filter($product->get_attributes(), 'wc_attributes_array_filter_visible');
            $attributes_num = count($attributes);
            $has_two_columns = ($attributes_num > 3);
            $column1_size = ($has_two_columns) ? ceil($attributes_num/2) :  $attributes_num;
            $attribute_iterator = 0;
          ?>
          <div class="attribute-column <?php echo ($has_two_columns) ? 'column-1':'';?>">
            <?php foreach ( $attributes as $attribute ): ?>
              <div>
                <strong class="attribute-name"><?php echo wc_attribute_label( $attribute->get_name() ); ?></strong>
                <span  class="attribute-content">
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
                $attribute_iterator++;
                if ($has_two_columns && $attribute_iterator == $column1_size) {
                  echo '</div><div class="attribute-column column-2">';
                }
              ?>
            <?php endforeach; ?>
          </div>
          <h4>USE&amp;CARE</h4>
          <?php
            if ($post->post_excerpt ) {
              echo '<div>';
              echo apply_filters( 'woocommerce_short_description', $post->post_excerpt );
              echo '</div>';
            }
          ?>
        </div>
      </div>
    </div>
  <?php
}

add_action( 'woocommerce_after_single_product_summary', 'single_product_reviews', 10);
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

//Move review rating hearts form "woocommerce_review_before_comment_meta" to "woocommerce_review_meta"
remove_action('woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating');
add_action('woocommerce_review_meta', 'woocommerce_review_display_rating', 20);

//remove product data tabs from single-product page.
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs');