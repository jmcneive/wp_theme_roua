<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


class Haze_Meta_Boxes {

    protected static $instance = null;

    public $prefix = 'diva_';

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    protected function __construct() {

        add_filter('rwmb_meta_boxes', array( &$this, 'haze_register_meta_boxes'));

        if ( is_admin() ) {
            //add_action( 'admin_enqueue_scripts', array( &$this, 'zen_meta_admin_init' ));
        }

    }

    public function zen_meta_admin_init() {
        global $pagenow;

        if ( $pagenow == 'post-new.php' || $pagenow == 'post.php' || $pagenow == 'edit.php' ) {

            wp_enqueue_script('clx_meta_js', THEMEROOT .'/assets/js/one-meta-js.js', array('jquery'));

            wp_enqueue_style( 'clx_meta_css', THEMEROOT .'/assets/css/clx-meta-css.css');

        }
    }

    /**
     * @param $meta_boxes
     * @return array
     */
    public function haze_register_meta_boxes( $meta_boxes ) {
        $prefix = $this->prefix;

        // Header Menu Color Scheme
        $meta_boxes[] = array(
            'id'        => "{$prefix}page_layout",
            'title'     => __('Header Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('post', 'page', PortfolioPostType::get_instance()->postType),
            'context'   => 'side',
            'priority'  => 'high',

            'fields'    => array(
                array(
                    'name'          => __( 'Header Color Scheme', LANGUAGE_ZONE_ADMIN ),
                    'id'            => "{$prefix}header_color",
                    'type'          => 'radio',
                    'class'         => 'custom_sidebar_select',
                    'options'       => array(
                        'light'         => __('Light', LANGUAGE_ZONE_ADMIN),
                        'dark'          => __('Dark', LANGUAGE_ZONE_ADMIN),
                    ),
                    'std'           => 'light',
                    //'desc'          => '<br>** If you select <strong>Full Width</strong> layout, you need to use Visual Composer to build the post.',
                ),

                array(
                    'name'          => __( 'Header Background', LANGUAGE_ZONE_ADMIN ),
                    'id'            => "{$prefix}header_bg",
                    'type'          => 'radio',
                    'class'         => 'custom_sidebar_select',
                    'options'       => array(
                        'default'         => __('Default', LANGUAGE_ZONE_ADMIN),
                        'solid'          => __('Solid Color', LANGUAGE_ZONE_ADMIN),
                    ),
                    'std'           => 'default',
                    //'desc'          => '<br>** If you select <strong>Full Width</strong> layout, you need to use Visual Composer to build the post.',
                ),
            ),
        );

        // Header Menu Color Scheme
        $meta_boxes[] = array(
            'id'        => "{$prefix}header_video",
            'title'     => __('Header Video Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array(PortfolioPostType::get_instance()->postType),
            'context'   => 'normal',
            'priority'  => 'low',

            'fields'    => array(
                array(
                    'name'          => __( 'Enable/Disable Header Video', LANGUAGE_ZONE_ADMIN ),
                    'id'            => "{$prefix}header_video",
                    'type'          => 'radio',
                    'class'         => 'custom_sidebar_select',
                    'options'       => array(
                        'enable'         => __('Enable', LANGUAGE_ZONE_ADMIN),
                        'disable'          => __('Disable', LANGUAGE_ZONE_ADMIN),
                    ),
                    'std'           => 'disable',
                    //'desc'          => '<br>** If you select <strong>Full Width</strong> layout, you need to use Visual Composer to build the post.',
                ),

                array(
                    'name'          => __( 'VIMEO Video ID', LANGUAGE_ZONE_ADMIN ),
                    'id'            => "{$prefix}header_video_id",
                    'type'          => 'text',
                    'desc'          => '<strong>Paste here the URL of the video from Vimeo.</strong>',
                ),
            ),
        );

        // Portfolio Info
        $meta_boxes[] = array(
            'id'        => "{$prefix}work_info",
            'title'     => __('Portfolio Info', LANGUAGE_ZONE_ADMIN),
            'pages'     => array(PortfolioPostType::get_instance()->postType),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(

                array(
                    'type' => 'heading',
                    'name' => __( 'Portfolio Images', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                array(
                    'name'             => __( 'Choose images', LANGUAGE_ZONE_ADMIN ),
                    'id'               => "{$prefix}imgadv",
                    'type'             => 'image_advanced',
                    'desc'             => __('<strong>The images should be </strong>', LANGUAGE_ZONE),
                    'max_file_uploads' => 99,
                ),

                // Custom fields
                array(
                    'type' => 'heading',
                    'name' => __( 'Custom Fields', LANGUAGE_ZONE_ADMIN ),
                    'id'   => 'fake_id', // Not used but needed for plugin
                ),
                array(
                    'name'  => __( 'Work', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}work",
                    'type'  => 'text',
                    'std'   => __('Product Design', LANGUAGE_ZONE),
                    'desc'  => __('Use this to describe what work you did for this project.', LANGUAGE_ZONE)
                ),
                array(
                    'name'  => __( 'Project URL', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}url",
                    'type'  => 'url',
                    'desc'  => __('Use this for the project url.', LANGUAGE_ZONE)
                ),
            ),
        );

        // Page Header Options
        $meta_boxes[] = array(
            'id'        => "{$prefix}page_header",
            'title'     => __('Page Header Type', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('page'),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(

                array(
                    'name' => __( 'Type', LANGUAGE_ZONE ),
                    'id'   => "{$prefix}header_type",
                    'type' => 'select',
                    'options' => array(
                        'default'          => __( 'Default', LANGUAGE_ZONE ),
                        'img_light'        => __( 'Image with Light Overlay', LANGUAGE_ZONE ),
                        'img_dark'         => __( 'Image with Dark Overlay', LANGUAGE_ZONE ),
                        'video_light'            => __( 'Video with Light Overlay', LANGUAGE_ZONE ),
                        'video_dark'            => __( 'Video with Dark Overlay', LANGUAGE_ZONE ),
                    ),
                ),

                array(
                    'name'  => __( 'Optional Title:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}h_title",
                    'type'  => 'text',
                ),

                array(
                    'name'  => __( 'Description:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}h_description",
                    'type'  => 'textarea',
                    'class' => ''
                ),

                array(
                    'name'  => __( 'Optional call to action:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}h_call_to_action",
                    'type'  => 'text',
                ),

                array(
                    'name'          => __( 'Video ID', LANGUAGE_ZONE_ADMIN ),
                    'id'            => "{$prefix}header_video_id",
                    'type'          => 'text',
                    'desc'          => '<strong>Paste here the ID of the video from Vimeo or YouTube.</strong>',
                ),

            ),
        );

        // Blog Page Options
        $meta_boxes[] = array(
            'id'        => "{$prefix}blog_options",
            'title'     => __('Blog Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('page'),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(

                array(
                    'name'  => __( 'Posts per Page:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}posts_per_page",
                    'type'  => 'number',
                    'desc'  => 'How many posts you want to display on a single page?',
                    'std'   => '5'
                ),

                array(
                    'name'    => __( 'Categories', LANGUAGE_ZONE_ADMIN ),
                    'id'      => "{$prefix}category",
                    'type'    => 'taxonomy',
                    'options' => array(
                        'taxonomy' => 'category',
                        'type' => 'checkbox_list',
                    ),
                ),

                array(
                    'name'     => __( 'Order by', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}order_by",
                    'type'     => 'select',
                    // Array of 'value' => 'Label' pairs for select box
                    'options'  => array(
                        'date'      => __( 'Date', LANGUAGE_ZONE ),
                        'name'      => __( 'Name', LANGUAGE_ZONE ),
                        'author'    => __( 'Author', LANGUAGE_ZONE ),
                        'ID'        => __( 'ID', LANGUAGE_ZONE ),
                        'rand'      => __( 'Random', LANGUAGE_ZONE ),
                        'title'     => __( 'Title', LANGUAGE_ZONE ),
                    ),
                    // Select multiple values, optional. Default is false.
                    'multiple'    => false,
                    'std'         => 'date',
                ),

                array(
                    'name' => __( 'Order', LANGUAGE_ZONE ),
                    'id'   => "{$prefix}order",
                    'type' => 'select',
                    'options' => array(
                        'DESC' => __( 'DESC', LANGUAGE_ZONE ),
                        'ASC' => __( 'ASC', LANGUAGE_ZONE ),
                    ),
                )

            ),
        );

        // Portfolio Page Options
        $meta_boxes[] = array(
            'id'        => "{$prefix}gallery_opt",
            'title'     => __('Portfolio Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('page'),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(

                array(
                    'name'  => __( 'Posts per Page:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}g_posts_per_page",
                    'type'  => 'number',
                    'desc'  => 'How many portfolios you want to display on a single page?',
                    'std'   => '5'
                ),

                array(
                    'name'  => __( 'Categories:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}g_category",
                    'type'    => 'taxonomy',
                    'options' => array(
                        'taxonomy' => PortfolioPostType::get_instance()->postTypeTax,
                        'type' => 'checkbox_list',
                    ),
                ),

                array(
                    'name'     => __( 'Order by', LANGUAGE_ZONE_ADMIN ),
                    'id'       => "{$prefix}g_order_by",
                    'type'     => 'select',
                    // Array of 'value' => 'Label' pairs for select box
                    'options'  => array(
                        'date'      => __( 'Date', LANGUAGE_ZONE ),
                        'name'      => __( 'Name', LANGUAGE_ZONE ),
                        'author'    => __( 'Author', LANGUAGE_ZONE ),
                        'ID'        => __( 'ID', LANGUAGE_ZONE ),
                        'rand'      => __( 'Random', LANGUAGE_ZONE ),
                        'title'     => __( 'Title', LANGUAGE_ZONE ),
                    ),
                    // Select multiple values, optional. Default is false.
                    'multiple'    => false,
                    'std'         => 'date',
                ),

                array(
                    'name' => __( 'Order', LANGUAGE_ZONE ),
                    'id'   => "{$prefix}g_order",
                    'type' => 'select',
                    'options' => array(
                        'DESC' => __( 'DESC', LANGUAGE_ZONE ),
                        'ASC' => __( 'ASC', LANGUAGE_ZONE ),
                    ),
                )

            ),
        );

        $meta_boxes[] = array(
            'id'        => "{$prefix}about_us",
            'title'     => __('About Us Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array('page'),
            'context'   => 'normal',
            'priority'  => 'high',

            'fields'    => array(

                array(
                    'name' => __( 'Left Side Image', LANGUAGE_ZONE_ADMIN ),
                    'id'   => "{$prefix}side_image",
                    'type' => 'image_advanced',
                    'max_file_uploads' => 1,
                ),

                array(
                    'name'  => __( 'Employees Title:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}team_title",
                    'type'  => 'text',
                    //'desc'  => 'How many portfolios you want to display on a single page?',
                    'std'   => 'My super team'
                ),

                array(
                    'name'  => __( 'Categories:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}team_category",
                    'type'    => 'taxonomy',
                    'options' => array(
                        'taxonomy' => TeamPostType::get_instance()->postTypeTax,
                        'type' => 'checkbox_list',
                    ),
                ),

            ),
        );

        // Employee Options
        $meta_boxes[] = array(
            'id'        => "{$prefix}options",
            'title'     => __('Employee Options', LANGUAGE_ZONE_ADMIN),
            'pages'     => array(TeamPostType::get_instance()->postType),
            'context'   => 'normal',
            'priority'  => 'low',

            'fields'    => array(
                array(
                    'name'  => __( 'Position:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}position",
                    'type'  => 'text',
                ),

                array(
                    'name'  => __( 'Facebook:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}facebook",
                    'type'  => 'url',
                    'std'   => 'http://facebook.com',
                ),

                array(
                    'name'  => __( 'Twitter:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}twitter",
                    'type'  => 'url',
                    'std'   => 'http://twitter.com',
                ),

                array(
                    'name'  => __( 'Pinterest:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}pinterest",
                    'type'  => 'url',
                    'std'   => 'https://pinterest.com',
                ),
                array(
                    'name'  => __( 'Instagram:', LANGUAGE_ZONE_ADMIN ),
                    'id'    => "{$prefix}instagram",
                    'type'  => 'url',
                    'std'   => 'http://instagram.com',
                ),

            ),
        );


        return $meta_boxes;
    }

}

Haze_Meta_Boxes::get_instance();