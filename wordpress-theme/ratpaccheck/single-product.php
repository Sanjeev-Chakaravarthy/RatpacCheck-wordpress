<?php
/**
 * Template Name: Product Detail Page
 * Description: Dedicated Single Product detail page matching Next.js design with gallery, tabs, and related products.
 *
 * @package RatpacCheck
 * @version 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 101;
$product = ratpaccheck_get_product_by_id($product_id);

if (!$product) {
    // Fallback to first available product if requested ID not found
    $all = ratpaccheck_get_all_products();
    $product = !empty($all) ? $all[0] : null;
}

if (!$product) :
?>
    <section style="background-color: #F6F1EA; min-height: 100vh; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 24px; padding-top: 120px;">
        <h1 class="page-heading text-2xl text-[#1A1A1A]">Product Not Found</h1>
        <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; fontSize: 14px; color: #8B8178;">
            The product you're looking for doesn't exist.
        </p>
        <a href="<?php echo esc_url(home_url('/products/')); ?>" style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 13px; font-weight: 600; color: #FFF; background-color: #1A1A1A; padding: 12px 32px; border-radius: 999px; text-decoration: none; letter-spacing: 0.06em;">
            Browse All Products
        </a>
    </section>
<?php
    get_footer();
    exit;
endif;

$id = intval($product['id']);
$name = esc_html($product['name']);
$subtitle = isset($product['subtitle']) ? esc_html($product['subtitle']) : '';
$price = intval($product['price']);
$original_price = isset($product['originalPrice']) ? intval($product['originalPrice']) : 0;
$rating = isset($product['rating']) ? floatval($product['rating']) : 4.8;
$reviews_count = isset($product['reviews']) ? intval($product['reviews']) : 120;
$badge = isset($product['badge']) ? esc_html($product['badge']) : '';
$category = isset($product['category']) ? $product['category'] : 'Skin';
$type = isset($product['type']) ? esc_html($product['type']) : 'Treatment';
$in_stock = isset($product['inStock']) ? (bool)$product['inStock'] : true;
$description = isset($product['description']) ? $product['description'] : '';
$how_to_use = isset($product['howToUse']) ? (array)$product['howToUse'] : array();
$benefits = isset($product['benefits']) ? (array)$product['benefits'] : array();
$ingredients = isset($product['ingredients']) ? (array)$product['ingredients'] : array();

$images = isset($product['images']) && !empty($product['images']) ? (array)$product['images'] : array($product['image']);
$primary_image = ratpaccheck_img_url($images[0]);
$discount = ($original_price > $price) ? round((($original_price - $price) / $original_price) * 100) : 0;
$relatedProducts = ratpaccheck_get_related_products($product, 4);

// How to use image mapping
$how_to_use_map = array(
    101 => 'deep glow face serum -1.png',
    103 => 'hydrating body cleanser -7.png',
    104 => 'hydrating face cleanser-6.png',
    105 => 'Light Weight Moisturiser-10.png',
    106 => '6% Glycolic + Mulberry Exfoliating Toner-8.png',
    107 => '5% Multi-Functional Face Serum-2.png',
    108 => '10% Multi-Functional Face Serum -3.png',
    109 => 'sunscreen - 9.png',
    110 => 'Multi Layer Hydrating Serum-4.png',
    203 => 'hair growth serum -5.png',
    204 => 'rinse off conditioner -15.png',
    205 => 'anti hairfall oil -11.png',
    206 => 'anti dandruff oil -12.png',
    207 => 'anti dandruff shampoo -13.png',
    208 => 'anti hairfall shampoo -14.png',
);
$how_to_use_file = isset($how_to_use_map[$id]) ? $how_to_use_map[$id] : 'default.png';
$how_to_use_img_url = get_template_directory_uri() . '/assets/how-to-use/' . rawurlencode($how_to_use_file);

// Detailed reviews data matching Next.js ModernReviews.tsx
$detailed_reviews = array(
    array(
        'id' => 1,
        'name' => 'Priya Sharma',
        'date' => 'Jan 2026',
        'verified' => true,
        'rating' => 5,
        'title' => 'Best investment for my hair',
        'review' => 'After just 3 months, the difference is night and day. My hairline looks fuller and the texture is so much better. I used to dread brushing my hair because of how much would come out, but now I barely see any strands.',
        'image' => ratpaccheck_img_url('/images/Hair growth serum.jpeg'),
        'product' => 'Hair Growth Serum',
    ),
    array(
        'id' => 2,
        'name' => 'Ananya Reddy',
        'date' => 'Feb 2026',
        'verified' => true,
        'rating' => 5,
        'title' => 'Smells amazing and works',
        'review' => "I love that it's natural. No harsh chemicals, just great results. The oil isn't too greasy either. After years of struggling with stubborn dandruff I'd pretty much given up. This product cleared everything up within 3 washes.",
        'image' => ratpaccheck_img_url('/images/Anti-dandruff shampoo.jpeg'),
        'product' => 'Anti-Dandruff Shampoo',
    ),
    array(
        'id' => 3,
        'name' => 'Rohan Mehta',
        'date' => '1 month ago',
        'verified' => true,
        'rating' => 4,
        'title' => 'Solid product, great results',
        'review' => "Good results so far. Takes consistency but definitely worth it. My dermatologist actually recommended trying RatpacCheck before going for stronger treatments. Three months later I genuinely don't need to.",
        'image' => '',
        'product' => 'Hair Growth Serum',
    ),
    array(
        'id' => 4,
        'name' => 'Kavitha Menon',
        'date' => 'Mar 2026',
        'verified' => true,
        'rating' => 5,
        'title' => 'Gentle yet effective formula',
        'review' => 'I have a very sensitive scalp and most products cause irritation. This was incredibly gentle — no itching, no redness, just clean, fresh hair. I noticed less hair fall after the first week itself.',
        'image' => ratpaccheck_img_url('/images/Anti-hairfall oil.png'),
        'product' => 'Anti-Hairfall Oil',
    ),
);
?>

<div class="overflow-x-hidden" style="background-color: #F6F1EA; min-height: 100vh;">
    <div class="container-luxury w-full px-4 sm:px-6 md:px-10">

        <!-- ═══════════════════════════════════════════
             SECTION 1: PRODUCT HERO
             ═══════════════════════════════════════════ -->
        <section style="background-color: transparent; opacity: 1;">
            <div class="flex flex-col lg:grid lg:grid-cols-2 gap-2 lg:gap-16 items-stretch lg:items-start pt-2 pb-1 lg:py-14">
                
                <!-- LEFT: Image Gallery -->
                <div class="w-full max-w-[420px] mx-auto lg:mx-0 flex lg:block overflow-x-auto snap-x snap-mandatory scrollbar-hide" style="min-width: 0;">
                    
                    <!-- Main Image Box -->
                    <div 
                        id="main-image-box"
                        class="product-image-container h-[220px] md:h-[420px] shrink-0 w-[calc(100%-2rem)] sm:w-full mx-4 sm:mx-0 lg:w-auto snap-start relative bg-[#F6F1EA]"
                        style="position: relative; width: 100%; border-radius: 20px; overflow: hidden; background-image: none; background-size: cover; background-repeat: no-repeat; cursor: default;"
                    >
                        <img 
                            id="pdp-main-img"
                            src="<?php echo esc_url($primary_image); ?>" 
                            alt="<?php echo esc_attr($name); ?>" 
                            class="main-product-image object-contain"
                            style="position: absolute; height: 100%; width: 100%; left: 0; top: 0; right: 0; bottom: 0; object-fit: contain; color: transparent; opacity: 1;"
                        />

                        <?php if ($badge) : ?>
                            <div style="position: absolute; top: 20px; left: 20px; z-index: 10;">
                                <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 11px; font-weight: 600; color: #F8F5EF; background-color: #000; padding: 6px 14px; border-radius: 999px; letter-spacing: 0.08em; text-transform: uppercase;">
                                    <?php echo $badge; ?>
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if ($discount > 0) : ?>
                            <div style="position: absolute; top: 20px; right: 20px; z-index: 10;">
                                <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 11px; font-weight: 700; color: #FFF; background-color: #000; padding: 6px 12px; border-radius: 999px;">
                                    -<?php echo $discount; ?>%
                                </span>
                            </div>
                        <?php endif; ?>

                        <?php if (!$in_stock) : ?>
                            <div style="position: absolute; inset: 0; background-color: rgba(255,255,255,0.5); display: flex; align-items: center; justify-content: center; z-index: 10;">
                                <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 14px; font-weight: 700; color: #1A1A1A; background-color: #FFF; padding: 10px 24px; border-radius: 999px; letter-spacing: 0.06em; text-transform: uppercase;">
                                    Sold Out
                                </span>
                            </div>
                        <?php endif; ?>

                        <!-- Zoom Search Icon Button -->
                        <button
                            id="pdp-zoom-btn"
                            type="button"
                            class="zoom-button"
                            style="top: <?php echo $discount > 0 ? '64px' : '16px'; ?>;"
                            aria-label="Zoom image"
                        >
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><path d="m21 21-4.3-4.3"></path></svg>
                        </button>
                    </div>

                    <!-- Thumbnails (Desktop Only) -->
                    <?php if (count($images) > 1) : ?>
                        <div class="hidden lg:flex gap-3 mt-4">
                            <?php foreach ($images as $idx => $img_path) : 
                                $thumb_url = ratpaccheck_img_url($img_path);
                            ?>
                                <button
                                    type="button"
                                    class="pdp-thumb-btn"
                                    data-src="<?php echo esc_url($thumb_url); ?>"
                                    data-index="<?php echo $idx; ?>"
                                    style="width: 72px; height: 72px; border-radius: 10px; overflow: hidden; border: <?php echo $idx === 0 ? '2px solid #1A1A1A' : '2px solid transparent'; ?>; cursor: pointer; position: relative; transition: border-color 0.2s ease; padding: 0; background: none;"
                                >
                                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($name . ' ' . ($idx + 1)); ?>" style="width: 100%; height: 100%; object-fit: contain;" />
                                </button>
                            <?php endforeach; ?>
                        </div>

                        <!-- Additional Mobile Images (Swipeable) -->
                        <?php foreach (array_slice($images, 1) as $idx => $img_path) : 
                            $m_thumb_url = ratpaccheck_img_url($img_path);
                        ?>
                            <div class="product-image-container h-[220px] shrink-0 w-full lg:hidden snap-start relative bg-[#F6F1EA]">
                                <img src="<?php echo esc_url($m_thumb_url); ?>" alt="<?php echo esc_attr($name . ' ' . ($idx + 2)); ?>" class="main-product-image object-contain" style="position: absolute; height: 100%; width: 100%; inset: 0; object-fit: contain;" />
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>

                <!-- RIGHT: Product Info -->
                <div class="w-full flex flex-col" style="min-width: 0;">
                    
                    <!-- Category Tag -->
                    <span class="order-1" style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 10px; font-weight: 600; letter-spacing: 0.15em; color: #8B6B4A; text-transform: uppercase; margin-bottom: 4px; display: block;">
                        <?php echo $category === 'Skin' ? 'Skin Care' : 'Hair Care'; ?> · <?php echo $type; ?>
                    </span>

                    <!-- Product Name -->
                    <h1 class="order-2 font-metropolis text-[18px] sm:text-[26px] md:text-[32px] font-semibold leading-tight text-black mb-0.5">
                        <?php echo $name; ?>
                    </h1>

                    <!-- Subtitle -->
                    <p class="order-3 font-adobe text-[12px] sm:text-[15px] md:text-[16px] leading-snug text-gray-600 mb-2">
                        <?php echo $subtitle; ?>
                    </p>

                    <!-- Rating -->
                    <div class="order-4 flex items-center gap-2 mb-3">
                        <div style="display: flex; align-items: center; gap: 2px;">
                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="#C9A84C" stroke="#C9A84C" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
                            <?php endfor; ?>
                        </div>
                        <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 11px; font-weight: 500; color: #3D3532;">
                            <?php echo number_format($rating, 1); ?>
                        </span>
                        <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 11px; color: #8B8178;">
                            (<?php echo number_format($reviews_count); ?> reviews)
                        </span>
                    </div>

                    <!-- Price -->
                    <div class="order-5 flex items-baseline gap-3 mb-3 pb-3 border-b border-[#E0D9CE]">
                        <span class="font-metropolis text-[15px] sm:text-[18px] lg:text-[28px] font-semibold text-gray-900">
                            ₹<?php echo $price; ?>
                        </span>
                        <?php if ($original_price > $price) : ?>
                            <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 14px; font-weight: 400; color: #AAA5A0; text-decoration: line-through;">
                                ₹<?php echo $original_price; ?>
                            </span>
                            <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 11px; font-weight: 600; color: #2E7D32; background-color: #E8F5E9; padding: 1px 6px; border-radius: 999px;">
                                Save <?php echo $discount; ?>%
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Description with Read More -->
                    <div class="order-7 lg:order-6 mb-2 lg:mb-8 mt-1 lg:mt-0">
                        <div 
                            id="pdp-desc-container"
                            style="position: relative; max-height: 6.4em; overflow: hidden; line-height: 1.6em; transition: max-height 0.4s ease;"
                        >
                            <?php 
                            $paragraphs = explode("\n\n", $description);
                            foreach ($paragraphs as $para) : 
                            ?>
                                <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 14px; color: #6B6560; margin-bottom: 12px; line-height: 1.7;">
                                    <?php echo nl2br(esc_html($para)); ?>
                                </p>
                            <?php endforeach; ?>
                            <div id="pdp-desc-fade" style="position: absolute; bottom: 0; left: 0; right: 0; height: 48px; background: linear-gradient(to top, #F6F1EA 20%, transparent 100%); pointer-events: none;"></div>
                        </div>
                        <button
                            id="pdp-desc-toggle"
                            type="button"
                            style="margin-top: 6px; background: none; border: none; padding: 0; cursor: pointer; font-family: 'Metropolis', 'Helvetica Neue', Arial, sans-serif; font-size: 13px; font-weight: 700; color: #1A1A1A; letter-spacing: 0.02em; text-decoration: underline; text-underline-offset: 3px;"
                        >
                            Read more
                        </button>
                    </div>

                    <!-- Buttons - In-flow layout on Mobile -->
                    <div class="order-6 lg:order-7 w-full flex items-center gap-3 mt-2 mb-2 lg:mt-6 lg:mb-6">
                        <div class="flex h-10 min-h-[40px] items-center border border-gray-300 rounded-xl bg-white lg:h-[52px]">
                            <button id="pdp-qty-minus" type="button" class="px-3 text-lg text-gray-900 bg-transparent border-none cursor-pointer">-</button>
                            <span id="pdp-qty-num" class="font-metropolis min-w-[20px] px-1 text-center text-[14px] font-semibold text-gray-900">1</span>
                            <button id="pdp-qty-plus" type="button" class="px-3 text-lg text-gray-900 bg-transparent border-none cursor-pointer">+</button>
                        </div>

                        <button
                            id="pdp-add-to-cart-btn"
                            type="button"
                            class="flex-1 rounded-xl flex items-center justify-center gap-2 shadow-sm font-metropolis text-sm font-semibold tracking-wide text-white transition-colors h-10 lg:min-h-[52px]"
                            style="background-color: #1A1A1A !important; color: #FFFFFF !important; border: none !important; cursor: <?php echo $in_stock ? 'pointer' : 'not-allowed'; ?>; opacity: <?php echo $in_stock ? '1' : '0.5'; ?>;"
                            data-id="<?php echo esc_attr($id); ?>"
                            data-name="<?php echo esc_attr($name); ?>"
                            data-price="<?php echo esc_attr($price); ?>"
                            data-original-price="<?php echo esc_attr($original_price); ?>"
                            data-image="<?php echo esc_url($primary_image); ?>"
                            data-subtitle="<?php echo esc_attr($subtitle); ?>"
                            <?php echo !$in_stock ? 'disabled' : ''; ?>
                        >
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 18px; height: 18px; flex-shrink: 0;"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                            <span id="pdp-add-text">Add to Cart</span>
                        </button>
                    </div>

                    <!-- Trust badges -->
                    <div class="order-8 flex gap-5 pt-3 lg:pt-5 border-t border-[#E0D9CE]">
                        <?php foreach (array("Free Shipping", "100% Genuine", "Easy Returns") as $txt) : ?>
                            <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 11px; font-weight: 500; color: #8B8178; letter-spacing: 0.04em;">
                                ✓ <?php echo $txt; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>
        </section>

        <!-- ═══════════════════════════════════════════
             SECTION 3: PRODUCT TABS / REVIEWS
             ═══════════════════════════════════════════ -->
        <div class="pt-10 lg:pt-[60px] pb-0 -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 bg-[#F6F1EA]">
            <section>
                <div style="background-color: #F6F1EA;">
                    
                    <!-- Tab Bar -->
                    <div class="flex justify-center gap-6 border-b pb-2 flex-wrap overflow-hidden max-w-7xl mx-auto w-full px-4 sm:px-6 md:px-10 mt-2 md:mt-6 lg:mt-0" style="border-bottom-color: #E0D9CE;">
                        <button
                            type="button"
                            class="pdp-tab-nav active"
                            data-tab="tab-reviews"
                            style="font-family: 'Metropolis', 'Helvetica Neue', Arial, sans-serif; font-size: 14px; font-weight: 700; color: #1A1A1A; border: none; background: none; padding: 8px 12px; cursor: pointer; border-bottom: 2px solid #1A1A1A; margin-bottom: -10px; transition: all 0.2s ease; white-space: nowrap; letter-spacing: 0.02em;"
                        >
                            Reviews
                        </button>
                        <button
                            type="button"
                            class="pdp-tab-nav"
                            data-tab="tab-how-to-use"
                            style="font-family: 'Metropolis', 'Helvetica Neue', Arial, sans-serif; font-size: 14px; font-weight: 500; color: #8B8178; border: none; background: none; padding: 8px 12px; cursor: pointer; border-bottom: 2px solid transparent; margin-bottom: -10px; transition: all 0.2s ease; white-space: nowrap; letter-spacing: 0.02em;"
                        >
                            How To Use
                        </button>
                        <button
                            type="button"
                            class="pdp-tab-nav"
                            data-tab="tab-ingredients"
                            style="font-family: 'Metropolis', 'Helvetica Neue', Arial, sans-serif; font-size: 14px; font-weight: 500; color: #8B8178; border: none; background: none; padding: 8px 12px; cursor: pointer; border-bottom: 2px solid transparent; margin-bottom: -10px; transition: all 0.2s ease; white-space: nowrap; letter-spacing: 0.02em;"
                        >
                            Ingredients
                        </button>
                    </div>

                    <!-- Tab 1: REVIEWS (Active by default) -->
                    <div id="tab-reviews" class="pdp-tab-content block">
                        <section class="mt-6 lg:mt-8 rounded-2xl overflow-hidden" style="background-color: #F4EFE9;">
                            <div class="reviews-wrapper max-w-6xl mx-auto w-full pr-[16px] pl-0 md:px-10 pb-6 lg:pb-8 pt-10 lg:pt-14">
                                <h2 style="display: none;">Customer Reviews</h2>

                                <div class="reviews-container">
                                    
                                    <!-- LEFT: Rating summary -->
                                    <div class="left-rating-section flex-shrink-0 m-0 p-0">
                                        <div>
                                            <div class="text-[38px] sm:text-[56px] md:text-[64px]" style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-weight: 700; color: #000; line-height: 1;">
                                                <?php echo number_format($rating, 1); ?>
                                            </div>

                                            <div class="flex gap-[2px] sm:gap-1 mt-1 sm:mt-1.5">
                                                <?php for ($s = 1; $s <= 5; $s++) : ?>
                                                    <svg class="w-[12px] h-[12px] sm:w-[18px] sm:h-[18px] md:w-[20px] md:h-[20px]" fill="#C08A5C" stroke="#C08A5C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
                                                <?php endfor; ?>
                                            </div>

                                            <p class="text-[9px] sm:text-[13px] md:text-[14px] mt-1 sm:mt-2 mb-2 sm:mb-4" style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; color: #6B7280; line-height: 1.3;">
                                                Based on <?php echo number_format($reviews_count); ?> reviews
                                            </p>

                                            <!-- Rating distribution bars -->
                                            <div class="flex flex-col gap-[3px] sm:gap-[10px] mb-3 sm:mb-5">
                                                <?php 
                                                $rating_bars = array(
                                                    array('stars' => 5, 'percent' => 85),
                                                    array('stars' => 4, 'percent' => 10),
                                                    array('stars' => 3, 'percent' => 3),
                                                    array('stars' => 2, 'percent' => 1),
                                                    array('stars' => 1, 'percent' => 1),
                                                );
                                                foreach ($rating_bars as $row) : 
                                                ?>
                                                    <div class="flex items-center gap-1 sm:gap-3">
                                                        <span class="text-[8px] sm:text-[13px] md:text-[14px] flex-shrink-0" style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-weight: 500; color: #000; width: 8px;">
                                                            <?php echo $row['stars']; ?>
                                                        </span>
                                                        <div class="flex-1 rounded-full overflow-hidden" style="height: clamp(3px, 0.5vw, 6px); background-color: #E6E0D8;">
                                                            <div class="h-full rounded-full" style="width: <?php echo $row['percent']; ?>%; background-color: #000;"></div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <!-- Write Review button -->
                                        <button
                                            type="button"
                                            class="reviews-write-btn w-full flex items-center justify-center gap-1 sm:gap-2 cursor-pointer ml-0 mr-auto"
                                            style="max-width: 450px; font-family: 'Metropolis', 'Helvetica Neue', Arial, sans-serif; font-weight: 600; color: #FFF; background-color: #000; border: none; border-radius: 999px;"
                                        >
                                            <svg class="w-[10px] h-[10px] sm:w-[14px] sm:h-[14px] md:w-[16px] md:h-[16px]" fill="none" stroke="#FFF" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                            <span>Write a Review</span>
                                        </button>
                                    </div>

                                    <!-- RIGHT: 3 Cards + Arrows + Button -->
                                    <div class="right-reviews-section min-w-0 m-0">
                                        <div class="w-full flex flex-col items-center relative mb-[28px] md:mb-[40px]">
                                            
                                            <!-- Up arrow -->
                                            <button
                                                id="rev-up-btn"
                                                type="button"
                                                aria-label="Previous review"
                                                class="review-nav-arrow absolute -top-[34px] lg:-top-[42px] left-1/2 -translate-x-1/2 flex items-center justify-center cursor-pointer z-10"
                                                style="width: clamp(24px, 4vw, 42px); height: clamp(18px, 2.5vw, 30px); border-radius: 999px; border: 1px solid #E6E0D8; background: #fff; transition: all 0.2s ease;"
                                            >
                                                <svg class="w-[12px] h-[12px] sm:w-[16px] sm:h-[16px] md:w-[18px] md:h-[18px]" stroke="#9CA3AF" stroke-width="2" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 15l-6-6-6 6"/></svg>
                                            </button>

                                            <!-- 3 Compact Cards Container -->
                                            <div id="reviews-cards-container" class="flex flex-col gap-[8px] md:gap-3 w-full items-center">
                                                <?php 
                                                // Show first 3 reviews initially
                                                for ($idx = 0; $idx < 3; $idx++) :
                                                    $r = $detailed_reviews[$idx % count($detailed_reviews)];
                                                    $parts = explode(' ', $r['name']);
                                                    $initials = (isset($parts[0][0]) ? $parts[0][0] : '') . (isset($parts[1][0]) ? $parts[1][0] : '');
                                                    $has_img = !empty($r['image']);
                                                ?>
                                                    <div 
                                                        class="review-card w-full md:max-w-[390px] lg:max-w-[430px] rounded-lg sm:rounded-xl bg-white overflow-hidden transition-all duration-300 cursor-pointer"
                                                        data-id="<?php echo $r['id']; ?>"
                                                        style="box-shadow: 0 1px 4px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);"
                                                    >
                                                        <div class="review-card-inner h-full flex flex-col justify-between relative">
                                                            
                                                            <!-- Stars -->
                                                            <div class="review-stars flex gap-[0.5px] md:gap-[1px]">
                                                                <?php for ($s = 1; $s <= 5; $s++) : ?>
                                                                    <svg class="w-[8px] h-[8px] md:w-[10px] md:h-[10px]" fill="<?php echo $s <= $r['rating'] ? '#C08A5C' : '#E5E7EB'; ?>" stroke="<?php echo $s <= $r['rating'] ? '#C08A5C' : '#E5E7EB'; ?>" stroke-width="1.5" viewBox="0 0 24 24"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
                                                                <?php endfor; ?>
                                                            </div>

                                                            <!-- Middle: Image + Details -->
                                                            <div class="review-middle flex items-start flex-1 min-w-0">
                                                                <div class="relative rounded-md overflow-hidden flex-shrink-0" style="background-color: #F6F1EA;">
                                                                    <?php if ($has_img) : ?>
                                                                        <img src="<?php echo esc_url($r['image']); ?>" alt="<?php echo esc_attr($r['product']); ?>" class="object-cover w-full h-full" />
                                                                    <?php else : ?>
                                                                        <div class="absolute inset-0 flex items-center justify-center" style="background-color: #F0EBE3;">
                                                                            <span class="text-[10px] md:text-[12px] font-bold" style="color: #8B6B4A;"><?php echo $initials; ?></span>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="review-details flex-1 min-w-0 flex flex-col justify-start">
                                                                    <div class="flex items-center gap-1.5 min-w-0">
                                                                        <span class="font-bold text-[#1A1A1A] truncate" style="font-family: 'Metropolis', 'Helvetica Neue', Arial, sans-serif;">
                                                                            <?php echo esc_html($r['name']); ?>
                                                                        </span>
                                                                        <?php if ($r['verified']) : ?>
                                                                            <span class="inline-flex items-center flex-shrink-0 text-[6px] md:text-[8px] px-1 py-[1px] rounded-[3px] gap-[1px]" style="background-color: #EFF6FF; font-family: 'Metropolis', 'Helvetica Neue', Arial, sans-serif; font-weight: 600; color: #2563EB;">
                                                                                <svg class="w-[5px] h-[5px] md:w-[6px] md:h-[6px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                                                                Verified
                                                                            </span>
                                                                        <?php endif; ?>
                                                                    </div>

                                                                    <h3 class="font-bold text-[#1A1A1A] truncate mt-0.5 leading-snug" style="font-family: 'Metropolis', 'Helvetica Neue', Arial, sans-serif;">
                                                                        <?php echo esc_html($r['title']); ?>
                                                                    </h3>

                                                                    <p class="text-[#6B7280] font-adobe leading-relaxed mt-0.5 review-description-text line-clamp-2">
                                                                        <?php echo esc_html($r['review']); ?>
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <!-- Arrow bottom center -->
                                                            <div class="review-arrow-container">
                                                                <svg class="review-card-arrow w-3 h-3 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                                            </div>

                                                        </div>
                                                    </div>
                                                <?php endfor; ?>
                                            </div>

                                            <!-- Down arrow -->
                                            <button
                                                id="rev-down-btn"
                                                type="button"
                                                aria-label="Next review"
                                                class="review-nav-arrow absolute -bottom-[34px] lg:-bottom-[42px] left-1/2 -translate-x-1/2 flex items-center justify-center cursor-pointer z-10"
                                                style="width: clamp(24px, 4vw, 42px); height: clamp(18px, 2.5vw, 30px); border-radius: 999px; border: 1px solid #E6E0D8; background: #fff; transition: all 0.2s ease;"
                                            >
                                                <svg class="w-[12px] h-[12px] sm:w-[16px] sm:h-[16px] md:w-[18px] md:h-[18px]" stroke="#9CA3AF" stroke-width="2" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                            </button>

                                        </div>

                                        <!-- View All Reviews -->
                                        <button
                                            type="button"
                                            class="view-all-reviews-btn w-full cursor-pointer ml-0"
                                            style="max-width: 450px; border-radius: 999px; border: 1px solid #000; background: transparent; color: #000; font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-weight: 600; transition: all 0.3s ease; letter-spacing: 0.02em;"
                                        >
                                            View All Reviews
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Tab 2: HOW TO USE -->
                    <div id="tab-how-to-use" class="pdp-tab-content hidden">
                        <div class="max-w-7xl mx-auto w-full px-6 sm:px-8 md:px-12 py-6 lg:py-8">
                            <div class="grid grid-cols-1 md:grid-cols-[1.2fr_1.8fr] gap-12 lg:gap-16 items-stretch">
                                
                                <!-- LEFT → TEXT -->
                                <div class="space-y-8 text-left w-full pr-4">
                                    <h3 class="section-title text-2xl mb-6 text-[#1A1A1A]" style="letter-spacing: 0.02em;">
                                        How To Use
                                    </h3>

                                    <ul class="space-y-4 m-0 p-0" style="list-style-type: none; display: flex; flex-direction: column; gap: 16px;">
                                        <?php if (!empty($how_to_use)) : ?>
                                            <?php foreach ($how_to_use as $step) : ?>
                                                <li class="flex items-start gap-4">
                                                    <div style="width: 6px; height: 6px; border-radius: 50%; background-color: #1A1A1A; margin-top: 10px; flex-shrink: 0;"></div>
                                                    <p class="font-body text-gray-600 text-sm leading-relaxed" style="color: #3D3532;">
                                                        <?php echo esc_html($step); ?>
                                                    </p>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <li class="flex items-start gap-4">
                                                <div style="width: 6px; height: 6px; border-radius: 50%; background-color: #1A1A1A; margin-top: 10px; flex-shrink: 0;"></div>
                                                <p class="font-body text-gray-600 text-sm leading-relaxed" style="color: #3D3532;">Apply 2–3 drops directly to cleansed skin or scalp.</p>
                                            </li>
                                        <?php endif; ?>
                                    </ul>

                                    <!-- ADVISORY TEXT SECTION -->
                                    <div style="margin-top: 24px;">
                                        <h4 class="title-text text-base mb-4 text-[#1A1A1A]">
                                            Advice / Caution
                                        </h4>
                                        <ul class="space-y-3 m-0 p-0" style="list-style-type: none; display: flex; flex-direction: column; gap: 12px;">
                                            <?php foreach (array(
                                                "Avoid direct contact with eyes",
                                                "Do a patch test before first use",
                                                "Store in a cool dry place",
                                                "Keep away from children",
                                            ) as $caution) : ?>
                                                <li class="flex items-start gap-3">
                                                    <span style="color: #8B8178; font-size: 14px; margin-top: 2px;">✦</span>
                                                    <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 14px; font-weight: 500; color: #6B6560; line-height: 1.5;">
                                                        <?php echo $caution; ?>
                                                    </span>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>

                                    <!-- YouTube Tutorial Bar -->
                                    <div class="w-full mt-8">
                                        <div class="flex items-center justify-between bg-[#f8f6f4] rounded-xl px-6 py-4 shadow-sm cursor-pointer group hover:scale-[1.01] transition-transform">
                                            <div class="flex flex-col gap-1">
                                                <span class="text-[11px] tracking-[0.2em] uppercase text-gray-400 font-adobe font-bold">
                                                    YOUTUBE
                                                </span>
                                                <p class="text-[14px] font-medium text-black m-0 font-metropolis">
                                                    Watch This Tutorial for More Details
                                                </p>
                                            </div>
                                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-black text-white transition-all duration-300 group-hover:scale-110 shrink-0">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5V19L19 12L8 5Z"/></svg>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- RIGHT → DYNAMIC PRODUCT IMAGE -->
                                <div class="hidden md:flex items-center justify-center md:ml-16 lg:ml-24 overflow-hidden rounded-[28px]">
                                    <img 
                                        src="<?php echo esc_url($how_to_use_img_url); ?>" 
                                        alt="<?php echo esc_attr('How to use ' . $name); ?>" 
                                        style="width: 100%; height: auto; max-height: 600px; object-fit: contain; object-position: center; display: block; border-radius: 28px;"
                                        onerror="this.style.display='none';if(this.parentElement)this.parentElement.style.display='none';"
                                    />
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: INGREDIENTS -->
                    <div id="tab-ingredients" class="pdp-tab-content hidden">
                        <div class="max-w-4xl mx-auto w-full px-4 sm:px-6 md:px-10 py-6 lg:py-8">
                            <h3 class="section-title text-xl mb-8 text-[#1A1A1A]">
                                Key Ingredients
                            </h3>
                            <div style="display: flex; flex-direction: column; gap: 20px;">
                                <?php if (!empty($ingredients)) : ?>
                                    <?php foreach ($ingredients as $ing) : 
                                        $ing_name = is_array($ing) && isset($ing['name']) ? $ing['name'] : (is_string($ing) ? $ing : '');
                                        $ing_desc = is_array($ing) && isset($ing['description']) ? $ing['description'] : '';
                                    ?>
                                        <div style="display: flex; gap: 20px; align-items: flex-start; padding: 20px 24px; background-color: #FFFFFF; border-radius: 12px; border: 1px solid #E8E3DB;">
                                            <div style="width: 10px; height: 10px; border-radius: 50%; background-color: #1A1A1A; flex-shrink: 0; margin-top: 6px;"></div>
                                            <div>
                                                <p class="title-text text-[15px] mb-1.5 text-[#1A1A1A]" style="line-height: 1.3;">
                                                    <?php echo esc_html($ing_name); ?>
                                                </p>
                                                <p class="font-body text-gray-600 text-sm leading-relaxed" style="color: #6B6560;">
                                                    <?php echo esc_html($ing_desc); ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p class="font-adobe text-sm text-gray-600">100% active, clean beauty formulation. Dermatologically evaluated and batch certified.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>

        <!-- ═══════════════════════════════════════════
             SECTION 7: RELATED PRODUCTS
             ═══════════════════════════════════════════ -->
        <?php if (!empty($relatedProducts)) : ?>
            <div>
                <section>
                    <div class="w-full pt-6 lg:pt-8 pb-10 lg:pb-20">
                        <h2 class="section-title mb-6 md:mb-10 text-center md:mb-12">
                            You May Also Like
                        </h2>
                        <div class="pdp-related-grid grid w-full grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            <?php foreach ($relatedProducts as $rp) : ?>
                                <div class="min-w-[160px] sm:min-w-[200px] lg:min-w-0 snap-start shrink-0 h-full">
                                    <?php echo ratpaccheck_render_product_card($rp); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            </div>
        <?php endif; ?>

    </div>
</div>

<!-- ═══════════════════════════════════════════
     PDP & REVIEWS CSS
     ═══════════════════════════════════════════ -->
<style>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.product-image-container {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    width: 100%;
    aspect-ratio: 1 / 1;
}

.main-product-image {
    transition: transform 0.3s ease, opacity 0.2s ease !important;
}

.zoom-button {
    position: absolute;
    right: 16px;
    width: 40px;
    height: 40px;
    background: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    opacity: 0;
    transition: all 0.25s ease;
    border: none;
    cursor: pointer;
    z-index: 10;
}

.product-image-container:hover .zoom-button {
    opacity: 1;
}

/* Reviews styles matching Next.js ModernReviews */
.reviews-container {
    display: flex !important;
    flex-direction: row !important;
    align-items: stretch !important;
    gap: 8px !important;
    width: 100%;
}

