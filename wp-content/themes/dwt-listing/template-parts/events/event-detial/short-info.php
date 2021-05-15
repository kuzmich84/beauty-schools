<?php global $dwt_listing_options;
	$event_id	=	get_the_ID();
	$listing_features = wp_get_object_terms( $event_id,  array('l_event_cat'), array('orderby' => 'name' , 'order' => 'ASC') );
?>
<div class="col-md-4 col-sm-5 col-xs-12 sticky-event">
    <div class="theiaStickySidebar">
        <div class="event-short-info">
            <h4 class="course-title"><?php echo esc_html__('Event Details','dwt-listing'); ?></h4>
            <ul>
            	<?php if(get_post_meta($event_id, 'dwt_listing_event_start_date', true) != "") { ?>
                <li data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__('Event start date','dwt-listing'); ?>">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                    <span><?php echo date_i18n( get_option( 'date_format'),  strtotime(get_post_meta($event_id, 'dwt_listing_event_start_date', true)) ); ?></span>
                </li>
                <?php } ?>
                <?php if(get_post_meta($event_id, 'dwt_listing_event_end_date', true) != "") { ?>
                <li data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__('Event end date','dwt-listing'); ?>">
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                    <span><?php echo date_i18n( get_option( 'date_format'),  strtotime(get_post_meta($event_id, 'dwt_listing_event_end_date', true)) ); ?></span>
                </li>
                 <?php } ?>
                 <?php
				 if(isset($listing_features) && $listing_features !="")
				 {
			 		if ( ! is_wp_error( $listing_features ) ) {
						foreach( $listing_features as $term )
						{
							$link = dwt_listing_pagelink('dwt_listing_event_page').'?event_cat='.$term->slug;
				 ?>
                <li data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__('Event category','dwt-listing'); ?>">
                    <i class="fa fa-filter" aria-hidden="true"></i>
                    <span><a href="<?php echo esc_url($link); ?>"><?php echo esc_attr($term->name); ?></a></span>
                </li>
                <?php break; } } } ?>
                <?php if(get_post_meta($event_id, 'dwt_listing_event_listing_id', true) !="") { ?>
                <li data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__('Related listings','dwt-listing'); ?>">
                    <i class="fa fa-external-link" aria-hidden="true"></i>
                    <span><a href="<?php echo get_permalink(get_post_meta($event_id, 'dwt_listing_event_listing_id', true)); ?>" target="_blank"><?php echo esc_html__('View Listing','dwt-listing'); ?></a></span>
                </li>
                <?php } ?>
                <?php if(get_post_meta($event_id, 'dwt_listing_event_email', true) !="") { ?>
                <li>
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <span><a href="mailto:<?php echo esc_url(get_post_meta($event_id, 'dwt_listing_event_email', true)); ?>"><?php echo esc_html__('Contact Email','dwt-listing'); ?></a> </span>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
