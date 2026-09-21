<?php
/**
 * Template Name: Customer Help & FAQs
 * Description: Customer support channels, FAQs with 2-col accordion layout — Matching Vercel 1:1.
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$faqs_left = array(
    array(
        'q' => 'How long does delivery take?',
        'a' => 'Standard delivery takes 5–7 business days across India. Express delivery (2–3 days) is available in select cities. You&apos;ll receive a tracking link once your order is dispatched.',
    ),
    array(
        'q' => 'What is your return policy?',
        'a' => 'We offer a 30-day hassle-free return guarantee. If a formulation does not work for you or arrives damaged, contact our support team and we will arrange a reverse pickup with a 100% refund.',
    ),
    array(
        'q' => 'Are your products dermatologist tested?',
        'a' => 'Yes. Every single RatpacCheck formula is clinically tested and dermatologist-approved. We publish our clinical trial and ingredient data on each product page for full consumer transparency.',
    ),
    array(
        'q' => 'Can I use multiple products together?',
        'a' => 'Absolutely! Our formulas are pH-balanced to complement one another. For example, our Hydrating Face Cleanser pairs seamlessly with the Deep Glow Face Serum followed by your favorite moisturiser.',
    ),
);

$faqs_right = array(
    array(
        'q' => 'Do you ship internationally?',
        'a' => 'Currently we ship across all PIN codes in India. International shipping to North America, UAE, and Europe is currently in development — join our newsletter to get notified on launch.',
    ),
    array(
        'q' => 'How do I track my order?',
        'a' => 'Visit our Track Order page and enter your 6-digit Order ID along with your phone number. You will see real-time updates directly from our courier partners.',
    ),
    array(
        'q' => 'Are gifts and subscription boxes available?',
        'a' => 'We are working on curated gift sets and subscription boxes. Join our mailing list to be the first to know when they launch.',
    ),
    array(
        'q' => 'What payment methods do you accept?',
        'a' => 'We support all major payment options: UPI (Google Pay, PhonePe, Paytm), Credit & Debit Cards (Visa, Mastercard, RuPay), Net Banking, and Cash on Delivery (COD) for orders above ₹499.',
    ),
);
?>

<div style="min-height:100vh;background-color:#F6F1EA;padding-top:112px;padding-bottom:80px;">
    <!-- Header -->
    <div style="text-align:center;padding:0 24px;margin-bottom:64px;">
        <div style="display:flex;align-items:center;justify-content:center;gap:12px;margin-bottom:12px;">
            <div style="width:40px;height:1px;background-color:#C9A84C;"></div>
            <span style="font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:12px;letter-spacing:0.25em;color:#8B6B4A;text-transform:uppercase;">Support</span>
            <div style="width:40px;height:1px;background-color:#C9A84C;"></div>
        </div>
        <h1 style="font-family:Metropolis,-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:clamp(36px,5vw,60px);font-weight:700;margin-bottom:16px;color:#000;line-height:1.1;">
            How Can We Help?
        </h1>
        <p style="font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:16px;color:#8B6B4A;max-width:448px;margin:0 auto;">
            Find answers to the most common questions. Still stuck? We're just a message away.
        </p>

        <!-- Contact Pills -->
        <div style="display:flex;flex-wrap:wrap;justify-content:center;gap:12px;margin-top:28px;">
            <a href="mailto:hello@ratpaccheck.com" style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#fff;border:1px solid #E8E3DB;border-radius:9999px;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:14px;color:#1A1A1A;text-decoration:none;box-shadow:0 1px 4px rgba(0,0,0,0.06);transition:all 0.3s;">
                <span style="font-weight:500;">Email Us:</span>
                <span style="color:#8B6B4A;">hello@ratpaccheck.com</span>
            </a>
            <a href="tel:+917382176403" style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#fff;border:1px solid #E8E3DB;border-radius:9999px;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:14px;color:#1A1A1A;text-decoration:none;box-shadow:0 1px 4px rgba(0,0,0,0.06);transition:all 0.3s;">
                <span style="font-weight:500;">Call Us:</span>
                <span style="color:#8B6B4A;">+91 73821 76403</span>
            </a>
            <a href="https://wa.me/917382176403" target="_blank" rel="noopener noreferrer" style="display:inline-flex;align-items:center;gap:8px;padding:10px 20px;background:#fff;border:1px solid #E8E3DB;border-radius:9999px;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:14px;color:#1A1A1A;text-decoration:none;box-shadow:0 1px 4px rgba(0,0,0,0.06);transition:all 0.3s;">
                <span style="font-weight:500;">WhatsApp:</span>
                <span style="color:#8B6B4A;">Chat Now</span>
            </a>
        </div>
    </div>

    <!-- FAQ Section - 2 Column Cards -->
    <div style="max-width:1024px;margin:0 auto;padding:0 24px;">
        <div style="display:grid;grid-template-columns:1fr;gap:32px;" class="faq-grid">

            <!-- Left FAQ Card -->
            <div style="background:#fff;border-radius:16px;box-shadow:0 1px 4px rgba(0,0,0,0.06);border:1px solid #E8E3DB;padding:28px;">
                <?php foreach ($faqs_left as $i => $faq) : ?>
                    <div style="border-bottom:1px solid #E8E3DB;<?php echo ($i === count($faqs_left) - 1) ? 'border-bottom:none;' : ''; ?>">
                        <button type="button" class="faq-toggle" style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:20px 0;text-align:left;background:none;border:none;cursor:pointer;">
                            <span style="font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:14px;font-weight:600;color:#1A1A1A;padding-right:16px;transition:color 0.2s;">
                                <?php echo esc_html($faq['q']); ?>
                            </span>
                            <span style="flex-shrink:0;color:#8B6B4A;transition:transform 0.3s;">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"></path></svg>
                            </span>
                        </button>
                        <div class="faq-content" style="overflow:hidden;height:0;opacity:0;transition:all 0.3s ease;">
                            <p style="font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:14px;color:#8B6B4A;line-height:1.7;padding-bottom:20px;">
                                <?php echo esc_html($faq['a']); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Right FAQ Card -->
            <div style="background:#fff;border-radius:16px;box-shadow:0 1px 4px rgba(0,0,0,0.06);border:1px solid #E8E3DB;padding:28px;">
                <?php foreach ($faqs_right as $i => $faq) : ?>
                    <div style="border-bottom:1px solid #E8E3DB;<?php echo ($i === count($faqs_right) - 1) ? 'border-bottom:none;' : ''; ?>">
                        <button type="button" class="faq-toggle" style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:20px 0;text-align:left;background:none;border:none;cursor:pointer;">
                            <span style="font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:14px;font-weight:600;color:#1A1A1A;padding-right:16px;transition:color 0.2s;">
                                <?php echo esc_html($faq['q']); ?>
                            </span>
                            <span style="flex-shrink:0;color:#8B6B4A;transition:transform 0.3s;">
                                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"></path></svg>
                            </span>
                        </button>
                        <div class="faq-content" style="overflow:hidden;height:0;opacity:0;transition:all 0.3s ease;">
                            <p style="font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:14px;color:#8B6B4A;line-height:1.7;padding-bottom:20px;">
                                <?php echo esc_html($faq['a']); ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- Still Need Help CTA -->
        <div style="text-align:center;margin-top:56px;padding:40px;background-color:#1A1A1A;border-radius:16px;">
            <p style="font-family:Metropolis,-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:24px;font-weight:600;color:#F6F1EA;margin-bottom:8px;">
                Still Need Help?
            </p>
            <p style="font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:14px;color:rgba(246,241,234,0.6);margin-bottom:24px;">
                Our team responds within 2 business hours.
            </p>
            <a href="mailto:hello@ratpaccheck.com" style="display:inline-block;padding:12px 32px;background-color:#C9A84C;color:#1A1A1A;border-radius:8px;font-family:Metropolis,-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;font-size:14px;font-weight:600;text-decoration:none;transition:background-color 0.2s;">
                Contact Support
            </a>
        </div>
    </div>
</div>

<style>
@media (min-width: 768px) {
    .faq-grid {
        grid-template-columns: 1fr 1fr !important;
        gap: 32px 48px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.faq-toggle').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var content = this.nextElementSibling;
            var chevron = this.querySelector('span:last-child');
            if (!content || !content.classList.contains('faq-content')) return;

            var isOpen = content.style.height !== '0px' && content.style.height !== '';

            // Close all
            document.querySelectorAll('.faq-content').forEach(function(c) {
                c.style.height = '0px';
                c.style.opacity = '0';
            });
            document.querySelectorAll('.faq-toggle span:last-child').forEach(function(s) {
                s.style.transform = 'rotate(0deg)';
            });

            if (!isOpen) {
                content.style.height = 'auto';
                content.style.opacity = '1';
                chevron.style.transform = 'rotate(180deg)';
            }
        });
    });
});
</script>

<?php
get_footer();
