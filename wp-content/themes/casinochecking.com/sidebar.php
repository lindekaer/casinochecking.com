<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package checkmate
 */ ?>

 
 <div class="container">
 	<div class="row">
 		<div class="small-6 large-12 columns large-disable-padding">
 			<div class="favorites ">
 				<h5 class="padding-sidebar-bottom heading"><?php echo _e('We recommend') ?></h5>
 				<?php 
 				$args = array(
 					'numberposts'   => 3,
 					'post_type'     => 'casino',
 					'post_status' => 'publish',
 					'meta_key' => 'our_score',
 					'orderby' => 'meta_value_num',
 					'order' => 'DESC',
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
 										<div class="small-6 medium-4 large-6 small-offset-2 columns align-middle">
 											<?php include(locate_template('template-parts/parts/user-rating.php')); ?>
 										</div>
 										<div class="small-4 columns hide-for-small-only our_score align-middle">
 											<p><?php echo the_field('our_score'); ?>/10</p>
 										</div>
 									</div>
 								</a>
 							</div>
 							<?php $i++; ?>
 						<?php endwhile; ?>
 					</div>
 					<?php  } 
 					wp_reset_query(); ?>
 				</div>
 			</div>
 			<div class="small-6 large-12 columns large-disable-padding">
 				<div class="favorites padding-top-sidebar">
 					<h5 class="padding-sidebar-bottom heading"><?php echo _e('User favorites') ?></h5>
 					<?php 

 					remove_all_filters('posts_orderby');

 					$args_user_votes = array(
 						'posts_per_page' => 3, 
 						'offset'         => 0,    
 						'post_type'      => 'casino',
 						'meta_key' => 'user_votes',
 						'orderby' => 'meta_value_num',
 						'order' => 'DESC',
 					);

 					$the_query_user_votes = new WP_Query( $args_user_votes );
 					//print_r($the_query_user_votes->request);
 					if($the_query_user_votes->have_posts()) {
 						$i = 1; ?>
 						<div class="border-bottom padding-sidebar-bottom">
 							<?php while( $the_query_user_votes->have_posts() ) : $the_query_user_votes->the_post(); ?>
 								<div class="fav-casino">
 									<a href="<?php the_permalink(); ?>">
 										<div class="row">
 											<div class="small-2 columns">
 												<p class="score-count"><?php echo $i; ?></p>
 											</div>
 											<div class="small-10 columns align-middle"> 						
 												<p class="casino-name"><?php echo the_field('name'); ?></p>
 											</div>
 											<div class="small-6 small-offset-2 columns align-middle">
 												<?php include(locate_template('template-parts/parts/user-rating.php')); ?>
 											</div>
 											<div class="small-4 columns hide-for-small-only our_score align-middle">
 												<p><?php echo the_field('our_score'); ?>/10</p>
 											</div>
 										</div>
 									</a>
 								</div>
 								<?php $i++; ?>
 							<?php endwhile; ?>
 						</div>
 						<?php 
 					} wp_reset_query(); ?>
 				</div>
 			</div>
 		</div>
 	</div>