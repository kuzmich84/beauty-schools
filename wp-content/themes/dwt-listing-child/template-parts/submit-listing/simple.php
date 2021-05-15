<div class="col-md-10 col-xs-12 col-sm-12 col-md-offset-1">
    <form id="listing-form" data-disable="false" method="post">
        <div class="preloading" id="dwt_listing_loading"></div>
        <?php
        global $dwt_listing_options;
        $layout = $dwt_listing_options['dwt_listing_form-layout-manager']['enabled'];
        if ($layout): foreach ($layout as $key => $value) {
                switch ($key) {
                    case 'title_cat': require trailingslashit(get_template_directory()) . 'template-parts/submit-listing/form-sections/title_cats.php';
                        break;
                    case 'price_type': require trailingslashit(get_template_directory()) . 'template-parts/submit-listing/form-sections/price_type.php';
                        break;
                    case 'buiness_hours': require trailingslashit(get_template_directory()) . 'template-parts/submit-listing/form-sections/hours.php';
                        break;
                    case 'social_links': require trailingslashit(get_template_directory()) . 'template-parts/submit-listing/form-sections/social_links.php';
                        break;
                    case 'desc_sec': require trailingslashit(get_template_directory()) . 'template-parts/submit-listing/form-sections/desc_sec.php';
                        break;
                    case 'coupon': require trailingslashit(get_template_directory()) . 'template-parts/submit-listing/form-sections/coupon_sec.php';
                        break;
                    case 'location': require trailingslashit(get_template_directory()) . 'template-parts/submit-listing/form-sections/location_sec.php';
                        break;
                }
            }
        endif;
        ?>
        <input type="hidden" id="dictDefaultMessage" value="<?php echo dwt_listing_text('dwt_listing_list_gallery_desc'); ?>" />
        <input type="hidden" id="dictFallbackMessage" value="<?php echo esc_html__('Your browser does not support drag\'n\'drop file uploads', 'dwt-listing'); ?> "/>
        <input type="hidden" id="dictFallbackText" value="<?php echo esc_html__('Please use the fallback form below to upload your files like in the olden days', 'dwt-listing'); ?> "/>
        <input type="hidden" id="dictFileTooBig" value="<?php echo esc_html__('File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB', 'dwt-listing'); ?>" />
        <input type="hidden" id="dictInvalidFileType" value="<?php echo esc_html__('You can\'t upload files of this type', 'dwt-listing'); ?>" />
        <input type="hidden" id="dictResponseError" value="<?php echo esc_html__('Server responded with {{statusCode}} code', 'dwt-listing'); ?>" />
        <input type="hidden" id="dictCancelUpload" value="<?php echo esc_html__('Cancel upload', 'dwt-listing'); ?>" />
        <input type="hidden" id="dictCancelUploadConfirmation" value="<?php echo esc_html__('Are you sure you want to cancel this upload?', 'dwt-listing'); ?>" />
        <input type="hidden" id="dictRemoveFile" value="<?php echo esc_html__('Remove file', 'dwt-listing'); ?>" />
        <input type="hidden" id="dictMaxFilesExceeded" value="<?php echo esc_html__('You can not upload any more files', 'dwt-listing'); ?>" />
        <input type="hidden" id="gallery_upload_limit" value="<?php echo esc_attr($number_of_images); ?>" />
        <input type="hidden" id="gallery_img_size" value="<?php echo esc_attr($dwt_listing_options['dwt_listing_image_up_size']); ?>" />
        <input type="hidden" id="gallery_upload_reach" value="<?php echo __('Maximum upload limit reached', 'dwt-listing'); ?>" />
       <?php dwt_listing_form_lang_field_callback(true); ?>
    </form>
</div>