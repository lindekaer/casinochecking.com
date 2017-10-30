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

<footer id="colophon" class="site-footer">
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
    endif;
    ?>
</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
