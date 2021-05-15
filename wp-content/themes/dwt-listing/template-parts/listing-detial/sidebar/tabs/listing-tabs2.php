<?php
global $dwt_listing_options;
//listing id
if (isset($_GET['review_id']) && $_GET['review_id'] != "") {
    $listing_id = $_GET['review_id'];
} else {
    $listing_id = get_the_ID();
}
$profile_url = $get_user_dp = '';
$profile_url = dwt_listing_listing_owner($listing_id, 'url');
$get_user_dp = dwt_listing_listing_owner($listing_id, 'dp');
?>
<div class="profile-widget tab2">
    <div class="panel with-nav-tabs panel-default">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1default" data-toggle="tab"><?php echo esc_html__('Listing Detail', 'dwt-listing'); ?></a></li>
                <li><a href="#tab2default" data-toggle="tab"><?php echo esc_html__('Contact', 'dwt-listing'); ?></a></li>
            </ul>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1default">
                    <ul class="widget-listing-details">
                        <?php
                        if (dwt_listing_listing_custom_location($listing_id) != "") {
                            ?>
                            <li> <span> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/map.png'); ?>" alt="<?php echo esc_html__('icon', 'dwt-listing'); ?>"></span> <span><?php echo dwt_listing_listing_custom_location($listing_id); ?></span> </li>
                            <?php
                        }
                        ?>
                        <?php
                        if (get_post_meta($listing_id, 'dwt_listing_listing_contact', true) != "") {
                            ?>
                            <li class="track-me"> <span> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/phone.png'); ?>" alt="<?php echo esc_html__('icon', 'dwt-listing'); ?>"></span> <span> <a data-reaction="contact" data-listing-id="<?php echo esc_attr($listing_id); ?>" href="tel:<?php echo get_post_meta($listing_id, 'dwt_listing_listing_contact', true); ?>"><?php echo get_post_meta($listing_id, 'dwt_listing_listing_contact', true); ?></a></span> </li>
                            <?php
                        }
                        ?>
                        <?php
                        if (get_post_meta($listing_id, 'dwt_listing_listing_weburl', true) != "") {
                            ?>    
                            <li class="track-me" > <span> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/globe.png'); ?>" alt="<?php echo esc_html__('icon', 'dwt-listing'); ?>"></span> <span> <a data-reaction="web" data-listing-id="<?php echo esc_attr($listing_id); ?>" target="_blank" href="<?php echo esc_url(get_post_meta($listing_id, 'dwt_listing_listing_weburl', true)); ?>"><?php echo esc_html__('View Website', 'dwt-listing'); ?></a></span> </li>
                            <?php
                        }
                        ?>
                    </ul>

                    <?php
                    if (get_post_meta($listing_id, 'dwt_listing_listing_fb', true) != "" || get_post_meta($listing_id, 'dwt_listing_listing_tw', true) != "" || get_post_meta($listing_id, 'dwt_listing_listing_google', true) != "" || get_post_meta($listing_id, 'dwt_listing_listing_in', true) != "") {
                        ?>
                        <ul class="social-media">

                            <?php
                            if (get_post_meta($listing_id, 'dwt_listing_listing_fb', true) != "") {
                                ?>
                                <li><a target="_blank" href="<?php echo esc_url(get_post_meta($listing_id, 'dwt_listing_listing_fb', true)); ?>"><i class="ti-facebook"></i></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if (get_post_meta($listing_id, 'dwt_listing_listing_tw', true) != "") {
                                ?>
                                <li><a target="_blank" href="<?php echo esc_url(get_post_meta($listing_id, 'dwt_listing_listing_tw', true)); ?>"><i class="ti-twitter"></i></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if (get_post_meta($listing_id, 'dwt_listing_listing_google', true) != "") {
                                ?>
                                <li><a target="_blank" href="<?php echo esc_url(get_post_meta($listing_id, 'dwt_listing_listing_google', true)); ?>"><i class="ti-google"></i></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if (get_post_meta($listing_id, 'dwt_listing_listing_in', true) != "") {
                                ?>
                                <li><a target="_blank" href="<?php echo esc_url(get_post_meta($listing_id, 'dwt_listing_listing_in', true)); ?>"><i class="ti-linkedin"></i></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if (get_post_meta($listing_id, 'dwt_listing_youtube', true) != "") {
                                ?>
                                <li><a target="_blank" href="<?php echo esc_url(get_post_meta($listing_id, 'dwt_listing_youtube', true)); ?>"><i class="ti-youtube "></i></a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if (get_post_meta($listing_id, 'dwt_listing_insta', true) != "") {
                                ?>
                                <li><a target="_blank" href="<?php echo esc_url(get_post_meta($listing_id, 'dwt_listing_insta', true)); ?>"><i class="ti-instagram"></i></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>



                </div>
                <div class="tab-pane fade" id="tab2default">
                    <form method="post" data-disable="false" id="listing-owner-contact">
                        <div class="form-group">
                            <input placeholder="<?php echo esc_html__('Your Name', 'dwt-listing'); ?>" name="name" class="form-control" type="text" required>
                        </div>
                        <div class="form-group">
                            <input placeholder="<?php echo esc_html__('Email address', 'dwt-listing'); ?>" name="email" class="form-control" type="email" required>
                        </div>
                        <div class="form-group">
                            <input placeholder="<?php echo esc_html__('Phone number or mobile number', 'dwt-listing'); ?>" name="phone" class="form-control" type="number" required>
                        </div>
                        <div class="form-group">
                            <textarea cols="6" name="message" rows="6" placeholder="<?php echo esc_html__('Your Message', 'dwt-listing'); ?>" class="form-control" required></textarea>
                        </div>

                        <input type="hidden" id="posted_listing_id" name="posted_listing_id" value="<?php echo esc_attr($listing_id); ?>" />

                        <button type="submit" class="btn btn-theme sonu-button-<?php echo esc_attr($listing_id); ?>"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo esc_html__("Processing...", 'dwt-listing'); ?>"><?php echo esc_html__("Send Message", 'dwt-listing'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="l-author-box user-info-card">
    <div class="row">
        <div class="user-photo col-lg-4 col-md-4 col-sm-3  col-xs-12">
            <a target="_blank" href="<?php echo esc_url($profile_url); ?>">
                <img src="<?php echo esc_url($get_user_dp); ?>" class="img-circle center-block img-responsive" alt="<?php echo esc_html__('not found', 'dwt-listing'); ?>">
            </a>
        </div>
        <div class="user-information col-lg-8 col-md-8 col-sm-9 col-xs-12 no-left-pad">
            <span class="user-name"><a class="hover-color" href="<?php echo esc_url($profile_url); ?>"><?php echo dwt_listing_listing_owner($listing_id, 'name'); ?></a></span>
            <div class="item-date">
                <p class="street-adr"><i class="ti-location-pin"></i> <?php echo dwt_listing_listing_owner($listing_id, 'location'); ?></p>
            </div>
        </div>
    </div>
    <div class="auth-button">
        <a class="btn btn-theme btn-block" href="<?php echo esc_url($profile_url); ?>"><?php echo esc_html__('View Profile', 'dwt-listing'); ?></a>
    </div>
</div>