<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


if ( ! function_exists( 'roua_upper_title' ) ) :

    function roua_upper_title() {
        ?>
        <?php

        if (is_home()) :

            _e('Welcome to <strong>ROUA</strong>', LANGUAGE_ZONE);

        elseif (is_page() || is_single()) :

            the_title();

        elseif (is_tag()) : ?>

            <?php _e('Posts in ', LANGUAGE_ZONE);?> <strong><?php echo single_cat_title(); ?></strong>

        <?php elseif (is_category()) : ?>

            <?php _e('Posts in ', LANGUAGE_ZONE);?> <strong><?php echo single_cat_title(); ?></strong>

        <?php elseif (is_tax(PortfolioPostType::get_instance()->postTypeTax)) : ?>

            <?php _e('Articles in ', LANGUAGE_ZONE);?> <strong><?php echo single_cat_title('' , false); ?></strong>

        <?php elseif (is_search()) : ?>

            <?php _e('Search results for ', LANGUAGE_ZONE);?> <strong><?php echo get_search_query(); ?></strong>

        <?php
        endif;
        ?>
    <?php
    }

endif;

if( ! function_exists( 'zen_the_excerpt' ) ) :
    function zen_the_excerpt() {
        echo zen_get_the_excerpt();
    }
endif;

if( ! function_exists( 'zen_get_the_excerpt' ) ) :

    /**
     * Returns a nice excerpt/content for the blog page.
     *
     * @return mixed|string|void
     *
     * @since 1.0.0
     *
     */

    function zen_get_the_excerpt() {

        global $post, $more, $pages;
        $more = 0;

        if ( !has_excerpt( $post->ID ) ) {

            $excerpt_length = apply_filters('excerpt_length', 55);
            $content = zen_get_the_clear_content();

            // check for more tag
            if ( preg_match( '/<!--more(.*?)?-->/', $post->post_content, $matches ) ) {

                // check content length
            } elseif ( st_count_words( $content ) <= $excerpt_length ) {

                add_filter('zen_get_content_more', 'zen_return_empty_string', 15);

            } else {

                $content = '';

            }

        }

        // if we got excerpt or content more than $excerpt_length
        if ( empty($content) && get_the_excerpt() ) {

            $content = apply_filters( 'the_excerpt', get_the_excerpt() );

        }

        return $content;

    }
endif;

if( ! function_exists( 'zen_get_the_clear_content' ) ) :

    /**
     * Return content passed throw these functions:
     *	strip_shortcodes( $content );
     *	apply_filters( 'the_content', $content );
     *	str_replace( ']]>', ']]&gt;', $content );
     *
     * @return string
     */
    function zen_get_the_clear_content() {
        $content = get_the_content( '' );
        $content = strip_shortcodes( $content );
        $content = apply_filters( 'the_content', $content );
        $content = str_replace( ']]>', ']]&gt;', $content );

        return $content;
    }

endif;

if( ! function_exists( 'zen_return_empty_string' ) ) :
    /**
     * Return empty string.
     *
     * @return string
     */
    function zen_return_empty_string() {
        return '';
    }
endif;

if( ! function_exists( 'zen_get_content_more' ) ) :

    /**
     * A filter for the "Read More" button
     *
     * @return mixed|void
     *
     * @since 1.0.0
     */

    function zen_get_content_more() {
        $more_button = '<a href="';
        $more_button .= get_permalink();
        $more_button .= '" >';
        $more_button .= __('read more', LANGUAGE_ZONE);
        $more_button .= ' <i class="fa fa-arrow-right"></i></a>';

        return apply_filters('zen_get_content_more', $more_button);
    }

endif;

if( ! function_exists( 'zen_single_post_pagination' ) ) :

    /**
     * Outputs the single post pagination.
     *
     * @since 1.0.0
     */

    function zen_single_post_pagination() {

        $output = wp_link_pages(
            array(
                'before'            => '<ul class="pager">',
                'after'             => '</ul>',
                'next_or_number'    =>'next',
                'previouspagelink'  => __(' &laquo; Previous Page',LANGUAGE_ZONE),
                'nextpagelink'      => __(' Next Page &raquo; ', LANGUAGE_ZONE),
                'separator'         => ' ', 'link_before' => '<li>',
                'link_after'        => '</li>',
                'echo'              => 0
            ));

        $output = str_replace('li></a>', 'a></li>', $output);
        $output = str_replace('<li>', '', $output);
        $output = str_replace('<a href', '<li><a href', $output);

        echo $output;

    }

    function haze_unused() {
        posts_nav_link();
    }

