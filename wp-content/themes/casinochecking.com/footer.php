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
    <?php if( have_rows('footer_repeater', 'options') ):
    while ( have_rows('footer_repeater', 'options') ) : the_row();
        $name = get_sub_field('footer_name', 'options');
        $link = get_sub_field('footer_link', 'options');
        $icon = get_sub_field('footer_icon', 'options'); ?>
        <div class="small-3 footer-section">
            <a href="<?php echo $link; ?>">
                <div class="icon">
                    <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt'] ?>" />
                </div>
                <div class="footer-text">
                    <p>  <?php echo $name; ?></p>
                </div>
            </a>
        </div>
    <?php  endwhile;
    endif; ?>
</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
