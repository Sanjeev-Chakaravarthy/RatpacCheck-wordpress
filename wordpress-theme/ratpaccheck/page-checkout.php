<?php
/**
 * Template Name: Checkout
 * Description: Clean, luxurious, science-backed beauty checkout page.
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<section class="min-h-screen bg-[#F6F1EA] py-10 md:py-16">
    <div class="container-luxury px-4 sm:px-6 md:px-8 max-w-6xl mx-auto">
        
        <!-- Header / Breadcrumb -->
        <div class="mb-8 md:mb-10 text-center">
            <span class="font-adobe text-[11px] font-medium tracking-[0.25em] uppercase text-[#8B6B4A] block mb-2">Secure Checkout</span>
            <h1 class="font-metropolis text-2xl md:text-3xl font-bold text-[#1A1A1A]">Complete Your Order</h1>
        </div>

        <style>
            .checkout-grid-container {
                display: flex;
                flex-direction: column;
                gap: 2rem;
            }
            @media (min-width: 1024px) {
                .checkout-grid-container {
                    flex-direction: row;
                    align-items: flex-start;
                    gap: 2.5rem;
                }
                .checkout-form-col {
                    flex: 1 1 60%;
                    min-width: 0;
                }
                .checkout-summary-col {
                    flex: 0 0 38%;
                    min-width: 320px;
                    max-width: 460px;
                }
            }
        </style>

        <div class="checkout-grid-container">
            
            <!-- Left Column: Checkout Form -->
            <div class="checkout-form-col space-y-8">
                
                <!-- Contact Information -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-[#E8E3DB] shadow-sm">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="font-metropolis text-base sm:text-lg font-bold text-[#1A1A1A]">Contact Information</h2>
                        <a href="<?php echo esc_url(home_url('/track-order/')); ?>" class="font-adobe text-xs text-[#8B6B4A] hover:text-black underline">Already have an account? Log in</a>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="checkout-email" class="block font-metropolis text-xs font-semibold text-gray-700 mb-1.5">Email address or mobile phone</label>
                            <input type="text" id="checkout-email" placeholder="you@example.com or 10-digit number" class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-black transition-colors" />
                        </div>
                        <label class="flex items-center gap-2.5 cursor-pointer">
                            <input type="checkbox" checked class="w-4 h-4 rounded accent-black cursor-pointer" />
                            <span class="font-adobe text-xs text-gray-600">Email me with science-backed haircare &amp; skincare tips and exclusive offers</span>
                        </label>
                    </div>
                </div>

                <!-- Delivery Address -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-[#E8E3DB] shadow-sm">
                    <h2 class="font-metropolis text-base sm:text-lg font-bold text-[#1A1A1A] mb-5">Delivery Address</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="first-name" class="block font-metropolis text-xs font-semibold text-gray-700 mb-1.5">First name</label>
                                <input type="text" id="first-name" placeholder="Priya" class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-black transition-colors" />
                            </div>
                            <div>
                                <label for="last-name" class="block font-metropolis text-xs font-semibold text-gray-700 mb-1.5">Last name</label>
                                <input type="text" id="last-name" placeholder="Sharma" class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-black transition-colors" />
                            </div>
                        </div>
                        <div>
                            <label for="address-1" class="block font-metropolis text-xs font-semibold text-gray-700 mb-1.5">Address line 1</label>
                            <input type="text" id="address-1" placeholder="House / Flat / Block No., Street" class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-black transition-colors" />
                        </div>
                        <div>
                            <label for="address-2" class="block font-metropolis text-xs font-semibold text-gray-700 mb-1.5">Apartment, suite, landmark (optional)</label>
                            <input type="text" id="address-2" placeholder="Near City Mall, 4th Floor" class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-black transition-colors" />
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="city" class="block font-metropolis text-xs font-semibold text-gray-700 mb-1.5">City</label>
                                <input type="text" id="city" placeholder="Mumbai" class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-black transition-colors" />
                            </div>
                            <div>
                                <label for="state" class="block font-metropolis text-xs font-semibold text-gray-700 mb-1.5">State</label>
                                <input type="text" id="state" placeholder="Maharashtra" class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-black transition-colors" />
                            </div>
                            <div>
                                <label for="pincode" class="block font-metropolis text-xs font-semibold text-gray-700 mb-1.5">PIN code</label>
                                <input type="text" id="pincode" placeholder="400001" class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-black transition-colors" />
                            </div>
                        </div>
                        <div>
                            <label for="phone" class="block font-metropolis text-xs font-semibold text-gray-700 mb-1.5">Phone for delivery updates</label>
                            <input type="tel" id="phone" placeholder="+91 98765 43210" class="w-full px-4 py-3 rounded-lg border border-gray-200 text-sm focus:outline-none focus:border-black transition-colors" />
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-2xl p-6 sm:p-8 border border-[#E8E3DB] shadow-sm">
                    <h2 class="font-metropolis text-base sm:text-lg font-bold text-[#1A1A1A] mb-2">Payment Options</h2>
                    <p class="font-adobe text-xs text-gray-500 mb-5">All transactions are secure and encrypted.</p>
                    <div class="space-y-3">
                        <label class="flex items-center justify-between p-4 rounded-xl border border-black bg-[#F8F5EF] cursor-pointer">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="upi" checked class="w-4 h-4 accent-black cursor-pointer" />
                                <span class="font-metropolis text-sm font-semibold text-black">UPI / QR (Google Pay, PhonePe, Paytm)</span>
                            </div>
                            <span class="text-xs font-bold text-green-700 bg-green-100 px-2.5 py-0.5 rounded-full">Fastest</span>
                        </label>
                        <label class="flex items-center justify-between p-4 rounded-xl border border-gray-200 hover:border-gray-300 cursor-pointer transition-colors">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="card" class="w-4 h-4 accent-black cursor-pointer" />
                                <span class="font-metropolis text-sm font-medium text-black">Credit / Debit Card / NetBanking</span>
                            </div>
                            <span class="text-xs text-gray-400">Visa, MC, RuPay</span>
                        </label>
                        <label class="flex items-center justify-between p-4 rounded-xl border border-gray-200 hover:border-gray-300 cursor-pointer transition-colors">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="cod" class="w-4 h-4 accent-black cursor-pointer" />
                                <span class="font-metropolis text-sm font-medium text-black">Cash on Delivery (COD)</span>
                            </div>
                            <span class="text-xs text-gray-400">+₹49 handling</span>
                        </label>
                    </div>

                    <!-- Place Order Button -->
                    <button type="button" id="place-order-btn" class="w-full bg-black hover:bg-neutral-800 text-white font-metropolis font-bold text-sm uppercase tracking-wider py-4 rounded-xl transition-all shadow-md active:scale-98 mt-6">
                        Complete Order
                    </button>
                    <p class="text-center text-[11px] text-gray-400 font-adobe mt-3">
                        🔒 256-bit SSL encrypted. 100% safe &amp; secure checkout.
                    </p>
                </div>

            </div>

            <!-- Right Column: Order Summary -->
            <div class="checkout-summary-col bg-white rounded-2xl p-6 sm:p-8 border border-[#E8E3DB] shadow-sm sticky top-24">
                <h2 class="font-metropolis text-base sm:text-lg font-bold text-[#1A1A1A] mb-5 pb-3 border-b border-gray-100">Order Summary</h2>

                <!-- Items list from Cart -->
                <div id="checkout-items-list" class="divide-y divide-gray-100 max-h-72 overflow-y-auto mb-6 pr-1">
                    <p class="text-xs text-gray-400 text-center py-4">Loading your cart items...</p>
                </div>

                <!-- Promo Code -->
                <div class="flex gap-2 mb-6">
                    <input type="text" id="promo-code-input" placeholder="Gift card or discount code" class="flex-1 px-4 py-2.5 rounded-lg border border-gray-200 text-xs focus:outline-none focus:border-black uppercase font-metropolis" />
                    <button type="button" id="promo-apply-btn" class="px-5 py-2.5 bg-[#F5F2ED] hover:bg-black hover:text-white rounded-lg text-xs font-semibold font-metropolis text-black transition-colors">
                        Apply
                    </button>
                </div>

                <!-- Pricing Totals -->
                <div class="space-y-3 pt-4 border-t border-gray-100 font-metropolis text-sm">
                    <div class="flex items-center justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span id="checkout-subtotal" class="font-semibold text-black">₹0</span>
                    </div>
                    <div class="flex items-center justify-between text-gray-600">
                        <span>Shipping</span>
                        <span class="text-green-700 font-semibold uppercase text-xs">FREE</span>
                    </div>
                    <div class="flex items-center justify-between text-base font-bold text-black pt-3 border-t border-gray-100">
                        <span>Total</span>
                        <span id="checkout-total" class="text-lg">₹0</span>
                    </div>
                    <p class="text-[11px] text-gray-400 font-adobe">Including GST and all applicable duties.</p>
                </div>

                <!-- Trust Badges -->
                <div class="mt-8 pt-6 border-t border-gray-100 grid grid-cols-3 gap-3 text-center">
                    <div class="flex flex-col items-center">
                        <span class="text-xl mb-1">🌿</span>
                        <span class="font-metropolis text-[10px] font-semibold text-gray-600">Clean Formula</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-xl mb-1">🚚</span>
                        <span class="font-metropolis text-[10px] font-semibold text-gray-600">Fast Shipping</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="text-xl mb-1">👩‍⚕️</span>
                        <span class="font-metropolis text-[10px] font-semibold text-gray-600">Derm Tested</span>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const list = document.getElementById('checkout-items-list');
    const subtotalEl = document.getElementById('checkout-subtotal');
    const totalEl = document.getElementById('checkout-total');
    const placeOrderBtn = document.getElementById('place-order-btn');

    let cart = [];
    try {
        const saved = localStorage.getItem('ratpaccheck_cart_v1');
        if (saved) cart = JSON.parse(saved);
    } catch(e) {}

    if (!cart || cart.length === 0) {
        if (list) {
            list.innerHTML = `
                <div class="text-center py-6">
                    <p class="text-xs text-gray-500 mb-3">Your cart is empty.</p>
                    <a href="<?php echo esc_url(home_url('/products/')); ?>" class="font-metropolis text-xs font-bold underline text-black">Shop Products →</a>
                </div>
            `;
        }
        return;
    }

    let subtotal = 0;
        list.innerHTML = cart.map(item => {
            const itemTotal = (item.price || 0) * (item.quantity || 1);
            subtotal += itemTotal;
            let img = item.image || '';
            if (img && !img.startsWith('http') && !img.startsWith('/')) {
                img = '<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/' + img.replace(/^images\//, '');
            } else if (img && img.startsWith('/images/')) {
                img = '<?php echo esc_url(get_template_directory_uri()); ?>/assets' + img;
            }
            return `
                <div class="flex items-center gap-3 py-3 border-b border-gray-100 last:border-0" style="padding-top:12px;padding-bottom:12px;">
                    <div style="position:relative;width:56px;height:56px;border-radius:10px;background:#F8F5EF;flex-shrink:0;display:flex;align-items:center;justify-content:center;overflow:hidden;border:1px solid #EDE8DF;">
                        <img src="${img}" alt="${item.name}" style="width:100%;height:100%;object-fit:contain;padding:4px;" />
                        <span style="position:absolute;top:2px;right:2px;width:18px;height:18px;border-radius:50%;background:#000;color:#fff;font-size:9.5px;font-weight:700;display:flex;align-items:center;justify-content:center;">${item.quantity || 1}</span>
                    </div>
                    <div class="flex-1 min-w-0" style="flex:1;min-width:0;">
                        <h4 class="font-metropolis text-xs font-bold text-black truncate" style="font-size:12px;font-weight:700;color:#1A1A1A;margin:0 0 2px;">${item.name}</h4>
                        <p class="font-adobe text-[11px] text-gray-400" style="font-size:11px;color:#888;margin:0;">${item.subtitle || 'Standard Edition'}</p>
                    </div>
                    <span class="font-metropolis text-xs font-bold text-black" style="font-size:13px;font-weight:700;color:#1A1A1A;white-space:nowrap;">₹${itemTotal.toLocaleString()}</span>
                </div>
            `;
        }).join('');

    if (subtotalEl) subtotalEl.textContent = '₹' + subtotal.toLocaleString();
    if (totalEl) totalEl.textContent = '₹' + subtotal.toLocaleString();

    if (placeOrderBtn) {
        placeOrderBtn.addEventListener('click', function() {
            alert('🎉 Thank you for your order! Your science-backed beauty essentials are being prepared.');
            try {
                localStorage.removeItem('ratpaccheck_cart_v1');
            } catch(e) {}
            window.location.href = '<?php echo esc_url(home_url('/')); ?>';
        });
    }
});
</script>

<?php
get_footer();
