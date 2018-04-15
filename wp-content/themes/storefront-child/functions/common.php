<?php

if (!function_exists('storefront_cart_link_fragment')) {
  /**
   * Cart Fragments
   * Ensure topbar cart contents update when products are added to the cart via AJAX
   *
   * @param  array $fragments Fragments to refresh via AJAX.
   * @return array            Fragments to refresh via AJAX
   */
  function storefront_cart_link_fragment($fragments) {
    global $woocommerce;

    ob_start();
    storefront_cart_link();
    $fragments['a.cart-contents'] = ob_get_clean();

    ob_start();
    topbar_cart_panel_title();
    $fragments['.topbar-cart-panel-title'] = ob_get_clean();

    ob_start();
    topbar_cart_link();
    $fragments['.topbar-cart-content'] = ob_get_clean();
    return $fragments;
  }
}

if (!function_exists('topbar_cart_link')) {
  /**
   * Topbar Cart Link
   * Displayed a link to the cart including the number of items present
   *
   * @return void
   */
  function topbar_cart_link() {
    ?>
      <div class="topbar-cart-content cart-contents" title="<?php esc_attr_e('View your shopping cart', 'storefront' ); ?>">
        <span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span> <span class="count"><?php echo wp_kses_data(sprintf(WC()->cart->get_cart_contents_count())); ?></span>
      </div>
    <?php
  }
}

if (!function_exists('topbar_cart_panel_title')) {
  /**
   * Displayed a title of shopping cart including the number of items present
   *
   * @return void
   */
  function topbar_cart_panel_title() {
    ?>
      <div class="topbar-cart-panel-title">
        <?php if (!WC()->cart->is_empty()) : ?>
          <?php echo wp_kses_data(sprintf(_n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'storefront'), WC()->cart->get_cart_contents_count()));?> in Shopping Bag
        <?php else:?>
          No Items in Shopping Bag
        <?php endif; ?>
      </div>
    <?php
  }
}

if (!function_exists('topbar_cart')) {
  /**
   * Display topbar Cart
   *
   * @return void
   */
  function topbar_cart() {
    ?>
    <div id="topbar-cart" class="topbar-cart">
      <?php if (apply_filters('woocommerce_widget_cart_is_hidden', is_cart() || is_checkout())) : ?>
        <a class="cart-content-wrap"  href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'storefront'); ?>">
          <?php topbar_cart_link(); ?>
        </a>
      <?php else: ?>
        <div class="cart-content-wrap topbar-cart-toggle">
          <?php topbar_cart_link(); ?>
        </div>
        <div id="topbar-cart-overlay" class="topbar-cart-overlay topbar-cart-toggle">
        </div>
        <div id="topbar-cart-panel" class="topbar-cart-panel">
          <div class="topbar-cart-close topbar-cart-toggle">
            <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/close_icon.svg"); ?>
          </div>
          <?php topbar_cart_panel_title(); ?>
          <?php the_widget('WC_Widget_Cart', 'title='); ?>
        </div>
      <?php endif;?>
    </div>
    <?php
  }
}

if (!function_exists('topbar_product_search')) {
  /**
   * Display Product Search
   *
   * @return void
   */
  function topbar_product_search() {
    ?>
      <div class="site-search">
        <?php the_widget('WC_Widget_Product_Search', 'title='); ?>
        <div class="search-clear-btn hidden"><?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/close_icon.svg"); ?></div>
      </div>
    <?php
  }
}

if (!function_exists('topbar_handles_menu_button')) {
  /**
   * Display handles_menu_button in topbar
   *
   * @return void
   */
  function topbar_handles_menu_button() {
    ?>
      <div id="topbar-menu-button" class="topbar-menu-button topbar-menu-toggle">
        Menu
      </div>
    <?php
  }
}

if (!function_exists('topbar_handles_menu')) {
  /**
   * Display handles_menu_button in topbar
   *
   * @return void
   */
  function topbar_handles_menu() {
    ?>
      <div id="topbar-menu" class="topbar-menu">
        <div class="topbar-menu-back">
          BACK
        </div>
        <div class="topbar-menu-close topbar-menu-toggle">
          <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/close_icon.svg"); ?>
        </div>
        <div class="topbar-menu-header">
        </div>
        <?php
          wp_nav_menu(array(
            'theme_location'  => 'handheld',
            'container_class' => 'handheld-navigation',
          ));
        ?>
        <div class="topbar-menu-footer">
          <?php if (is_user_logged_in()) : ?>
            <?php
              $user = wp_get_current_user();
              echo '<span><b>Hi, '.$user->display_name.'</b></span>|';
            ?>
            <span><a href="<?php echo wp_logout_url(get_permalink(woocommerce_get_page_id('myaccount')));?>">Sign Out</a><span>|
            <span><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a></span>
          <?php else : ?>
            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a>
          <?php endif;?>
        </div>
      </div>
    <?php
  }
}

