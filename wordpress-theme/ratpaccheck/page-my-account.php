<?php
/**
 * Template Name: WooCommerce My Account
 *
 * Dedicated full-width luxury template for the RatpacCheck Customer Portal.
 * Eliminates nested page.php container conflicts, duplicate headers, and constrained widths.
 *
 * @package RatpacCheck
 * @version 1.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main rpc-myaccount-main min-h-screen bg-[#F6F1EA] py-8 sm:py-12">
    <div class="rpc-myaccount-container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <?php while (have_posts()) : the_post(); ?>
            <div class="rpc-myaccount-entry-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
