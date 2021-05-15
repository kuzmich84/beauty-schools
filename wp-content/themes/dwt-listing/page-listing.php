<?php
/* Template Name: Ad Listing Page */
/**
 * The template for displaying Pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dwt listing
 */
?>
<?php
get_header();
dwt_listing_check_pkg();
?>
<section class="submit-listing">
    <div class="container">
        <div class="row">
            <?php get_template_part('template-parts/submit-listing/submit'); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>