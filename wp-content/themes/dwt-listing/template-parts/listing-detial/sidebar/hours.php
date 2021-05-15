<?php
global $dwt_listing_options;
//listing id
if (isset($_GET['review_id']) && $_GET['review_id'] != "") {
    $listing_id = $_GET['review_id'];
} else {
    $listing_id = get_the_ID();
}
//if busines hours allowed
if (get_post_meta($listing_id, 'dwt_listing_is_hours_allow', true) == '1') {
    //now check if its 24/7 or selective timimgz
    if (get_post_meta($listing_id, 'dwt_listing_business_hours', true) == '1') {
        ?>
        <div class="widget-opening-hours widget">
            <div class="opening-hours-title tool-tip" title="<?php echo esc_html__('Business Hours', 'dwt-listing'); ?>"> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/clock.png'); ?>" alt="<?php echo esc_html__('not found', 'dwt-listing'); ?>"><span><?php echo esc_html__('Always Open', 'dwt-listing'); ?></span>
            </div> 
        </div>    
        <?php
    } else {
        $get_hours = dwt_listing_show_business_hours($listing_id);
        $status_type = dwt_listing_business_hours_status($listing_id);
        if ($status_type == 0) {
            $business_hours_status = esc_html__('Closed', 'dwt-listing');
        } else {
            $business_hours_status = esc_html__('Open Now', 'dwt-listing');
        }
        $class = '';
        if (is_rtl()) {
            $class = 'flip';
        }
        ?>
        <div class="widget-opening-hours widget">
            <div class="opening-hours-title tool-tip" title="<?php echo esc_html__('Business Hours', 'dwt-listing'); ?>"  data-toggle="collapse" data-target="#opening-hours"> <img src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/icons/clock.png'); ?>" alt="<?php echo esc_html__('not found', 'dwt-listing'); ?>"><span><?php echo esc_attr($business_hours_status); ?></span> <i class="ti-angle-down pull-right <?php echo esc_attr($class); ?>"></i>
            </div>
            <div id="opening-hours" class="collapse in">
                <?php
                if (get_post_meta($listing_id, 'dwt_listing_user_timezone', true) != "") {

                    echo '<div class="s-timezone">' . dwt_listing_text('dwt_listing_timezone_txt') . ' : <strong>' . get_post_meta($listing_id, 'dwt_listing_user_timezone', true) . '</strong></div>';
                }
                ?>
                <ul>
                    <?php
                    if (is_array($get_hours) && count($get_hours) > 0) {
                        foreach ($get_hours as $key => $val) {
                            $class = '';
                            if ($val['current_day'] != "") {
                                $class = "current_day";
                            }
                            if ($val['closed'] == 1) {
                                $class = "closed";
                                echo '' . $htm_return = '<li class="' . esc_html($class) . '"> <span class="day-name"> ' . $val['day_name'] . ':</span> <span class="day-timing"> ' . esc_html__('Closed', 'dwt-listing') . ' </span> </li>';
                            } else {
                                echo '' . $htm_return = ' <li class="' . esc_html($class) . '"> <span class="day-name"> ' . $val['day_name'] . ':</span> <span class="day-timing"> ' . esc_attr($val['start_time']) . ' - ' . esc_attr($val['end_time']) . ' </span> </li>';
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>        
        <?php
    }
}
