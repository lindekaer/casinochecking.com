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
			<?php
			/*$country = ipAddress();
			$countryCode = $country['geoplugin_countryName'];
			if(isset($countryCode)){
				if($countryCode = 'DENMARK'){ 
					$countryCode = 'DANMARK';
				}
				elseif($countryCode = 'NORWAY'){
					$countryCode = 'NORGE';
				}
			} */
			?>
			<h1><?php the_field('heading_first_line_casino', 'options');/* if(isset($countryCode)): echo $countryCode; endif;*/?></h1>
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
								<div class="naming-casino"><p><?php echo _e('Currency', 'checkmate'); ?></p></div>
								<select id="currencySelect">
									<option value="USD" data-currency="$">USD ($)</option>
									<option value="EUR" data-currency="€">EUR (€)</option>
									<option value="GBP" data-currency="£">GBP (£)</option>
									<option value="DKK" data-currency="DKK">DKK</option>
									<option value="NOK" data-currency="NOK">NOK</option>
								</select>
							</div>
							<div class="sorting">
								<div class="naming-casino"><p><?php echo _e('SORT BY', 'checkmate'); ?></p></div>
								<p class="filter-score filter active-sort" data-filter="our_score"><?php echo _e('Score', 'checkmate'); ?></p>
								<p class="filter-bonus filter" data-filter="signup_bonus"><?php echo _e('Bonus', 'checkmate'); ?></p>
								<p class="filter-deposit filter" data-filter="minimum_deposit"><?php echo _e('Deposit', 'checkmate'); ?></p>
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
<section class="bg-white section-compare-casino">
	<div class="container">
		<div class="row">
			<div class="small-12 large-6">
				<h3 class="cursive-headline color-red text-left section-heading"><?php echo _e('Compare online casinos', 'checkmate'); ?></h3>
				<?php the_field('description_online_casinos', 'options'); ?>
			</div>
			<div class="small-6 text-center hide-for-small-only hide-for-medium-only">
				<img class="img-section" src="<?php the_field('casino-container-bg', 'options'); ?>">
			</div>
		</div>
	</div>
</section>
<section class="bg-gray section-padding-guides">
	<div class="container">
		<h2 class="cursive-headline text-center section-heading"><?php echo _e('Tips & Tricks', 'checkmate'); ?></h2>
		<?php 
		$args_blog = array(
			'posts_per_page' => 3, 
			'offset'         => 0,    
			'post_type'      => 'blog',
			'meta_key'		=> 'blog_category',
			'meta_value'	=> 'How to play'
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