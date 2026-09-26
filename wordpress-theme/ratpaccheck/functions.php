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

// ── Include WooCommerce & Modern Authentication Modules ──
require_once get_template_directory() . '/inc/admin-login.php';
require_once get_template_directory() . '/inc/woocommerce-setup.php';
require_once get_template_directory() . '/inc/woocommerce-meta.php';
require_once get_template_directory() . '/inc/woocommerce-importer.php';
require_once get_template_directory() . '/inc/woocommerce-account.php';
require_once get_template_directory() . '/inc/woocommerce-cart.php';

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
    $theme_version = '1.1.0';

    // Enqueue Google Fonts (Noto Serif & Instrument Sans)
    wp_enqueue_style('ratpaccheck-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap', array(), null);

    // Enqueue Compiled Tailwind CSS
    wp_enqueue_style('ratpaccheck-main', get_template_directory_uri() . '/assets/css/main.css', array(), $theme_version);

    // Enqueue Theme Stylesheet Header
    wp_enqueue_style('ratpaccheck-style', get_stylesheet_uri(), array('ratpaccheck-main'), $theme_version);

    // Enqueue Interactive Vanilla JS
    wp_enqueue_script('ratpaccheck-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), $theme_version, true);

    // Pass data to JS
    wp_localize_script('ratpaccheck-theme', 'RatpacCheckData', array(
        'homeUrl'     => home_url('/'),
        'themeUrl'    => get_template_directory_uri(),
        'allProducts' => ratpaccheck_get_all_products(),
        'ajaxUrl'     => admin_url('admin-ajax.php'),
        'cartNonce'   => wp_create_nonce('ratpaccheck_cart_nonce'),
        'wcActive'    => class_exists('WooCommerce'),
        'isLoggedIn'  => is_user_logged_in(),
        'accountUrl'  => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account/'),
        'checkoutUrl' => function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : home_url('/checkout/'),
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
    <div class="group product-card h-full card-padding flex flex-col justify-between <?php echo esc_attr($extra_classes); ?>" style="width:100%;" data-product-id="<?php echo esc_attr($id); ?>">
        <a class="block w-full flex-1" href="<?php echo esc_url($url); ?>" style="text-decoration:none;color:inherit;cursor:pointer;">
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
                    <h3 class="product-card-title" style="position:relative;display:inline-block;">
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
            </div>
        </a>
        <!-- Add to Cart Button Outside <a> -->
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
            onclick="event.stopPropagation();if(window.ratpaccheck_handle_add_to_cart){window.ratpaccheck_handle_add_to_cart(event,this);}"
        >
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
            <span>Add to Cart</span>
        </button>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * ─────────────────────────────────────────────────────────────────────────────
 * ROUTING, REWRITE RULES & TEMPLATE DISPATCH ARCHITECTURE
 * ─────────────────────────────────────────────────────────────────────────────
 */

/**
 * Register Custom Query Variables
 */
function ratpaccheck_register_query_vars($vars) {
    $vars[] = 'product_detail';
    $vars[] = 'product_id';
    $vars[] = 'category';
    return $vars;
}
add_filter('query_vars', 'ratpaccheck_register_query_vars');

/**
 * Register WordPress Rewrite Rules for Custom Endpoints
 */
function ratpaccheck_add_rewrite_rules() {
    add_rewrite_tag('%product_detail%', '([^&]+)');
    add_rewrite_tag('%product_id%', '([0-9]+)');

    // Rule: /product-detail/?product_id=104 or /product-detail/
    add_rewrite_rule('^product-detail/?$', 'index.php?product_detail=1', 'top');

    // Rule: /product/{id}/ (e.g. /product/104/)
    add_rewrite_rule('^product/([0-9]+)/?$', 'index.php?product_detail=1&product_id=$matches[1]', 'top');

    // Rule: /collections/{category}/ (e.g. /collections/hair/)
    add_rewrite_rule('^collections/([^/]+)/?$', 'index.php?pagename=collections&category=$matches[1]', 'top');
}
add_action('init', 'ratpaccheck_add_rewrite_rules');

/**
 * Ensure CPT template hierarchy uses single-ratpac_product.php or single-product.php
 */
function ratpaccheck_cpt_template_include($template) {
    if (is_singular('ratpac_product')) {
        $cpt_tpl = get_template_directory() . '/single-ratpac_product.php';
        if (file_exists($cpt_tpl)) {
            return $cpt_tpl;
        }
        $prod_tpl = get_template_directory() . '/single-product.php';
        if (file_exists($prod_tpl)) {
            return $prod_tpl;
        }
    }
    return $template;
}
add_filter('template_include', 'ratpaccheck_cpt_template_include', 20);

/**
 * Prevent WordPress canonical redirects or early 404s on known theme routes
 */
function ratpaccheck_pre_template_redirect() {
    global $wp_query;
    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = trim(strtok($request_uri, '?'), '/');
    $site_path = trim(parse_url(home_url(), PHP_URL_PATH) ?? '', '/');
    if ($site_path && strpos($path, $site_path) === 0) {
        $path = trim(substr($path, strlen($site_path)), '/');
    }

    $target_routes = array(
        'product-detail', 'about', 'products', 'collections', 'checkout', 'customer-help', 'track-order'
    );
    if (in_array($path, $target_routes, true) || preg_match('#^(product/[0-9]+|collections/[^/]+)$#', $path) || get_query_var('product_detail')) {
        if ($wp_query && $wp_query->is_404) {
            $wp_query->is_404 = false;
        }
    }
}
add_action('template_redirect', 'ratpaccheck_pre_template_redirect', 1);

/**
 * Universal Template & Virtual Route Dispatcher
 *
 * Ensures /product-detail/, /product/{id}, and all core theme pages (/about/,
 * /products/, /collections/, /checkout/, /customer-help/, /track-order/)
 * resolve directly to their PHP templates with HTTP 200 even on a brand-new,
 * empty WordPress installation without requiring manual page creation.
 */
function ratpaccheck_template_router($template) {
    global $wp_query;

    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    $path = trim(strtok($request_uri, '?'), '/');

    // Strip subfolder if WordPress is installed in a subdirectory
    $site_path = trim(parse_url(home_url(), PHP_URL_PATH) ?? '', '/');
    if ($site_path && strpos($path, $site_path) === 0) {
        $path = trim(substr($path, strlen($site_path)), '/');
    }

    $product_detail_var = function_exists('get_query_var') ? get_query_var('product_detail') : false;

    // 1. Route: Product Detail (/product-detail/ or query var product_detail or /product/{id})
    if ($product_detail_var || $path === 'product-detail' || preg_match('#^product/([0-9]+)$#', $path, $m)) {
        if (!empty($m[1])) {
            $_GET['product_id'] = intval($m[1]);
            set_query_var('product_id', intval($m[1]));
        }
        if ($wp_query) {
            $wp_query->is_404 = false;
            $wp_query->is_single = true;
            $wp_query->is_page = false;
        }
        status_header(200);
        $single_prod = get_template_directory() . '/single-product.php';
        if (file_exists($single_prod)) {
            return $single_prod;
        }
        $single_ratpac = get_template_directory() . '/single-ratpac_product.php';
        if (file_exists($single_ratpac)) {
            return $single_ratpac;
        }
    }

    // 2. Route: Collections sub-categories (/collections/hair, /collections/skin)
    if (preg_match('#^collections/([^/]+)$#', $path, $m)) {
        $_GET['category'] = sanitize_text_field($m[1]);
        set_query_var('category', sanitize_text_field($m[1]));
        if ($wp_query) {
            $wp_query->is_404 = false;
            $wp_query->is_page = true;
        }
        status_header(200);
        $col_tpl = get_template_directory() . '/page-collections.php';
        if (file_exists($col_tpl)) {
            return $col_tpl;
        }
    }

    // 3. Fallback virtual routes if WP page does not exist in DB (prevents 404 on fresh installs)
    $virtual_pages = array(
        'about'         => '/page-about.php',
        'products'      => '/page-products.php',
        'collections'   => '/page-collections.php',
        'checkout'      => '/page-checkout.php',
        'customer-help' => '/page-customer-help.php',
        'track-order'   => '/page-track-order.php',
    );

    if (isset($virtual_pages[$path])) {
        $target_file = get_template_directory() . $virtual_pages[$path];
        if (file_exists($target_file)) {
            if ($wp_query) {
                $wp_query->is_404 = false;
                $wp_query->is_page = true;
            }
            status_header(200);
            return $target_file;
        }
    }

    return $template;
}
add_filter('template_include', 'ratpaccheck_template_router', 99);

/**
 * Safely find a page by its post_name (slug) across all WP versions
 */
function ratpaccheck_get_page_by_slug($slug) {
    $pages = get_posts(array(
        'name'        => $slug,
        'post_type'   => 'page',
        'post_status' => 'any',
        'numberposts' => 1,
    ));
    return !empty($pages) ? $pages[0] : null;
}

/**
 * Programmatically create required theme pages in the WordPress database
 * (Runs safely on theme activation or one-time admin setup)
 */
function ratpaccheck_ensure_default_pages() {
    $default_pages = array(
        'about' => array(
            'title'    => 'About Us',
            'template' => 'page-about.php',
        ),
        'products' => array(
            'title'    => 'Products Catalog',
            'template' => 'page-products.php',
        ),
        'collections' => array(
            'title'    => 'Collections',
            'template' => 'page-collections.php',
        ),
        'checkout' => array(
            'title'    => 'Checkout',
            'template' => 'page-checkout.php',
        ),
        'customer-help' => array(
            'title'    => 'Customer Help & FAQs',
            'template' => 'page-customer-help.php',
        ),
        'track-order' => array(
            'title'    => 'Track Order',
            'template' => 'page-track-order.php',
        ),
        'product-detail' => array(
            'title'    => 'Product Detail',
            'template' => 'single-product.php',
        ),
    );

    foreach ($default_pages as $slug => $data) {
        $existing = ratpaccheck_get_page_by_slug($slug);
        if (!$existing) {
            $page_id = wp_insert_post(array(
                'post_title'     => $data['title'],
                'post_name'      => $slug,
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
            ));
            if ($page_id && !is_wp_error($page_id) && !empty($data['template'])) {
                update_post_meta($page_id, '_wp_page_template', $data['template']);
            }
        } else {
            // Ensure template is assigned if missing
            $current_tpl = get_post_meta($existing->ID, '_wp_page_template', true);
            if (empty($current_tpl) || $current_tpl === 'default') {
                update_post_meta($existing->ID, '_wp_page_template', $data['template']);
            }
        }
    }
}

/**
 * Run safe auto-setup on theme switch
 */
function ratpaccheck_on_theme_activation() {
    ratpaccheck_ensure_default_pages();
    ratpaccheck_add_rewrite_rules();
    flush_rewrite_rules(false);
    update_option('ratpaccheck_pages_installed_v2', '1.0');
}
add_action('after_switch_theme', 'ratpaccheck_on_theme_activation');

/**
 * One-time check for fresh deployments or manual setup trigger
 */
function ratpaccheck_check_setup() {
    if (get_option('ratpaccheck_pages_installed_v2') !== '1.0') {
        ratpaccheck_ensure_default_pages();
        ratpaccheck_add_rewrite_rules();
        flush_rewrite_rules(false);
        update_option('ratpaccheck_pages_installed_v2', '1.0');
    }
    // Allow admin to re-run setup via ?ratpaccheck_setup_pages=1
    if (isset($_GET['ratpaccheck_setup_pages']) && current_user_can('manage_options')) {
        ratpaccheck_ensure_default_pages();
        ratpaccheck_add_rewrite_rules();
        flush_rewrite_rules(false);
        update_option('ratpaccheck_pages_installed_v2', '1.0');
    }
}
add_action('init', 'ratpaccheck_check_setup', 20);

