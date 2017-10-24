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
    <link href="https://fonts.googleapis.com/css?family=Roboto|Lato:300,400" rel="stylesheet">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="fade-in">
<div id="page" class="site">
    <header id="masthead" class="site-header slide-down">
        <div class="container show-for-large">
            <div class="row flex-header desktop-row">
                <div class="large-4 columns site-navigation" id="menu-left">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php include(locate_template('template-parts/parts/logo.php')); ?>
                    </a>
                </div><!-- .site-branding -->
                <div id="menu-right" class="site-navigation columns large-6 large-offset-2">
                    <?php wp_nav_menu(array('theme_location' => 'desktop-menu')); ?>
                </div><!-- #site-navigation -->
            </div>
        </div>
        <div class="container show-for-medium-down hide-for-large">
            <div class="row  mobile-row flex-header">
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