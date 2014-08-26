<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

function one_change_colors_css ($col1, $col2) {
    $color1 = hex2rgba($col1, 1);
    $color2 = hex2rgba($col2, 1);

    ?>

    <style type="text/css">

    a {
        color: <?php echo $color2; ?>;
    }
    a:hover,
    a:focus {
        color: <?php echo $color2; ?>;
    }
    blockquote:before {
        color: <?php echo $color2; ?>;
    }
    .roua-menu .menu ul li a:after {
        background: <?php echo $color2; ?>;
    }
    .filter-list nav ul li a:after {
        background: <?php echo $color2; ?>;
    }
    .portfolio-single .footer-portfolio-single .category a:hover {
        color: <?php echo $color2; ?>;
    }
    .carousel-description .text .content p {
        border-bottom: 3px solid <?php echo $color2; ?>;
    }
    .team-member .content .social-icons ul li:hover a {
        color: <?php echo $color2; ?>;
    }
    @media (max-width: 780px) {
        .filter-list nav ul li a:after {
            background: <?php echo $color2; ?>;
        }
    }
    .owl-team .owl-controls .owl-nav div:hover {
        color: <?php echo $color2; ?>;
    }
    .text-primary {
        color: <?php echo $color1; ?>;
    }
    .bg-primary {
        background-color: <?php echo $color1; ?>;
    }
    .form-control:hover,
    input[type=text]:hover,
    textarea:hover,
    .post-password-form input[type=password]:hover,
    .form-control:active,
    input[type=text]:active,
    textarea:active,
    .post-password-form input[type=password]:active,
    .form-control:focus,
    input[type=text]:focus,
    textarea:focus,
    .post-password-form input[type=password]:focus {
        border-color: <?php echo $color1; ?>;
    }
    .btn:hover,
    input[type=submit]:hover,
    button[type=submit]:hover,
    .btn:focus,
    input[type=submit]:focus,
    button[type=submit]:focus {
        border-color: <?php echo $color1; ?>;
    }
    .btn:hover:after,
    input[type=submit]:hover:after,
    button[type=submit]:hover:after,
    .btn:focus:after,
    input[type=submit]:focus:after,
    button[type=submit]:focus:after {
        background: <?php echo $color1; ?>;
    }
    .breadcrumb {
        background-color: <?php echo $color1; ?>;
    }
    .breadcrumb.breadcrumb-fullscreen {
        color: <?php echo $color1; ?>;
    }
    .breadcrumb > div h1 {
        color: <?php echo $color1; ?>;
    }
    .breadcrumb .info a:before {
        color: <?php echo $color1; ?>;
    }
    header.header.no-breadcrumb-fullscreen {
        background: <?php echo $color1; ?>;
    }
    header.header.dark-bg.affix {
        background-color: <?php echo $color1; ?>;
    }
    header.header.dark-layout .additional-right-buttons a,
    .roua-menu.dark-layout .additional-right-buttons a {
        color: <?php echo $color1; ?>;
    }
    header.header.dark-layout a.open-menu,
    .roua-menu.dark-layout a.open-menu {
        color: <?php echo $color1; ?>;
    }
    header.header.dark-layout a.open-menu .icon span,
    .roua-menu.dark-layout a.open-menu .icon span {
        background: <?php echo $color1; ?>;
    }
    header.header.dark-layout nav.social-icons ul li a,
    .roua-menu.dark-layout nav.social-icons ul li a {
        color: <?php echo $color1; ?>;
    }
    header.header.half-light-layout .additional-right-buttons a,
    .roua-menu.half-light-layout .additional-right-buttons a {
        color: <?php echo $color1; ?>;
    }
    header.header.half-light-layout a.open-menu,
    .roua-menu.half-light-layout a.open-menu {
        color: <?php echo $color1; ?>;
    }
    header.header.half-light-layout a.open-menu .icon span,
    .roua-menu.half-light-layout a.open-menu .icon span {
        background: <?php echo $color1; ?>;
    }
    header.header.half-light-layout nav.social-icons ul li a,
    .roua-menu.half-light-layout nav.social-icons ul li a {
        color: <?php echo $color1; ?>;
    }
    header.header.half-light-layout nav.social-icons ul li a:hover,
    .roua-menu.half-light-layout nav.social-icons ul li a:hover {
        background: <?php echo $color1; ?>;
    }
    header.header.transparent-layout.dark-layout nav.social-icons ul li a,
    .roua-menu.transparent-layout.dark-layout nav.social-icons ul li a {
        color: <?php echo $color1; ?>;
    }
    header.header.transparent-layout.dark-layout nav.social-icons ul li a:hover,
    .roua-menu.transparent-layout.dark-layout nav.social-icons ul li a:hover {
        color: <?php echo $color1; ?>;
    }
    header.header.dark-layout nav.social-icons ul li a {
        color: <?php echo $color1; ?>;
    }
    @media (max-width: 500px) {
        header.header.phone-menu-bg.transparent-layout.affix,
        header.header.phone-menu-bg.light-layout.affix {
            background-color: <?php echo $color1; ?>;
        }
    }
    .roua-menu .menu ul li a {
        color: <?php echo $color1; ?>;
    }
    nav.social-icons ul li a:hover {
        color: <?php echo $color1; ?>;
    }
    .filter-list nav .x-filter span {
        background: <?php echo $color1; ?>;
    }
    .filter-list nav ul li a {
        color: <?php echo $color1; ?>;
    }
    .portfolio ul li figure .content .left {
        border-right: 1px solid <?php echo $color1; ?>;
    }
    .portfolio ul li figure .content .left i {
        color: <?php echo $color1; ?>;
    }
    .portfolio-single .header-portfolio-single .like i {
        color: <?php echo $color1; ?>;
    }
    .portfolio-single .footer-portfolio-single .navigation-projects > a {
        color: <?php echo $color1; ?>;
    }
    .portfolio-single .footer-portfolio-single .navigation-projects > a:hover .icon {
        background: <?php echo $color1; ?>;
    }
    .padding-content h5 a {
        color: <?php echo $color1; ?>;
        border-bottom: 1px solid <?php echo $color1; ?>;
    }
    .comment-respond .form-submit:after {
        background: <?php echo $color1; ?>;
    }
    @media (max-width: 780px) {
        .filter-list nav .x-filter span {
            background: <?php echo $color1; ?>;
        }
        .filter-list nav ul li a {
            color: <?php echo $color1; ?>;
        }
    }
    .blog-posts > article section footer a {
        color: <?php echo $color1; ?>;
    }
    .post-password-form input[type=submit]:hover {
        color: <?php echo $color1; ?>;
    }
    #nprogress .bar {
        background: <?php echo $color1; ?>;
    }
    /* Fancy blur effect */
    #nprogress .peg {
        box-shadow: 0 0 10px <?php echo $color1; ?>, 0 0 5px <?php echo $color1; ?>;
    }
    #nprogress .spinner-icon {
        border-top-color: <?php echo $color1; ?>;
        border-left-color: <?php echo $color1; ?>;
    }

    </style>

<?php
}