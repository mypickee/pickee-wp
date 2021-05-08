<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>
<div class="col-full">
  <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php do_action( 'woocommerce_before_cart_table' ); ?>

    <div class="cart woocommerce-cart-form__contents">
      <div class="head">
        <div class="head-product"><div class="item-wrap">Item</div></div>
        <div class="head-price"><div class="item-wrap"><?php esc_html_e( 'Item Price', 'woocommerce' ); ?></div></div>
        <div class="head-quantity"><div class="item-wrap"><?php esc_html_e( 'Qty', 'woocommerce' ); ?></div></div>
        <div class="head-total"><div class="item-wrap"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></div></div>
      </div>
      <div class="items">
        <?php do_action( 'woocommerce_before_cart_contents' ); ?>
        <?php
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
          $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
          $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

          if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            ?>
            <div class="item woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

              <div class="item-column item-thumbnail">
                <div class="item-wrap">
                  <?php
                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                    if ( ! $product_permalink ) {
                      echo $thumbnail; // PHPCS: XSS ok.
                    } else {
                      printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
                    }
                  ?>
                </div>
              </div>
              <div class="item-column item-middle">
                <div class="item-column product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                  <div class="item-wrap">
                    <?php
                      if ( ! $product_permalink ) {
                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                      } else {
                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                      }

                      do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

                      // Meta data
                      echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                      // Backorder notification
                      if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                      }
                    ?>
                  </div>
                </div>

                <div class="item-column product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                  <div class="item-wrap">
                    <span class="hidden-md-up">Item Price: </span>
                    <?php
                      echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                    ?>
                  </div>
                </div>

                <div class="item-column product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
                  <div class="item-wrap">
                    <?php
                      if ( $_product->is_sold_individually() ) {
                        $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                      } else {
                        $product_quantity = woocommerce_quantity_input( array(
                          'input_name'    => "cart[{$cart_item_key}][qty]",
                          'input_value'   => $cart_item['quantity'],
                          'max_value'     => $_product->get_max_purchase_quantity(),
                          'min_value'     => '0',
                          'product_name'  => $_product->get_name(),
                        ), $_product, false );
                      }

                      echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                    ?>
                    <?php
                      echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        'woocommerce_cart_item_remove_link',
                        sprintf(
                          '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',
                          esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                          esc_html__( 'Remove this item', 'woocommerce' ),
                          esc_attr( $product_id ),
                          esc_attr( $_product->get_sku() )
                        ),
                        $cart_item_key
                      );
                    ?>
                  </div>
                </div>
              </div>
              <div class="item-column product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
                <div class="item-wrap">
                  <?php
                    echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                  ?>
                </div>
              </div>
            </div>
            <?php
          }
        }
        ?>
      </div>
    </div>
    <?php do_action( 'woocommerce_cart_contents' ); ?>

    <div class="self_clear">
      <div class="update-and-coupon self_clear">
        <div class="update-cart">
          <button type="submit" class="button btn btn-link" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
        </div>
        <div class="coupon-block">
          <?php if ( wc_coupons_enabled() ) { ?>
            <div class="coupon-label fw-500">Promo Code</div>
            <div class="coupon">
              <div class="input-group">
                <input type="text" name="coupon_code" class="form-control" id="coupon_code" value="">
                <div class="input-group-append">
                  <input type="submit" class="button btn btn-primary btn-sm" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>" />
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <?php do_action( 'woocommerce_cart_actions' ); ?>
        <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
      </div>

      <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
      <div class="cart-collaterals">
        <?php
          /**
           * woocommerce_cart_collaterals hook.
           *
           * @hooked woocommerce_cross_sell_display
           * @hooked woocommerce_cart_totals - 10
           */
          do_action( 'woocommerce_cart_collaterals' );
        ?>
      </div>
    </div>

    <?php do_action( 'woocommerce_after_cart_table' ); ?>
  </form>

  <?php do_action( 'woocommerce_after_cart' ); ?>
</div>
