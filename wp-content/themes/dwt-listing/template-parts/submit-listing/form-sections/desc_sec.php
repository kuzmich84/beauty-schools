<?php
$my_class = 'none';
$cover_brand_idz = $get_brand_img = '';
$remove_class = 'hide';
$get_brand_img = dwt_listing_get_brand_img($listing_id,'dwt_listing_list-view1');
if(get_post_meta($listing_id, 'dwt_listing_brand_img', true) != "")
{
	$remove_class = '';
	$cover_brand_idz = get_post_meta($listing_id, 'dwt_listing_brand_img', true);
}
?>
<div class="submit-listing-section">
	<div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div class="form-group has-feedback">
                <label class="control-label"><?php echo dwt_listing_text('dwt_listing_list_desc');?><span>*</span></label>
                <textarea name="listing_desc" class="jqte-test" required><?php echo esc_textarea($listing_desc); ?></textarea>
                <div class="help-block"></div>
              </div>
        </div>
        <?php if($video_listing == "yes") { ?>
           <div class="col-md-6 col-xs-12 col-sm-6 l_video_form">
            <div class="form-group">
                <label class="control-label"><?php echo dwt_listing_text('dwt_listing_list_video');?></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="ti-video-camera"></i></span>
                  <input type="text" class="form-control tool-tip" name="listing_videolink" title="<?php echo dwt_listing_text('dwt_listing_list_video_tool');?>" placeholder="<?php echo dwt_listing_text('dwt_listing_list_video_place');?>" value="<?php echo esc_attr($listing_video); ?>">
                </div>
                <div class="help-block"></div>
            </div>
            </div>
        <?php } ?>
        <div class="col-md-6 col-xs-12 col-sm-6 l_user_email">
            <div class="form-group">
                <label class="control-label"><?php echo dwt_listing_text('dwt_listing_contact_email');?></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="ti-email"></i></span>
                  <input type="text" class="form-control tool-tip" name="listing_contact_email" title="<?php echo dwt_listing_text('dwt_listing_contact_email_tooltip');?>" placeholder="<?php echo dwt_listing_text('dwt_listing_contact_email_placeholder');?>" value="<?php echo sanitize_email($listing_contact_email); ?>">
                </div>
                <div class="help-block"></div>
            </div>
         </div>
        <?php if($allow_tags == "yes") { ?>
       	 <div class="col-md-12 col-xs-12 col-sm-12 l_tags_form">
                <div class="form-group">
                    <label class="control-label"><?php echo dwt_listing_text('dwt_listing_list_tags');?></label>
                    <textarea  class="form-control" placeholder="<?php echo dwt_listing_text('dwt_listing_list_tags_place');?>" name="listing_tags" id="listing_tags"><?php echo esc_attr($listing_tags); ?></textarea>
                    <div class="help-block"></div>
                </div>
         </div>
        <?php } ?>  
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div class="form-group">
                <label class="control-label"><?php echo dwt_listing_text('dwt_listing_list_gallery');?></label>
                <div id="dropzone" class="dropzone upload-ad-images"></div>
            </div>
            
        <div class="clearfix"></div>
        <div id="listing_msgz" class="alert custom-alert custom-alert--warning none" role="alert">
<div class="custom-alert__top-side">
<span class="alert-icon custom-alert__icon  ti-face-sad "></span>
<div class="custom-alert__body">
<h6 class="custom-alert__heading">
<?php echo esc_html__('Whoops.....!', 'dwt-listing'); ?>
</h6>
<div class="custom-alert__content"></div>
</div>
</div>
</div>
        </div>
        <div class="clearfix"></div>
        <?php 
		if( dwt_listing_text('dwt_listing_lp_style') == 'minimal')
		{
		    $cover_idz = $get_cover_img = '';
			$remove_class = 'hide';
			$get_cover_img = dwt_listing_get_cover_img($listing_id,'full');
			if(get_post_meta($listing_id, 'dwt_listing_cover_photo', true) != "")
			{
				$cover_idz = get_post_meta($listing_id, 'dwt_listing_cover_photo', true);
				$remove_class = '';
			}
		?>
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div class="form-group has-feedback">
                <label class="control-label"><?php echo dwt_listing_text('dwt_listing_list_cover');?></label>
                <div class="avatar-upload-cover">
        <div class="avatar-edit">
            <input type='file' id="imageUpload" class="c-cover-listing" name="c-cover-listing[]" accept=".jpg,.jpeg,.png" />
            <label for="imageUpload"></label>
            <label data-cover-id=<?php echo esc_attr($cover_idz);?> id="c-del" class="<?php echo esc_attr($remove_class); ?> c-delete" for="c-delete"></label>
        </div>
        <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url(<?php echo esc_url($get_cover_img); ?>);">
            </div>
        </div>
        <?php if(dwt_listing_text('dwt_listing_list_cover_reco') !="") { ?>
        <span><small><?php echo dwt_listing_text('dwt_listing_list_cover_reco');?></small></span>
        <?php } ?>
    </div>
              </div>
        </div>
        <?php
		}
		?>
        <div class="col-md-6 col-xs-12 col-sm-6 l_bname_form">
            <div class="form-group">
                <label class="control-label"><?php echo dwt_listing_text('dwt_listing_b_title');?></label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="ti-layers"></i></span>
                  <input type="text" class="form-control" name="listing_brandname" placeholder="<?php echo dwt_listing_text('dwt_listing_b_placetitle');?>" value="<?php echo esc_attr($listing_brandname); ?>">
                </div>
                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 col-sm-6 l_blogo_form">
            <div class="form-group">
                <label class="control-label"><?php echo dwt_listing_text('dwt_listing_brand_name_logo');?></label>
				<div class="avatar-or-brand">
               <div class="s-spinner <?php echo esc_attr($my_class); ?>">
                   <i class="fa fa-spinner fa-spin"></i>
               </div>
                    <div class="avatar-edit">
                        <input type='file' id="brand_logos_upload"  class="c-cover-brand" name="c-cover-brand[]"  accept=".png, .jpg, .jpeg" />
                        <label for="brand_logos_upload"></label>
                        <label data-brand-cover-id="<?php echo esc_attr($cover_brand_idz);?>" id="brand-del" class="<?php echo esc_attr($remove_class); ?> brand-delete" for="brand-delete"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="brand_imagePreview" style="background-image: url(<?php echo esc_url($get_brand_img); ?>);">
                        </div>
                    </div>
    		  </div>
            </div>
        </div>
    </div>
</div>