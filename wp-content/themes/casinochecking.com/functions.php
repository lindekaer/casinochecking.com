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

/*
* Remove SEO by Yoast's canonical on archive casino
*/

add_filter( 'wpseo_canonical', 'yoast_remove_canonical_items' );
function yoast_remove_canonical_items( $canonical ) {
  if(is_post_type_archive('casino')) {
    return false;
}
return $canonical; 
}

/*
* Remove hreflangs from frontpage (archive casino) - instead it's hardcoded in the header
*/

add_filter('wpml_hreflangs', 'custom_lang_code', 10, 1);
function custom_lang_code($hreflang_items){
    if(is_post_type_archive('casino')){
      unset ($hreflang_items);
  }
  else {
    return $hreflang_items;
}
}

/*
* REMOVES NEXT AND PREV FROM FRONTPAGE
*/
add_filter( 'wpseo_next_rel_link', 'custom_remove_wpseo_next' );
add_filter( 'wpseo_prev_rel_link', 'custom_remove_wpseo_prev' );

function custom_remove_wpseo_next( $link ) {
 if(is_post_type_archive('casino')) {
  return false;
} else { 
  return $link;
}
}
function custom_remove_wpseo_prev( $link ) {
  if(is_post_type_archive('casino')) {
      return false;
  } else { 
      return $link;
  }
}

/*
* Sets archive casino as frontpage
*/
add_action("pre_get_posts", "custom_front_page");
function custom_front_page($wp_query){
    //Ensure this filter isn't applied to the admin area
    if(is_admin()) {
        return;
    }

    if($wp_query->get('page_id') == get_option('page_on_front')):
        $wp_query->set('post_type', 'casino');
        $wp_query->set('page_id', '');

        $wp_query->is_page = 0;
        $wp_query->is_singular = 0;
        $wp_query->is_post_type_archive = 1;
        $wp_query->is_archive = 1;
    endif;
}

/*
* Ajax showing available casinos based on user IP
*/

add_action('wp_ajax_nopriv_available_casino', 'available_casino');
add_action('wp_ajax_available_casino', 'available_casino');

function available_casino() {
    $country = $_POST['country'];
    $id = $_POST['pageID'];

    $args = array(
        'post_type' => 'casino',
        'p' => $id,
        'meta_query' => array(
            array(
                'key' => 'available_countries', 
                'value' => $country, 
                'compare' => 'LIKE'
            )
        )
    );

    $the_query = new WP_Query( $args );
    $count = $the_query->found_posts;

    $result = array('found_posts' => $count, 'country' => $country);

    echo json_encode($result);

    wp_reset_query();
    die();

}

/*
* Updates currency based on the users IP
*/

add_action('wp_ajax_nopriv_currency_update', 'currency_update');
add_action('wp_ajax_currency_update', 'currency_update');