endif;

if( ! function_exists( 'clx_post_single_nav' ) ) :

    function clx_post_single_nav($current_id, $post_type) {

        $args = array(
            'posts_per_page'   => 999,
            'offset'           => 0,
            'category'         => '',
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'include'          => '',
            'exclude'          => '',
            'meta_key'         => '',
            'meta_value'       => '',
            'post_type'        => $post_type,
            'post_mime_type'   => '',
            'post_parent'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true );

        $posts_array = get_posts( $args );

        $n = count($posts_array);
        $has_next = false;
        $has_previous = false;
        $next_portfolio = array();
        $previous_portfolio = array();

        for ( $i = 0; $i < $n; $i++ ){
            if ( $current_id == $posts_array[$i]->ID && $n > 1 ) {

                if( $i == 0 ) {
                    $has_next = false;
                    $has_previous = true;

                    $next_portfolio = array();
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => get_permalink( $posts_array[$i+1]->ID ));
                } else if( $i == $n-1 ) {
                    $has_next = true;
                    $has_previous = false;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => get_permalink( $posts_array[$i-1]->ID ));
                    $previous_portfolio = array();
                } else {
                    $has_next = true;
                    $has_previous = true;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => get_permalink( $posts_array[$i-1]->ID ));
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => get_permalink( $posts_array[$i+1]->ID ));
                }

            }
        }

        ?>
        <section class="no-mb">
        <div class="container">
        <div class="row">
        <div class="col-sm-12">
        <div class="row">
        <div class="pagination-roua cleafix">

            <?php if ($has_previous) : ?>
                <a href="<?php echo $previous_portfolio['link']; ?>" class="left"><span class="icon">
										<span></span>
										<span></span>
									</span> <?php _e('previous article', LANGUAGE_ZONE); ?></a>
            <?php else: ?>
                <a href="#" style="cursor: not-allowed;" class="canceled left"><span class="icon">
										<span></span>
										<span></span>
									</span> <?php _e('previous article', LANGUAGE_ZONE); ?></a>
            <?php endif; ?>


            <?php if ($has_next) : ?>
                <a href="<?php echo $next_portfolio['link']; ?>" class="right"><span class="icon">
										<span></span>
										<span></span>
									</span> <?php _e('next article', LANGUAGE_ZONE); ?></a>
            <?php else: ?>
                <a href="#" style="cursor: not-allowed;" class="canceled right"><span class="icon">
										<span></span>
										<span></span>
									</span> <?php _e('next article', LANGUAGE_ZONE); ?></i></a>
            <?php endif; ?>

        </div>
        </div>
        </div>
        </div>
        </div>
        </section>

    <?php

    }

endif;

if( ! function_exists( 'roua_post_single_nav' ) ) :

    function roua_post_single_nav($current_id, $post_type) {

        $args = array(
            'posts_per_page'   => 999,
            'offset'           => 0,
            'category'         => '',
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'include'          => '',
            'exclude'          => '',
            'meta_key'         => '',
            'meta_value'       => '',
            'post_type'        => $post_type,
            'post_mime_type'   => '',
            'post_parent'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true );

        $posts_array = get_posts( $args );

        $n = count($posts_array);
        $has_next = false;
        $has_previous = false;
        $next_portfolio = array();
        $previous_portfolio = array();

        for ( $i = 0; $i < $n; $i++ ){
            if ( $current_id == $posts_array[$i]->ID && $n > 1 ) {

                if( $i == 0 ) {
                    $has_next = false;
                    $has_previous = true;

                    $next_portfolio = array();
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => get_permalink( $posts_array[$i+1]->ID ));
                } else if( $i == $n-1 ) {
                    $has_next = true;
                    $has_previous = false;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => get_permalink( $posts_array[$i-1]->ID ));
                    $previous_portfolio = array();
                } else {
                    $has_next = true;
                    $has_previous = true;

                    $next_portfolio = array('title' => $posts_array[$i-1]->post_title, 'link' => get_permalink( $posts_array[$i-1]->ID ));
                    $previous_portfolio = array('title' => $posts_array[$i+1]->post_title, 'link' => get_permalink( $posts_array[$i+1]->ID ));
                }

            }
        }

        ?>

        <div class="navigation-projects">

        <?php if ($has_next) : ?>
            <a href="<?php echo $next_portfolio['link']; ?>" class="next">
                <div class="icon">
                    <i class="fa fa-arrow-right"></i>
                    <span><?php _e('next', LANGUAGE_ZONE); ?></span>
                </div>
            </a>
        <?php else: ?>
            <a href="#" style="cursor: not-allowed;" class="canceled next">
                <div class="icon">
                    <i class="fa fa-arrow-right"></i>
                    <span><?php _e('next', LANGUAGE_ZONE); ?></span>
                </div>
            </a>
        <?php endif; ?>

        <?php if ($has_previous) : ?>
            <a href="<?php echo $previous_portfolio['link']; ?>" class="prev">
                <div class="icon">
                    <i class="fa fa-arrow-left"></i>
                    <span><?php _e('prev', LANGUAGE_ZONE); ?></span>
                </div>
            </a>
        <?php else: ?>
            <a href="#" style="cursor: not-allowed;" class="canceled prev">
                <div class="icon">
                    <i class="fa fa-arrow-left"></i>
                    <span><?php _e('prev', LANGUAGE_ZONE); ?></span>
                </div>
            </a>
        <?php endif; ?>

        </div>

    <?php

    }

