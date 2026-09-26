/**
 * RatpacCheck Theme Interactive Scripts
 * Lightweight Vanilla JS handling Cart Drawer, Mobile Navigation,
 * Hero Slider, FAQs, Search Modal, and Product Details.
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

document.addEventListener('DOMContentLoaded', () => {

    // ─────────────────────────────────────────────────────────────
    // 1. Cart Management (Persistent via localStorage)
    // ─────────────────────────────────────────────────────────────
    const CART_STORAGE_KEY = 'ratpaccheck_cart_v1';
    let cart = [];

    try {
        const saved = localStorage.getItem(CART_STORAGE_KEY);
        if (saved) {
            cart = JSON.parse(saved);
        }
    } catch (e) {
        cart = [];
    }

    function saveCart() {
        try {
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
        } catch (e) {}
        renderCartUI();
    }

    const cartDrawer = document.getElementById('cart-drawer');
    const cartBackdrop = document.getElementById('cart-backdrop');
    const cartDrawerClose = document.getElementById('cart-drawer-close');
    const cartDrawerTrigger = document.getElementById('cart-drawer-trigger');
    const cartCounterBadge = document.getElementById('cart-counter-badge');
    const cartDrawerCount = document.getElementById('cart-drawer-count');
    const cartItemsContainer = document.getElementById('cart-items-container');
    const cartEmptyState = document.getElementById('cart-empty-state');
    const cartFooter = document.getElementById('cart-footer');
    const cartSubtotalPrice = document.getElementById('cart-subtotal-price');
    const freeShippingText = document.getElementById('free-shipping-text');
    const freeShippingProgress = document.getElementById('free-shipping-progress');

    function openCart() {
        if (!cartDrawer) return;
        cartDrawer.classList.remove('translate-x-full');
        cartDrawer.classList.remove('pointer-events-none');
        if (cartBackdrop) {
            cartBackdrop.classList.remove('opacity-0');
        }
        document.body.style.overflow = 'hidden';
    }

    function closeCart() {
        if (!cartDrawer) return;
        cartDrawer.classList.add('translate-x-full');
        cartDrawer.classList.add('pointer-events-none');
        if (cartBackdrop) {
            cartBackdrop.classList.add('opacity-0');
        }
        document.body.style.overflow = '';
    }

    if (cartDrawerTrigger) cartDrawerTrigger.addEventListener('click', openCart);
    document.querySelectorAll('.mobile-cart-trigger').forEach(btn => btn.addEventListener('click', openCart));
    if (cartDrawerClose) cartDrawerClose.addEventListener('click', closeCart);
    if (cartBackdrop) cartBackdrop.addEventListener('click', closeCart);

    const cartCheckoutBtn = document.getElementById('cart-checkout-btn');
    if (cartCheckoutBtn) {
        cartCheckoutBtn.addEventListener('click', () => {
            closeCart();
            const checkoutUrl = (window.RatpacCheckData && window.RatpacCheckData.checkoutUrl) ? window.RatpacCheckData.checkoutUrl : ((window.RatpacCheckData && window.RatpacCheckData.homeUrl) ? (window.RatpacCheckData.homeUrl + 'checkout/') : '/checkout/');
            window.location.href = checkoutUrl;
        });
    }

    // ── Auth Slide-in Drawer ──
    const authDrawer = document.getElementById('auth-drawer');
    const authBackdrop = document.getElementById('auth-backdrop');
    const authDrawerClose = document.getElementById('auth-drawer-close');
    const authDrawerTrigger = document.getElementById('auth-drawer-trigger');
    const authTabBtnLogin = document.getElementById('auth-tab-btn-login');
    const authTabBtnRegister = document.getElementById('auth-tab-btn-register');
    const authPanelLogin = document.getElementById('auth-panel-login');
    const authPanelRegister = document.getElementById('auth-panel-register');

    function openAuthDrawer(initialTab) {
        if (!authDrawer) return;
        if (initialTab === 'register') {
            switchToRegister();
        } else {
            switchToLogin();
        }
        authDrawer.classList.remove('translate-x-full');
        authDrawer.classList.remove('pointer-events-none');
        if (authBackdrop) {
            authBackdrop.classList.remove('opacity-0');
        }
        document.body.style.overflow = 'hidden';
    }

    function closeAuthDrawer() {
        if (!authDrawer) return;
        authDrawer.classList.add('translate-x-full');
        authDrawer.classList.add('pointer-events-none');
        if (authBackdrop) {
            authBackdrop.classList.add('opacity-0');
        }
        document.body.style.overflow = '';
    }

    function switchToLogin() {
        if (!authPanelLogin || !authPanelRegister) return;
        authPanelLogin.classList.remove('hidden');
        authPanelRegister.classList.add('hidden');
        if (authTabBtnLogin && authTabBtnRegister) {
            authTabBtnLogin.classList.add('bg-[#1A1A1A]', 'text-white', 'shadow-xs');
            authTabBtnLogin.classList.remove('text-[#666666]');
            authTabBtnRegister.classList.remove('bg-[#1A1A1A]', 'text-white', 'shadow-xs');
            authTabBtnRegister.classList.add('text-[#666666]');
        }
    }

    function switchToRegister() {
        if (!authPanelLogin || !authPanelRegister) return;
        authPanelLogin.classList.add('hidden');
        authPanelRegister.classList.remove('hidden');
        if (authTabBtnLogin && authTabBtnRegister) {
            authTabBtnRegister.classList.add('bg-[#1A1A1A]', 'text-white', 'shadow-xs');
            authTabBtnRegister.classList.remove('text-[#666666]');
            authTabBtnLogin.classList.remove('bg-[#1A1A1A]', 'text-white', 'shadow-xs');
            authTabBtnLogin.classList.add('text-[#666666]');
        }
    }

    if (authDrawerTrigger) authDrawerTrigger.addEventListener('click', () => openAuthDrawer('login'));
    document.querySelectorAll('.mobile-auth-trigger').forEach(btn => btn.addEventListener('click', () => openAuthDrawer('login')));
    if (authDrawerClose) authDrawerClose.addEventListener('click', closeAuthDrawer);
    if (authBackdrop) authBackdrop.addEventListener('click', closeAuthDrawer);
    if (authTabBtnLogin) authTabBtnLogin.addEventListener('click', switchToLogin);
    if (authTabBtnRegister) authTabBtnRegister.addEventListener('click', switchToRegister);

    // ── Cart Coupon Handler ──
    const couponInput = document.getElementById('cart-coupon-code');
    const applyCouponBtn = document.getElementById('cart-apply-coupon-btn');
    const couponNotice = document.getElementById('cart-coupon-notice');
    const discountRow = document.getElementById('cart-discount-row');
    const discountAmount = document.getElementById('cart-discount-amount');

    if (applyCouponBtn && couponInput) {
        applyCouponBtn.addEventListener('click', function() {
            const code = couponInput.value.trim();
            if (!code) return;
            
            if (window.RatpacCheckData && window.RatpacCheckData.wcActive && window.RatpacCheckData.ajaxUrl) {
                applyCouponBtn.disabled = true;
                applyCouponBtn.textContent = '...';

                const formData = new FormData();
                formData.append('action', 'ratpaccheck_apply_coupon');
                formData.append('security', window.RatpacCheckData.cartNonce);
                formData.append('coupon_code', code);

                fetch(window.RatpacCheckData.ajaxUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(r => r.json())
                .then(res => {
                    applyCouponBtn.disabled = false;
                    applyCouponBtn.textContent = 'Apply';
                    if (couponNotice) {
                        couponNotice.classList.remove('hidden', 'text-red-600', 'text-green-700');
                        if (res.success) {
                            couponNotice.classList.add('text-green-700');
                            couponNotice.textContent = res.data.success_message || 'Coupon applied!';
                            couponInput.value = '';
                            if (res.data.has_discount && discountRow && discountAmount) {
                                discountRow.classList.remove('hidden');
                                discountAmount.textContent = '-' + res.data.discount_total;
                            }
                            if (cartSubtotalPrice) cartSubtotalPrice.textContent = res.data.total;
                        } else {
                            couponNotice.classList.add('text-red-600');
                            couponNotice.textContent = res.data.message || 'Invalid coupon';
                        }
                    }
                })
                .catch(() => {
                    applyCouponBtn.disabled = false;
                    applyCouponBtn.textContent = 'Apply';
                });
            } else {
                // Client-side fallback
                if (code.toUpperCase() === 'FIRST10' || code.toUpperCase() === 'BEAUTY10') {
                    if (couponNotice) {
                        couponNotice.classList.remove('hidden', 'text-red-600');
                        couponNotice.classList.add('text-green-700');
                        couponNotice.textContent = 'Coupon applied: 10% OFF!';
                    }
                } else {
                    if (couponNotice) {
                        couponNotice.classList.remove('hidden', 'text-green-700');
                        couponNotice.classList.add('text-red-600');
                        couponNotice.textContent = 'Invalid coupon code';
                    }
                }
            }
        });
    }

    // Global cart API
    window.ratpaccheck_cart = {
        addItem: function(item, qty) {
            const id = parseInt(item.id, 10);
            const name = item.name || 'Product';
            const price = parseInt(item.price, 10) || 0;
            const originalPrice = parseInt(item.originalPrice, 10) || 0;
            const image = item.image || '';
            const subtitle = item.subtitle || '';
            const quantityToAdd = qty || 1;

            const existingIndex = cart.findIndex(i => i.id === id);
            if (existingIndex > -1) {
                cart[existingIndex].quantity += quantityToAdd;
            } else {
                cart.push({ id, name, price, originalPrice, image, subtitle, quantity: quantityToAdd });
            }
            saveCart();
            renderCartUI();
            openCart();

            // Background sync with WooCommerce session if active
            if (window.RatpacCheckData && window.RatpacCheckData.wcActive && window.RatpacCheckData.ajaxUrl) {
                const fd = new FormData();
                fd.append('action', 'ratpaccheck_add_to_cart');
                fd.append('security', window.RatpacCheckData.cartNonce);
                fd.append('product_id', id);
                fd.append('quantity', quantityToAdd);
                fetch(window.RatpacCheckData.ajaxUrl, { method: 'POST', body: fd }).catch(() => {});
            }
        },
        openCart: openCart,
        closeCart: closeCart,
        openAuth: openAuthDrawer,
        closeAuth: closeAuthDrawer,
        getCart: function() { return cart; }
    };

    function renderCartUI() {
        const totalCount = cart.reduce((sum, item) => sum + item.quantity, 0);
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

        document.querySelectorAll('.cart-counter-badge, #cart-counter-badge').forEach(badge => {
            badge.textContent = totalCount;
            badge.style.display = totalCount > 0 ? 'flex' : 'none';
        });
        if (cartDrawerCount) cartDrawerCount.textContent = `${totalCount} item${totalCount !== 1 ? 's' : ''}`;
        if (cartSubtotalPrice) cartSubtotalPrice.textContent = `₹${subtotal.toLocaleString('en-IN')}`;

        // Free shipping calculation (Target ₹499)
        const target = 499;
        if (freeShippingText && freeShippingProgress) {
            if (subtotal >= target) {
                freeShippingText.innerHTML = '<span class="text-green-700 font-bold">🎉 You have unlocked Free Shipping!</span>';
                freeShippingProgress.style.width = '100%';
                freeShippingProgress.style.backgroundColor = '#16a34a';
            } else {
                const diff = target - subtotal;
                freeShippingText.innerHTML = `Add <strong>₹${diff.toLocaleString('en-IN')}</strong> more for Free Shipping!`;
                const pct = Math.min(100, Math.round((subtotal / target) * 100));
                freeShippingProgress.style.width = `${pct}%`;
                freeShippingProgress.style.backgroundColor = '#000000';
            }
        }

        if (totalCount === 0) {
            if (cartEmptyState) cartEmptyState.classList.remove('hidden');
            if (cartItemsContainer) cartItemsContainer.classList.add('hidden');
            if (cartFooter) cartFooter.classList.add('hidden');
        } else {
            if (cartEmptyState) cartEmptyState.classList.add('hidden');
            if (cartItemsContainer) {
                cartItemsContainer.classList.remove('hidden');
                cartItemsContainer.innerHTML = '';

                cart.forEach((item, index) => {
                    const el = document.createElement('div');
                    el.className = 'flex items-center gap-3 p-3 bg-[#FBF9F5] rounded-lg border border-gray-200';
                    el.innerHTML = `
                        <div class="w-16 h-16 rounded-md overflow-hidden bg-white p-1 flex-shrink-0 border border-gray-100 flex items-center justify-center">
                            <img src="${item.image}" alt="${item.name}" class="w-full h-full object-contain" />
                        </div>
                        <div class="flex-grow min-w-0">
                            <h4 class="font-metropolis text-xs font-bold text-black truncate">${item.name}</h4>
                            <p class="text-[11px] text-gray-500 truncate">${item.subtitle || ''}</p>
                            <div class="flex items-baseline gap-2 mt-1">
                                <span class="font-metropolis text-xs font-bold text-black">₹${item.price}</span>
                                ${item.originalPrice > item.price ? `<span class="text-[10px] text-gray-400 line-through">₹${item.originalPrice}</span>` : ''}
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <div class="flex items-center border border-gray-300 rounded bg-white">
                                    <button type="button" class="btn-qty-minus px-2 py-0.5 text-xs text-gray-600 hover:text-black font-bold" data-index="${index}">-</button>
                                    <span class="px-2 text-xs font-semibold">${item.quantity}</span>
                                    <button type="button" class="btn-qty-plus px-2 py-0.5 text-xs text-gray-600 hover:text-black font-bold" data-index="${index}">+</button>
                                </div>
                                <button type="button" class="btn-remove-item text-[11px] text-red-600 hover:underline ml-auto" data-index="${index}">Remove</button>
                            </div>
                        </div>
                    `;
                    cartItemsContainer.appendChild(el);
                });
            }
            if (cartFooter) cartFooter.classList.remove('hidden');
        }
    }

    // Cart Quantity minus/plus and remove
    if (cartItemsContainer) {
        cartItemsContainer.addEventListener('click', (e) => {
            const minusBtn = e.target.closest('.btn-qty-minus');
            const plusBtn = e.target.closest('.btn-qty-plus');
            const removeBtn = e.target.closest('.btn-remove-item');

            if (minusBtn) {
                const idx = parseInt(minusBtn.dataset.index, 10);
                if (cart[idx].quantity > 1) {
                    cart[idx].quantity -= 1;
                } else {
                    cart.splice(idx, 1);
                }
                saveCart();
            } else if (plusBtn) {
                const idx = parseInt(plusBtn.dataset.index, 10);
                cart[idx].quantity += 1;
                saveCart();
            } else if (removeBtn) {
                const idx = parseInt(removeBtn.dataset.index, 10);
                cart.splice(idx, 1);
                saveCart();
            }
        });
    }

    // Add to cart click handlers
    document.addEventListener('click', (e) => {
        const btn = e.target.closest('.btn-add-to-cart') || e.target.closest('#single-add-to-cart') || e.target.closest('#pdp-add-to-cart-btn');
        if (btn) {
            e.preventDefault();
            const id = parseInt(btn.dataset.id, 10);
            const name = btn.dataset.name || 'Product';
            const price = parseInt(btn.dataset.price, 10) || 0;
            const originalPrice = parseInt(btn.dataset.originalPrice, 10) || 0;
            const image = btn.dataset.image || '';
            const subtitle = btn.dataset.subtitle || '';

            let quantityToAdd = 1;
            const qtyDisplay = document.getElementById('qty-display');
            if (qtyDisplay && btn.id === 'single-add-to-cart') {
                quantityToAdd = parseInt(qtyDisplay.textContent, 10) || 1;
            }

            const existingIndex = cart.findIndex(item => item.id === id);
            if (existingIndex > -1) {
                cart[existingIndex].quantity += quantityToAdd;
            } else {
                cart.push({ id, name, price, originalPrice, image, subtitle, quantity: quantityToAdd });
            }

            saveCart();
            openCart();

            // Button feedback
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span>Added to Bag ✓</span>';
            setTimeout(() => {
                btn.innerHTML = originalText;
            }, 1200);
        }
    });

    // Initial cart render
    renderCartUI();


    // ─────────────────────────────────────────────────────────────
    // 2. Mobile Navigation Drawer
    // ─────────────────────────────────────────────────────────────
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');
    const mobileMenuBackdrop = document.getElementById('mobile-menu-backdrop');

    function openMobileMenu() {
        if (!mobileMenuDrawer) return;
        mobileMenuDrawer.classList.remove('-translate-x-full');
        mobileMenuDrawer.classList.remove('pointer-events-none');
        if (mobileMenuBackdrop) mobileMenuBackdrop.classList.remove('opacity-0');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileMenu() {
        if (!mobileMenuDrawer) return;
        mobileMenuDrawer.classList.add('-translate-x-full');
        mobileMenuDrawer.classList.add('pointer-events-none');
        if (mobileMenuBackdrop) mobileMenuBackdrop.classList.add('opacity-0');
        document.body.style.overflow = '';
    }

    if (mobileMenuToggle) mobileMenuToggle.addEventListener('click', openMobileMenu);
    if (mobileMenuClose) mobileMenuClose.addEventListener('click', closeMobileMenu);
    if (mobileMenuBackdrop) mobileMenuBackdrop.addEventListener('click', closeMobileMenu);


    // ─────────────────────────────────────────────────────────────
    // 3. Desktop & Mobile Hero Sliders
    // ─────────────────────────────────────────────────────────────
    // Desktop Hero
    const desktopHeroContainer = document.getElementById('desktop-hero-container');
    const desktopHeroPrev = document.getElementById('desktop-hero-prev');
    const desktopHeroNext = document.getElementById('desktop-hero-next');
    const desktopDots = document.querySelectorAll('.desktop-dot');
    let desktopHeroIdx = 0;

    function updateDesktopDots(idx) {
        desktopHeroIdx = idx;
        desktopDots.forEach((dot, i) => {
            if (i === idx) {
                dot.className = 'desktop-dot rounded-full transition-all duration-300 bg-black w-4 h-2';
            } else {
                dot.className = 'desktop-dot rounded-full transition-all duration-300 bg-gray-300 w-2 h-2';
            }
        });
    }

    function goToDesktopSlide(idx) {
        if (!desktopHeroContainer) return;
        const w = desktopHeroContainer.offsetWidth;
        desktopHeroContainer.scrollTo({ left: idx * w, behavior: 'smooth' });
        updateDesktopDots(idx);
    }

    if (desktopHeroContainer) {
        // Sync dot indicator on manual swipe/scroll
        desktopHeroContainer.addEventListener('scroll', () => {
            const w = desktopHeroContainer.offsetWidth;
            if (w > 0) {
                const idx = Math.round(desktopHeroContainer.scrollLeft / w);
                if (idx !== desktopHeroIdx) {
                    updateDesktopDots(idx);
                }
            }
        }, { passive: true });

        if (desktopHeroPrev) {
            desktopHeroPrev.addEventListener('click', () => {
                const next = (desktopHeroIdx - 1 + 2) % 2;
                goToDesktopSlide(next);
            });
        }
        if (desktopHeroNext) {
            desktopHeroNext.addEventListener('click', () => {
                const next = (desktopHeroIdx + 1) % 2;
                goToDesktopSlide(next);
            });
        }
        desktopDots.forEach(dot => {
            dot.addEventListener('click', () => {
                goToDesktopSlide(parseInt(dot.dataset.index, 10) || 0);
            });
        });

        // Auto-advance every 5 seconds
        setInterval(() => {
            if (!desktopHeroContainer.matches(':hover')) {
                const next = (desktopHeroIdx + 1) % 2;
                goToDesktopSlide(next);
            }
        }, 5000);
    }

    // Mobile Hero
    const mobileHeroScroll = document.getElementById('mobile-hero-scroll');
    const mobileHeroPrev = document.getElementById('mobile-hero-prev');
    const mobileHeroNext = document.getElementById('mobile-hero-next');
    const mobileHeroDots = document.querySelectorAll('.mobile-hero-dot');
    let mobileHeroIdx = 0;

    function updateMobileDots(idx) {
        mobileHeroIdx = idx;
        mobileHeroDots.forEach((dot, i) => {
            if (i === idx) {
                dot.className = 'mobile-hero-dot rounded-full transition-all duration-300 bg-black w-3 h-1';
            } else {
                dot.className = 'mobile-hero-dot rounded-full transition-all duration-300 bg-gray-400 w-1 h-1';
            }
        });
    }

    function goToMobileSlide(idx) {
        if (!mobileHeroScroll) return;
        const w = mobileHeroScroll.offsetWidth;
        mobileHeroScroll.scrollTo({ left: idx * w, behavior: 'smooth' });
        updateMobileDots(idx);
    }

    if (mobileHeroScroll) {
        mobileHeroScroll.addEventListener('scroll', () => {
            const w = mobileHeroScroll.offsetWidth;
            if (w > 0) {
                const idx = Math.round(mobileHeroScroll.scrollLeft / w);
                if (idx !== mobileHeroIdx) {
                    updateMobileDots(idx);
                }
            }
        }, { passive: true });

        if (mobileHeroPrev) {
            mobileHeroPrev.addEventListener('click', () => {
                const next = (mobileHeroIdx - 1 + 2) % 2;
                goToMobileSlide(next);
            });
        }
        if (mobileHeroNext) {
            mobileHeroNext.addEventListener('click', () => {
                const next = (mobileHeroIdx + 1) % 2;
                goToMobileSlide(next);
            });
        }
        mobileHeroDots.forEach(dot => {
            dot.addEventListener('click', () => {
                goToMobileSlide(parseInt(dot.dataset.index, 10) || 0);
            });
        });

        // Auto-advance every 3 seconds (Next.js match)
        setInterval(() => {
            const next = (mobileHeroIdx + 1) % 2;
            goToMobileSlide(next);
        }, 3000);
    }

    // Customer Results Slider (Mobile)
    const customerResultsPrev = document.getElementById('customer-results-prev');
    const customerResultsNext = document.getElementById('customer-results-next');
    const customerResultsSlider = document.querySelector('.customer-results-slider');

    if (customerResultsSlider && customerResultsPrev && customerResultsNext) {
        customerResultsPrev.addEventListener('click', () => {
            customerResultsSlider.scrollBy({ left: -200, behavior: 'smooth' });
        });
        customerResultsNext.addEventListener('click', () => {
            customerResultsSlider.scrollBy({ left: 200, behavior: 'smooth' });
        });
    }

    // Concerns Slider
    const concernsPrev = document.getElementById('concerns-prev');
    const concernsNext = document.getElementById('concerns-next');
    const concernsTrackContainer = document.getElementById('concerns-track-container');

    if (concernsTrackContainer && concernsPrev && concernsNext) {
        concernsPrev.addEventListener('click', () => {
            concernsTrackContainer.scrollBy({ left: -240, behavior: 'smooth' });
        });
        concernsNext.addEventListener('click', () => {
            concernsTrackContainer.scrollBy({ left: 240, behavior: 'smooth' });
        });
    }

    // Reviews Slider
    const reviewsPrev = document.getElementById('reviews-prev');
    const reviewsNext = document.getElementById('reviews-next');
    const reviewsTrackContainer = document.getElementById('reviews-track-container');

    if (reviewsTrackContainer && reviewsPrev && reviewsNext) {
        function updateReviewsArrows() {
            const scrollLeft = reviewsTrackContainer.scrollLeft;
            const maxScroll = reviewsTrackContainer.scrollWidth - reviewsTrackContainer.clientWidth;
            
            if (scrollLeft <= 5) {
                reviewsPrev.style.background = '#f5f5f5';
                reviewsPrev.style.color = '#ccc';
                reviewsPrev.style.cursor = 'not-allowed';
            } else {
                reviewsPrev.style.background = '#fff';
                reviewsPrev.style.color = '#1a1a1a';
                reviewsPrev.style.cursor = 'pointer';
            }

            if (scrollLeft >= maxScroll - 5) {
                reviewsNext.style.background = '#f5f5f5';
                reviewsNext.style.color = '#ccc';
                reviewsNext.style.cursor = 'not-allowed';
            } else {
                reviewsNext.style.background = '#fff';
                reviewsNext.style.color = '#1a1a1a';
                reviewsNext.style.cursor = 'pointer';
            }
        }

        reviewsPrev.addEventListener('click', () => {
            const cardWidth = reviewsTrackContainer.clientWidth / 3;
            reviewsTrackContainer.scrollBy({ left: -(cardWidth + 24), behavior: 'smooth' });
        });

        reviewsNext.addEventListener('click', () => {
            const cardWidth = reviewsTrackContainer.clientWidth / 3;
            reviewsTrackContainer.scrollBy({ left: (cardWidth + 24), behavior: 'smooth' });
        });

        reviewsTrackContainer.addEventListener('scroll', updateReviewsArrows);
        updateReviewsArrows();

        reviewsPrev.addEventListener('mouseenter', () => {
            if (reviewsTrackContainer.scrollLeft > 5) {
                reviewsPrev.style.background = '#1a1a1a';
                reviewsPrev.style.color = '#fff';
            }
        });
        reviewsPrev.addEventListener('mouseleave', () => {
            if (reviewsTrackContainer.scrollLeft > 5) {
                reviewsPrev.style.background = '#fff';
                reviewsPrev.style.color = '#1a1a1a';
            }
        });

        reviewsNext.addEventListener('mouseenter', () => {
            const maxScroll = reviewsTrackContainer.scrollWidth - reviewsTrackContainer.clientWidth;
            if (reviewsTrackContainer.scrollLeft < maxScroll - 5) {
                reviewsNext.style.background = '#1a1a1a';
                reviewsNext.style.color = '#fff';
            }
        });
        reviewsNext.addEventListener('mouseleave', () => {
            const maxScroll = reviewsTrackContainer.scrollWidth - reviewsTrackContainer.clientWidth;
            if (reviewsTrackContainer.scrollLeft < maxScroll - 5) {
                reviewsNext.style.background = '#fff';
                reviewsNext.style.color = '#1a1a1a';
            }
        });
    }


    // ─────────────────────────────────────────────────────────────
    // 4. Desktop MegaMenu & Search Dropdown
    // ─────────────────────────────────────────────────────────────
    const megaDropdown = document.getElementById('megamenu-dropdown');
    const megaBackdrop = document.getElementById('megamenu-backdrop');
    const megaPanels = document.querySelectorAll('.megamenu-panel');
    const megaTriggers = document.querySelectorAll('.megamenu-trigger-wrap');
    let megaCloseTimer = null;

    // Save initial active links
    megaTriggers.forEach(trig => {
        const link = trig.querySelector('.nav-link');
        if (link && link.classList.contains('nav-link-active')) {
            link.dataset.originalActive = 'true';
        }
    });

    function openMegaMenu(menuKey) {
        if (!megaDropdown) return;
        if (megaCloseTimer) {
            clearTimeout(megaCloseTimer);
            megaCloseTimer = null;
        }

        // Close search if open
        if (searchDropdown && !searchDropdown.classList.contains('hidden')) {
            closeSearchDropdown();
        }

        megaPanels.forEach(p => {
            p.classList.add('hidden');
            p.style.display = 'none';
        });

        // Update nav-link-active highlight
        megaTriggers.forEach(trig => {
            const link = trig.querySelector('.nav-link');
            if (link) {
                if (trig.getAttribute('data-menu') === menuKey) {
                    link.classList.add('nav-link-active');
                } else if (!link.dataset.originalActive) {
                    link.classList.remove('nav-link-active');
                }
            }
        });

        const targetPanel = document.getElementById(`megamenu-panel-${menuKey}`);
        if (targetPanel) {
            targetPanel.classList.remove('hidden');
            targetPanel.style.display = 'grid';
            megaDropdown.classList.remove('hidden');
            megaDropdown.style.display = 'block';
            if (megaBackdrop) {
                megaBackdrop.classList.remove('hidden');
                megaBackdrop.style.display = 'block';
            }
        }
    }

    function closeMegaMenu() {
        if (!megaDropdown) return;
        megaDropdown.classList.add('hidden');
        megaDropdown.style.display = 'none';
        if (megaBackdrop) {
            megaBackdrop.classList.add('hidden');
            megaBackdrop.style.display = 'none';
        }
        megaPanels.forEach(p => {
            p.classList.add('hidden');
            p.style.display = 'none';
        });
        megaTriggers.forEach(trig => {
            const link = trig.querySelector('.nav-link');
            if (link && !link.dataset.originalActive) {
                link.classList.remove('nav-link-active');
            }
        });
    }

    function startMegaCloseTimer() {
        if (megaCloseTimer) clearTimeout(megaCloseTimer);
        megaCloseTimer = setTimeout(() => {
            closeMegaMenu();
        }, 250);
    }

    megaTriggers.forEach(trig => {
        const key = trig.getAttribute('data-menu');
        const triggerLink = trig.querySelector('a');

        const onTriggerEnter = () => openMegaMenu(key);

        trig.addEventListener('mouseenter', onTriggerEnter);
        trig.addEventListener('mouseover', onTriggerEnter);
        trig.addEventListener('mouseleave', startMegaCloseTimer);

        if (triggerLink) {
            triggerLink.addEventListener('mouseenter', onTriggerEnter);
            triggerLink.addEventListener('mouseover', onTriggerEnter);
            triggerLink.addEventListener('focus', onTriggerEnter);
            triggerLink.addEventListener('mouseleave', startMegaCloseTimer);
        }
    });

    if (megaDropdown) {
        megaDropdown.addEventListener('mouseenter', () => {
            if (megaCloseTimer) {
                clearTimeout(megaCloseTimer);
                megaCloseTimer = null;
            }
        });
        megaDropdown.addEventListener('mouseover', () => {
            if (megaCloseTimer) {
                clearTimeout(megaCloseTimer);
                megaCloseTimer = null;
            }
        });
        megaDropdown.addEventListener('mouseleave', startMegaCloseTimer);
    }

    if (megaBackdrop) {
        megaBackdrop.addEventListener('click', closeMegaMenu);
        megaBackdrop.addEventListener('mouseenter', closeMegaMenu);
    }

    // ── Search Dropdown Panel ──
    const searchDropdown = document.getElementById('search-dropdown-wrapper');
    const searchBackdrop = document.getElementById('search-backdrop');
    const searchTrigger = document.getElementById('search-modal-trigger');
    const mobileSearchTrigger = document.getElementById('mobile-search-trigger');
    const searchInput = document.getElementById('navbar-search-input');
    const searchClear = document.getElementById('navbar-search-clear');
    const searchDefaultContent = document.getElementById('search-default-content');
    const searchLiveResults = document.getElementById('search-live-results');
    const searchResultsList = document.getElementById('search-results-list');

    function openSearchDropdown() {
        closeMegaMenu();
        if (!searchDropdown) return;
        searchDropdown.classList.remove('hidden');
        if (searchBackdrop) searchBackdrop.classList.remove('hidden');
        if (searchInput) {
            setTimeout(() => searchInput.focus(), 80);
        }
    }

    function closeSearchDropdown() {
        if (!searchDropdown) return;
        searchDropdown.classList.add('hidden');
        if (searchBackdrop) searchBackdrop.classList.add('hidden');
    }

    if (searchTrigger) searchTrigger.addEventListener('click', (e) => {
        e.preventDefault();
        if (searchDropdown && !searchDropdown.classList.contains('hidden')) {
            closeSearchDropdown();
        } else {
            openSearchDropdown();
        }
    });

    if (mobileSearchTrigger) mobileSearchTrigger.addEventListener('click', (e) => {
        e.preventDefault();
        if (searchDropdown && !searchDropdown.classList.contains('hidden')) {
            closeSearchDropdown();
        } else {
            openSearchDropdown();
        }
    });

    if (searchBackdrop) searchBackdrop.addEventListener('click', closeSearchDropdown);

    if (searchClear && searchInput) {
        searchClear.addEventListener('click', () => {
            searchInput.value = '';
            searchClear.classList.add('hidden');
            if (searchDefaultContent) searchDefaultContent.classList.remove('hidden');
            if (searchLiveResults) searchLiveResults.classList.add('hidden');
            searchInput.focus();
        });
    }

    if (searchInput && window.RatpacCheckData && Array.isArray(window.RatpacCheckData.allProducts)) {
        const allProducts = window.RatpacCheckData.allProducts;
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.trim();
            const lower = query.toLowerCase();

            if (query.length > 0) {
                if (searchClear) searchClear.classList.remove('hidden');
            } else {
                if (searchClear) searchClear.classList.add('hidden');
            }

            if (lower.length < 2) {
                if (searchDefaultContent) searchDefaultContent.classList.remove('hidden');
                if (searchLiveResults) searchLiveResults.classList.add('hidden');
                return;
            }

            if (searchDefaultContent) searchDefaultContent.classList.add('hidden');
            if (searchLiveResults) searchLiveResults.classList.remove('hidden');

            const matches = allProducts.filter(p => {
                const nameMatch = p.name.toLowerCase().includes(lower);
                const subMatch = (p.subtitle || '').toLowerCase().includes(lower);
                const concernMatch = (p.concerns || []).some(c => c.toLowerCase().includes(lower));
                return nameMatch || subMatch || concernMatch;
            });

            if (matches.length === 0) {
                searchResultsList.innerHTML = `
                    <div class="text-center py-8">
                        <p class="text-sm text-gray-500 font-medium">No products found for "${query}"</p>
                    </div>
                `;
                return;
            }

            searchResultsList.innerHTML = matches.slice(0, 6).map(p => {
                const url = `${window.RatpacCheckData.homeUrl}product/${p.id}`;
                const img = p.image.startsWith('http') ? p.image : `${window.RatpacCheckData.themeUrl}/assets/${p.image.replace(/^\/?(assets\/)?/, '')}`;
                
                // Highlight match
                const idx = p.name.toLowerCase().indexOf(lower);
                let displayName = p.name;
                if (idx !== -1) {
                    const before = p.name.slice(0, idx);
                    const matchText = p.name.slice(idx, idx + lower.length);
                    const after = p.name.slice(idx + lower.length);
                    displayName = `${before}<span style="background-color:#FFF3D6;border-radius:2px;padding:0 1px;">${matchText}</span>${after}`;
                }

                return `
                    <a href="${url}" class="flex items-center gap-3 bg-white rounded-xl p-2.5 shadow-sm border border-gray-100 hover:bg-gray-50 active:scale-[0.98] transition-all group" style="text-decoration:none;">
                        <div class="relative h-16 w-16 flex-shrink-0 overflow-hidden rounded-lg border border-gray-100 bg-[#f5f5f5]">
                            <img src="${img}" alt="${p.name}" class="w-full h-full object-contain scale-[1.08] group-hover:scale-110 transition-transform duration-500" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="product-card-title line-clamp-1 mb-0.5 text-gray-800 font-semibold text-sm">${displayName}</h3>
                            <p class="text-[11px] font-medium text-gray-400 uppercase tracking-tight">${p.category === 'Skin' ? 'Skin Care' : 'Hair Care'}</p>
                            <span class="font-metropolis text-xs font-bold text-black">₹${p.price}</span>
                        </div>
                        <div class="pr-2 text-gray-300 group-hover:text-gray-900 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                    </a>
                `;
            }).join('');
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeMegaMenu();
            closeSearchDropdown();
            closeCart();
            closeMobileMenu();
        }
    });


    // ─────────────────────────────────────────────────────────────
    // 5. Product Detail Page Gallery, Qty & Tabs
    // ─────────────────────────────────────────────────────────────
    const mainGalleryImage = document.getElementById('main-gallery-image');
    const galleryThumbs = document.querySelectorAll('.gallery-thumb');

    galleryThumbs.forEach(thumb => {
        thumb.addEventListener('click', () => {
            galleryThumbs.forEach(t => {
                t.classList.remove('border-black');
                t.classList.add('border-gray-200');
            });
            thumb.classList.add('border-black');
            thumb.classList.remove('border-gray-200');

            if (mainGalleryImage && thumb.dataset.src) {
                mainGalleryImage.src = thumb.dataset.src;
            }
        });
    });

    const qtyMinus = document.getElementById('qty-minus');
    const qtyPlus = document.getElementById('qty-plus');
    const qtyDisplay = document.getElementById('qty-display');

    if (qtyMinus && qtyPlus && qtyDisplay) {
        qtyMinus.addEventListener('click', () => {
            let val = parseInt(qtyDisplay.textContent, 10) || 1;
            if (val > 1) {
                qtyDisplay.textContent = val - 1;
            }
        });
        qtyPlus.addEventListener('click', () => {
            let val = parseInt(qtyDisplay.textContent, 10) || 1;
            qtyDisplay.textContent = val + 1;
        });
    }

    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.dataset.tab;
            tabBtns.forEach(b => {
                b.classList.remove('text-black', 'border-black');
                b.classList.add('text-gray-400', 'border-transparent');
            });
            btn.classList.add('text-black', 'border-black');
            btn.classList.remove('text-gray-400', 'border-transparent');

            tabPanes.forEach(pane => {
                if (pane.id === targetId) {
                    pane.classList.remove('hidden');
                    pane.classList.add('block');
                } else {
                    pane.classList.add('hidden');
                    pane.classList.remove('block');
                }
            });
        });
    });


    // ─────────────────────────────────────────────────────────────
    // 6. FAQ Accordion Toggle
    // ─────────────────────────────────────────────────────────────
    const faqToggles = document.querySelectorAll('.faq-toggle');

    faqToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const content = toggle.nextElementSibling;
            const icon = toggle.querySelector('.faq-icon');
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';

            // Close all
            faqToggles.forEach(t => {
                t.setAttribute('aria-expanded', 'false');
                if (t.nextElementSibling) t.nextElementSibling.classList.add('hidden');
                const ic = t.querySelector('.faq-icon');
                if (ic) ic.classList.remove('rotate-180');
            });

            if (!isExpanded && content) {
                toggle.setAttribute('aria-expanded', 'true');
                content.classList.remove('hidden');
                if (icon) icon.classList.add('rotate-180');
            }
        });
    });


    // ─────────────────────────────────────────────────────────────
    // 7. Order Tracking Form Simulator
    // ─────────────────────────────────────────────────────────────
    const trackingForm = document.getElementById('order-tracking-form');
    const trackingResultBox = document.getElementById('tracking-result-box');

    if (trackingForm && trackingResultBox) {
        trackingForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const orderIdInput = document.getElementById('order-id-input');
            const phoneInput = document.getElementById('phone-input');

            if (!orderIdInput.value || !phoneInput.value) return;

            trackingResultBox.classList.remove('hidden');
            trackingResultBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
    }


    // ─────────────────────────────────────────────────────────────
    // 8. Dynamic Brand Tagline Alignment (100% Vercel Edge-to-Edge Match)
    // ─────────────────────────────────────────────────────────────
    function alignTaglines() {
        const pairs = [
            { brand: document.getElementById('brand-text-desktop'), tag: document.getElementById('tagline-text-desktop') },
            { brand: document.getElementById('brand-text-mobile'), tag: document.getElementById('tagline-text-mobile') }
        ];
        pairs.forEach(({ brand, tag }) => {
            if (brand && tag) {
                const brandWidth = brand.offsetWidth;
                const tagWidth = tag.offsetWidth;
                if (brandWidth && tagWidth) {
                    tag.style.transform = `scaleX(${brandWidth / tagWidth})`;
                }
            }
        });
    }

    alignTaglines();
    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(alignTaglines);
    }
    window.addEventListener('resize', alignTaglines);
    window.addEventListener('load', alignTaglines);

});

