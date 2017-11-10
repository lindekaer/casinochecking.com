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

add_action('wp_ajax_nopriv_filter_casino', 'filter_casino');
add_action('wp_ajax_filter_casino', 'filter_casino');

function filter_casino() {
    $arrayPosts = Array(
        'filter_type_score' => 'filter_type_score', 
        'filter_type_votes' => 'filter_type_votes', 
        'filter_type_deposit' => 'filter_type_deposit', 
        'filter_type_signup-bonus' => 'filter_type_signup-bonus',
        'sort-active' => 'active',
    );

    //If filter is not set, then add null   
    foreach ($arrayPosts as $key => $value){
        $filterArr[$key] = (isset($_POST[$value])) ? $_POST[$value] : null;
    }

    $args = array(
        'numberposts'   => -1,
        'post_type'     => 'casino',
        'post_status' => 'publish',
        'orderby' => 'signup_bonus',
        'order' => 'DESC'
    );

    if($filterArr['sort-active']) {
        $sortType = $filterArr['sort-active'];
        $args['orderby'] = $sortType;
    }
        //Bonus
    $min_signup_bonus = $_POST['min_signup-bonus'];
    $max_signup_bonus = $_POST['max_signup-bonus'];
    $query_vars_signup_bonus = array(
        "relation" => 'AND', 
        array(
            "key" => "signup_bonus",
            'compare' => '>=',
            'value' => intval($min_signup_bonus),
            'type' => 'numeric'
        ),
        array(
            "key" => "signup_bonus",
            'compare' => '<=',
            'value' => intval($max_signup_bonus),
            'type' => 'numeric'
        )
    );
    $args['meta_query'] = $query_vars_signup_bonus;

        //Deposit
    $min_deposit = $_POST['min_deposit'];
    $max_deposit = $_POST['max_deposit'];
    $query_vars_deposit = array(
        "relation" => 'AND', 
        array(
            "key" => "minimum_deposit",
            'compare' => '>=',
            'value' => intval($min_deposit),
            'type' => 'numeric'
        ),
        array(
            "key" => "minimum_deposit",
            'compare' => '<=',
            'value' => intval($max_deposit),
            'type' => 'numeric'
        )
    );
    $args['meta_query'][] = $query_vars_deposit;

        //Votes
    $min_votes = $_POST['min_votes'];
    $max_votes = $_POST['max_votes'];
    $query_vars_votes = array(
        "relation" => 'AND', 
        array(
            "key" => "user_votes",
            'compare' => '>=',
            'value' => intval($min_votes),
            'type' => 'numeric'
        ),
        array(
            "key" => "user_votes",
            'compare' => '<=',
            'value' => intval($max_votes),
            'type' => 'numeric'
        )
    );
    $args['meta_query'][] = $query_vars_votes;

    //Score
    $min_score = $_POST['min_score'];
    $max_score = $_POST['max_score'];
    $query_vars_score = array(
        "relation" => 'AND', 
        array(
            "key" => "our_score",
            'compare' => '>=',
            'value' => intval($min_score),
            'type' => 'numeric'
        ),
        array(
            "key" => "our_score",
            'compare' => '<=',
            'value' => intval($max_score),
            'type' => 'numeric'
        )
    );
    $args['meta_query'][] = $query_vars_score;

    $the_query = new WP_Query( $args );

    if($the_query->have_posts()) {
        while( $the_query->have_posts() ) : $the_query->the_post();
          include(locate_template('template-parts/parts/casino-teaser.php')); 
      endwhile;
  }
  else {
    echo '<h2>No results.. please adjust your criterias.</h2>';
}
wp_reset_query();
die();
}

add_action("pre_get_posts", "custom_front_page");
function custom_front_page($wp_query)
{
    if (is_admin()) {
        return;
    }

    if ($wp_query->get('page_id') == get_option('page_on_front')):

        $wp_query->set('post_type', 'casino');
        $wp_query->set('page_id', ''); 

        $wp_query->is_page = 0;
        $wp_query->is_singular = 0;
        $wp_query->is_post_type_archive = 1;
        $wp_query->is_archive = 1;
    endif;
}


