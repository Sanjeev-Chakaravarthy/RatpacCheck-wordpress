<?php
/**
 * 404 Error Page Template
 *
 * @package RatpacCheck
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="min-h-[60vh] flex items-center justify-center py-20 px-4">
    <div class="text-center max-w-md space-y-5">
        <span class="font-metropolis text-6xl font-extrabold text-[#E8A3A8] block">404</span>
        <h1 class="font-metropolis text-2xl sm:text-3xl font-bold text-black">Page Not Found</h1>
        <p class="font-adobe text-sm text-gray-600">
            The page or formulation you are looking for might have been moved or does not exist.
        </p>
        <div class="pt-2">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-block bg-black hover:bg-neutral-800 text-white font-metropolis font-semibold text-xs uppercase tracking-wider px-8 py-3.5 rounded-md transition-all">
                Return to Homepage
            </a>
        </div>
    </div>
</div>

<?php
get_footer();
