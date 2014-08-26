<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


/************************************************************/
/* Define Theme's Constants */
/************************************************************/
define('THEMEROOT', get_stylesheet_directory_uri());

define('IMAGES', THEMEROOT . '/assets/img');

if ( !defined( 'LANGUAGE_ZONE' ) ) {
    define( 'LANGUAGE_ZONE', 'roua' );
}

if ( !defined( 'LANGUAGE_ZONE_ADMIN' ) ) {
    define( 'LANGUAGE_ZONE_ADMIN', 'roua' );
}


/************************************************************/
/* Theme Setup Function */
/************************************************************/
add_action( 'after_setup_theme', 'roua_theme_setup' );

function roua_theme_setup() {

    // Load textdomain for translation
    load_theme_textdomain( 'roua', get_template_directory() . '/lang' );

    // Set a max with for the uploaded images.
    if (!isset($content_width)) $content_width = 1028;


    // Add Theme Support for Post Formats, Post Thumbnails and Automatic Feed Links
    if (function_exists('add_theme_support')) {


        // This theme supports a variety of post formats
        add_theme_support('post-formats', array());


        // Add theme support for post-thumbnails & declare its size
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(350, 350, true);


        // Adds RSS feed links to <head> for posts and comments
        add_theme_support( 'automatic-feed-links' );


        // This theme styles the visual editor with editor-style.css to match the theme style
        add_editor_style();


        // Add special field to image for audio/video post
        //add_filter( 'attachment_fields_to_edit', 'zen_attachment_fields_to_edit', 10, 2 );
        //add_action( 'edit_attachment', 'zen_save_attachment_fields' );

    }


    if ( function_exists( 'add_image_size' ) ) {

        add_image_size('blog_image_1', 300, 300, true);

        add_image_size('portfolio', 650, 650, true);

        add_image_size('clients', 613, 407, true);

        add_image_size('employee', 480, 584, true);

    }


    // Load custom Scripts and Styles for Haze.
    add_action('wp_enqueue_scripts', 'clubix_load_custom_scripts');
    add_action('wp_enqueue_scripts', 'clubix_load_custom_styles');


    // Set widgets to accept shortcodes
    add_filter('widget_text', 'do_shortcode');


    // Comments filters
    add_filter('comment_form_defaults', 'zen_custom_comment_form');
    add_filter('comment_form_default_fields', 'zen_custom_comment_fields');


    // Register Menus
    add_action('init', 'haze_register_my_menus');


    // Add Google Analytics
    add_action('wp_head','zen_google_analytics');


    // TODO: Nu uita sa scoti asta
    //add_filter('show_admin_bar', '__return_false');

}


/************************************************************/
/* Theme Scripts Function */
/************************************************************/
function clubix_load_custom_scripts() {

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrapJS', THEMEROOT . '/assets/js/bootstrap.min.js', array(), '1.0', true);
    wp_enqueue_script('onePluginsJS', THEMEROOT . '/assets/js/plugins.js', array(), '1.0', true);
    wp_enqueue_script('oneMainJS', THEMEROOT . '/assets/js/main.js', array(), '1.0', true);

    //wp_enqueue_script('mapJS', THEMEROOT . '/assets/js/map.js', array(), '1.0', true);

    wp_enqueue_script('google-maps-api', 'http://maps.google.com/maps/api/js?sensor=true', array(), '1.0', true);

    wp_enqueue_script('ajax-portfolio', THEMEROOT . '/assets/js/portfolio-ajax.js', array(), '1.0', true);

    /** Localize Scripts */
    $php_array = array( 'admin_ajax' => admin_url( 'admin-ajax.php' ) );
    wp_localize_script( 'ajax-portfolio', 'php_array', $php_array );

}


/************************************************************/
/* Theme Styles Function */
/************************************************************/
function clubix_load_custom_styles() {

    wp_enqueue_style( 'master', THEMEROOT . '/assets/css/master.css');
    //wp_enqueue_style( 'base-color', THEMEROOT . '/assets/css/color.css');
    wp_enqueue_style( 'style', get_stylesheet_uri());

}


/************************************************************/
/* Register Menus */
/************************************************************/
function haze_register_my_menus() {
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu', LANGUAGE_ZONE_ADMIN)
        )
    );
}

/************************************************************/
/* Add Google Analytics */
/************************************************************/
function zen_google_analytics() {
    global $clx_data;

    if(!empty($clx_data['jscode'])) {
        print_r(stripslashes($clx_data['jscode']));
    }
}


/************************************************************/
/* Theme Includes Helpers */
/************************************************************/
require_once('lib/functions/core-functions.php');
require_once('lib/functions/color-handler.php');
require_once('lib/functions/filters_and_actions.php');
require_once('lib/functions/helpers.php');
require_once('lib/functions/comments-helpers.php');

// Post Type Rulz
require_once('lib/functions/roua-posttypes.php');

// Shortcodes Rulz
require_once('lib/functions/roua-shortcodes.php');

// Metaboxes Rulz
define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/admin/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_stylesheet_directory() . '/admin/meta-box' ) );

require_once(RWMB_DIR . 'meta-box.php');
require_once('lib/functions/roua-metaboxes.php');

// Zilla Likes
if( !function_exists('zilla_likes') ) {
    require_once('admin/zilla-likes/zilla-likes.php');
}

// Redux Framework
if (class_exists('ReduxFramework')) {
    require_once('admin/redux-framework/options-init.php');
}

// TGM Activation Plugin
require_once('admin/tgm/tgm-init.php');

