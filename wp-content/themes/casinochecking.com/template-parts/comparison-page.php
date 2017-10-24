<?php $args = array(
    'numberposts' => -1,
    'post_type' => 'casino',
);
$the_query = new WP_Query($args);
?>
<section class="bg-img" style="background: url('http://localhost/casinochecking.com/wp-content/uploads/2017/10/casino-bg.jpg') no-repeat center center fixed;">
    <div class="container padding-top">
        <div class="row welcome-row">
            <div class="small-12 columns fade-in-slow">
                <h1 >Best bonus.</h1>
                <h1>Largest profit.</h1>
            </div>
        </div>
        <div class="container bg-white wrapper-casino-comparison slide-up">
            <div class="row">
                <div class="small-12 columns">
                    <h2 class="headline-casino-h2">Top-rated online casinos</h2>
                </div>
                <div class="small-12 medium-4 columns">
                </div><?php
                if ($the_query->have_posts()): ?>
                    <div class="small-12 medium-8 columns">
                        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <div class="row casino-wrapper">
                                <?php
                                $image = get_field('image');
                                $imageSize = 'thumbnail';
                                $deepUrl = get_field('deep_url');
                                $ourScore = get_field('our_score');
                                $userVotes = get_field('user_votes');
                                $signUpBonus = get_field('signup_bonus');
                                $minimumDeposit = get_field('minimum_deposit'); ?>

                                <div class="small-6 columns border-right my-align-center">
                                    <div style="width: 100%;">
                                        <div class="image section-padding">
                                            <a href="<?php echo the_permalink(); ?>">
                                                <?php echo wp_get_attachment_image($image['id'], $imageSize); ?>
                                            </a>
                                        </div>
                                        <div class="user-rating section-padding-bottom">
                                            <div class="row">
                                                <div class="small-6 columns">
                                                    <p>User rating</p>
                                                    <?php include(locate_template('template-parts/parts/user-rating.php')); ?>
                                                </div>
                                                <div class="small-6 columns">
                                                    <p>score</p>
                                                    <h2><?php echo $ourScore; ?></h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="small-6 columns my-align-center">
                                    <div style="width: 100%;">
                                        <div class="image-ratings section-padding">
                                            <div class="row">
                                                <div class="small-6 border-right">
                                                    <p>Bonus</p>
                                                    <h4><?php echo $signUpBonus; ?>$</h4>
                                                </div>
                                                <div class="small-6">
                                                    <p>Deposit</p>
                                                    <h4><?php echo $minimumDeposit; ?>$</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bonus-info button-padding-bottom">
                                            <a href="<?php echo $deepUrl; ?>" class="button">Get Bonus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

