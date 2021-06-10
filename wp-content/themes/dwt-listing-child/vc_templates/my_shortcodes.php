<?php
$args = array(
    'title_value' => '',
    'join_text' => '',
    'text_btn' => ''

);

$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$css = '';
extract(shortcode_atts(array(
    'css' => ''
), $atts));
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' '), $this->settings['base'], $atts);
?>

<section class="home-five bg-img5 <?php echo esc_attr($css_class); ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="home5_slider">
                    <div class="item">
                        <div class="home-text">
                            <h2><span class="text-thm"><?php echo esc_attr($title_value); ?></span></h2>
                            <p><?php echo esc_attr($join_text); ?></p>
                            <a class="btn home_btn" href="#"><?php echo esc_attr($text_btn); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>