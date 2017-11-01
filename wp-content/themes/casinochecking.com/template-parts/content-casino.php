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
$imageSize = 'full';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container minus-margin">
        <div class="bg-gray">
            <div class="row">
                <div class="small-12 columns" id="casino-outer-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="small-5 columns casino-logo">
                                <?php echo wp_get_attachment_image($image['id'], $imageSize); ?>
                            </div>
                            <div class="small-7 columns casino-info-wrapper">
                                <div>
                                    <div class="row padding-casino">
                                        <div class="small-8 border-right columns">
                                            <h2 class="casino-title"><?php echo $name; ?></h2>
                                            <?php include(locate_template('template-parts/parts/user-rating.php')); ?>
                                        </div>
                                        <div class="small-4 our-score columns">
                                            <div style="width: 100%;">
                                                <h1><?php echo $ourScore; ?></h1>
                                                <p>Score</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="further-casino-info">
                                        <div class="row">
                                            <div class="small-6 columns">
                                                <h4><?php echo $signUpBonus ?>$</h4>
                                                <p>Signup bonus</p>
                                            </div>
                                            <div class="small-6 columns">
                                                <h4><?php echo $minimumDeposit; ?>$</h4>
                                                <p>Deposit</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="small-12 columns">
                                <a href="<?php echo $deepUrl; ?>" class="button content-page-button">Get Bonus</a>
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
                <a href="<?php echo $deepUrl; ?>" class="button content-page-button" id="fixed-button">Get Bonus</a>
            </div>
        </div>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
