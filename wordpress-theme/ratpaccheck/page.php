<?php
/**
 * Generic Page Template
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="max-w-[960px] mx-auto px-4 sm:px-6 py-12 md:py-16">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white p-6 sm:p-10 rounded-xl border border-[#E8E3DB] shadow-sm'); ?>>
            <header class="mb-8 pb-6 border-b border-gray-100">
                <h1 class="font-metropolis text-3xl sm:text-4xl font-bold text-black">
                    <?php the_title(); ?>
                </h1>
            </header>
            <div class="font-adobe text-gray-700 leading-relaxed space-y-4 text-base">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php
get_footer();
