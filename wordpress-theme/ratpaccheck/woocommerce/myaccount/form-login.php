<?php
/**
 * Login / Register Form – RatpacCheck theme override
 *
 * Modern, unified single-card authentication layout with segmented tab switcher.
 * Ensures both Sign In and Create Account have the EXACT same compact width and styling.
 *
 * @package RatpacCheck
 * @version 1.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$registration_enabled = ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) );
$start_tab = ( isset( $_GET['action'] ) && $_GET['action'] === 'register' ) ? 'register' : 'login';
?>

<div class="rpc-auth-page-container">

    <!-- Header -->
    <div class="rpc-auth-page-header">
        <span class="rpc-auth-badge">Your Account</span>
        <h1 class="rpc-auth-title">Welcome to RatpacCheck</h1>
        <p class="rpc-auth-subtitle">Sign in or create an account to manage your routine, view deliveries, and access member perks.</p>
    </div>

    <!-- Unified Compact Authentication Card (Identical size for both tabs) -->
    <div class="rpc-auth-card" id="customer_login">

        <?php if ( $registration_enabled ) : ?>
        <!-- Segmented Tab Switcher -->
        <div class="rpc-auth-card-tabs" role="tablist">
            <button
                type="button"
                id="rpc-page-tab-login"
                class="rpc-card-tab-btn <?php echo ($start_tab === 'login') ? 'active' : ''; ?>"
                role="tab"
                aria-selected="<?php echo ($start_tab === 'login') ? 'true' : 'false'; ?>"
                aria-controls="rpc-page-panel-login"
            >
                Sign In
            </button>
            <button
                type="button"
                id="rpc-page-tab-register"
                class="rpc-card-tab-btn <?php echo ($start_tab === 'register') ? 'active' : ''; ?>"
                role="tab"
                aria-selected="<?php echo ($start_tab === 'register') ? 'true' : 'false'; ?>"
                aria-controls="rpc-page-panel-register"
            >
                Create Account
            </button>
        </div>
        <?php endif; ?>

        <!-- ===================== 1. SIGN IN PANEL ===================== -->
        <div
            id="rpc-page-panel-login"
            class="rpc-auth-card-panel <?php echo ($start_tab !== 'login' && $registration_enabled) ? 'rpc-tab-hidden' : ''; ?>"
            role="tabpanel"
            aria-labelledby="rpc-page-tab-login"
        >
            <div class="rpc-auth-panel-heading">
                <h2>Sign In</h2>
                <p>Welcome back — enter your credentials below.</p>
            </div>

            <form class="woocommerce-form woocommerce-form-login login" method="post">
                <?php do_action( 'woocommerce_login_form_start' ); ?>

                <p class="woocommerce-form-row form-row">
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

                <p class="woocommerce-form-row form-row">
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
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </p>

                <?php do_action( 'woocommerce_login_form_end' ); ?>
            </form>
        </div><!-- #rpc-page-panel-login -->

        <?php if ( $registration_enabled ) : ?>
        <!-- ===================== 2. CREATE ACCOUNT PANEL ===================== -->
        <div
            id="rpc-page-panel-register"
            class="rpc-auth-card-panel <?php echo ($start_tab !== 'register') ? 'rpc-tab-hidden' : ''; ?>"
            role="tabpanel"
            aria-labelledby="rpc-page-tab-register"
        >
            <div class="rpc-auth-panel-heading">
                <h2>Create Account</h2>
                <p>Join RatpacCheck for member perks and saved routines.</p>
            </div>

            <form
                method="post"
                class="woocommerce-form woocommerce-form-register register"
                <?php do_action( 'woocommerce_register_form_tag' ); ?>
            >
                <?php do_action( 'woocommerce_register_form_start' ); ?>

                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                <p class="woocommerce-form-row form-row">
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

                <p class="woocommerce-form-row form-row">
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
                <p class="woocommerce-form-row form-row">
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

                <p class="woocommerce-form-row form-row rpc-submit-row">
                    <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                    <button
                        type="submit"
                        class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit rpc-btn-primary-wide"
                        name="register"
                        value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"
                    >
                        <span>Create Account</span>
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </p>

                <?php do_action( 'woocommerce_register_form_end' ); ?>
            </form>
        </div><!-- #rpc-page-panel-register -->
        <?php endif; ?>

    </div><!-- .rpc-auth-card -->
</div><!-- .rpc-auth-page-container -->

<script>
(function() {
    function initAuthTabs() {
        var loginTab = document.getElementById('rpc-page-tab-login');
        var regTab = document.getElementById('rpc-page-tab-register');
        var loginPanel = document.getElementById('rpc-page-panel-login');
        var regPanel = document.getElementById('rpc-page-panel-register');

        if (!loginTab || !regTab || !loginPanel || !regPanel) return;

        function showLogin() {
            loginTab.classList.add('active');
            loginTab.setAttribute('aria-selected', 'true');
            regTab.classList.remove('active');
            regTab.setAttribute('aria-selected', 'false');
            loginPanel.classList.remove('rpc-tab-hidden');
            regPanel.classList.add('rpc-tab-hidden');
        }

        function showRegister() {
            regTab.classList.add('active');
            regTab.setAttribute('aria-selected', 'true');
            loginTab.classList.remove('active');
            loginTab.setAttribute('aria-selected', 'false');
            regPanel.classList.remove('rpc-tab-hidden');
            loginPanel.classList.add('rpc-tab-hidden');
        }

        loginTab.addEventListener('click', showLogin);
        regTab.addEventListener('click', showRegister);

        // Auto-switch if URL has hash #register or search ?action=register
        if (window.location.hash === '#register' || window.location.search.indexOf('action=register') !== -1) {
            showRegister();
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAuthTabs);
    } else {
        initAuthTabs();
    }
})();
</script>
