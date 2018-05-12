<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package checkmate
 */ ?>
<div class="container" id="sticky_item">
    <?php if (!is_post_type_archive('blog')) { ?>
        <?php
        $args_blog = array(
            'posts_per_page' => 10,
            'post_type' => 'blog',
        );
        $the_query_blog = new WP_Query($args_blog);
        ?>
        <?php if ($the_query_blog->have_posts()): ?>
            <div class="row">
                <div class="small-12 columns large-disable-padding sidebar-padding-bottom">
                    <div class="most-read">
                        <h5 class="padding-sidebar-bottom heading cursive-headline"><?php echo _e('Popular acticles', 'checkmate'); ?></h5>
                        <?php while ($the_query_blog->have_posts()) : $the_query_blog->the_post(); ?>
                            <p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        <?php endwhile; ?>
                        <?php wp_reset_query(); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php } ?>
    <div class="row">
        <div class="small-12 columns large-disable-padding sidebar-padding-bottom">
            <div class="favorites">
                <h5 class="padding-sidebar-bottom heading cursive-headline"><?php echo _e('New bonuses', 'checkmate'); ?></h5>
                <div class="favorites-teaser">
                </div>
            </div>
        </div>
    </div>
</div>