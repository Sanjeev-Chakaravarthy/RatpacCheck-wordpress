<?php
/**
 * WooCommerce My Account Configuration & Portal Helpers
 *
 * Provides helper functions, custom SVG icons, endpoint detection,
 * and seamless template routing for the RatpacCheck customer portal.
 *
 * @package RatpacCheck
 * @version 1.2.0
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
 * Ensure template_include loads page-my-account.php for all WooCommerce account pages
 */
function ratpaccheck_force_myaccount_template($template) {
    if (function_exists('is_account_page') && is_account_page()) {
        $custom_tpl = get_template_directory() . '/page-my-account.php';
        if (file_exists($custom_tpl)) {
            return $custom_tpl;
        }
    }
    return $template;
}
add_filter('template_include', 'ratpaccheck_force_myaccount_template', 99);
