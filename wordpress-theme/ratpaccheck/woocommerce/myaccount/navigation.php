<?php
/**
 * My Account navigation template override for RatpacCheck
 *
 * @package RatpacCheck
 * @version 1.2.0
 */

defined('ABSPATH') || exit;

$menu_items = function_exists('wc_get_account_menu_items') ? wc_get_account_menu_items() : array();
?>

<nav class="woocommerce-MyAccount-navigation rpc-account-nav" aria-label="<?php esc_attr_e('Account navigation', 'ratpaccheck'); ?>">
    <div class="rpc-nav-heading">
        <span>Account Menu</span>
    </div>
    <ul class="rpc-nav-list">
        <?php foreach ($menu_items as $endpoint => $label) : 
            $is_current = function_exists('ratpaccheck_is_account_menu_item_active') 
                ? ratpaccheck_is_account_menu_item_active($endpoint) 
                : wc_is_current_account_menu_item($endpoint);
            $url  = wc_get_account_endpoint_url($endpoint);
            $icon = function_exists('ratpaccheck_get_account_menu_icon') 
                ? ratpaccheck_get_account_menu_icon($endpoint) 
                : '<svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"></circle></svg>';
        ?>
            <li class="rpc-nav-item <?php echo $is_current ? 'is-active active' : ''; ?>">
                <a href="<?php echo esc_url($url); ?>" class="rpc-nav-link <?php echo $is_current ? 'is-active active' : ''; ?>" <?php echo $is_current ? 'aria-current="page"' : ''; ?>>
                    <span class="rpc-nav-icon">
                        <?php echo $icon; ?>
                    </span>
                    <span class="rpc-nav-label"><?php echo esc_html($label); ?></span>
                    <?php if ($is_current) : ?>
                        <span class="rpc-nav-dot" aria-hidden="true"></span>
                    <?php endif; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>
