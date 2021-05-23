<?php

add_action( 'after_setup_theme', 'my_child_theme_setup' );
function my_child_theme_setup(){
    load_child_theme_textdomain( 'dwt-listing', get_stylesheet_directory() . '/languages' );

    function theme_register_nav_menu() {
        register_nav_menu( 'primary', 'Primary Menu' );
    }
}

add_action( 'wp_enqueue_scripts', 'dwt_listing_child_scripts' );
function dwt_listing_child_scripts(){
    wp_enqueue_style( 'style-suggestions', 'https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/css/suggestions.min.css');
    wp_enqueue_style('parent-theme-css', get_template_directory_uri() .'/style.css' );
    wp_enqueue_style('udemy-css', get_stylesheet_directory_uri().'/assets/css/style.css');

    wp_enqueue_script( 'jquery-ajax--script', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', '', '', true);
    wp_enqueue_script( 'suggestions-jquery', 'https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/js/jquery.suggestions.min.js','', '', true);
    wp_enqueue_script( 'dadata-script', get_stylesheet_directory_uri().'/scripts/dadata.js', '', '', true);
    wp_enqueue_script( 'my-custom-script', get_stylesheet_directory_uri().'/scripts/my-custom.js', '', '', true);


    /**
     * Подключеам скрипт yandex карты
     */

    global $dwt_listing_options;

    if ($dwt_listing_options["dwt_listing_enable_map"] == "1" && $dwt_listing_options["dwt_map_selection"] == "yandex_map" && $dwt_listing_options["yandex_api_key"] != "") {
        $map_lang = "en_US";
        if (isset($dwt_listing_options["dwt_listing_yandex_lang"]) && $dwt_listing_options["dwt_listing_yandex_lang"] != "") {
            $map_lang = $dwt_listing_options["dwt_listing_yandex_lang"];
        }
        wp_enqueue_script("yandex-map", "https://api-maps.yandex.ru/2.1/?apikey=". $dwt_listing_options["yandex_api_key"]."&lang=". $map_lang , false, false, false);
        //call back
//        wp_register_script("google-map-callback", "//maps.googleapis.com/maps/api/js?key=" . $dwt_listing_options["gmap_api_key"] . "&libraries=geometry,places&language=" . $map_lang . "&callback=" . "dwt_listing_location", false, false, true);
    }
    wp_enqueue_script("getYandexMap", get_stylesheet_directory_uri().'/scripts/yandex-map.js', false, false, false);

}

/**
 * Функция проверяющая роль пользователя
 */

function is_user_role( $role, $user_id = null ) {
    $user = is_numeric( $user_id ) ? get_userdata( $user_id ) : wp_get_current_user();

    if( ! $user )
        return false;

    return in_array( $role, (array) $user->roles );
}


/**
 * Добавляет новую роль student
 */

//
// Удаляем роль при деактивации нашей темы

add_action( 'switch_theme', 'deactivate_dwt_listing_child' );
function deactivate_dwt_listing_child() {
    remove_role( 'student' );
}

// Добавляем роль при активации нашей темы
add_action( 'after_switch_theme', 'activate_dwt_listing_child' );
function activate_dwt_listing_child() {


    add_role( 'student', 'Студент', array(
        'read'            => true, // Allows a user to read
        'create_posts'      => true, // Allows user to create new posts
        'edit_posts'        => true, // Allows user to edit their own posts
        'edit_others_posts' => false, // Allows user to edit others posts too
        'publish_posts' => true, // Allows the user to publish posts
        'manage_categories' => true, // Allows user to manage post categories
    ));
}


/**
 * Класс для кастомизации вывода категорий
 */

