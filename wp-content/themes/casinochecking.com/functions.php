<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * checkmate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package checkmate
 */

/* Adding new tab */
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
}

if ( ! function_exists( 'checkmate_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function checkmate_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on checkmate, use a find and replace
		 * to change 'checkmate' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'checkmate', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'desktop-menu' => esc_html__( 'Desktop - Header', 'checkmate' ),
			'mobile-header' => esc_html__( 'Mobile Header', 'checkmate' ),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'checkmate_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'checkmate_setup' );

function create_post_type() {
	register_post_type( 'casino',
		array(
			'labels' => array(
				'name' => __( 'Casino' ),
				'singular_name' => __( 'casinos' )
			),
			'public' => true,
			'has_archive' => true,
			'dash-icon' => 'dashicons-chart-area',
		)
	);
}
add_action( 'init', 'create_post_type' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function checkmate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'checkmate_content_width', 640 );
}
add_action( 'after_setup_theme', 'checkmate_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function checkmate_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'checkmate' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'checkmate' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'checkmate_widgets_init' );

function accept_svg($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'accept_svg');

/**
 * Google fonts
 */
function google_fonts() {
	$query_args = array(
		'family' => 'Lato|Roboto'
	);
	wp_register_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
            }
            
add_action('wp_enqueue_scripts', 'google_fonts');

/**
 * Enqueue scripts and styles.
 */
function checkmate_scripts() {
	wp_enqueue_style( 'checkmate-style', get_stylesheet_uri() );

	// jquery
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

	// foundation scripts
	wp_enqueue_script( 'checkmate-what-input', get_template_directory_uri() . '/bower_components/what-input/dist/what-input.js', array(), '20151215', true );
	wp_enqueue_script( 'checkmate-foundation', get_template_directory_uri() . '/bower_components/foundation-sites/dist/js/foundation.js', array(), '20151215', true );

	// theme scripts
	wp_enqueue_script( 'checkmate-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'checkmate_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*Admin*/
function login_logo() { 
?> 
<style type="text/css"> 
	body.login div#login h1 a {
		background-image: url(<?php echo get_template_directory_uri() . '/screenshot.png'; ?>);  //Add your own logo image in this url 
		padding-bottom: 30px; 
		background-size: 100%;
		width: 320px;
		height: 240px;
	} 
</style>
<?php 
} add_action( 'login_enqueue_scripts', 'login_logo' );