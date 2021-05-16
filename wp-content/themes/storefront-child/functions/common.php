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
    header_cart_panel_title();
    $fragments['.header-cart-panel-title'] = ob_get_clean();

    ob_start();
    header_cart_link();
    $fragments['.header-cart-content'] = ob_get_clean();
    return $fragments;
  }
}

if (!function_exists('site_branding_svg')) {
  /**
   * Display site branding svg in header
   *
   * @return void
   */
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


if (!function_exists('header_handheld_menu_button')) {
  /**
   * Display handheld_menu_button in header
   *
   * @return void
   */
  function header_handheld_menu_button() {
    ?>
      <div id="header-menu-button" class="header-menu-button header-menu-toggle">
        <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/header_nav.svg"); ?>
      </div>
    <?php
  }
}

if (!function_exists('header_handheld_menu')) {
  /**
   * Display handheld_menu_button in header
   *
   * @return void
   */
  function header_handheld_menu() {
    ?>
      <div id="header-menu" class="header-menu">
        <div class="header-menu-header">
          <div id="header-menu-back" class="header-menu-back">
            <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/back_arrow_darkgreen.svg"); ?>
            BACK
          </div>
          <?php if (is_user_logged_in()) : ?>
            <div id="handheld-account-toggle" class="account-toggle">
              <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/account.svg"); ?>
            </div>
          <?php else: ?>
            <a class="handheld-sign-in" href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" title="<?php _e('Login / Register','woothemes'); ?>"><?php _e('Sign in','woothemes'); ?></a>
          <?php endif; ?>
          <div id="handheld-search-toggle" class="search-toggle">
            <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/search.svg"); ?>
          </div>
          <div class="header-menu-close header-menu-toggle">
            <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/close_icon.svg"); ?>
          </div>
        </div>
        <?php if (is_user_logged_in()) : ?>
          <div id="handheld-account-dropdown" class="account-dropdown">
            <div class="account-info">
              <?php
                $user = wp_get_current_user();
                echo '<div class="name">'.$user->display_name.'</b></div>';
              ?>
              <ul class="account-links">
                <li><a href="/my-account">Account Details</a></li>
                <li><a href="/my-account/orders">Orders</a></li>
                <li><a href="/my-account/payment-methods">Payment Methods</a></li>
                <li><a class="logout" href="<?php echo esc_url(wc_logout_url());?>"><b>Log out</b></a></li>
              </ul>
            </div>
          </div>
        <?php endif;?>
        <div id="handheld-search-bar" class="search-bar">
          <?php the_widget('WC_Widget_Product_Search', 'title='); ?>
        </div>
        <?php
          wp_nav_menu(array(
            'theme_location'  => 'handheld',
            'container_class' => 'handheld-navigation',
          ));
        ?>
      </div>
    <?php
  }
}

if (!function_exists('header_login')) {
  /**
   * Display Sign-in button in header
   *
   * @return void
   */
  function header_login() {
    ?>
    <div class="header-account">
      <?php if (is_user_logged_in()) : ?>
        <div id="header-account-toggle" class="account-toggle">
          <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/account.svg"); ?>
        </div>
        <div id="header-account-dropdown" class="account-dropdown">
          <div class="account-info">
            <?php
              $user = wp_get_current_user();
              echo '<div class="name">'.$user->display_name.'</b></div>';
            ?>
            <ul class="account-links">
              <li><a href="/my-account">Account Details</a></li>
              <li><a href="/my-account/orders">Orders</a></li>
              <li><a href="/my-account/payment-methods">Payment Methods</a></li>
              <li><a class="logout" href="<?php echo esc_url(wc_logout_url());?>"><b>Log out</b></a></li>
            </ul>
          </div>
        </div>
      <?php else : ?>
        <ul class="links">
          <li>
            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Sign in','woothemes'); ?>"><?php _e('Sign in','woothemes'); ?></a>
          </li>
          </ul>
      <?php endif;?>
    </div>
    <?php
  }
}

if (!function_exists('header_product_search')) {
  /**
   * Display header product search
   *
   * @return void
   */
  function header_product_search() {
    ?>
      <div class="site-search">
        <div id="header-search-toggle" class="search-toggle"><?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/search.svg"); ?></div>
        <div id="header-search-bar" class="search-bar">
          <?php the_widget('WC_Widget_Product_Search', 'title='); ?>
        </div>
      </div>
    <?php
  }
}

if (!function_exists('header_cart_link')) {
  /**
   * Displayed a link to the cart including the number of items present
   *
   * @return void
   */
  function header_cart_link() {
    ?>
      <div class="header-cart-content cart-contents" title="<?php esc_attr_e('View your shopping cart', 'storefront' ); ?>">
        <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/shopping_bag.svg"); ?>
        <?php if (WC()->cart->get_cart_contents_count() > 0) : ?>
          <div class="hinter"></div>
        <?php endif; ?>
        <span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span> <span class="count"><?php echo wp_kses_data(sprintf(WC()->cart->get_cart_contents_count())); ?></span>
      </div>
    <?php
  }
}

if (!function_exists('header_cart_panel_title')) {
  function header_cart_panel_title() {
    ?>
    <div class="header-cart-panel-title">
      <?php if (!WC()->cart->is_empty()) : ?>
        Shopping Bag (<?php echo WC()->cart->get_cart_contents_count();?>)
      <?php else:?>
        No Items in Shopping Bag
      <?php endif; ?>
    </div>
    <?php
  }
}

if (!function_exists('header_cart')) {
  /**
   * Display header Cart component
   *
   * @return void
   */
  function header_cart() {
    ?>
    <div id="header-cart" class="header-cart">
      <?php if (apply_filters('woocommerce_widget_cart_is_hidden', is_cart() || is_checkout())) : ?>
        <a class="cart-content-wrap"  href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'storefront'); ?>">
          <?php header_cart_link(); ?>
        </a>
      <?php else: ?>
        <div class="cart-content-wrap header-cart-toggle">
          <?php header_cart_link(); ?>
        </div>
        <div id="header-cart-overlay" class="header-cart-overlay header-cart-toggle">
        </div>
        <div id="header-cart-panel" class="header-cart-panel">
          <div class="header-cart-close header-cart-toggle">
            <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/close_icon.svg"); ?>
          </div>
          <?php header_cart_panel_title(); ?>
          <?php //the_widget('WC_Widget_Cart', 'title='); ?>
          <?php if (!WC()->cart->is_empty()) : ?>
            <div class="widget woocommerce widget_shopping_cart">
              <div class="widget_shopping_cart_header">
                <div class="item">Item</div>
                <div class="price">Total Price</div>
              </div>
              <?php
                # Insert cart widget placeholder - code in woocommerce.js will update this on page load
                echo '<div class="widget_shopping_cart_content"></div>';
              ?>
            </div>
          <?php endif;?>
        </div>
      <?php endif;?>
    </div>
    <?php
  }
}

