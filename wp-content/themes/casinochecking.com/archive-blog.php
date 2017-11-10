<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package checkmate
 */
get_header(); ?>
<section class="bg-img" style="background: url('http://casinochecking.com/wp-content/uploads/2017/10/casino-bg.jpg') no-repeat center center fixed;">
	<div class="container padding-top">
		<div class="row slide-up minus-row-margin">
			<div class="small-12 medium-4 bg-sidebar columns border-radius-left wrapper-casino-comparison">
				<div class="border-radius-left">
				</div>
			</div>
			<div class="small-12 medium-8 bg-gray columns border-radius-right wrapper-casino-comparison">
				<div class="container">
					<?php if(have_posts()): ?>
						<div class="row">
							<?php while (have_posts()) : the_post(); ?>
								<div class="small-6 columns">
									<a href="<?php the_permalink();?>">
										<div class="blog-content">
											<div class="blog-img-wrapper">
												<?php 
												$image = get_field('blog_image');
											$size = 'logo-casino-content'; // (thumbnail, medium, large, full or custom size)
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
												<h2 class="cursive-headline"><?php the_title();?></h2>
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
											<?php echo substr(get_the_content(), 0, 100) . '...'; ?>
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
</section>
<?php
get_footer();