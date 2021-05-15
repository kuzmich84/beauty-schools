<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <?php
        if (!is_page_template('page-profile.php')) {
            echo dwt_listing_site_spinner();
            echo dwt_listing_site_header();
        }
        ?>
        <?php
        // if (wp_basename(get_page_template()) != 'page-home.php' && !is_page_template('page-profile.php')) {
        //     echo dwt_listing_site_breadcrumb(); /* Get Breadcrumbs */
        // }
        if (!wp_basename(is_page_template('page-home.php')) && !wp_basename(is_page_template('page-profile.php'))) {
                echo dwt_listing_site_breadcrumb(); /* Get Breadcrumbs */
            }