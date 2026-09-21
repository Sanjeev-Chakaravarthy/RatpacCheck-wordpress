<?php
/**
 * Template Name: Products Catalog
 * Description: All products catalog with sidebar filters, mobile accordion filters, and product grid — 100% Matching Vercel.
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$all_products = ratpaccheck_get_all_products();

// ── Read Query Parameters (1:1 with Vercel searchParams) ──
$category_param = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';
$concern_param = isset($_GET['concern']) ? sanitize_text_field($_GET['concern']) : '';
$type_param = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : '';

$selected_category = null;
$selected_concerns = array();
$selected_types = array();

if (!empty($category_param)) {
    $norm_cat = ucfirst(strtolower($category_param));
    if ($norm_cat === 'Skin' || $norm_cat === 'Hair') {
        $selected_category = $norm_cat;
    }
}

if (!empty($concern_param)) {
    if (strcasecmp($concern_param, 'Skin') === 0 || strcasecmp($concern_param, 'Hair') === 0) {
        $selected_category = ucfirst(strtolower($concern_param));
    } else {
        $selected_concerns[] = $concern_param;
        if (empty($selected_category)) {
            $selected_category = in_array(strtolower($concern_param), array('hairfall', 'dandruff')) ? 'Hair' : 'Skin';
        }
    }
}

if (!empty($type_param)) {
    $selected_types[] = $type_param;
}

// ── Concern Groups and Page Heading (1:1 with filters.ts) ──
$heading_map = array(
    'acne' => 'Acne / Oily Skin',
    'oiliness' => 'Acne / Oily Skin',
    'dark spots' => 'Harder Dark Spots',
    'brightening' => 'Brightening / Hyperpigmentation / Melasma / Tan',
    'brightening skin' => 'Brightening / Hyperpigmentation / Melasma / Tan',
    'hyperpigmentation' => 'Brightening / Hyperpigmentation / Melasma / Tan',
    'melasma' => 'Brightening / Hyperpigmentation / Melasma / Tan',
    'tan' => 'Brightening / Hyperpigmentation / Melasma / Tan',
    'dehydrated skin' => 'Dehydrated Skin',
    'hairfall' => 'Hairfall',
    'dandruff' => 'Dandruff',
);

$page_title = 'All Products';
if (!empty($selected_concerns)) {
    $c_key = strtolower($selected_concerns[0]);
    if (isset($heading_map[$c_key])) {
        $page_title = $heading_map[$c_key];
    } else {
        $page_title = $selected_concerns[0];
    }
} elseif (!empty($selected_category)) {
    $page_title = $selected_category;
}

// ── Filter Products List ──
$filtered_products = array();
foreach ($all_products as $p) {
    // 1. Category Filter
    if ($selected_category) {
        if (!isset($p['category']) || strcasecmp($p['category'], $selected_category) !== 0) {
            continue;
        }
    }

    // 2. Concern Filter
    if (!empty($selected_concerns)) {
        $matched_concern = false;
        $active_concern = strtolower($selected_concerns[0]);

        if (isset($p['concerns']) && is_array($p['concerns'])) {
            $p_concerns_lower = array_map('strtolower', $p['concerns']);

            if (in_array($active_concern, array('acne', 'oiliness'))) {
                if (in_array('acne', $p_concerns_lower) || in_array('oiliness', $p_concerns_lower)) {
                    $matched_concern = true;
                }
            } elseif (in_array($active_concern, array('brightening', 'brightening skin', 'hyperpigmentation', 'melasma', 'tan'))) {
                if (in_array('brightening skin', $p_concerns_lower) || in_array('hyperpigmentation', $p_concerns_lower) || in_array('melasma', $p_concerns_lower) || in_array('tan', $p_concerns_lower)) {
                    $matched_concern = true;
                }
            } elseif ($active_concern === 'dark spots') {
                if (in_array('dark spots', $p_concerns_lower)) {
                    $matched_concern = true;
                }
            } elseif ($active_concern === 'dehydrated skin') {
                if (in_array('dehydrated skin', $p_concerns_lower)) {
                    $matched_concern = true;
                }
            } else {
                foreach ($p_concerns_lower as $plc) {
                    if (strpos($plc, $active_concern) !== false) {
                        $matched_concern = true;
                        break;
                    }
                }
            }
        }
        if (!$matched_concern) {
            continue;
        }
    }

    // 3. Type Filter
    if (!empty($selected_types)) {
        $active_type = strtolower($selected_types[0]);
        if (!isset($p['type']) || strcasecmp($p['type'], $active_type) !== 0) {
            continue;
        }
    }

    $filtered_products[] = $p;
}

// ── Sort by PRODUCT_ORDER (exact match to Vercel's productData.ts) ──
$product_order = array(
    "Hydrating Face Cleanser",
    "Hydrating Body Cleanser",
    "6% Glycolic + Mulberry Exfoliating Toner",
    "5% Multi-Functional Face Serum",
    "10% Multi-Functional Face Serum",
    "Multi Layer Hydrating Serum",
    "Deep Glow Face Serum",
    "Light Weight Moisturiser",
    "Multi-Functional Sunscreen 50+",
    "Anti-Hairfall Oil",
    "Hair-Care Shampoo",
    "Hair Growth Serum",
    "Anti-Dandruff Oil",
    "Anti-Dandruff Shampoo",
    "Rinse-Off Conditioner",
);

usort($filtered_products, function($a, $b) use ($product_order) {
    $indexA = array_search($a['name'], $product_order);
    $indexB = array_search($b['name'], $product_order);
    if ($indexA === false) $indexA = PHP_INT_MAX;
    if ($indexB === false) $indexB = PHP_INT_MAX;
    return $indexA - $indexB;
});

$product_count = count($filtered_products);

// Visible concerns for current category
$skin_concerns = array("Acne", "Hyperpigmentation", "Dark Spots", "Melasma", "Tan", "Brightening Skin", "Oiliness", "Dehydrated Skin");
$hair_concerns = array("Hairfall", "Dandruff");
$visible_concerns = ($selected_category === 'Hair') ? $hair_concerns : ($selected_category === 'Skin' ? $skin_concerns : array_merge($skin_concerns, $hair_concerns));
$type_options = array("Cleanser", "Toner", "Serum", "Moisturizer", "Sunscreen");

// ══════════════════════════════════════════════════════════════════════════
// SKIN CARE ROUTINE — Fully Data-Driven, Variable Step Count (3 / 4 / 5)
// 'special' steps render as a wide horizontal card with multi-line description.
// footer_notes[] is per-concern configurable.
// ══════════════════════════════════════════════════════════════════════════
$concern_routines = array(

    // ── ACNE ── 3 steps ────────────────────────────────────────────────
    'acne' => array(
        'label'        => 'Acne',
        'subtitle'     => 'Acne, Pimples, Very Lighter Dark Spots',
        'footer_notes' => array(
            'Suitable for <strong>ALL SKIN TYPES</strong>.',
            'Gentle Formula even suitable for <strong>BEGINNERS</strong>',
        ),
        'steps' => array(
            array('num'=>1,'timing'=>'AM, PM','instruction'=>'Step 1 : Wash Your Face',
                  'product_name'=>'Hydrating Face Cleanser','image'=>'/images/Hydrating%20face%20cleanser.jpeg','special'=>false),
            array('num'=>2,'timing'=>'AM, PM','instruction'=>'Step 2 : Apply serum a few drops on skin & gently massage.',
                  'product_name'=>'5% Multi-Functional Face Serum','image'=>'/images/Multi-functional%20(Face%20serum%205%25).jpeg','special'=>false),
            array('num'=>3,'timing'=>'AM, PM','instruction'=>'Step 3 : Moisturizer (optional)',
                  'product_name'=>'Light Weight Moisturiser','image'=>'/images/Light%20weight%20moisturiser.jpeg','special'=>false),
        ),
    ),

    // ── HYPERPIGMENTATION ── 5 steps ───────────────────────────────────
    'hyperpigmentation' => array(
        'label'        => 'Hyperpigmentation',
        'subtitle'     => 'Brighten Skin, Melasma, Hyperpigmentation',
        'footer_notes' => array(
            'Suitable for <strong>ALL SKIN TYPES</strong>.',
            'Gentle Formula even suitable for <strong>BEGINNERS</strong>',
        ),
        'steps' => array(
            array('num'=>1,'timing'=>'AM, PM','instruction'=>'Step 1 : Wash Your Face',
                  'product_name'=>'Hydrating Face Cleanser','image'=>'/images/Hydrating%20face%20cleanser.jpeg','special'=>false),
            array('num'=>2,'timing'=>'AM, PM','instruction'=>'Step 2 : Apply serum a few drops on skin & gently massage.',
                  'product_name'=>'Deep Glow Face Serum','image'=>'/images/Deep%20glow%20(Face%20serum).jpeg','special'=>false),
            array('num'=>3,'timing'=>'AM, PM','instruction'=>'Step 3 : Moisturizer',
                  'product_name'=>'Light Weight Moisturiser','image'=>'/images/Light%20weight%20moisturiser.jpeg','special'=>false),
            array('num'=>4,'timing'=>'AM','instruction'=>'Step 4 : Sunscreen',
                  'product_name'=>'Multi-Functional Sunscreen 50+','image'=>'/images/Multi-functional%20Sunscreen%2050%2B.jpeg','special'=>false),
            array('num'=>5,'timing'=>'PM','instruction'=>'Step 5 : Exfoliating Toner (Weekly)',
                  'description'=>"Apply toner Weekly twice or thrice only at night.\nAfter toner applied, use Our Multi Layer Hydrating Serum Strictly. No other serums.",
                  'product_name'=>'6% Glycolic + Mulberry Exfoliating Toner','image'=>'/images/Mulberry%20(Exfoliating%20Toner).jpeg','special'=>true),
        ),
    ),

    // ── DARK SPOTS ── 3 steps ──────────────────────────────────────────
    'dark spots' => array(
        'label'        => 'Dark Spots',
        'subtitle'     => 'Dark Spots, Post-Acne Marks, Very Lighter Dark Spots',
        'footer_notes' => array(
            'Suitable for <strong>ALL SKIN TYPES</strong>.',
            'Gentle Formula even suitable for <strong>BEGINNERS</strong>',
        ),
        'steps' => array(
            array('num'=>1,'timing'=>'AM, PM','instruction'=>'Step 1 : Wash Your Face',
                  'product_name'=>'Hydrating Face Cleanser','image'=>'/images/Hydrating%20face%20cleanser.jpeg','special'=>false),
            array('num'=>2,'timing'=>'AM, PM','instruction'=>'Step 2 : Apply serum a few drops on skin & gently massage.',
                  'product_name'=>'5% Multi-Functional Face Serum','image'=>'/images/Multi-functional%20(Face%20serum%205%25).jpeg','special'=>false),
            array('num'=>3,'timing'=>'AM, PM','instruction'=>'Step 3 : Moisturizer (optional)',
                  'product_name'=>'Light Weight Moisturiser','image'=>'/images/Light%20weight%20moisturiser.jpeg','special'=>false),
        ),
    ),

    // ── MELASMA ── 5 steps ─────────────────────────────────────────────
    'melasma' => array(
        'label'        => 'Melasma',
        'subtitle'     => 'Melasma, Hormonal Pigmentation, Deep Discolouration',
        'footer_notes' => array(
            'Suitable for <strong>ALL SKIN TYPES</strong>.',
            'Consistent use recommended — results visible in <strong>4–8 weeks</strong>',
        ),
        'steps' => array(
            array('num'=>1,'timing'=>'AM, PM','instruction'=>'Step 1 : Wash Your Face',
                  'product_name'=>'Hydrating Face Cleanser','image'=>'/images/Hydrating%20face%20cleanser.jpeg','special'=>false),
            array('num'=>2,'timing'=>'AM, PM','instruction'=>'Step 2 : Apply brightening serum & gently massage.',
                  'product_name'=>'Deep Glow Face Serum','image'=>'/images/Deep%20glow%20(Face%20serum).jpeg','special'=>false),
            array('num'=>3,'timing'=>'AM, PM','instruction'=>'Step 3 : Moisturizer',
                  'product_name'=>'Light Weight Moisturiser','image'=>'/images/Light%20weight%20moisturiser.jpeg','special'=>false),
            array('num'=>4,'timing'=>'AM','instruction'=>'Step 4 : Sunscreen (must — prevents melasma from returning)',
                  'product_name'=>'Multi-Functional Sunscreen 50+','image'=>'/images/Multi-functional%20Sunscreen%2050%2B.jpeg','special'=>false),
            array('num'=>5,'timing'=>'PM','instruction'=>'Step 5 : Exfoliating Toner (Weekly)',
                  'description'=>"Apply toner Weekly twice or thrice only at night.\nAfter toner applied, use Our Multi Layer Hydrating Serum Strictly. No other serums.",
                  'product_name'=>'6% Glycolic + Mulberry Exfoliating Toner','image'=>'/images/Mulberry%20(Exfoliating%20Toner).jpeg','special'=>true),
        ),
    ),

    // ── TAN ── 4 steps ─────────────────────────────────────────────────
    'tan' => array(
        'label'        => 'Tan',
        'subtitle'     => 'Sun Tan, UV-Induced Darkening, Dull & Uneven Skin',
        'footer_notes' => array(
            'Suitable for <strong>ALL SKIN TYPES</strong>.',
            'Use <strong>Sunscreen daily</strong> for best de-tan results',
        ),
        'steps' => array(
            array('num'=>1,'timing'=>'AM, PM','instruction'=>'Step 1 : Wash Your Face',
                  'product_name'=>'Hydrating Face Cleanser','image'=>'/images/Hydrating%20face%20cleanser.jpeg','special'=>false),
            array('num'=>2,'timing'=>'AM, PM','instruction'=>'Step 2 : Apply brightening serum a few drops & massage.',
                  'product_name'=>'Deep Glow Face Serum','image'=>'/images/Deep%20glow%20(Face%20serum).jpeg','special'=>false),
            array('num'=>3,'timing'=>'AM, PM','instruction'=>'Step 3 : Moisturizer',
                  'product_name'=>'Light Weight Moisturiser','image'=>'/images/Light%20weight%20moisturiser.jpeg','special'=>false),
            array('num'=>4,'timing'=>'AM','instruction'=>'Step 4 : Sunscreen (must — prevents re-tanning)',
                  'product_name'=>'Multi-Functional Sunscreen 50+','image'=>'/images/Multi-functional%20Sunscreen%2050%2B.jpeg','special'=>false),
        ),
    ),

    // ── BRIGHTENING SKIN ── 5 steps ────────────────────────────────────
    'brightening skin' => array(
        'label'        => 'Brightening Skin',
        'subtitle'     => 'Brighten Skin, Melasma, Hyperpigmentation',
        'footer_notes' => array(
            'Suitable for <strong>ALL SKIN TYPES</strong>.',
            'Gentle Formula even suitable for <strong>BEGINNERS</strong>',
        ),
        'steps' => array(
            array('num'=>1,'timing'=>'AM, PM','instruction'=>'Step 1 : Wash Your Face',
                  'product_name'=>'Hydrating Face Cleanser','image'=>'/images/Hydrating%20face%20cleanser.jpeg','special'=>false),
            array('num'=>2,'timing'=>'AM, PM','instruction'=>'Step 2 : Apply serum a few drops on skin & gently massage.',
                  'product_name'=>'Deep Glow Face Serum','image'=>'/images/Deep%20glow%20(Face%20serum).jpeg','special'=>false),
            array('num'=>3,'timing'=>'AM, PM','instruction'=>'Step 3 : Moisturizer',
                  'product_name'=>'Light Weight Moisturiser','image'=>'/images/Light%20weight%20moisturiser.jpeg','special'=>false),
            array('num'=>4,'timing'=>'AM','instruction'=>'Step 4 : Sunscreen',
                  'product_name'=>'Multi-Functional Sunscreen 50+','image'=>'/images/Multi-functional%20Sunscreen%2050%2B.jpeg','special'=>false),
            array('num'=>5,'timing'=>'PM','instruction'=>'Step 5 : Exfoliating Toner (Weekly)',
                  'description'=>"Apply toner Weekly twice or thrice only at night.\nAfter toner applied, use Our Multi Layer Hydrating Serum Strictly. No other serums.",
                  'product_name'=>'6% Glycolic + Mulberry Exfoliating Toner','image'=>'/images/Mulberry%20(Exfoliating%20Toner).jpeg','special'=>true),
        ),
    ),

    // ── OILINESS ── 4 steps ────────────────────────────────────────────
    'oiliness' => array(
        'label'        => 'Oiliness',
        'subtitle'     => 'Excess Sebum, Oily & Shiny Skin, Enlarged Pores',
        'footer_notes' => array(
            'Suitable for <strong>ALL SKIN TYPES</strong>.',
            'Non-comedogenic formula — <strong>will not clog pores</strong>',
        ),
        'steps' => array(
            array('num'=>1,'timing'=>'AM, PM','instruction'=>'Step 1 : Wash Your Face to remove excess oil.',
                  'product_name'=>'Hydrating Face Cleanser','image'=>'/images/Hydrating%20face%20cleanser.jpeg','special'=>false),
            array('num'=>2,'timing'=>'AM, PM','instruction'=>'Step 2 : Apply oil-control serum & gently massage.',
                  'product_name'=>'5% Multi-Functional Face Serum','image'=>'/images/Multi-functional%20(Face%20serum%205%25).jpeg','special'=>false),
            array('num'=>3,'timing'=>'AM, PM','instruction'=>'Step 3 : Lightweight Moisturizer',
                  'product_name'=>'Light Weight Moisturiser','image'=>'/images/Light%20weight%20moisturiser.jpeg','special'=>false),
            array('num'=>4,'timing'=>'AM','instruction'=>'Step 4 : Sunscreen (non-comedogenic — AM only)',
                  'product_name'=>'Multi-Functional Sunscreen 50+','image'=>'/images/Multi-functional%20Sunscreen%2050%2B.jpeg','special'=>false),
        ),
    ),

    // ── DEHYDRATED SKIN ── 3 steps ─────────────────────────────────────
    'dehydrated skin' => array(
        'label'        => 'Dehydrated Skin',
        'subtitle'     => 'Dehydrated, Dry, Moisture-Lacking & Tight Skin',
        'footer_notes' => array(
            'Suitable for <strong>ALL SKIN TYPES</strong>.',
            'Drink water & use consistently for <strong>plump hydrated skin</strong>',
        ),
        'steps' => array(
            array('num'=>1,'timing'=>'AM, PM','instruction'=>'Step 1 : Wash Your Face with a gentle hydrating cleanser.',
                  'product_name'=>'Hydrating Face Cleanser','image'=>'/images/Hydrating%20face%20cleanser.jpeg','special'=>false),
            array('num'=>2,'timing'=>'AM, PM','instruction'=>'Step 2 : Apply hydrating serum to damp skin & press in gently.',
                  'product_name'=>'Multi Layer Hydrating Serum','image'=>'/images/multi%20layer%20hydrating%20serum.png','special'=>false),
            array('num'=>3,'timing'=>'AM, PM','instruction'=>'Step 3 : Moisturizer to seal all hydration in.',
                  'product_name'=>'Light Weight Moisturiser','image'=>'/images/Light%20weight%20moisturiser.jpeg','special'=>false),
        ),
    ),

); // end $concern_routines

// Determine active routine
$active_routine     = null;
$active_concern_key = !empty($selected_concerns) ? strtolower($selected_concerns[0]) : '';
if (!empty($active_concern_key) && isset($concern_routines[$active_concern_key])) {
    $active_routine = $concern_routines[$active_concern_key];
}

// Pre-split steps into normal and special (wide toner card) groups
$normal_steps  = array();
$special_steps = array();
if ($active_routine) {
    foreach ($active_routine['steps'] as $step) {
        if (!empty($step['special'])) {
            $special_steps[] = $step;
        } else {
            $normal_steps[] = $step;
        }
    }
}
?>

<section class="bg-[#F6F1EA] px-3 sm:px-6 md:px-10 pt-0 lg:pt-10 pb-12" style="min-height:100vh;">
    <div class="w-full">
        
        <!-- Top Small Tag -->
        <div class="flex items-center justify-center gap-4 mt-4 md:mt-0 lg:mt-4 mb-2 md:mb-0">
            <span class="text-xs tracking-[0.3em] text-gray-500 font-adobe">SHOP</span>
        </div>

        <!-- Heading H1 (1:1 typography with Vercel) -->
        <div class="flex justify-center items-center text-center mb-4 md:mb-2 mx-auto">
            <h1 class="w-full whitespace-nowrap text-[clamp(11px,3.2vw,36px)] md:text-[clamp(22px,2.8vw,40px)] font-medium tracking-tight leading-[1.2] text-center mx-auto text-black px-2 md:px-4 font-metropolis">
                <?php echo esc_html($page_title); ?>
            </h1>
        </div>

        <div class="container mx-auto px-4">
            <div class="flex flex-col md:grid md:grid-cols-[250px_1fr] gap-6 md:gap-10">
                
                <!-- ═══════════════════════════════════════
                     LEFT: Filters Column
                     ═══════════════════════════════════════ -->
                <div class="w-full md:w-auto">

                    <!-- MOBILE FILTERS (md:hidden) -->
                    <div class="md:hidden bg-white rounded-xl border border-gray-200 p-4">
                        <div class="mb-4">
                            <button type="button" class="flex items-center justify-between w-full text-left font-metropolis font-semibold text-sm text-[#1A1A1A] filter-accordion-toggle" data-target="mobile-filter-content">
                                <span>Filters</span>
                                <svg class="w-4 h-4 transition-transform duration-200 transform rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        </div>
                        
                        <div id="mobile-filter-content" class="space-y-4">
                            <!-- Category Section (Open by default) -->
                            <div class="border-t border-gray-100 pt-3">
                                <button type="button" class="flex items-center justify-between w-full text-left font-adobe font-bold text-[13px] tracking-[0.06em] uppercase text-[#1A1A1A] filter-subaccordion-toggle" data-target="mobile-cat-content">
                                    <span>Category</span>
                                    <svg class="w-3.5 h-3.5 transition-transform duration-200 transform rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div id="mobile-cat-content" class="mt-2.5 flex flex-col gap-2">
                                    <label class="flex items-center gap-2.5 cursor-pointer font-adobe text-[13px] text-[#3D3532]">
                                        <input type="checkbox" class="w-4 h-4 cursor-pointer accent-[#1A1A1A]" <?php echo ($selected_category === 'Skin') ? 'checked' : ''; ?> onchange="window.location.href='<?php echo ($selected_category === 'Skin') ? esc_url(home_url('/products')) : esc_url(home_url('/products?concern=Skin')); ?>'">
                                        <span>Skin</span>
                                    </label>
                                    <label class="flex items-center gap-2.5 cursor-pointer font-adobe text-[13px] text-[#3D3532]">
                                        <input type="checkbox" class="w-4 h-4 cursor-pointer accent-[#1A1A1A]" <?php echo ($selected_category === 'Hair') ? 'checked' : ''; ?> onchange="window.location.href='<?php echo ($selected_category === 'Hair') ? esc_url(home_url('/products')) : esc_url(home_url('/products?concern=Hair')); ?>'">
                                        <span>Hair</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Concern Section -->
                            <div class="border-t border-gray-100 pt-3">
                                <button type="button" class="flex items-center justify-between w-full text-left font-adobe font-bold text-[13px] tracking-[0.06em] uppercase text-[#1A1A1A] filter-subaccordion-toggle" data-target="mobile-concern-content">
                                    <span>Concern</span>
                                    <svg class="w-3.5 h-3.5 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div id="mobile-concern-content" class="mt-2.5 flex flex-col gap-2 hidden">
                                    <?php foreach ($visible_concerns as $opt) : ?>
                                        <?php $is_checked = in_array($opt, $selected_concerns); ?>
                                        <label class="flex items-center gap-2.5 cursor-pointer font-adobe text-[13px] text-[#3D3532]">
                                            <input type="checkbox" class="w-4 h-4 cursor-pointer accent-[#1A1A1A]" <?php echo $is_checked ? 'checked' : ''; ?> onchange="window.location.href='<?php echo $is_checked ? esc_url(home_url('/products' . ($selected_category ? '?concern=' . $selected_category : ''))) : esc_url(home_url('/products?concern=' . urlencode($opt))); ?>'">
                                            <span><?php echo esc_html($opt); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Type Section (Hidden for Hair) -->
                            <?php if ($selected_category !== 'Hair') : ?>
                            <div class="border-t border-gray-100 pt-3">
                                <button type="button" class="flex items-center justify-between w-full text-left font-adobe font-bold text-[13px] tracking-[0.06em] uppercase text-[#1A1A1A] filter-subaccordion-toggle" data-target="mobile-type-content">
                                    <span>Type of Product</span>
                                    <svg class="w-3.5 h-3.5 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div id="mobile-type-content" class="mt-2.5 flex flex-col gap-2 hidden">
                                    <?php foreach ($type_options as $topt) : ?>
                                        <?php $is_checked = in_array($topt, $selected_types); ?>
                                        <label class="flex items-center gap-2.5 cursor-pointer font-adobe text-[13px] text-[#3D3532]">
                                            <input type="checkbox" class="w-4 h-4 cursor-pointer accent-[#1A1A1A]" <?php echo $is_checked ? 'checked' : ''; ?> onchange="window.location.href='<?php echo $is_checked ? esc_url(home_url('/products')) : esc_url(home_url('/products?type=' . urlencode($topt))); ?>'">
                                            <span><?php echo esc_html($topt); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Mobile Watch Tutorial Card -->
                    <div class="md:hidden mt-4 mb-2">
                        <div class="flex items-center justify-between gap-4 w-full px-4 py-2 md:px-5 md:py-2 rounded-2xl bg-[#EDE8E0] border border-[#DDD7CE] shadow-[0_2px_12px_rgba(0,0,0,0.06)]">
                            <div class="flex-1 min-w-0 flex flex-col justify-center">
                                <p class="font-metropolis text-[10px] font-bold tracking-[0.2em] text-[#B0A89E] uppercase m-0 mb-1">YOUTUBE</p>
                                <p class="font-adobe text-[clamp(12px,1.4vw,15px)] font-semibold text-[#1A1A1A] m-0 leading-tight break-words">Watch This Tutorial for Guidance</p>
                            </div>
                            <a href="https://www.youtube.com/@RatpacCheck" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-9 h-9 md:w-10 md:h-10 shrink-0 rounded-full bg-[#1A1A1A] text-white" style="text-decoration:none;">
                                <span class="text-xs leading-none translate-x-[1px]">▶</span>
                            </a>
                        </div>
                    </div>

                    <!-- DESKTOP FILTERS (hidden md:block) -->
                    <div class="hidden md:block md:mt-0">
                        <h2 class="title-text text-base mb-6 text-[#1A1A1A]" style="letter-spacing:0.04em;font-weight:600;">
                            Filters
                        </h2>

                        <!-- Desktop Category Filter -->
                        <div style="border-bottom:1px solid #E8E3DB;padding-bottom:16px;margin-bottom:16px;">
                            <button type="button" class="flex items-center justify-between w-full text-left font-adobe font-bold text-[13px] tracking-[0.06em] uppercase text-[#1A1A1A] filter-section-toggle" data-target="desktop-cat-list">
                                <span>Category</span>
                                <svg class="w-4 h-4 transition-transform duration-200 transform rotate-180" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div id="desktop-cat-list" class="mt-3 flex flex-col gap-2">
                                <label class="flex items-center gap-2.5 cursor-pointer font-adobe text-[13px] text-[#3D3532]">
                                    <input type="checkbox" class="w-4 h-4 cursor-pointer accent-[#1A1A1A]" <?php echo ($selected_category === 'Skin') ? 'checked' : ''; ?> onchange="window.location.href='<?php echo ($selected_category === 'Skin') ? esc_url(home_url('/products')) : esc_url(home_url('/products?concern=Skin')); ?>'">
                                    <span>Skin</span>
                                </label>
                                <label class="flex items-center gap-2.5 cursor-pointer font-adobe text-[13px] text-[#3D3532]">
                                    <input type="checkbox" class="w-4 h-4 cursor-pointer accent-[#1A1A1A]" <?php echo ($selected_category === 'Hair') ? 'checked' : ''; ?> onchange="window.location.href='<?php echo ($selected_category === 'Hair') ? esc_url(home_url('/products')) : esc_url(home_url('/products?concern=Hair')); ?>'">
                                    <span>Hair</span>
                                </label>
                            </div>
                        </div>

                        <!-- Desktop Concern Filter -->
                        <div style="border-bottom:1px solid #E8E3DB;padding-bottom:16px;margin-bottom:16px;">
                            <button type="button" class="flex items-center justify-between w-full text-left font-adobe font-bold text-[13px] tracking-[0.06em] uppercase text-[#1A1A1A] filter-section-toggle" data-target="desktop-concern-list">
                                <span>Concern</span>
                                <svg class="w-4 h-4 transition-transform duration-200 <?php echo !empty($selected_concerns) ? 'transform rotate-180' : ''; ?>" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div id="desktop-concern-list" class="mt-3 flex flex-col gap-2 <?php echo empty($selected_concerns) ? 'hidden' : ''; ?>">
                                <?php foreach ($visible_concerns as $opt) : ?>
                                    <?php $is_checked = in_array($opt, $selected_concerns); ?>
                                    <label class="flex items-center gap-2.5 cursor-pointer font-adobe text-[13px] text-[#3D3532]">
                                        <input type="checkbox" class="w-4 h-4 cursor-pointer accent-[#1A1A1A]" <?php echo $is_checked ? 'checked' : ''; ?> onchange="window.location.href='<?php echo $is_checked ? esc_url(home_url('/products' . ($selected_category ? '?concern=' . $selected_category : ''))) : esc_url(home_url('/products?concern=' . urlencode($opt))); ?>'">
                                        <span><?php echo esc_html($opt); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Desktop Type Filter (Hidden for Hair) -->
                        <?php if ($selected_category !== 'Hair') : ?>
                        <div style="border-bottom:1px solid #E8E3DB;padding-bottom:16px;margin-bottom:16px;">
                            <button type="button" class="flex items-center justify-between w-full text-left font-adobe font-bold text-[13px] tracking-[0.06em] uppercase text-[#1A1A1A] filter-section-toggle" data-target="desktop-type-list">
                                <span>Type of Product</span>
                                <svg class="w-4 h-4 transition-transform duration-200 <?php echo !empty($selected_types) ? 'transform rotate-180' : ''; ?>" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div id="desktop-type-list" class="mt-3 flex flex-col gap-2 <?php echo empty($selected_types) ? 'hidden' : ''; ?>">
                                <?php foreach ($type_options as $topt) : ?>
                                    <?php $is_checked = in_array($topt, $selected_types); ?>
                                    <label class="flex items-center gap-2.5 cursor-pointer font-adobe text-[13px] text-[#3D3532]">
                                        <input type="checkbox" class="w-4 h-4 cursor-pointer accent-[#1A1A1A]" <?php echo $is_checked ? 'checked' : ''; ?> onchange="window.location.href='<?php echo $is_checked ? esc_url(home_url('/products')) : esc_url(home_url('/products?type=' . urlencode($topt))); ?>'">
                                        <span><?php echo esc_html($topt); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Desktop Watch Tutorial Card -->
                        <div class="flex items-center justify-between gap-4 w-full mt-6 mb-4 px-5 py-2 rounded-2xl bg-[#EDE8E0] border border-[#DDD7CE] shadow-[0_2px_12px_rgba(0,0,0,0.06)]">
                            <div class="flex-1 min-w-0 flex flex-col justify-center">
                                <p class="font-metropolis text-[10px] font-bold tracking-[0.2em] text-[#B0A89E] uppercase m-0 mb-1">YOUTUBE</p>
                                <p class="font-adobe text-[clamp(12px,1.4vw,15px)] font-semibold text-[#1A1A1A] m-0 leading-tight break-words">Watch This Tutorial for Guidance</p>
                            </div>
                            <a href="https://www.youtube.com/@RatpacCheck" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center w-10 h-10 shrink-0 rounded-full bg-[#1A1A1A] text-white hover:scale-105 transition-transform" style="text-decoration:none;">
                                <span class="text-xs leading-none translate-x-[1px]">▶</span>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- ═══════════════════════════════════════
                     RIGHT: Products Area
                     ═══════════════════════════════════════ -->
                <div class="flex min-h-[60vh] w-full min-w-0 flex-1 flex-col">

<?php if ($active_routine) : ?>
                    <!-- ── Skin Care Routine Card (Top above products) ── -->
                    <div class="scr-box mb-8" aria-label="Skin Care Routine">

            <!-- ── Header Inside Box ── -->
            <div class="scr-header">
                <div class="scr-brand-row">
                    <span class="scr-brand-logo">RatpacCheck<span class="scr-brand-dot">.</span></span>
                    <span class="scr-brand-tagline">we <strong>CARE</strong> about your <strong>SKIN</strong></span>
                </div>
                <div class="scr-heading-col">
                    <h2 class="scr-title">SKIN CARE ROUTINE</h2>
                </div>
            </div>

            <!-- ── Normal Steps Row (3, 4, or 4-of-5) ── -->
            <?php if (!empty($normal_steps)) : ?>
            <div class="scr-steps scr-steps--count-<?php echo count($normal_steps); ?>">
                <?php foreach ($normal_steps as $step) : ?>
                <div class="scr-step">
                    <div class="scr-img-wrap">
                        <img
                            src="<?php echo esc_url($step['image']); ?>"
                            alt="<?php echo esc_attr($step['product_name']); ?>"
                            class="scr-img"
                            loading="lazy"
                        />
                    </div>
                    <div class="scr-step-meta">
                        <p class="scr-timing"><?php echo esc_html($step['timing']); ?></p>
                        <p class="scr-instruction"><?php echo esc_html($step['instruction']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- ── Special Steps (e.g. Toner step 5) ── -->
            <?php if (!empty($special_steps)) : ?>
            <div class="scr-special-steps">
                <?php foreach ($special_steps as $sp) : ?>
                <div class="scr-step-special">
                    <div class="scr-special-img-col">
                        <div class="scr-special-img-wrap">
                            <img
                                src="<?php echo esc_url($sp['image']); ?>"
                                alt="<?php echo esc_attr($sp['product_name']); ?>"
                                class="scr-img"
                                loading="lazy"
                            />
                        </div>
                    </div>
                    <div class="scr-special-text-col">
                        <p class="scr-timing"><?php echo esc_html($sp['timing']); ?></p>
                        <p class="scr-instruction"><?php echo esc_html($sp['instruction']); ?></p>
                        <?php if (!empty($sp['description'])) : ?>
                        <div class="scr-special-desc">
                            <?php foreach (explode("\n", $sp['description']) as $line) : ?>
                                <?php if (trim($line) !== '') : ?>
                                <p><?php echo esc_html(trim($line)); ?></p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <!-- ── Footer Notes (Inside Box) ── -->
            <div class="scr-footer-notes">
                <div class="scr-notes-left">
                    <?php if (!empty($active_routine['footer_notes'])) : ?>
                        <?php foreach ($active_routine['footer_notes'] as $note) : ?>
                        <p class="scr-note"><?php echo wp_kses_post($note); ?></p>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="scr-tagline-wrap">
                    <span class="scr-tagline">BEAUTY IS YOUR'S AT AFFORDABLE <span class="scr-heart">&#9829;</span></span>
                </div>
            </div>
                    </div>
                    <?php endif; ?>

                    <!-- Showing Count Bar (hidden on mobile, visible lg) -->
                    <div class="hidden lg:flex items-center justify-between mb-4 flex-wrap gap-3">
                        <span class="font-adobe text-sm text-[#8B8178]">
                            Showing <?php echo $product_count; ?> product<?php echo $product_count !== 1 ? 's' : ''; ?>
                        </span>
                    </div>

                    <?php if ($product_count > 0) : ?>
                        <!-- Product Grid (2 cols mobile, 3 cols sm, 4 cols md/lg) -->
                        <div class="flex justify-center w-full">
                            <div class="grid w-full flex-1 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 pb-8 md:justify-start">
                                <?php
                                foreach ($filtered_products as $prod) {
                                    echo ratpaccheck_render_product_card($prod);
                                }
                                ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <!-- Empty State -->
                        <div class="flex flex-1 flex-col items-center justify-center text-center py-16 lg:-translate-x-[145px]">
                            <p class="body-copy text-base text-[#8B8178] mb-4">
                                No products match the selected filters.
                            </p>
                            <a href="<?php echo esc_url(home_url('/products')); ?>" class="btn-primary rounded-full px-6 py-2.5 text-sm font-semibold tracking-wide">
                                Clear All Filters
                            </a>
                        </div>
                    <?php endif; ?>

                </div>

            </div>
        </div>

    </div>
</section>



<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile accordion toggles
    document.querySelectorAll('.filter-accordion-toggle, .filter-subaccordion-toggle, .filter-section-toggle').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var targetId = this.getAttribute('data-target');
            var target = document.getElementById(targetId);
            var svg = this.querySelector('svg');
            if (target) {
                target.classList.toggle('hidden');
                if (svg) {
                    svg.classList.toggle('rotate-180');
                }
            }
        });
    });
});
</script>

<?php
get_footer();
