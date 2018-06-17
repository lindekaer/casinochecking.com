<div class="footer-casino-name small-6 columns text-center">
    <div class="footer-name">
        <p class="red-color">
            <?php echo the_field('name'); ?>
        </p>
    </div>
    <div class="footer-score">
        <?php include(locate_template('template-parts/parts/user-rating.php')); ?>
        <p class="align-middle"><?php echo the_field('our_score'); ?>/10</p>
    </div>
</div>
<div class="get-bonus small-6 columns text-center align-middle">
    <a target="_blank"
       class="button deep-link-button footer-page-button" <?php include(locate_template('template-parts/parts/deep-link.php')); ?> ><?php echo _e('Sign up', 'checkmate'); ?></a>
</div>

