<?php
/**
 * Template Name: About Us
 * Description: About Us & Brand Heritage — 100% Parity with Vercel.
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main style="background-color: #F8F5EF; min-height: 100vh; overflow: hidden;">

    <!-- ═══════════════════════════════════════════
        SECTION 1: HERO STORY
        ═══════════════════════════════════════════ -->
    <section
        style="position: relative; min-height: 92vh; display: flex; align-items: center; justify-content: center; overflow: hidden; background: linear-gradient(180deg, #F8F5EF 0%, #EDE8DF 60%, #E5DDD2 100%);"
    >
        <!-- Floating abstract shapes -->
        <div style="position: absolute; top: 10%; right: 8%; width: 320px; height: 320px; border-radius: 50%; background: radial-gradient(circle, rgba(201,168,76,0.08) 0%, transparent 70%); filter: blur(40px); pointer-events: none;"></div>
        <div style="position: absolute; bottom: 15%; left: 5%; width: 260px; height: 260px; border-radius: 50%; background: radial-gradient(circle, rgba(139,107,74,0.06) 0%, transparent 70%); filter: blur(50px); pointer-events: none;"></div>

        <div style="max-width: 1280px; margin: 0 auto; padding: 120px 40px 80px; display: grid; grid-template-columns: 1fr 1fr; gap: 64px; align-items: center; width: 100%;" class="about-hero-grid">
            
            <!-- Left — Text -->
            <div>
                <!-- Gold Divider -->
                <div style="display: flex; align-items: center; justify-content: flex-start; gap: 14px; margin-bottom: 24px;">
                    <div style="width: 48px; height: 1px; background: linear-gradient(90deg, transparent, #C9A84C);"></div>
                    <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 10px; font-weight: 600; letter-spacing: 0.3em; color: #8B6B4A; text-transform: uppercase;">
                        Our Story
                    </span>
                    <div style="width: 48px; height: 1px; background: linear-gradient(90deg, #C9A84C, transparent);"></div>
                </div>

                <h1 style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: clamp(40px, 5vw, 72px); font-weight: 700; color: #2C1810; lineHeight: 1.08; margin-bottom: 28px; letter-spacing: -0.02em;">
                    We Care About<br />Your <span style="color: #8B6B4A; font-weight: 700; position: relative;">Skin & Hair<svg style="position: absolute; bottom: -6px; left: 0; width: 100%; height: 8px;" viewBox="0 0 200 8" preserveAspectRatio="none"><path d="M0 6 Q50 0, 100 4 Q150 8, 200 2" stroke="#C9A84C" stroke-width="1.5" fill="none" opacity="0.5"></path></svg></span><span style="font-size: clamp(40px, 5vw, 72px);">.</span>
                </h1>

                <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 17px; color: #7C5C3E; line-height: 1.85; max-width: 480px; margin-bottom: 40px;">
                    Born from a simple frustration — the haircare aisle was full of pretty packaging but empty promises. As creators trusted by millions, we had a responsibility to build something real.
                </p>

                <div style="display: flex; gap: 16px; flex-wrap: wrap;">
                    <a href="#our-story" class="about-cta-primary" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 32px; background-color: #2C1810; color: #F8F5EF; border-radius: 999px; font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 13px; font-weight: 600; text-decoration: none; letter-spacing: 0.06em; transition: all 0.4s cubic-bezier(0.25,0.1,0.25,1); box-shadow: 0 4px 20px rgba(44,24,16,0.15);">
                        Discover Our Journey 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Right — Lifestyle Image with Badge -->
            <div style="position: relative;">
                <div style="border-radius: 24px; overflow: hidden; box-shadow: 0 24px 60px rgba(44,24,16,0.12); position: relative; aspect-ratio: 4/5;">
                    <img src="<?php echo esc_url(ratpaccheck_img_url('skin-care.jpeg')); ?>" alt="Premium skincare — glowing healthy skin" style="position: absolute; height: 100%; width: 100%; inset: 0; object-fit: cover; object-position: center 20%;" />
                    <div style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 60%, rgba(44,24,16,0.08) 100%); border-radius: 24px;"></div>
                </div>

                <!-- Floating accent badge -->
                <div style="position: absolute; bottom: 32px; left: -24px; background: rgba(248,245,239,0.92); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border-radius: 20px; border: 1px solid rgba(201,168,76,0.25); padding: 20px 24px; box-shadow: 0 8px 32px rgba(44,24,16,0.1); display: flex; align-items: center; gap: 14px; z-index: 2;">
                    <div style="width: 48px; height: 48px; border-radius: 14px; background-color: #2C1810; display: flex; align-items: center; justify-content: center;">
                        <svg class="w-5 h-5 text-[#C9A84C]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l2.4 7.2h7.6l-6.2 4.5 2.4 7.3-6.2-4.5-6.2 4.5 2.4-7.3-6.2-4.5h7.6z"/></svg>
                    </div>
                    <div>
                        <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 22px; font-weight: 700; color: #2C1810; line-height: 1; margin: 0;">94%</p>
                        <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 11px; color: #8B6B4A; letter-spacing: 0.05em; margin-top: 2px; margin-bottom: 0;">Saw results in 4 weeks</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ═══════════════════════════════════════════
        SECTION 2: FOUNDER / BRAND STORY
        ═══════════════════════════════════════════ -->
    <section id="our-story" style="background-color: #FFFFFF; padding: 120px 40px;">
        <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1.1fr; gap: 80px; align-items: center;" class="about-founder-grid">
            
            <!-- Left — Image -->
            <div>
                <div style="position: relative; border-radius: 24px; overflow: hidden; aspect-ratio: 3/4; box-shadow: 0 20px 50px rgba(44,24,16,0.1);">
                    <img src="<?php echo esc_url(ratpaccheck_img_url('hair-care.jpg')); ?>" alt="RatpacCheck — our journey" style="position: absolute; height: 100%; width: 100%; inset: 0; object-fit: cover; object-position: center 15%;" />
                    <div style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 50%, rgba(44,24,16,0.1) 100%);"></div>
                </div>
                <!-- Accent line below image -->
                <div style="width: 60px; height: 3px; background: linear-gradient(90deg, #C9A84C, #D4B86A); border-radius: 2px; margin: 24px auto 0;"></div>
            </div>

            <!-- Right — Editorial story text -->
            <div>
                <div style="display: flex; align-items: center; justify-content: flex-start; gap: 14px; margin-bottom: 24px;">
                    <div style="width: 48px; height: 1px; background: linear-gradient(90deg, transparent, #C9A84C);"></div>
                    <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 10px; font-weight: 600; letter-spacing: 0.3em; color: #8B6B4A; text-transform: uppercase;">
                        The Beginning
                    </span>
                    <div style="width: 48px; height: 1px; background: linear-gradient(90deg, #C9A84C, transparent);"></div>
                </div>

                <blockquote style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: clamp(26px, 3vw, 38px); font-weight: 600; color: #2C1810; line-height: 1.35; font-style: italic; margin-bottom: 32px; position: relative; padding-left: 24px; border-left: 3px solid #C9A84C;">
                    &ldquo;We didn&apos;t set out to start a brand — we set out to fix a broken industry.&rdquo;
                </blockquote>

                <div style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 15px; color: #7C5C3E; line-height: 1.9; display: flex; flex-direction: column; gap: 20px;">
                    <p>
                        As creators with millions of followers asking us for recommendations, we realized something uncomfortable — we couldn&apos;t, in good conscience, recommend most products on the market. The science was thin. The claims were hollow. The prices were unjust.
                    </p>
                    <p>
                        So we went to the labs ourselves. We partnered with certified trichologists and cosmetic chemists. We developed formulas from scratch, tested rigorously, and refused to launch until the clinical data convinced us first.
                    </p>
                    <p style="color: #2C1810; font-weight: 500;">
                        RatpacCheck isn&apos;t just a brand — it&apos;s our promise that you deserve better.
                    </p>
                </div>

                <!-- Signature element -->
                <div style="margin-top: 40px; display: flex; align-items: center; gap: 16px;">
                    <div style="width: 48px; height: 48px; border-radius: 50%; background-color: #EDE8DF; display: flex; align-items: center; justify-content: center;">
                        <svg class="w-5 h-5 text-[#8B6B4A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div>
                        <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 16px; font-weight: 600; color: #2C1810; font-style: italic; margin: 0;">
                            The RatpacCheck Team
                        </p>
                        <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 12px; color: #8B6B4A; letter-spacing: 0.08em; margin: 0;">
                            Founders &amp; Creators
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- ═══════════════════════════════════════════
        SECTION 3: CORE VALUES — PREMIUM PANELS
        ═══════════════════════════════════════════ -->
    <section style="background: linear-gradient(180deg, #F8F5EF 0%, #F2ECE3 100%); padding: 120px 40px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            
            <div style="text-align: center; margin-bottom: 72px;">
                <div style="display: flex; align-items: center; justify-content: center; gap: 14px; margin-bottom: 24px;">
                    <div style="width: 48px; height: 1px; background: linear-gradient(90deg, transparent, #C9A84C);"></div>
                    <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 10px; font-weight: 600; letter-spacing: 0.3em; color: #8B6B4A; text-transform: uppercase;">
                        Our Values
                    </span>
                    <div style="width: 48px; height: 1px; background: linear-gradient(90deg, #C9A84C, transparent);"></div>
                </div>
                <h2 style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: clamp(32px, 3.5vw, 48px); font-weight: 700; color: #2C1810; line-height: 1.15; margin-bottom: 16px;">
                    What We Stand For
                </h2>
                <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 16px; color: #7C5C3E; max-width: 500px; margin: 0 auto; line-height: 1.7;">
                    Every product reflects three non-negotiable commitments that define everything we create.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px;" class="about-values-grid">
                
                <!-- Value 1: Chemical Free -->
                <div class="about-value-card" style="background: linear-gradient(135deg, rgba(138,155,110,0.08) 0%, rgba(138,155,110,0.02) 100%); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-radius: 24px; border: 1px solid rgba(216,208,197,0.6); padding: 48px 36px; height: 100%; display: flex; flex-direction: column; gap: 24px; transition: all 0.4s cubic-bezier(0.25,0.1,0.25,1); cursor: default;">
                    <div style="width: 64px; height: 64px; border-radius: 20px; background-color: #fff; box-shadow: 0 4px 16px rgba(44,24,16,0.06); display: flex; align-items: center; justify-content: center;">
                        <svg class="w-7 h-7 text-[#8A9B6E]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 0 1-9-9c0-4.97 4.03-9 9-9 4.97 0 9 4.03 9 9 0 4.97-4.03 9-9 9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18"/></svg>
                    </div>
                    <h3 style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 26px; font-weight: 700; color: #2C1810; line-height: 1.2; margin: 0;">
                        Chemical Free
                    </h3>
                    <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 14px; color: #7C5C3E; line-height: 1.8; flex: 1; margin: 0;">
                        No sulphates, no parabens, no harmful additives. Every formula is built from clinically-safe, skin-friendly ingredients you can trust.
                    </p>
                    <div style="width: 40px; height: 2px; background-color: #8A9B6E; border-radius: 1px; opacity: 0.5;"></div>
                </div>

                <!-- Value 2: Affordable -->
                <div class="about-value-card" style="background: linear-gradient(135deg, rgba(201,168,76,0.08) 0%, rgba(201,168,76,0.02) 100%); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-radius: 24px; border: 1px solid rgba(216,208,197,0.6); padding: 48px 36px; height: 100%; display: flex; flex-direction: column; gap: 24px; transition: all 0.4s cubic-bezier(0.25,0.1,0.25,1); cursor: default;">
                    <div style="width: 64px; height: 64px; border-radius: 20px; background-color: #fff; box-shadow: 0 4px 16px rgba(44,24,16,0.06); display: flex; align-items: center; justify-content: center;">
                        <svg class="w-7 h-7 text-[#C9A84C]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 26px; font-weight: 700; color: #2C1810; line-height: 1.2; margin: 0;">
                        Affordable
                    </h3>
                    <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 14px; color: #7C5C3E; line-height: 1.8; flex: 1; margin: 0;">
                        Premium quality shouldn&apos;t come at a premium price. We cut middlemen and deliver lab-grade care at honest prices — never inflated.
                    </p>
                    <div style="width: 40px; height: 2px; background-color: #C9A84C; border-radius: 1px; opacity: 0.5;"></div>
                </div>

                <!-- Value 3: Clinically Tested -->
                <div class="about-value-card" style="background: linear-gradient(135deg, rgba(139,107,74,0.08) 0%, rgba(139,107,74,0.02) 100%); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-radius: 24px; border: 1px solid rgba(216,208,197,0.6); padding: 48px 36px; height: 100%; display: flex; flex-direction: column; gap: 24px; transition: all 0.4s cubic-bezier(0.25,0.1,0.25,1); cursor: default;">
                    <div style="width: 64px; height: 64px; border-radius: 20px; background-color: #fff; box-shadow: 0 4px 16px rgba(44,24,16,0.06); display: flex; align-items: center; justify-content: center;">
                        <svg class="w-7 h-7 text-[#8B6B4A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                    </div>
                    <h3 style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 26px; font-weight: 700; color: #2C1810; line-height: 1.2; margin: 0;">
                        Clinically Tested
                    </h3>
                    <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 14px; color: #7C5C3E; line-height: 1.8; flex: 1; margin: 0;">
                        94% of users saw measurable results within 4 weeks. Every product undergoes rigorous in-vitro and clinical testing before launch.
                    </p>
                    <div style="width: 40px; height: 2px; background-color: #8B6B4A; border-radius: 1px; opacity: 0.5;"></div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
        SECTION 4: BACKED BY SCIENCE
        ═══════════════════════════════════════════ -->
    <section style="background-color: #EDE8DF; padding: 120px 40px; position: relative; overflow: hidden;">
        <div style="position: absolute; top: 20%; right: -5%; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(201,168,76,0.05) 0%, transparent 70%); filter: blur(60px); pointer-events: none;"></div>

        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center;" class="about-science-grid">
                
                <!-- Left — Content -->
                <div>
                    <div style="display: flex; align-items: center; justify-content: flex-start; gap: 14px; margin-bottom: 24px;">
                        <div style="width: 48px; height: 1px; background: linear-gradient(90deg, transparent, #C9A84C);"></div>
                        <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 10px; font-weight: 600; letter-spacing: 0.3em; color: #8B6B4A; text-transform: uppercase;">
                            The Science
                        </span>
                        <div style="width: 48px; height: 1px; background: linear-gradient(90deg, #C9A84C, transparent);"></div>
                    </div>

                    <h2 style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: clamp(30px, 3.5vw, 44px); font-weight: 700; color: #2C1810; line-height: 1.2; margin-bottom: 24px;">
                        Backed by Research,<br /><span style="color: #8B6B4A; font-style: italic;">Proven by Results</span>
                    </h2>

                    <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 15px; color: #7C5C3E; line-height: 1.85; margin-bottom: 48px; max-width: 460px;">
                        Every formula is co-developed with certified trichologists and cosmetic chemists. We don&apos;t launch until clinical trials and real-world testing confirm measurable results.
                    </p>

                    <!-- Stat Counters -->
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 32px;" class="about-stats-grid">
                        <div style="padding: 24px; background-color: rgba(248,245,239,0.7); border-radius: 20px; border: 1px solid rgba(216,208,197,0.5);">
                            <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 36px; font-weight: 700; color: #2C1810; line-height: 1; margin: 0;">94%</p>
                            <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 12px; color: #8B6B4A; letter-spacing: 0.06em; margin-top: 6px; margin-bottom: 0; text-transform: uppercase;">Saw visible results</p>
                        </div>
                        <div style="padding: 24px; background-color: rgba(248,245,239,0.7); border-radius: 20px; border: 1px solid rgba(216,208,197,0.5);">
                            <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 36px; font-weight: 700; color: #2C1810; line-height: 1; margin: 0;">18+</p>
                            <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 12px; color: #8B6B4A; letter-spacing: 0.06em; margin-top: 6px; margin-bottom: 0; text-transform: uppercase;">Active ingredients</p>
                        </div>
                        <div style="padding: 24px; background-color: rgba(248,245,239,0.7); border-radius: 20px; border: 1px solid rgba(216,208,197,0.5);">
                            <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 36px; font-weight: 700; color: #2C1810; line-height: 1; margin: 0;">12+</p>
                            <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 12px; color: #8B6B4A; letter-spacing: 0.06em; margin-top: 6px; margin-bottom: 0; text-transform: uppercase;">Months of testing</p>
                        </div>
                        <div style="padding: 24px; background-color: rgba(248,245,239,0.7); border-radius: 20px; border: 1px solid rgba(216,208,197,0.5);">
                            <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 36px; font-weight: 700; color: #2C1810; line-height: 1; margin: 0;">50K+</p>
                            <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 12px; color: #8B6B4A; letter-spacing: 0.06em; margin-top: 6px; margin-bottom: 0; text-transform: uppercase;">Happy customers</p>
                        </div>
                    </div>
                </div>

                <!-- Right — Lab Image -->
                <div>
                    <div style="position: relative; border-radius: 24px; overflow: hidden; aspect-ratio: 1; box-shadow: 0 20px 50px rgba(44,24,16,0.1);">
                        <img src="<?php echo esc_url(ratpaccheck_img_url('hero-1.png')); ?>" alt="RatpacCheck laboratory — science-backed formulations" style="position: absolute; height: 100%; width: 100%; inset: 0; object-fit: cover;" />
                        <div style="position: absolute; inset: 0; background: linear-gradient(180deg, transparent 40%, rgba(44,24,16,0.12) 100%); border-radius: 24px;"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
        SECTION 5: SOCIAL PROOF / TRUST
        ═══════════════════════════════════════════ -->
    <section style="background: linear-gradient(180deg, #F8F5EF 0%, #F2ECE3 50%, #F8F5EF 100%); padding: 120px 40px;">
        <div style="max-width: 900px; margin: 0 auto; text-align: center;">
            <div style="margin-bottom: 48px;">
                <div style="display: inline-flex; align-items: center; justify-content: center; width: 72px; height: 72px; border-radius: 50%; background-color: #EDE8DF; margin-bottom: 24px;">
                    <svg class="w-8 h-8 text-[#8B6B4A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>

                <h2 style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: clamp(56px, 8vw, 96px); font-weight: 700; color: #2C1810; line-height: 1; margin-bottom: 8px;">
                    1M<span style="color: #C9A84C;">+</span>
                </h2>
                <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 15px; color: #8B6B4A; letter-spacing: 0.12em; text-transform: uppercase; font-weight: 500; margin: 0;">
                    Customers Trust RatpacCheck
                </p>
            </div>

            <!-- Testimonial -->
            <div style="background-color: #fff; border-radius: 24px; padding: 48px 44px; box-shadow: 0 8px 32px rgba(44,24,16,0.06); border: 1px solid rgba(216,208,197,0.4); max-width: 680px; margin: 0 auto; position: relative;">
                <div style="position: absolute; top: 24px; left: 36px; font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 72px; color: #C9A84C; line-height: 1; opacity: 0.2;">
                    &ldquo;
                </div>

                <blockquote style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 20px; font-weight: 500; color: #2C1810; line-height: 1.6; font-style: italic; margin-bottom: 24px; position: relative; z-index: 1;">
                    I&apos;ve tried every expensive brand out there — nothing worked like RatpacCheck. My hair feels healthier, my scalp feels clean, and I never thought I&apos;d find something this effective at this price.
                </blockquote>

                <div style="display: flex; align-items: center; justify-content: center; gap: 12px;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background-color: #EDE8DF; display: flex; align-items: center; justify-content: center;">
                        <svg class="w-5 h-5 text-[#8B6B4A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <div style="text-align: left;">
                        <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 14px; font-weight: 600; color: #2C1810; margin: 0;">Priya Sharma</p>
                        <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 12px; color: #8B6B4A; margin: 0;">Verified Customer — Mumbai</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
        SECTION 6: FINAL CTA
        ═══════════════════════════════════════════ -->
    <section style="background: linear-gradient(135deg, #2C1810 0%, #3D2418 50%, #2C1810 100%); padding: 120px 40px; position: relative; overflow: hidden;">
        <div style="position: absolute; inset: 0; background: radial-gradient(circle at 30% 50%, rgba(201,168,76,0.06) 0%, transparent 50%); pointer-events: none;"></div>
        <div style="position: absolute; inset: 0; background: radial-gradient(circle at 80% 30%, rgba(201,168,76,0.04) 0%, transparent 40%); pointer-events: none;"></div>

        <div style="max-width: 720px; margin: 0 auto; textAlign: center; position: relative; z-index: 1; text-align: center;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 14px; margin-bottom: 24px;">
                <div style="width: 48px; height: 1px; background: linear-gradient(90deg, transparent, #C9A84C);"></div>
                <span style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 10px; font-weight: 600; letter-spacing: 0.3em; color: #C9A84C; text-transform: uppercase;">
                    Join Us
                </span>
                <div style="width: 48px; height: 1px; background: linear-gradient(90deg, #C9A84C, transparent);"></div>
            </div>

            <h2 style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: clamp(34px, 4vw, 56px); font-weight: 700; color: #F8F5EF; line-height: 1.15; margin-bottom: 24px;">
                Experience Care That<br /><span style="color: #C9A84C; font-style: italic;">Understands You</span>.
            </h2>

            <p style="font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 16px; color: rgba(248,245,239,0.65); line-height: 1.8; max-width: 480px; margin: 0 auto 44px;">
                Join the movement of conscious beauty. Science that works. Prices that are honest. Care that&apos;s genuine.
            </p>

            <div style="display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo esc_url(home_url('/products')); ?>" class="about-cta-gold" style="display: inline-flex; align-items: center; gap: 10px; padding: 17px 36px; background-color: #C9A84C; color: #fff; border-radius: 999px; font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 14px; font-weight: 600; text-decoration: none; letter-spacing: 0.05em; transition: all 0.4s cubic-bezier(0.25,0.1,0.25,1); box-shadow: 0 4px 24px rgba(201,168,76,0.3);">
                    Shop the Collection 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>

                <a href="<?php echo esc_url(home_url('/customer-help')); ?>" class="about-cta-outline" style="display: inline-flex; align-items: center; gap: 8px; padding: 17px 32px; border: 1px solid rgba(248,245,239,0.25); color: #F8F5EF; border-radius: 999px; font-family: 'Adobe Hebrew', 'Noto Serif', Georgia, serif; font-size: 14px; font-weight: 500; text-decoration: none; letter-spacing: 0.04em; transition: all 0.4s cubic-bezier(0.25,0.1,0.25,1);">
                    Get in Touch
                </a>
            </div>
        </div>
    </section>

</main>

<style>
@media (max-width: 768px) {
    .about-hero-grid {
        grid-template-columns: 1fr !important;
        gap: 40px !important;
        padding: 80px 24px 60px !important;
        text-align: center;
    }
    .about-founder-grid {
        grid-template-columns: 1fr !important;
        gap: 48px !important;
    }
    .about-values-grid {
        grid-template-columns: 1fr !important;
    }
    .about-stats-grid {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    .about-science-grid {
        grid-template-columns: 1fr !important;
    }
}

.about-value-card:hover {
    transform: translateY(-6px) !important;
    box-shadow: 0 16px 48px rgba(44,24,16,0.12) !important;
    border-color: rgba(201,168,76,0.3) !important;
}

.about-cta-primary:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 30px rgba(44,24,16,0.25) !important;
}

.about-cta-gold:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 30px rgba(201,168,76,0.45) !important;
    background-color: #D4B86A !important;
}

.about-cta-outline:hover {
    background-color: rgba(248,245,239,0.08) !important;
    border-color: rgba(248,245,239,0.45) !important;
}
</style>

<?php
get_footer();
