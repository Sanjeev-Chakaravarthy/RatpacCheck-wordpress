<?php
/**
 * Template Name: Collections
 * Description: Collections overview and routing — 100% Matching Vercel.
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$category = isset($_GET['category']) ? ucfirst(strtolower(sanitize_text_field($_GET['category']))) : '';

// Vercel routes /collections/hair -> /products?concern=Hair and /collections/skin -> /products?concern=Skin
if ($category === 'Hair') {
    if (!headers_sent()) {
        $redirect_url = function_exists('home_url') ? home_url('/products?concern=Hair') : '?page=products&concern=Hair';
        header('Location: ' . $redirect_url);
        exit;
    } else {
        $redirect_url = function_exists('home_url') ? home_url('/products?concern=Hair') : '?page=products&concern=Hair';
        echo '<script>window.location.href="' . esc_url($redirect_url) . '";</script>';
        exit;
    }
} elseif ($category === 'Skin') {
    if (!headers_sent()) {
        $redirect_url = function_exists('home_url') ? home_url('/products?concern=Skin') : '?page=products&concern=Skin';
        header('Location: ' . $redirect_url);
        exit;
    } else {
        $redirect_url = function_exists('home_url') ? home_url('/products?concern=Skin') : '?page=products&concern=Skin';
        echo '<script>window.location.href="' . esc_url($redirect_url) . '";</script>';
        exit;
    }
}

get_header();

// Collections definition matching Vercel src/app/collections/page.tsx
$collections = array(
    array(
        'name' => 'Skin',
        'image' => ratpaccheck_img_url('skin-care.jpeg'),
        'href' => home_url('/products?concern=Skin'),
    ),
    array(
        'name' => 'Hair',
        'image' => ratpaccheck_img_url('hair-care.jpg'),
        'href' => home_url('/products?concern=Hair'),
    ),
    array(
        'name' => 'New Launches',
        'image' => ratpaccheck_img_url('Multi-functional (Face serum 10%).jpeg'),
        'href' => home_url('/products'),
    ),
    array(
        'name' => 'Best Sellers',
        'image' => ratpaccheck_img_url('Deep glow (Face serum).jpeg'),
        'href' => home_url('/products'),
    ),
    array(
        'name' => 'All Products',
        'image' => ratpaccheck_img_url('hero-1.png'),
        'href' => home_url('/products'),
    ),
);
?>

<section style="padding:80px 24px 100px;background-color:#F6F1EA;min-height:100vh;">
    <div style="max-width:1280px;margin:0 auto;">
        
        <!-- Page Heading (1:1 with Vercel) -->
        <div style="text-align:center;margin-bottom:56px;">
            <div style="display:flex;align-items:center;justify-content:center;gap:12px;margin-bottom:14px;">
                <div style="width:48px;height:1px;background-color:#000000;"></div>
                <span style="font-family:'Adobe Hebrew', 'Noto Serif', Georgia, serif;font-size:11px;font-weight:500;letter-spacing:0.25em;color:#8B6B4A;text-transform:uppercase;">
                    Browse
                </span>
                <div style="width:48px;height:1px;background-color:#000000;"></div>
            </div>
            <h1 class="page-heading text-[clamp(32px,4vw,52px)] text-[#1A1A1A] mb-3" style="line-height:1.1;letter-spacing:-0.02em;">
                collections
            </h1>
            <p class="body-copy text-[#8B6B4A] max-w-[480px] mx-auto" style="font-size:15px;">
                Explore our curated range of skincare and haircare essentials.
            </p>
        </div>

        <!-- Collections Grid (4 Columns, matching Vercel repeat(4, 1fr)) -->
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
            <?php foreach ($collections as $col) : ?>
                <div class="collection-item-card group">
                    <a href="<?php echo esc_url($col['href']); ?>" style="text-decoration:none;display:block;">
                        <!-- Image Container (1:1 aspect ratio, rounded-12px, hover zoom) -->
                        <div style="position:relative;width:100%;aspect-ratio:1/1;border-radius:12px;overflow:hidden;cursor:pointer;background-color:#F3F0EB;">
                            <img
                                src="<?php echo esc_url($col['image']); ?>"
                                alt="<?php echo esc_attr($col['name']); ?>"
                                loading="lazy"
                                style="position:absolute;height:100%;width:100%;inset:0;object-fit:cover;transition:transform 0.4s ease;"
                                class="group-hover:scale-105"
                            />
                        </div>

                        <!-- Category Name with animated underline -->
                        <div style="margin-top:14px;text-align:center;">
                            <span class="title-text text-base text-[#1A1A1A]" style="position:relative;display:inline-block;cursor:pointer;letter-spacing:0.02em;font-weight:600;">
                                <?php echo esc_html($col['name']); ?>
                                <span class="collection-underline" style="position:absolute;left:0;bottom:-2px;height:1.5px;background-color:#1A1A1A;width:0%;transition:width 0.35s ease;"></span>
                            </span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<style>
.collection-item-card:hover .group-hover\:scale-105 {
    transform: scale(1.05);
}
.collection-item-card:hover .collection-underline {
    width: 100% !important;
}
</style>

<?php
get_footer();
