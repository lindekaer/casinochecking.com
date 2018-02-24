<?php
/**
 * The template for displaying archive pages
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package checkmate
 */
get_header(); ?>
<?php $activateOverlay = get_field('activate_overlay_blog', 'options');
$blogImg = get_field('blog_img', 'options')['sizes']['bg-img'];  ?>
<section class="bg-img" style="background: url(<?php echo $blogImg; ?>);">
	<div class="container comparison-section mobile-full-width">
		<div class="row welcome-row mobile-bg z-index" style="background: url(<?php echo $blogImg; ?>)">
			<div class="small-12 columns fade-in-slow z-index-medium welcome-text">
				<h1><?php the_field('heading_first_line_blog', 'options');?></h1>
				<h1><?php the_field('heading_second_line_blog', 'options'); ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="small-12 medium-8 margin-top-fp medium-order-2 bg-gray columns wrapper-blog slide-up z-index-medium hidden-overflow">
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
			<div class="medium-4 bg-sidebar columns wrapper-casino-comparison slide-up margin-top-fp medium-order-1">
				<div class="filter-inner-wrapper">
					<?php echo get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();