endif;

if(!function_exists('clx_breadcrumbs_filter')) :

    function clx_breadcrumbs_filter($taxonomy, $ids = array()) {
        $output = '';

        $output .= '<nav><div class="x-filter"><span></span><span></span></div><ul data-option-key="filter" class="option-set">';
        $output .= '<li><a class="selected" data-option-value="*">'.__('All', LANGUAGE_ZONE).'</a></li>';

        if(empty($ids)) {
            $terms = get_terms($taxonomy);

            foreach($terms as $term) { $ids[] = $term->term_id; }
        }

        foreach($ids as $id) {
            $term = get_term($id, $taxonomy);

            $output .= '<li><a data-option-value=".'.$term->slug.'">'.$term->name.'</a></li>';
        }

        $output .= '</ul><div class="x-filter">
					<span></span>
					<span></span>
				</div></nav>';


        return $output;
    }

endif;

if( ! function_exists( 'diva_page_breadcrumb' ) ) :

    function diva_page_breadcrumb($class = '') {

        $prefix = Haze_Meta_Boxes::get_instance()->prefix;
        $type = rwmb_meta( "{$prefix}header_type", $args = array(), get_the_ID() );
        $title = ( rwmb_meta( "{$prefix}h_title", $args = array(), get_the_ID() ) != '' ? rwmb_meta( "{$prefix}h_title", $args = array(), get_the_ID() ) : get_the_title() );
        $description = rwmb_meta( "{$prefix}h_description", $args = array(), get_the_ID() );
        $call_to_action = ( rwmb_meta( "{$prefix}h_call_to_action", $args = array(), get_the_ID() ) != '' ? rwmb_meta( "{$prefix}h_call_to_action", $args = array(), get_the_ID() ) : __('read more', LANGUAGE_ZONE) );

        switch($type) {
            default:
                ?>

                <section class="<?php echo $class; ?>">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="breadcrumb">
                                <h1>
                                    <?php roua_upper_title(); ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                break;
            case 'img_light':
                ?>

                <?php
                $img_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                $img_url = $img_url[0];
                ?>
                <section class="no-mb">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="breadcrumb-fullscreen-parent">
                                <div class="breadcrumb breadcrumb-fullscreen alignleft overlay white-overlay" style="background-image: url(<?php echo $img_url; ?>);" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
                                    <div>
                                        <h1>
                                            <?php echo $title; ?>
                                        </h1>
                                        <p>
                                            <?php echo $description; ?>
                                        </p>
                                        <a href="#content" data-easing="easeInOutQuint" data-scroll="" data-speed="600" data-url="false">
                                            <?php echo $call_to_action; ?> <i class="fa fa-angle-down"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                break;
            case 'img_dark':
                ?>

                <?php
                $img_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                $img_url = $img_url[0];
                ?>
                <section class="no-mb">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="breadcrumb-fullscreen-parent">
                                <div class="breadcrumb breadcrumb-fullscreen alignleft small-description overlay black-overlay" style="background-image: url(<?php echo $img_url; ?>);" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="0">
                                    <div>
                                        <h1 style="color: #fff;">
                                            <?php echo $title; ?>
                                        </h1>
                                        <p style="color: #c2c2c2;">
                                            <?php echo $description; ?>
                                        </p>
                                        <a href="#content" style="color: #fff;" data-easing="easeInOutQuint" data-scroll="" data-speed="600" data-url="false">
                                            <?php echo $call_to_action; ?> <i class="fa fa-angle-down"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <?php
                break;

            case 'video_light':

                $id = rwmb_meta( "{$prefix}header_video_id", $args = array(), get_the_ID() );

                ?>
                <section class="no-mb">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="breadcrumb-fullscreen-parent">
                                <div id="<?php echo $id; ?>" class="breadcrumb breadcrumb-fullscreen alignleft overlay white-overlay video-bg">
                                    <div>
                                        <h1>
                                            <?php echo $title; ?>
                                        </h1>
                                        <p>
                                            <?php echo $description; ?>
                                        </p>
                                        <a href="#content" data-easing="easeInOutQuint" data-scroll="" data-speed="600" data-url="false">
                                            <?php echo $call_to_action; ?> <i class="fa fa-angle-down"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                break;

            case 'video_dark':

                $id = rwmb_meta( "{$prefix}header_video_id", $args = array(), get_the_ID() );

                ?>
                <section class="no-mb">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="breadcrumb-fullscreen-parent">
                                <div id="<?php echo $id; ?>" class="breadcrumb breadcrumb-fullscreen alignleft overlay black-overlay video-bg">
                                    <div>
                                        <h1>
                                            <?php echo $title; ?>
                                        </h1>
                                        <p>
                                            <?php echo $description; ?>
                                        </p>
                                        <a href="#content" data-easing="easeInOutQuint" data-scroll="" data-speed="600" data-url="false">
                                            <?php echo $call_to_action; ?> <i class="fa fa-angle-down"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                break;
        }

    }

