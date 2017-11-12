<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package checkmate
 */
get_header(); ?>
<section class="bg-img" style="background: url('http://casinochecking.com/wp-content/uploads/2017/10/casinocheckingcom-2000x1329.jpg') no-repeat center center fixed;">
	<div class="row welcome-row">
		<div class="small-12 columns fade-in-slow">
			<h1>News, guides, how to</h1>
			<h1>.. and much more</h1>
		</div>
	</div>
</section>
<section class="comparison-section">
	<div class="container">
		<div class="row slide-up minus-row-margin">
			<div class="hide-for-medium-down large-4 bg-sidebar columns border-radius-left wrapper-casino-comparison">
				<div class="border-radius-left">
					<div class="filter-inner-wrapper">
						<?php $blog_category = get_field_object('blog_category'); ?>
						<p>
							<label class="<?php echo $blog_category['name'];?>">
								<?php echo $blog_category['label'];?>
							</label>
						</p>

						<?php 
						if( $blog_category )
						{
							echo '<form action="">';
							echo '<input type="radio" class="blog-category" value="all" name="blog-category"><p class="blog-name">All</p></br>';
							foreach( $blog_category['choices'] as $k => $v )
							{
								echo '<input type="radio" value="' . $k . '" class="blog-category" name="blog-category"><p class="blog-name">' . $v . '</p></br>';
							}
							echo '</form>';
						}
						?>
					</div>
					<div class="blog-ajax">
						<a class="button" id="search-blog">Search</a>
					</div>
					<div class="reset-filter">
						<p>Reset search</p>
					</div>
				</div>
			</div>
			<div class="small-12 large-8 bg-gray columns border-radius-right wrapper-casino-comparison">
				<div class="container">
					<div class="row align-middle padding-bottom">
						<div class="small-12 large-7 columns">
							<h4 class="headline-casino-h4">Casino-news and guides</h4>
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