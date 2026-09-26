<?php
/**
 * WooCommerce Native Core Setup & Auto-Configuration Engine
 *
 * Implements full WooCommerce theme support, wrapper hooks, SEO plugin
 * compatibility, and automatic zero-config page & menu creation on theme activation.
 *
 * @package RatpacCheck
 * @version 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Declare WooCommerce and Gallery Theme Support
 */
function ratpaccheck_woocommerce_support() {
    add_theme_support('woocommerce', array(
        'thumbnail_image_width'         => 600,
        'single_image_width'            => 800,
        'product_grid'                  => array(
            'default_rows'    => 4,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ));

    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'ratpaccheck_woocommerce_support');

/**
 * Standard WooCommerce Content Wrappers (Clean Luxury Styling)
 */
function ratpaccheck_wc_wrapper_start() {
    ?>
    <section class="min-h-screen bg-[#F6F1EA] py-8 sm:py-12">
        <div class="container mx-auto px-4 sm:px-6 md:px-8 max-w-7xl">
    <?php
}
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
add_action('woocommerce_before_main_content', 'ratpaccheck_wc_wrapper_start', 10);

function ratpaccheck_wc_wrapper_end() {
    ?>
        </div>
    </section>
    <?php
}
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_after_main_content', 'ratpaccheck_wc_wrapper_end', 10);

/**
 * Disable default unstyled WooCommerce sidebar
 */
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

/**
 * Automatic Zero-Config Setup on Theme Activation
 *
 * Automatically creates all required WordPress and WooCommerce pages,
 * configures front page, sets up navigation menu, and establishes shop links.
 */
function ratpaccheck_auto_configure_theme_environment() {
    // 1. Essential Pages List
    $pages = array(
        'home' => array(
            'title'    => 'Home',
            'template' => 'front-page.php',
            'content'  => '',
        ),
        'products' => array(
            'title'    => 'Products',
            'template' => 'page-products.php',
            'content'  => '[ratpaccheck_products]',
            'is_shop'  => true,
        ),
        'collections' => array(
            'title'    => 'Collections',
            'template' => 'page-collections.php',
            'content'  => '',
        ),
        'about' => array(
            'title'    => 'About Us',
            'template' => 'page-about.php',
            'content'  => '',
        ),
        'track-order' => array(
            'title'    => 'Track Order',
            'template' => 'page-track-order.php',
            'content'  => '',
        ),
        'customer-help' => array(
            'title'    => 'Customer Help',
            'template' => 'page-customer-help.php',
            'content'  => '',
        ),
        'cart' => array(
            'title'    => 'Cart',
            'template' => '',
            'content'  => '<!-- wp:woocommerce/cart /-->[woocommerce_cart]',
            'is_cart'  => true,
        ),
        'checkout' => array(
            'title'       => 'Checkout',
            'template'    => 'page-checkout.php',
            'content'     => '<!-- wp:woocommerce/checkout /-->[woocommerce_checkout]',
            'is_checkout' => true,
        ),
        'my-account' => array(
            'title'      => 'My account',
            'template'   => '',
            'content'    => '[woocommerce_my_account]',
            'is_account' => true,
        ),
    );

    $created_page_ids = array();

    foreach ($pages as $slug => $data) {
        $page = get_page_by_path($slug);
        if (!$page) {
            // Check by title
            $page = get_page_by_title($data['title']);
        }

        if (!$page) {
            $page_id = wp_insert_post(array(
                'post_title'     => $data['title'],
                'post_name'      => $slug,
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'post_content'   => $data['content'],
                'comment_status' => 'closed',
            ));
        } else {
            $page_id = $page->ID;
            if ($page->post_status !== 'publish') {
                wp_update_post(array('ID' => $page_id, 'post_status' => 'publish'));
            }
        }

        if ($page_id && !is_wp_error($page_id)) {
            $created_page_ids[$slug] = $page_id;
            if (!empty($data['template'])) {
                update_post_meta($page_id, '_wp_page_template', $data['template']);
            }

            // Bind WooCommerce options
            if (!empty($data['is_shop'])) {
                update_option('woocommerce_shop_page_id', $page_id);
            }
            if (!empty($data['is_cart'])) {
                update_option('woocommerce_cart_page_id', $page_id);
            }
            if (!empty($data['is_checkout'])) {
                update_option('woocommerce_checkout_page_id', $page_id);
            }
            if (!empty($data['is_account'])) {
                update_option('woocommerce_myaccount_page_id', $page_id);
            }
        }
    }

    // 2. Configure Front Page Displays
    if (isset($created_page_ids['home'])) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $created_page_ids['home']);
    }

    // 3. Configure Navigation Menu
    $menu_name     = 'Primary Header Menu';
    $menu_location = 'primary';
    $menu_exists   = wp_get_nav_menu_object($menu_name);

    if (!$menu_exists) {
        $menu_id = wp_create_nav_menu($menu_name);
        if (!is_wp_error($menu_id)) {
            $menu_items = array(
                array('title' => 'Home',        'url' => home_url('/')),
                array('title' => 'Products',    'url' => home_url('/products')),
                array('title' => 'Collections', 'url' => home_url('/collections')),
                array('title' => 'About Us',    'url' => home_url('/about')),
                array('title' => 'Track Order', 'url' => home_url('/track-order')),
            );

            foreach ($menu_items as $order => $item) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title'   => $item['title'],
                    'menu-item-url'     => $item['url'],
                    'menu-item-status'  => 'publish',
                    'menu-item-type'    => 'custom',
                    'menu-item-position'=> $order + 1,
                ));
            }

            $locations = get_theme_mod('nav_menu_locations');
            if (!is_array($locations)) {
                $locations = array();
            }
            $locations[$menu_location] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }

    // 4. Create Standard Promotional Coupons if none exist
    if (class_exists('WC_Coupon')) {
        $default_coupons = array(
            'FIRST10'  => array('type' => 'percent', 'amount' => 10, 'desc' => '10% Welcome Discount'),
            'BEAUTY20' => array('type' => 'percent', 'amount' => 20, 'desc' => '20% Special Promotion'),
        );
        foreach ($default_coupons as $code => $c_data) {
            $existing_id = wc_get_coupon_id_by_code($code);
            if (!$existing_id) {
                try {
                    $coupon = new WC_Coupon();
                    $coupon->set_code($code);
                    $coupon->set_discount_type($c_data['type']);
                    $coupon->set_amount($c_data['amount']);
                    $coupon->set_individual_use(false);
                    $coupon->set_description($c_data['desc']);
                    $coupon->save();
                } catch (Exception $e) {}
            }
        }
    }

    // Flush rewrites
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'ratpaccheck_auto_configure_theme_environment', 10);
// Also run on admin init if front page or shop page is not configured yet
function ratpaccheck_ensure_core_pages_configured() {
    if (!get_option('page_on_front') || get_option('page_on_front') == 0) {
        ratpaccheck_auto_configure_theme_environment();
    }
}
add_action('admin_init', 'ratpaccheck_ensure_core_pages_configured', 5);

