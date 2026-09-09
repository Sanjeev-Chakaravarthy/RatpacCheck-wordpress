<?php
/**
 * Template Name: Track Order
 * Description: Order tracking with tabbed lookup form — Matching Vercel 1:1.
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<section style="background-color:#F6F1EA;padding-top:60px;padding-bottom:60px;padding-left:24px;padding-right:24px;">
    <div style="max-width:520px;margin:0 auto;">
        <!-- Header -->
        <div style="text-align:center;margin-bottom:32px;">
            <div style="display:flex;align-items:center;justify-content:center;gap:12px;margin-bottom:12px;">
                <span style="font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:11px;font-weight:600;letter-spacing:0.22em;color:#8B6B4A;text-transform:uppercase;">
                    Order Status
                </span>
            </div>
            <h1 style="font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:34px;font-weight:600;color:#1A1A1A;line-height:1.15;margin-bottom:10px;">
                Track Your Order
            </h1>
            <p style="font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:15px;color:#6b6b6b;line-height:1.6;">
                Enter your order details to see real-time delivery updates.
            </p>
        </div>

        <!-- Tabbed Lookup Card -->
        <div style="background:#FFFFFF;border-radius:18px;box-shadow:0 6px 20px rgba(0,0,0,0.08);overflow:hidden;">
            <!-- Tab Bar -->
            <div style="display:flex;justify-content:center;gap:40px;border-bottom:1px solid #F0EDE8;padding-left:32px;padding-right:32px;">
                <button type="button" id="tab-order-details" class="track-tab active" style="position:relative;padding:14px 0;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:14px;font-weight:600;color:#1A1A1A;background:none;border:none;cursor:pointer;letter-spacing:0.02em;white-space:nowrap;transition:color 0.2s ease;">
                    Order Details
                    <span class="track-tab-indicator" style="position:absolute;bottom:-1px;left:50%;transform:translateX(-50%);width:80%;height:2px;background-color:#3b1d0f;border-radius:2px;transition:width 0.25s ease;display:block;"></span>
                </button>
                <button type="button" id="tab-tracking-number" class="track-tab" style="position:relative;padding:14px 0;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:14px;font-weight:500;color:#8B8178;background:none;border:none;cursor:pointer;letter-spacing:0.02em;white-space:nowrap;transition:color 0.2s ease;">
                    Tracking Number
                    <span class="track-tab-indicator" style="position:absolute;bottom:-1px;left:50%;transform:translateX(-50%);width:0%;height:2px;background-color:#3b1d0f;border-radius:2px;transition:width 0.25s ease;display:block;"></span>
                </button>
            </div>

            <!-- Tab Content: Order Details -->
            <div id="pane-order-details" style="padding:20px 28px 28px;">
                <form>
                    <div style="margin-bottom:16px;">
                        <label style="display:block;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:12px;font-weight:600;color:#1A1A1A;letter-spacing:0.08em;text-transform:uppercase;margin-bottom:8px;">
                            Order ID
                        </label>
                        <div style="position:relative;">
                            <svg style="position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#AAAAAA;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z"></path>
                                <path d="M12 22V12"></path>
                                <polyline points="3.29 7 12 12 20.71 7"></polyline>
                                <path d="m7.5 4.27 9 5.15"></path>
                            </svg>
                            <input id="order-id" type="text" placeholder="e.g. RPC-2026-00123" style="width:100%;height:52px;border-radius:12px;border:1px solid #e8e8e8;font-size:15px;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;color:#1A1A1A;background-color:#fafafa;outline:none;box-sizing:border-box;transition:border-color 0.2s ease,background-color 0.2s ease;padding-left:44px;padding-right:16px;" />
                        </div>
                    </div>
                    <div style="margin-bottom:16px;">
                        <label style="display:block;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:12px;font-weight:600;color:#1A1A1A;letter-spacing:0.08em;text-transform:uppercase;margin-bottom:8px;">
                            Order Email
                        </label>
                        <input id="order-email" type="email" placeholder="your@email.com" style="width:100%;height:52px;border-radius:12px;border:1px solid #e8e8e8;font-size:15px;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;color:#1A1A1A;background-color:#fafafa;outline:none;box-sizing:border-box;transition:border-color 0.2s ease,background-color 0.2s ease;padding-left:16px;padding-right:16px;" />
                    </div>
                    <button id="track-button" type="submit" style="width:100%;height:54px;border-radius:28px;background:linear-gradient(135deg,#4a2413,#2b1208);color:#FFFFFF;border:none;cursor:pointer;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:16px;font-weight:500;letter-spacing:0.04em;display:flex;align-items:center;justify-content:center;gap:10px;transition:all 0.2s ease;box-shadow:0 2px 8px rgba(0,0,0,0.10);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21 21-4.34-4.34"></path>
                            <circle cx="11" cy="11" r="8"></circle>
                        </svg>
                        Track Order
                    </button>
                </form>
            </div>

            <!-- Tab Content: Tracking Number (hidden by default) -->
            <div id="pane-tracking-number" style="padding:20px 28px 28px;display:none;">
                <form>
                    <div style="margin-bottom:16px;">
                        <label style="display:block;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:12px;font-weight:600;color:#1A1A1A;letter-spacing:0.08em;text-transform:uppercase;margin-bottom:8px;">
                            Tracking Number
                        </label>
                        <input id="tracking-number-input" type="text" placeholder="e.g. BD123456789IN" style="width:100%;height:52px;border-radius:12px;border:1px solid #e8e8e8;font-size:15px;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;color:#1A1A1A;background-color:#fafafa;outline:none;box-sizing:border-box;transition:border-color 0.2s ease,background-color 0.2s ease;padding-left:16px;padding-right:16px;" />
                    </div>
                    <button type="submit" style="width:100%;height:54px;border-radius:28px;background:linear-gradient(135deg,#4a2413,#2b1208);color:#FFFFFF;border:none;cursor:pointer;font-family:'Adobe Hebrew','Noto Serif',Georgia,serif;font-size:16px;font-weight:500;letter-spacing:0.04em;display:flex;align-items:center;justify-content:center;gap:10px;transition:all 0.2s ease;box-shadow:0 2px 8px rgba(0,0,0,0.10);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m21 21-4.34-4.34"></path>
                            <circle cx="11" cy="11" r="8"></circle>
                        </svg>
                        Track Shipment
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var tabs = document.querySelectorAll('.track-tab');
    var panes = {
        'tab-order-details': document.getElementById('pane-order-details'),
        'tab-tracking-number': document.getElementById('pane-tracking-number')
    };
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            tabs.forEach(function(t) {
                t.style.fontWeight = '500';
                t.style.color = '#8B8178';
                t.querySelector('.track-tab-indicator').style.width = '0%';
            });
            this.style.fontWeight = '600';
            this.style.color = '#1A1A1A';
            this.querySelector('.track-tab-indicator').style.width = '80%';
            Object.values(panes).forEach(function(p) { if(p) p.style.display = 'none'; });
            var target = panes[this.id];
            if (target) target.style.display = 'block';
        });
    });
});
</script>

<?php
get_footer();
