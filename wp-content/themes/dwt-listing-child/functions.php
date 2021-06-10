<?php

define('WPEDUMY_DIR_JS', get_stylesheet_directory_uri() . '/assets/js');
define('WPEDUMY_DIR_CSS', get_stylesheet_directory_uri() . '/assets/css');

add_action('after_setup_theme', 'my_child_theme_setup');
function my_child_theme_setup()
{
    load_child_theme_textdomain('dwt-listing', get_stylesheet_directory() . '/languages');

    function theme_register_nav_menu()
    {
        register_nav_menu('primary', 'Primary Menu');
    }
}

add_action('wp_enqueue_scripts', 'dwt_listing_child_scripts');
function dwt_listing_child_scripts()
{
    wp_enqueue_style('style-suggestions', 'https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/css/suggestions.min.css');
    wp_enqueue_style('parent-theme-css', get_template_directory_uri() . '/style.css');
//    wp_enqueue_style('udemy-bootstrap-4-6-css', WPEDUMY_DIR_CSS . '/bootstrap-4-6.min.css');
    wp_enqueue_style('udemy-css', WPEDUMY_DIR_CSS . '/style.css');

    wp_enqueue_script('jquery-ajax--script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', '', '', true);
    wp_enqueue_script('suggestions-jquery', 'https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/js/jquery.suggestions.min.js', '', '', true);
    wp_enqueue_script('dadata-script', get_stylesheet_directory_uri() . '/scripts/dadata.js', '', '', true);
    wp_enqueue_script('my-custom-script', get_stylesheet_directory_uri() . '/scripts/my-custom.js', '', '', true);


    // Подключение скриптов Edumy
//    wp_enqueue_script('edumy-jquery-bootstrap-4-6-script', WPEDUMY_DIR_JS . '/bootstrap-4-6.min.js', '', '', true);
//    wp_enqueue_script('edumy-jquery-migrate-3-0-0-script', WPEDUMY_DIR_JS . '/jquery-migrate-3.0.0.min.js', '', '', true);
//    wp_enqueue_script('edumy-popper-script', WPEDUMY_DIR_JS . '/popper.min.js', '', '', true);
//    wp_enqueue_script('edumy-jquery.mmenu-script', WPEDUMY_DIR_JS . '/jquery.mmenu.all.js', ['jquery'], '', true);
//    wp_enqueue_script('edumy-ace-responsive-menu-script', WPEDUMY_DIR_JS . '/ace-responsive-menu.js', '', '', true);
//    wp_enqueue_script('bootstrap-select-script', WPEDUMY_DIR_JS . '/bootstrap-select.min.js', '', '', true);
//    wp_enqueue_script('edumy-isotop-script', WPEDUMY_DIR_JS . '/isotop.js', '', '', true);
//    wp_enqueue_script('edumy-snackbar-script', WPEDUMY_DIR_JS . '/snackbar.min.js', '', '', true);
//    wp_enqueue_script('edumy-simplebar-script', WPEDUMY_DIR_JS . '/simplebar.js', '', '', true);
//    wp_enqueue_script('edumy-parallax-script', WPEDUMY_DIR_JS . '/parallax.js', '', '', true);
//    wp_enqueue_script('edumy-scrollto-script', WPEDUMY_DIR_JS . '/scrollto.js', '', '', true);
//    wp_enqueue_script('edumy-jquery-scrolltofixed-script', WPEDUMY_DIR_JS . '/jquery-scrolltofixed-min.js', ['jquery'], '', true);
//    wp_enqueue_script('edumy-jquery-counterup-script', WPEDUMY_DIR_JS . '/jquery.counterup.js',['jquery'], '', true);
//    wp_enqueue_script('edumy-wow-script', WPEDUMY_DIR_JS . '/wow.min.js', '', '', true);
//    wp_enqueue_script('edumy-progressbar-script', WPEDUMY_DIR_JS . '/progressbar.js', '', '', true);
//    wp_enqueue_script('edumy-slider-script', WPEDUMY_DIR_JS. '/slider.js', ['jquery'], '', true);
//    wp_enqueue_script('edumy-timepicker-script', WPEDUMY_DIR_JS . '/timepicker.js', '', '', true);
//    wp_enqueue_script('edumy-script', WPEDUMY_DIR_JS . '/script.js', ['jquery'], '', true);

    /**
     * Подключеам скрипт yandex карты
     */

    global $dwt_listing_options;

    if ($dwt_listing_options["dwt_listing_enable_map"] == "1" && $dwt_listing_options["dwt_map_selection"] == "yandex_map" && $dwt_listing_options["yandex_api_key"] != "") {
        $map_lang = "en_US";
        if (isset($dwt_listing_options["dwt_listing_yandex_lang"]) && $dwt_listing_options["dwt_listing_yandex_lang"] != "") {
            $map_lang = $dwt_listing_options["dwt_listing_yandex_lang"];
        }
        wp_enqueue_script("yandex-map", "https://api-maps.yandex.ru/2.1/?apikey=" . $dwt_listing_options["yandex_api_key"] . "&lang=" . $map_lang, false, false, false);
        //call back
//        wp_register_script("google-map-callback", "//maps.googleapis.com/maps/api/js?key=" . $dwt_listing_options["gmap_api_key"] . "&libraries=geometry,places&language=" . $map_lang . "&callback=" . "dwt_listing_location", false, false, true);
    }
    wp_enqueue_script("getYandexMap", get_stylesheet_directory_uri() . '/scripts/yandex-map.js', false, false, false);

}

