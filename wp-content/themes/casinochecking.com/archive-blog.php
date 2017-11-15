<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package checkmate
 */
get_header(); ?>
<?php $activateOverlay = get_field('activate_overlay_blog', 'options'); ?>
<section class="bg-img <?php if($activateOverlay): echo 'overlay'; endif;?>" style="background: url('https://casinochecking.com/wp-content/uploads/2017/10/casinocheckingcom-2000x1329.jpg') no-repeat center center fixed;">
	<div class="row welcome-row z-index">
		<div class="small-12 columns fade-in-slow z-index">
			<h1><?php the_field('heading_first_line_blog', 'options'); ?></h1>
			<h1><?php the_field('heading_second_line_blog', 'options'); ?></h1>
		</div>
	</div>
</section>
<section class="comparison-section">
	<div class="container">
		<div class="row slide-up minus-row-margin">
			<div class="hide-for-medium-down large-4 bg-sidebar columns wrapper-casino-comparison">
				<div class="filter-inner-wrapper">
				</div>
			</div>
			<div class="small-12 large-8 bg-gray columns wrapper-casino-comparison">
				<div class="container">
					<div class="row align-middle padding-bottom">
						<div class="small-12 large-7 columns">
							<h4 class="headline-casino-h4"><?php the_field('heading_blog_comparison', 'options'); ?></h4>
						</div>
						<div class="small-12 large-5 columns align-right">
							<div class="filter-wrapper">
								<p>SORT BY: </p>
								<p class="filter-bonus filter active-sort" data-filter="newest">Newest</p>
								<p class="filter-deposit filter" data-filter="minimum_deposit">Category</p>
							</div>
						</div>
					</div>
					<?php if(have_posts()): ?>
						<div class="row">
							<?php while (have_posts()) : the_post(); ?>
								<div class="small-6 columns">
									<a href="<?php the_permalink();?>">
										<div class="blog-content">
											<div class="blog-img-wrapper">
												<?php 
												$image = get_field('blog_image');
											$size = 'logo-blog-archive'; // (thumbnail, medium, large, full or custom size)
											if( $image ) {
												echo wp_get_attachment_image( $image, $size );
											}
											?>
										</div>
										<div class="text-wrapper columns">
											<div class="category">
												<p><?php the_field('blog_category'); ?></p>
											</div>
											<div class="blog-headline">
												<h3 class="cursive-headline"><?php the_title();?></h3>
											</div>
											<div class="blog-icon">
												<?php 
												$images = get_field('blog_icon');
											$sizes = 'thumbnail'; // (thumbnail, medium, large, full or custom size)
											if( $images ) {
												echo wp_get_attachment_image( $images, $sizes );
											}
											?>
										</div>
										<div class="blog-text">
											<p><?php echo substr(get_the_content(), 0, 100) . ' [...]'; ?></p>
										</div>
									</a>
								</div>
							</div>
						</div>
					<?php endwhile;?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
</div>
</div>
</section>
<?php
get_footer();