if (!function_exists('topbar')) {
  /**
   * Display topbar
   *
   * @return void
   */
  function topbar() {
    ?>
    <div id="topbar" class="topbar">
      <?php topbar_handles_menu_button();?>
      <?php topbar_handles_menu();?>
      <?php topbar_cart();?>
      <?php topbar_product_search();?>
      <ul class="links">
        <?php if (is_user_logged_in()) : ?>
          <li>
            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a>
          </li>
          <li><a href="<?php echo wp_logout_url(get_permalink(woocommerce_get_page_id('myaccount')));?>">Sign Out</a></li>
          <?php
            $user = wp_get_current_user();
            echo "<li><b>Hi, ". $user->display_name ."</b></li>";
          ?>
        <?php else : ?>
          <li>
            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Login / Register','woothemes'); ?></a>
          </li>
        <?php endif;?>
      </ul>
    </div>
    <?php
  }
}

if (!function_exists('site_branding_svg')) {
  //display site branding svg
  function site_branding_svg() {
    ?>
    <div class="site-branding">
      <a href="<?php echo esc_url(home_url('/'));?>">
        <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/pickee_logo.svg"); ?>
      </a>
    </div>
    <?php
  }
}

if (!function_exists('init_header')) {
  //Initialize header rendering
  function init_header() {
    remove_action('storefront_header', 'storefront_site_branding', 20);
    remove_action('storefront_header', 'storefront_product_search', 40);
    remove_action('storefront_header', 'storefront_header_cart', 60);
    //Add topbar before header
    add_action('storefront_before_header', 'topbar', 20);
    //Add site branding svg
    add_action('storefront_header', 'site_branding_svg', 20);
  }
}
//Initialize header rendering
add_action('init', 'init_header', 10);

function init_homepage() {
  if (is_front_page()) {
    remove_action('storefront_page', 'storefront_page_header', 10);
  }
}
//Initialize homepage rendering
add_action('wp', 'init_homepage', 10);

# Remove button which link to check out page directly in mini-cart
remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20);

# Change display text of button form 'view cart' to 'Check Out' which link to cart page in mini-cart
function woocommerce_widget_shopping_cart_button_view_cart() {
  echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward">' . esc_html__( 'Check Out', 'woocommerce' ) . '</a>';
}

//Variable product title should not include variance attributes.
add_filter('woocommerce_product_variation_title_include_attributes', 'product_variation_title_should_not_include_attributes');
function product_variation_title_should_not_include_attributes() {
  return false;
}

//Remove "Add to cart" button from product loop
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

//Remove rating from product loop
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

//Remove sale tag flash from product loop
add_filter('woocommerce_sale_flash', 'woocommerce_custom_hide_sales_flash');
function woocommerce_custom_hide_sales_flash()
{
  return false;
}

//Change number of products per row to 4
add_filter('storefront_loop_columns', function() { return 4; });

// Remove Cross Sells From Default Position
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

// Add them back UNDER the Cart Table
add_action('woocommerce_after_cart_table', 'woocommerce_cross_sell_display');

// Set cross-sells columns to 4
add_filter('woocommerce_cross_sells_columns', 'change_cross_sells_columns');
function change_cross_sells_columns($columns) {
  return 4;
}

// Display 4 cross-sell products in cart
add_filter( 'woocommerce_cross_sells_total', 'change_cross_sells_product_no');
function change_cross_sells_product_no($columns) {
  return 4;
}

//load customized js
function custom_scripts() {
  wp_enqueue_script('custom', get_stylesheet_directory_uri().'/js/custom.js', array('jquery'), 1.0, true);
  wp_enqueue_script('slick', get_stylesheet_directory_uri().'/js/slick.min.js', array('jquery'), 1.6, true);
  wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', [], false, true);
  wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', [], false, 'all');
}
add_action('wp_enqueue_scripts', 'custom_scripts', 5);