function currency_update() {

    //Args for filter
    $arrayPosts = Array(
        'previous' => 'previous',
        'after' => 'after',
        'updateCurrencyLoad' => 'updateCurrencyLoad',
    );

    //If filter is not set, then add null
    foreach ($arrayPosts as $key => $value){
        $filterArr[$key] = (isset($_POST[$value])) ? $_POST[$value] : null;
    }

    //If the loaded country is not EU
    $updateCurrencyLoad = $filterArr['updateCurrencyLoad'];

    if (isset($updateCurrencyLoad)) {
        if ($updateCurrencyLoad == 'EUR') {
            $currency = 1;
        }
        else if ($updateCurrencyLoad == 'USD') {
            $currency = get_field('eur_in_usd', 'options');
        }
        else if ($updateCurrencyLoad == 'DKK') {
            $currency = get_field('eur_in_dkk', 'options');
        }
        else if ($updateCurrencyLoad == 'GBP') {
            $currency = get_field('eur_in_gbp', 'options');
        }
        else if ($updateCurrencyLoad == 'NOK') {
            $currency = get_field('eur_in_no', 'options');
        }
        echo $currency;
    }

    else {
        if ($filterArr['previous'] == 'USD'){
            if ($filterArr['after'] == 'USD') {
                $currency = 1;
            }
            else if ($filterArr['after'] == 'EUR') {
                $currency = get_field('usd_in_eur', 'options');
            }
            else if ($filterArr['after'] == 'DKK') {
                $currency = get_field('usd_in_dkk', 'options');
            }
            else if ($filterArr['after'] == 'GBP') {
                $currency = get_field('usd_in_gbp', 'options');
            }
            else if ($filterArr['after'] == 'NOK') {
                $currency = get_field('usd_in_no', 'options');
            }
        }

        if ($filterArr['previous']== 'EUR'){
            if ($filterArr['after'] == '1') {
                $currency = 1;
            }
            else if ($filterArr['after'] == 'USD') {
                $currency = get_field('eur_in_usd', 'options');
            }
            else if ($filterArr['after'] == 'DKK') {
                $currency = get_field('eur_in_dkk', 'options');
            }
            else if ($filterArr['after'] == 'GBP') {
                $currency = get_field('eur_in_gbp', 'options');
            }
            else if ($filterArr['after'] == 'NOK') {
                $currency = get_field('eur_in_no', 'options');
            }
        }

        if ($filterArr['previous'] == 'DKK'){
            if ($filterArr['after'] == 'DKK') {
                $currency = 1;
            }
            else if ($filterArr['after'] == 'EUR') {
                $currency = get_field('dkk_in_eur', 'options');
            }
            else if ($filterArr['after'] == 'USD') {
                $currency = get_field('dkk_in_usd', 'options');
            }
            else if ($filterArr['after'] == 'GBP') {
                $currency = get_field('dkk_in_gbp', 'options');
            }
            else if ($filterArr['after'] == 'NOK') {
                $currency = get_field('dkk_in_no', 'options');
            }
        }

        if ($filterArr['previous'] == 'GBP'){
            if ($filterArr['after'] == 'GBP') {
                $currency = 1;
            }
            else if ($filterArr['after'] == 'EUR') {
                $currency = get_field('gbp_in_eur', 'options');
            }
            else if ($filterArr['after'] == 'USD') {
                $currency = get_field('gbp_in_usd', 'options');
            }
            else if ($filterArr['after'] == 'DKK') {
                $currency = get_field('gbp_in_dkk', 'options');
            }
            else if ($filterArr['after'] == 'NOK') {
                $currency = get_field('gbp_in_no', 'options');
            }
        }

        if ($filterArr['previous'] == 'NOK'){
            if ($filterArr['after'] == 'NOK') {
                $currency = 1;
            }
            else if ($filterArr['after'] == 'EUR') {
                $currency = get_field('no_in_eur', 'options');
            }
            else if ($filterArr['after'] == 'USD') {
                $currency = get_field('no_in_usd', 'options');
            }
            else if ($filterArr['after'] == 'DKK') {
                $currency = get_field('no_in_dkk', 'options');
            }
            else if ($filterArr['after'] == 'GBP') {
                $currency = get_field('no_in_gbp', 'options');
            }
        }
        echo $currency;
    }
    die();
}

/*
* Ajax, load casinos to menu based on IP
*/

add_action('wp_ajax_nopriv_add_casino_menu', 'add_casino_menu');
add_action('wp_ajax_add_casino_menu', 'add_casino_menu');

function add_casino_menu() {
    $country = $_POST['country'];
    $type = $_POST['type']; 

    $args = array(
        'post_type'     => 'casino',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => 'available_countries', 
                'value' => $country, 
                'compare' => 'LIKE'
            )
        )
    );

    if($type == 'sidebar') {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
        $args['posts_per_page'] = 5;
    }

    elseif ($type == 'menu') {
       $args['orderby'] = 'title';
       $args['order']   = 'ASC';
   }
   
   $the_query = new WP_Query( $args );

   if($the_query->have_posts()):?>
   <?php if($type == 'menu'): ?>
       <div class="container">
        <div class="row">
            <div class="small-12 columns">
                <ul class="row">
                    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <div class="small-2 columns">
                            <li><p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p></li>
                        </div>
                    <?php endwhile; ?>
                    <div class="small-2 columns">
                        <li>
                            <p><a href="<?php echo get_home_url(); ?>"><?php echo _e('All casinos', 'checkmate'); ?></a></p>
                        </li>
                    </div>
                </ul>
            </div>
        </div>
    </div>
<?php elseif($type == 'sidebar'): ?>
    <?php $i = 1; ?>
    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="border-bottom padding-sidebar-bottom recommendations fade-in">
            <?php include(locate_template('template-parts/parts/featured-casinos.php')); ?>
        </div>
        <?php $i++; ?>
    <?php endwhile; ?>
<?php endif; ?>
<?php endif;
wp_reset_query();
die();
}


/*
* Ajax, filter casinos
*/

add_action('wp_ajax_nopriv_filter_casino', 'filter_casino');
add_action('wp_ajax_filter_casino', 'filter_casino');

