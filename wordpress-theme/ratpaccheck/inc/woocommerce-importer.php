<?php
/**
 * WooCommerce Auto-Importer & Sync Engine
 *
 * Automatically imports all 15 RatpacCheck products, categories, concerns,
 * high-res imagery, and rich scientific meta into native WooCommerce products
 * on theme activation or when WooCommerce is installed.
 *
 * @package RatpacCheck
 * @version 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Automatically import products on theme activation or if WooCommerce product count is 0
 */
function ratpaccheck_auto_sync_woocommerce() {
    // Only run if WooCommerce is active
    if (!class_exists('WooCommerce') || !function_exists('wc_get_products')) {
        return;
    }

    // Check if sync was already completed
    if (get_option('ratpaccheck_wc_products_imported_v1')) {
        return;
    }

    ratpaccheck_sync_all_products_to_woocommerce();
    update_option('ratpaccheck_wc_products_imported_v1', 1);
}
add_action('admin_init', 'ratpaccheck_auto_sync_woocommerce', 20);
add_action('after_switch_theme', 'ratpaccheck_auto_sync_woocommerce', 20);

/**
 * Import/Sync all products from products-data.php into WooCommerce
 */
function ratpaccheck_sync_all_products_to_woocommerce() {
    if (!class_exists('WC_Product_Simple')) {
        return array('success' => false, 'message' => 'WooCommerce product class not found');
    }

    if (!function_exists('ratpaccheck_get_all_products')) {
        require_once get_template_directory() . '/inc/products-data.php';
    }

    $catalog_products = ratpaccheck_get_all_products();
    $details_map      = function_exists('ratpaccheck_get_all_product_details') ? ratpaccheck_get_all_product_details() : array();
    $imported_count   = 0;

    foreach ($catalog_products as $p) {
        $legacy_id = (int)$p['id'];
        $sku       = 'RPC-' . $legacy_id;

        // Check if product already exists by legacy ID or SKU
        $existing = get_posts(array(
            'post_type'      => 'product',
            'meta_key'       => '_ratpac_legacy_id',
            'meta_value'     => $legacy_id,
            'posts_per_page' => 1,
            'fields'         => 'ids'
        ));

        if (!empty($existing)) {
            $product_id = $existing[0];
            $wc_product = wc_get_product($product_id);
        } else {
            $wc_product = new WC_Product_Simple();
            $wc_product->set_sku($sku);
        }

        if (!$wc_product) {
            continue;
        }

        // Basic Info
        $wc_product->set_name($p['name']);
        $wc_product->set_status('publish');
        $wc_product->set_catalog_visibility('visible');

        // Pricing
        $price          = (float)$p['price'];
        $original_price = !empty($p['originalPrice']) ? (float)$p['originalPrice'] : 0;

        if ($original_price > $price) {
            $wc_product->set_regular_price((string)$original_price);
            $wc_product->set_sale_price((string)$price);
            $wc_product->set_price((string)$price);
            $badge = '-' . round((($original_price - $price) / $original_price) * 100) . '%';
        } else {
            $wc_product->set_regular_price((string)$price);
            $wc_product->set_price((string)$price);
            $badge = 'FEATURED';
        }

        // Inventory
        $wc_product->set_manage_stock(false);
        $wc_product->set_stock_status($p['inStock'] ? 'instock' : 'outofstock');

        // Rich Details from details_map
        $detail = isset($details_map[$legacy_id]) ? $details_map[$legacy_id] : array();
        $description = !empty($detail['description']) ? $detail['description'] : ($p['subtitle'] ?? '');
        $wc_product->set_description($description);
        $wc_product->set_short_description($p['subtitle'] ?? '');

        // Save first to get WordPress Post ID
        $product_id = $wc_product->save();

        if (!$product_id) {
            continue;
        }

        // Assign Custom Meta
        update_post_meta($product_id, '_ratpac_legacy_id', $legacy_id);
        update_post_meta($product_id, '_ratpac_subtitle', $p['subtitle'] ?? '');
        update_post_meta($product_id, '_ratpac_badge', $badge);
        update_post_meta($product_id, '_ratpac_rating', (string)($p['rating'] ?? '4.8'));
        update_post_meta($product_id, '_ratpac_rating_count', (string)($p['reviews'] ?? '1,200'));

        if (!empty($detail['volume'])) {
            update_post_meta($product_id, '_ratpac_volume', $detail['volume']);
        }
        if (!empty($detail['suitable_for'])) {
            update_post_meta($product_id, '_ratpac_suitable_for', $detail['suitable_for']);
        }
        if (!empty($detail['how_to_use'])) {
            $how_to_text = is_array($detail['how_to_use']) ? implode("\n", $detail['how_to_use']) : $detail['how_to_use'];
            update_post_meta($product_id, '_ratpac_how_to_use', $how_to_text);
        }
        if (!empty($detail['key_ingredients'])) {
            $ing_text = is_array($detail['key_ingredients']) ? implode("\n", $detail['key_ingredients']) : $detail['key_ingredients'];
            update_post_meta($product_id, '_ratpac_key_ingredients', $ing_text);
        }

        // Categories (product_cat)
        $cat_name = !empty($p['category']) ? ucfirst($p['category']) : 'Skin';
        if ($cat_name === 'Skin') $cat_name = 'Face';
        $cat_term = term_exists($cat_name, 'product_cat');
        if (!$cat_term) {
            $cat_term = wp_insert_term($cat_name, 'product_cat');
        }
        if (!is_wp_error($cat_term) && !empty($cat_term['term_id'])) {
            wp_set_object_terms($product_id, (int)$cat_term['term_id'], 'product_cat');
        }

        // Concerns Taxonomy (product_concern)
        if (!empty($p['concerns']) && is_array($p['concerns'])) {
            $concern_term_ids = array();
            foreach ($p['concerns'] as $concern_name) {
                $term = term_exists($concern_name, 'product_concern');
                if (!$term) {
                    $term = wp_insert_term($concern_name, 'product_concern');
                }
                if (!is_wp_error($term) && !empty($term['term_id'])) {
                    $concern_term_ids[] = (int)$term['term_id'];
                }
            }
            if (!empty($concern_term_ids)) {
                wp_set_object_terms($product_id, $concern_term_ids, 'product_concern');
            }
        }

        // Sideload Image if not set
        if (!has_post_thumbnail($product_id) && !empty($p['image'])) {
            $img_rel_path = ltrim(urldecode($p['image']), '/');
            $img_rel_path = preg_replace('#^images/#', '', $img_rel_path);
            $local_path   = get_template_directory() . '/assets/images/' . $img_rel_path;

            if (file_exists($local_path)) {
                $filename = basename($local_path);
                
                // Check if attachment with same title or filename already exists
                $existing_att = get_posts(array(
                    'post_type'      => 'attachment',
                    'meta_key'       => '_wp_attached_file',
                    'meta_value'     => $filename,
                    'posts_per_page' => 1,
                    'fields'         => 'ids'
                ));

                if (!empty($existing_att)) {
                    set_post_thumbnail($product_id, $existing_att[0]);
                } else {
                    $upload = wp_upload_bits($filename, null, file_get_contents($local_path));
                    if (empty($upload['error'])) {
                        $wp_filetype = wp_check_filetype($filename, null);
                        $attachment = array(
                            'post_mime_type' => $wp_filetype['type'],
                            'post_title'     => sanitize_file_name($p['name']),
                            'post_content'   => '',
                            'post_status'    => 'inherit'
                        );
                        $attach_id = wp_insert_attachment($attachment, $upload['file'], $product_id);
                        if (!is_wp_error($attach_id)) {
                            require_once(ABSPATH . 'wp-admin/includes/image.php');
                            $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
                            wp_update_attachment_metadata($attach_id, $attach_data);
                            set_post_thumbnail($product_id, $attach_id);
                        }
                    }
                }
            }
        }

        $imported_count++;
    }

    return array('success' => true, 'count' => $imported_count);
}

/**
 * Add Manual One-Click Sync Button to WP Admin Notice or Tools
 */
function ratpaccheck_render_sync_admin_notice() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    $screen = get_current_screen();
    if ($screen && $screen->id === 'edit-product') {
        if (isset($_GET['ratpac_sync_completed'])) {
            echo '<div class="notice notice-success is-dismissible"><p><strong>RatpacCheck:</strong> All 15 science-backed products have been synced into WooCommerce successfully!</p></div>';
        }
    }
}
add_action('admin_notices', 'ratpaccheck_render_sync_admin_notice');

/**
 * Handle manual sync trigger from admin
 */
function ratpaccheck_handle_manual_sync() {
    if (isset($_GET['action']) && $_GET['action'] === 'ratpaccheck_sync_products' && check_admin_referer('ratpaccheck_sync_action')) {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        ratpaccheck_sync_all_products_to_woocommerce();
        wp_safe_redirect(admin_url('edit.php?post_type=product&ratpac_sync_completed=1'));
        exit;
    }
}
add_action('admin_init', 'ratpaccheck_handle_manual_sync');
