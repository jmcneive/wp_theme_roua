<?php
/**
 * @author Stylish Themes
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


if ( ! function_exists( 'haze_pagination' ) ) :

    add_action('clubix_after_posts_loop', 'haze_pagination', 10, 3);

    function haze_pagination( $query, $pages = '', $range = 2 ) {
        ?>
        <!-- ========== START PAGINATION ========== -->
        <?php
        $showitems = ($range * 2)+1;

        global $paged;
        if(empty($paged)) $paged = 1;

        if($pages == '')
        {
            $pages = $query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }

        if(1 != $pages)
        {
            echo '<section class="no-mb"><div class="container"><div class="row"><div class="col-sm-12"><div class="row"><div class="pagination-roua cleafix">';

            if ($paged < $pages) echo "<a class='left' href='".get_pagenum_link($paged + 1)."'>".__('prev post', LANGUAGE_ZONE)."<span class='icon'>
										<span></span>
										<span></span>
									</span></a>";

            if ($paged > 1) echo "<a class='right' href='".get_pagenum_link($paged - 1)."'>".__('next post', LANGUAGE_ZONE)."<span class='icon'>
										<span></span>
										<span></span>
									</span></a>";


            echo "</div></div></div></div></div></section>";
        }
        ?>
        <!-- ========== END PAGINATION ========== -->
    <?php
    }

endif;

if ( ! function_exists( 'diva_ajax_pagination' ) ) :

    add_action('roua_after_posts_loop', 'diva_ajax_pagination', 10, 3);

    function diva_ajax_pagination( $query, $pages = '', $range = 2 ) {
        ?>
        <!-- ========== START PAGINATION ========== -->
        <?php
        $showitems = ($range * 2)+1;

        global $paged;
        if(empty($paged)) $paged = 1;

        if($pages == '')
        {
            $pages = $query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }

        if(1 != $pages)
        {
            echo '<section class="no-mb"><div class="container"><div class="row"><div class="col-sm-12"><div class="row"><div id="pagination-ajax-inner" class="pagination-roua cleafix">';

            if ($paged < $pages) echo "<a id='blog-load-more-button' class='middle' href='".get_pagenum_link($paged + 1)."'><span class='icon'>
										<span></span>
										<span></span>
									</span></a>";

            echo "</div></div></div></div></div></section>";
        }
        ?>
        <!-- ========== END PAGINATION ========== -->
    <?php
    }

endif;