.left-rating-section {
    width: 48% !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    height: auto !important;
    gap: 0 !important;
    min-width: 0;
    padding: 0 !important;
    margin: 0 !important;
}

.right-reviews-section {
    width: 52% !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    height: auto !important;
    gap: 0 !important;
    min-width: 0;
}

.reviews-write-btn {
    width: 100%;
    height: 34px !important;
    min-height: 34px !important;
    min-width: 0;
    margin-top: auto !important;
    padding: 0 !important;
    font-size: 10px !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    flex-shrink: 0;
}

.view-all-reviews-btn {
    width: 100%;
    height: 34px !important;
    min-height: 34px !important;
    margin-top: auto !important;
    font-size: 10px !important;
    flex-shrink: 0;
}

.review-card {
    min-height: auto;
    height: 68px !important;
    border-radius: 12px !important;
    width: 95% !important;
    overflow: hidden;
}

.review-card.expanded {
    height: auto !important;
}

.review-card-inner {
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    height: 100% !important;
    padding: 6px 8px !important;
    position: relative !important;
}

.review-stars {
    margin-bottom: 2px !important;
}

.review-middle {
    display: flex !important;
    flex-direction: row !important;
    align-items: start !important;
    gap: 6px !important;
    width: 100%;
    min-width: 0;
    flex: 1 !important;
}

