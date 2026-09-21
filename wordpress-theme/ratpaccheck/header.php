<?php
/**
 * The Header for RatpacCheck Theme
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Noto+Serif:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap">
    <?php wp_head(); ?>
</head>
<body <?php body_class('font-adobe antialiased w-full max-w-full bg-[#F6F1EA] text-[#1A1A1A]'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col">
    <?php
    $current_uri = $_SERVER['REQUEST_URI'] ?? '';
    $path_only = strtok($current_uri, '?');
    $is_products = (strpos($path_only, '/products') !== false);
    $concern_param = isset($_GET['concern']) ? sanitize_text_field($_GET['concern']) : '';
    $is_collections_hair = (strpos($path_only, '/collections/hair') !== false);
    $is_collections_skin = (strpos($path_only, '/collections/skin') !== false);
    $is_track_order = (strpos($path_only, '/track-order') !== false);
    $is_customer_help = (strpos($path_only, '/customer-help') !== false);

    $is_shop_active = ($is_products && empty($concern_param));
    $is_skin_active = ($is_collections_skin || ($is_products && strcasecmp($concern_param, 'Skin') === 0));
    $is_hair_active = ($is_collections_hair || ($is_products && strcasecmp($concern_param, 'Hair') === 0));
    ?>
    <style>
        html {
            overflow-x: clip !important;
        }
        body {
            overflow-x: clip !important;
        }
        #site-header-wrapper {
            position: relative;
            z-index: 50;
        }

        @media (min-width: 1024px) {
            #site-header-wrapper:has(.megamenu-trigger-wrap[data-menu="shop"]:hover) #megamenu-dropdown,
            #site-header-wrapper:has(.megamenu-trigger-wrap[data-menu="skincare"]:hover) #megamenu-dropdown,
            #site-header-wrapper:has(.megamenu-trigger-wrap[data-menu="haircare"]:hover) #megamenu-dropdown,
            #site-header-wrapper:has(#megamenu-dropdown:hover) #megamenu-dropdown {
                display: block !important;
            }
            #site-header-wrapper:has(.megamenu-trigger-wrap[data-menu="shop"]:hover) #megamenu-panel-shop {
                display: grid !important;
            }
            #site-header-wrapper:has(.megamenu-trigger-wrap[data-menu="skincare"]:hover) #megamenu-panel-skincare {
                display: grid !important;
            }
            #site-header-wrapper:has(.megamenu-trigger-wrap[data-menu="haircare"]:hover) #megamenu-panel-haircare {
                display: grid !important;
            }
            #site-header-wrapper:has(.megamenu-trigger-wrap[data-menu="shop"]:hover) .megamenu-trigger-wrap[data-menu="shop"] .nav-link::after,
            #site-header-wrapper:has(.megamenu-trigger-wrap[data-menu="skincare"]:hover) .megamenu-trigger-wrap[data-menu="skincare"] .nav-link::after,
            #site-header-wrapper:has(.megamenu-trigger-wrap[data-menu="haircare"]:hover) .megamenu-trigger-wrap[data-menu="haircare"] .nav-link::after {
                transform: scaleX(1) !important;
            }
            #site-header-wrapper:has(.megamenu-trigger-wrap[data-menu="shop"]:hover) ~ #megamenu-backdrop,
            #site-header-wrapper:has(.megamenu-trigger-wrap[data-menu="skincare"]:hover) ~ #megamenu-backdrop,
            #site-header-wrapper:has(.megamenu-trigger-wrap[data-menu="haircare"]:hover) ~ #megamenu-backdrop,
            #site-header-wrapper:has(#megamenu-dropdown:hover) ~ #megamenu-backdrop {
                display: block !important;
            }
        }
    </style>

    <!-- ── Outer Header Wrapper (100% Vercel Match) ── -->
    <div id="site-header-wrapper" class="relative z-50 bg-white border-b border-[#E8E3DB]">

        <!-- 1. Announcement Bar (Pinned together with Header) -->
        <div style="background-color:#000000;color:#FFFFFF;min-height:34px;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:500;letter-spacing:0.14em;text-transform:uppercase;padding:6px 16px;text-align:center;flex-wrap:wrap;font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;">
            Free Shipping on Orders Above ₹499&nbsp;&nbsp;|&nbsp;&nbsp;Science-Backed Formulas
        </div>

        <!-- 2. Main Navbar -->
        <header id="masthead" class="bg-white" style="transition:border-color 0.2s ease;overflow-x:hidden;">
            <!-- Desktop Header (lg:flex) -->
            <div class="px-4 py-3 sm:px-6 md:px-10 sm:py-0 relative hidden lg:flex" style="max-width:1280px;margin:0 auto;min-height:56px;align-items:center;justify-content:space-between">
                <!-- Brand Group -->
                <div class="flex items-center">
                    <a class="hover:opacity-90 transition-opacity" href="<?php echo esc_url(home_url('/')); ?>" style="text-decoration:none;display:inline-block;position:relative;padding-bottom:18px">
                        <span id="brand-text-desktop" class="font-metropolis" style="font-size:clamp(20px, 2vw, 20px);font-weight:800;color:#E8799A;line-height:1;white-space:nowrap;display:block;font-synthesis:none">
                            RatpacCheck.
                        </span>
                        <span id="tagline-text-desktop" class="font-metropolis" style="position:absolute;left:0;bottom:0;font-size:clamp(9px, 1vw, 10px);font-weight:450;color:#6B6B6B;letter-spacing:0.04em;white-space:nowrap;display:block;font-synthesis:none;transform-origin:left center;">
                            we <span style="font-weight:800">CARE</span> about your <span style="font-weight:800">SKIN</span> &amp; <span style="font-weight:800">HAIR</span>
                        </span>
                    </a>
                </div>
            
            <nav class="flex items-center" style="gap:32px">
                <div class="megamenu-trigger-wrap" data-menu="shop" style="position:relative">
                    <a class="nav-link font-metropolis<?php echo $is_shop_active ? ' nav-link-active' : ''; ?>" href="<?php echo esc_url(home_url('/products')); ?>" style="font-size:13px;letter-spacing:0.04em;padding:10px 0;display:inline-block;text-decoration:none;color:#1A1A1A;">Shop</a>
                </div>
                <div class="megamenu-trigger-wrap" data-menu="skincare" style="position:relative">
                    <a class="nav-link font-metropolis<?php echo $is_skin_active ? ' nav-link-active' : ''; ?>" href="<?php echo esc_url(home_url('/products?concern=Skin')); ?>" style="font-size:13px;letter-spacing:0.04em;padding:10px 0;display:inline-block;text-decoration:none;color:#1A1A1A;">Skin Care</a>
                </div>
                <div class="megamenu-trigger-wrap" data-menu="haircare" style="position:relative">
                    <a class="nav-link font-metropolis<?php echo $is_hair_active ? ' nav-link-active' : ''; ?>" href="<?php echo esc_url(home_url('/products?concern=Hair')); ?>" style="font-size:13px;letter-spacing:0.04em;padding:10px 0;display:inline-block;text-decoration:none;color:#1A1A1A;">Hair Care</a>
                </div>
                <a class="nav-link font-metropolis<?php echo $is_track_order ? ' nav-link-active' : ''; ?>" href="<?php echo esc_url(home_url('/track-order')); ?>" style="font-size:13px;letter-spacing:0.04em;padding:10px 0;text-decoration:none;color:#1A1A1A;">Track Order</a>
                <a class="nav-link font-metropolis<?php echo $is_customer_help ? ' nav-link-active' : ''; ?>" href="<?php echo esc_url(home_url('/customer-help')); ?>" style="font-size:13px;letter-spacing:0.04em;padding:10px 0;text-decoration:none;color:#1A1A1A;">Customer Help</a>
            </nav>

            <div class="flex items-center gap-4 sm:gap-[18px]">
                <button type="button" id="search-modal-trigger" style="background:none;border:none;cursor:pointer;color:#1A1A1A;display:flex;align-items:center;transition:color 0.2s;padding:4px" title="Search products">
                    <svg aria-hidden="true" class="lucide lucide-search w-5 h-5 sm:w-[19px] sm:h-[19px]" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <path d="m21 21-4.34-4.34"></path>
                        <circle cx="11" cy="11" r="8"></circle>
                    </svg>
                </button>
                <a class="flex items-center gap-1.5 font-metropolis" href="<?php echo esc_url(home_url('/track-order/')); ?>" style="font-size:13px;font-weight:500;letter-spacing:0.04em;color:#1A1A1A;text-decoration:none;transition:color 0.2s">
                    <svg aria-hidden="true" class="lucide lucide-user" fill="none" height="15" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>Login</span>
                </a>
                <button type="button" id="cart-drawer-trigger" style="background:none;border:none;cursor:pointer;color:#1A1A1A;position:relative;display:flex;align-items:center;transition:color 0.2s;padding:4px" aria-label="Open cart">
                    <svg aria-hidden="true" class="lucide lucide-shopping-cart w-5 h-5 sm:w-[19px] sm:h-[19px]" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="8" cy="21" r="1"></circle>
                        <circle cx="19" cy="21" r="1"></circle>
                        <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                    </svg>
                    <span id="cart-counter-badge" class="absolute -top-1 -right-1 bg-black text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center" style="display:none;">0</span>
                </button>
                <a href="https://wa.me/919876543210" target="_blank" rel="noopener noreferrer" class="whatsapp-nav-btn" aria-label="Contact RatpacCheck on WhatsApp" title="Chat on WhatsApp" style="width:34px;height:34px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="19" height="19" fill="currentColor" aria-hidden="true">
                        <path d="M12.004 2c-5.518 0-9.996 4.48-9.996 10.001 0 1.765.459 3.488 1.332 5.008L2 22l5.122-1.311c1.472.802 3.13 1.226 4.882 1.226 5.518 0 10-4.48 10-10.001C22.004 6.48 17.522 2 12.004 2zm5.835 14.167c-.244.685-1.42 1.309-1.956 1.392-.518.08-1.196.113-3.447-.818-2.73-1.129-4.508-3.904-4.646-4.086-.135-.183-1.1-1.464-1.1-2.793 0-1.328.697-1.982.946-2.247.247-.266.541-.332.721-.332.181 0 .362.002.52.01.168.009.394-.064.616.471.229.551.78 1.902.848 2.042.068.14.113.305.023.487-.091.182-.136.295-.271.455-.136.16-.285.358-.408.48-.135.136-.277.283-.119.555.158.271.703 1.16 1.51 1.879 1.037.925 1.91 1.211 2.181 1.347.272.136.43.113.589-.068.158-.182.678-.792.86-1.064.181-.271.362-.226.61-.136.249.091 1.583.746 1.854.882.272.136.452.204.52.317.068.113.068.656-.176 1.341z"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Mobile Header (lg:hidden) -->
        <div class="lg:hidden flex flex-col">
            <div class="px-4 flex items-center justify-between" style="min-height:52px">
                <a class="hover:opacity-90 transition-opacity" href="<?php echo esc_url(home_url('/')); ?>" style="text-decoration:none;display:inline-block;position:relative;padding-bottom:17px">
                    <span id="brand-text-mobile" class="font-metropolis" style="font-size:18px;font-weight:800;color:#E8799A;line-height:1;display:block;white-space:nowrap;font-synthesis:none">
                        RatpacCheck.
                    </span>
                    <span id="tagline-text-mobile" class="font-metropolis" style="position:absolute;left:0;bottom:0;font-size:8.5px;font-weight:450;color:#6B6B6B;letter-spacing:0.03em;white-space:nowrap;display:block;font-synthesis:none;transform-origin:left center;transform:scaleX(1)">
                        we <span style="font-weight:800">CARE</span> about your <span style="font-weight:800">SKIN</span> &amp; <span style="font-weight:800">HAIR</span>
                    </span>
                </a>
                <div class="flex items-center gap-3">
                    <button type="button" id="mobile-search-trigger" style="background:none;border:none;cursor:pointer;color:#1A1A1A;display:flex;align-items:center;padding:4px" title="Search products">
                        <svg aria-hidden="true" class="lucide lucide-search" fill="none" height="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path d="m21 21-4.34-4.34"></path>
                            <circle cx="11" cy="11" r="8"></circle>
                        </svg>
                    </button>
                    <a href="<?php echo esc_url(home_url('/track-order/')); ?>" style="color:#1A1A1A;display:flex;align-items:center;padding:4px" title="Login">
                        <svg aria-hidden="true" class="lucide lucide-user" fill="none" height="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>
                    <button type="button" class="mobile-cart-trigger" style="background:none;border:none;cursor:pointer;color:#1A1A1A;position:relative;display:flex;align-items:center;padding:4px" aria-label="Open cart">
                        <svg aria-hidden="true" class="lucide lucide-shopping-cart" fill="none" height="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="8" cy="21" r="1"></circle>
                            <circle cx="19" cy="21" r="1"></circle>
                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                        </svg>
                        <span class="cart-counter-badge absolute -top-1 -right-1 bg-black text-white text-[10px] font-bold rounded-full h-4 w-4 flex items-center justify-center" style="display:none;">0</span>
                    </button>
                    <a href="https://wa.me/919876543210" target="_blank" rel="noopener noreferrer" class="whatsapp-nav-btn" aria-label="Contact RatpacCheck on WhatsApp" title="Chat on WhatsApp" style="width:30px;height:30px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true">
                            <path d="M12.004 2c-5.518 0-9.996 4.48-9.996 10.001 0 1.765.459 3.488 1.332 5.008L2 22l5.122-1.311c1.472.802 3.13 1.226 4.882 1.226 5.518 0 10-4.48 10-10.001C22.004 6.48 17.522 2 12.004 2zm5.835 14.167c-.244.685-1.42 1.309-1.956 1.392-.518.08-1.196.113-3.447-.818-2.73-1.129-4.508-3.904-4.646-4.086-.135-.183-1.1-1.464-1.1-2.793 0-1.328.697-1.982.946-2.247.247-.266.541-.332.721-.332.181 0 .362.002.52.01.168.009.394-.064.616.471.229.551.78 1.902.848 2.042.068.14.113.305.023.487-.091.182-.136.295-.271.455-.136.16-.285.358-.408.48-.135.136-.277.283-.119.555.158.271.703 1.16 1.51 1.879 1.037.925 1.91 1.211 2.181 1.347.272.136.43.113.589-.068.158-.182.678-.792.86-1.064.181-.271.362-.226.61-.136.249.091 1.583.746 1.854.882.272.136.452.204.52.317.068.113.068.656-.176 1.341z"/>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="border-t border-[#F0ECE6] scrollbar-hide" style="overflow-x:auto;-webkit-overflow-scrolling:touch">
                <div class="flex items-center font-metropolis" style="padding:0 8px;gap:0;width:max-content;min-width:100%">
                    <a class="nav-link<?php echo $is_shop_active ? ' nav-link-active' : ''; ?>" href="<?php echo esc_url(home_url('/products')); ?>" style="font-size:12px;letter-spacing:0.03em;padding:10px 12px;white-space:nowrap;display:inline-block;font-weight:600;color:#1A1A1A;text-decoration:none;">Shop</a>
                    <a class="nav-link<?php echo $is_skin_active ? ' nav-link-active' : ''; ?>" href="<?php echo esc_url(home_url('/products?concern=Skin')); ?>" style="font-size:12px;letter-spacing:0.03em;padding:10px 12px;white-space:nowrap;display:inline-block;font-weight:600;color:#1A1A1A;text-decoration:none;">Skin Care</a>
                    <a class="nav-link<?php echo $is_hair_active ? ' nav-link-active' : ''; ?>" href="<?php echo esc_url(home_url('/collections/hair')); ?>" style="font-size:12px;letter-spacing:0.03em;padding:10px 12px;white-space:nowrap;display:inline-block;font-weight:600;color:#1A1A1A;text-decoration:none;">Hair Care</a>
                    <a class="nav-link<?php echo $is_track_order ? ' nav-link-active' : ''; ?>" href="<?php echo esc_url(home_url('/track-order')); ?>" style="font-size:12px;letter-spacing:0.03em;padding:10px 12px;white-space:nowrap;display:inline-block;font-weight:600;color:#1A1A1A;text-decoration:none;">Track Order</a>
                    <a class="nav-link<?php echo $is_customer_help ? ' nav-link-active' : ''; ?>" href="<?php echo esc_url(home_url('/customer-help')); ?>" style="font-size:12px;letter-spacing:0.03em;padding:10px 12px;white-space:nowrap;display:inline-block;font-weight:600;color:#1A1A1A;text-decoration:none;">Customer Help</a>
                </div>
            </div>
        </div>
    </header>

    <!-- ═══════════════════════════════════════════════════════════════
         ONE-TIME INTERNATIONAL ORDERS NOTIFICATION (Near WhatsApp / Navbar)
         ═══════════════════════════════════════════════════════════════ -->
    <div id="international-orders-popup" class="hidden" role="dialog" aria-modal="false" aria-labelledby="intl-popup-title">
        <div class="intl-popup-card">
            <span class="intl-popup-arrow"></span>
            <button type="button" id="intl-popup-close" class="intl-popup-close-btn" aria-label="Close notification">&times;</button>
            <div class="intl-popup-badge-row">
                <span class="intl-popup-dot"></span>
                <span class="intl-popup-badge">WORLDWIDE ASSISTANCE</span>
            </div>
            <h3 id="intl-popup-title" class="intl-popup-heading">International Orders Accepted</h3>
            <p class="intl-popup-text">
                We accept orders from customers outside India. Contact us on WhatsApp for international ordering and assistance.
            </p>
            <div class="intl-popup-action-row">
                <a href="https://wa.me/919876543210" target="_blank" rel="noopener noreferrer" id="intl-popup-cta" class="intl-popup-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="13" height="13" fill="currentColor" aria-hidden="true" style="flex-shrink:0;">
                        <path d="M12.004 2c-5.518 0-9.996 4.48-9.996 10.001 0 1.765.459 3.488 1.332 5.008L2 22l5.122-1.311c1.472.802 3.13 1.226 4.882 1.226 5.518 0 10-4.48 10-10.001C22.004 6.48 17.522 2 12.004 2zm5.835 14.167c-.244.685-1.42 1.309-1.956 1.392-.518.08-1.196.113-3.447-.818-2.73-1.129-4.508-3.904-4.646-4.086-.135-.183-1.1-1.464-1.1-2.793 0-1.328.697-1.982.946-2.247.247-.266.541-.332.721-.332.181 0 .362.002.52.01.168.009.394-.064.616.471.229.551.78 1.902.848 2.042.068.14.113.305.023.487-.091.182-.136.295-.271.455-.136.16-.285.358-.408.48-.135.136-.277.283-.119.555.158.271.703 1.16 1.51 1.879 1.037.925 1.91 1.211 2.181 1.347.272.136.43.113.589-.068.158-.182.678-.792.86-1.064.181-.271.362-.226.61-.136.249.091 1.583.746 1.854.882.272.136.452.204.52.317.068.113.068.656-.176 1.341z"/>
                    </svg>
                    <span>Chat on WhatsApp</span>
                </a>
            </div>
        </div>
    </div>
    <script>
    (function() {
        var KEY = 'ratpaccheck_international_orders_popup_seen';
        function initIntlPopup() {
            try {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.get('reset_popup') === '1' || urlParams.get('test_popup') === '1' || urlParams.get('intl_popup') === '1') {
                    localStorage.removeItem(KEY);
                }
                if (localStorage.getItem(KEY)) {
                    return;
                }
            } catch (e) {
                return;
            }
            var popup = document.getElementById('international-orders-popup');
            if (!popup) return;

            setTimeout(function() {
                popup.style.display = 'block';
                popup.classList.remove('hidden');
                popup.classList.add('intl-popup-animate');
            }, 300);

            function dismiss() {
                try {
                    localStorage.setItem(KEY, 'true');
                } catch (e) {}
                popup.style.opacity = '0';
                popup.style.transform = 'translateY(-6px)';
                popup.style.transition = 'all 0.25s ease';
                setTimeout(function() {
                    popup.style.display = 'none';
                }, 260);
            }

            var closeBtn = document.getElementById('intl-popup-close');
            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    dismiss();
                });
            }

            var ctaBtn = document.getElementById('intl-popup-cta');
            if (ctaBtn) {
                ctaBtn.addEventListener('click', function() {
                    dismiss();
                });
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initIntlPopup);
        } else {
            initIntlPopup();
        }
    })();
    </script>

    <!-- ══════════════════════════════════════════
         DESKTOP MEGA MENU DROPDOWN (100% Vercel Match)
         ══════════════════════════════════════════ -->
    <div id="megamenu-dropdown" class="absolute top-full left-0 w-full z-50 bg-white border-t border-[#F0ECE6] shadow-[0_20px_60px_rgba(0,0,0,0.06),0_4px_16px_rgba(0,0,0,0.03)] hidden transition-all duration-200">
        <div class="hidden lg:block max-w-[1280px] mx-auto" style="padding:40px 56px 44px;">
            <!-- 1. Shop MegaMenu Panel (100% Exact Vercel Match) -->
            <div id="megamenu-panel-shop" class="megamenu-panel hidden" style="display:none;grid-template-columns:220px 1fr 220px;gap:48px;align-items:start;">
                <div>
                    <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:11px;font-weight:700;color:#1A1A1A;margin-bottom:20px;letter-spacing:0.12em;text-transform:uppercase;">Shop Categories</p>
                    <div style="display:flex;flex-direction:column;gap:4px;">
                        <a href="<?php echo esc_url(home_url('/products?concern=Skin')); ?>" class="group block no-underline transition-transform duration-200 hover:translate-x-1.5" style="text-decoration:none;padding:14px 0;border-bottom:1px solid #F0ECE6;">
                            <span class="block font-metropolis font-semibold text-sm text-[#1A1A1A] group-hover:text-black transition-colors" style="margin-bottom:4px;">Skin Care</span>
                            <span class="block font-metropolis font-normal text-xs text-[#8B8178] leading-snug">Active ingredient formulas for healthy skin</span>
                        </a>
                        <a href="<?php echo esc_url(home_url('/products?concern=Hair')); ?>" class="group block no-underline transition-transform duration-200 hover:translate-x-1.5" style="text-decoration:none;padding:14px 0;border-bottom:1px solid #F0ECE6;">
                            <span class="block font-metropolis font-semibold text-sm text-[#1A1A1A] group-hover:text-black transition-colors" style="margin-bottom:4px;">Hair Care</span>
                            <span class="block font-metropolis font-normal text-xs text-[#8B8178] leading-snug">Clinically tested solutions for scalp &amp; hair strength</span>
                        </a>
                    </div>
                </div>
                <div style="display:flex;gap:20px;justify-content:center;">
                    <a href="<?php echo esc_url(home_url('/products?concern=Skin')); ?>" class="group block no-underline transition-all duration-300 hover:-translate-y-1 hover:shadow-xl" style="width:280px;text-decoration:none;border-radius:16px;overflow:hidden;position:relative;box-shadow:0 4px 16px rgba(0,0,0,0.06);">
                        <div style="position:relative;width:100%;padding-top:110%;overflow:hidden;background-color:#F5F2ED;">
                            <img src="<?php echo esc_url(ratpaccheck_img_url('skin-care.jpeg')); ?>" alt="Skin Care" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;transition:transform 0.45s ease;" class="group-hover:scale-105" />
                            <div style="position:absolute;bottom:0;left:0;right:0;height:55%;background:linear-gradient(to top, rgba(0,0,0,0.52) 0%, rgba(0,0,0,0) 100%);pointer-events:none;"></div>
                            <div style="position:absolute;bottom:0;left:0;right:0;padding:20px 22px;">
                                <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:14px;font-weight:700;color:#FFFFFF;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:4px;text-shadow:0 1px 3px rgba(0,0,0,0.3);">Skin Care</p>
                                <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:11px;font-weight:400;color:rgba(255,255,255,0.80);letter-spacing:0.03em;margin:0;text-shadow:0 1px 2px rgba(0,0,0,0.2);">Dermatologist-tested formulas</p>
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo esc_url(home_url('/products?concern=Hair')); ?>" class="group block no-underline transition-all duration-300 hover:-translate-y-1 hover:shadow-xl" style="width:280px;text-decoration:none;border-radius:16px;overflow:hidden;position:relative;box-shadow:0 4px 16px rgba(0,0,0,0.06);">
                        <div style="position:relative;width:100%;padding-top:110%;overflow:hidden;background-color:#F5F2ED;">
                            <img src="<?php echo esc_url(ratpaccheck_img_url('hair-care.jpg')); ?>" alt="Hair Care" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;transition:transform 0.45s ease;" class="group-hover:scale-105" />
                            <div style="position:absolute;bottom:0;left:0;right:0;height:55%;background:linear-gradient(to top, rgba(0,0,0,0.52) 0%, rgba(0,0,0,0) 100%);pointer-events:none;"></div>
                            <div style="position:absolute;bottom:0;left:0;right:0;padding:20px 22px;">
                                <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:14px;font-weight:700;color:#FFFFFF;letter-spacing:0.1em;text-transform:uppercase;margin-bottom:4px;text-shadow:0 1px 3px rgba(0,0,0,0.3);">Hair Care</p>
                                <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:11px;font-weight:400;color:rgba(255,255,255,0.80);letter-spacing:0.03em;margin:0;text-shadow:0 1px 2px rgba(0,0,0,0.2);">Scalp-focused hair science</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div>
                    <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:11px;font-weight:700;color:#1A1A1A;margin-bottom:20px;letter-spacing:0.12em;text-transform:uppercase;">Why RatpacCheck</p>
                    <div style="display:flex;flex-direction:column;gap:14px;margin-bottom:28px;">
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span style="font-size:16px;line-height:1;">🔬</span>
                            <span style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:13px;font-weight:500;color:#3D3532;letter-spacing:0.02em;">Science-Backed Formulas</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span style="font-size:16px;line-height:1;">🧖</span>
                            <span style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:13px;font-weight:500;color:#3D3532;letter-spacing:0.02em;">Dermatologist Tested</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span style="font-size:16px;line-height:1;">🌿</span>
                            <span style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:13px;font-weight:500;color:#3D3532;letter-spacing:0.02em;">No Harsh Chemicals</span>
                        </div>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <span style="font-size:16px;line-height:1;">🐇</span>
                            <span style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:13px;font-weight:500;color:#3D3532;letter-spacing:0.02em;">Cruelty Free</span>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(home_url('/products')); ?>" style="display:inline-flex;align-items:center;gap:6px;font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:11px;font-weight:600;color:#FFFFFF;background-color:#000000;text-decoration:none;letter-spacing:0.08em;text-transform:uppercase;padding:10px 22px;border-radius:999px;transition:background-color 0.25s ease, transform 0.25s ease;">Explore All Products &rarr;</a>
                </div>
            </div>

            <!-- 2. Skin Care MegaMenu Panel (100% Exact Vercel Match) -->
            <div id="megamenu-panel-skincare" class="megamenu-panel hidden" style="display:none;grid-template-columns:200px 1fr 280px;gap:48px;align-items:start;">
                <div>
                    <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:11px;font-weight:700;color:#1A1A1A;margin-bottom:20px;letter-spacing:0.12em;text-transform:uppercase;">Skin Care Concerns</p>
                    <div style="display:flex;flex-direction:column;">
                        <?php
                        $skin_concerns_list = array('Acne', 'Dark Spots', 'Oiliness', 'Brightening Skin', 'Melasma', 'Hyperpigmentation', 'Tan', 'Dehydrated Skin');
                        foreach ($skin_concerns_list as $sc) : ?>
                            <a href="<?php echo esc_url(home_url('/products?concern=' . urlencode($sc))); ?>" class="block transition-all duration-200 hover:translate-x-1.5 hover:text-[#2C1810]" style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:13.5px;font-weight:400;color:#5A5550;text-decoration:none;padding:10px 0;display:block;border-bottom:1px solid #F2F0EC;">
                                <?php echo esc_html($sc); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div>
                    <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:11px;font-weight:700;color:#1A1A1A;margin-bottom:20px;letter-spacing:0.12em;text-transform:uppercase;">Popular Skin Products</p>
                    <div style="display:flex;gap:14px;">
                        <?php
                        $skin_bestsellers_nav = array(
                            array('name' => 'Multi-Functional Sunscreen 50+', 'price' => '₹499', 'image' => 'Multi-functional Sunscreen 50+.jpeg', 'badge' => 'Best Seller', 'id' => 109),
                            array('name' => 'Hydrating Face Cleanser', 'price' => '₹349', 'image' => 'Hydrating face cleanser.jpeg', 'badge' => 'Trending', 'id' => 104),
                            array('name' => 'Deep Glow Face Serum', 'price' => '₹599', 'image' => 'Deep glow (Face serum).jpeg', 'badge' => 'New', 'id' => 101),
                        );
                        foreach ($skin_bestsellers_nav as $p) : 
                            $is_cleanser = ($p['name'] === 'Hydrating Face Cleanser');
                        ?>
                            <a href="<?php echo esc_url(home_url('/product/' . $p['id'])); ?>" class="block flex-1 rounded-[14px] border border-[#EDEBE7] bg-white hover:border-[#C8BFB0] hover:bg-[#FDFCFA] transition-all duration-300 hover:-translate-y-1 shadow-sm hover:shadow-md overflow-hidden group" style="text-decoration:none;display:flex;flex-direction:column;">
                                <div class="product-image-wrapper" style="position:relative;width:100%;aspect-ratio:1/1;overflow:hidden;display:flex;align-items:center;justify-content:center;background-color:#FFFFFF;">
                                    <img src="<?php echo esc_url(ratpaccheck_img_url($p['image'])); ?>" alt="<?php echo esc_attr($p['name']); ?>" class="product-image" style="width:100%;height:100%;object-fit:contain;object-position:center;transition:transform 0.35s ease;<?php echo $is_cleanser ? 'transform:scale(1.24);' : 'transform:scale(1.08);'; ?>" />
                                    <span style="position:absolute;top:10px;left:10px;font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:9px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#7C5C3E;background-color:rgba(255,255,255,0.92);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);padding:4px 10px;border-radius:999px;border:1px solid #E8E3DB;">
                                        <?php echo esc_html($p['badge']); ?>
                                    </span>
                                </div>
                                <div style="padding:12px 14px 14px;">
                                    <p class="product-card-title line-clamp-2" style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:13px;font-weight:600;color:#2C1810;margin-bottom:4px;line-height:1.3;min-height:34px;"><?php echo esc_html($p['name']); ?></p>
                                    <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:12px;font-weight:700;color:#5C4A35;margin:0;"><?php echo esc_html($p['price']); ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="rounded-2xl overflow-hidden relative shadow-sm hover:shadow-md group" style="border-radius:16px;overflow:hidden;position:relative;height:100%;min-height:280px;box-shadow:0 4px 20px rgba(0,0,0,0.06);">
                    <img src="<?php echo esc_url(ratpaccheck_img_url('skin-care.jpeg')); ?>" alt="Science Backed Skincare" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;transition:transform 0.5s ease;" class="group-hover:scale-105" />
                    <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.62) 0%, rgba(0,0,0,0.10) 50%, rgba(0,0,0,0.02) 100%);pointer-events:none;"></div>
                    <div style="position:absolute;bottom:0;left:0;right:0;padding:24px 22px;">
                        <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:13px;font-weight:700;color:#FFFFFF;letter-spacing:0.12em;text-transform:uppercase;margin-bottom:6px;text-shadow:0 1px 3px rgba(0,0,0,0.3);">Science Backed Skincare</p>
                        <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:12px;font-weight:400;color:rgba(255,255,255,0.80);line-height:1.5;margin-bottom:16px;text-shadow:0 1px 2px rgba(0,0,0,0.2);">Clinically tested formulas made with active ingredients.</p>
                        <a href="<?php echo esc_url(home_url('/products?concern=Skin')); ?>" style="display:inline-flex;align-items:center;gap:5px;font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:11px;font-weight:600;color:#2C1810;background-color:rgba(255,255,255,0.92);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);text-decoration:none;letter-spacing:0.06em;text-transform:uppercase;padding:8px 18px;border-radius:999px;transition:background-color 0.25s ease;" onmouseover="this.style.backgroundColor='#FFFFFF'" onmouseout="this.style.backgroundColor='rgba(255,255,255,0.92)'">Shop Skin Care &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- 3. Hair Care MegaMenu Panel (100% Exact Vercel Match) -->
            <div id="megamenu-panel-haircare" class="megamenu-panel hidden" style="display:none;grid-template-columns:200px 1fr 280px;gap:48px;align-items:start;">
                <div>
                    <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:11px;font-weight:700;color:#1A1A1A;margin-bottom:20px;letter-spacing:0.12em;text-transform:uppercase;">Hair Care Concerns</p>
                    <div style="display:flex;flex-direction:column;">
                        <?php
                        $hair_concerns_list = array('Hairfall', 'Dandruff');
                        foreach ($hair_concerns_list as $hc) : ?>
                            <a href="<?php echo esc_url(home_url('/products?concern=' . urlencode($hc))); ?>" class="block transition-all duration-200 hover:translate-x-1.5 hover:text-[#2C1810]" style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:13.5px;font-weight:400;color:#5A5550;text-decoration:none;padding:10px 0;display:block;border-bottom:1px solid #F2F0EC;">
                                <?php echo esc_html($hc); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div>
                    <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:11px;font-weight:700;color:#1A1A1A;margin-bottom:20px;letter-spacing:0.12em;text-transform:uppercase;">Popular Hair Products</p>
                    <div style="display:flex;gap:14px;">
                        <?php
                        $hair_bestsellers_nav = array(
                            array('name' => 'Hair Growth Serum', 'price' => '₹899', 'image' => 'Hair growth serum.jpeg', 'badge' => 'Best Seller', 'id' => 203),
                            array('name' => 'Anti-Hairfall Oil', 'price' => '₹449', 'image' => 'Anti-hairfall oil.png', 'badge' => 'Trending', 'id' => 205),
                            array('name' => 'Anti-Dandruff Shampoo', 'price' => '₹499', 'image' => 'Anti-dandruff shampoo.jpeg', 'badge' => 'New', 'id' => 207),
                        );
                        foreach ($hair_bestsellers_nav as $p) : ?>
                            <a href="<?php echo esc_url(home_url('/product/' . $p['id'])); ?>" class="block flex-1 rounded-[14px] border border-[#EDEBE7] bg-white hover:border-[#C8BFB0] hover:bg-[#FDFCFA] transition-all duration-300 hover:-translate-y-1 shadow-sm hover:shadow-md overflow-hidden group" style="text-decoration:none;display:flex;flex-direction:column;">
                                <div class="product-image-wrapper" style="position:relative;width:100%;aspect-ratio:1/1;overflow:hidden;display:flex;align-items:center;justify-content:center;background-color:#FFFFFF;">
                                    <img src="<?php echo esc_url(ratpaccheck_img_url($p['image'])); ?>" alt="<?php echo esc_attr($p['name']); ?>" class="product-image" style="width:100%;height:100%;object-fit:contain;object-position:center;transition:transform 0.35s ease;transform:scale(1.08);" />
                                    <span style="position:absolute;top:10px;left:10px;font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:9px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#7C5C3E;background-color:rgba(255,255,255,0.92);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);padding:4px 10px;border-radius:999px;border:1px solid #E8E3DB;">
                                        <?php echo esc_html($p['badge']); ?>
                                    </span>
                                </div>
                                <div style="padding:12px 14px 14px;">
                                    <p class="product-card-title line-clamp-2" style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:13px;font-weight:600;color:#2C1810;margin-bottom:4px;line-height:1.3;min-height:34px;"><?php echo esc_html($p['name']); ?></p>
                                    <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:12px;font-weight:700;color:#5C4A35;margin:0;"><?php echo esc_html($p['price']); ?></p>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="rounded-2xl overflow-hidden relative shadow-sm hover:shadow-md group" style="border-radius:16px;overflow:hidden;position:relative;height:100%;min-height:280px;box-shadow:0 4px 20px rgba(0,0,0,0.06);">
                    <img src="<?php echo esc_url(ratpaccheck_img_url('hair-care.jpg')); ?>" alt="Scalp First Haircare" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;object-position:center;transition:transform 0.5s ease;" class="group-hover:scale-105" />
                    <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.62) 0%, rgba(0,0,0,0.10) 50%, rgba(0,0,0,0.02) 100%);pointer-events:none;"></div>
                    <div style="position:absolute;bottom:0;left:0;right:0;padding:24px 22px;">
                        <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:13px;font-weight:700;color:#FFFFFF;letter-spacing:0.12em;text-transform:uppercase;margin-bottom:6px;text-shadow:0 1px 3px rgba(0,0,0,0.3);">Scalp First Haircare</p>
                        <p style="font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:12px;font-weight:400;color:rgba(255,255,255,0.80);line-height:1.5;margin-bottom:16px;text-shadow:0 1px 2px rgba(0,0,0,0.2);">Healthy scalp leads to stronger hair.</p>
                        <a href="<?php echo esc_url(home_url('/products?concern=Hair')); ?>" style="display:inline-flex;align-items:center;gap:5px;font-family:'Metropolis', 'Helvetica Neue', Arial, sans-serif;font-size:11px;font-weight:600;color:#2C1810;background-color:rgba(255,255,255,0.92);backdrop-filter:blur(4px);-webkit-backdrop-filter:blur(4px);text-decoration:none;letter-spacing:0.06em;text-transform:uppercase;padding:8px 18px;border-radius:999px;transition:background-color 0.25s ease;" onmouseover="this.style.backgroundColor='#FFFFFF'" onmouseout="this.style.backgroundColor='rgba(255,255,255,0.92)'">Shop Hair Care &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════
         SEARCH DROPDOWN PANEL (100% Vercel Match)
         ══════════════════════════════════════════ -->
    <div id="search-dropdown-wrapper" class="absolute top-full left-0 w-full z-50 bg-white border-t border-[#F0ECE6] shadow-[0_20px_60px_rgba(0,0,0,0.08)] hidden">
        <div class="max-w-[760px] mx-auto w-full bg-white flex flex-col max-h-[85vh]">
            <!-- Search Input Bar -->
            <div class="w-full px-4 pt-4 sticky top-0 bg-white z-10 pb-4 border-b border-gray-50">
                <div class="flex items-center bg-gray-50 rounded-xl border border-gray-200 px-3 py-2.5 shadow-sm transition-all focus-within:ring-2 focus-within:ring-gray-100 focus-within:border-gray-300">
                    <svg class="w-4 h-4 text-gray-400 mr-2.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    <input id="navbar-search-input" type="text" placeholder="Search for products, ingredients..." class="w-full outline-none text-sm text-gray-700 placeholder-gray-400 bg-transparent font-medium" autocomplete="off" />
                    <button id="navbar-search-clear" class="p-1 hover:bg-gray-200 rounded-full transition-colors hidden" type="button" aria-label="Clear search">
                        <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
            </div>

            <!-- Scrollable Search Body -->
            <div id="navbar-search-body" class="overflow-y-auto px-4 py-4 space-y-6">
                <!-- Default Suggestions -->
                <div id="search-default-content" class="space-y-6">
                    <!-- Popular Categories -->
                    <div class="space-y-3">
                        <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase px-1">POPULAR CATEGORIES</p>
                        <div class="flex flex-wrap gap-2">
                            <a href="<?php echo esc_url(home_url('/products?concern=Skin')); ?>" class="px-4 py-2 rounded-full border border-gray-200 bg-white text-xs font-semibold text-gray-700 hover:bg-gray-50 transition-colors shadow-sm" style="text-decoration:none;">Skin Care</a>
                            <a href="<?php echo esc_url(home_url('/products?concern=Hair')); ?>" class="px-4 py-2 rounded-full border border-gray-200 bg-white text-xs font-semibold text-gray-700 hover:bg-gray-50 transition-colors shadow-sm" style="text-decoration:none;">Hair Care</a>
                        </div>
                    </div>

                    <!-- Popular Products Quick Links -->
                    <div class="space-y-3">
                        <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase px-1">POPULAR PRODUCTS</p>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <?php
                            $search_popular = array(
                                array('name' => 'Hair Growth Serum', 'subtitle' => 'Reduces hair fall in 2 months', 'price' => '₹899', 'image' => 'Hair growth serum.jpeg', 'id' => 203),
                                array('name' => 'Multi-Functional Sunscreen 50+', 'subtitle' => 'Broad spectrum UV protection', 'price' => '₹499', 'image' => 'Multi-functional Sunscreen 50+.jpeg', 'id' => 109),
                                array('name' => 'Anti-Dandruff Shampoo', 'subtitle' => 'Clears flakes & soothes scalp', 'price' => '₹499', 'image' => 'Anti-dandruff shampoo.jpeg', 'id' => 207),
                                array('name' => 'Hydrating Face Cleanser', 'subtitle' => 'Gentle barrier repair', 'price' => '₹349', 'image' => 'Hydrating face cleanser.jpeg', 'id' => 104),
                            );
                            foreach ($search_popular as $item) : ?>
                                <a href="<?php echo esc_url(home_url('/product/' . $item['id'])); ?>" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-gray-50 transition-colors border border-gray-100 group" style="text-decoration:none;">
                                    <div class="w-12 h-12 rounded-lg bg-[#F5F2ED] overflow-hidden flex-shrink-0 flex items-center justify-center">
                                        <img src="<?php echo esc_url(ratpaccheck_img_url($item['image'])); ?>" alt="<?php echo esc_attr($item['name']); ?>" class="w-full h-full object-contain group-hover:scale-105 transition-transform" />
                                    </div>
                                    <div class="flex-grow min-w-0">
                                        <p class="font-metropolis text-xs font-semibold text-gray-800 truncate"><?php echo esc_html($item['name']); ?></p>
                                        <p class="text-[11px] text-gray-400 truncate"><?php echo esc_html($item['subtitle']); ?></p>
                                        <span class="font-metropolis text-xs font-bold text-[#1A1A1A]"><?php echo esc_html($item['price']); ?></span>
                                    </div>
                                    <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-[#1A1A1A] group-hover:text-white transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Live Results Container -->
                <div id="search-live-results" class="space-y-3 hidden">
                    <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase px-1">SEARCH RESULTS</p>
                    <div id="search-results-list" class="grid grid-cols-1 gap-3"></div>
                </div>
            </div>
        </div>
    </div>

</div><!-- #site-header-wrapper -->

    <!-- MegaMenu Backdrop -->
    <div id="megamenu-backdrop" class="fixed inset-0 z-40 bg-black/25 hidden transition-opacity duration-200"></div>

    <!-- Search Dropdown Backdrop -->
    <div id="search-backdrop" class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm hidden transition-opacity duration-200"></div>

    <!-- Mobile Slide-In Navigation Drawer -->
    <div id="mobile-menu-drawer" class="fixed inset-0 z-50 transform -translate-x-full transition-transform duration-300 ease-in-out lg:hidden pointer-events-none">
        <div id="mobile-menu-backdrop" class="absolute inset-0 bg-black/50 opacity-0 transition-opacity duration-300"></div>
        <div class="relative w-[300px] max-w-[85vw] h-full bg-white shadow-2xl flex flex-col justify-between p-6 z-10 overflow-y-auto">
            <div>
                <div class="flex items-center justify-between pb-5 border-b border-gray-100">
                    <span class="font-metropolis font-bold text-lg text-[#E8A3A8]">RatpacCheck.</span>
                    <button type="button" id="mobile-menu-close" class="p-2 text-gray-500 hover:text-black">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <nav class="flex flex-col space-y-4 pt-6">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="font-metropolis text-base font-semibold text-black hover:text-[#C9A84C]">Home</a>
                    <a href="<?php echo esc_url(home_url('/products/')); ?>" class="font-metropolis text-base font-semibold text-black hover:text-[#C9A84C]">Shop All Products</a>
                    <a href="<?php echo esc_url(home_url('/collections/skin')); ?>" class="font-metropolis text-base font-semibold text-black hover:text-[#C9A84C]">Skin Care</a>
                    <a href="<?php echo esc_url(home_url('/collections/hair')); ?>" class="font-metropolis text-base font-semibold text-black hover:text-[#C9A84C]">Hair Care</a>
                    <a href="<?php echo esc_url(home_url('/collections/')); ?>" class="font-metropolis text-base font-semibold text-black hover:text-[#C9A84C]">Collections</a>
                    <a href="<?php echo esc_url(home_url('/about/')); ?>" class="font-metropolis text-base font-semibold text-black hover:text-[#C9A84C]">About Us</a>
                    <a href="<?php echo esc_url(home_url('/customer-help/')); ?>" class="font-metropolis text-base font-semibold text-black hover:text-[#C9A84C]">Customer Help &amp; FAQs</a>
                    <a href="<?php echo esc_url(home_url('/track-order/')); ?>" class="font-metropolis text-base font-semibold text-black hover:text-[#C9A84C]">Track Your Order</a>
                </nav>
            </div>
            <div class="pt-6 border-t border-gray-100 text-xs text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> RatpacCheck. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Search Modal Overlay -->
    <div id="search-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm hidden items-start justify-center pt-20 px-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full p-6 relative">
            <button type="button" id="search-modal-close" class="absolute top-4 right-4 text-gray-400 hover:text-black">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h3 class="font-metropolis font-semibold text-lg text-black mb-4">Search Products</h3>
            <div class="relative mb-6">
                <input type="text" id="site-search-input" placeholder="Search by name, concern (e.g. Hairfall, Acne)..." class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-black" />
                <svg class="w-5 h-5 text-gray-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <div id="search-results-box" class="max-h-80 overflow-y-auto divide-y divide-gray-100">
                <p class="text-xs text-gray-400 text-center py-4">Type to start searching products...</p>
            </div>
        </div>
    </div>

    <!-- Content Area Starts -->
    <main id="primary" class="site-main flex-grow">
