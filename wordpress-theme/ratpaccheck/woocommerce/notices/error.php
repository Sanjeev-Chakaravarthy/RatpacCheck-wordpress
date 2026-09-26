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
<div class="rpc-woocommerce-notice rpc-notice-error" role="alert" tabindex="-1">
    <div class="rpc-notice-icon-box" aria-hidden="true">
        <svg class="rpc-notice-svg" width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
    </div>
    <ul class="rpc-notice-content woocommerce-error">
        <?php foreach ( $notices as $notice ) : ?>
            <li<?php echo wc_get_notice_data_attr( $notice ); ?>>
                <?php echo wc_kses_notice( $notice['notice'] ); ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
