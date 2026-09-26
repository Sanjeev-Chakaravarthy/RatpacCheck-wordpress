<?php
/**
 * Custom Branded WordPress Admin Login Styling
 *
 * Implements a luxurious, science-backed clean beauty aesthetic for wp-login.php
 * matching the RatpacCheck brand (#F6F1EA background, #E8799A pink, #8B6B4A gold, #1A1A1A dark).
 *
 * @package RatpacCheck
 * @version 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue custom styles for the login page
 */
function ratpaccheck_login_styles() {
    ?>
    <style type="text/css">
        body.login {
            background-color: #F6F1EA !important;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #1A1A1A;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 24px 16px;
        }

        #login {
            width: 100% !important;
            max-width: 440px !important;
            padding: 0 !important;
            margin: auto !important;
        }

        /* Brand Header */
        #login h1 {
            margin-bottom: 24px !important;
            text-align: center;
        }

        #login h1 a {
            display: inline-block !important;
            background-image: none !important;
            text-indent: 0 !important;
            font-size: 32px !important;
            font-weight: 800 !important;
            color: #E8799A !important;
            line-height: 1.1 !important;
            text-decoration: none !important;
            width: auto !important;
            height: auto !important;
            letter-spacing: -0.02em;
            margin: 0 !important;
            padding: 0 !important;
            transition: opacity 0.2s ease;
        }

        #login h1 a:hover {
            opacity: 0.9;
        }

        #login h1 a::after {
            content: "we CARE about your SKIN & HAIR";
            display: block;
            font-size: 11px;
            font-weight: 500;
            color: #8C847C;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: 6px;
        }

        /* Form Card */
        #login form {
            background: #FFFFFF !important;
            border: 1px solid #E8E3DB !important;
            border-radius: 16px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04), 0 1px 3px rgba(0, 0, 0, 0.02) !important;
            padding: 36px 32px !important;
            margin-top: 0 !important;
        }

        /* Form Labels */
        #login form label {
            font-size: 12.5px !important;
            font-weight: 600 !important;
            letter-spacing: 0.04em !important;
            text-transform: uppercase !important;
            color: #4A4A4A !important;
            margin-bottom: 8px !important;
            display: block !important;
        }

        /* Input Fields */
        #login form .input,
        #login input[type="text"],
        #login input[type="password"] {
            background-color: #FAFAFA !important;
            border: 1px solid #E2DCD5 !important;
            border-radius: 10px !important;
            font-size: 15px !important;
            padding: 12px 14px !important;
            color: #1A1A1A !important;
            box-shadow: none !important;
            transition: all 0.2s ease !important;
            margin-bottom: 20px !important;
            width: 100% !important;
            box-sizing: border-box !important;
        }

        #login form .input:focus,
        #login input[type="text"]:focus,
        #login input[type="password"]:focus {
            border-color: #E8799A !important;
            background-color: #FFFFFF !important;
            box-shadow: 0 0 0 3px rgba(232, 121, 154, 0.15) !important;
            outline: none !important;
        }

        /* Remember Me & Submit */
        .forgetmenot {
            float: left !important;
            margin-top: 6px !important;
        }

        .forgetmenot label {
            font-size: 13px !important;
            font-weight: 400 !important;
            text-transform: none !important;
            color: #666666 !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            cursor: pointer !important;
        }

        .forgetmenot input[type="checkbox"] {
            border: 1px solid #D5CFC7 !important;
            border-radius: 4px !important;
            width: 16px !important;
            height: 16px !important;
            cursor: pointer !important;
        }

        .forgetmenot input[type="checkbox"]:checked {
            background-color: #1A1A1A !important;
            border-color: #1A1A1A !important;
        }

        /* Submit Button */
        #login form p.submit {
            margin: 0 !important;
            padding-top: 8px !important;
        }

        #login form .button-primary {
            background-color: #1A1A1A !important;
            border: 1px solid #1A1A1A !important;
            border-radius: 10px !important;
            color: #FFFFFF !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            letter-spacing: 0.05em !important;
            text-transform: uppercase !important;
            padding: 10px 24px !important;
            height: auto !important;
            line-height: 1.5 !important;
            cursor: pointer !important;
            transition: all 0.25s ease !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
            float: right !important;
        }

        #login form .button-primary:hover,
        #login form .button-primary:focus {
            background-color: #E8799A !important;
            border-color: #E8799A !important;
            color: #FFFFFF !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 16px rgba(232, 121, 154, 0.3) !important;
        }

        /* Bottom Nav Links */
        #nav, #backtoblog {
            text-align: center !important;
            padding: 16px 0 0 !important;
            margin: 0 !important;
            font-size: 13px !important;
        }

        #nav a, #backtoblog a {
            color: #8C847C !important;
            text-decoration: none !important;
            transition: color 0.2s ease !important;
            font-weight: 500 !important;
        }

        #nav a:hover, #backtoblog a:hover {
            color: #1A1A1A !important;
            text-decoration: underline !important;
        }

        /* Error and Info Notices */
        .login #login_error,
        .login .message,
        .login .notice {
            border-radius: 10px !important;
            font-size: 13.5px !important;
            line-height: 1.5 !important;
            padding: 14px 18px !important;
            margin-bottom: 20px !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03) !important;
        }

        .login #login_error {
            background-color: #FFF5F5 !important;
            border-left: 4px solid #E53E3E !important;
            border-top: 1px solid #FED7D7 !important;
            border-right: 1px solid #FED7D7 !important;
            border-bottom: 1px solid #FED7D7 !important;
            color: #9B2C2C !important;
        }

        .login .message {
            background-color: #F0FFF4 !important;
            border-left: 4px solid #38A169 !important;
            border-top: 1px solid #C6F6D5 !important;
            border-right: 1px solid #C6F6D5 !important;
            border-bottom: 1px solid #C6F6D5 !important;
            color: #22543D !important;
        }

        /* Language Switcher */
        .language-switcher {
            margin-top: 24px !important;
            text-align: center !important;
        }
    </style>
    <?php
}
add_action('login_enqueue_scripts', 'ratpaccheck_login_styles');

/**
 * Point login header URL to home page
 */
function ratpaccheck_login_headerurl() {
    return home_url('/');
}
add_filter('login_headerurl', 'ratpaccheck_login_headerurl');

/**
 * Set login logo title to site name
 */
function ratpaccheck_login_headertitle() {
    return get_bloginfo('name') . ' — Science-Backed Haircare & Skincare';
}
add_filter('login_headertext', 'ratpaccheck_login_headertitle');
