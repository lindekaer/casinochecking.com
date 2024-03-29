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
<?php
$email = get_field('email', 'options');
$cpr = get_field('cpr', 'options'); ?>
</div><!-- #content -->
<footer id="colophon" class="site-footer bg-sidebar">
    <div class="container" id="desktop-footer">
        <div class="row">
            <div class="small-12 columns">
                <div class="footer-heading">
                    <h2 class="cursive-headline medium-gray"><?php echo _e('How we compare casinos', 'checkmate'); ?> </h2>
                </div>
                <div class="footer-subheading"></div>
            </div>
        </div>
        <div class="row">
            <?php if (have_rows('footer_repeater_desc', 'options')):
                while (have_rows('footer_repeater_desc', 'options')) : the_row(); ?>
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
                                    if ($iconDesc) {
                                        echo wp_get_attachment_image($iconDesc, $size);
                                    } ?>
                                </div>
                                <div class="desc-footer">
                                    <div class="headline-footer medium-gray"><h4><?php echo $headlineDesc; ?></h4></div>
                                    <div class="text-footer"><p><?php echo $textDesc; ?></p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
    <div class="bg-sidebar footer-legal">
        <div class="container">
            <hr>
            <div class="row">
                <div class="small-12 text-center">
                    <?php the_field('footer_disclaimer_text', 'options'); ?>
                    <ul>
                        <?php if (have_rows('footer_img', 'options')):
                            while (have_rows('footer_img', 'options')) : the_row(); ?>
                                <?php

                                $image = get_sub_field('footer_single_img');

                                if (!empty($image)): ?>
                                    <li class="inline">
                                        <a rel="nofollow" target="_blank"
                                           href="<?php echo get_sub_field('footer_single_link') ?>">
                                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                                        </a>
                                    </li>
                                <?php endif; ?>

                            <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="small-12 columns contact-info">
                    <ul>
                        <?php if ($email): ?>
                            <li><p>Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
                            </li><?php endif; ?>
                        <?php if ($cpr): ?>
                            <li><p>CPR: <?php echo $cpr; ?></p></li><?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>


        <div class="show-for-medium-down hide-for-large z-index-medium" id="mobile-footer">
            <div id="inner-mobile-footer"></div>
        </div>
</footer><!-- #colophon -->
<?php include(locate_template('template-parts/parts/cookiebanner.php')); ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>