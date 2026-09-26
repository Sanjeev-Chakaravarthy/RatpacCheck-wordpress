<?php
/**
 * WooCommerce My Account Redesign & Plugin-Safe Template Engine
 *
 * Re-architects the default WooCommerce My Account page into a luxurious,
 * modern client portal with custom icons, statistics, order status badges,
 * and 100% dynamic support for third-party plugin tabs/endpoints.
 *
 * @package RatpacCheck
 * @version 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return modern SVG icons for WooCommerce account menu items
 */
function ratpaccheck_get_account_menu_icon($endpoint) {
    switch ($endpoint) {
        case 'dashboard':
            return '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>';
        case 'orders':
            return '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>';
        case 'downloads':
            return '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>';
        case 'edit-address':
            return '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
        case 'edit-account':
            return '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>';
        case 'customer-logout':
            return '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>';
        default:
            // Fallback icon for third-party plugin endpoints (Wishlist, Subscriptions, etc.)
            return '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>';
    }
}

/**
 * Safe helper to retrieve customer order count across all WooCommerce versions
 */
function ratpaccheck_get_customer_order_count($user_id) {
    if (!$user_id) {
        return 0;
    }
    if (class_exists('WC_Customer')) {
        try {
            $customer = new WC_Customer($user_id);
            return (int) $customer->get_order_count();
        } catch (Exception $e) {}
    }
    if (function_exists('wc_get_orders')) {
        try {
            $orders = wc_get_orders(array(
                'customer_id' => $user_id,
                'limit'       => -1,
                'return'      => 'ids',
            ));
            return is_array($orders) ? count($orders) : 0;
        } catch (Exception $e) {}
    }
    return 0;
}



/**
 * Safe helper to check if an account menu item endpoint is active
 */
function ratpaccheck_is_account_menu_item_active($endpoint) {
    if (function_exists('is_wc_endpoint_url') && is_wc_endpoint_url($endpoint)) {
        return true;
    }
    if (function_exists('wc_get_account_menu_item_classes')) {
        $classes = wc_get_account_menu_item_classes($endpoint);
        if (strpos($classes, 'is-active') !== false) {
            return true;
        }
    }
    if ($endpoint === 'dashboard') {
        if (function_exists('is_account_page') && is_account_page()) {
            if (function_exists('WC') && isset(WC()->query) && method_exists(WC()->query, 'get_current_endpoint')) {
                return !WC()->query->get_current_endpoint();
            }
            return true;
        }
    }
    return false;
}

/**
 * Override Account Navigation Template with Luxury Banner, Icons, and Dynamic Navigation
 */
