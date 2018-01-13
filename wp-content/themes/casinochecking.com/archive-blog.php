<?php
/**
 * The template for displaying archive pages
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package checkmate
 */
get_header(); ?>
<?php $activateOverlay = get_field('activate_overlay_blog', 'options');
$blogImg = get_field('blog_img', 'options');  ?>
<section class="bg-img <?php if($activateOverlay): echo 'overlay'; endif;?>" style="background: url(<?php echo $blogImg['url']; ?>) no-repeat center center fixed;">
	<div class="row welcome-row z-index">
		<div class="small-12 columns fade-in-slow z-index welcome-text">
			<h1><?php the_field('heading_first_line_blog', 'options'); ?></h1>
			<h1><?php the_field('heading_second_line_blog', 'options'); ?></h1>
		</div>
	</div>
</section>
<section class="comparison-section bg-dark-gray">
	<div class="container mobile-full-width">
		<div class="row">
			<div class="small-12 large-order-2 large-8 bg-gray columns wrapper-casino-comparison slide-up minus-row-margin">
				<div class="container">
					<div class="row align-middle padding-bottom">
						<div class="small-12 columns">
							<h4 class="headline-casino-h4"><?php the_field('heading_blog_comparison', 'options'); ?></h4>
						</div>
					</div>
					<?php if(have_posts()): ?>
						<div class="row list">
							<?php while (have_posts()) : the_post(); ?>
								<div class="small-6 columns list-item">
									<?php include(locate_template('template-parts/parts/blog-teaser.php')); ?>
								</div>
							<?php endwhile;?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="small-12 large-order-1 large-4 bg-sidebar columns wrapper-casino-comparison slide-up minus-row-margin-sidebar">
				<div class="filter-inner-wrapper">
					<?php echo get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<?php
get_footer();