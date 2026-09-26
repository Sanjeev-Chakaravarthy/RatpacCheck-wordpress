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
<div class="rpc-woocommerce-notice rpc-notice-success" role="alert" tabindex="-1">
    <div class="rpc-notice-icon-box" aria-hidden="true">
        <svg class="rpc-notice-svg" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
    </div>
    <ul class="rpc-notice-content woocommerce-message">
        <?php foreach ( $notices as $notice ) : ?>
            <li<?php echo wc_get_notice_data_attr( $notice ); ?>>
                <?php echo wc_kses_notice( $notice['notice'] ); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