function ratpaccheck_custom_account_navigation() {
    if (!is_user_logged_in()) {
        return;
    }

    $current_user = wp_get_current_user();
    $display_name = !empty($current_user->first_name) ? $current_user->first_name : $current_user->display_name;
    $initial      = strtoupper(substr($display_name, 0, 1));
    $order_count  = ratpaccheck_get_customer_order_count($current_user->ID);
    $menu_items   = function_exists('wc_get_account_menu_items') ? wc_get_account_menu_items() : array();
    ?>
    <div class="rpc-account-portal py-6 sm:py-10">
        
        <!-- Luxury User Header Banner -->
        <div class="rpc-account-banner mb-8 bg-white border border-[#E8E3DB] rounded-2xl p-6 sm:p-8 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4 sm:gap-5">
                <div class="rpc-avatar-circle w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-[#1A1A1A] text-[#E8799A] font-bold text-xl sm:text-2xl flex items-center justify-center flex-shrink-0 shadow-md">
                    <?php echo esc_html($initial); ?>
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h2 class="font-metropolis text-xl sm:text-2xl font-bold text-[#1A1A1A] m-0">
                            Hello, <?php echo esc_html($display_name); ?>
                        </h2>
                        <span class="inline-block bg-[#F6F1EA] text-[#8B6B4A] text-[10px] font-semibold tracking-wider uppercase px-2.5 py-0.5 rounded-full border border-[#E8E3DB]">
                            Beauty Member
                        </span>
                    </div>
                    <p class="font-metropolis text-xs sm:text-sm text-[#8C847C] mt-1 m-0">
                        <?php echo esc_html($current_user->user_email); ?> &bull; <?php printf(_n('%s Order Placed', '%s Orders Placed', $order_count, 'ratpaccheck'), number_format_i18n($order_count)); ?>
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?php echo esc_url(home_url('/products')); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-[#F6F1EA] hover:bg-[#1A1A1A] hover:text-white text-[#1A1A1A] text-xs font-semibold uppercase tracking-wider rounded-lg transition-colors border border-[#E8E3DB]">
                    Browse Products
                </a>
                <a href="<?php echo esc_url(wc_logout_url()); ?>" class="inline-flex items-center justify-center px-4 py-2 bg-transparent hover:bg-red-50 text-[#8C847C] hover:text-red-600 text-xs font-semibold uppercase tracking-wider rounded-lg transition-colors border border-transparent hover:border-red-200">
                    Log out
                </a>
            </div>
        </div>

        <!-- Portal 2-Column Grid -->
        <div class="rpc-account-grid flex flex-col lg:flex-row items-start gap-8">
            <nav class="rpc-account-nav w-full lg:w-64 flex-shrink-0 bg-white border border-[#E8E3DB] rounded-2xl p-3 sm:p-4 shadow-sm" aria-label="<?php esc_attr_e('Account navigation', 'ratpaccheck'); ?>">
                <span class="block px-3 py-2 text-[10px] font-bold uppercase tracking-widest text-[#8C847C] border-b border-[#F6F1EA] mb-2">
                    Account Menu
                </span>
                <ul class="space-y-1 list-none p-0 m-0">
                    <?php foreach ($menu_items as $endpoint => $label) : 
                        $is_current = ratpaccheck_is_account_menu_item_active($endpoint);
                        $url        = function_exists('wc_get_account_endpoint_url') ? wc_get_account_endpoint_url($endpoint) : '#';
                        $icon       = ratpaccheck_get_account_menu_icon($endpoint);
                    ?>
                        <li class="rpc-account-nav-item m-0">
                            <a href="<?php echo esc_url($url); ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-[13px] font-medium transition-all <?php echo $is_current ? 'bg-[#1A1A1A] text-white shadow-sm' : 'text-[#4A4A4A] hover:bg-[#F6F1EA] hover:text-[#1A1A1A]'; ?>">
                                <span class="flex-shrink-0 <?php echo $is_current ? 'text-[#E8799A]' : 'text-[#8C847C]'; ?>">
                                    <?php echo $icon; ?>
                                </span>
                                <span class="font-metropolis tracking-wide flex-1"><?php echo esc_html($label); ?></span>
                                <?php if ($is_current) : ?>
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#E8799A]"></span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="rpc-account-content flex-1 min-w-0 w-full bg-white border border-[#E8E3DB] rounded-2xl p-6 sm:p-8 shadow-sm">
    <?php
}
remove_action('woocommerce_account_navigation', 'woocommerce_account_navigation');
add_action('woocommerce_account_navigation', 'ratpaccheck_custom_account_navigation');

/**
 * Close content wrapper after woocommerce_account_content
 */
function ratpaccheck_close_account_content_wrapper() {
    if (is_user_logged_in()) {
        echo '</div><!-- /.rpc-account-content -->';
        echo '</div><!-- /.rpc-account-grid -->';
        echo '</div><!-- /.rpc-account-portal -->';
    }
}
add_action('woocommerce_after_account_content', 'ratpaccheck_close_account_content_wrapper', 99);

/**
 * Enhance Dashboard with Quick Luxury Cards
 */
function ratpaccheck_custom_account_dashboard_cards() {
    $current_user = wp_get_current_user();
    $order_count  = ratpaccheck_get_customer_order_count($current_user->ID);
    ?>
    <div class="rpc-dashboard-cards grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-[#F6F1EA] border border-[#E8E3DB] rounded-xl p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-[#1A1A1A] shadow-xs flex-shrink-0">
                <svg class="w-5 h-5 text-[#8B6B4A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            </div>
            <div>
                <span class="block text-[11px] font-semibold text-[#8C847C] uppercase tracking-wider">Orders</span>
                <span class="block text-lg font-bold text-[#1A1A1A]"><?php echo esc_html($order_count); ?></span>
            </div>
        </div>

        <div class="bg-[#F6F1EA] border border-[#E8E3DB] rounded-xl p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-[#1A1A1A] shadow-xs flex-shrink-0">
                <svg class="w-5 h-5 text-[#8B6B4A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            </div>
            <div>
                <span class="block text-[11px] font-semibold text-[#8C847C] uppercase tracking-wider">Addresses</span>
                <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-address')); ?>" class="block text-xs font-bold text-[#1A1A1A] hover:underline">Manage &rarr;</a>
            </div>
        </div>

        <div class="bg-[#F6F1EA] border border-[#E8E3DB] rounded-xl p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center text-[#1A1A1A] shadow-xs flex-shrink-0">
                <svg class="w-5 h-5 text-[#8B6B4A]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            </div>
            <div>
                <span class="block text-[11px] font-semibold text-[#8C847C] uppercase tracking-wider">Security</span>
                <a href="<?php echo esc_url(wc_get_account_endpoint_url('edit-account')); ?>" class="block text-xs font-bold text-[#1A1A1A] hover:underline">Password &rarr;</a>
            </div>
        </div>
    </div>
    <?php
}
add_action('woocommerce_account_dashboard', 'ratpaccheck_custom_account_dashboard_cards', 5);
