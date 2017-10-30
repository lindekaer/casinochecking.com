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
        <?php
        // check if the repeater field has rows of data
        if (have_rows('footer_repeater')):
            // loop through the rows of data
            while (have_rows('footer_repeater')) : the_row();
                // display a sub field value
                $name = get_sub_field('name');
                $link = get_sub_field('link');
                $icon = get_sub_field('icon'); ?>
                <div class="small-3 footer-section">
                    <a href="<?php echo $link; ?>">
                        <div class="icon">
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>"/>
                        </div>
                        <div class="footer-text">
                            <p><?php echo $name; ?></p>
                        </div>
                    </a>
                </div>
            <?php endwhile;
        endif; ?>
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
