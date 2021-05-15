<?php
global $dwt_listing_options;
$is_event_creation = '';
$listing_type = '';
$profile = new dwt_listing_profile();
$uid = $profile->user_info->ID;
$get_user_dp = dwt_listing_get_user_dp($uid, 'dwt_listing_user-dp');
$listng = new dwt_listing_submit_listing();
$package_id = $listng->get_package_detials();
if (get_post_meta($package_id, 'create_event', true) != "") {
    $is_event_creation = get_post_meta($package_id, 'create_event', true);
}
$listing_type = isset($_GET['listing-type']) ? $_GET['listing-type'] : '';
$review_active = $review_in = $event_active = $event_in = $activeListing = $listing_active = $listing_in = $booking_timekit_active = $booking_timekit_in = '';
if (!empty($listing_type) && ($listing_type == "publish" || $listing_type == "pending" || $listing_type == "expired" || $listing_type == "featured")) {
    $listing_in = 'in';
    $listing_active = 'active';
}
if (!empty($listing_type) && ($listing_type == "publish-events" || $listing_type == "pending-events" || $listing_type == "expired-events" || $listing_type == "create-events")) {
    $event_in = 'in';
    $event_active = 'active';
}
if (!empty($listing_type) && ($listing_type == "received-reviews" || $listing_type == "submitted-reviews")) {
    $review_in = 'in';
    $review_active = 'active';
}
if (!empty($listing_type) && ($listing_type == "booking-timekit")) {
    $booking_timekit_in = 'in';
    $booking_timekit_active = 'active';
}
$arrowz = 'fa fa-angle-right';
if (is_rtl()) {
    $arrowz = 'fa fa-angle-left';
}
?>
<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">
        <nav>
            <ul class="nav">
                <?php
                $listing_update_url = '';
                $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'dashboard'));
                ?>
                <li class="profile-dash"><a
                            href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>" <?php
                    if ($listing_type == "dashboard") {
                        echo 'class="active"';
                    }
                    ?>><i class="lnr lnr-home"></i>
                        <span><?php echo esc_html__("Dashboard", 'dwt-listing'); ?></span></a></li>
                <?php
                $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'profile'));
                ?>
                <li class="profile-profile"><a
                            href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>" <?php
                    if ($listing_type == "profile") {
                        echo 'class="active"';
                    }
                    ?>><i class="lnr lnr-user"></i> <span><?php echo esc_html__("Profile", 'dwt-listing'); ?></span></a>
                </li>
                <li class="profile-listings">
                    <a href="#mylisting" data-toggle="collapse"
                       class="collapsed <?php echo esc_attr($listing_active) ?>"><i class="lnr lnr-list"></i>
                        <span><?php echo esc_html__("My Listings", 'dwt-listing'); ?></span> <i
                                class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="mylisting" class="collapse <?php echo esc_attr($listing_in); ?>">
                        <ul class="nav">
                            <li>
                                <?php
                                $btn_link = '';
                                $btn_src_link = '#';
                                if (dwt_listing_text('dwt_listing_disable_submission') == '1') {
                                    $btn_link = $dwt_listing_options["dwt_listing_header-page"];
                                    if (isset($btn_link) && $btn_link != '') {
                                        $btn_src_link = esc_url(get_the_permalink($btn_link));
                                    }
                                }
                                ?>
                                <a <?php
                                if ($listing_type == "create-listing") {
                                    echo 'class="active"';
                                }
                                ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($btn_src_link)); ?>"><i
                                            class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Create Listing", 'dwt-listing'); ?>
                                </a>
                            </li>
                            <li><a <?php
                                if ($listing_type == "publish") {
                                    echo 'class="active"';
                                }
                                $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'publish'));
                                ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>"><i
                                            class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Published Listings", 'dwt-listing'); ?>
                                    <span class="badge"><?php echo dwt_listing_get_listing_status_count($uid, '1'); ?></span></a>
                            </li>
                            <li><a <?php
                                if ($listing_type == "pending") {
                                    echo 'class="active"';
                                }
                                $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'pending'));
                                ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>"><i
                                            class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Pending Listings", 'dwt-listing'); ?>
                                    <span class="badge"><?php echo dwt_listing_get_pending_listing_count_update($uid); ?></span></a>
                            </li>
                            <li><a <?php
                                if ($listing_type == "featured") {
                                    echo 'class="active"';
                                }
                                $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'featured'));
                                ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>"><i
                                            class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Featured Listings", 'dwt-listing'); ?>
                                    <span class="badge"><?php echo dwt_listing_get_featured_count($uid); ?></span></a>
                            </li>
                            <li><a <?php
                                if ($listing_type == "expired") {
                                    echo 'class="active"';
                                }
                                $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'expired'));
                                ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>"><i
                                            class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Expired Listings", 'dwt-listing'); ?>
                                    <span class="badge"><?php echo dwt_listing_get_listing_status_count($uid, '0'); ?></span></a>
                            </li>
                            <li><a <?php
                                if ($listing_type == "trashed") {
                                    echo 'class="active"';
                                }
                                $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'trashed'));
                                ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>"><i
                                            class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Trashed Listings", 'dwt-listing'); ?>
                                    <span class="badge"><?php echo dwt_listing_get_listing_status_count_trash($uid); ?></span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php if ($is_event_creation == 'yes') { ?>
                    <li class="profile-events">
                        <a href="#myeventz" data-toggle="collapse"
                           class="collapsed <?php echo esc_attr($event_active) ?>"><i class="lnr lnr-calendar-full"></i>
                            <span><?php echo esc_html__("Events", 'dwt-listing'); ?></span> <i
                                    class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="myeventz" class="collapse <?php echo esc_attr($event_in); ?>">
                            <ul class="nav">
                                <li><a <?php
                                    if ($listing_type == "create-events") {
                                        echo 'class="active"';
                                    }
                                    $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'create-events'));
                                    ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>"><i
                                                class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Create Event", 'dwt-listing'); ?>
                                    </a></li>
                                <li><a <?php
                                    if ($listing_type == "publish-events") {
                                        echo 'class="active"';
                                    }
                                    $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'publish-events'));
                                    ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>"><i
                                                class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Published Events", 'dwt-listing'); ?>
                                        <span class="badge"><?php echo dwt_listing_get_events_status_count($uid, '1'); ?></span></a>
                                </li>
                                <li><a <?php
                                    if ($listing_type == "pending-events") {
                                        echo 'class="active"';
                                    }
                                    $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'pending-events'));
                                    ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>"><i
                                                class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Pending Events", 'dwt-listing'); ?>
                                        <span class="badge"><?php echo dwt_listing_get_pending_events_count($uid); ?></span></a>
                                </li>
                                <li><a <?php
                                    if ($listing_type == "expired-events") {
                                        echo 'class="active"';
                                    }
                                    $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'expired-events'));
                                    ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>"><i
                                                class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Expired Events", 'dwt-listing'); ?>
                                        <span class="badge"><?php echo dwt_listing_get_events_status_count($uid, '0'); ?></span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php } ?>
                <?php
                if (dwt_listing_text('dwt_listing_disable_menu') == '1') {
                    $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'create-menu'));
                    ?>
                    <li class="profile-menu"><a
                                href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>" <?php
                        if ($listing_type == "create-menu") {
                            echo 'class="active"';
                        }
                        ?>><i class="lnr lnr-dinner"></i> <span><?php echo esc_html__("Menu", 'dwt-listing'); ?></span></a>
                    </li>
                <?php } ?>
                <li class="profile-reviews">
                    <a href="#myreviews" data-toggle="collapse"
                       class="collapsed <?php echo esc_attr($review_active) ?>"><i class="lnr lnr-star"></i>
                        <span><?php echo esc_html__("Reviews", 'dwt-listing'); ?></span> <i
                                class="icon-submenu lnr lnr-chevron-left"></i></a>
                    <div id="myreviews" class="collapse <?php echo esc_attr($review_in); ?>">
                        <ul class="nav">
                            <li><a <?php
                                if ($listing_type == "received-reviews") {
                                    echo 'class="active"';
                                }
                                $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'received-reviews'));
                                ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>"><i
                                            class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Received Reviews", 'dwt-listing'); ?>
                                    <span class="badge"><?php echo dwt_listing_received_reviews($uid); ?></span></a>
                            </li>
                            <li><a <?php
                                if ($listing_type == "submitted-reviews") {
                                    echo 'class="active"';
                                }
                                $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'submitted-reviews'));
                                ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>"><i
                                            class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Submitted Reviews", 'dwt-listing'); ?>
                                    <span class="badge"><?php echo dwt_listing_submitted_reviews($uid); ?></span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php
                $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'favourite'));
                ?>
                <li class="profile-fav"><a
                            href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>" <?php
                    if ($listing_type == "favourite") {
                        echo 'class="active"';
                    }
                    ?>><i class="lnr lnr-heart"></i> <span><?php echo esc_html__("Favorites", 'dwt-listing'); ?></span></a>
                </li>
                <?php
                $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'invoices'));
                ?>
                <li class="profile-invoice"><a
                            href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>" <?php
                    if ($listing_type == "invoices") {
                        echo 'class="active"';
                    }
                    ?>><i class="lnr lnr-printer"></i> <span><?php echo esc_html__("Invoices", 'dwt-listing'); ?></span></a>
                </li>

                <?php if ($dwt_listing_options['dwt_listing_booking_time_kit'] == true) { ?>
                    <li class="profile-booking">
                        <a href="#mybooking" data-toggle="collapse"
                           class="collapsed <?php echo esc_attr($review_active) ?>"><i
                                    class="lnr lnr-calendar-full"></i><span><?php echo esc_html__("Booking", 'dwt-listing'); ?></span>
                            <i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        <div id="mybooking" class="collapse <?php echo esc_attr($booking_timekit_in); ?>">
                            <ul class="nav">
                                <li><a <?php
                                    if ($listing_type == "booking-timekit") {
                                        echo 'class="active"';
                                    }
                                    $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'booking-timekit'));
                                    ?> href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>"><i
                                                class="<?php echo $arrowz; ?>"></i><?php echo esc_html__("Timekit", 'dwt-listing'); ?>
                                    </a></li>
                            </ul>
                        </div>
                    </li>
                <?php } ?>
                <li><a href="<?php echo wp_logout_url(home_url('/')); ?>"><i class="lnr lnr-exit"></i>
                        <span><?php echo esc_html__("Logout", 'dwt-listing'); ?></span></a></li>
            </ul>
        </nav>
    </div>
</div>