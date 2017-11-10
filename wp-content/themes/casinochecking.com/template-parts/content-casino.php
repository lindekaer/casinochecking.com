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
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container minus-margin">
        <div class="row">
            <div class="small-4 columns bg-sidebar wrapper-casino-comparison border-radius-left">
                <?php echo get_sidebar(); ?>
            </div>
            <div class="small-8 columns bg-gray border-radius-right" id="casino-outer-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="small-5 columns casino-logo">
                            <?php echo wp_get_attachment_image($image['id'], $imageSize); ?>
                        </div>
                        <div class="small-7 columns casino-info-wrapper">
                            <div>
                                <div class="row padding-casino">
                                    <div class="small-3 columns">
                                        <p>Signup bonus</p>
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
                    <div class="container">
                        <div class="row">
                            <div class="small-12 columns desc">
                                <?php echo $description; ?>
                            </div>
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
