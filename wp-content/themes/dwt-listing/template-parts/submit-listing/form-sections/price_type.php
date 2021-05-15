<?php if ($price_range == "yes") { ?> 
    <div class="submit-listing-section l_price_form">
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div id="pricing-fields">
                    <div class="row">
                        <div class="col-md-7 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label class="control-label"><?php echo dwt_listing_text('dwt_listing_list_pricetype'); ?></label>
                                <select data-placeholder="<?php echo esc_html__('Select Price Type', 'dwt-listing'); ?>" class="custom-select" name="listing_price_type">
                                    <?php echo '' . $price_type_html; ?>
                                </select>
                                <div class="help-block"></div>
                            </div>


                            <div class="form-group">
                                <label class="control-label"><?php echo dwt_listing_text('dwt_listing_list_currenct'); ?></label>
                                <select data-placeholder="<?php echo esc_html__('Select Currency Type', 'dwt-listing'); ?>" class="custom-select" name="listing_currency_type">
                                    <?php echo '' . $listing_currency_html; ?>
                                </select>
                                <div class="help-block"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"><?php echo dwt_listing_text('dwt_listing_list_price_from'); ?></label>
                                        <input type="number" class="form-control" name="listing_pricefrom" value="<?php echo esc_attr($listing_price_from); ?>">
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label class="control-label"><?php echo dwt_listing_text('dwt_listing_list_price_to'); ?></label>

                                        <input type="number" class="form-control" name="listing_priceto" value="<?php echo esc_attr($listing_price_to); ?>">

                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div  class="col-md-5 col-xs-12 col-sm-12 hidden-sm">
                            <div class="submit-post-img-container">
                                <img class="img-responsive" src="<?php echo esc_url(trailingslashit(get_template_directory_uri()) . 'assets/images/submit-post-pricing.jpg'); ?>" alt="<?php echo esc_html__('image not found', 'dwt-listing'); ?>">
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>   
<?php } ?>  