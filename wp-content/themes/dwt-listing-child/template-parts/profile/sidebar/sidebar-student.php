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
if (!empty($listing_type) && ( $listing_type == "publish" || $listing_type == "pending" || $listing_type == "expired" || $listing_type == "featured")) {
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
                $listing_update_url = dwt_listing_set_url_params_multi(get_the_permalink(), array('listing-type' => 'profile'));
                ?>
                <li class="profile-profile"><a
                        href="<?php echo esc_url(dwt_listing_page_lang_url_callback($listing_update_url)); ?>" <?php
                    if ($listing_type == "profile") {
                        echo 'class="active"';
                    };
                    ?>><i class="lnr lnr-user"></i> <span><?php echo esc_html__("Profile", 'dwt-listing'); ?></span></a>
                </li>
                <li><a href="<?php echo wp_logout_url(home_url('/')); ?>"><i class="lnr lnr-exit"></i>
                        <span><?php echo esc_html__("Logout", 'dwt-listing'); ?></span></a></li>
            </ul>
            </ul>
        </nav>
    </div>
</div>