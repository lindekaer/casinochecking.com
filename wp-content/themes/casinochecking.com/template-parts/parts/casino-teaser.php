<div class="row casino-wrapper fade-in-casino">
	<?php
	$image = get_field('image');
	$imageSize = 'logo-casino-archive';
	$deepUrl = get_field('deep_url');
	$ourScore = get_field('our_score');
	$userVotes = get_field('user_votes');
	$signUpBonus = get_field('signup_bonus');
	$upToBonus = get_field('up_to_signup');
	$currency = get_field('currency');


	$minimumDeposit = get_field('minimum_deposit'); ?>
	<p class="first"><?php echo $i; ?></p>

	<div class="small-6 large-7 columns border-right my-align-center">
		<div style="width: 100%;">
			<div class="image section-padding">
				<?php echo wp_get_attachment_image($image['id'], $imageSize); ?>
			</div>
			<div class="user-rating section-padding-bottom">
				<div class="row">
					<div class="small-6 large-7">
						<p><span class="hide-for-small-only"><?php echo _e('Signup', 'checkmate'); ?></span><?php echo _e('Bonus', 'checkmate'); ?></p>
						<h6 class="inline"><?php echo $signUpBonus; ?>%</h6><p class="inline up-to hide-for-small-only"><?php  echo _e('up to', 'checkmate'); ?></p><h6 class="inline hide-for-small-only"><span class="numeric_currency"><?php echo $upToBonus; ?></span><span class="currency-type"></span></h6>
					</div>
					<div class="small-6 large-5">
						<p><span class="hide-for-small-only"><?php echo _e('Minimum', 'checkmate'); ?> </span><?php echo _e('Deposit', 'checkmate'); ?></p>
						<h6><span class="numeric_currency"><?php echo $minimumDeposit; ?></span><span class="currency-type"></span></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="small-6 large-5 columns my-align-center">
		<div style="width: 100%;">
			<div class="image-ratings section-padding">
				<div class="row">
					<div class="small-6 border-right">
						<p><span class="hide-for-small-only"><?php echo _e('User', 'checkmate'); ?> </span><?php echo _e('Rating', 'checkmate'); ?></p>
						<?php include(locate_template('template-parts/parts/user-rating.php')); ?>
					</div>
					<div class="small-6 columns">
						<p><span class="hide-for-small-only"><?php echo _e('Our', 'checkmate'); ?> </span><?php echo _e('score', 'checkmate'); ?></p>
						<h6><?php echo $ourScore; ?><span class="rating-ten">/10</span></h6>
					</div>
				</div> 
			</div>
			<div class="bonus-info button-padding-bottom">
				<a target="_blank" class="button deep-link-button cta-button" <?php include(locate_template('template-parts/parts/deep-link.php'));?>><?php echo _e('Sign up', 'checkmate'); ?></a>
			</div>
		</div>
	</div>
	<div class="small-12 hide-custom desc columns">
		<div class="row">
			<div class="small-12 columns">
				<div class="dropdown-desc">
					<?php if (get_field('description')): ?>
						<?php $short_desc = strip_tags(get_field('description')); ?>
						<p><?php echo substr($short_desc, 0, 250) . '[...]';?><a href="<?php echo get_permalink(); ?>" class="read-more-btn"><?php echo _e('Read more', 'checkmate'); ?></a></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>