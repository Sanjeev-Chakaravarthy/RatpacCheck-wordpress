<?php
/**
 * Lost password form override for RatpacCheck
 *
 * Implements a luxurious, single-card layout matching the brand design system.
 *
 * @package RatpacCheck
 * @version 1.3.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<div class="rpc-auth-page-container">

    <!-- Header -->
    <div class="rpc-auth-page-header">
        <span class="rpc-auth-badge">Account Recovery</span>
        <h1 class="rpc-auth-title">Reset Your Password</h1>
        <p class="rpc-auth-subtitle">Enter your username or email address and we'll send you a secure link to create a new password.</p>
    </div>

    <!-- Unified Luxury Card -->
    <div class="rpc-auth-card" id="customer_lost_password">
        <div class="rpc-auth-panel-heading">
            <h2>Forgot Password?</h2>
            <p>Please enter your account email to receive reset instructions.</p>
        </div>

        <form method="post" class="woocommerce-ResetPassword lost_reset_password">
            <p class="woocommerce-form-row form-row">
                <label for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                <input
                    class="woocommerce-Input woocommerce-Input--text input-text"
                    type="text"
                    name="user_login"
                    id="user_login"
                    autocomplete="username"
                    placeholder="Enter your email or username"
                    required
                />
            </p>

            <div class="clear"></div>

            <?php do_action( 'woocommerce_lostpassword_form' ); ?>

            <p class="woocommerce-form-row form-row rpc-submit-row">
                <input type="hidden" name="wc_reset_password" value="true" />
                <button
                    type="submit"
                    class="woocommerce-Button button rpc-btn-primary-wide"
                    value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"
                >
                    <span>Send Reset Link</span>
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </p>

            <p class="rpc-auth-switch-prompt" style="margin-top: 18px; text-align: center;">
                Remember your password? <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="rpc-link-switch">Sign in</a>
            </p>

            <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
        </form>
    </div>

</div>

<?php
do_action( 'woocommerce_after_lost_password_form' );
