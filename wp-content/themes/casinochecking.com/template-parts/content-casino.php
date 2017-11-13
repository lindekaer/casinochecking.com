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
$userVotes = get_field('user_votes');
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
<article id="post-<?php the_ID(); ?>" <?php post_class('comparison-section z-index'); ?>>
    <div class="container">
        <div class="row">
            <div class="small-12 large-4 small-order-2 large-order-1 columns bg-sidebar wrapper-casino-comparison border-radius-left">
                <?php echo get_sidebar(); ?>
            </div>
            <div class="small-12 large-8 small-order-1 large-order-2 columns bg-gray border-radius-right" id="casino-outer-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="medium-6 hide-for-small-only large-5 columns casino-logo">
                            <?php echo wp_get_attachment_image($image['id'], $imageSize); ?>
                        </div>
                        <div class="small-12 show-for-small-only logo-wrapper-small columns text-center">
                            <?php echo wp_get_attachment_image($imageLong['id'], $imageSizeLong); ?>
                        </div>
                        <div class="small-12 medium-6 large-7 columns casino-info-wrapper">
                            <div>
                                <div class="row padding-casino">
                                    <div class="small-3 columns">
                                        <p><span class="hide-for-small-only">Signup </span>bonus</p>
                                        <h4 class="number"><?php echo $signUpBonus ?>$</h4>
                                    </div>
                                    <div class="small-3 columns ">
                                        <p>Deposit</p>
                                        <h4 class="number"><?php echo $minimumDeposit; ?>$</h4>
                                    </div>
                                    <div class="small-3">
                                        <p>User rating</p>
                                        <?php include(locate_template('template-parts/parts/user-rating.php')); ?>
                                    </div>
                                    <div class="small-3 columns">
                                        <p>Score</p>
                                        <h4 class="number"><?php echo $ourScore; ?></h4>
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
</article><!-- #post-<?php the_ID(); ?> -->