.review-details {
    min-width: 0;
    flex: 1 !important;
}

/* Product image inside card — smaller on mobile */
.review-card .relative.rounded-md {
    width: 32px !important;
    height: 32px !important;
}

/* Username font -> smaller */
.review-card span.font-bold {
    font-size: 9px !important;
}

/* Bold title -> max 1 line */
.review-card h3 {
    font-size: 9px !important;
    white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    margin-top: 1px !important;
}

/* Review text -> max 1 line, hides extra description text */
.review-card p.review-description-text {
    font-size: 8px !important;
    white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
    margin-top: 1px !important;
    display: block !important;
}

.review-card.expanded h3 {
    white-space: normal !important;
    overflow: visible !important;
    text-overflow: clip !important;
}

.review-card.expanded p.review-description-text {
    white-space: normal !important;
    overflow: visible !important;
    text-overflow: clip !important;
}

/* Hide card arrow on mobile to prevent vertical height growth */
.review-arrow-container {
    display: none !important;
}

/* ══════════════════════════════════════
   DESKTOP (≥ 768px)
   Text clamping + arrow cleanup matching Next.js ModernReviews.tsx
   ══════════════════════════════════════ */
@media (min-width: 768px) {
    .reviews-container {
        display: flex !important;
        flex-direction: row !important;
        gap: 40px !important;
        align-items: stretch !important;
    }
    .left-rating-section {
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        width: clamp(130px, 42%, 460px) !important;
        height: auto !important;
    }
    .right-reviews-section {
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        align-items: center !important;
        flex: 1 !important;
        max-width: 460px !important;
        margin-left: auto !important;
        width: auto !important;
        height: auto !important;
    }
    .reviews-write-btn {
        height: clamp(48px, 5vw, 56px) !important;
        font-size: clamp(12px, 1.5vw, 16px) !important;
        margin-top: auto !important;
    }
    .view-all-reviews-btn {
        height: clamp(48px, 5vw, 56px) !important;
        font-size: clamp(12px, 1.5vw, 16px) !important;
        margin-top: auto !important;
    }

    /* Desktop card spacing, sizing, padding & arrows fix */
    .review-card {
        width: 100% !important;
        height: 90px !important;
        max-height: 95px !important;
        padding: 0 !important;
    }

    .review-card.expanded {
        height: auto !important;
        max-height: 500px !important;
    }

    .review-card-inner {
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        height: 100% !important;
        padding: 8px 10px 18px 10px !important; /* space at bottom for absolute arrow */
        position: relative !important;
    }

    .review-stars {
        margin-bottom: 2px !important;
    }

    .review-middle {
        display: flex !important;
        flex-direction: row !important;
        align-items: start !important;
        gap: 10px !important;
        width: 100%;
        min-width: 0;
        flex: 1 !important;
    }

    .review-card .relative.rounded-md {
        width: 56px !important;
        height: 56px !important;
    }

    .review-details {
        min-width: 0;
        flex: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: start !important;
    }

    /* Username */
    .review-card span.font-bold {
        font-size: 11px !important;
        line-height: 1.1 !important;
    }

    /* Title: max 1 line only */
    .review-card h3 {
        font-size: 10px !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        margin-top: 1px !important;
        line-height: 1.2 !important;
    }

    /* Description: max 2 lines, overflow ellipsis, remove excessive wrapping */
    .review-card p.review-description-text {
        font-size: 9px !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        box-orient: vertical !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        white-space: normal !important;
        margin-top: 2px !important;
        line-height: 1.25 !important;
    }

    /* Expanded state description text wrapping */
    .review-card.expanded p.review-description-text {
        -webkit-line-clamp: unset !important;
        line-clamp: unset !important;
        overflow: visible !important;
    }

    /* Arrow: absolute center horizontally, fixed bottom center */
    .review-arrow-container {
        display: flex !important;
        position: absolute !important;
        bottom: 4px !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        width: auto !important;
        margin: 0 !important;
        height: auto !important;
    }
}

