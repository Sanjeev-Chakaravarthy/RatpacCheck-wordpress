<?php
/**
 * The Homepage Template for RatpacCheck (100% Pixel-Perfect to Next.js Frontend)
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$all_products = ratpaccheck_get_all_products();

// 4 New Launch Products matching original Next.js NewLaunches component (101, 106, 208, 203)
$launch_ids = array(101, 106, 208, 203);
$launch_badges = array(
    101 => 'New Launch',
    106 => 'Trending',
    208 => 'Most Loved',
    203 => 'New Launch'
);
$launch_products = array();
foreach ($launch_ids as $lid) {
    $p = ratpaccheck_get_product_by_id($lid);
    if ($p) {
        $p['badge'] = $launch_badges[$lid];
        $launch_products[] = $p;
    }
}
if (empty($launch_products)) {
    $launch_products = array_slice($all_products, 0, 4);
}
?>

<!-- ═══════════════════════════════════════════════════════════════════
     1. HERO SECTION (Exact Mobile & Desktop Sliders)
     ═══════════════════════════════════════════════════════════════════ -->

<!-- MOBILE-ONLY Hero Slider -->
<section class="mobile-hero-fix block md:hidden relative w-full overflow-hidden">
    <div id="mobile-hero-scroll" class="flex overflow-x-auto snap-x snap-mandatory" style="scrollbar-width: none; -ms-overflow-style: none;">
        <!-- Slide 1 -->
        <div class="hero-slide w-full h-[220px] pt-2 flex-shrink-0 snap-center relative bg-white overflow-hidden">
            <img src="<?php echo esc_url(ratpaccheck_img_url('images/hero-1.png')); ?>" alt="Hero slide 1" class="absolute inset-0 w-full h-full object-cover block" />
            <div class="absolute left-[5%] bottom-[12%] z-10 flex items-center gap-2" style="font-family: 'Instrument Sans', sans-serif;">
                <a href="<?php echo esc_url(home_url('/products/?concern=acne&category=skin')); ?>" class="bg-black text-white text-[7px] px-2 py-1 rounded-[2px] leading-none font-semibold">Shop now</a>
                <a href="<?php echo esc_url(home_url('/products/')); ?>" class="border border-gray-300 bg-white text-gray-700 text-[7px] px-2 py-1 rounded-[2px] leading-none font-semibold">Buy in store</a>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="hero-slide w-full h-[220px] pt-2 flex-shrink-0 snap-center relative bg-white overflow-hidden">
            <img src="<?php echo esc_url(ratpaccheck_img_url('images/hero-2.png')); ?>" alt="Hero slide 2" class="absolute inset-0 w-full h-full object-cover block" />
            <div class="absolute left-[5%] bottom-[12%] z-10 flex items-center gap-2" style="font-family: 'Instrument Sans', sans-serif;">
                <a href="<?php echo esc_url(home_url('/product-detail/?product_id=203')); ?>" class="bg-black text-white text-[7px] px-2 py-1 rounded-[2px] leading-none font-semibold">Shop now</a>
                <a href="<?php echo esc_url(home_url('/products/')); ?>" class="border border-gray-300 bg-white text-gray-700 text-[7px] px-2 py-1 rounded-[2px] leading-none font-semibold">Buy in store</a>
            </div>
        </div>
    </div>

    <!-- Mobile Arrows -->
    <button type="button" id="mobile-hero-prev" class="absolute left-2 top-1/2 -translate-y-1/2 p-1 bg-white/70 rounded-full z-20" aria-label="Previous slide">
        <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button type="button" id="mobile-hero-next" class="absolute right-2 top-1/2 -translate-y-1/2 p-1 bg-white/70 rounded-full z-20" aria-label="Next slide">
        <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    </button>

    <!-- Mobile Slider Dots -->
    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex gap-1 z-20">
        <button type="button" class="mobile-hero-dot rounded-full transition-all duration-300 bg-black w-3 h-1" data-index="0" aria-label="Go to slide 1"></button>
        <button type="button" class="mobile-hero-dot rounded-full transition-all duration-300 bg-gray-400 w-1 h-1" data-index="1" aria-label="Go to slide 2"></button>
    </div>
</section>

<!-- DESKTOP Hero Slider -->
<section class="hidden md:block relative w-full bg-[#ffffff] overflow-hidden">
    <div id="desktop-hero-container" class="flex overflow-x-auto snap-x snap-mandatory" style="scrollbar-width: none; -ms-overflow-style: none;">
        
        <!-- Slide 1: Acne Solution -->
        <div class="desktop-slide w-full flex-shrink-0 snap-center relative flex" style="height: clamp(520px, 70vh, 780px);">
            <!-- Left Half -->
            <div class="w-1/2 flex flex-col justify-center pl-[10%]">
                <div style="font-family: 'Instrument Sans', sans-serif;">
                    <div class="flex items-center w-full max-w-[420px] gap-3 justify-start">
                        <span class="text-[11px] font-semibold tracking-[0.35em] text-gray-500 uppercase whitespace-nowrap">
                            New Launch
                        </span>
                    </div>
                    <h1 class="font-bold text-black whitespace-pre-line" style="font-size: clamp(36px, 4.5vw, 56px); line-height: 1.08; letter-spacing: -0.02em; margin-top: 16px; margin-bottom: 16px; font-synthesis: none;">Everything You Need for Acne</h1>
                    <p class="text-black font-normal whitespace-pre-wrap" style="font-size: clamp(14px, 1.2vw, 16px); max-width: 420px; line-height: 1.6; letter-spacing: 0; margin-bottom: 28px;">Fight breakouts, control oil, and fade dark spots</p>
                    <p class="text-base text-black font-semibold mb-8 max-w-sm whitespace-pre-wrap"><span><img src="<?php echo esc_url(ratpaccheck_img_url('check.png')); ?>" alt="check" class="w-4 h-4 inline mr-1" /> Controls oil<br /></span><span><img src="<?php echo esc_url(ratpaccheck_img_url('check.png')); ?>" alt="check" class="w-4 h-4 inline mr-1" /> Fades spots<br /></span><span><img src="<?php echo esc_url(ratpaccheck_img_url('check.png')); ?>" alt="check" class="w-4 h-4 inline mr-1" /> Smoothens skin</span></p>
                    <div class="flex gap-4 items-center">
                        <a href="<?php echo esc_url(home_url('/products/?concern=acne&category=skin')); ?>" class="bg-black text-white text-sm md:text-base px-8 py-3 rounded-md leading-none font-semibold hover:opacity-80 transition-opacity shadow-sm flex items-center justify-center">
                            SHOP NOW
                        </a>
                        <a href="<?php echo esc_url(home_url('/products/')); ?>" class="bg-white border border-gray-300 text-black text-sm md:text-base px-8 py-3 rounded-md leading-none font-semibold hover:bg-gray-50 transition-colors shadow-sm flex items-center justify-center">
                            BUY IN STORE
                        </a>
                    </div>
                </div>
            </div>
            <!-- Right Half Image -->
            <div class="w-1/2 relative overflow-hidden">
                <img src="<?php echo esc_url(ratpaccheck_img_url('hero-1-pc.png')); ?>" alt="Hero Slide 1" loading="eager" decoding="async" style="image-rendering: auto;" class="absolute inset-0 w-full h-full object-cover object-center" />
            </div>
        </div>

        <!-- Slide 2: Hair Growth Serum -->
        <div class="desktop-slide w-full flex-shrink-0 snap-center relative flex" style="height: clamp(520px, 70vh, 780px);">
            <!-- Left Half -->
            <div class="w-1/2 flex flex-col justify-center pl-[10%]">
                <div style="font-family: 'Instrument Sans', sans-serif;">
                    <div class="flex items-center w-full max-w-[420px] gap-3 justify-start">
                        <span class="text-[11px] font-semibold tracking-[0.35em] text-gray-500 uppercase whitespace-nowrap">
                            Best Seller
                        </span>
                    </div>
                    <h1 class="font-bold text-black whitespace-pre-line" style="font-size: clamp(40px, 5vw, 68px); line-height: 1; letter-spacing: -0.025em; margin-top: 6px; margin-bottom: 14px; font-synthesis: none;">Hair Growth
Serum</h1>
                    <p class="text-black font-normal whitespace-pre-wrap" style="font-size: clamp(14px, 1.2vw, 16px); max-width: 360px; line-height: 1.45; letter-spacing: -0.015em; margin-bottom: 28px;">Reduces hair fall in 2 months water-based formula</p>
                    <p class="text-base text-black font-semibold mb-8 max-w-sm whitespace-pre-wrap"><span></span></p>
                    <div class="flex gap-4 items-center">
                        <a href="<?php echo esc_url(home_url('/product-detail/?product_id=203')); ?>" class="bg-black text-white text-sm md:text-base px-8 py-3 rounded-md leading-none font-semibold hover:opacity-80 transition-opacity shadow-sm flex items-center justify-center">
                            SHOP NOW
                        </a>
                        <a href="<?php echo esc_url(home_url('/products/')); ?>" class="bg-white border border-gray-300 text-black text-sm md:text-base px-8 py-3 rounded-md leading-none font-semibold hover:bg-gray-50 transition-colors shadow-sm flex items-center justify-center">
                            BUY IN STORE
                        </a>
                    </div>
                </div>
            </div>
            <!-- Right Half Image -->
            <div class="w-1/2 relative overflow-hidden">
                <img src="<?php echo esc_url(ratpaccheck_img_url('hero-2-pc.png')); ?>" alt="Hero Slide 2" loading="eager" decoding="async" style="image-rendering: auto;" class="absolute inset-0 w-full h-full object-cover object-center" />
            </div>
        </div>

    </div>

    <!-- Desktop Navigation Arrows -->
    <button type="button" id="desktop-hero-prev" class="absolute left-6 xl:left-10 top-1/2 -translate-y-1/2 p-3 bg-white/70 backdrop-blur-sm rounded-full z-30 shadow-sm border border-black/5 hover:bg-white transition-all hover:-translate-x-1" aria-label="Previous slide">
        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button type="button" id="desktop-hero-next" class="absolute right-6 xl:right-10 top-1/2 -translate-y-1/2 p-3 bg-white/70 backdrop-blur-sm rounded-full z-30 shadow-sm border border-black/5 hover:bg-white transition-all hover:translate-x-1" aria-label="Next slide">
        <svg class="w-5 h-5 text-black" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
    </button>

    <!-- Desktop Dots -->
    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2 z-30">
        <button type="button" class="desktop-dot rounded-full transition-all duration-300 bg-black w-4 h-2" data-index="0" aria-label="Slide 1"></button>
        <button type="button" class="desktop-dot rounded-full transition-all duration-300 bg-gray-300 w-2 h-2" data-index="1" aria-label="Slide 2"></button>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════════════
     2. CUSTOMER RESULTS SECTION
     ═══════════════════════════════════════════════════════════════════ -->
<section class="section-padding bg-[#F6F1EA]">
    <div class="container-luxury">
        <div class="mb-10 text-center md:mb-14">
            <h2 class="section-title">Customer Results</h2>
        </div>

        <div class="relative w-full">
            <!-- Left Arrow (Mobile) -->
            <button type="button" id="customer-results-prev" aria-label="Previous" class="flex md:hidden absolute slider-arrow left-arrow z-20" style="background: rgba(255,255,255,0.85); color: #333; cursor: pointer; left: 0; top: 40%;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <!-- Right Arrow (Mobile) -->
            <button type="button" id="customer-results-next" aria-label="Next" class="flex md:hidden absolute slider-arrow right-arrow z-20" style="background: rgba(255,255,255,0.85); color: #333; cursor: pointer; right: 0; top: 40%;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>

            <!-- Cards -->
            <?php
            $customer_results = array(
                array('id' => 1, 'label' => 'Acne Reduction', 'image' => 'images/result_acne.png'),
                array('id' => 2, 'label' => 'Hyperpigmentation', 'image' => 'images/result_hyperpigmentation.png'),
                array('id' => 3, 'label' => 'Dark Spots', 'image' => 'images/result_dark_spots.png'),
                array('id' => 4, 'label' => 'Uneven Tone', 'image' => 'images/result_uneven_tone.png'),
            );
            ?>
            <div class="customer-results-slider overflow-x-auto overflow-y-hidden px-4 pb-1 -mb-1 scroll-smooth scrollbar-hide snap-x snap-mandatory md:overflow-hidden md:pb-0 md:mb-0 md:px-0 md:grid md:grid-cols-2 lg:grid-cols-4 md:gap-6 flex gap-3">
                <?php foreach ($customer_results as $item) : ?>
                    <div class="w-[150px] flex-shrink-0 snap-start md:w-auto md:flex-shrink">
                        <div class="aspect-square overflow-hidden rounded-md md:rounded-xl bg-[#f5f0eb] relative transition-shadow duration-300 hover:shadow-md">
                            <img src="<?php echo esc_url(ratpaccheck_img_url($item['image'])); ?>" alt="<?php echo esc_attr($item['label']); ?>" class="w-full h-full object-cover" loading="lazy" />

                            <!-- Centre divider line -->
                            <div class="absolute top-0 bottom-0 left-1/2 w-[1.5px] z-[2]" style="background-color: rgba(255,255,255,0.65);"></div>

                            <!-- BEFORE pill -->
                            <span style="position: absolute; top: 10px; left: 10px; z-index: 3; font-family: 'Metropolis', sans-serif; font-size: 9px; font-weight: 700; color: #555; background-color: rgba(255,255,255,0.88); padding: 3px 9px; border-radius: 999px; letter-spacing: 0.14em; text-transform: uppercase;">
                                Before
                            </span>

                            <!-- AFTER pill -->
                            <span style="position: absolute; top: 10px; right: 10px; z-index: 3; font-family: 'Metropolis', sans-serif; font-size: 9px; font-weight: 700; color: #2E7D32; background-color: rgba(255,255,255,0.88); padding: 3px 9px; border-radius: 999px; letter-spacing: 0.14em; text-transform: uppercase;">
                                After
                            </span>

                            <!-- Bottom gradient -->
                            <div class="absolute bottom-0 left-0 right-0 h-[64px] z-[2]" style="background: linear-gradient(to top, rgba(10,9,8,0.82) 0%, transparent 100%);"></div>

                            <!-- Label text overlaid -->
                            <p style="position: absolute; bottom: 10px; left: 14px; right: 14px; z-index: 3; font-family: 'Metropolis', sans-serif; font-size: 13px; font-weight: 600; color: #F6F1EA; letter-spacing: 0.01em; margin: 0;">
                                <?php echo esc_html($item['label']); ?>
                            </p>
                        </div>

                        <!-- Label below image -->
                        <div class="mt-3 text-center">
                            <span class="title-text text-sm" style="color: #1a1a1a; letter-spacing: 0.01em;">
                                <?php echo esc_html($item['label']); ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════════════
     3. SHOP BY CONCERNS SECTION
     ═══════════════════════════════════════════════════════════════════ -->
<section class="section-padding" style="background-color: #F6F1EA;">
    <div class="container-luxury">
        <h2 class="section-title mb-6 text-left text-[#1a1a1a] md:mb-8">
            Shop By Concerns
        </h2>

        <div class="relative w-full" id="concerns-slider-wrap">
            <!-- Left Arrow -->
            <button type="button" id="concerns-prev" aria-label="Previous" class="hidden md:flex absolute slider-arrow left-arrow z-20" style="left: -16px; top: 40%; background: rgba(255,255,255,0.85); color: #333; cursor: pointer; width: 40px; height: 40px; border-radius: 50%; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <!-- Right Arrow -->
            <button type="button" id="concerns-next" aria-label="Next" class="hidden md:flex absolute slider-arrow right-arrow z-20" style="right: -16px; top: 40%; background: rgba(255,255,255,0.85); color: #333; cursor: pointer; width: 40px; height: 40px; border-radius: 50%; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>

            <?php
            $home_concerns = array(
                'Hairfall'          => 'images/Hair_Fall-min.avif',
                'Dandruff'          => 'images/Dandruff.avif',
                'Tan'               => 'images/Tan.png',
                'Acne'              => 'images/Acne-min.avif',
                'Oiliness'          => 'images/Oiliness-min.avif',
                'Dark Spots'        => 'images/Dark Spots.png',
                'Brightening Skin'  => 'images/Brightening skin.png',
                'Hyperpigmentation' => 'images/Hyperpigmentation.png',
                'Melasma'           => 'images/Melasma.png',
                'Uneven Tone'       => 'images/Uneven_Tone_or_Pigmentation-min.avif',
            );
            $watermarks = array('Brightening Skin', 'Melasma', 'Tan', 'Hyperpigmentation');
            ?>
            <div id="concerns-track-container" class="concerns-slider overflow-x-auto overflow-y-hidden px-4 pb-1 -mb-1 scroll-smooth scrollbar-hide snap-x snap-mandatory md:overflow-hidden md:pb-0 md:mb-0 md:px-0">
                <div id="concerns-track" class="flex gap-3 transition-transform duration-500 ease-out md:w-full md:gap-[16px]">
                    <?php foreach ($home_concerns as $cname => $cimg) : 
                        $is_wm = in_array($cname, $watermarks, true);
                    ?>
                        <div class="w-[150px] md:w-[calc((100%-64px)/5)] flex-shrink-0 snap-start concern-card">
                            <a href="<?php echo esc_url(home_url('/products/?concern=' . urlencode($cname))); ?>" class="block no-underline outline-none w-full cursor-pointer group text-left bg-transparent border-0 p-0">
                                <div class="aspect-square overflow-hidden rounded-md md:rounded-xl bg-[#f5f0eb] transition-shadow duration-300 group-hover:shadow-md">
                                    <img src="<?php echo esc_url(ratpaccheck_img_url($cimg)); ?>" alt="<?php echo esc_attr($cname); ?>" class="<?php echo $is_wm ? 'w-full h-full object-cover object-top scale-125 transition-transform duration-500 group-hover:scale-[1.28]' : 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105'; ?>" loading="lazy" />
                                </div>
                                <div class="mt-3 text-center">
                                    <span class="title-text text-sm" style="display: inline-block; position: relative; line-height: 1.4; color: #1a1a1a; letter-spacing: 0.01em;">
                                        <?php echo esc_html($cname); ?>
                                        <span class="concern-underline" style="display: block; height: 2px; background: #1a1a1a; margin-top: 4px; width: 0%; transition: width 0.3s ease; margin-inline: auto;"></span>
                                    </span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════════════
     4. NEW LAUNCHES SECTION (Exact Screenshot 3 Match)
     ═══════════════════════════════════════════════════════════════════ -->
<section class="section-padding bg-[#F6F1EA]">
    <div class="container-luxury">
        <!-- Heading with Eyebrow line & View All Button -->
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4 md:mb-12">
            <div>
                <div class="mb-3 flex items-center gap-3">
                    <div style="width: 48px; height: 1px; background-color: #000000;"></div>
                    <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 11px; font-weight: 500; letter-spacing: 0.25em; color: #8B6B4A; text-transform: uppercase;">
                        FRESH DROPS
                    </span>
                </div>
                <h2 class="section-title text-[clamp(28px,4vw,48px)] text-[#2C1810] leading-[1.1]">
                    New Launches
                </h2>
                <p class="section-subtitle text-[#8B6B4A] mt-2">
                    the latest from our lab — now in your routine
                </p>
            </div>
            <a href="<?php echo esc_url(home_url('/products/')); ?>" class="btn-outline min-w-fit whitespace-nowrap border-[#2C1810] text-[#2C1810] hidden sm:inline-flex rounded-md px-5 py-2.5 text-sm font-medium hover:bg-[#2C1810] hover:text-white transition-colors" style="border: 1px solid #2C1810;">
                View All Products
            </a>
        </div>

        <!-- 4 Product Cards Grid -->
        <?php
        $launch_meta = array(
            0 => array('id' => 101, 'badge' => 'NEW LAUNCH', 'discount' => 25, 'rating' => '4.8', 'reviews' => '1,500', 'font' => 'INTER REGULAR', 'font_family' => "'Metropolis', 'Helvetica Neue', Arial, sans-serif"),
            1 => array('id' => 106, 'badge' => 'TRENDING',   'discount' => 32, 'rating' => '4.6', 'reviews' => '900',   'font' => 'POPPINS REGULAR', 'font_family' => "'Poppins', sans-serif"),
            2 => array('id' => 208, 'badge' => 'MOST LOVED',  'discount' => 29, 'rating' => '4.7', 'reviews' => '2,100', 'font' => 'ADOBE HEBREW REGULAR', 'font_family' => "'Adobe Hebrew', 'Noto Serif', Georgia, serif"),
            3 => array('id' => 203, 'badge' => 'NEW LAUNCH', 'discount' => 25, 'rating' => '4.9', 'reviews' => '3,200', 'font' => 'ARIAL', 'font_family' => "Arial, sans-serif")
        );
        ?>
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 pb-2 items-stretch">
            <?php foreach ($launch_meta as $idx => $meta) : 
                $prod = ratpaccheck_get_product_by_id($meta['id']);
                if (!$prod) continue;
                $pid = intval($prod['id']);
                $pname = esc_html($prod['name']);
                $psubtitle = isset($prod['subtitle']) ? esc_html($prod['subtitle']) : '';
                $pprice = intval($prod['price']);
                $poriginal = isset($prod['originalPrice']) ? intval($prod['originalPrice']) : 0;
                $pimage = ratpaccheck_img_url($prod['image']);
                $url = ratpaccheck_product_url($pid);
            ?>
                <div class="group product-card h-full card-padding p-2 sm:p-0 flex flex-col cursor-pointer" onclick="window.location.href='<?php echo esc_url($url); ?>';" style="font-family: <?php echo esc_attr($meta['font_family']); ?>; font-weight: 400;">
                    <!-- Square Media Frame -->
                    <div class="square-media-frame aspect-square w-full">
                        <img src="<?php echo esc_url($pimage); ?>" alt="<?php echo esc_attr($pname); ?>" class="square-media group-hover:scale-[1.1] sm:group-hover:scale-[1.12]" loading="lazy" />
                        
                        <!-- Badges: Row of Left Pill + Right Discount Pill -->
                        <div class="product-card-badge-frame">
                            <div class="product-card-badge-row">
                                <span class="product-card-badge">
                                    <?php echo esc_html($meta['badge']); ?>
                                </span>
                                <span class="product-card-discount">
                                    -<?php echo esc_html($meta['discount']); ?>%
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Details Stack -->
                    <div class="product-card-stack flex flex-col flex-1 mt-3">
                        <div class="space-y-1">
                            <h3 class="product-card-title text-[13px] sm:text-base leading-tight line-clamp-2 min-h-[34px]">
                                <span style="position: relative; display: inline-block;">
                                    <?php echo $pname; ?>
                                </span>
                            </h3>
                            <p class="product-card-subtitle text-[12px] sm:text-sm line-clamp-2 min-h-[32px]">
                                <?php echo $psubtitle; ?>
                            </p>
                        </div>

                        <div class="space-y-2 pt-2 min-h-[56px]">
                            <!-- Star Rating -->
                            <div class="flex items-center gap-1.5">
                                <div style="display: flex; align-items: center; gap: 2px;">
                                    <?php for ($s = 0; $s < 5; $s++) : ?>
                                        <svg aria-hidden="true" class="lucide lucide-star" fill="#C9A84C" height="12" stroke="#C9A84C" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" width="12"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path></svg>
                                    <?php endfor; ?>
                                </div>
                                <span class="text-[11px] sm:text-xs text-[#8B8178]">
                                    <?php echo esc_html($meta['rating']); ?> (<?php echo esc_html($meta['reviews']); ?>)
                                </span>
                            </div>

                            <!-- Prices -->
                            <div class="flex items-center gap-2">
                                <span class="product-price text-[14px] sm:text-base font-semibold text-black">
                                    <?php echo ratpaccheck_format_price($pprice); ?>
                                </span>
                                <?php if ($poriginal > $pprice) : ?>
                                    <span class="text-[13px] text-[#AAA5A0] line-through">
                                        <?php echo ratpaccheck_format_price($poriginal); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Add to Cart & Font Strip -->
                        <div class="mt-auto pt-2">
                            <button 
                                type="button" 
                                class="btn-add-to-cart"
                                style="width: 100%; padding: 12px 0; background-color: #1A1A1A; color: #FFFFFF; border: none; border-radius: 12px; font-family: inherit; font-size: 13px; font-weight: 400; letter-spacing: 0.03em; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; transition: background-color 0.2s ease;"
                                data-id="<?php echo esc_attr($pid); ?>"
                                data-name="<?php echo esc_attr($pname); ?>"
                                data-price="<?php echo esc_attr($pprice); ?>"
                                data-original-price="<?php echo esc_attr($poriginal); ?>"
                                data-image="<?php echo esc_url($pimage); ?>"
                                data-subtitle="<?php echo esc_attr($psubtitle); ?>"
                                onclick="event.stopPropagation();"
                            >
                                <svg aria-hidden="true" class="lucide lucide-shopping-bag" fill="none" height="15" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="15"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
                                <span>Add to Cart</span>
                            </button>

                            <!-- Font Test Strip -->
                            <div style="margin-top: 10px; text-align: center; padding: 6px; background-color: #ebe2d8; border-radius: 6px; font-size: 11px; text-transform: uppercase; line-height: 1.2; font-family: Arial;">
                                Using: <span style="font-weight: 600;"><?php echo esc_html($meta['font']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════════════
     5. ABOUT SECTION (Exact "Our Promise" & 3 Cards)
     ═══════════════════════════════════════════════════════════════════ -->
<section class="section-padding bg-[#F6F1EA]">
    <div class="container-luxury">
        <!-- Heading -->
        <div class="mb-10 text-center md:mb-16">
            <div style="display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 16px;">
                <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 11px; font-weight: 500; letter-spacing: 0.25em; color: #555555; text-transform: uppercase;">
                    Our Promise
                </span>
            </div>

            <h2 class="section-title mx-auto max-w-[640px]">
                We Care About Your<br />
                <span style="color: #555555;">Skin and Hair</span>
            </h2>

            <p class="section-subtitle mx-auto mt-5 max-w-[520px] text-[#555555]">
                Built by creators. Backed by trichologists. Chosen by millions. This is science that actually cares.
            </p>
        </div>

        <!-- Three Cards -->
        <div class="grid grid-cols-1 gap-4 sm:gap-5 md:grid-cols-3 md:gap-6">
            <!-- Card 1: Chemical Free -->
            <div class="w-full rounded-xl border border-gray-200 bg-[#f5f1ea] shadow-sm p-5 md:p-6 text-center md:text-left transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="w-12 h-12 bg-black rounded-full flex items-center justify-center mb-4 mx-auto md:mx-0 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 20A7 7 0 019.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
                </div>
                <h3 class="font-metropolis text-lg md:text-xl font-semibold text-black">Chemical Free</h3>
                <p class="font-adobe mt-2 text-sm md:text-base leading-relaxed text-gray-600">
                    No sulphates, no parabens, no harmful additives. Every formula is built from clinically-safe, skin-friendly ingredients.
                </p>
            </div>

            <!-- Card 2: Affordable -->
            <div class="w-full rounded-xl border border-gray-200 bg-[#f5f1ea] shadow-sm p-5 md:p-6 text-center md:text-left transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="w-12 h-12 bg-black rounded-full flex items-center justify-center mb-4 mx-auto md:mx-0 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-metropolis text-lg md:text-xl font-semibold text-black">Affordable</h3>
                <p class="font-adobe mt-2 text-sm md:text-base leading-relaxed text-gray-600">
                    Premium quality shouldn't come at a premium price. We cut middlemen and deliver lab-grade care at honest prices.
                </p>
            </div>

            <!-- Card 3: Clinically Tested -->
            <div class="w-full rounded-xl border border-gray-200 bg-[#f5f1ea] shadow-sm p-5 md:p-6 text-center md:text-left transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
                <div class="w-12 h-12 bg-black rounded-full flex items-center justify-center mb-4 mx-auto md:mx-0 text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                </div>
                <h3 class="font-metropolis text-lg md:text-xl font-semibold text-black">Clinically Tested</h3>
                <p class="font-adobe mt-2 text-sm md:text-base leading-relaxed text-gray-600">
                    94% of users saw measurable results within 4 weeks. Every product undergoes rigorous in-vitro and clinical testing.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════════════
     6. REVIEWS SECTION (Exact Screenshot 1 Match)
     ═══════════════════════════════════════════════════════════════════ -->
<section class="section-padding bg-[#F9F5EF]">
    <div class="container-luxury">
        <!-- Header -->
        <div class="mb-8 md:mb-10">
            <h2 class="section-title mb-1.5 font-metropolis font-semibold text-black" style="font-size: clamp(28px, 4vw, 42px);">
                What Our Customers Say
            </h2>
            <div class="flex items-center gap-2">
                <div style="display: flex; gap: 1px;">
                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="#1a1a1a" stroke="#1a1a1a" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    <?php endfor; ?>
                </div>
                <span class="font-adobe text-[13px] sm:text-sm text-[#888]">
                    4.8 · 7,300+ reviews
                </span>
            </div>
        </div>

        <?php
        $reviews = array(
            array(
                'id' => 1,
                'name' => 'Priya Sharma',
                'date' => 'Jan 2026',
                'verified' => true,
                'rating' => 5,
                'title' => 'Hair fall reduced dramatically',
                'review' => 'I\'ve been using the Scalp Revival Serum for 8 weeks and the results are genuinely shocking. My hair fall reduced by at least 70%. The formula is light, non-greasy and the results spoke for themselves within the first month.',
                'product' => 'Scalp Revival Serum'
            ),
            array(
                'id' => 2,
                'name' => 'Ananya Reddy',
                'date' => 'Feb 2026',
                'verified' => true,
                'rating' => 5,
                'title' => 'Finally dandruff-free',
                'review' => 'After years of struggling with stubborn dandruff I\'d pretty much given up. This shampoo cleared my scalp within 3 washes. I can actually wear dark colours again without worrying!',
                'product' => 'Anti-Dandruff Shampoo'
            ),
            array(
                'id' => 3,
                'name' => 'Meera Krishnan',
                'date' => 'Feb 2026',
                'verified' => true,
                'rating' => 5,
                'title' => 'Incredibly luxurious feel',
                'review' => 'I watched the YouTube video where the founder talks about the ingredients and I was sold. The mask feels incredibly luxurious and my hair is visibly softer and shinier. RatpacCheck is now my go-to brand.',
                'product' => 'Deep Nourish Hair Mask'
            ),
            array(
                'id' => 4,
                'name' => 'Rohan Mehta',
                'date' => 'Feb 2026',
                'verified' => true,
                'rating' => 5,
                'title' => 'Visible regrowth in 3 months',
                'review' => 'My dermatologist actually recommended trying RatpacCheck before going for stronger treatments. Three months later I genuinely don\'t need to. Baby hairs all along my hairline and thickness I haven\'t had in years.',
                'product' => 'Hair Growth Oil'
            ),
            array(
                'id' => 5,
                'name' => 'Deepa Nair',
                'date' => 'Jan 2026',
                'verified' => true,
                'rating' => 5,
                'title' => 'Worth every single rupee',
                'review' => 'Skeptical at first because of the price but this serum is worth every rupee. Fine hair completely transformed. I\'ve recommended it to my entire family — and they\'re all converts now.',
                'product' => 'Scalp Revival Serum'
            )
        );
        ?>
        <div class="relative" id="reviews-carousel-wrap">
            <!-- Left Circular Arrow -->
            <button type="button" id="reviews-prev" aria-label="Previous reviews" class="hidden md:flex absolute items-center justify-center cursor-pointer transition-all z-20" style="left: -14px; top: 50%; transform: translateY(-50%); width: 42px; height: 42px; border-radius: 50%; border: none; background: #fff; color: #1a1a1a; box-shadow: 0 4px 14px rgba(0,0,0,0.12);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>

            <!-- Right Circular Arrow -->
            <button type="button" id="reviews-next" aria-label="Next reviews" class="hidden md:flex absolute items-center justify-center cursor-pointer transition-all z-20" style="right: -14px; top: 50%; transform: translateY(-50%); width: 42px; height: 42px; border-radius: 50%; border: none; background: #fff; color: #1a1a1a; box-shadow: 0 4px 14px rgba(0,0,0,0.12);">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>

            <!-- Reviews Track Container -->
            <div class="overflow-x-auto snap-x snap-mandatory scrollbar-hide px-1 scroll-smooth" id="reviews-track-container">
                <div class="flex gap-4 md:gap-[24px]">
                    <?php foreach ($reviews as $rev) : ?>
                        <div class="flex-none review-slide-card snap-center">
                            <div class="review-card flex h-full flex-col rounded-2xl border border-[#e8e8e8] bg-white p-4 md:p-5 shadow-sm hover:shadow-md transition-shadow">
                                <!-- Top row: avatar, name, verified, date -->
                                <div class="flex items-center justify-between mb-3.5">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-[#f2f2f2] flex items-center justify-center font-adobe text-xs font-semibold text-[#555] flex-shrink-0">
                                            <?php 
                                            $parts = explode(' ', $rev['name']);
                                            echo esc_html(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
                                            ?>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-1.5">
                                                <span class="font-metropolis text-[13px] sm:text-sm font-medium text-[#1a1a1a]">
                                                    <?php echo esc_html($rev['name']); ?>
                                                </span>
                                                <span style="display: inline-flex; align-items: center; gap: 3px; padding: 1px 6px; border-radius: 4px; background-color: #f0f7ff; font-size: 10px; font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-weight: 500; color: #4a90d9; line-height: 1.6;">
                                                    <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                    Verified
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="font-adobe text-xs text-[#aaa]"><?php echo esc_html($rev['date']); ?></span>
                                </div>

                                <!-- Stars -->
                                <div style="display: flex; gap: 1px; margin-bottom: 10px;">
                                    <?php for ($s = 1; $s <= 5; $s++) : ?>
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="#1a1a1a" stroke="#1a1a1a" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                    <?php endfor; ?>
                                </div>

                                <!-- Title -->
                                <h3 class="font-metropolis mb-2 text-[15px] sm:text-[16px] font-medium leading-snug text-[#1a1a1a]">
                                    <?php echo esc_html($rev['title']); ?>
                                </h3>

                                <!-- Body -->
                                <p class="font-adobe mb-4 flex-1 text-[14px] sm:text-[15px] leading-relaxed text-[#777]">
                                    <?php echo esc_html($rev['review']); ?>
                                </p>

                                <!-- Product Tag -->
                                <div style="display: flex; align-items: center; gap: 8px; padding-top: 14px; border-top: 1px solid #f2f2f2;">
                                    <div style="width: 28px; height: 28px; border-radius: 6px; background-color: #f8f5ef; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <span style="font-size: 12px;">🧴</span>
                                    </div>
                                    <span class="font-adobe text-xs text-[#999]">
                                        <?php echo esc_html($rev['product']); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════════════════════
     7. FOLLOW OUR JOURNEY SECTION (Exact YouTube & Instagram Cards)
     ═══════════════════════════════════════════════════════════════════ -->
<section class="section-padding bg-[#F6F1EA]">
    <div class="container-luxury">
        <!-- Section Header -->
        <div class="mb-10 text-center md:mb-14">
            <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 11px; font-weight: 500; letter-spacing: 0.25em; color: #555555; text-transform: uppercase; display: block; margin-bottom: 14px;">
                @RATPACCHECK
            </span>
            <h2 class="section-title mb-3">Follow Our Journey</h2>
            <p class="section-subtitle text-[#555555]">
                Real results. Real people. Real haircare science.
            </p>
        </div>

        <!-- 2 Social Cards Grid -->
        <div class="follow-grid mx-auto grid max-w-6xl grid-cols-1 gap-4 md:grid-cols-2 md:gap-6">
            <!-- YouTube Card -->
            <div class="rounded-2xl overflow-hidden bg-white shadow-sm flex flex-col transition-all duration-300 hover:shadow-xl group">
                <div class="relative w-full aspect-[3/4] rounded-t-2xl overflow-hidden flex items-center justify-center bg-white p-4">
                    <img src="<?php echo esc_url(ratpaccheck_img_url('images/you-tube.jpg')); ?>" alt="Follow us on YouTube" class="h-auto w-auto max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-400" loading="lazy" />
                </div>
                <div class="flex items-center justify-between gap-3 p-5 pb-6 sm:p-4 mt-3 bg-white border-t border-gray-50">
                    <span class="font-metropolis text-[15px] sm:text-[16px] font-medium text-[#1a1a1a]">
                        Follow us on YouTube
                    </span>
                    <a href="https://www.youtube.com/@RatpacCheck" target="_blank" rel="noopener noreferrer" class="touch-button inline-flex items-center gap-1.5 rounded-xl border border-[#1a1a1a] font-adobe text-[13px] font-medium px-4 py-2 hover:bg-[#1a1a1a] hover:text-white transition-all text-[#1a1a1a]">
                        <span>Watch on YouTube</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Instagram Card -->
            <div class="rounded-2xl overflow-hidden bg-white shadow-sm flex flex-col transition-all duration-300 hover:shadow-xl group">
                <div class="relative w-full aspect-[3/4] rounded-t-2xl overflow-hidden flex items-center justify-center bg-white p-4">
                    <img src="<?php echo esc_url(ratpaccheck_img_url('images/insta.jpg')); ?>" alt="Follow us on Instagram" class="h-auto w-auto max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-400" loading="lazy" />
                </div>
                <div class="flex items-center justify-between gap-3 p-5 pb-6 sm:p-4 mt-3 bg-white border-t border-gray-50">
                    <span class="font-metropolis text-[15px] sm:text-[16px] font-medium text-[#1a1a1a]">
                        Follow us on Instagram
                    </span>
                    <a href="https://www.instagram.com/ratpaccheck.in/" target="_blank" rel="noopener noreferrer" class="touch-button inline-flex items-center gap-1.5 rounded-xl border border-[#1a1a1a] font-adobe text-[13px] font-medium px-4 py-2 hover:bg-[#1a1a1a] hover:text-white transition-all text-[#1a1a1a]">
                        <span>View Instagram</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.concern-card:hover .concern-underline {
    width: 100% !important;
}
.review-card:hover {
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06) !important;
    border-color: #d8d8d8 !important;
}
</style>

<?php
get_footer();
