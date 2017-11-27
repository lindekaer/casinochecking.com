<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package checkmate
 */ ?>

 


 <div class="favorites padding-top-sidebar">
 	<h5 class="padding-sidebar-bottom"><?php echo _e('We recommend') ?></h5>
 	<?php 
 	$args = array(
 		'numberposts'   => -1,
 		'post_type'     => 'casino',
 		'post_status' => 'publish',
 		'orderby' => 'our_score',
 		'order' => 'ASC',
 	);

 	$the_query = new WP_Query( $args );
 	if($the_query->have_posts()) {
 		$i = 1; ?>
 		<div class="border-bottom padding-sidebar-bottom">
 			<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
 				<div class="fav-casino">
 					<a href="<?php the_permalink(); ?>">
 						<div class="row">
 							<div class="small-2 columns">
 								<p class="score-count"><?php echo $i; ?></p>
 							</div>
 							<div class="small-10 columns align-middle"> 						
 								<p class="casino-name"><?php echo the_field('name'); ?></p>
 							</div>
 							<div class="small-8 small-offset-2 columns align-middle">
 								<?php include(locate_template('template-parts/parts/user-rating.php')); ?>
 							</div>
 							<div class="small-2 columns">
 								<h4><?php echo the_field('our_score'); ?></h4>
 							</div>
 						</div>
 					</a>
 				</div>
 				<?php $i++; ?>
 			<?php endwhile; ?>
 		</div>
 		<?php wp_reset_query(); 
 	}?>
 </div>
 <div class="favorites padding-top-sidebar">
 	<h5 class="padding-sidebar-bottom"><?php echo _e('User favorites') ?></h5>
 	<?php 
 	$args = array(
 		'numberposts'   => -1,
 		'post_type'     => 'casino',
 		'post_status' => 'publish',
 		'orderby' => 'user_votes',
 		'order' => 'ASC',
 	);

 	$the_query = new WP_Query( $args );
 	if($the_query->have_posts()) {
 		$i = 1; ?>
 		<div class="border-bottom padding-sidebar-bottom">
 			<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
 				<div class="fav-casino">
 					<a href="<?php the_permalink(); ?>">
 						<div class="row">
 							<div class="small-2 columns">
 								<p class="score-count"><?php echo $i; ?></p>
 							</div>
 							<div class="small-10 columns align-middle"> 						
 								<p class="casino-name"><?php echo the_field('name'); ?></p>
 							</div>
 							<div class="small-8 small-offset-2 columns align-middle">
 								<?php include(locate_template('template-parts/parts/user-rating.php')); ?>
 							</div>
 							<div class="small-2 columns">
 								<h4><?php echo the_field('our_score'); ?></h4>
 							</div>
 						</div>
 					</a>
 				</div>
 				<?php $i++; ?>
 			<?php endwhile; ?>
 		</div>
 		<?php wp_reset_query(); 
 	}?>
 </div>