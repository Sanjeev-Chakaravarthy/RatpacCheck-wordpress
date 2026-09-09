<?php
/**
 * Standalone Local WordPress Preview Server
 * Run with: php -S localhost:8000 preview.php
 *
 * Emulates the minimal WordPress environment to allow instant browser preview
 * of the converted theme without needing MySQL or a full WordPress install.
 */

define('ABSPATH', __DIR__ . '/wordpress-theme/ratpaccheck/');

// ── Asset routing for PHP built-in web server ──
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Check possible locations inside theme directory
$clean_path = ltrim($uri, '/');
$candidates = [
    __DIR__ . '/wordpress-theme/ratpaccheck/' . $clean_path,
    __DIR__ . '/wordpress-theme/ratpaccheck/assets/' . preg_replace('#^assets/#', '', $clean_path),
    __DIR__ . '/wordpress-theme/ratpaccheck/assets/images/' . preg_replace('#^(assets/)?(images/)?#', '', $clean_path),
    __DIR__ . '/wordpress-theme/ratpaccheck/assets/' . preg_replace('#^(images/)?#', 'images/', $clean_path),
];

$static_file = null;
foreach ($candidates as $candidate) {
    if (file_exists($candidate) && !is_dir($candidate)) {
        $static_file = $candidate;
        break;
    }
}

if ($static_file && file_exists($static_file)) {
    $ext = strtolower(pathinfo($static_file, PATHINFO_EXTENSION));
    $mimes = [
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'svg'   => 'image/svg+xml',
        'avif'  => 'image/avif',
        'webp'  => 'image/webp',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'otf'   => 'font/otf',
        'ttf'   => 'font/ttf',
        'ico'   => 'image/x-icon',
    ];
    header('Content-Type: ' . ($mimes[$ext] ?? 'application/octet-stream'));
    header('Content-Length: ' . filesize($static_file));
    header('Cache-Control: no-cache, must-revalidate');
    readfile($static_file);
    exit;
}

