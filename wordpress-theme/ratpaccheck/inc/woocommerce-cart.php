<?php
/**
 * WooCommerce Dynamic Cart Drawer & AJAX Engine
 *
 * Connects the RatpacCheck slide-out cart drawer directly with WooCommerce's native
 * session cart (WC()->cart), supporting coupons/discount codes, AJAX fragments,
 * inventory validation, and seamless checkout redirection.
 *
 * @package RatpacCheck
 * @version 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return live WooCommerce cart drawer state via AJAX
 */
function ratpaccheck_get_cart_state() {
    if (!function_exists('WC') || !WC()->cart) {
        wp_send_json_error(array('message' => 'WooCommerce cart not initialized'));
    }

    $cart = WC()->cart;
    $items = array();

    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
        $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
            $product_name  = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
            $thumbnail     = $_product->get_image(array(90, 90));
            $product_price = apply_filters('woocommerce_cart_item_price', $cart->get_product_price($_product), $cart_item, $cart_item_key);
            $subtitle      = get_post_meta($product_id, '_ratpac_subtitle', true) ?: get_post_meta($product_id, '_subtitle', true);

            $items[] = array(
                'key'            => $cart_item_key,
                'product_id'     => $product_id,
                'name'           => $product_name,
                'subtitle'       => $subtitle,
                'price'          => $product_price,
                'raw_price'      => $_product->get_price(),
                'quantity'       => $cart_item['quantity'],
                'image'          => $thumbnail,
                'line_total'     => wc_price($cart_item['line_total']),
                'permalink'      => $_product->get_permalink($cart_item),
                'stock_status'   => $_product->get_stock_status(),
                'max_qty'        => $_product->get_max_purchase_quantity(),
            );
        }
    }

    // Applied Coupons
    $applied_coupons = array();
    foreach ($cart->get_applied_coupons() as $coupon_code) {
        $coupon = new WC_Coupon($coupon_code);
        $applied_coupons[] = array(
            'code'   => $coupon_code,
            'amount' => wc_price($cart->get_coupon_discount_amount($coupon_code)),
        );
    }

    return array(
        'item_count'       => $cart->get_cart_contents_count(),
        'items'            => $items,
        'subtotal'         => $cart->get_cart_subtotal(),
        'total'            => $cart->get_total(),
        'discount_total'   => wc_price($cart->get_discount_total()),
        'has_discount'     => $cart->get_discount_total() > 0,
        'applied_coupons'  => $applied_coupons,
        'checkout_url'     => wc_get_checkout_url(),
        'cart_url'         => wc_get_cart_url(),
    );
}

/**
 * AJAX Handler: Get Cart
 */
function ratpaccheck_ajax_get_cart() {
    wp_send_json_success(ratpaccheck_get_cart_state());
}
add_action('wp_ajax_ratpaccheck_get_cart', 'ratpaccheck_ajax_get_cart');
add_action('wp_ajax_nopriv_ratpaccheck_get_cart', 'ratpaccheck_ajax_get_cart');

/**
 * AJAX Handler: Add to Cart
 */
function ratpaccheck_ajax_add_to_cart() {
    check_ajax_referer('ratpaccheck_cart_nonce', 'security');

    if (!function_exists('WC') || !WC()->cart) {
        wp_send_json_error(array('message' => 'WooCommerce is not active'));
    }

    $product_id = isset($_POST['product_id']) ? absint($_POST['product_id']) : 0;
    $quantity   = isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : 1;

    // Check if ID is legacy custom ID, resolve to WooCommerce product
    if ($product_id < 1000) {
        $wc_post = get_posts(array(
            'post_type'      => 'product',
            'meta_key'       => '_ratpac_legacy_id',
            'meta_value'     => $product_id,
            'posts_per_page' => 1,
            'fields'         => 'ids'
        ));
        if (!empty($wc_post)) {
            $product_id = $wc_post[0];
        }
    }

    if (!$product_id) {
        wp_send_json_error(array('message' => 'Invalid product ID'));
    }

    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $cart_item_key     = WC()->cart->add_to_cart($product_id, $quantity);

    if ($passed_validation && $cart_item_key) {
        do_action('woocommerce_ajax_added_to_cart', $product_id);
        wp_send_json_success(ratpaccheck_get_cart_state());
    } else {
        $notices = wc_get_notices('error');
        wc_clear_notices();
        $message = !empty($notices) ? wp_strip_all_tags($notices[0]['notice']) : 'Could not add product to cart.';
        wp_send_json_error(array('message' => $message));
    }
}
add_action('wp_ajax_ratpaccheck_add_to_cart', 'ratpaccheck_ajax_add_to_cart');
add_action('wp_ajax_nopriv_ratpaccheck_add_to_cart', 'ratpaccheck_ajax_add_to_cart');

