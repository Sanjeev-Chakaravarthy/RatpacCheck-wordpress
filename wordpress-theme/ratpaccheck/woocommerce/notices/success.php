<?php
/**
 * Show success messages - RatpacCheck Luxury Override
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
<div class="rpc-woocommerce-notice rpc-notice-success woocommerce-message" role="alert" tabindex="-1">
    <div class="rpc-notice-icon-box" aria-hidden="true">
        <svg class="rpc-notice-svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
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
