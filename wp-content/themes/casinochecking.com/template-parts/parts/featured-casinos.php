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
				<p><?php echo the_field('our_score'); ?><span class="rating-ten">/10</span></p>
			</div>
		</div>
	</a>
</div>