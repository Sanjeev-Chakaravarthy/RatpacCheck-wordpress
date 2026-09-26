<?php
/**
 * Show error messages - RatpacCheck Luxury Override
 *
 * @package RatpacCheck
 * @version 8.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! $notices ) {
    return;
}
?>
<div class="rpc-woocommerce-notice rpc-notice-error woocommerce-error" role="alert" tabindex="-1">
    <div class="rpc-notice-icon-box" aria-hidden="true">
        <svg class="rpc-notice-svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"></circle>
            <line x1="15" y1="9" x2="9" y2="15"></line>
            <line x1="9" y1="9" x2="15" y2="15"></line>
        </svg>
    </div>
    <ul class="rpc-notice-content">
        <?php foreach ( $notices as $notice ) : ?>
            <li<?php echo wc_get_notice_data_attr( $notice ); ?>>
                <?php echo wc_kses_notice( $notice['notice'] ); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