.view-all-reviews-btn:hover {
    background: #000 !important;
    color: #fff !important;
}
.review-nav-arrow:hover {
    background: #f5f2ed !important;
    border-color: #ccc !important;
}

@media (max-width: 767px) {
    .product-image-container {
        width: 100% !important;
        min-height: 220px;
        aspect-ratio: 1 / 1;
        display: block !important;
    }
}
</style>

<!-- ═══════════════════════════════════════════
     PDP INTERACTIVITY SCRIPT
     ═══════════════════════════════════════════ -->
<script>
(function() {
    // 1. Gallery Thumbnails Swapping
    const thumbBtns = document.querySelectorAll('.pdp-thumb-btn');
    const mainImg = document.getElementById('pdp-main-img');
    const mainBox = document.getElementById('main-image-box');
    const zoomBtn = document.getElementById('pdp-zoom-btn');
    let isZoomed = false;

    thumbBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const src = this.getAttribute('data-src');
            if (mainImg && src) {
                mainImg.src = src;
                if (isZoomed && mainBox) {
                    mainBox.style.backgroundImage = 'url(' + src + ')';
                }
            }
            thumbBtns.forEach(b => b.style.borderColor = 'transparent');
            this.style.borderColor = '#1A1A1A';
        });
    });

    // 2. Zoom Functionality
    if (zoomBtn && mainBox && mainImg) {
        zoomBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            isZoomed = !isZoomed;
            if (isZoomed) {
                mainBox.style.backgroundImage = 'url(' + mainImg.src + ')';
                mainBox.style.backgroundSize = '200%';
                mainBox.style.cursor = 'zoom-in';
                mainImg.style.opacity = '0';
            } else {
                mainBox.style.backgroundImage = 'none';
                mainBox.style.cursor = 'default';
                mainImg.style.opacity = '1';
            }
        });

        mainBox.addEventListener('mousemove', function(e) {
            if (!isZoomed) return;
            const rect = mainBox.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 100;
            const y = ((e.clientY - rect.top) / rect.height) * 100;
            mainBox.style.backgroundPosition = x + '% ' + y + '%';
        });

        mainBox.addEventListener('click', function() {
            if (isZoomed) {
                isZoomed = false;
                mainBox.style.backgroundImage = 'none';
                mainBox.style.cursor = 'default';
                mainImg.style.opacity = '1';
            }
        });
    }

    // 3. Description Read More / Read Less
    const descContainer = document.getElementById('pdp-desc-container');
    const descFade = document.getElementById('pdp-desc-fade');
    const descToggle = document.getElementById('pdp-desc-toggle');
    let isDescExpanded = false;
    if (descToggle && descContainer) {
        descToggle.addEventListener('click', function() {
            isDescExpanded = !isDescExpanded;
            if (isDescExpanded) {
                descContainer.style.maxHeight = 'none';
                if (descFade) descFade.style.display = 'none';
                descToggle.textContent = 'Read less';
            } else {
                descContainer.style.maxHeight = '6.4em';
                if (descFade) descFade.style.display = 'block';
                descToggle.textContent = 'Read more';
            }
        });
    }

    // 4. Quantity Counter
    const qtyMinus = document.getElementById('pdp-qty-minus');
    const qtyPlus = document.getElementById('pdp-qty-plus');
    const qtyNum = document.getElementById('pdp-qty-num');
    let currentQty = 1;

    if (qtyMinus && qtyPlus && qtyNum) {
        qtyMinus.addEventListener('click', function() {
            if (currentQty > 1) {
                currentQty--;
                qtyNum.textContent = currentQty;
            }
        });
        qtyPlus.addEventListener('click', function() {
            currentQty++;
            qtyNum.textContent = currentQty;
        });
    }

    // 5. Add to Cart
    const addToCartBtn = document.getElementById('pdp-add-to-cart-btn');
    const addText = document.getElementById('pdp-add-text');
    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const price = parseFloat(this.getAttribute('data-price')) || 0;
            const originalPrice = parseFloat(this.getAttribute('data-original-price')) || 0;
            const image = this.getAttribute('data-image');
            const subtitle = this.getAttribute('data-subtitle');

            if (window.ratpaccheck_cart && typeof window.ratpaccheck_cart.addItem === 'function') {
                window.ratpaccheck_cart.addItem({
                    id: id,
                    name: name,
                    price: price,
                    originalPrice: originalPrice,
                    image: image,
                    subtitle: subtitle
                }, currentQty);
            }

            // Visual feedback
            if (addText) {
                const originalBg = addToCartBtn.style.backgroundColor;
                addText.textContent = 'Added';
                addToCartBtn.style.backgroundColor = '#2E7D32';
                setTimeout(function() {
                    addText.textContent = 'Add to Cart';
                    addToCartBtn.style.backgroundColor = originalBg;
                }, 2000);
            }
        });
    }

    // 6. Tabs Switching
    const tabNavs = document.querySelectorAll('.pdp-tab-nav');
    const tabContents = document.querySelectorAll('.pdp-tab-content');

    tabNavs.forEach(nav => {
        nav.addEventListener('click', function() {
            const target = this.getAttribute('data-tab');
            tabNavs.forEach(n => {
                n.classList.remove('active');
                n.style.fontWeight = '500';
                n.style.color = '#8B8178';
                n.style.borderBottomColor = 'transparent';
            });
            this.classList.add('active');
            this.style.fontWeight = '700';
            this.style.color = '#1A1A1A';
            this.style.borderBottomColor = '#1A1A1A';

            tabContents.forEach(c => {
                if (c.id === target) {
                    c.classList.remove('hidden');
                    c.classList.add('block');
                } else {
                    c.classList.add('hidden');
                    c.classList.remove('block');
                }
            });
        });
    });

    // 7. Reviews Carousel (Up/Down) & Expand
    const reviewsData = <?php echo json_encode($detailed_reviews); ?>;
    let activeReviewIndex = 0;

    function renderReviews() {
        const container = document.getElementById('reviews-cards-container');
        if (!container || !reviewsData || reviewsData.length === 0) return;

        container.innerHTML = '';
        for (let i = 0; i < 3; i++) {
            const r = reviewsData[(activeReviewIndex + i) % reviewsData.length];
            const parts = (r.name || '').split(' ');
            const initials = (parts[0] ? parts[0][0] : '') + (parts[1] ? parts[1][0] : '');

            const card = document.createElement('div');
            card.className = 'review-card w-full md:max-w-[390px] lg:max-w-[430px] rounded-lg sm:rounded-xl bg-white overflow-hidden transition-all duration-300 cursor-pointer';
            card.style.boxShadow = '0 1px 4px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04)';

            let starsHtml = '';
            for (let s = 1; s <= 5; s++) {
                const color = s <= r.rating ? '#C08A5C' : '#E5E7EB';
                starsHtml += '<svg class="w-[8px] h-[8px] md:w-[10px] md:h-[10px]" fill="' + color + '" stroke="' + color + '" stroke-width="1.5" viewBox="0 0 24 24"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>';
            }

            let mediaHtml = r.image 
                ? '<img src="' + r.image + '" alt="' + (r.product || '') + '" class="object-cover w-full h-full" />'
                : '<div class="absolute inset-0 flex items-center justify-center" style="background-color: #F0EBE3;"><span class="text-[10px] md:text-[12px] font-bold" style="color: #8B6B4A;">' + initials + '</span></div>';

            card.innerHTML = 
                '<div class="review-card-inner h-full flex flex-col justify-between relative">' +
                    '<div class="review-stars flex gap-[0.5px] md:gap-[1px]">' + starsHtml + '</div>' +
                    '<div class="review-middle flex items-start flex-1 min-w-0">' +
                        '<div class="relative rounded-md overflow-hidden flex-shrink-0" style="background-color: #F6F1EA;">' +
                            mediaHtml +
                        '</div>' +
                        '<div class="review-details flex-1 min-w-0 flex flex-col justify-start">' +
                            '<div class="flex items-center gap-1.5 min-w-0">' +
                                '<span class="font-bold text-[#1A1A1A] truncate" style="font-family: \'Metropolis\', \'Helvetica Neue\', Arial, sans-serif;">' + r.name + '</span>' +
                                (r.verified ? '<span class="inline-flex items-center flex-shrink-0 text-[6px] md:text-[8px] px-1 py-[1px] rounded-[3px] gap-[1px]" style="background-color: #EFF6FF; font-family: \'Metropolis\', \'Helvetica Neue\', Arial, sans-serif; font-weight: 600; color: #2563EB;"><svg class="w-[5px] h-[5px] md:w-[6px] md:h-[6px]" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>Verified</span>' : '') +
                            '</div>' +
                            '<h3 class="font-bold text-[#1A1A1A] truncate mt-0.5 leading-snug" style="font-family: \'Metropolis\', \'Helvetica Neue\', Arial, sans-serif;">' + r.title + '</h3>' +
                            '<p class="text-[#6B7280] font-adobe leading-relaxed mt-0.5 review-description-text line-clamp-2">' + r.review + '</p>' +
                        '</div>' +
                    '</div>' +
                    '<div class="review-arrow-container">' +
                        '<svg class="review-card-arrow w-3 h-3 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>' +
                    '</div>' +
                '</div>';

            bindCardClick(card);
            container.appendChild(card);
        }
    }

    function bindCardClick(card) {
        card.addEventListener('click', function() {
            const isExp = this.classList.toggle('expanded');
            const desc = this.querySelector('.review-description-text');
            const arr = this.querySelector('.review-card-arrow');
            if (desc) {
                if (isExp) {
                    desc.classList.remove('line-clamp-2');
                } else {
                    desc.classList.add('line-clamp-2');
                }
            }
            if (arr) {
                arr.style.transform = isExp ? 'rotate(180deg)' : 'none';
            }
        });
    }

    // Bind click to initial 3 cards
    document.querySelectorAll('.review-card').forEach(bindCardClick);

    const revUpBtn = document.getElementById('rev-up-btn');
    const revDownBtn = document.getElementById('rev-down-btn');

    if (revUpBtn) {
        revUpBtn.addEventListener('click', function() {
            activeReviewIndex = (activeReviewIndex === 0) ? reviewsData.length - 1 : activeReviewIndex - 1;
            renderReviews();
        });
    }

    if (revDownBtn) {
        revDownBtn.addEventListener('click', function() {
            activeReviewIndex = (activeReviewIndex === reviewsData.length - 1) ? 0 : activeReviewIndex + 1;
            renderReviews();
        });
    }
})();
</script>

<?php
get_footer();
