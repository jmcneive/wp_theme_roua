<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header(); ?>

    <!-- ================================================== -->
    <!-- =============== START BREADCRUMB ================ -->
    <!-- ================================================== -->

    <?php diva_page_breadcrumb(); ?>

    <!-- ================================================== -->
    <!-- =============== END BREADCRUMB ================ -->
    <!-- ================================================== -->

    <!-- ================================================== -->
    <!-- =============== START CONTENT PAGE ================ -->
    <!-- ================================================== -->



    <?php if ( have_posts() ) : ?>

        <?php while ( have_posts() ) : the_post(); ?>


        <section>
            <div class="sticky-background"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-3 col-sm-10 col-sm-offset-1">
                            <div class="row">
                                <div class="col-sm-12">

                                    <?php the_content(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>


        <?php endwhile; ?>

    <?php endif; ?>



    <!-- ================================================== -->
    <!-- =============== END CONTENT PAGE ================ -->
    <!-- ================================================== -->



<?php get_footer(); ?>