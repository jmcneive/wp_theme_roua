<?php
/**
 * It creates a custom Post-Type for Songs.
 *
 * @package   ZenTeam
 * @author    Vlad Mustiata <alexmustiata@gmail.com>
 * @license   GPL-2.0+
 * @link      http://stylishthemes.co
 * @copyright 2013 StylishThemes, Inc.
 */


class PortfolioPostType {

    const VERSION = '1.0.0';

    protected $plugin_slug = 'diva_pt_';

    protected static $instance = null;

    protected $plugin_screen_hook_suffix = null;

    protected $plugin_network_activated = false;

    public $postType = 'work';

    public $postTypeTax = 'work-category';

    private function __construct() {

        $this->zen_pt_init();

        if ( is_admin() ) {
            add_filter( 'enter_title_here', array( &$this, 'change_default_title' ) );
        }

        //add_filter('manage_csong_posts_columns' , array( &$this, 'add_song_columns'));
        //add_action( 'manage_posts_custom_column' , array( &$this, 'custom_columns'), 10, 2 );

    }

    public function zen_pt_init() {

        $labels = array(
            'name'                  => __('Portfolios', LANGUAGE_ZONE_ADMIN),
            'singular_name'         => __('Portfolio', LANGUAGE_ZONE_ADMIN),
            'add_new'               => __('Add new', LANGUAGE_ZONE_ADMIN),
            'add_new_item'          => __('Add new portfolio', LANGUAGE_ZONE_ADMIN),
            'edit_item'             => __('Edit Portfolio', LANGUAGE_ZONE_ADMIN),
            'new_item'              => __('New Portfolio', LANGUAGE_ZONE_ADMIN),
            'view_item'             => __('View Portfolio', LANGUAGE_ZONE_ADMIN),
            'search_items'          => __('Search Portfolios', LANGUAGE_ZONE_ADMIN),
            'not_found'             => __('No portfolios found.', LANGUAGE_ZONE_ADMIN),
            'not_found_in_trash'    => __('No portfolios found in trash.', LANGUAGE_ZONE_ADMIN),
            'parent_item_colon'     => ''
        );

        $args = array(
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => true,
            'show_ui'               => true,
            'query_var'             => true,
            'rewrite'               => true,
            'hierarchical'          => false,
            'menu_position'         => null,
            'capability_type'       => 'post',
            'supports'              => array('title', 'editor', 'thumbnail'),
            'menu_icon'             => 'dashicons-format-gallery'
        );

        register_post_type( $this->postType, $args );

        register_taxonomy(
            $this->postTypeTax, $this->postType,
            array(
                'hierarchical'      => true,
                'label'             => __('Categories', LANGUAGE_ZONE_ADMIN),
                'singular_label'    => __('Category', LANGUAGE_ZONE_ADMIN),
                'public'           => true
            )
        );

    }

    public function change_default_title( $title ){

        $screen = get_current_screen();

        if ( $this->postType == $screen->post_type ){
            $title = __('Portfolio title...', LANGUAGE_ZONE_ADMIN);
        }

        return $title;
    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

}

PortfolioPostType::get_instance();