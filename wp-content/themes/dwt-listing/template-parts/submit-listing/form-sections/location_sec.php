<?php
$location_icon = $check_class = $my_id = '';
if (dwt_listing_text('dwt_listing_enable_geo') == '1' && dwt_listing_text('dwt_map_selection') == 'open_street') {
    $check_class = 'get-loc';
    $location_icon = '<i class="detect-me fa fa-crosshairs"></i>';
}
?>    
<div class="submit-listing-section l_placeholder_form">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div class="form-group <?php echo esc_attr($check_class); ?>">
                <label class="control-label "><?php echo dwt_listing_text('dwt_listing_list_google_loc'); ?><span>*</span></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="ti-location-pin"></i></span>
                    <input type="text" class="form-control tool-tip" id="address_location" name="listing_streetAddress" title="<?php echo dwt_listing_text('dwt_listing_list_google_loc_tool'); ?>" placeholder="<?php echo dwt_listing_text('dwt_listing_list_google_loc_place'); ?>" value="<?php echo esc_attr($listing_street); ?>" required>
                    <?php echo $location_icon; ?>
                </div>
                <div class="help-block"></div>
            </div>
        </div>
        <?php
        if (dwt_listing_text('dwt_listing_enable_map') == "1") {
            if (dwt_listing_text('dwt_map_selection') == "google_map" && dwt_listing_text('gmap_api_key') != "") {
                require trailingslashit(get_template_directory()) . 'template-parts/submit-listing/form-sections/google_map.php';
            } else {
                require trailingslashit(get_template_directory()) . 'template-parts/submit-listing/form-sections/open_street.php';
            }
        }
        ?>
        <?php if (dwt_listing_text('dwt_listing_allow_country_location') == '1') { ?>     
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="form-group has-feedback">
                    <label class="control-label"><?php echo esc_attr($loc_lvl_1); ?><span>*</span></label>
                    <select data-placeholder="<?php echo esc_html__('Select Your Country', 'dwt-listing'); ?>" class="custom-select" id="d_country" name="d_country" required >

    <?php echo '' . $country_html; ?>
                    </select>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-6 <?php echo esc_attr($class_two); ?>" id="states">
                <div class="form-group">
                    <label class="control-label"><?php echo esc_attr($loc_lvl_2); ?></label>
                    <select data-placeholder="<?php echo esc_html__('Select Your State', 'dwt-listing'); ?>" class="custom-select" id="d_state" name="d_state"><?php echo '' . $state_html; ?></select>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-6 <?php echo esc_attr($class_three); ?>" id="city">
                <div class="form-group">
                    <label class="control-label"><?php echo esc_attr($loc_lvl_3); ?></label>
                    <select data-placeholder="<?php echo esc_html__('Select Your City', 'dwt-listing'); ?>" class="custom-select" id="d_city" name="d_city"><?php echo '' . $cities_html; ?></select>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 col-sm-6 <?php echo esc_attr($class_four); ?>" id="town">
                <div class="form-group">
                    <label class="control-label"><?php echo esc_attr($loc_lvl_4); ?></label>
                    <select data-placeholder="<?php echo esc_html__('Select Your Town', 'dwt-listing'); ?>" class="custom-select" id="d_town" name="d_town"><?php echo '' . $towns_html; ?></select>
                </div>
            </div>
<?php } ?>
        <input type="hidden" id="is_update" name="is_update" value="<?php echo esc_attr($is_update); ?>">
        <input type="hidden" id="is_selective" name="is_selective" value="<?php echo esc_attr($listing_is_opened); ?>">
        <?php
        //check user have featured ads
        if ($featured_listing == '-1' || $featured_listing > 0 && $listing_is_feature != '1') {
            echo "<div class='col-md-12 for_featured_list'><div class='alert custom-alert custom-alert--warning' role='alert'><div class='custom-alert__top-side'><span class='alert-icon custom-alert__icon  ti-help-alt'></span><div class='custom-alert__body'><h6 class='custom-alert__heading'>" . esc_html__("Do you want to make this listing featured!", "dwt-listing") . "<input type='checkbox' name='make_listing_featured' id='make_listing_featured' value='1' class='custom-checkbox'></h6></div></div></div></div>";
        }
        // if current listing is already featured
        if ($listing_is_feature == '1') {
            echo "<div class='col-md-12 for_featured_list'><div class='alert custom-alert custom-alert--info' role='alert'><div class='custom-alert__top-side'><span class='alert-icon custom-alert__icon ti-bell'></span><div class='custom-alert__body'><h6 class='custom-alert__heading'>" . esc_html__("This listing is already featured.", "dwt-listing") . "</h6></div></div></div></div>";
        }
        ?>

        <?php
        if (isset($_GET['listing_id']) && $_GET['listing_id'] != "") {
            //check user have bump listings
            if ($listing_bump_amount == '-1' || $listing_bump_amount > 0) {
                echo "<div class='col-md-12 for_featured_list margin-10'><div class='alert custom-alert custom-alert--danger' role='alert'><div class='custom-alert__top-side'><span class='alert-icon custom-alert__icon  ti-reload'></span><div class='custom-alert__body'><h6 class='custom-alert__heading'>" . esc_html__("Do you want to bump this listing!", "dwt-listing") . "<input type='checkbox' name='make_listing_bump' id='make_listing_bump' value='1' class='custom-checkbox'></h6></div></div></div></div>";
            }
        }
        ?>  
        <div  class="col-md-12 col-xs-12 col-sm-12">
            <div class="submit-post-button">
        <?php
        if (dwt_listing_text('dwt_listing_disable_edit') == '1' && !is_super_admin(get_current_user_id())) {
            echo '<button type="button" class="btn btn-theme tool-tip" title="' . esc_html__('Disable for Demo', 'dwt-listing') . '" disabled> ' . esc_html__('Save & preview', 'dwt-listing') . ' </button>';
        } else {
            ?>
                    <button type="submit" class="btn btn-theme sonu-button"  data-loading-text="<i class='fa fa-spinner fa-spin '></i> <?php echo esc_html__("Processing...", 'dwt-listing'); ?>"><?php echo dwt_listing_text('dwt_listing_list_form_btn'); ?></button>
<?php } ?>
            </div>
        </div>
    </div>
</div>