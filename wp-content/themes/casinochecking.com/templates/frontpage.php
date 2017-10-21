<?php

/*
 * Template Name: Frontpage
 */
get_header(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
            while ( have_posts() ) : the_post(); ?>
                <?php include(locate_template('template-parts/comparison-page.php')); ?>
            <?php endwhile; // End of the loop.
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
//get_sidebar();
get_footer();