if (!function_exists('header_tablet_bar')) {
  function header_tablet_bar() {
    ?>
    <div class="header-tablet-bar">
      <div class="wrap">
        <div class="site-search">
          <div id="tablet-search-toggle" class="search-toggle"><?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/search.svg"); ?></div>
          <div id="tablet-search-bar" class="search-bar">
            <?php the_widget('WC_Widget_Product_Search', 'title='); ?>
          </div>
        </div>
        <div class="header-account">
          <?php if (is_user_logged_in()) : ?>
            <div id="tablet-account-toggle" class="account-toggle">
              <?php echo file_get_contents(get_stylesheet_directory()."/assets/svg/account.svg"); ?>
            </div>
            <div id="tablet-account-dropdown" class="account-dropdown">
              <div class="account-info">
                <?php
                  $user = wp_get_current_user();
                  echo '<div class="name">'.$user->display_name.'</b></div>';
                ?>
                <ul class="account-links">
                  <li><a href="/my-account">Account Details</a></li>
                  <li><a href="/my-account/orders">Orders</a></li>
                  <li><a href="/my-account/payment-methods">Payment Methods</a></li>
                  <li><a class="logout" href="<?php echo esc_url(wc_logout_url());?>"><b>Log out</b></a></li>
                </ul>
              </div>
            </div>
          <?php else : ?>
            <ul class="links">
              <li>
                <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Sign in','woothemes'); ?>"><?php _e('Sign in','woothemes'); ?></a>
              </li>
              </ul>
          <?php endif;?>
        </div>
      </div>
    </div>
    <?php
  }
}

if (!function_exists('init_header')) {
  # Initialize header rendering
  function init_header() {
    # Remove unneeded components
    remove_action('storefront_header', 'storefront_site_branding', 20);
    remove_action('storefront_header', 'storefront_product_search', 40);
    remove_action('storefront_header', 'storefront_header_cart', 60);

    # Add site header components
    add_action('storefront_header', 'header_tablet_bar', -1);
    add_action('storefront_header', 'header_handheld_menu_button', 10);
    add_action('storefront_header', 'header_handheld_menu', 15);
    add_action('storefront_header', 'site_branding_svg', 20);
    add_action('storefront_header', 'header_cart', 70);
    add_action('storefront_header', 'header_product_search', 80);
    add_action('storefront_header', 'header_login', 90);
  }
}
add_action('init', 'init_header', 10);

function remove_storefront_handheld_footer_bar() {
  remove_action('storefront_footer', 'storefront_handheld_footer_bar', 999);
}
add_action('init', 'remove_storefront_handheld_footer_bar');

