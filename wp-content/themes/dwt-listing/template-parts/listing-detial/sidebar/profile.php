<?php
global $dwt_listing_options;
//listing id
$get_brand_img = $profile_url = $get_user_dp = '';
if (isset($_GET['review_id']) && $_GET['review_id'] != "") {
    $listing_id = $_GET['review_id'];
} else {
    $listing_id = get_the_ID();
}
$profile_url = dwt_listing_listing_owner($listing_id, 'url');
$get_user_dp = dwt_listing_listing_owner($listing_id, 'dp');
if (get_post_meta($listing_id, 'dwt_listing_brand_name', true) != "") {
    $get_brand_img = dwt_listing_get_brand_img($listing_id, 'dwt_listing_list-view1');
    ?>
    <div class="contact-box">
        <div class="contact-img">
            <a href="javascript:void(0)"><img src="<?php echo esc_url($get_brand_img); ?>" class="img-circle img-responsive" alt="<?php echo esc_html__('not found', 'dwt-listing'); ?>"></a>
        </div>
        <div class="contact-caption">
            <h4><a href="javascript:void(0)"><?php echo esc_attr(get_post_meta($listing_id, 'dwt_listing_brand_name', true)); ?></a></h4>
            <?php if (get_post_meta($listing_id, 'dwt_listing_listing_street', true) != "") { ?>
                <span>	  
                    <p class="street-adr"><i class="ti-location-pin"></i> <?php echo get_post_meta($listing_id, 'dwt_listing_listing_street', true); ?></p>
                </span><?php } ?>
        </div>
    </div>
    <?php
    get_template_part('template-parts/listing-detial/sidebar/tabs/listing', 'tabs2');
} else {
    ?>
    <div class="contact-box">
        <div class="contact-img">
            <a target="_blank" href="<?php echo esc_url($profile_url); ?>"><img src="<?php echo esc_url($get_user_dp); ?>" class="img-circle img-responsive" alt="<?php echo esc_html__('not found', 'dwt-listing'); ?>"></a>
        </div>
        <div class="contact-caption">
            <h4><a href="<?php echo esc_url($profile_url); ?>"><?php echo dwt_listing_listing_owner($listing_id, 'name'); ?></a></h4>
            <span><?php echo dwt_listing_listing_owner($listing_id, 'location'); ?></span>
        </div>
    </div>
    <?php
    get_template_part('template-parts/listing-detial/sidebar/tabs/listing', 'tabs');
}
