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
$start_tab = 'login';
if ( isset( $_POST['register'] ) || ( isset( $_GET['action'] ) && $_GET['action'] === 'register' ) ) {
    $start_tab = 'register';
}
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

                <?php if ( $registration_enabled ) : ?>
                <p class="rpc-auth-switch-prompt">
                    Don't have an account? <button type="button" class="rpc-link-switch rpc-to-register">Create an account</button>
                </p>
                <?php endif; ?>

                <div class="rpc-auth-divider">
                    <span>or continue with</span>
                </div>

                <button type="button" class="rpc-btn-google rpc-google-auth-trigger" aria-label="Continue with Google">
                    <svg class="rpc-google-icon" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/>
                        <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.16 0 9.97 0 12s.45 3.84 1.25 5.42l4.03-3.15z"/>
                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                    </svg>
                    <span>Continue with Google</span>
                </button>

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

                <div class="rpc-drawer-policy-box">
                    <p class="rpc-drawer-policy-text">
                        By signing up you agree to our <a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>" target="_blank" class="rpc-policy-link">Privacy Policy</a>.
                    </p>
                </div>

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

                <p class="rpc-auth-switch-prompt">
                    Already have an account? <button type="button" class="rpc-link-switch rpc-to-login">Sign in</button>
                </p>

                <div class="rpc-auth-divider">
                    <span>or continue with</span>
                </div>

                <button type="button" class="rpc-btn-google rpc-google-auth-trigger" aria-label="Continue with Google">
                    <svg class="rpc-google-icon" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v4.51h6.6c-.29 1.52-1.14 2.82-2.4 3.68v3.05h3.88c2.27-2.09 3.66-5.17 3.66-9.17z"/>
                        <path fill="#34A853" d="M12 24c3.24 0 5.95-1.08 7.93-2.91l-3.88-3.05c-1.08.72-2.45 1.16-4.05 1.16-3.12 0-5.77-2.1-6.72-4.93H1.25v3.15C3.26 21.36 7.34 24 12 24z"/>
                        <path fill="#FBBC05" d="M5.28 14.27c-.25-.72-.38-1.49-.38-2.27s.13-1.55.38-2.27V6.58H1.25C.45 8.16 0 9.97 0 12s.45 3.84 1.25 5.42l4.03-3.15z"/>
                        <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42C17.95 1.19 15.24 0 12 0 7.34 0 3.26 2.64 1.25 6.58l4.03 3.15c.95-2.83 3.6-4.98 6.72-4.98z"/>
                    </svg>
                    <span>Continue with Google</span>
                </button>

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

        function showLogin() {
            if (loginTab) {
                loginTab.classList.add('active');
                loginTab.setAttribute('aria-selected', 'true');
            }
            if (regTab) {
                regTab.classList.remove('active');
                regTab.setAttribute('aria-selected', 'false');
            }
            if (loginPanel) loginPanel.classList.remove('rpc-tab-hidden');
            if (regPanel) regPanel.classList.add('rpc-tab-hidden');
        }

        function showRegister() {
            if (regTab) {
                regTab.classList.add('active');
                regTab.setAttribute('aria-selected', 'true');
            }
            if (loginTab) {
                loginTab.classList.remove('active');
                loginTab.setAttribute('aria-selected', 'false');
            }
            if (regPanel) regPanel.classList.remove('rpc-tab-hidden');
            if (loginPanel) loginPanel.classList.add('rpc-tab-hidden');
        }

        if (loginTab) loginTab.addEventListener('click', showLogin);
        if (regTab) regTab.addEventListener('click', showRegister);

        // Sub-links inside forms ("Don't have an account? Create an account")
        document.querySelectorAll('.rpc-to-register').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                showRegister();
            });
        });

        document.querySelectorAll('.rpc-to-login').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                showLogin();
            });
        });

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