function remove_breadcrumbs() {
  remove_action('storefront_before_content', 'woocommerce_breadcrumb', 10);
}
add_action('init', 'remove_breadcrumbs');

function remove_page_header() {
  remove_action('storefront_page', 'storefront_page_header', 10);
}
add_action('init', 'remove_page_header');

function remove_customizer_css() {
  add_filter('storefront_customizer_css', '__return_false');
  add_filter('storefront_customizer_woocommerce_css', '__return_false');
  add_filter('storefront_gutenberg_customizer_css', '__return_false');
}
add_action('init', 'remove_customizer_css');

function remove_sorting() {
  remove_action('woocommerce_after_shop_loop', 'storefront_sorting_wrapper', 9); //.storefront-sorting opening after products loop
  remove_action('woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10);
  remove_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 20);
  remove_action('woocommerce_after_shop_loop', 'storefront_sorting_wrapper_close', 31); //.storefront-sorting closing after products loop
}
add_action('after_setup_theme', 'remove_sorting');

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

//Remove breadcrumb
remove_action('storefront_before_content', 'woocommerce_breadcrumb', 10);

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
add_filter('woocommerce_cross_sells_total', 'change_cross_sells_product_no');
function change_cross_sells_product_no($columns) {
  return 4;
}

add_action('woocommerce_before_shop_loop_item_title', 'my_show_brands_in_loop');
if (!function_exists('my_show_brands_in_loop')) {
  function my_show_brands_in_loop() {
    global $product;
    $product_id = $product->get_id();
    $product_brands =  wp_get_post_terms($product_id, 'pwb-brand');
    if (!empty($product_brands)) {
      echo '<div class="brands-in-loop">';
      foreach ($product_brands as $brand) {
        echo '<span>';
        $url = get_permalink($product_id);
        echo '<a href="'.$url.'">'.$brand->name.'</a>';
        echo '</span>';
      }
      echo '</div>';
    }
  }
}

function adjust_checkout_fields($fields) {
  $fields['first_name']['class'] = ['form-row-wide'];
  $fields['last_name']['class'] = ['form-row-wide'];
  unset($fields['company']);
  return $fields;
}
add_filter('woocommerce_default_address_fields', 'adjust_checkout_fields');

function adjust_checkout_phone_email_fields($fields) {
  $fields['billing_phone']['class'] = ['form-row-wide'];
  $fields['billing_email']['class'] = ['form-row-wide'];
  return $fields;
}
add_filter('woocommerce_billing_fields', 'adjust_checkout_phone_email_fields');

// move payment method block from the right column to the bottom of the left column
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
add_action('woocommerce_after_order_notes', 'woocommerce_checkout_payment', 20);

remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);

remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10);
add_action('woocommerce_checkout_before_order_review', 'woocommerce_checkout_login_form', 10);

add_filter('woocommerce_account_menu_items', 'remove_my_account_links');
function remove_my_account_links($menu_links) {
  unset($menu_links['edit-address']); // Addresses
  unset($menu_links['downloads']); // Downloads
  unset($menu_links['edit-account']); // Account details
  unset($menu_links['customer-logout']); // Logout
  $menu_links['dashboard'] = __('Account Details', 'woocommerce'); // Reset 'Dashboard' to 'Account Details'
  return $menu_links;
}

# Change 'View' to 'View Details' in /my-account/orders
function change_my_acccount_orders_action_name($actions, $order) {
  $actions['view']['name'] = __('View Details', 'woocommerce');
  return $actions;
}
add_filter('woocommerce_my_account_my_orders_actions', 'change_my_acccount_orders_action_name', 10, 2);

/**
 * Override woocommerce_account_content() in /woocommerce/includes/wc-template-functions.php
 */
function woocommerce_account_content() {
  global $wp;

  if (!empty($wp->query_vars)) {
    foreach ($wp->query_vars as $key => $value) {
      // Ignore pagename param.
      if ('pagename' === $key) {
        continue;
      }

      if (has_action( 'woocommerce_account_' . $key . '_endpoint')) {
        do_action('woocommerce_account_' . $key . '_endpoint', $value);
        return;
      }
    }
  }
  // No endpoint found? Default to dashboard.

  // Enqueue scripts
  wp_enqueue_script('wc-country-select');
  wp_enqueue_script('wc-address-i18n');

  $address_types = ['billing', 'shipping'];

  foreach ($address_types as $load_address) {
    $load_address = sanitize_key($load_address);

    $address = WC()->countries->get_address_fields(get_user_meta(get_current_user_id(), $load_address . '_country', true), $load_address . '_');

    // Prepare values
    foreach ($address as $key => $field) {

      $value = get_user_meta( get_current_user_id(), $key, true);

      if (!$value) {
        switch ($key) {
          case 'billing_email' :
          case 'shipping_email' :
            $value = $current_user->user_email;
          break;
          case 'billing_country' :
          case 'shipping_country' :
            $value = WC()->countries->get_base_country();
          break;
          case 'billing_state' :
          case 'shipping_state' :
            $value = WC()->countries->get_base_state();
          break;
        }
      }

      $address[$key]['value'] = apply_filters('woocommerce_my_account_edit_address_field_value', $value, $key, $load_address);
    }
    $addresses[$load_address] = apply_filters('woocommerce_address_to_edit', $address, $load_address);
  }

  wc_get_template('myaccount/dashboard.php', array(
    'current_user' => get_user_by('id', get_current_user_id()),
    'addresses' => $addresses,
  ));
}