endif;

if( !function_exists('clx_get_google_maps') ) :

    function clx_get_google_maps($address, $visible = true) {

        $coordinates = clx_get_coordinates($address);

        global $clx_data;
        $pointer = $clx_data['map-image']['url'];
        $title = $clx_data['contact-title'];
        $description = $clx_data['contact-description'];

        if($visible) {
            $output = '<div id="map-canvas" style="height: 650px;" data-lat="'.$coordinates['lat'].'" data-long="'.$coordinates['lng'].'" data-img="'.$pointer.'" data-title="'.$title.'" data-description="'.$description.'"></div>';

            return $output;
        } else {return '';}

    }

endif;

if( !function_exists('clx_get_coordinates') ) :

    /**
     * @param $address
     * @param bool $force_refresh
     * @return array|mixed|string|void
     */
    function clx_get_coordinates($address, $force_refresh = false) {
        $address_hash = md5( $address );

        $coordinates = get_transient( $address_hash );

        if ($force_refresh || $coordinates === false) {

            $args       = array( 'address' => urlencode( $address ), 'sensor' => 'false' );
            $url        = add_query_arg( $args, 'http://maps.googleapis.com/maps/api/geocode/json' );
            $response   = wp_remote_get( $url );

            if( is_wp_error( $response ) )
                return;

            $data = wp_remote_retrieve_body( $response );

            if( is_wp_error( $data ) )
                return;

            if ( $response['response']['code'] == 200 ) {

                $data = json_decode( $data );

                if ( $data->status === 'OK' ) {

                    $coordinates = $data->results[0]->geometry->location;

                    $cache_value['lat']   = $coordinates->lat;
                    $cache_value['lng']   = $coordinates->lng;
                    $cache_value['address'] = (string) $data->results[0]->formatted_address;

                    // cache coordinates for 3 months
                    set_transient($address_hash, $cache_value, 3600*24*30*3);
                    $data = $cache_value;

                } elseif ( $data->status === 'ZERO_RESULTS' ) {
                    return __( 'No location found for the entered address.', 'pw-maps' );
                } elseif( $data->status === 'INVALID_REQUEST' ) {
                    return __( 'Invalid request. Did you enter an address?', 'pw-maps' );
                } else {
                    return __( 'Something went wrong while retrieving your map, please ensure you have entered the short code correctly.', 'pw-maps' );
                }

            } else {
                return __( 'Unable to contact Google API service.', 'pw-maps' );
            }

        } else {
            // return cached results
            $data = $coordinates;
        }

        return $data;
    }

endif;

if( ! function_exists( 'zen_entry_tags' ) ) :

    function zen_entry_tags() {
        $tag_list = get_the_tags();
        if ( $tag_list ) {
            echo '<h6>' . __('tags: ', LANGUAGE_ZONE) . '</h6><ul class="clearfix">';

            $i = 0;
            $n = count( $tag_list );

            foreach($tag_list as $tag) {
                echo '<li><a href="' . home_url( '/' ) . '?tag=' . $tag->slug . '">' . $tag->name . '</a></li>';
                //if ($i != $n-1) echo ', ';
                $i++;
            }

            echo '</ul>';
        }
    }

endif;
