<?php
/**
 * Login / Register Form – RatpacCheck theme override
 *
 * @package RatpacCheck
 * @version 1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$registration_enabled = ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) );
?>

<div class="rpc-auth-page-container">

    <!-- Header -->
    <div class="rpc-auth-page-header">
        <span class="rpc-auth-badge">Your Account</span>
        <h1 class="rpc-auth-title">Welcome to RatpacCheck</h1>
        <p class="rpc-auth-subtitle">Sign in to access your orders, skincare routine, and exclusive member benefits.</p>
    </div>

    <!-- Login + Register columns -->
    <div class="rpc-auth-columns <?php echo $registration_enabled ? 'rpc-has-register' : 'rpc-login-only'; ?>" id="customer_login">

        <!-- ===================== SIGN IN ===================== -->
        <div class="rpc-auth-col rpc-col-login">
            <div class="rpc-auth-col-header">
                <h2>Sign In</h2>
                <p>Welcome back — enter your credentials below.</p>
            </div>

            <form
                class="woocommerce-form woocommerce-form-login login"
                method="post"
                action="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"
            >
                <?php do_action( 'woocommerce_login_form_start' ); ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input
                        type="text"
                        class="woocommerce-Input woocommerce-Input--text input-text"
                        name="username"
                        id="username"
                        autocomplete="username"
                        value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"
                        required
                    />
                </p>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input
                        class="woocommerce-Input woocommerce-Input--text input-text"
                        type="password"
                        name="password"
                        id="password"
                        autocomplete="current-password"
                        required
                    />
                </p>

                <?php do_action( 'woocommerce_login_form' ); ?>

                <div class="rpc-form-row-actions">
                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                        <input
                            class="woocommerce-form__input woocommerce-form__input-checkbox"
                            name="rememberme"
                            type="checkbox"
                            id="rememberme"
                            value="forever"
                        />
                        <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
                    </label>
                    <a class="rpc-lost-pw-link" href="<?php echo esc_url( wp_lostpassword_url() ); ?>">
                        <?php esc_html_e( 'Forgot password?', 'woocommerce' ); ?>
                    </a>
                </div>

                <p class="form-row rpc-submit-row">
                    <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                    <button
                        type="submit"
                        class="woocommerce-button button woocommerce-form-login__submit rpc-btn-primary-wide"
                        name="login"
                        value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"
                    >
                        <span>Sign In</span>
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </p>

                <?php do_action( 'woocommerce_login_form_end' ); ?>
            </form>
        </div><!-- .rpc-col-login -->

        <?php if ( $registration_enabled ) : ?>
        <!-- ================= CREATE ACCOUNT ================= -->
        <div class="rpc-auth-col rpc-col-register">
            <div class="rpc-auth-col-header">
                <h2>Create an Account</h2>
                <p>Join RatpacCheck for member-only skincare benefits and early access.</p>
            </div>

            <form
                method="post"
                class="woocommerce-form woocommerce-form-register register"
                <?php do_action( 'woocommerce_register_form_tag' ); ?>
            >
                <?php do_action( 'woocommerce_register_form_start' ); ?>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input
                        type="text"
                        class="woocommerce-Input woocommerce-Input--text input-text"
                        name="username"
                        id="reg_username"
                        autocomplete="username"
                        value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"
                        required
                    />
                </p>
                <?php endif; ?>

                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input
                        type="email"
                        class="woocommerce-Input woocommerce-Input--text input-text"
                        name="email"
                        id="reg_email"
                        autocomplete="email"
                        value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>"
                        required
                    />
                </p>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                    <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
                    <input
                        type="password"
                        class="woocommerce-Input woocommerce-Input--text input-text"
                        name="password"
                        id="reg_password"
                        autocomplete="new-password"
                        required
                    />
                </p>
                <?php else : ?>
                <p class="rpc-pw-notice"><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>
                <?php endif; ?>

                <?php do_action( 'woocommerce_register_form' ); ?>

                <p class="rpc-privacy-policy-text">
                    Your personal data will be used to manage your account, support your experience, and for the purposes described in our privacy policy.
                </p>

                <p class="woocommerce-form-row form-row rpc-submit-row">
                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                    <button
                        type="submit"
                        class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit rpc-btn-primary-wide"
                        name="register"
                        value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"
                    >
                        <span>Create Account</span>
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </p>

                <?php do_action( 'woocommerce_register_form_end' ); ?>
            </form>
        </div><!-- .rpc-col-register -->
        <?php endif; ?>

    </div><!-- .rpc-auth-columns -->
</div><!-- .rpc-auth-page-container -->
