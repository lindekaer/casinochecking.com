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
session_start();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M8T2B4D');</script>
<!-- End Google Tag Manager -->
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if(is_post_type_archive('casino')): ?>
<!-- <link rel="alternate" hreflang="da-dk" href="https://casinochecking.com/da/" />
<link rel="alternate" hreflang="en-us" href="https://casinochecking.com/" /> -->
<?php endif; ?>

<?php wp_head(); ?>
</head>
<?php
//if (!isset($_SESSION['countryCode']) || $_SESSION['countryCode'] == ''):
//$ip = $_SERVER['REMOTE_ADDR'];
//$countryCode = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
//$_SESSION["countryCode"] = $countryCode['geoplugin_countryCode'];
//endif;
?>
<body <?php body_class(); ?> id="fade-in" data-user-country="">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M8T2B4D" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div id="page" class="site">
        <header id="masthead" class="site-header slide-down z-index-high">
            <div class="container height z-index-high">
                <div class="row flex-header show-for-large desktop-row z-index-high">
                    <div class="large-3 columns site-navigation position-relative" id="menu-left">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logo-link">
                            <?php include(locate_template('template-parts/parts/logo.php')); ?>
                        </a>
                    </div><!-- .site-branding -->
                    <div id="menu-right" class="site-navigation columns large-6 large-offset-3">
                        <?php wp_nav_menu(array('theme_location' => 'desktop-menu')); ?>
                    </div><!-- #site-navigation -->
                </div> 
                <div class="row show-for-medium-down hide-for-large mobile-row flex-header bg-black">
                    <div class="mobile-logo small-8 medium-4 large-2 columns">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="logo-link">
                            <?php include(locate_template('template-parts/parts/logo.php')); ?>
                        </a>
                    </div>
                    <div class="hamburger z-index-high">
                        <a id="nav-toggle" href="#"><span></span></a>
                    </div>
                </div>
            </div>
        </header><!-- #masthead -->
        <?php wp_nav_menu( array( 'theme_location' => 'mobile-header' ) ); ?>
        <div id="content" class="site-content">