// ── Mock WordPress Core API Functions for Preview ──
if (!function_exists('home_url')) {
    function home_url($path = '/') {
        return 'http://' . $_SERVER['HTTP_HOST'] . '/' . ltrim($path, '/');
    }
}
if (!function_exists('get_template_directory_uri')) {
    function get_template_directory_uri() {
        return 'http://' . $_SERVER['HTTP_HOST'];
    }
}
if (!function_exists('get_template_directory')) {
    function get_template_directory() {
        return __DIR__ . '/wordpress-theme/ratpaccheck';
    }
}
if (!function_exists('get_stylesheet_uri')) {
    function get_stylesheet_uri() {
        return 'http://' . $_SERVER['HTTP_HOST'] . '/style.css';
    }
}
if (!function_exists('language_attributes')) {
    function language_attributes() {
        echo 'lang="en"';
    }
}
if (!function_exists('bloginfo')) {
    function bloginfo($show = '') {
        if ($show === 'charset') echo 'UTF-8';
        elseif ($show === 'name') echo 'RatpacCheck';
        else echo '';
    }
}
if (!function_exists('body_class')) {
    function body_class($class = '') {
        echo 'class="' . esc_attr($class) . '"';
    }
}
if (!function_exists('post_class')) {
    function post_class($class = '') {
        echo 'class="' . esc_attr($class) . '"';
    }
}
if (!function_exists('wp_head')) {
    function wp_head() {
        echo '<title>RatpacCheck — Science-Backed Haircare & Skincare</title>' . "\n";
        echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
        echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
        echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap">' . "\n";
        echo '<link rel="stylesheet" href="' . home_url('/assets/css/main.css?v=' . filemtime(__DIR__ . '/wordpress-theme/ratpaccheck/assets/css/main.css')) . '">' . "\n";
        echo '<link rel="stylesheet" href="' . home_url('/style.css?v=' . filemtime(__DIR__ . '/wordpress-theme/ratpaccheck/style.css')) . '">' . "\n";
    }
}
if (!function_exists('wp_footer')) {
    function wp_footer() {
        $data = json_encode([
            'homeUrl' => home_url('/'),
            'themeUrl' => get_template_directory_uri(),
            'allProducts' => ratpaccheck_get_all_products()
        ]);
        echo '<script>window.RatpacCheckData = ' . $data . ';</script>' . "\n";
        echo '<script src="' . home_url('/assets/js/theme.js?v=' . filemtime(__DIR__ . '/wordpress-theme/ratpaccheck/assets/js/theme.js')) . '"></script>' . "\n";
    }
}
if (!function_exists('wp_body_open')) {
    function wp_body_open() {}
}
if (!function_exists('has_nav_menu')) {
    function has_nav_menu() { return false; }
}
if (!function_exists('wp_nav_menu')) {
    function wp_nav_menu() { return false; }
}
if (!function_exists('get_header')) {
    function get_header() {
        require __DIR__ . '/wordpress-theme/ratpaccheck/header.php';
    }
}
if (!function_exists('get_footer')) {
    function get_footer() {
        require __DIR__ . '/wordpress-theme/ratpaccheck/footer.php';
    }
}
if (!function_exists('esc_html')) {
    function esc_html($t) { return htmlspecialchars($t ?? '', ENT_QUOTES, 'UTF-8'); }
}
if (!function_exists('esc_attr')) {
    function esc_attr($t) { return htmlspecialchars($t ?? '', ENT_QUOTES, 'UTF-8'); }
}
if (!function_exists('esc_url')) {
    function esc_url($t) { return htmlspecialchars($t ?? '', ENT_QUOTES, 'UTF-8'); }
}
if (!function_exists('sanitize_text_field')) {
    function sanitize_text_field($t) { return trim(strip_tags($t ?? '')); }
}
if (!function_exists('wp_unslash')) {
    function wp_unslash($t) { return stripslashes($t ?? ''); }
}
if (!function_exists('__')) {
    function __($text, $domain = 'default') { return $text; }
}
if (!function_exists('_e')) {
    function _e($text, $domain = 'default') { echo $text; }
}
if (!function_exists('_x')) {
    function _x($text, $context, $domain = 'default') { return $text; }
}
if (!function_exists('esc_html__')) {
    function esc_html__($text, $domain = 'default') { return htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); }
}
if (!function_exists('add_action')) {
    function add_action() {}
}
if (!function_exists('add_theme_support')) {
    function add_theme_support() {}
}
if (!function_exists('register_nav_menus')) {
    function register_nav_menus() {}
}
if (!function_exists('register_post_type')) {
    function register_post_type() {}
}
if (!function_exists('register_taxonomy')) {
    function register_taxonomy() {}
}
if (!function_exists('add_meta_box')) {
    function add_meta_box() {}
}
if (!function_exists('load_theme_textdomain')) {
    function load_theme_textdomain() {}
}

// Load Theme Functions
require_once __DIR__ . '/wordpress-theme/ratpaccheck/functions.php';

// ── Route request to appropriate template ──
$path = trim($uri, '/');

if ($path === '' || $path === 'index.php') {
    require __DIR__ . '/wordpress-theme/ratpaccheck/front-page.php';
} elseif ($path === 'products' || $path === 'products/') {
    require __DIR__ . '/wordpress-theme/ratpaccheck/page-products.php';
} elseif ($path === 'collections' || $path === 'collections/') {
    require __DIR__ . '/wordpress-theme/ratpaccheck/page-collections.php';
} elseif (preg_match('#^collections/([^/]+)#', $path, $m)) {
    $_GET['category'] = $m[1];
    require __DIR__ . '/wordpress-theme/ratpaccheck/page-collections.php';
} elseif ($path === 'about' || $path === 'about/') {
    require __DIR__ . '/wordpress-theme/ratpaccheck/page-about.php';
} elseif ($path === 'customer-help' || $path === 'customer-help/') {
    require __DIR__ . '/wordpress-theme/ratpaccheck/page-customer-help.php';
} elseif ($path === 'track-order' || $path === 'track-order/') {
    require __DIR__ . '/wordpress-theme/ratpaccheck/page-track-order.php';
} elseif ($path === 'checkout' || $path === 'checkout/') {
    require __DIR__ . '/wordpress-theme/ratpaccheck/page-checkout.php';
} elseif ($path === 'product-detail' || $path === 'product-detail/') {
    require __DIR__ . '/wordpress-theme/ratpaccheck/single-product.php';
} elseif (preg_match('#^product/([0-9]+)#', $path, $m)) {
    $_GET['product_id'] = intval($m[1]);
    require __DIR__ . '/wordpress-theme/ratpaccheck/single-product.php';
} else {
    http_response_code(404);
    require __DIR__ . '/wordpress-theme/ratpaccheck/404.php';
}
