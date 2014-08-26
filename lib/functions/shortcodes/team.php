<?php
/**
 * @author Stylish Themes
 *
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }


class One_Team {
    protected static $instance = null;

    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        add_shortcode( 'diva_team', array( &$this, 'shortcode' ) );
    }

    public function shortcode( $atts ) {
        $output = $id = $category = $title = '';

        extract( shortcode_atts( array(
            'category'      => '',
            'title'         => 'Title <br> Here',
        ), $atts ) );

        $post_type = TeamPostType::get_instance()->postType;
        $post_tax = TeamPostType::get_instance()->postTypeTax;
        $prefix = Haze_Meta_Boxes::get_instance()->prefix;

        $args = array(
            'post_type' => $post_type,
            'tax_query' => array(
                array(
                    'taxonomy' => $post_tax,
                    'field' => 'id',
                    'terms' => $category
                )
            )
        );
        $query = new WP_Query( $args );

        $output .= '<div class="owl-team"><div class="carousel-description"><div class="text"><div class="content"><p>';
        $output .= $title;
        $output .= '</p></div></div></div><div class="team-members">';

        // The Loop
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();

                $employee_name = get_the_title();
                $employee_image = get_the_post_thumbnail($query->post->ID, 'employee');

                $employee_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $query->post->ID ), 'full' );

                $employee_position = rwmb_meta("{$prefix}position");
                $employee_fb = rwmb_meta("{$prefix}facebook");
                $employee_twit = rwmb_meta("{$prefix}twitter");
                $employee_in = rwmb_meta("{$prefix}pinterest");
                $employee_instagram = rwmb_meta("{$prefix}instagram");

                //$output .= '<figure class="team-member"><figcaption>'.$employee_image.'</figcaption>';
                $output .= '<figure class="team-member"><figcaption>'.$employee_image.'</figcaption>';
                $output .= '<div class="content"><h4>'.$employee_name.'</h4><hr><h5>'.$employee_position.'</h5>';
                $output .= '<nav class="social-icons"><ul>';

                if ($employee_fb != '') { $output .= '<li><a href="'.$employee_fb.'"><i class="fa fa-facebook"></i></a></li>'; }
                if ($employee_twit != '') { $output .= '<li><a href="'.$employee_twit.'"><i class="fa fa-twitter"></i></a></li>'; }
                if ($employee_in != '') { $output .= '<li><a href="'.$employee_in.'"><i class="fa fa-pinterest"></i></a></li>'; }
                if ($employee_instagram != '') { $output .= '<li><a href="'.$employee_instagram.'"><i class="fa fa-instagram"></i></a></li>'; }

                $output .= '</ul></nav></div></figure>';

            }
        }
        wp_reset_postdata();
        // End The Loop

        $output .= '</div></div>';

        return $output;
    }

}
One_Team::get_instance();