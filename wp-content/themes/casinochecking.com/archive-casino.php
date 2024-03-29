<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package checkmate
 */
get_header(); ?>
<?php $activateOverlay = get_field('activate_overlay_casino', 'options');
$casinoImg = get_field('casino_img', 'options')['sizes']['bg-img'];
?>
    <section class="bg-img casinos" style="background: url(<?php echo $casinoImg; ?>)">
        <div class="container mobile-full-width">
            <div class="row welcome-row mobile-bg" style="background: url(<?php echo $casinoImg; ?>)">
                <div class="small-12 medium-8 medium-offset-2 columns fade-in-slow z-index-medium welcome-text">
                    <h1><?php the_field('heading_first_line_casino', 'options'); ?></h1>
                </div>
            </div>
            <div class="row comparison-section">
                <?php include(locate_template('template-parts/parts/casino-sidebar.php')); ?>
                <div class="small-12 medium-8 margin-top-fp bg-gray columns wrapper-casino-comparison slide-up z-index-medium content-casino">
                    <div class="container">
                        <div class="row">
                            <div class="small-12 align-right filter-wrapper columns">
                                <div class="row">
                                    <div class="selected-currency small-6 medium-2 medium-offset-5 filter-padding">
                                        <div class="naming-casino margin-mobile show-for-small-only">
                                            <p><?php echo _e('Currency', 'checkmate'); ?></p></div>
                                        <select id="currencySelect" class="float-left-mobile">
                                            <option value="USD" data-currency="$">USD ($)</option>
                                            <option value="EUR" data-currency="€">EUR (€)</option>
                                            <option value="GBP" data-currency="£">GBP (£)</option>
                                            <option value="DKK" data-currency="DKK">DKK</option>
                                            <option value="NOK" data-currency="NOK">NOK</option>
                                        </select>
                                    </div>
                                    <div class="small-6 medium-3 filter-padding">
                                        <?php include(locate_template('template-parts/parts/content-country.php')); ?>
                                    </div>
                                    <div class="sorting hide-for-small-only medium-2 filter-padding align-middle-center">
                                        <div>
                                            <p class="filter-score filter active-sort"
                                               data-filter="our_score"><?php echo _e('Score', 'checkmate'); ?></p>
                                            <p class="filter-bonus filter"
                                               data-filter="signup_bonus"><?php echo _e('Bonus', 'checkmate'); ?></p>
                                            <!-- <p class="filter-deposit filter" data-filter="minimum_deposit"><?php //echo _e('Deposit', 'checkmate'); ?></p> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="small-12 columns load-casino hidden-overflow">
                        <div class="load-wrapper">
                            <div class="loader">
                            </div>
                        </div>
                    </div>
                    <div class="loaded-posts" data-count="">
                    </div>
                    <p class="text-right small-font"><?php echo _e('T&C apply to each of the offers above, click "Sign up" for more details.', 'checkmate'); ?></p>
                    <div class="load-more">
                        <div class="load-wrapper">
                            <div class="loader">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white section-compare-casino">
        <div class="container">
            <div class="row">
                <div class="small-12 large-6 columns fade-in-child">
                    <h3 class="cursive-headline color-red text-left section-heading"><?php echo _e('Compare online casinos', 'checkmate'); ?></h3>
                    <?php the_field('description_online_casinos', 'options'); ?>
                </div>
                <div class="small-6 columns text-center hide-for-small-only hide-for-medium-only">
                    <img class="img-section" src="<?php the_field('casino-container-bg', 'options'); ?>">
                </div>
            </div>
        </div>
    </section>
<?php
$args_blog = array(
    'posts_per_page' => 3,
    'offset' => 0,
    'post_type' => 'blog',
    'meta_key' => 'blog_category',
    'meta_value' => 'How to play'
);
$the_query_blog = new WP_Query($args_blog);
?>
<?php if ($the_query_blog->have_posts()): ?>
    <section class="bg-gray section-padding-guides">
        <div class="container">
            <h2 class="cursive-headline text-center section-heading fade-in-child"><?php echo _e('Tips & Tricks', 'checkmate'); ?></h2>
            <div class="row list">
                <?php while ($the_query_blog->have_posts()) : $the_query_blog->the_post(); ?>
                    <div class="small-12 medium-6 large-4 columns list-item fade-in-child">
                        <?php include(locate_template('template-parts/parts/blog-teaser.php')); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<?php wp_reset_query(); ?>
<?php include(locate_template('template-parts/parts/flexible-content.php')); ?>
<?php get_footer();