function filter_casino() {
    $arrayPosts = Array(
        'categories' => 'categories',
        'filter_type_score' => 'filter_type_score',
        'filter_type_votes' => 'filter_type_votes',
        'filter_type_deposit' => 'filter_type_deposit',
        'filter_type_signup-bonus' => 'filter_type_signup-bonus',
        'sort-active' => 'active',
        'posts_per_page' => 'posts_per_page',
        'country' => 'country'
    );

    //If filter is not set, then add null
    foreach ($arrayPosts as $key => $value){
        $filterArr[$key] = (isset($_POST[$value])) ? $_POST[$value] : null;
    }

    $args = array(
        'post_type'     => 'casino',
        'post_status' => 'publish',
        'meta_key' => 'our_score',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'posts_per_page'   => 50,
    );

    if($filterArr['posts_per_page']) {
        $args['numberposts'] = $filterArr['posts_per_page'];
    }

    //Checks if sort is chosen, and overwrites meta_key from $args
    if($filterArr['sort-active']) {
        $sortType = $filterArr['sort-active'];

        if($sortType == 'minimum_deposit') {
            $args['order'] = 'ASC';
        }
        $args['meta_key'] = $sortType;
    }

        //Available countries
    if($filterArr['country'] && $filterArr['country'] !== 'all') {
        $query_vars_country = array (
            'key' => 'available_countries',
            'value' => $filterArr['country'],
            'compare' => 'LIKE'
        );
        $args['meta_query'][] = $query_vars_country;
    }

     //Bonus
    if ($filterArr['filter_type_signup-bonus']) {
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
        $args['meta_query'][] = $query_vars_signup_bonus;
    }

    //Deposit
    if ($filterArr['filter_type_deposit']) {
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
    }

    //Votes
    if ($filterArr['filter_type_votes']) {
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
    }

    //Score
    if ($filterArr['filter_type_score']) {
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
    }

    $the_query = new WP_Query( $args );
    $count = $the_query->found_posts;

    if($filterArr['posts_per_page'] <= $count){
        if($the_query->have_posts()) {
           $i = 1;
           while( $the_query->have_posts() ) : $the_query->the_post(); ?>
           <div class="small-12 columns">
            <?php include(locate_template('template-parts/parts/casino-teaser.php')); ?>
        </div>
        <?php $i++;
    endwhile;
}
else {
    echo '<h6 class="text-left">No results. Please adjust your criterias.</h6>';
}
}
else {
    echo '<h6>All results are already shown</h6>';
}
wp_reset_query();
die();
}

/*
* Adding tabs in admin-dashboard for Advanced Custom Fields
*/

if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Archive Settings',
        'menu_title' => 'Archive',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme Header Settings',
        'menu_title' => 'Header',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Theme Footer Settings',
        'menu_title' => 'Footer',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title' => 'Currency Settings',
        'menu_title' => 'Currency',
        'parent_slug' => 'theme-general-settings',
    ));
}

/*
* Default setup
*/

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
            'mobile-header' => esc_html__('mobile-header', 'checkmate'),
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

/*
* Adding post types
*/

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

/*
* Accepting SVG to media library
*/

function accept_svg($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'accept_svg');

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
    //wp_enqueue_script( 'checkmate-fontawesome', 'https://use.fontawesome.com/ccfb9ddc23.js', array(), '20151215', false );
    wp_enqueue_script( 'smartlook', get_template_directory_uri() . '/js/vendor/smartlook.js', array(), '20151215', true );
    wp_enqueue_script( 'sticky', get_template_directory_uri() . '/js/vendor/sticky.min.js', array(), '20151215', true );
    wp_enqueue_script( 'checkmate-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '20151215', true );
    wp_localize_script( 'checkmate-scripts', 'site_vars', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'theme_url' => get_template_directory_uri(),
        'site_url' => get_option('siteurl')
    ));

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'checkmate_scripts' );

function wpb_add_google_fonts() {
    wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Varela|Cormorant+Garamond|Roboto|Lato:300,400', false );
}

add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

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

/*
* Image crop
*/
add_image_size( 'logo-casino-content', 400, 400, true );
add_image_size( 'logo-casino-archive', 260, 50, true );
add_image_size( 'logo-blog-archive', 400, 300, true );
add_image_size( 'bg-img', 2293, 9999);
add_image_size( 'flexible-content', 2000, 788, true);

/*
* Google Analytics tracking script
*/

add_action('wp_head', 'add_google_analytics');
function add_google_analytics() { ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108087950-2"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-108087950-2');
</script>
<?php }

/*
* Admin login styling
*/
function login_logo()
{
    ?>
    <style type="text/css">
    body.login div#login h1 a {
        background-image: url(<?php echo get_template_directory_uri() . '/screenshot.png'; ?>);
        padding-bottom: 30px;
        background-size: 100%;
        width: 320px;
        height: 240px;
    }
</style>
<?php
}

add_action('login_enqueue_scripts', 'login_logo');

/*
* Remove default emoji script
*/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

/*
* SEO by Yoast adjustments
*/
function filter_wpseo_replacements( $replacements ) {
    if( isset( $replacements['%%cf_up_to_signup%%'] ) ){
        $replacements['%%cf_up_to_signup%%'] = round($replacements['%%cf_up_to_signup%%']);
    }
    if( isset( $replacements['%%cf_minimum_deposit%%'] ) ){
        $replacements['%%cf_minimum_deposit%%'] = round($replacements['%%cf_minimum_deposit%%']);
    }
    return $replacements;
};

add_filter( 'wpseo_replacements', 'filter_wpseo_replacements', 10, 1 );

/*
* Disallow editing from backend
*/
define( 'DISALLOW_FILE_EDIT', true );


/*
* Disable comments to avoid spam
*/
function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'df_disable_comments_admin_bar');

?>