/**
 * AJAX Handler: Update Item Quantity
 */
function ratpaccheck_ajax_update_cart_qty() {
    check_ajax_referer('ratpaccheck_cart_nonce', 'security');

    if (!function_exists('WC') || !WC()->cart) {
        wp_send_json_error(array('message' => 'WooCommerce cart not initialized'));
    }

    $cart_key = isset($_POST['cart_item_key']) ? sanitize_text_field($_POST['cart_item_key']) : '';
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

    if (empty($cart_key)) {
        wp_send_json_error(array('message' => 'Invalid cart item key'));
    }

    if ($quantity <= 0) {
        WC()->cart->remove_cart_item($cart_key);
    } else {
        WC()->cart->set_quantity($cart_key, $quantity, true);
    }

    wp_send_json_success(ratpaccheck_get_cart_state());
}
add_action('wp_ajax_ratpaccheck_update_cart_qty', 'ratpaccheck_ajax_update_cart_qty');
add_action('wp_ajax_nopriv_ratpaccheck_update_cart_qty', 'ratpaccheck_ajax_update_cart_qty');

/**
 * AJAX Handler: Apply Coupon / Discount Code
 */
function ratpaccheck_ajax_apply_coupon() {
    check_ajax_referer('ratpaccheck_cart_nonce', 'security');

    if (!function_exists('WC') || !WC()->cart) {
        wp_send_json_error(array('message' => 'WooCommerce is not active'));
    }

    $coupon_code = isset($_POST['coupon_code']) ? sanitize_text_field(wp_unslash($_POST['coupon_code'])) : '';

    if (empty($coupon_code)) {
        wp_send_json_error(array('message' => 'Please enter a valid coupon code.'));
    }

    if (WC()->cart->has_discount($coupon_code)) {
        wp_send_json_error(array('message' => 'Coupon code is already applied.'));
    }

    $applied = WC()->cart->apply_coupon($coupon_code);

    if ($applied) {
        wc_clear_notices();
        $state = ratpaccheck_get_cart_state();
        $state['success_message'] = sprintf(__('Coupon "%s" applied successfully!', 'ratpaccheck'), esc_html($coupon_code));
        wp_send_json_success($state);
    } else {
        $notices = wc_get_notices('error');
        wc_clear_notices();
        $message = !empty($notices) ? wp_strip_all_tags($notices[0]['notice']) : __('Invalid or expired coupon code.', 'ratpaccheck');
        wp_send_json_error(array('message' => $message));
    }
}
add_action('wp_ajax_ratpaccheck_apply_coupon', 'ratpaccheck_ajax_apply_coupon');
add_action('wp_ajax_nopriv_ratpaccheck_apply_coupon', 'ratpaccheck_ajax_apply_coupon');

/**
 * AJAX Handler: Remove Coupon
 */
function ratpaccheck_ajax_remove_coupon() {
    check_ajax_referer('ratpaccheck_cart_nonce', 'security');

    if (!function_exists('WC') || !WC()->cart) {
        wp_send_json_error(array('message' => 'WooCommerce is not active'));
    }

    $coupon_code = isset($_POST['coupon_code']) ? sanitize_text_field(wp_unslash($_POST['coupon_code'])) : '';

    if ($coupon_code && WC()->cart->remove_coupon($coupon_code)) {
        wc_clear_notices();
        $state = ratpaccheck_get_cart_state();
        $state['success_message'] = __('Coupon removed.', 'ratpaccheck');
        wp_send_json_success($state);
    } else {
        wp_send_json_error(array('message' => 'Could not remove coupon.'));
    }
}
add_action('wp_ajax_ratpaccheck_remove_coupon', 'ratpaccheck_ajax_remove_coupon');
add_action('wp_ajax_nopriv_ratpaccheck_remove_coupon', 'ratpaccheck_ajax_remove_coupon');

/**
 * WooCommerce Cart Fragments for Badge & Header
 */
function ratpaccheck_cart_fragments($fragments) {
    if (function_exists('WC') && WC()->cart) {
        $count = WC()->cart->get_cart_contents_count();
        $style = $count > 0 ? '' : 'display:none;';
        $fragments['#cart-counter-badge'] = '<span id="cart-counter-badge" class="absolute -top-1 -right-1 bg-black text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center" style="' . $style . '">' . $count . '</span>';
        $fragments['.cart-counter-badge'] = '<span class="cart-counter-badge absolute -top-1 -right-1 bg-black text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center" style="' . $style . '">' . $count . '</span>';
    }
    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'ratpaccheck_cart_fragments');
