<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package checkmate
 */

?>

</div><!-- #content -->
<footer id="colophon" class="site-footer bg-gray">
    <div class="container" id="desktop-footer">
        <div class="row">
            <div class="small-12 columns">
                <div class="footer-heading">
                    <h2 class="cursive-headline"><?php echo _e('How we compare casinos', 'checkmate'); ?> </h2>
                </div>
                <div class="footer-subheading"></div>
            </div>
        </div>
        <div class="row" >
            <?php if( have_rows('footer_repeater_desc', 'options') ):
            while ( have_rows('footer_repeater_desc', 'options') ) : the_row(); ?>
            <?php 
            $iconDesc = get_sub_field('footer_icon_desc', 'options');
            $headlineDesc = get_sub_field('footer_headline_desc', 'options');
            $textDesc = get_sub_field('footer_text_desc', 'options'); ?>
            <div class="small-6 medium-3 columns footer-wrapper">
                <div class="row">
                    <div class="small-12 columns">
                        <div class="icon-footer">
                            <?php                                         
                            $size = 'logo-blog-archive'; 
                            if( $iconDesc ) 
                            {
                                echo wp_get_attachment_image( $iconDesc, $size );
                            }  ?>
                        </div>
                        <div class="desc-footer">
                            <div class="headline-footer"><h5><?php echo $headlineDesc; ?></h5></div>
                            <div class="text-footer"><p><?php echo $textDesc; ?></p></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif;  ?>
    <?php wp_reset_query(); ?>
</div>
</div>


<div class="row show-for-medium-down hide-for-large" id="mobile-footer">
    <?php
    $selectedCasinoID = get_field('choose_selected_casino', 'options')->ID;
    // get_the_ID()
    $args = array(
        'post_type'      => 'casino',
        'p'               => $selectedCasinoID 
    );

    ?>
    <div class="small-12 columns">
        <?php 
        $the_query = new WP_Query( $args );
        if($the_query->have_posts()) {
         while( $the_query->have_posts() ) : $the_query->the_post(); ?>
         <div class="row">
             <div class="footer-casino-name small-6 columns text-center">
                <div class="footer-name">
                    <p><span class="red-color">Popular:</span> <?php echo the_field('name'); ?></p>
                </div>
                <div class="footer-score">
                    <?php include(locate_template('template-parts/parts/user-rating.php')); ?>
                    <p class="align-middle"><?php echo the_field('our_score'); ?>/10</p>
                </div>
            </div>
            <div class="get-bonus small-6 columns align-middle">
                <a target="_blank" href="<?php the_field('deep_url') ?>" class="button footer-page-button">Get Bonus</a>
            </div>
        </div>
        <div class="extra-info">
            <div class="row">
                <div class="small-6 columns">
                    <div class="footer-bonus text-center">
                        <p>SIGN-UP BONUS</p>
                        <h5><?php the_field('signup_bonus'); ?>$</h5>
                    </div>
                </div>
                <div class="small-6 columns">
                    <div class="footer-deposit text-center">
                        <p>MINIMUM DEPOSIT</p>
                        <h5><?php the_field('minimum_deposit'); ?>$</h5>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; 
}
wp_reset_query();
?>
</div>
</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
