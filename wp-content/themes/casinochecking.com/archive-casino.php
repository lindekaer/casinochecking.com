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
	<div class="row welcome-row z-index">
		<div class="small-12 columns fade-in-slow z-index">
			<h1><?php the_field('heading_first_line_casino', 'options'); ?></h1>
			<h1><?php the_field('heading_second_line_casino', 'options'); ?></h1>
		</div>
	</div>
</section>
<section class="comparison-section bg-dark-gray">
	<div class="container mobile-full-width">
		<div class="row">
			<div class="hide-for-small-only medium-4 bg-sidebar columns wrapper-casino-comparison slide-up minus-row-margin">
				<div class="casino-sidebar">
					<div class="row">
						<div class="small-12 columns">
							<h4 class="headline-casino-h4">Filters</h4>
						</div>
					</div>
					<div class="filter-inner-wrapper">
						<?php
						$countries_available = get_field('available_countries');
						echo '<pre>';
						print_r($countries_available);
						echo '</pre>';
						if( $countries_available ): ?>
						<p>Country</p>
						<select id="countrySelect">
							<?php foreach( $countries_available as $country_available): ?>
								<option value="<?php echo $country_available['value']; ?>"><?php echo $country_available['label']; ?></option>
							<?php endforeach; ?>
						</select>
					<?php endif; ?>
				</div>
				<!-- Our score -->
				<div class="filter-inner-wrapper">
					<?php $user_votes = get_field_object('user_votes'); ?>
					<p><label class="<?php echo $user_votes['name'];?>" data-filter-type="<?php echo $user_votes['name'];?>" data-min="<?php echo $user_votes['min'];?>" data-max="<?php echo $user_votes['max'];?>" for="<?php echo $user_votes['name'];?>"><?php echo $user_votes['label'];?></label></p>
					<div id="slider-range-user-votes"></div>
					<input type="text" id="<?php echo $user_votes['name'];?>" readonly>
				</div>
				<div class="filter-inner-wrapper">
					<?php $our_score = get_field_object('our_score'); ?>
					<p><label class="<?php echo $our_score['name'];?>" data-filter-type="<?php echo $our_score['name'];?>" data-min="<?php echo $our_score['min'];?>" data-max="<?php echo $our_score['max'];?>" for="<?php echo $our_score['name'];?>"><?php echo $our_score['label'];?></label></p>
					<div id="slider-range-our-score"></div>
					<input type="text" id="<?php echo $our_score['name'];?>" readonly>
				</div>
				<!-- User votes -->

				<!-- Signup bonus -->
				<div class="filter-inner-wrapper">
					<?php $signup_bonus = get_field_object('signup_bonus'); ?>
					<p><label class="<?php echo $signup_bonus['name'];?>" data-filter-type="<?php echo $signup_bonus['name'];?>" for="<?php echo $signup_bonus['name'];?>"><?php echo $signup_bonus['label'];?>
					</label></p>

					<div id="slider-range-signup-bonus"></div>
					<input type="text" id="<?php echo $signup_bonus['name'];?>" readonly>
				</div>


				<!-- Minimum deposit -->
				<div class="filter-inner-wrapper no-borders">
					<?php $min_deposit = get_field_object('minimum_deposit'); ?>
					<p><label class="<?php echo $min_deposit['name'];?>" data-filter-type="<?php echo $min_deposit['name'];?>" for="<?php echo $min_deposit['name'];?>"><?php echo $min_deposit['label'];?>
					</label></p>

					<div id="slider-range-min-deposit"></div>
					<input type="text" id="<?php echo $min_deposit['name'];?>" readonly>
				</div>
				<div class="search-ajax">
					<a class="button">Search casinos</a>
				</div>
				<div class="reset-filter">
					<p>Reset search</p>
				</div>
			</div>
		</div>
		<div class="small-12 medium-8 bg-gray columns wrapper-casino-comparison slide-up minus-row-margin">
			<div class="container">
				<div class="row align-middle padding-bottom">
					<div class="small-12 large-7 columns">
						<h4 class="headline-casino-h4"><?php the_field('heading_casino_comparison', 'options'); ?></h4>
					</div>
					<div class="small-12 large-5 columns align-right">
						<div class="filter-wrapper">
							<p>SORT BY: </p>
							<p class="filter-score filter active-sort" data-filter="our_score">Score</p>
							<p class="filter-bonus filter " data-filter="signup_bonus">Bonus</p>
							<p class="filter-deposit filter" data-filter="minimum_deposit">Deposit</p>
						</div>
					</div>
				</div>
				<div class="small-12 columns load-casino">
					<div class="load-wrapper">
						<div class="loader">
						</div></div>
					</div>
					<?php  				
					$args = array(
						'numberposts'   => -1,
						'post_type'     => 'casino',
						'post_status' => 'publish',
						'meta_key' => 'our_score',
						'orderby' => 'meta_value_num',
						'order' => 'DESC',
					);

					$the_query = new WP_Query( $args );
					?>
					<div class="loaded-posts" data-count="<?php echo $the_query->found_posts;?>">
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
<?php
get_footer();