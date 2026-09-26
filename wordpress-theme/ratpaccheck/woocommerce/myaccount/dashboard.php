<?php
/**
 * My Account dashboard override for RatpacCheck
 *
 * @package RatpacCheck
 * @version 1.2.0
 */

defined('ABSPATH') || exit;

if ( ! is_user_logged_in() ) {
    return;
}

$current_user = wp_get_current_user();
$display_name = !empty($current_user->first_name) ? $current_user->first_name : $current_user->display_name;
$order_count  = function_exists('ratpaccheck_get_customer_order_count') ? ratpaccheck_get_customer_order_count($current_user->ID) : 0;
?>

<div class="rpc-dashboard-container">
    <!-- Header Overview -->
    <div class="rpc-dashboard-intro">
        <h3 class="rpc-dash-heading">Account Overview</h3>
        <p class="rpc-dash-lead">
            Welcome back, <strong><?php echo esc_html($display_name); ?></strong>. From your client dashboard, you can track current deliveries, review order receipts, manage delivery addresses, and configure your password and account preferences.
        </p>
    </div>

    <!-- Quick Stat Cards -->
    <div class="rpc-dashboard-cards">
        <div class="rpc-stat-card">
            <div class="rpc-stat-icon-wrap">
                <svg class="w-5 h-5 text-[#8B6B4A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            </div>
            <div class="rpc-stat-info">
                <span class="rpc-stat-tag">Orders</span>
                <span class="rpc-stat-number"><?php echo esc_html($order_count); ?> <span class="rpc-stat-sub">Total</span></span>
                <a href="<?php echo esc_url(wc_get_account_endpoint_url('orders')); ?>" class="rpc-stat-link">View history &rarr;</a>
            </div>
        </div>

        <div class="rpc-stat-card">
            <div class="rpc-stat-icon-wrap">
                <svg class="w-5 h-5 text-[#8B6B4A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            </div>
            <div class="rpc-stat-info">
                <span class="rpc-stat-tag">Addresses</span>
                <span class="rpc-stat-number">Billing &amp; Shipping</span>
                <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-address')); ?>" class="rpc-stat-link">Manage addresses &rarr;</a>
            </div>
        </div>

        <div class="rpc-stat-card">
            <div class="rpc-stat-icon-wrap">
                <svg class="w-5 h-5 text-[#8B6B4A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            </div>
            <div class="rpc-stat-info">
                <span class="rpc-stat-tag">Security</span>
                <span class="rpc-stat-number">Password &amp; Info</span>
                <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>" class="rpc-stat-link">Account details &rarr;</a>
            </div>
        </div>
    </div>

    <!-- Concierge Support Card -->
    <div class="rpc-support-card">
        <div class="rpc-support-text">
            <h4>Need assistance with your orders?</h4>
            <p>Our dedicated haircare and skincare advisory team is on hand to help with formulations, product regimens, and delivery inquiries.</p>
        </div>
        <div class="rpc-support-actions">
            <a href="<?php echo esc_url(home_url('/track-order/')); ?>" class="rpc-btn-outline-dark">
                Track Package
            </a>
            <a href="<?php echo esc_url(home_url('/customer-help/')); ?>" class="rpc-btn-solid-dark">
                Client Support
            </a>
        </div>
    </div>
</div>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action('woocommerce_account_dashboard');
