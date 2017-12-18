<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package checkmate
 */
get_header(); ?>
<?php $activateOverlay = get_field('activate_overlay_casino', 'options');
$casinoImg = get_field('casino_img', 'options'); ?>
<section class="bg-img casinos <?php if($activateOverlay): echo 'overlay'; endif;?>" style="background: url(<?php echo $casinoImg['url']; ?>) no-repeat center center fixed">
	<div class="row welcome-row">
		<div class="small-12 columns fade-in-slow z-index-medium">
			<h1><?php the_field('heading_first_line_casino', 'options'); ?></h1>
			<h1><?php the_field('heading_second_line_casino', 'options'); ?></h1>
		</div>
	</div>
</section>
<section class="comparison-section bg-dark-gray" data-count="10">
	<div class="container mobile-full-width">
		<div class="row">
			<?php include(locate_template('template-parts/parts/casino-sidebar.php')); ?>
			<div class="small-12 medium-8 bg-gray columns wrapper-casino-comparison slide-up minus-row-margin z-index-medium hidden-overflow">
				<div class="container">
					<div class="row align-middle padding-bottom">
						<div class="small-12 large-6">
							<h4 class="headline-casino-h4"><?php the_field('heading_casino_comparison', 'options'); ?></h4>
						</div>
						<div class="small-12 large-6 columns align-right filter-wrapper">
							<div class="selected-currency">
								<div class="naming-casino"><p>Currency</p></div>
								<select id="currencySelect">
									<option value="USD" data-currency="$">USD ($)</option>
									<option value="EUR" data-currency="€">EUR (€)</option>
									<option value="GBP" data-currency="£">GBP (£)</option>
									<option value="DKK" data-currency="DKK">DKK</option>
								</select>
							</div>
							<div class="sorting">
								<div class="naming-casino"><p>SORT BY</p></div>
								<p class="filter-score filter active-sort" data-filter="our_score">Score</p>
								<p class="filter-bonus filter" data-filter="signup_bonus">Bonus</p>
								<p class="filter-deposit filter" data-filter="minimum_deposit">Deposit</p>
							</div>
						</div>
					</div>
				</div>
				<div class="small-12 columns load-casino hidden-overflow">
					<div class="load-wrapper">
						<div class="loader">
						</div></div>
					</div>
					<div class="loaded-posts" data-count="">
					</div>
					<div class="load-more">
						<div class="load-wrapper">
							<div class="loader">
							</div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<section class="bg-gray section-padding-guides">
	<div class="container">
		<h2 class="cursive-headline text-center section-heading">News & guides</h2>
		<?php 
		$args_blog = array(
			'posts_per_page' => 6, 
			'offset'         => 0,    
			'post_type'      => 'blog',
		);
		$the_query_blog = new WP_Query( $args_blog );
		?>
		<?php if($the_query_blog->have_posts()): ?>
			<div class="row">
				<?php while ($the_query_blog->have_posts()) : $the_query_blog->the_post(); ?>
					<div class="small-6 large-4 columns">
						<?php include(locate_template('template-parts/parts/blog-teaser.php')); ?>
					</div>
				<?php endwhile;?>
			</div>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		</div>
		</section>
		<?php get_footer();