<div class="footer-casino-name small-6 columns text-center">
    <div class="footer-name">
        <p class="red-color">
            <?php echo the_field('name'); ?>
        </p>
    </div>
    <div class="footer-score">
        <p class="align-middle"><?php the_field('signup_bonus'); ?>%<span
                    style="font-size: 12px;"> up to </span><span
                    class="numeric_currency"><?php the_field('up_to_signup'); ?></span><span class="currency-type"></p>
    </div>
</div>
<div class="get-bonus small-6 columns text-center align-middle">
    <a target="_blank"
       class="button deep-link-button footer-page-button" <?php include(locate_template('template-parts/parts/deep-link.php')); ?> ><?php echo _e('Sign up', 'checkmate'); ?></a>
</div>