/**
 * Функция проверяющая роль пользователя
 */

function is_user_role($role, $user_id = null)
{
    $user = is_numeric($user_id) ? get_userdata($user_id) : wp_get_current_user();

    if (!$user)
        return false;

    return in_array($role, (array)$user->roles);
}


/**
 * Добавляет новую роль student
 */

//
// Удаляем роль при деактивации нашей темы

add_action('switch_theme', 'deactivate_dwt_listing_child');
function deactivate_dwt_listing_child()
{
    remove_role('student');
}

// Добавляем роль при активации нашей темы
add_action('after_switch_theme', 'activate_dwt_listing_child');
function activate_dwt_listing_child()
{


    add_role('student', 'Студент', array(
        'read' => true, // Allows a user to read
        'create_posts' => true, // Allows user to create new posts
        'edit_posts' => true, // Allows user to edit their own posts
        'edit_others_posts' => false, // Allows user to edit others posts too
        'publish_posts' => true, // Allows the user to publish posts
        'manage_categories' => true, // Allows user to manage post categories
    ));
}


/**
 * Создание своего виджета в WpBackery
 */

if (class_exists("WPBakeryShortCode")) {
    // Class Name should be WPBakeryShortCode_Your_Short_Code
    // See more in vc_composer/includes/classes/shortcodes/shortcodes.php
    class WPBakeryShortCode_My_Shortcodes extends WPBakeryShortCode
    {
    }
}

if (function_exists('vc_map')) {
    vc_map(array(
            'name' => __('Edumy Home Join', 'edumy'),
            // shortcode name

            'base' => 'my_shortcodes',
            // shortcode base [test_element]

            'category' => __('Edumy Home', 'edumy'),
            // param category tab in add elements view

            'description' => __('Create join section on home page', 'edumy'),
            // element description in add elements view

            'show_settings_on_create' => true,
            // don't show params window after adding

            'icon' => 'icon-vc-edumy',


            'weight' => -5,
            // Depends on ordering in list, Higher weight first


            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Text title", "edumy"),
                    "param_name" => "title_value",
                    "description" => __("Enter text title.", "edumy")
                ),
                array(
                    "type" => "textarea",
                    "heading" => __("Text Join", "edumy"),
                    "param_name" => "join_text",
                    "description" => __("Enter text", "edumy")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Text btn", "edumy"),
                    "param_name" => "text_btn",
                    "description" => __("Enter text btn.", "edumy")
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => __( 'Css', 'edumy'),
                    'param_name' => 'css',
                    'group' => __( 'Design options', 'edumy' ),
                ),
            )
        )
    );
}