function redirect_after_customer_save_address() {
  wp_safe_redirect(wc_get_page_permalink('myaccount'));
  exit;
}
add_action('woocommerce_customer_save_address', 'redirect_after_customer_save_address', 5);

//load customized js
function custom_scripts() {
  wp_enqueue_script('custom', get_stylesheet_directory_uri().'/js/custom.js', array('jquery'), 1.0, true);
  wp_enqueue_script('slick', get_stylesheet_directory_uri().'/js/slick.min.js', array('jquery'), 1.6, true);
  wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js', [], false, true);
  wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', [], false, 'all');
}
add_action('wp_enqueue_scripts', 'custom_scripts', 5);

//[brands_list] sortcode. It is a copy of pwb-all-brands short code from perfect-woocommerce-brands
function brands_list_func($atts) {

  $atts = shortcode_atts([
    'per_page'       => "100",
    'image_size'     => "thumbnail",
    'hide_empty'     => false,
    'order_by'       => 'name',
    'order'          => 'ASC',
    'title_position' => 'before'
  ], $atts, 'brands-list');

  $hide_empty = ($atts['hide_empty'] != 'true') ? false : true;

  ob_start();

  $brands = array();
  if ($atts['order_by'] == 'rand') {
    $brands = \Perfect_Woocommerce_Brands\Perfect_Woocommerce_Brands::get_brands($hide_empty);
    shuffle($brands);
  }else{
    $brands = \Perfect_Woocommerce_Brands\Perfect_Woocommerce_Brands::get_brands($hide_empty, $atts['order_by'], $atts['order']);
  }

  ?>
  <div class="brands-list-block">
    <div class="row">
      <?php
        foreach($brands as $brand) {
          $brand_id = $brand->term_id;
          //echo $brand->slug;
          $brand_name = $brand->name;
          //$brand_link = get_term_link($brand_id);
          $brand_link = get_permalink(get_page_by_path($brand_name));


          $attachment_id = get_term_meta($brand_id, 'pwb_brand_image', 1);
          $attachment_html = $brand_name;
          if ($attachment_id != '') {
            $attachment_html = wp_get_attachment_image($attachment_id, $image_size);
          }

          ?>
          <div class="brands-list-col">
            <div>
              <a href="<?php echo $brand_link;?>" title="<?php echo $brand_name;?>"><?php echo $attachment_html;?></a>
            </div>
            <h4>
              <a href="<?php echo $brand_link;?>"><?php echo $brand_name;?></a>
            </h4>
          </div>
          <?php
        }
      ?>
      </div>
    </div>
  <?php

  return ob_get_clean();
}
add_shortcode('brands_list', 'brands_list_func');


/**
 * sticky add-to-cart in single product page
 * copy from /wp-content/themes/storefront/inc/woocommerce/storefront-woocommerce-template-functions.php
**/
function storefront_sticky_single_add_to_cart() {
  global $product;

  if ( class_exists( 'Storefront_Sticky_Add_to_Cart' ) || true !== get_theme_mod( 'storefront_sticky_add_to_cart' ) ) {
    return;
  }

  if ( ! is_product() ) {
    return;
  }

  $params = apply_filters( 'storefront_sticky_add_to_cart_params', array(
    'trigger_class' => 'entry-summary'
  ) );

  wp_localize_script( 'storefront-sticky-add-to-cart', 'storefront_sticky_add_to_cart_params', $params );

  wp_enqueue_script( 'storefront-sticky-add-to-cart' );
  ?>
    <section class="storefront-sticky-add-to-cart">
      <div class="col-full">
        <div class="storefront-sticky-add-to-cart__content">
          <div class="storefront-sticky-add-to-cart__content-product-info">
            <span class="storefront-sticky-add-to-cart__content-title h2"><?php the_title(); ?></span>
            <span class="storefront-sticky-add-to-cart__content-price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
          </div>
          <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="storefront-sticky-add-to-cart__content-button button alt btn-arrow">
            <?php echo esc_attr( $product->add_to_cart_text() ); ?>
          </a>
        </div>
      </div>
    </section><!-- .storefront-sticky-add-to-cart -->
  <?php
}