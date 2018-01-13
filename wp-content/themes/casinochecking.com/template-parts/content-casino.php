<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package checkmate
 */

$name = get_field('name');
$image = get_field('image_post');
$deepUrl = get_field('deep_url');
$ourScore = get_field('our_score');
$signUpBonus = get_field('signup_bonus');
$minimumDeposit = get_field('minimum_deposit');
$description = get_field('description');
$imageSize = 'logo-casino-content';
$sectionBg = get_field('section_bg');
$activateOverlay = get_field('activate_overlay');
$imageLong = get_field('image');
$upToSignup = get_field('up_to_signup');
$imageSizeLong = 'logo-casino-archive'; ?>
<section class="bg-img content-casino <?php if($activateOverlay): echo 'overlay'; endif;?>" style="background: url('<?php echo $sectionBg; ?>') no-repeat center center fixed;">
    <article id="post-<?php the_ID(); ?>" <?php post_class('comparison-section z-index'); ?>>
        <div class="container">
            <div class="row">
                <div class="small-12 large-4 small-order-2 large-order-1 columns margin-top bg-sidebar slide-up wrapper-casino-comparison">
                    <?php echo get_sidebar(); ?>
                </div>
                <div class="small-12 large-8 small-order-1 bg-dark-gray margin-top large-order-2 columns slide-up" id="casino-outer-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="medium-4 large-5 hide-for-small-only columns casino-logo">
                                <div class="position-relative">
                                    <?php echo wp_get_attachment_image($image['id'], $imageSize); ?>
                                    <div class="ribbon-wrapper hide-custom">
                                        <div class="rectangle" data-casino-id="<?php echo get_the_ID(); ?>">
                                            <span class="casino-available hide-custom">
                                                <p>
                                                    <?php echo _e('Players from', 'checkmate'); ?> <span class="user-country"></span> <?php echo _e('accepted', 'checkmate'); ?></p><img class="checked-svg" src="<?php echo get_stylesheet_directory_uri(); ?>/img/checked.svg"></span>
                                                    <span class="casino-not-available hide-custom"><p><?php echo _e('Not available in', 'checkmate'); ?> <span class="user-country"></span> </p></span>
                                                </div>
                                                <div class="triangle-l"></div>
                                                <div class="triangle-r"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="small-12 show-for-small-only logo-wrapper-small columns text-center">
                                        <?php echo wp_get_attachment_image($imageLong['id'], $imageSizeLong); ?>
                                    </div>
                                    <div class="small-12 medium-8 large-7 columns">
                                        <div class="container">
                                            <div class="row padding-casino casino-info-wrapper">
                                                <div class="small-3">
                                                    <p><span class="hide-for-small-only"><?php echo _e('Signup', 'checkmate'); ?></span><?php echo _e('bonus', 'checkmate'); ?></p>
                                                    <h6 class="number"><?php echo $signUpBonus ?>%</h6>
                                                </div>
                                                <div class="small-3">
                                                    <p><?php echo _e('Deposit', 'checkmate'); ?></p>
                                                    <h6><span data-value="<?php echo $minimumDeposit; ?>" class="numeric_currency"><?php echo $minimumDeposit; ?></span><span class="currency-type"></h6>
                                                    </div>
                                                    <div class="small-3">
                                                        <p><?php echo _e('User rating', 'checkmate'); ?></p>
                                                        <?php include(locate_template('template-parts/parts/user-rating.php')); ?>
                                                    </div>
                                                    <div class="small-3">
                                                        <p>Score</p>
                                                        <h6 class="number"><?php echo $ourScore; ?><span class="rating-ten">/10</span></h6>
                                                    </div>
                                                </div>
                                                <div class="further-casino-info">
                                                    <div class="row">
                                                        <div class="small-12">
                                                            <a target="_blank" <?php include(locate_template('template-parts/parts/deep-link.php')); ?>  class="button content-page-button cta-button deep-link-button"><?php echo _e('Sign up', 'checkmate'); ?></a>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="small-12 columns desc">
                                            <h1 class="text-left content-casino cursive-headline"><?php echo $name . ' '; echo _e('review', 'checkmate');?></h1>
                                            <?php echo $description; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
            <script type="application/ld+json">
                {
                  "@context": "http://schema.org/",
                  "@type": "Review",
                  "itemReviewed": {
                    "@type": "Thing",
                    "name": "<?php echo $name; ?>"
                },
                "image": "<?php echo wp_get_attachment_image_url($image['id'], $imageSize); ?>",
                "author": {
                    "@type": "Organization",
                    "name": "Casinochecking",
                    "url": "https://casinochecking.com/"
                },
                "reviewRating": {
                    "@type": "Rating",
                    "ratingValue": "<?php echo $ourScore; ?>",
                    "bestRating": "10",
                    "worstRating": "0"
                }
            }
        </script>