if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme Footer Settings',
        'menu_title' => 'Footer',
        'parent_slug' => 'theme-general-settings',
    ));
}

if (!function_exists('checkmate_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function checkmate_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on checkmate, use a find and replace
         * to change 'checkmate' to the name of your theme in all the template files.
         */
        load_theme_textdomain('checkmate', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'desktop-menu' => esc_html__('Desktop - Header', 'checkmate'),
            'mobile-header' => esc_html__('Mobile Header', 'checkmate'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('checkmate_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'checkmate_setup');

function create_post_type()
{
    register_post_type('casino',
        array(
            'labels' => array(
                'name' => __('Casino'),
                'singular_name' => __('casinos')
            ),
            'public' => true,
            'has_archive' => true,
            'dash-icon' => 'dashicons-chart-area',
        )
    );

    register_post_type('blog',
        array(
            'labels' => array(
                'name' => __('Blog'),
                'singular_name' => __('blogs')
            ),
            'public' => true,
            'has_archive' => true,
            'dash-icon' => 'dashicons-chart-area',
        )
    );
}
add_action('init', 'create_post_type');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function checkmate_content_width()
{
    $GLOBALS['content_width'] = apply_filters('checkmate_content_width', 640);
}

add_action('after_setup_theme', 'checkmate_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function checkmate_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'checkmate'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'checkmate'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'checkmate_widgets_init');

function accept_svg($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'accept_svg');

/**
 * Google fonts
 */
function google_fonts()
{
    $query_args = array(
        'family' => 'Lato|Roboto|Varela|Cormorant+Garamond'
    );
    wp_register_style('google_fonts', add_query_arg($query_args, "//fonts.googleapis.com/css"), array(), null);
}

add_action('wp_enqueue_scripts', 'google_fonts');

/**
 * Enqueue scripts and styles.
 */
function checkmate_scripts() {

    wp_enqueue_style( 'checkmate-jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css' );
    wp_enqueue_style( 'checkmate-style', get_stylesheet_uri() );

    // jquery
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    wp_enqueue_script('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array(), null, true);
    

    // foundation scripts
    wp_enqueue_script( 'checkmate-what-input', get_template_directory_uri() . '/bower_components/what-input/dist/what-input.js', array(), '20151215', true );
    wp_enqueue_script( 'checkmate-foundation', get_template_directory_uri() . '/bower_components/foundation-sites/dist/js/foundation.js', array(), '20151215', true );

    // theme scripts
    wp_enqueue_script( 'checkmate-fontawesome', 'https://use.fontawesome.com/ccfb9ddc23.js', array(), '20151215', false );
    wp_enqueue_script( 'checkmate-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20151215', true );
    wp_localize_script( 'checkmate-scripts', 'site_vars', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'theme_url' => get_template_directory_uri()
    ));

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
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

add_action( 'pre_get_posts', 'my_change_sort_order'); 
function my_change_sort_order($query){
    if(is_archive()):
       $query->set( 'orderby', 'signup_bonus' );
       $query->set( 'order', 'ASC' );
   endif;    
};    

//Image crop
add_image_size( 'logo-casino-content', 400, 400, true ); 
add_image_size( 'logo-casino-archive', 260, 50, true );
add_image_size( 'logo-blog-archive', 400, 250, true ); 


/*Admin*/
function login_logo()
{
    ?>
    <style type="text/css">
    body.login div#login h1 a {
        background-image: url(<?php echo get_template_directory_uri() . '/screenshot.png'; ?>);
        / / Add your own logo image in this url padding-bottom: 30 px;
        background-size: 100%;
        width: 320px;
        height: 240px;
    }
</style>
<?php
}

add_action('login_enqueue_scripts', 'login_logo');?>