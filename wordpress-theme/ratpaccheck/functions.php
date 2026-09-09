<?php
/**
 * RatpacCheck Theme Functions and Definitions
 * 100% Native WordPress Theme Architecture
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// ── Include Master Product Data & Helpers ──
require_once get_template_directory() . '/inc/products-data.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function ratpaccheck_setup() {
    // Make theme available for translation.
    load_theme_textdomain('ratpaccheck', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Enable Custom Logo support.
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Register navigation menus.
    register_nav_menus(array(
        'primary'         => esc_html__('Primary Header Navigation', 'ratpaccheck'),
        'footer_company'  => esc_html__('Footer Company Links', 'ratpaccheck'),
        'footer_help'     => esc_html__('Footer Help Links', 'ratpaccheck'),
        'footer_policies' => esc_html__('Footer Policies Links', 'ratpaccheck'),
    ));
}
add_action('after_setup_theme', 'ratpaccheck_setup');

/**
 * Register Custom Post Type for Products in WordPress Admin
 */
function ratpaccheck_register_post_types() {
    $labels = array(
        'name'                  => _x('Products', 'Post type general name', 'ratpaccheck'),
        'singular_name'         => _x('Product', 'Post type singular name', 'ratpaccheck'),
        'menu_name'             => _x('Products', 'Admin Menu text', 'ratpaccheck'),
        'name_admin_bar'        => _x('Product', 'Add New on Toolbar', 'ratpaccheck'),
        'add_new'               => __('Add New Product', 'ratpaccheck'),
        'add_new_item'          => __('Add New Product', 'ratpaccheck'),
        'new_item'              => __('New Product', 'ratpaccheck'),
        'edit_item'             => __('Edit Product', 'ratpaccheck'),
        'view_item'             => __('View Product', 'ratpaccheck'),
        'all_items'             => __('All Products', 'ratpaccheck'),
        'search_items'          => __('Search Products', 'ratpaccheck'),
        'not_found'             => __('No products found.', 'ratpaccheck'),
        'not_found_in_trash'    => __('No products found in Trash.', 'ratpaccheck'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'product-item'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-cart',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true,
    );

    register_post_type('ratpac_product', $args);

    // Register Category Taxonomy (Hair, Skin)
    register_taxonomy('product_category', 'ratpac_product', array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'          => __('Categories', 'ratpaccheck'),
            'singular_name' => __('Category', 'ratpaccheck'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'product-category'),
    ));

    // Register Concern Taxonomy (Acne, Hairfall, Dandruff, etc.)
    register_taxonomy('product_concern', 'ratpac_product', array(
        'hierarchical'      => false,
        'labels'            => array(
            'name'          => __('Concerns', 'ratpaccheck'),
            'singular_name' => __('Concern', 'ratpaccheck'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'product-concern'),
    ));
}
add_action('init', 'ratpaccheck_register_post_types');

/**
 * Add Meta Boxes for Product Fields in WP Admin
 */
function ratpaccheck_add_product_meta_boxes() {
    add_meta_box(
        'ratpac_product_details',
        __('Product E-Commerce Details', 'ratpaccheck'),
        'ratpaccheck_render_product_meta_box',
        'ratpac_product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ratpaccheck_add_product_meta_boxes');

function ratpaccheck_render_product_meta_box($post) {
    wp_nonce_field('ratpaccheck_save_meta', 'ratpaccheck_meta_nonce');
    $price = get_post_meta($post->ID, '_price', true);
    $original_price = get_post_meta($post->ID, '_original_price', true);
    $subtitle = get_post_meta($post->ID, '_subtitle', true);
    $badge = get_post_meta($post->ID, '_badge', true);
    $rating = get_post_meta($post->ID, '_rating', true) ?: '4.8';
    $reviews = get_post_meta($post->ID, '_reviews', true) ?: '150';
    ?>
    <table class="form-table">
        <tr>
            <th><label for="_price"><?php _e('Price (₹)', 'ratpaccheck'); ?></label></th>
            <td><input type="number" id="_price" name="_price" value="<?php echo esc_attr($price); ?>" class="regular-text" placeholder="599" /></td>
        </tr>
        <tr>
            <th><label for="_original_price"><?php _e('Original / MRP Price (₹)', 'ratpaccheck'); ?></label></th>
            <td><input type="number" id="_original_price" name="_original_price" value="<?php echo esc_attr($original_price); ?>" class="regular-text" placeholder="799" /></td>
        </tr>
        <tr>
            <th><label for="_subtitle"><?php _e('Subtitle', 'ratpaccheck'); ?></label></th>
            <td><input type="text" id="_subtitle" name="_subtitle" value="<?php echo esc_attr($subtitle); ?>" class="regular-text" placeholder="Radiance & Brightening" /></td>
        </tr>
        <tr>
            <th><label for="_badge"><?php _e('Badge', 'ratpaccheck'); ?></label></th>
            <td><input type="text" id="_badge" name="_badge" value="<?php echo esc_attr($badge); ?>" class="regular-text" placeholder="Best Seller / New Launch" /></td>
        </tr>
        <tr>
            <th><label for="_rating"><?php _e('Rating (1.0 to 5.0)', 'ratpaccheck'); ?></label></th>
            <td><input type="text" id="_rating" name="_rating" value="<?php echo esc_attr($rating); ?>" class="small-text" placeholder="4.8" /></td>
        </tr>
        <tr>
            <th><label for="_reviews"><?php _e('Total Reviews Count', 'ratpaccheck'); ?></label></th>
            <td><input type="number" id="_reviews" name="_reviews" value="<?php echo esc_attr($reviews); ?>" class="small-text" placeholder="150" /></td>
        </tr>
    </table>
    <?php
}

function ratpaccheck_save_product_meta($post_id) {
    if (!isset($_POST['ratpaccheck_meta_nonce']) || !wp_verify_nonce($_POST['ratpaccheck_meta_nonce'], 'ratpaccheck_save_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array('_price', '_original_price', '_subtitle', '_badge', '_rating', '_reviews');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_ratpac_product', 'ratpaccheck_save_product_meta');

/**
 * Enqueue scripts and styles.
 */
function ratpaccheck_scripts() {
    // Enqueue Google Fonts (Noto Serif & Instrument Sans)
    wp_enqueue_style('ratpaccheck-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap', array(), null);

    // Enqueue Compiled Tailwind CSS
    wp_enqueue_style('ratpaccheck-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');

    // Enqueue Theme Stylesheet Header
    wp_enqueue_style('ratpaccheck-style', get_stylesheet_uri(), array('ratpaccheck-main'), '1.0.0');

    // Enqueue Interactive Vanilla JS
    wp_enqueue_script('ratpaccheck-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.0.0', true);

    // Pass data to JS
    wp_localize_script('ratpaccheck-theme', 'RatpacCheckData', array(
        'homeUrl'   => home_url('/'),
        'themeUrl'  => get_template_directory_uri(),
        'allProducts' => ratpaccheck_get_all_products(),
    ));
}
add_action('wp_enqueue_scripts', 'ratpaccheck_scripts');

/**
 * Format Indian Rupee currency
 */
function ratpaccheck_format_price($amount) {
    return '₹' . number_format(floatval($amount), 0);
}

/**
 * Render 5-star rating SVG block
 */
function ratpaccheck_render_stars($rating = 5.0) {
    $html = '<div class="flex items-center gap-0.5 text-[#C9A84C]">';
    $full = floor($rating);
    for ($i = 0; $i < 5; $i++) {
        if ($i < $full) {
            $html .= '<svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
        } else {
            $html .= '<svg class="w-3.5 h-3.5 text-gray-300 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>';
        }
    }
    $html .= '<span class="ml-1.5 text-xs font-semibold text-gray-800">' . number_format($rating, 1) . '</span>';
    $html .= '</div>';
    return $html;
}

/**
 * Render standard Product Card
 */
function ratpaccheck_render_product_card($product, $extra_classes = '') {
    $id = isset($product['id']) ? intval($product['id']) : 0;
    $name = isset($product['name']) ? esc_html($product['name']) : '';
    $subtitle = isset($product['subtitle']) ? esc_html($product['subtitle']) : '';
    $price = isset($product['price']) ? intval($product['price']) : 0;
    $original_price = isset($product['originalPrice']) ? intval($product['originalPrice']) : 0;
    $image = isset($product['image']) ? ratpaccheck_img_url($product['image']) : '';
    $rating = isset($product['rating']) ? floatval($product['rating']) : 4.8;
    $reviews = isset($product['reviews']) ? intval($product['reviews']) : 120;
    $badge = isset($product['badge']) ? esc_html($product['badge']) : '';
    $url = ratpaccheck_product_url($id);
    $discount_pct = ($original_price > $price) ? round((($original_price - $price) / $original_price) * 100) : 0;

    ob_start();
    ?>
    <a class="block w-full h-full" href="<?php echo esc_url($url); ?>" style="text-decoration:none;color:inherit;">
        <div class="group product-card h-full card-padding <?php echo esc_attr($extra_classes); ?>" style="cursor:pointer;width:100%;" data-product-id="<?php echo esc_attr($id); ?>">
            <!-- Square Image Frame -->
            <div class="square-media-frame">
                <img alt="<?php echo esc_attr($name); ?>" class="square-media group-hover:scale-110" src="<?php echo esc_url($image); ?>" loading="lazy" style="position:absolute;height:100%;width:100%;inset:0;color:transparent;transition:opacity 0.35s;opacity:1;" />
                <div class="product-card-badge-frame">
                    <div class="product-card-badge-row">
                        <span><?php if ($badge) : ?><span class="product-card-badge"><?php echo $badge; ?></span><?php endif; ?></span>
                        <?php if ($discount_pct > 0) : ?>
                            <span class="product-card-discount">-<?php echo $discount_pct; ?>%</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- Card Info Stack -->
            <div class="product-card-stack">
                <div style="display:flex;flex-direction:column;gap:4px;">
                    <h3 class="product-card-title" style="position:relative;display:inline-block;cursor:pointer;">
                        <?php echo $name; ?>
                        <span style="position:absolute;left:0;bottom:-2px;height:1px;background-color:#1A1A1A;width:0%;transition:width 0.3s;"></span>
                    </h3>
                    <p class="product-card-subtitle"><?php echo $subtitle; ?></p>
                </div>
                <div style="display:flex;flex-direction:column;gap:8px;padding-top:8px;">
                    <!-- Stars + Review Count -->
                    <div style="display:flex;align-items:center;gap:6px;">
                        <div style="display:flex;align-items:center;gap:2px;">
                            <?php for ($i = 0; $i < 5; $i++) : ?>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="#C9A84C" stroke="#C9A84C" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
                            <?php endfor; ?>
                        </div>
                        <span style="font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:11px;color:#8B8178;"><?php echo number_format($rating, 1); ?> (<?php echo number_format($reviews); ?>)</span>
                    </div>
                    <!-- Price -->
                    <div style="display:flex;align-items:center;gap:8px;">
                        <span class="product-price"><?php echo ratpaccheck_format_price($price); ?></span>
                        <?php if ($original_price > $price) : ?>
                            <span style="font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:13px;color:#AAA5A0;text-decoration:line-through;"><?php echo ratpaccheck_format_price($original_price); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Add to Cart Button -->
                <button
                    type="button"
                    class="btn-add-to-cart"
                    style="margin-top:10px;width:100%;padding:12px 0;background-color:#1A1A1A;color:#fff;border:none;border-radius:12px;font-family:Metropolis,'Helvetica Neue',Arial,sans-serif;font-size:13px;font-weight:600;letter-spacing:0.03em;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:background-color 0.2s;"
                    data-id="<?php echo esc_attr($id); ?>"
                    data-name="<?php echo esc_attr($name); ?>"
                    data-price="<?php echo esc_attr($price); ?>"
                    data-original-price="<?php echo esc_attr($original_price); ?>"
                    data-image="<?php echo esc_url($image); ?>"
                    data-subtitle="<?php echo esc_attr($subtitle); ?>"
                    onclick="event.preventDefault();event.stopPropagation();"
                >
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
                    Add to Cart
                </button>
            </div>
        </div>
    </a>
    <?php
    return ob_get_clean();
}
