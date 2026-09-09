<?php
/**
 * Main Template Fallback File
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="max-w-[1280px] mx-auto px-4 sm:px-6 md:px-10 py-12">
    <?php if (have_posts()) : ?>
        <div class="space-y-8">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white p-6 rounded-lg border border-[#E8E3DB]'); ?>>
                    <h2 class="font-metropolis text-2xl font-bold text-black mb-3">
                        <a href="<?php the_permalink(); ?>" class="hover:text-[#C9A84C] transition-colors">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="font-adobe text-gray-600 leading-relaxed prose max-w-none">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
        <div class="mt-8">
            <?php the_posts_pagination(); ?>
        </div>
    <?php else : ?>
        <div class="text-center py-16">
            <h2 class="font-metropolis text-2xl font-bold text-black mb-2">No Posts Found</h2>
            <p class="font-adobe text-gray-500">It seems we cannot find what you are looking for.</p>
        </div>
    <?php endif; ?>
</div>

<?php
get_footer();
