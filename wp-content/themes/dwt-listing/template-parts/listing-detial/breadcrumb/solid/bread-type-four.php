<?php global $dwt_listing_options;?>
<section class="transparent-breadcrumb-listing bread-type-4">
 <div class="container">
    <div class="row">
       <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="small-breadcrumb">
          <div class="header-page">
                  <h1> <?php echo dwt_listing_bread_crumb_heading(); ?></h1>
             </div>
             <div class="breadcrumb-link">
                <ul>
                    <li>                       
                        <a href="<?php echo home_url( '/' ); ?>"><?php echo esc_html__('Home', 'dwt-listing' ); ?> </a>
                    </li>
                    <li class="active">
                        <a href="javascript:void(0)" class="active"> <?php echo dwt_listing_page_breadcrumb(); ?></a>
                    </li>
               </ul>
             </div>
			  
          </div>
       </div>
    </div>
 </div>
</section>