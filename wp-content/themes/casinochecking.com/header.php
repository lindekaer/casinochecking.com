<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package checkmate
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php include(locate_template('inc/meta-tags.php')); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Lato:300,400" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="bg-img">
<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="row flex-header show-for-large">
            <div class="large-5 columns site-navigation" id="menu-left">
                <?php wp_nav_menu(array('theme_location' => 'header-left')); ?>
            </div><!-- .site-branding -->
            <div class="large-2 float-center columns">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php include(locate_template('template-parts/parts/logo.php')); ?>
                </a>
            </div>
            <div id="menu-right" class="site-navigation columns large-5">
                <?php wp_nav_menu(array('theme_location' => 'header-right')); ?>
            </div><!-- #site-navigation -->
        </div>
        <div class="container bg-black">
            <div class="row show-for-medium-down hide-for-large mobile-row flex-header">
                <div class="mobile-logo small-8 medium-2 columns">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php include(locate_template('template-parts/parts/logo.php')); ?>
                    </a>
                </div>
                <div class="small-4 medium-3 medium-offset-7 z-index columns">
                    <div class="three col z-index">
                        <div class="hamburger" id="hamburger-9">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php wp_nav_menu(array('theme_location' => 'mobile-header')); ?>
    </header><!-- #masthead -->

    <div id="content" class="site-content">