<?php
/**
 * My Account page override for RatpacCheck
 *
 * Provides a modern, responsive, 2-column luxury client portal layout.
 *
 * @package RatpacCheck
 * @version 1.2.0
 */

defined('ABSPATH') || exit;

$current_user = wp_get_current_user();
$display_name = !empty($current_user->first_name) ? $current_user->first_name : $current_user->display_name;
$initial      = strtoupper(substr($display_name, 0, 1));
$order_count  = function_exists('ratpaccheck_get_customer_order_count') ? ratpaccheck_get_customer_order_count($current_user->ID) : 0;
?>

<div class="rpc-account-portal">
    <!-- Customer Luxury Header Banner -->
    <div class="rpc-account-banner">
        <div class="rpc-banner-user">
            <div class="rpc-avatar-circle">
                <?php echo esc_html($initial ? $initial : 'U'); ?>
            </div>
            <div class="rpc-banner-details">
                <div class="rpc-banner-greeting">
                    <h2 class="rpc-user-name">Hello, <?php echo esc_html($display_name); ?></h2>
                    <span class="rpc-member-badge">Beauty Member</span>
                </div>
                <p class="rpc-user-meta">
                    <span><?php echo esc_html($current_user->user_email); ?></span>
                    <span class="rpc-meta-bullet">&bull;</span>
                    <span><?php printf(_n('%s Order Placed', '%s Orders Placed', $order_count, 'ratpaccheck'), number_format_i18n($order_count)); ?></span>
                </p>
            </div>
        </div>

        <div class="rpc-banner-actions">
            <a href="<?php echo esc_url(home_url('/products/')); ?>" class="rpc-btn-browse">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                <span>Browse Products</span>
            </a>
            <a href="<?php echo esc_url(wc_logout_url()); ?>" class="rpc-btn-logout">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                <span>Log out</span>
            </a>
        </div>
    </div>

    <!-- Notices Container (Full Width) -->
    <div class="rpc-account-notices">
        <?php
        if (function_exists('wc_print_notices')) {
            wc_print_notices();
        }
        ?>
    </div>

    <!-- 2-Column Responsive Portal Grid -->
    <div class="rpc-account-grid">
        <aside class="rpc-account-nav-wrap">
            <?php
            /**
             * My Account navigation.
             *
             * @since 2.6.0
             */
            do_action('woocommerce_account_navigation');
            ?>
        </aside>

        <section class="rpc-account-content-wrap">
            <div class="woocommerce-MyAccount-content rpc-account-content">
                <?php
                /**
                 * My Account content.
                 *
                 * @since 2.6.0
                 */
                do_action('woocommerce_account_content');
                ?>
            </div>
        </section>
    </div>
</div>
