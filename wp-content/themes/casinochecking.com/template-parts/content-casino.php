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
$imageSizeLong = 'logo-casino-archive';
?>
<section class="bg-img content-casino <?php if($activateOverlay): echo 'overlay'; endif;?>" style="background: url('<?php echo $sectionBg; ?>') no-repeat center center fixed;">
</section>
<article id="post-<?php the_ID(); ?>" <?php post_class('comparison-section z-index bg-dark-gray'); ?>>
    <div class="container">
        <div class="row">
            <div class="small-12 large-4 small-order-2 large-order-1 columns bg-sidebar slide-up wrapper-casino-comparison minus-content-sidebar">
                <?php echo get_sidebar(); ?>
            </div>
            <div class="small-12 large-8 small-order-1 large-order-2 columns bg-gray slide-up minus-content" id="casino-outer-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="medium-4 large-5 hide-for-small-only columns casino-logo">
                            <?php echo wp_get_attachment_image($image['id'], $imageSize); ?>
                        </div>
                        <div class="small-12 show-for-small-only logo-wrapper-small columns text-center">
                            <?php echo wp_get_attachment_image($imageLong['id'], $imageSizeLong); ?>
                        </div>
                        <div class="small-12 medium-8 large-7 columns">
                            <div class="container">
                                <div class="row padding-casino casino-info-wrapper">
                                    <div class="small-3">
                                        <p><span class="hide-for-small-only">Signup </span>bonus</p>
                                        <h4 class="number"><?php echo $signUpBonus ?>$</h4>
                                    </div>
                                    <div class="small-3">
                                        <p>Deposit</p>
                                        <h4 class="number"><?php echo $minimumDeposit; ?>$</h4>
                                    </div>
                                    <div class="small-3">
                                        <p>User rating</p>
                                        <?php include(locate_template('template-parts/parts/user-rating.php')); ?>
                                    </div>
                                    <div class="small-3">
                                        <p>Score</p>
                                        <h4 class="number"><?php echo $ourScore; ?>/10</h4>
                                    </div>
                                </div>
                                <div class="further-casino-info">
                                    <div class="row">
                                        <div class="small-12">
                                            <a href="<?php echo $deepUrl; ?>" class="button content-page-button">Get Bonus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns desc">
                            <?php echo $description; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <a href="<?php echo $deepUrl; ?>" class="button content-page-button" id="fixed-button">Get Bonus</a>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> 