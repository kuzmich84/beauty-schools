<?php
global $dwt_listing_options;
$event_id = get_the_ID();
$user_id = get_post_field('post_author', $event_id);
$event_start_date = get_post_meta($event_id, 'dwt_listing_event_start_date', true);
$event_end_dateTime = (get_post_meta($event_id, 'dwt_listing_event_end_date', true));
$listing_features = wp_get_object_terms($event_id, array('l_event_cat'), array('orderby' => 'name', 'order' => 'ASC'));
$status_event = get_post_meta($event_id, 'dwt_listing_event_status', true);
//user info
$get_user_dp = $get_user_url = $get_user_name = $get_loc = $contact_num = $get_profile_contact = $get_event_contact = $get_profile_email = $get_email = '';
$get_user_dp = dwt_listing_listing_owner($event_id, 'dp');
$get_user_url = dwt_listing_listing_owner($event_id, 'url');
$get_user_name = dwt_listing_listing_owner($event_id, 'name');
$get_loc = dwt_listing_listing_owner($event_id, 'location');
$get_profile_contact = dwt_listing_listing_owner($event_id, 'contact');
$get_event_contact = get_post_meta($event_id, 'dwt_listing_event_contact', true);
$get_profile_email = dwt_listing_listing_owner($event_id, 'email');
$get_event_email = get_post_meta($event_id, 'dwt_listing_event_email', true);
//display contact number when profile contact not set
if (!empty($get_event_contact)) {
    $contact_num = $get_event_contact;
} else {
    $contact_num = $get_profile_contact;
}
//display email when profile email not set
if (!empty($get_event_email)) {
    $get_email = $get_event_email;
} else {
    $get_email = $get_profile_email;
}
?>
<section class="single-post single-detail-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xs-12 col-md-8 col-sm-8">
                <div class="list-detail">

                    <?php
                    //Message for event has expired
                    if (get_post_meta($event_id, 'dwt_listing_event_status', true) == '0') {
                        echo dwt_listing_event_expired_notification();
                    }
                    ?>
                    <div class="event-title-box">
                        <div class="list-heading">
                            <h2><?php echo get_the_title($event_id); ?></h2>
                        </div>
                        <div class="list-meta">
                            <ul>
                                <li>
                                    <i class="ti-calendar"></i> <?php echo esc_html__('Last Update on ', 'dwt-listing'); ?> <?php the_modified_date(get_option('date_format'), '<a href="javascript:void(0)">', '</a>'); ?>
                                    <?php
                                    if (function_exists('pvc_get_post_views')) {
                                        echo '<span class="spliator">ــ</span> <i class=" ti-eye "></i> ' . esc_html__(" Views ", 'dwt-listing') . '  ' . dwt_listing_number_format_short(pvc_get_post_views($event_id)) . '';
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php get_template_part('template-parts/events/event-detial/modern/slider'); ?>
                    <div class="panel-group" id="accordion_listing_detial" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default panel-event-desc">
                            <div class="panel-heading">
                                <h4 class="panel-title"> <a href="javascript:void(0)"> <i class=" ti-file "></i><?php echo esc_html__('Description', 'dwt-listing'); ?>  </a> </h4>
                            </div>
                            <div class="panel-collapse">
                                <div class="panel-body">

                                    <?php the_content(); ?>
                                    <?php
                                    //related
                                    if (dwt_listing_text('dwt_listing_on_related') == '1') {
                                        $category_id = wp_get_object_terms($event_id, 'l_event_cat', array('fields' => 'ids'));
                                        $args = array
                                            (
                                            'post_type' => 'events',
                                            'post_status' => 'publish',
                                            'posts_per_page' => dwt_listing_text('app_event_related_nums'),
                                            'post__not_in' => array($event_id),
                                            'no_found_rows' => true,
                                            'meta_query' => array(
                                                array(
                                                    'key' => 'dwt_listing_event_status',
                                                    'value' => '1',
                                                    'compare' => '='
                                                )
                                            ),
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'l_event_cat',
                                                    'field' => 'id',
                                                    'terms' => $category_id
                                                )
                                            ),
                                            'order' => 'desc',
                                            'orderby' => 'date',
                                        );
                                        $results = new WP_Query($args);
                                        if ($results->have_posts()) {
                                            ?>
                                            <div class="related-event-section">
                                                <h3><?php echo dwt_listing_text('dwt_related_section'); ?></h3>
                                                <div class="row">
                                                    <?php
                                                    while ($results->have_posts()) {
                                                        $results->the_post();
                                                        $related_id = get_the_ID();
                                                        $media = dwt_listing_fetch_event_gallery($related_id);
                                                        ?>	
                                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                            <div class="e-related-grid">
                                                                <div class="related-event-img">
                                                                    <a href="<?php echo esc_url(get_the_permalink($related_id)); ?>"><img src="<?php echo dwt_listing_return_event_idz($media, 'dwt_listing_related_imgz'); ?>"  class="img-responsive"  alt="<?php echo get_the_title($related_id); ?>"></a>                                   
                                                                </div>                                
                                                                <h3>
                                                                    <a href="<?php echo esc_url(get_the_permalink($related_id)); ?>"><?php echo get_the_title($related_id); ?></a>
                                                                </h3>
                                                                <span class="date"><i class="fa fa-calendar-o" aria-hidden="true"></i> <?php echo get_the_date(get_option('date_format'), $related_id); ?></span>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        wp_reset_postdata();
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php if (is_singular('events')) { ?>
                            <div class="events-post-navigation">
                                <div class="nav-links">
                                    <div class="nav-previous"><?php previous_post_link('%link', esc_html__('Previous Event', 'dwt-listing')); ?></div>
                                    <div class="nav-next"><?php next_post_link('%link', esc_html__('Next Event', 'dwt-listing')); ?></div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        if (get_post_meta($event_id, 'dwt_listing_event_status', true) != '0') {
                            ?>
                            <div class="panel panel-default eventz-comments">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a  href="javascript:void(0)"> <i class="ti-comment-alt"></i><?php echo esc_html__('Discussion', 'dwt-listing'); ?> </a> </h4>
                                </div>
                                <div class="panel-collapse">
                                    <div class="panel-body">
                                        <div class="single-blog blog-detial">
                                            <div class="blog-post">
                                                <?php comments_template('', true); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="sidebar-panels">
                    <div class="panel panel-default side-author">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a href="javascript:void(0)"> <i class=" ti-user "></i><?php echo esc_html__('Author', 'dwt-listing'); ?>  </a> </h4>
                        </div>
                        <div class="panel-collapse">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="user-photo col-lg-4 col-md-4 col-sm-3  col-xs-12">
                                        <a target="_blank" href="<?php echo esc_url($get_user_url); ?>">
                                            <img src="<?php echo esc_url($get_user_dp); ?>" class="img-circle center-block img-responsive" alt="<?php __('not found', 'dwt-listing'); ?>">
                                        </a>
                                    </div>
                                    <div class="user-information col-lg-8 col-md-8 col-sm-9 col-xs-12 no-left-pad">
                                        <span class="user-name"><a class="hover-color" href="<?php echo esc_url($get_user_url); ?>"><?php echo esc_attr($get_user_name); ?></a></span>
                                        <?php if (!empty($get_loc)) { ?>
                                            <div class="item-date">
                                                <p class="street-adr"><i class="ti-location-pin"></i> <?php echo esc_attr($get_loc); ?></p>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <ul class="widget-listing-details">
                                    <?php if (!empty($get_profile_contact)) { ?>
                                        <li> <span> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/phone.png'); ?>" alt="<?php echo esc_html__('image not found', 'dwt-listing'); ?>"></span> <span> <a href="tel:<?php echo esc_attr($get_profile_contact); ?>"><?php echo esc_attr($get_profile_contact); ?></a></span> </li>
                                    <?php } ?>     
                                    <li> <span> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/gmail.png'); ?>" alt="<?php echo esc_html__('image not found', 'dwt-listing'); ?>"></span> <span> <a href="mailto:<?php echo ($get_profile_email); ?>"><?php echo esc_attr($get_profile_email); ?></a></span> </li>
                                </ul>
                                <ul class="social-media-event">
                                    <?php if (get_user_meta($user_id, 'd_fb_link', true) != '') { ?>
                                        <li><a href="<?php echo esc_url(get_user_meta($user_id, 'd_fb_link', true)); ?>"><i class="ti-facebook"></i></a></li>
                                    <?php } ?>
                                    <?php if (get_user_meta($user_id, 'd_twitter_link', true) != '') { ?>
                                        <li><a href="<?php echo esc_url(get_user_meta($user_id, 'd_twitter_link', true)); ?>"><i class="ti-twitter"></i></a></li>
                                    <?php } ?>
                                    <?php if (get_user_meta($user_id, 'd_google_link', true) != '') { ?>
                                        <li><a href="<?php echo esc_url(get_user_meta($user_id, 'd_google_link', true)); ?>"><i class="ti-google"></i></a></li>
                                    <?php } ?>
                                    <?php if (get_user_meta($user_id, 'd_linked_link', true) != '') { ?>
                                        <li><a href="<?php echo esc_url(get_user_meta($user_id, 'd_linked_link', true)); ?>"><i class="ti-linkedin"></i></a></li>
                                    <?php } ?>
                                    <?php if (get_user_meta($user_id, 'd_youtube_link', true) != '') { ?>
                                        <li><a href="<?php echo esc_url(get_user_meta($user_id, 'd_youtube_link', true)); ?>"><i class=" ti-youtube "></i></a></li>
                                    <?php } ?>
                                    <?php if (get_user_meta($user_id, 'd_insta_link', true) != '') { ?>
                                        <li><a href="<?php echo esc_url(get_user_meta($user_id, 'd_insta_link', true)); ?>"><i class=" ti-instagram "></i></a></li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default side-event">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a href="javascript:void(0)"> <i class="ti-server"></i> <?php echo esc_html__('Event Information', 'dwt-listing'); ?> </a> </h4>
                        </div>
                        <div class="panel-collapse">
                            <div class="panel-body">
                                <ul class="widget-listing-details">
                                    <?php if ($status_event != '0') { ?>
                                        <li data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__('Event start date', 'dwt-listing'); ?>"> <span> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/timer.png'); ?>" alt="<?php echo esc_html__('icon', 'dwt-listing'); ?>"></span> <span class="sidebar_clock" data-countdown-time="<?php echo esc_attr($event_start_date); ?>"></span> </li>
                                    <?php } ?>
                                    <?php if (get_post_meta($event_id, 'dwt_listing_event_start_date', true) != "") { ?>
                                        <li data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__('Event start date', 'dwt-listing'); ?>"> <span> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/calendar.png'); ?>" alt="<?php echo esc_html__('icon', 'dwt-listing'); ?>"></span> <span> <?php echo date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime(get_post_meta($event_id, 'dwt_listing_event_start_date', true))); ?></span> </li>
                                    <?php } ?>
                                    <?php if (get_post_meta($event_id, 'dwt_listing_event_end_date', true) != "") { ?>
                                        <li data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__('Event end date', 'dwt-listing'); ?>"> <span> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/calendar-end.png'); ?>" alt="<?php echo esc_html__('icon', 'dwt-listing'); ?>"></span> <span><?php echo date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime(get_post_meta($event_id, 'dwt_listing_event_end_date', true))); ?></span> </li>
                                    <?php } ?>
                                    <?php
                                    if (isset($listing_features) && $listing_features != "") {
                                        if (!is_wp_error($listing_features)) {
                                            foreach ($listing_features as $term) {
                                                $link = dwt_listing_pagelink('dwt_listing_event_page') . '?event_cat=' . $term->slug;
                                                ?>
                                                <li data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__('Event category', 'dwt-listing'); ?>"> <span> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/database.png'); ?>" alt="<?php echo esc_html__('icon', 'dwt-listing'); ?>"></span> <span> <a href="<?php echo esc_url($link); ?>"><?php echo esc_attr($term->name); ?></a></span> </li>
                                                <?php
                                                break;
                                            }
                                        }
                                    }
                                    ?>
                                    <?php if (get_post_meta($event_id, 'dwt_listing_event_listing_id', true) != "") { ?>
                                        <li data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__('Related listings', 'dwt-listing'); ?>"> <span> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/click.png'); ?>" alt="<?php echo esc_html__('icon', 'dwt-listing'); ?>"></span> <span> <a href="<?php echo get_permalink(get_post_meta($event_id, 'dwt_listing_event_listing_id', true)); ?>" target="_blank"><?php echo esc_html__('View Listing', 'dwt-listing'); ?></a></span> </li>
                                    <?php } ?>
                                    <?php if (get_post_meta($event_id, 'dwt_listing_event_contact', true) != "") { ?>
                                        <li> <span> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/phone.png'); ?>" alt="<?php echo esc_html__('icon', 'dwt-listing'); ?>"></span> <span><a href="tel:<?php echo get_post_meta($event_id, 'dwt_listing_event_contact', true); ?>"><?php echo get_post_meta($event_id, 'dwt_listing_event_contact', true); ?></a></span> </li>
                                    <?php } ?>
                                    <?php if (get_post_meta($event_id, 'dwt_listing_event_email', true) != "") { ?>
                                        <li> <span> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/email.png'); ?>" alt="<?php echo esc_html__('icon', 'dwt-listing'); ?>"></span> <span> <a href="mailto:<?php echo (get_post_meta($event_id, 'dwt_listing_event_email', true)); ?>"><?php echo esc_html__('Contact Email', 'dwt-listing'); ?></a></span> </li>
                                    <?php } ?>
                                </ul>
                                <?php
                                if (get_post_meta($event_id, 'dwt_event_fb', true) != "" || get_post_meta($event_id, 'dwt_event_tw', true) != "" || get_post_meta($event_id, 'dwt_event_google', true) != "" || get_post_meta($event_id, 'dwt_event_in', true) != "" || get_post_meta($event_id, 'dwt_event_youtube', true) != "" || get_post_meta($event_id, 'dwt_event_insta', true) != "") {
                                    ?>	 
                                    <ul class="social-media-event">
                                        <?php if (get_post_meta($event_id, 'dwt_event_fb', true) != "") { ?>
                                            <li><a href="<?php echo esc_url(get_post_meta($event_id, 'dwt_event_fb', true)); ?>"><i class="ti-facebook"></i></a></li>
                                        <?php } ?>
                                        <?php if (get_post_meta($event_id, 'dwt_event_tw', true) != "") { ?>
                                            <li><a href="<?php echo esc_url(get_post_meta($event_id, 'dwt_event_tw', true)); ?>"><i class="ti-twitter"></i></a></li>
                                        <?php } ?>
                                        <?php if (get_post_meta($event_id, 'dwt_event_google', true) != "") { ?>
                                            <li><a href="<?php echo esc_url(get_post_meta($event_id, 'dwt_event_google', true)); ?>"><i class="ti-google"></i></a></li>
                                        <?php } ?>
                                        <?php if (get_post_meta($event_id, 'dwt_event_in', true) != "") { ?>
                                            <li><a href="<?php echo esc_url(get_post_meta($event_id, 'dwt_event_in', true)); ?>"><i class="ti-linkedin"></i></a></li>
                                        <?php } ?>
                                        <?php if (get_post_meta($event_id, 'dwt_event_youtube', true) != "") { ?>
                                            <li><a href="<?php echo esc_url(get_post_meta($event_id, 'dwt_event_youtube', true)); ?>"><i class="ti-youtube"></i></a></li>
                                        <?php } ?>
                                        <?php if (get_post_meta($event_id, 'dwt_event_insta', true) != "") { ?>
                                            <li><a href="<?php echo esc_url(get_post_meta($event_id, 'dwt_event_insta', true)); ?>"><i class=" ti-instagram"></i></a></li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default side-map">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a href="javascript:void(0)"> <i class="ti-location-pin"></i> <?php echo esc_html__('Location', 'dwt-listing'); ?> </a> </h4>
                        </div>
                        <div class="panel-collapse">
                            <div class="panel-body">
                                <?php get_template_part('template-parts/events/event-detial/modern/map'); ?>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</section>