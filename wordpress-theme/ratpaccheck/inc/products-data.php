<?php
/**
 * RatpacCheck Master Products Data & Helpers
 *
 * @package RatpacCheck
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function ratpaccheck_get_all_products() {
    static $products = null;
    if ($products !== null) {
        return $products;
    }
    $products = array(
        array(
            "id" => 101,
            "name" => "Deep Glow Face Serum",
            "subtitle" => "Radiance & Brightening",
            "price" => 599,
            "originalPrice" => 799,
            "image" => "/images/Deep%20glow%20(Face%20serum).jpeg",
            "images" => array(
                "/images/Deep%20glow%20(Face%20serum).jpeg"
            ),
            "rating" => 4.8,
            "reviews" => 1500,
            "concerns" => array(
                "Dark Spots",
                "Oiliness",
                "Brightening Skin",
                "Melasma",
                "Hyperpigmentation",
                "Tan",
                "Dehydrated Skin"
            ),
            "type" => "Serum",
            "category" => "Skin",
            "inStock" => true,
            "dateAdded" => 9,
            "salesCount" => 1200
        ),
        array(
            "id" => 103,
            "name" => "Hydrating Body Cleanser",
            "subtitle" => "Deep Hydration for Body",
            "price" => 399,
            "originalPrice" => 499,
            "image" => "/images/Hydrating%20body%20cleanser.jpeg",
            "images" => array(
                "/images/Hydrating%20body%20cleanser.jpeg"
            ),
            "rating" => 4.8,
            "reviews" => 800,
            "concerns" => array(
                "Dehydrated Skin"
            ),
            "type" => "Cleanser",
            "category" => "Skin",
            "inStock" => true,
            "dateAdded" => 11,
            "salesCount" => 850
        ),
        array(
            "id" => 104,
            "name" => "Hydrating Face Cleanser",
            "subtitle" => "Gentle Facial Cleansing",
            "price" => 349,
            "originalPrice" => 449,
            "image" => "/images/Hydrating%20face%20cleanser.jpeg",
            "images" => array(
                "/images/Hydrating%20face%20cleanser.jpeg"
            ),
            "rating" => 4.9,
            "reviews" => 2100,
            "concerns" => array(
                "Acne",
                "Dark Spots",
                "Oiliness",
                "Brightening Skin",
                "Melasma",
                "Hyperpigmentation",
                "Tan",
                "Dehydrated Skin"
            ),
            "type" => "Cleanser",
            "category" => "Skin",
            "inStock" => true,
            "dateAdded" => 12,
            "salesCount" => 2000
        ),
        array(
            "id" => 105,
            "name" => "Light Weight Moisturiser",
            "subtitle" => "Daily Hydration",
            "price" => 499,
            "originalPrice" => 699,
            "image" => "/images/Light%20weight%20moisturiser.jpeg",
            "images" => array(
                "/images/Light%20weight%20moisturiser.jpeg"
            ),
            "rating" => 4.8,
            "reviews" => 3400,
            "concerns" => array(
                "Acne",
                "Dark Spots",
                "Oiliness",
                "Brightening Skin",
                "Melasma",
                "Hyperpigmentation",
                "Tan"
            ),
            "type" => "Moisturizer",
            "category" => "Skin",
            "inStock" => true,
            "dateAdded" => 13,
            "salesCount" => 3100
        ),
        array(
            "id" => 106,
            "name" => "6% Glycolic + Mulberry Exfoliating Toner",
            "subtitle" => "Clear & Bright Skin",
            "price" => 305,
            "originalPrice" => 449,
            "image" => "/images/Mulberry%20(Exfoliating%20Toner).jpeg",
            "images" => array(
                "/images/Mulberry%20(Exfoliating%20Toner).jpeg"
            ),
            "rating" => 4.6,
            "reviews" => 900,
            "concerns" => array(
                "Acne",
                "Dark Spots",
                "Oiliness",
                "Melasma",
                "Hyperpigmentation",
                "Tan",
                "Dehydrated Skin"
            ),
            "type" => "Toner",
            "category" => "Skin",
            "inStock" => true,
            "dateAdded" => 14,
            "salesCount" => 800
        ),
        array(
            "id" => 107,
            "name" => "5% Multi-Functional Face Serum",
            "subtitle" => "Overall Skin Health",
            "price" => 599,
            "originalPrice" => 799,
            "image" => "/images/Multi-functional%20(Face%20serum%205%25).jpeg",
            "images" => array(
                "/images/Multi-functional%20(Face%20serum%205%25).jpeg"
            ),
            "rating" => 4.7,
            "reviews" => 1300,
            "concerns" => array(
                "Acne",
                "Dark Spots",
                "Oiliness",
                "Brightening Skin"
            ),
            "type" => "Serum",
            "category" => "Skin",
            "inStock" => true,
            "dateAdded" => 15,
            "salesCount" => 1100
        ),
        array(
            "id" => 108,
            "name" => "10% Multi-Functional Face Serum",
            "subtitle" => "Advanced Skin Health",
            "price" => 799,
            "originalPrice" => 999,
            "image" => "/images/Multi-functional%20(Face%20serum%2010%25).jpeg",
            "images" => array(
                "/images/Multi-functional%20(Face%20serum%2010%25).jpeg"
            ),
            "rating" => 4.8,
            "reviews" => 1100,
            "concerns" => array(
                "Acne",
                "Dark Spots",
                "Oiliness"
            ),
            "type" => "Serum",
            "category" => "Skin",
            "inStock" => true,
            "dateAdded" => 16,
            "salesCount" => 1050
        ),
        array(
            "id" => 109,
            "name" => "Multi-Functional Sunscreen 50+",
            "subtitle" => "Ultimate UV Protection",
            "price" => 499,
            "originalPrice" => 649,
            "image" => "/images/Multi-functional%20Sunscreen%2050%2B.jpeg",
            "images" => array(
                "/images/Multi-functional%20Sunscreen%2050%2B.jpeg"
            ),
            "rating" => 4.9,
            "reviews" => 4500,
            "concerns" => array(
                "Acne",
                "Dark Spots",
                "Oiliness",
                "Brightening Skin",
                "Melasma",
                "Hyperpigmentation",
                "Tan"
            ),
            "type" => "Sunscreen",
            "category" => "Skin",
            "inStock" => true,
            "dateAdded" => 17,
            "salesCount" => 4100
        ),
        array(
            "id" => 110,
            "name" => "Multi Layer Hydrating Serum",
            "subtitle" => "Intense Moisture Boost",
            "price" => 549,
            "originalPrice" => 749,
            "image" => "/images/multi%20layer%20hydrating%20serum.png",
            "images" => array(
                "/images/multi%20layer%20hydrating%20serum.png"
            ),
            "rating" => 4.8,
            "reviews" => 780,
            "concerns" => array(
                "Dehydrated Skin"
            ),
            "type" => "Serum",
            "category" => "Skin",
            "inStock" => true,
            "dateAdded" => 18,
            "salesCount" => 750
        ),
        array(
            "id" => 208,
            "name" => "Hair-Care Shampoo",
            "subtitle" => "Strength & Fall Control",
            "price" => 499,
            "originalPrice" => 699,
            "image" => "/images/Hair-Care%20shampoo.jpeg",
            "images" => array(
                "/images/Hair-Care%20shampoo.jpeg"
            ),
            "rating" => 4.7,
            "reviews" => 950,
            "concerns" => array(
                "Hairfall"
            ),
            "type" => "Shampoo",
            "category" => "Hair",
            "inStock" => true,
            "dateAdded" => 18,
            "salesCount" => 1950
        ),
        array(
            "id" => 203,
            "name" => "Hair Growth Serum",
            "subtitle" => "Promotes Hair Growth",
            "price" => 899,
            "originalPrice" => 1199,
            "image" => "/images/Hair%20growth%20serum.jpeg",
            "images" => array(
                "/images/Hair%20growth%20serum.jpeg"
            ),
            "rating" => 4.9,
            "reviews" => 3200,
            "concerns" => array(
                "Hairfall"
            ),
            "type" => "Serum",
            "category" => "Hair",
            "inStock" => true,
            "dateAdded" => 20,
            "salesCount" => 3000
        ),
        array(
            "id" => 204,
            "name" => "Rinse-Off Conditioner",
            "subtitle" => "Smooth & Silky Hair",
            "price" => 399,
            "originalPrice" => 549,
            "image" => "/images/Rinse-off%20conditioner.jpeg",
            "images" => array(
                "/images/Rinse-off%20conditioner.jpeg"
            ),
            "rating" => 4.8,
            "reviews" => 1600,
            "concerns" => array(
                "Dry Hair"
            ),
            "type" => "Conditioner",
            "category" => "Hair",
            "inStock" => true,
            "dateAdded" => 21,
            "salesCount" => 1500
        ),
        array(
            "id" => 205,
            "name" => "Anti-Hairfall Oil",
            "subtitle" => "Root Strengthening",
            "price" => 449,
            "originalPrice" => 599,
            "image" => "/images/Anti-hairfall%20oil.png",
            "images" => array(
                "/images/Anti-hairfall%20oil.png"
            ),
            "rating" => 4.7,
            "reviews" => 1200,
            "concerns" => array(
                "Hairfall"
            ),
            "type" => "Oil",
            "category" => "Hair",
            "inStock" => true,
            "dateAdded" => 22,
            "salesCount" => 1300
        ),
        array(
            "id" => 206,
            "name" => "Anti-Dandruff Oil",
            "subtitle" => "Scalp Health",
            "price" => 449,
            "originalPrice" => 599,
            "image" => "/images/Anti-dandruff%20oil.png",
            "images" => array(
                "/images/Anti-dandruff%20oil.png"
            ),
            "rating" => 4.6,
            "reviews" => 950,
            "concerns" => array(
                "Dandruff"
            ),
            "type" => "Oil",
            "category" => "Hair",
            "inStock" => true,
            "dateAdded" => 23,
            "salesCount" => 1100
        ),
        array(
            "id" => 207,
            "name" => "Anti-Dandruff Shampoo",
            "subtitle" => "Scalp Cleansing",
            "price" => 399,
            "originalPrice" => 549,
            "image" => "/images/Anti-dandruff%20shampoo.jpeg",
            "images" => array(
                "/images/Anti-dandruff%20shampoo.jpeg"
            ),
            "rating" => 4.7,
            "reviews" => 720,
            "concerns" => array(
                "Dandruff"
            ),
            "type" => "Shampoo",
            "category" => "Hair",
            "inStock" => true,
            "dateAdded" => 24,
            "salesCount" => 1050
        )
    );
    return $products;
}

function ratpaccheck_get_all_product_details() {
    static $details = null;
    if ($details !== null) {
        return $details;
    }
    $details = array(
        array(
            "id" => 101,
            "name" => "Deep Glow Face Serum",
            "subtitle" => "Radiance & Brightening",
            "price" => 599,
            "originalPrice" => 799,
            "image" => "/images/Deep%20glow%20(Face%20serum).jpeg",
            "images" => array(
                "/images/Deep%20glow%20(Face%20serum).jpeg"
            ),
            "rating" => 4.8,
            "reviews" => 1500,
            "concern" => "Brightening Skin",
            "type" => "Serum",
            "category" => "Skin",
            "inStock" => true,
            "description" => "Brightening serum designed to target pigmentation and uneven skin tone.\n\nKey Benefits\n• Helps reduce hyperpigmentation and melasma\n• Improves overall skin brightness and clarity\n• Smooths texture and refines pores\n\nKey Actives\nTranexamic Acid, Alpha Arbutin, NAG and Niacinamide help even skin tone and boost radiance.",
            "howToUse" => array(
                "Cleanse face thoroughly with the Hydrating Face Cleanser.",
                "Apply 2–3 drops of the Deep Glow Face Serum to face and neck.",
                "Gently pat in until fully absorbed.",
                "Follow with a lightweight moisturiser.",
                "Always finish your AM routine with sunscreen SPF 50+."
            ),
            "benefits" => array(
                "Reduces dark spots & hyperpigmentation",
                "Brightens dull skin",
                "Evens skin tone",
                "Hydrating & lightweight"
            ),
            "ingredients" => array(
                array(
                    "name" => "Alpha-Arbutin",
                    "description" => "A skin-brightening agent that reduces melanin production to fade dark spots.",
                    "image" => "/images/Deep%20glow%20(Face%20serum).jpeg"
                ),
                array(
                    "name" => "Tranexamic Acid",
                    "description" => "Clinically proven to reduce hyperpigmentation and improve overall skin radiance.",
                    "image" => "/images/Deep%20glow%20(Face%20serum).jpeg"
                ),
                array(
                    "name" => "Niacinamide (Vitamin B3)",
                    "description" => "Minimizes pores, controls oil, and strengthens the skin barrier for a healthy glow.",
                    "image" => "/images/Deep%20glow%20(Face%20serum).jpeg"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Visible Brightening From Week 2",
                    "description" => "With consistent daily use, you will notice a measurable improvement in skin tone, dark spot visibility, and overall radiance.",
                    "image" => "/images/Deep%20glow%20(Face%20serum).jpeg"
                )
            )
        ),
        array(
            "id" => 103,
            "name" => "Hydrating Body Cleanser",
            "subtitle" => "Deep Hydration for Body",
            "price" => 399,
            "originalPrice" => 499,
            "image" => "/images/Hydrating%20body%20cleanser.jpeg",
            "images" => array(
                "/images/Hydrating%20body%20cleanser.jpeg"
            ),
            "rating" => 4.8,
            "reviews" => 800,
            "concern" => "Dehydrated Skin",
            "type" => "Cleanser",
            "category" => "Skin",
            "inStock" => true,
            "description" => "Cleanser is soap-free and gentle on the skin.\n\nThis hydrating body cleanser removes impurities without stripping the skin's natural moisture. Enriched with moisturising actives, it leaves the skin soft, smooth, and hydrated after every wash.\n\nKey benefits\n\nDeep Cleansing\nEffectively removes dirt and impurities while preserving the skin's natural protective barrier.\n\nLasting Moisture\nInfused with humectants and emollients to maintain softness and prevent dryness throughout the day.",
            "howToUse" => array(
                "Apply to damp skin and lather gently.",
                "Massage in circular motions.",
                "Rinse thoroughly with water.",
                "Use daily for best results."
            ),
            "benefits" => array(
                "Gentle daily cleanse",
                "Maintains moisture",
                "Suitable for all skin types",
                "Non-stripping formula"
            ),
            "ingredients" => array(
                array(
                    "name" => "Hydrating Actives",
                    "description" => "Moisturising blend that cleanses while maintaining skin softness.",
                    "image" => "/images/Hydrating%20body%20cleanser.jpeg"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Soft Skin Every Day",
                    "description" => "Clinically tested to leave skin smoother and more hydrated with daily use.",
                    "image" => "/images/Hydrating%20body%20cleanser.jpeg"
                )
            )
        ),
        array(
            "id" => 104,
            "name" => "Hydrating Face Cleanser",
            "subtitle" => "Gentle Facial Cleansing",
            "price" => 349,
            "originalPrice" => 449,
            "image" => "/images/Hydrating%20face%20cleanser.jpeg",
            "images" => array(
                "/images/Hydrating%20face%20cleanser.jpeg"
            ),
            "rating" => 4.9,
            "reviews" => 2100,
            "concern" => "Dehydrated Skin",
            "type" => "Cleanser",
            "category" => "Skin",
            "inStock" => true,
            "description" => "Gentle cleanser that removes impurities while maintaining skin hydration.\n\nKey Benefits\n• Cleans skin without stripping natural moisture\n• Prepares skin for serums and treatments\n• Suitable for daily AM and PM use",
            "howToUse" => array(
                "Wet face with lukewarm water.",
                "Take a small amount and lather gently.",
                "Massage in circular motions for 30–60 seconds.",
                "Rinse thoroughly and pat dry.",
                "Follow with your serum or moisturiser."
            ),
            "benefits" => array(
                "Gentle daily cleanse",
                "Maintains moisture barrier",
                "Suitable for all skin types",
                "Non-stripping formula"
            ),
            "ingredients" => array(
                array(
                    "name" => "Hydrating Actives",
                    "description" => "Hydrating blend that cleanses without disrupting the skin's natural moisture.",
                    "image" => "/images/Hydrating%20face%20cleanser.jpeg"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Clean Without Compromise",
                    "description" => "Tested for daily use — cleanses thoroughly while keeping the skin barrier healthy and intact.",
                    "image" => "/images/Hydrating%20face%20cleanser.jpeg"
                )
            )
        ),
        array(
            "id" => 105,
            "name" => "Light Weight Moisturiser",
            "subtitle" => "Daily Hydration",
            "price" => 499,
            "originalPrice" => 699,
            "image" => "/images/Light%20weight%20moisturiser.jpeg",
            "images" => array(
                "/images/Light%20weight%20moisturiser.jpeg"
            ),
            "rating" => 4.8,
            "reviews" => 3400,
            "concern" => "Dehydrated Skin",
            "type" => "Moisturizer",
            "category" => "Skin",
            "inStock" => true,
            "description" => "Lightweight daily moisturizer designed to hydrate and support healthy skin.\n\nKey Benefits\n• Provides lasting hydration without heaviness\n• Supports skin barrier and moisture balance\n• Works well for oily and combination skin\n\nPerfect as the final step before sunscreen in the morning routine.",
            "howToUse" => array(
                "After cleansing and applying serum, take a small amount.",
                "Gently massage into face and neck in upward strokes.",
                "Allow to absorb before applying sunscreen.",
                "Use AM and PM for continuous hydration."
            ),
            "benefits" => array(
                "Lightweight texture",
                "All-day hydration",
                "Non-comedogenic",
                "Suitable for all skin types"
            ),
            "ingredients" => array(
                array(
                    "name" => "Humectants & Emollients",
                    "description" => "Moisture-binding actives that hydrate without weight or greasiness.",
                    "image" => "/images/Light%20weight%20moisturiser.jpeg"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Hydration Without Weight",
                    "description" => "Lightweight enough for daily use under sunscreen, yet effective enough to keep skin hydrated all day.",
                    "image" => "/images/Light%20weight%20moisturiser.jpeg"
                )
            )
        ),
        array(
            "id" => 106,
            "name" => "6% Glycolic + Mulberry Exfoliating Toner",
            "subtitle" => "Clear & Bright Skin",
            "price" => 305,
            "originalPrice" => 449,
            "image" => "/images/Mulberry%20(Exfoliating%20Toner).jpeg",
            "images" => array(
                "/images/Mulberry%20(Exfoliating%20Toner).jpeg"
            ),
            "rating" => 4.6,
            "reviews" => 900,
            "concern" => "Brightening Skin",
            "type" => "Toner",
            "category" => "Skin",
            "inStock" => true,
            "description" => "Weekly exfoliating toner that removes dead skin cells and improves skin texture.\n\nKey Benefits\n• Removes dead and tanned surface skin cells\n• Unclogs pores and refines texture\n• Helps serums absorb better into the skin\n\nKey Actives\nGlycolic Acid and Mulberry help exfoliate skin and support brighter results.",
            "howToUse" => array(
                "After cleansing, apply toner to a cotton pad.",
                "Gently sweep across face, neck and décolleté.",
                "Avoid the eye area.",
                "Follow with serum and moisturiser.",
                "Use in PM routine. Wear sunscreen during the day."
            ),
            "benefits" => array(
                "Exfoliates dead skin cells",
                "Fades hyperpigmentation",
                "Brightens dull skin",
                "Improves absorption of serums"
            ),
            "ingredients" => array(
                array(
                    "name" => "6% Glycolic Acid",
                    "description" => "AHA that resurfaces skin, unclogs pores and stimulates collagen production.",
                    "image" => "/images/Mulberry%20(Exfoliating%20Toner).jpeg"
                ),
                array(
                    "name" => "Mulberry Extract",
                    "description" => "Natural brightener that inhibits melanin and fades dark spots gently.",
                    "image" => "/images/Mulberry%20(Exfoliating%20Toner).jpeg"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Reveal Brighter Skin in 4–6 Weeks",
                    "description" => "Dual-action formula resurfaces and brightens with consistent PM use.",
                    "image" => "/images/Mulberry%20(Exfoliating%20Toner).jpeg"
                )
            )
        ),
        array(
            "id" => 107,
            "name" => "5% Multi-Functional Face Serum",
            "subtitle" => "Overall Skin Health",
            "price" => 599,
            "originalPrice" => 799,
            "image" => "/images/Multi-functional%20(Face%20serum%205%25).jpeg",
            "images" => array(
                "/images/Multi-functional%20(Face%20serum%205%25).jpeg"
            ),
            "rating" => 4.7,
            "reviews" => 1300,
            "concern" => "Acne",
            "type" => "Serum",
            "category" => "Skin",
            "inStock" => true,
            "description" => "Oil control and acne-targeting serum designed for clearer, balanced skin.\n\nKey Benefits\n• Controls excess oil and regulates sebum production\n• Helps reduce acne and prevent future breakouts\n• Minimizes pores and improves skin texture\n\nKey Actives\nNiacinamide, Mulberry, Zinc PCA and Chamomile help balance oil production and support clearer skin.",
            "howToUse" => array(
                "Cleanse face with the Hydrating Face Cleanser.",
                "Apply 2–3 drops to face and neck.",
                "Gently pat in until absorbed.",
                "Follow with a lightweight moisturiser.",
                "Use sunscreen SPF 50+ in AM."
            ),
            "benefits" => array(
                "Targets acne and oiliness",
                "Controls sebum production",
                "Minimises pore appearance",
                "Reduces post-acne marks"
            ),
            "ingredients" => array(
                array(
                    "name" => "Niacinamide (Vitamin B3)",
                    "description" => "Reduces sebum, minimises pores and calms inflammation.",
                    "image" => "/images/Multi-functional%20(Face%20serum%205%25).jpeg"
                ),
                array(
                    "name" => "Salicylic Acid (BHA)",
                    "description" => "Penetrates pores to dissolve oil and dead cells, preventing breakouts.",
                    "image" => "/images/Multi-functional%20(Face%20serum%205%25).jpeg"
                ),
                array(
                    "name" => "Zinc PCA",
                    "description" => "Regulates sebum for a balanced, non-shiny complexion.",
                    "image" => "/images/Multi-functional%20(Face%20serum%205%25).jpeg"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Clear Skin Science",
                    "description" => "Formulated for acne-prone and oily skin types with clinically tested actives.",
                    "image" => "/images/Multi-functional%20(Face%20serum%205%25).jpeg"
                )
            )
        ),
        array(
            "id" => 108,
            "name" => "10% Multi-Functional Face Serum",
            "subtitle" => "Advanced Skin Health",
            "price" => 799,
            "originalPrice" => 999,
            "image" => "/images/Multi-functional%20(Face%20serum%2010%25).jpeg",
            "images" => array(
                "/images/Multi-functional%20(Face%20serum%2010%25).jpeg"
            ),
            "rating" => 4.8,
            "reviews" => 1100,
            "concern" => "Acne",
            "type" => "Serum",
            "category" => "Skin",
            "inStock" => true,
            "description" => "Serum is lightweight and absorbs in seconds.\n\nThe 10% Multi-Functional Face Serum is a higher-strength formula designed for stubborn acne, persistent oiliness, and skin congestion. A step up from the 5% version, it delivers faster and more intensive results for those with moderate-to-severe breakouts.\n\nKey active ingredients\n\nNiacinamide (Vitamin B3)\nAt a higher effective concentration, it significantly reduces pore size, controls shine, and minimises inflammation and post-acne marks.\n\nSalicylic Acid (BHA)\nDeep-penetrating exfoliant that dissolves clogged pores, reduces blackheads and whiteheads, and prevents new blemishes from forming.\n\nZinc PCA\nStrengthens the skin's defence against excess oil while providing an antibacterial effect to reduce acne-causing bacteria on the skin surface.\n\nRecommended for those with experience using active serums. Introduce gradually if you have sensitive skin and always pair with SPF 50+ during the day.",
            "howToUse" => array(
                "Cleanse face with the Hydrating Face Cleanser.",
                "Apply 2–3 drops of the 10% serum to face and neck.",
                "Gently pat in until absorbed.",
                "Follow with a lightweight moisturiser.",
                "Use sunscreen SPF 50+ in AM."
            ),
            "benefits" => array(
                "Intensive acne control",
                "Deep pore cleansing",
                "Reduces persistent blemishes",
                "Controls excess oil"
            ),
            "ingredients" => array(
                array(
                    "name" => "Niacinamide (Vitamin B3)",
                    "description" => "Higher concentration — reduces pore size, controls shine and post-acne marks.",
                    "image" => "/images/Multi-functional%20(Face%20serum%2010%25).jpeg"
                ),
                array(
                    "name" => "Salicylic Acid (BHA)",
                    "description" => "Dissolves clogged pores, reduces blackheads and prevents new blemishes.",
                    "image" => "/images/Multi-functional%20(Face%20serum%2010%25).jpeg"
                ),
                array(
                    "name" => "Zinc PCA",
                    "description" => "Regulates oil and provides antibacterial defence at the skin surface.",
                    "image" => "/images/Multi-functional%20(Face%20serum%2010%25).jpeg"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Intensive Acne Care",
                    "description" => "Higher concentration formula for those who need more targeted and intensive treatment.",
                    "image" => "/images/Multi-functional%20(Face%20serum%2010%25).jpeg"
                )
            )
        ),
        array(
            "id" => 109,
            "name" => "Multi-Functional Sunscreen 50+",
            "subtitle" => "Ultimate UV Protection",
            "price" => 499,
            "originalPrice" => 649,
            "image" => "/images/Multi-functional%20Sunscreen%2050%2B.jpeg",
            "images" => array(
                "/images/Multi-functional%20Sunscreen%2050%2B.jpeg"
            ),
            "rating" => 4.9,
            "reviews" => 4500,
            "concern" => "Brightening Skin",
            "type" => "Sunscreen",
            "category" => "Skin",
            "inStock" => true,
            "description" => "Sunscreen is lightweight, non-greasy, and absorbs easily.\n\nThis broad-spectrum SPF 50+ sunscreen protects against UVA and UVB rays while also offering additional skin benefits. Wear it as the final step of your morning routine every day — no exceptions.\n\nKey benefits\n\nSPF 50+ Broad Spectrum\nProvides high-level protection against both UVA (ageing) and UVB (burning) rays, preventing sun damage, dark spots, and premature ageing.\n\nLightweight, Non-Greasy Texture\nAbsorbs quickly without leaving a white cast, making it comfortable to wear daily under makeup or alone.\n\nMulti-Functional Formula\nGoes beyond UV protection — helps maintain skin tone and shield the surface from environmental stressors.\n\nAlways apply as the last step of your morning skincare routine.",
            "howToUse" => array(
                "Apply generously to face and neck as the last step of your morning routine.",
                "Reapply every 2–3 hours when outdoors.",
                "Use daily, regardless of weather conditions."
            ),
            "benefits" => array(
                "SPF 50+ broad-spectrum protection",
                "Lightweight, no white cast",
                "Prevents dark spots and ageing",
                "Suitable for daily use"
            ),
            "ingredients" => array(
                array(
                    "name" => "UV Filters (UVA + UVB)",
                    "description" => "Broad-spectrum filters that shield the skin from both UVA and UVB radiation.",
                    "image" => "/images/Multi-functional%20Sunscreen%2050%2B.jpeg"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Your Daily Shield",
                    "description" => "SPF is the most important step in any skincare routine — non-negotiable for preventing dark spots and premature ageing.",
                    "image" => "/images/Multi-functional%20Sunscreen%2050%2B.jpeg"
                )
            )
        ),
        array(
            "id" => 110,
            "name" => "Multi Layer Hydrating Serum",
            "subtitle" => "Intense Moisture Boost",
            "price" => 549,
            "originalPrice" => 749,
            "image" => "/images/multi%20layer%20hydrating%20serum.png",
            "images" => array(
                "/images/multi%20layer%20hydrating%20serum.png"
            ),
            "rating" => 4.8,
            "reviews" => 780,
            "concern" => "Dehydrated Skin",
            "type" => "Serum",
            "category" => "Skin",
            "inStock" => true,
            "description" => "Serum is water-based and absorbs in seconds.\n\nThe Multi Layer Hydrating Serum uses a layered delivery approach — combining multi-weight Hyaluronic Acid, Ceramides, and Panthenol — to deliver sustained moisture at the surface, mid, and deep layers of the skin. The result is lasting plumpness, improved skin barrier function, and visibly healthier skin.\n\nKey active ingredients\n\nMulti-Weight Hyaluronic Acid\nSmall, medium, and large molecular weights work together to attract and retain moisture at every layer of the skin, from the surface down to the deeper dermis.\n\nCeramides\nLipid molecules that rebuild the skin's protective barrier, locking in moisture and shielding the skin from environmental stressors that cause dryness and irritation.\n\nPanthenol (Pro-Vitamin B5)\nSoothes irritated skin, improves elasticity, and accelerates the healing of the skin surface for a softer, smoother texture.\n\nSuitable for all skin types, including dry, sensitive, and dehydrated skin. Use morning and evening as a base layer beneath your moisturiser.",
            "howToUse" => array(
                "After cleansing, apply 2–3 drops to face and neck.",
                "Gently pat in until fully absorbed.",
                "Layer under your moisturiser for enhanced hydration.",
                "Use AM and PM for continuous moisture support.",
                "Follow with sunscreen in the morning."
            ),
            "benefits" => array(
                "Deep multi-layer hydration",
                "Plumps and smooths skin",
                "Strengthens skin barrier",
                "Suitable for all skin types"
            ),
            "ingredients" => array(
                array(
                    "name" => "Multi-Weight Hyaluronic Acid",
                    "description" => "Delivers moisture at multiple skin layers from surface to deeper dermis.",
                    "image" => "/images/multi%20layer%20hydrating%20serum.png"
                ),
                array(
                    "name" => "Ceramides",
                    "description" => "Rebuild the skin barrier and lock in moisture against environmental damage.",
                    "image" => "/images/multi%20layer%20hydrating%20serum.png"
                ),
                array(
                    "name" => "Panthenol (Pro-Vitamin B5)",
                    "description" => "Soothes, improves elasticity and smooths skin texture.",
                    "image" => "/images/multi%20layer%20hydrating%20serum.png"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Hydration at Every Layer",
                    "description" => "Unlike single-layer serums, this formula delivers moisture to the surface, mid, and deep layers of skin.",
                    "image" => "/images/multi%20layer%20hydrating%20serum.png"
                )
            )
        ),
        array(
            "id" => 203,
            "name" => "Hair Growth Serum",
            "subtitle" => "Promotes Hair Growth",
            "price" => 899,
            "originalPrice" => 1199,
            "image" => "/images/Hair%20growth%20serum.jpeg",
            "images" => array(
                "/images/Hair%20growth%20serum.jpeg"
            ),
            "rating" => 4.9,
            "reviews" => 3200,
            "concern" => "Hairfall",
            "type" => "Serum",
            "category" => "Hair",
            "inStock" => true,
            "description" => "Serum is water-based and absorbs in seconds.\n\nThe Hair Growth Serum is one of the few serums in India that delivers five gold-standard, clinically proven hair-growth actives at an affordable price to support healthier, fuller hair.\n\nWhile many brands charge premium prices for formulas containing only two or three active ingredients, RatpacCheck delivers a powerful research-backed blend of:\n\nBIACAPIL + CAPIXYL + PROCAPIL + ANAGAIN + REDENSYL\n\nNo compromises, no gimmicks — only science-driven results.\n\nKey active ingredients\n\nBiacapil\nBoosts hair density and helps reduce the effects of DHT, promoting thicker and fuller hair growth.\n\nCapixyl (Acetyl Tetrapeptide-3)\nHelps reduce hair loss, strengthens hair anchorage, and stimulates healthy growth signals at the follicle level.\n\nProcapil (Biotinoyl Tripeptide-1)\nHelps block DHT at the scalp while improving circulation to support stronger, more resilient follicles.\n\nAnagain\nReactivates dormant hair follicles, reduces hair fall, and encourages the anagen (growth) phase of the hair cycle.\n\nRedensyl\nTargets hair follicle stem cells to support visible hair growth within 4–6 months of consistent use.",
            "howToUse" => array(
                "Part hair and apply directly to scalp.",
                "Massage gently for 2–3 minutes to improve absorption.",
                "Leave on — do not rinse.",
                "Use daily in AM or PM for best results.",
                "Results visible in 4–6 months of consistent use."
            ),
            "benefits" => array(
                "All 5 gold-standard hair growth actives",
                "Reduces hair fall",
                "Reactivates dormant follicles",
                "Targets hair follicle stem cells"
            ),
            "ingredients" => array(
                array(
                    "name" => "Biacapil",
                    "description" => "Boosts hair density and fights DHT for thicker, fuller growth.",
                    "image" => "/images/Hair%20growth%20serum.jpeg"
                ),
                array(
                    "name" => "Capixyl (Acetyl Tetrapeptide-3)",
                    "description" => "Reduces hair loss, strengthens anchorage, and stimulates growth signals.",
                    "image" => "/images/Hair%20growth%20serum.jpeg"
                ),
                array(
                    "name" => "Procapil (Biotinoyl Tripeptide-1)",
                    "description" => "Blocks DHT and improves scalp circulation for stronger follicles.",
                    "image" => "/images/Hair%20growth%20serum.jpeg"
                ),
                array(
                    "name" => "Anagain",
                    "description" => "Reactivates dormant follicles and boosts the anagen (growth) phase.",
                    "image" => "/images/Hair%20growth%20serum.jpeg"
                ),
                array(
                    "name" => "Redensyl",
                    "description" => "Targets follicle stem cells for visible growth within 4–6 months.",
                    "image" => "/images/Hair%20growth%20serum.jpeg"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Five Gold-Standard Actives, One Serum",
                    "description" => "The only serum in India combining all five clinically proven hair growth actives at an affordable price.",
                    "image" => "/images/Hair%20growth%20serum.jpeg"
                )
            )
        ),
        array(
            "id" => 204,
            "name" => "Rinse-Off Conditioner",
            "subtitle" => "Smooth & Silky Hair",
            "price" => 399,
            "originalPrice" => 549,
            "image" => "/images/Rinse-off%20conditioner.jpeg",
            "images" => array(
                "/images/Rinse-off%20conditioner.jpeg"
            ),
            "rating" => 4.8,
            "reviews" => 1600,
            "concern" => "Dry Hair",
            "type" => "Conditioner",
            "category" => "Hair",
            "inStock" => true,
            "description" => "Conditioner rinses clean without weighing hair down.\n\nThis rinse-off conditioner detangles, smooths, and adds lasting softness to every hair type. Use it after every shampoo to seal the hair cuticle and reduce frizz for visibly shinier, silkier hair.\n\nKey benefits\n\nDetangles and Smooths\nInstantly reduces knots and makes hair easier to manage, minimising breakage during combing.\n\nSeals the Cuticle\nSmoothes the outer layer of each strand to reduce frizz and enhance shine for the whole day.\n\nLightweight Formula\nConditions without weighing fine hair down — leaves hair feeling clean and bouncy.",
            "howToUse" => array(
                "After shampooing, apply conditioner from mid-length to ends.",
                "Leave on for 1–2 minutes.",
                "Rinse thoroughly with cool water.",
                "Use every time you shampoo."
            ),
            "benefits" => array(
                "Detangles instantly",
                "Reduces frizz",
                "Adds shine and softness",
                "Suitable for all hair types"
            ),
            "ingredients" => array(
                array(
                    "name" => "Conditioning Actives",
                    "description" => "Smoothing and detangling blend that seals the cuticle and reduces frizz.",
                    "image" => "/images/Rinse-off%20conditioner.jpeg"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Silky Hair After Every Wash",
                    "description" => "Use consistently after shampoo to maintain soft, manageable, and frizz-free hair.",
                    "image" => "/images/Rinse-off%20conditioner.jpeg"
                )
            )
        ),
        array(
            "id" => 205,
            "name" => "Anti-Hairfall Oil",
            "subtitle" => "Root Strengthening",
            "price" => 449,
            "originalPrice" => 599,
            "image" => "/images/Anti-hairfall%20oil.png",
            "images" => array(
                "/images/Anti-hairfall%20oil.png"
            ),
            "rating" => 4.7,
            "reviews" => 1200,
            "concern" => "Hairfall",
            "type" => "Oil",
            "category" => "Hair",
            "inStock" => true,
            "description" => "Oil penetrates the scalp quickly and is non-greasy.\n\nThis anti-hairfall oil is formulated to strengthen hair at the root, improve scalp circulation, and reduce daily hair fall with regular use. Best applied before washing for a nourishing pre-wash treatment.\n\nKey benefits\n\nStrengthens Hair Roots\nNourishes and fortifies the follicle base to reduce hair fall caused by weak roots.\n\nImproves Scalp Circulation\nGentle massage with this oil promotes blood flow to the scalp, supporting a healthier environment for hair growth.\n\nReduces Breakage\nCoats hair strands to improve elasticity and prevent mid-shaft breakage.",
            "howToUse" => array(
                "Part hair into sections and apply oil directly to the scalp.",
                "Massage gently for 5–10 minutes in circular motions.",
                "Leave on overnight or for at least 1 hour.",
                "Wash out thoroughly with shampoo.",
                "Use 2–3 times per week."
            ),
            "benefits" => array(
                "Reduces hair fall",
                "Strengthens roots",
                "Nourishes scalp",
                "Improves circulation"
            ),
            "ingredients" => array(
                array(
                    "name" => "Strengthening Herbal Blend",
                    "description" => "A potent mix of root-strengthening oils and botanical extracts.",
                    "image" => "/images/Anti-hairfall%20oil.png"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Nourish at the Root",
                    "description" => "Pre-wash oil treatment that targets the source of hair fall — the follicle itself.",
                    "image" => "/images/Anti-hairfall%20oil.png"
                )
            )
        ),
        array(
            "id" => 207,
            "name" => "Anti-Dandruff Shampoo",
            "subtitle" => "Flake Control & Scalp Clarity",
            "price" => 499,
            "originalPrice" => 699,
            "image" => "/images/Anti-dandruff%20shampoo.jpeg",
            "images" => array(
                "/images/Anti-dandruff%20shampoo.jpeg"
            ),
            "rating" => 4.5,
            "reviews" => 720,
            "concern" => "Dandruff",
            "type" => "Shampoo",
            "category" => "Hair",
            "inStock" => true,
            "description" => "Shampoo is sulphate-free and gentle enough for regular use.\n\nThis anti-dandruff shampoo is formulated with antifungal actives to target the root cause of dandruff — excess fungal activity on the scalp. With consistent use, it reduces flaking, soothes itchiness, and restores scalp balance for cleaner, healthier hair.\n\nKey benefits\n\nEliminates Dandruff\nAntifungal actives work directly against the fungal causes of dandruff to visibly reduce flakes with regular use.\n\nSoothes Scalp Irritation\nCalms itching and redness associated with dandruff and dry scalp conditions.\n\nCleanses Without Stripping\nGentle enough for frequent use, it cleanses the scalp without over-drying or disrupting the scalp's natural moisture.",
            "howToUse" => array(
                "Wet hair thoroughly.",
                "Apply shampoo to scalp and massage gently for 2–3 minutes.",
                "Leave on for 1–2 minutes to allow actives to work.",
                "Rinse thoroughly with water.",
                "Use 3–4 times per week for best results."
            ),
            "benefits" => array(
                "Reduces dandruff and flaking",
                "Soothes scalp irritation",
                "Antifungal action",
                "Gentle sulphate-free formula"
            ),
            "ingredients" => array(
                array(
                    "name" => "Anti-Dandruff Actives",
                    "description" => "Antifungal blend that targets the root cause of dandruff and scalp irritation.",
                    "image" => "/images/Anti-dandruff%20shampoo.jpeg"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Clinically Targeted Dandruff Control",
                    "description" => "Formulated with antifungal actives that address the underlying cause of dandruff, not just the symptoms.",
                    "image" => "/images/Anti-dandruff%20shampoo.jpeg"
                )
            )
        ),
        array(
            "id" => 206,
            "name" => "Anti-Dandruff Oil",
            "subtitle" => "Scalp Health",
            "price" => 449,
            "originalPrice" => 599,
            "image" => "/images/Anti-dandruff%20oil.png",
            "images" => array(
                "/images/Anti-dandruff%20oil.png"
            ),
            "rating" => 4.6,
            "reviews" => 950,
            "concern" => "Dandruff",
            "type" => "Oil",
            "category" => "Hair",
            "inStock" => true,
            "description" => "Oil absorbs into the scalp and is non-greasy on application.\n\nThis anti-dandruff oil targets the root cause of flaking and scalp irritation with a blend of antifungal and soothing actives. Regular use reduces dandruff, calms itchiness, and restores a balanced, healthy scalp.\n\nKey benefits\n\nFights Dandruff at the Source\nActive ingredients work against the fungal causes of dandruff, reducing flakes with consistent use.\n\nSoothes Scalp Irritation\nCalms itching and redness caused by dry or irritated scalp conditions.\n\nBalances Scalp Oil Production\nHelps regulate sebum levels on the scalp to prevent the conditions that cause dandruff to return.",
            "howToUse" => array(
                "Apply oil directly to the scalp.",
                "Massage gently for 5 minutes.",
                "Leave on for 1–2 hours before washing.",
                "Rinse thoroughly with an anti-dandruff shampoo.",
                "Use twice a week."
            ),
            "benefits" => array(
                "Reduces dandruff and flaking",
                "Soothes scalp irritation",
                "Balances scalp health",
                "Anti-fungal action"
            ),
            "ingredients" => array(
                array(
                    "name" => "Anti-Dandruff Actives",
                    "description" => "Antifungal and soothing blend that targets flaking and scalp irritation.",
                    "image" => "/images/Anti-dandruff%20oil.png"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "A Healthier Scalp Starts Here",
                    "description" => "Consistent oil treatments help eliminate dandruff and restore scalp balance within weeks.",
                    "image" => "/images/Anti-dandruff%20oil.png"
                )
            )
        ),
        array(
            "id" => 208,
            "name" => "Hair-Care Shampoo",
            "subtitle" => "Strength & Fall Control",
            "price" => 499,
            "originalPrice" => 699,
            "image" => "/images/Hair-Care%20shampoo.jpeg",
            "images" => array(
                "/images/Hair-Care%20shampoo.jpeg"
            ),
            "rating" => 4.7,
            "reviews" => 950,
            "concern" => "Hairfall",
            "type" => "Shampoo",
            "category" => "Hair",
            "inStock" => true,
            "description" => "Shampoo is sulphate-free and fortified with strengthening actives.\n\nThis hair-care shampoo is formulated with root-strengthening actives to reduce hair fall, strengthen hair fibers, and promote healthier, fuller hair. With consistent use, it minimizes breakage and improves overall hair health and vitality.\n\nKey benefits\n\nReduces Hair Fall\nStrengthening actives work to reduce excessive hair fall and promote stronger root grip.\n\nStrengthens Hair Fibers\nFortifies each strand to reduce breakage and split ends.\n\nCleanses Without Stripping\nGentle enough for frequent use, it cleanses without over-drying the scalp or hair.",
            "howToUse" => array(
                "Wet hair thoroughly.",
                "Apply shampoo to scalp and massage gently for 2–3 minutes.",
                "Work through hair lengths gently.",
                "Rinse thoroughly with water.",
                "Use 3–4 times per week for best results."
            ),
            "benefits" => array(
                "Reduces hair fall",
                "Strengthens hair roots",
                "Reduces breakage",
                "Gentle sulphate-free formula"
            ),
            "ingredients" => array(
                array(
                    "name" => "Hair-Care Actives",
                    "description" => "Fortifying blend that strengthens hair roots and reduces hair fall.",
                    "image" => "/images/Hair-Care%20shampoo.jpeg"
                )
            ),
            "detailSections" => array(
                array(
                    "title" => "Stronger Hair From the Root",
                    "description" => "Formulated with strengthening actives that work at the root level to reduce hair fall and improve overall hair health.",
                    "image" => "/images/Hair-Care%20shampoo.jpeg"
                )
            )
        )
    );
    return $details;
}

function ratpaccheck_get_product_by_id($id) {
    $id = intval($id);
    $details = ratpaccheck_get_all_product_details();
    foreach ($details as $p) {
        if (isset($p['id']) && intval($p['id']) === $id) {
            return $p;
        }
    }
    $products = ratpaccheck_get_all_products();
    foreach ($products as $p) {
        if (isset($p['id']) && intval($p['id']) === $id) {
            return $p;
        }
    }
    return null;
}

function ratpaccheck_get_related_products($current_product, $limit = 4) {
    $all = ratpaccheck_get_all_products();
    $current_id = isset($current_product['id']) ? intval($current_product['id']) : 0;
    $current_category = isset($current_product['category']) ? $current_product['category'] : '';

    $related = array();
    foreach ($all as $p) {
        if (intval($p['id']) !== $current_id) {
            if (!$current_category || (isset($p['category']) && $p['category'] === $current_category)) {
                $related[] = $p;
            }
        }
    }

    usort($related, function($a, $b) {
        $rA = isset($a['reviews']) ? intval($a['reviews']) : 0;
        $rB = isset($b['reviews']) ? intval($b['reviews']) : 0;
        return $rB - $rA;
    });

    return array_slice($related, 0, $limit);
}

function ratpaccheck_asset_url($path) {
    $clean = ltrim($path, '/');
    return get_template_directory_uri() . '/assets/' . $clean;
}

function ratpaccheck_img_url($path) {
    if (empty($path)) return '';
    if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
        return $path;
    }
    $clean = ltrim($path, '/');
    if (strpos($clean, 'assets/') === 0) {
        $clean = substr($clean, 7);
    }
    if (strpos($clean, 'images/') !== 0) {
        $clean = 'images/' . $clean;
    }
    // Safely encode path segments so URLs with spaces are valid W3C URLs
    $parts = explode('/', $clean);
    $encoded_parts = array_map(function($p) {
        return rawurlencode(rawurldecode($p));
    }, $parts);
    $clean_encoded = implode('/', $encoded_parts);

    return get_template_directory_uri() . '/assets/' . $clean_encoded;
}

function ratpaccheck_product_url($id) {
    return home_url('/product-detail/?product_id=' . intval($id));
}
