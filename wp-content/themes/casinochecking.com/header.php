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
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css?family=Varela|Cormorant+Garamond|Roboto|Lato:300,400" rel="stylesheet">
    <?php wp_head(); ?>  
</head>
<?php 
$IPaddress = $_SERVER['REMOTE_ADDR'];
$details = ip_details("$IPaddress");
?>
<body <?php body_class(); ?> id="fade-in" data-user-country="<?php if(isset($details->country)): echo $details->country; endif; ?>">
    <div id="page" class="site">
        <header id="masthead" class="site-header slide-down z-index-high">
            <div class="container height z-index-high">
                <div class="row flex-header show-for-large desktop-row z-index-high">
                    <div class="large-3 columns site-navigation" id="menu-left">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php include(locate_template('template-parts/parts/logo.php')); ?>
                        </a>
                    </div><!-- .site-branding -->
                    <div id="menu-right" class="site-navigation columns large-6 large-offset-3">
                        <?php wp_nav_menu(array('theme_location' => 'desktop-menu')); ?>
                    </div><!-- #site-navigation -->
                </div> 
                <div class="row show-for-medium-down hide-for-large mobile-row flex-header bg-black">
                    <div class="mobile-logo small-8 medium-4 large-2 columns">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php include(locate_template('template-parts/parts/logo.php')); ?>
                        </a>
                    </div>
                    <div class="hamburger z-index-high">
                        <a id="nav-toggle" href="#"><span></span></a>
                    </div>
                </div>
            </div>
            <?php wp_nav_menu( array( 'theme_location' => 'mobile-header' ) ); ?>
        </header><!-- #masthead -->
        <div id="content" class="site-content">