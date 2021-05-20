<?php $action = dwt_listing_pagelink('dwt_listing_seacrh_page'); ?>
<?php
global $dwt_listing_options;
$no_left = '';
if (isset($dwt_listing_options["dwt_listing_header-btn"]) && $dwt_listing_options["dwt_listing_header-btn"] == "0") {
    $no_left = 'no-left-p';
}
$by_title = '';
if (isset($_GET['by_title']) && $_GET['by_title'] != "") {
    $by_title = $_GET['by_title'];
}
get_template_part('template-parts/header/topbar');
?>
<div class="header-type-3">
    <section class="header-top">
        <div class="container-fluid">
            <div class="row">
                <nav id="menu-1" class="mega-menu">
                    <div class="menu-list-items">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <?php echo dwt_listing_site_logo('1'); ?>
                            <ul>
                                <li class="list-inline-item">
                                    <div class="header_top_lang_widget">
                                        <div class="ht-widget-container">
                                            <div class="vertical-wrapper">
                                                <h2 class="title-vertical home3">
                                                    <span class="text-title">Категории</span> <i class="fa fa-angle-down show-down" aria-hidden="true"></i>
                                                </h2>
                                                <div class="content-vertical home3">
                                                    <ul id="vertical-menu" class="mega-vertical-menu nav navbar-nav">
                                                        <li><a href="#">Development</a></li>
                                                        <li><a href="#">Business</a></li>
                                                        <li><a href="#">IT &amp; Software</a></li>
                                                        <li>
                                                            <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Design <b class="caret"></b></a>
                                                            <div class="dropdown-menu vertical-megamenu">
                                                                <div class="dropdown-menu-inner">
                                                                    <div class="element-inner">
                                                                        <div class="element-section-wrap">
                                                                            <div class="element-container">
                                                                                <div class="element-row">
                                                                                    <div class="col-lg-2">
                                                                                        <div class="row">
                                                                                            <div class="col-lg-6">
                                                                                                <div class="element-wrapper">
                                                                                                    <div class="widget-nav-menu">
                                                                                                        <div class="element-list-wrapper wn-menu">
                                                                                                            <ul class="element-menu-list">
                                                                                                                <li><a href="#">Color</a></li>
                                                                                                                <li><a href="#">Digital Painting</a></li>
                                                                                                                <li><a href="#">Drawing</a></li>
                                                                                                                <li><a href="#">Illustration</a></li>
                                                                                                                <li><a href="#">Logo Design</a></li>
                                                                                                                <li><a href="#">User Experience</a></li>
                                                                                                                <li><a href="#">Web Design</a></li>
                                                                                                            </ul>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="element-warapper-btn">
                                                                                                        <a href="#"><div class="element-wrapper-sub-title">See All <i class="flaticon-right-arrow-1"></i></div></a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li><a href="#">Marketing</a></li>
                                                        <li><a href="#">Lifestyle</a></li>
                                                        <li><a href="#">Photography</a></li>
                                                        <li><a href="#">Education + Elearning</a></li>
                                                        <li><a href="#">Music</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <form action="<?php echo esc_attr($action); ?>" class="custom-style-search top-search-form">
                                <div class="form-group">
                                    <div class="typeahead__container">
                                        <div class="typeahead__field">
                                            <div class="typeahead__query">
                                                <input value="<?php echo esc_attr($by_title); ?>" autocomplete="off"
                                                       type="search" class="for_sp_home dwt-search form-control"
                                                       placeholder="<?php echo esc_html__('What Are You Looking For?', 'dwt-listing'); ?>">
                                            </div>
                                            <div class="typeahead__button">
                                                <button type="submit">
                                                    <span class="typeahead__search-icon"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input id="by_title_home" type="hidden" name="by_title" value="">
                                <input id="l_category_home" type="hidden" name="l_category" value="">
                                <input id="l_tag_home" type="hidden" name="l_tag" value="">
                            </form>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <ul class="menu-links"><?php dwt_listing_themeMenu('main_menu'); ?> </ul>
                            <div class="header-top-profile">
                                <ul class="menu-button pull-right <?php echo esc_attr($no_left); ?>"><?php echo dwt_listing_header_profile_menu('3'); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>
</div>