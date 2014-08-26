<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


class ROUA_PostTypes {

    protected $prefix = 'haze_post_types_';

    protected static $instance = null;

    private function __construct() {

        // Song Post Type
        require_once('posttypes/portfolio.php');

        require_once('posttypes/team.php');

    }

    /**
     * Return an instance of this class.
     *
     * @since     1.0.0
     *
     * @return    object  A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

}

ROUA_PostTypes::get_instance();