/**
 * SEO & Image Optimization Plugin Support
 */
function ratpaccheck_seo_image_support() {
    // Standard Title Tag
    add_theme_support('title-tag');

    // Post Thumbnails
    add_theme_support('post-thumbnails');

    // HTML5 markup support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));

    // Selective Refresh for Widgets
    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'ratpaccheck_seo_image_support');

/**
 * Output Clean Schema.org and Open Graph Fallbacks ONLY if no SEO plugin is active
 */
function ratpaccheck_seo_fallbacks() {
    // If Yoast, Rank Math, AIOSEO, or SEOPress is active, do not output duplicate meta
    if (
        defined('WPSEO_VERSION') ||
        class_exists('RankMath') ||
        defined('AIOSEO_VERSION') ||
        function_exists('seopress_init')
    ) {
        return;
    }

    $site_name = get_bloginfo('name');
    $title     = wp_get_document_title();
    $desc      = get_bloginfo('description') ?: 'Science-backed skincare and haircare formulated by creators, trusted by millions.';
    $url       = esc_url(home_url(add_query_arg(array(), $GLOBALS['wp']->request ?? '')));
    ?>
    <!-- RatpacCheck SEO Fallback Meta -->
    <meta name="description" content="<?php echo esc_attr($desc); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr($site_name); ?>">
    <meta property="og:type" content="<?php echo is_single() ? 'product' : 'website'; ?>">
    <meta property="og:title" content="<?php echo esc_attr($title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($desc); ?>">
    <meta property="og:url" content="<?php echo esc_url($url); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr($title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($desc); ?>">
    <?php
}
add_action('wp_head', 'ratpaccheck_seo_fallbacks', 5);
