<?php
/**
 * WooCommerce Product Custom Meta Boxes & Admin Template
 *
 * Provides a structured meta box for WooCommerce products in WP Admin
 * ensuring store managers can create new products with all the signature
 * RatpacCheck details (subtitles, badges, ratings, how-to-use, routine info).
 *
 * @package RatpacCheck
 * @version 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Product Details Meta Box for WooCommerce 'product' and 'ratpac_product'
 */
function ratpaccheck_register_wc_product_meta_box() {
    $screens = array('product', 'ratpac_product');
    foreach ($screens as $screen) {
        add_meta_box(
            'ratpaccheck_wc_product_details',
            __('RatpacCheck Product Design & Details', 'ratpaccheck'),
            'ratpaccheck_render_wc_product_meta_box',
            $screen,
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'ratpaccheck_register_wc_product_meta_box');

/**
 * Render Product Details Meta Box
 */
function ratpaccheck_render_wc_product_meta_box($post) {
    wp_nonce_field('ratpaccheck_wc_product_meta_nonce_action', 'ratpaccheck_wc_product_meta_nonce');

    // Retrieve existing values
    $subtitle        = get_post_meta($post->ID, '_ratpac_subtitle', true);
    if (!$subtitle) $subtitle = get_post_meta($post->ID, '_subtitle', true);

    $badge           = get_post_meta($post->ID, '_ratpac_badge', true);
    if (!$badge) $badge = get_post_meta($post->ID, '_badge', true);

    $rating          = get_post_meta($post->ID, '_ratpac_rating', true);
    if (!$rating) $rating = get_post_meta($post->ID, '_rating', true) ?: '4.8';

    $rating_count    = get_post_meta($post->ID, '_ratpac_rating_count', true);
    if (!$rating_count) $rating_count = get_post_meta($post->ID, '_rating_count', true) ?: '1,200';

    $volume          = get_post_meta($post->ID, '_ratpac_volume', true);
    if (!$volume) $volume = get_post_meta($post->ID, '_product_volume', true) ?: '50ml / 1.69 fl. oz.';

    $suitable_for    = get_post_meta($post->ID, '_ratpac_suitable_for', true);
    if (!$suitable_for) $suitable_for = get_post_meta($post->ID, '_suitable_for', true) ?: 'All Skin Types, Beginners';

    $routine_step    = get_post_meta($post->ID, '_ratpac_routine_step', true) ?: '';
    $routine_timing  = get_post_meta($post->ID, '_ratpac_routine_timing', true) ?: 'AM, PM';

    $how_to_use      = get_post_meta($post->ID, '_ratpac_how_to_use', true);
    if (!$how_to_use) $how_to_use = get_post_meta($post->ID, '_how_to_use', true);

    $key_ingredients = get_post_meta($post->ID, '_ratpac_key_ingredients', true);
    if (!$key_ingredients) $key_ingredients = get_post_meta($post->ID, '_key_ingredients', true);
    ?>
    <style>
        .rpc-meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        .rpc-meta-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .rpc-meta-field label {
            font-weight: 600;
            font-size: 13px;
            color: #1A1A1A;
        }
        .rpc-meta-field input, .rpc-meta-field textarea, .rpc-meta-field select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #D5CFC7;
            border-radius: 6px;
            font-size: 13.5px;
        }
        .rpc-meta-field input:focus, .rpc-meta-field textarea:focus {
            border-color: #E8799A;
            box-shadow: 0 0 0 2px rgba(232, 121, 154, 0.2);
            outline: none;
        }
        .rpc-meta-desc {
            font-size: 11.5px;
            color: #777;
            margin: 0;
        }
        .rpc-section-heading {
            font-size: 14px;
            font-weight: 700;
            color: #8B6B4A;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 20px 0 10px;
            padding-bottom: 6px;
            border-bottom: 1px solid #E8E3DB;
        }
    </style>

    <div class="rpc-meta-container">
        <p class="rpc-meta-desc" style="margin-bottom: 14px;">
            Configure the aesthetic cards, badges, ratings, and routine instructions. These settings are displayed on both the catalog grid and product detail page.
        </p>

        <div class="rpc-section-heading">Catalog Card Aesthetics</div>
        <div class="rpc-meta-grid">
            <div class="rpc-meta-field">
                <label for="ratpac_subtitle"><?php _e('Product Subtitle / Benefit', 'ratpaccheck'); ?></label>
                <input type="text" id="ratpac_subtitle" name="ratpac_subtitle" value="<?php echo esc_attr($subtitle); ?>" placeholder="e.g. Radiance & Brightening" />
                <span class="rpc-meta-desc">Displayed directly below product title on cards & details page.</span>
            </div>

            <div class="rpc-meta-field">
                <label for="ratpac_badge"><?php _e('Product Card Badge', 'ratpaccheck'); ?></label>
                <input type="text" id="ratpac_badge" name="ratpac_badge" value="<?php echo esc_attr($badge); ?>" placeholder="e.g. -25% or BEST SELLER" />
                <span class="rpc-meta-desc">Black badge pill in the upper-right corner of the product image.</span>
            </div>

            <div class="rpc-meta-field">
                <label for="ratpac_rating"><?php _e('Star Rating (0 - 5)', 'ratpaccheck'); ?></label>
                <input type="text" id="ratpac_rating" name="ratpac_rating" value="<?php echo esc_attr($rating); ?>" placeholder="4.8" />
                <span class="rpc-meta-desc">Rating score displayed with gold stars.</span>
            </div>

            <div class="rpc-meta-field">
                <label for="ratpac_rating_count"><?php _e('Rating Reviews Count', 'ratpaccheck'); ?></label>
                <input type="text" id="ratpac_rating_count" name="ratpac_rating_count" value="<?php echo esc_attr($rating_count); ?>" placeholder="1,500" />
                <span class="rpc-meta-desc">Shown in parentheses, e.g. (1,500).</span>
            </div>
        </div>

        <div class="rpc-section-heading">Routine & Specifications</div>
        <div class="rpc-meta-grid">
            <div class="rpc-meta-field">
                <label for="ratpac_volume"><?php _e('Product Volume / Size', 'ratpaccheck'); ?></label>
                <input type="text" id="ratpac_volume" name="ratpac_volume" value="<?php echo esc_attr($volume); ?>" placeholder="50ml / 1.69 fl. oz." />
            </div>

            <div class="rpc-meta-field">
                <label for="ratpac_suitable_for"><?php _e('Suitable For', 'ratpaccheck'); ?></label>
                <input type="text" id="ratpac_suitable_for" name="ratpac_suitable_for" value="<?php echo esc_attr($suitable_for); ?>" placeholder="All Skin Types, Beginners" />
            </div>

            <div class="rpc-meta-field">
                <label for="ratpac_routine_step"><?php _e('Routine Step (Optional)', 'ratpaccheck'); ?></label>
                <input type="text" id="ratpac_routine_step" name="ratpac_routine_step" value="<?php echo esc_attr($routine_step); ?>" placeholder="e.g. Step 1 : Wash Your Face" />
            </div>

            <div class="rpc-meta-field">
                <label for="ratpac_routine_timing"><?php _e('Routine Timing (AM / PM)', 'ratpaccheck'); ?></label>
                <input type="text" id="ratpac_routine_timing" name="ratpac_routine_timing" value="<?php echo esc_attr($routine_timing); ?>" placeholder="AM, PM" />
            </div>
        </div>

        <div class="rpc-section-heading">Detailed Sections</div>
        <div class="rpc-meta-field" style="margin-bottom: 16px;">
            <label for="ratpac_how_to_use"><?php _e('How To Use / Application Guide', 'ratpaccheck'); ?></label>
            <textarea id="ratpac_how_to_use" name="ratpac_how_to_use" rows="4" placeholder="Enter step-by-step instructions (one per line)"><?php echo esc_textarea($how_to_use); ?></textarea>
            <span class="rpc-meta-desc">Displayed on the product detail page under the How To Use tab.</span>
        </div>

        <div class="rpc-meta-field">
            <label for="ratpac_key_ingredients"><?php _e('Key Ingredients & Science Benefits', 'ratpaccheck'); ?></label>
            <textarea id="ratpac_key_ingredients" name="ratpac_key_ingredients" rows="4" placeholder="e.g. Niacinamide, Hyaluronic Acid, Ceramide Complex..."><?php echo esc_textarea($key_ingredients); ?></textarea>
            <span class="rpc-meta-desc">Displayed in the Key Ingredients collapsible accordion.</span>
        </div>
    </div>
    <?php
}

/**
 * Save Product Details Meta Box
 */
function ratpaccheck_save_wc_product_meta($post_id) {
    if (!isset($_POST['ratpaccheck_wc_product_meta_nonce']) || !wp_verify_nonce($_POST['ratpaccheck_wc_product_meta_nonce'], 'ratpaccheck_wc_product_meta_nonce_action')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'ratpac_subtitle'       => '_ratpac_subtitle',
        'ratpac_badge'          => '_ratpac_badge',
        'ratpac_rating'         => '_ratpac_rating',
        'ratpac_rating_count'   => '_ratpac_rating_count',
        'ratpac_volume'         => '_ratpac_volume',
        'ratpac_suitable_for'   => '_ratpac_suitable_for',
        'ratpac_routine_step'   => '_ratpac_routine_step',
        'ratpac_routine_timing' => '_ratpac_routine_timing',
    );

    foreach ($fields as $post_key => $meta_key) {
        if (isset($_POST[$post_key])) {
            $val = sanitize_text_field($_POST[$post_key]);
            update_post_meta($post_id, $meta_key, $val);
            // Also update legacy keys for 100% backward compatibility
            $legacy_key = str_replace('_ratpac', '', $meta_key);
            update_post_meta($post_id, $legacy_key, $val);
        }
    }

    // Textarea fields
    if (isset($_POST['ratpac_how_to_use'])) {
        $val = sanitize_textarea_field($_POST['ratpac_how_to_use']);
        update_post_meta($post_id, '_ratpac_how_to_use', $val);
        update_post_meta($post_id, '_how_to_use', $val);
    }

    if (isset($_POST['ratpac_key_ingredients'])) {
        $val = sanitize_textarea_field($_POST['ratpac_key_ingredients']);
        update_post_meta($post_id, '_ratpac_key_ingredients', $val);
        update_post_meta($post_id, '_key_ingredients', $val);
    }
}
add_action('save_post', 'ratpaccheck_save_wc_product_meta');
