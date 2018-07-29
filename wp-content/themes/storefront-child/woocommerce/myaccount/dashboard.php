<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$user = wp_get_current_user();
?>
<div class="u-columns woocommerce-Addresses col2-set addresses">
  <div class="u-column col-1 accout-info">
    <header class="woocommerce-Address-title title">
      <h3>Account Info</h3>
      <a href="#" id="my-account-edit" class="edit myaccount-edit-link" data-type="account"><?php _e('Edit', 'woocommerce'); ?></a>
    </header>
    <p id="my-account-block">
      <?php echo esc_attr($user->first_name.' '.$user->last_name); ?><br>
      <?php echo esc_attr($user->user_email); ?>
    </p>
    <form id="my-account-form" class="woocommerce-EditAccountForm edit-account d-none" action="" method="post">

      <?php do_action( 'woocommerce_edit_account_form_start' ); ?>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="account_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" required />
      </p>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="account_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" required />
      </p>
      <div class="clear"></div>

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="account_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
        <input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" required />
      </p>
      <div class="clear"></div>

      <?php do_action( 'woocommerce_edit_account_form' ); ?>

      <p>
        <?php wp_nonce_field( 'save_account_details' ); ?>
        <input type="submit" class="woocommerce-Button button btn btn-primary btn-block" name="save_account_details" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>" />
        <input type="hidden" name="action" value="save_account_details" />
        <a href="#" class="myaccount-cancel-link btn btn-block mt-2" data-type="account">Cancel</a>
      </p>

      <?php do_action( 'woocommerce_edit_account_form_end' ); ?>
    </form>
  </div>
  <div class="u-column col-2 accout-info">
    <header class="woocommerce-Address-title title">
      <h3>Password</h3>
      <a href="#" id="my-password-edit" class="edit myaccount-edit-link" data-type="password"><?php _e('Edit', 'woocommerce'); ?></a>
    </header>
    <p id="my-password-block">
      *************
    </p>
    <form id="my-password-form" class="woocommerce-EditAccountForm edit-account d-none" action="" method="post">
      <input type="hidden" name="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" />
      <input type="hidden" name="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" />
      <input type="hidden" name="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" />

      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="password_current"><?php _e( 'Current password', 'woocommerce' ); ?>  <span class="required">*</span></label>
        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_current" id="password_current" required />
      </p>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="password_1"><?php _e( 'New password', 'woocommerce' ); ?>  <span class="required">*</span></label>
        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" required />
      </p>
      <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="password_2"><?php _e( 'Confirm new password', 'woocommerce' ); ?>  <span class="required">*</span></label>
        <input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" required />
      </p>
      <div class="clear"></div>

      <?php do_action( 'woocommerce_edit_account_form' ); ?>

      <p>
        <?php wp_nonce_field( 'save_account_details' ); ?>
        <input type="submit" class="woocommerce-Button button btn btn-primary btn-block" name="save_account_details" value="<?php esc_attr_e( 'Apply', 'woocommerce' ); ?>" />
        <input type="hidden" name="action" value="save_account_details" />
        <a href="#" class="myaccount-cancel-link btn btn-block mt-2" data-type="password">Cancel</a>
      </p>

      <?php do_action( 'woocommerce_edit_account_form_end' ); ?>
    </form>
  </div>
</div>
<?php
$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
  $get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
    'billing' => __( 'Billing address', 'woocommerce' ),
    'shipping' => __( 'Shipping address', 'woocommerce' ),
  ), $customer_id );
} else {
  $get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
    'billing' => __( 'Billing address', 'woocommerce' ),
  ), $customer_id );
}

$oldcol = 1;
$col    = 1;
?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
  <div class="u-columns woocommerce-Addresses col2-set addresses">
<?php endif; ?>

<?php foreach ($get_addresses as $name => $title) : ?>

  <div class="u-column<?php echo ( ( $col = $col * -1 ) < 0 ) ? 1 : 2; ?> col-<?php echo (($oldcol = $oldcol * -1) < 0) ? 1 : 2; ?> woocommerce-Address">
    <header class="woocommerce-Address-title title">
      <h3><?php echo $title; ?></h3>
      <a href="#" id="my-<?php echo $name;?>-edit" class="edit myaccount-edit-link" data-type="<?php echo $name;?>"><?php _e('Edit', 'woocommerce'); ?></a>
    </header>
    <p id="my-<?php echo $name;?>-block"><?php
      $address = wc_get_account_formatted_address( $name );
      echo $address ? wp_kses_post( $address ) : esc_html_e('You have not set up this type of address yet.', 'woocommerce');
    ?></p>
    <form id="my-<?php echo $name;?>-form" class="d-none" method="post" action="my-account/edit-address/<?php echo $name;?>">
      <?php $load_address = sanitize_key($name); ?>
      <div class="woocommerce-address-fields">
        <?php do_action( "woocommerce_before_edit_address_form_{$name}" ); ?>

        <div class="woocommerce-address-fields__field-wrapper">
          <?php
            foreach ($addresses[$load_address] as $key => $field) {
              if (isset( $field['country_field'], $address[$field['country_field'] ])) {
                $field['country'] = wc_get_post_data_by_key($field['country_field'], $address[ $field['country_field']]['value']);
              }
              woocommerce_form_field($key, $field, wc_get_post_data_by_key( $key, $field['value']));
            }
          ?>
        </div>

        <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

        <p>
          <input type="submit" class="button btn btn-primary btn-block" name="save_address" value="<?php esc_attr_e('Save address', 'woocommerce'); ?>" />
          <?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
          <input type="hidden" name="action" value="edit_address" />
          <a href="#" class="myaccount-cancel-link btn btn-block mt-2" data-type="<?php echo $name;?>">Cancel</a>
        </p>
      </div>

    </form>
  </div>

<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
  </div>
<?php endif;
?>

<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
