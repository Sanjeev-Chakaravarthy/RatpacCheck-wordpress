<?php
/**
 * Template Name: My Account
 *
 * Full-width account portal template for RatpacCheck.
 * Uses standard WordPress header/footer and outputs WooCommerce account
 * content directly via do_action hooks — avoids double-wrapper conflicts.
 *
 * @package RatpacCheck
 * @version 1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main rpc-myaccount-page">
    <div class="rpc-myaccount-inner">
        <?php
        // Output any WooCommerce notices
        if ( function_exists( 'woocommerce_output_all_notices' ) ) {
            woocommerce_output_all_notices();
        }

        // The core WooCommerce my-account content
        if ( function_exists( 'wc_get_template' ) ) {
            if ( ! is_user_logged_in() ) {
                if ( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( 'lost-password' ) ) {
                    wc_get_template( 'myaccount/form-lost-password.php' );
                } elseif ( function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url() ) {
                    do_action( 'woocommerce_account_content' );
                } else {
                    wc_get_template( 'myaccount/form-login.php' );
                }
            } else {
                wc_get_template( 'myaccount/my-account.php' );
            }
        } else {
            // Fallback: render page content (shortcode)
            while ( have_posts() ) {
                the_post();
                the_content();
            }
        }
        ?>
    </div>
</main>

<?php
get_footer();
