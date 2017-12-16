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
						<p><span class="hide-for-small-only">Signup </span>Bonus</p>
						<h6 class="inline"><?php echo $signUpBonus; ?>%</h6><p class="inline up-to hide-for-small-only">up to</p><h6 class="inline hide-for-small-only"><span class="numeric_currency"><?php echo $upToBonus; ?></span><span class="currency-type"></span></h6>
						</div>
						<div class="small-6 large-5">
							<p><span class="hide-for-small-only">Minimum </span>Deposit</p>
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
							<p><span class="hide-for-small-only">User </span>rating</p>
							<?php include(locate_template('template-parts/parts/user-rating.php')); ?>
						</div>
						<div class="small-6 columns">
							<p><span class="hide-for-small-only">Our </span>score</p>
							<h6><?php echo $ourScore; ?>/10</h6>
						</div>
					</div>
				</div>
				<div class="bonus-info button-padding-bottom">
					<a target="_blank" class="button deep-link-button" <?php include(locate_template('template-parts/parts/deep-link.php')); ?> >Get Bonus</a>
				</div>
			</div>
		</div>
		<div class="small-12 hide-custom desc columns">
			<div class="row">
				<div class="small-12 columns">
					<div class="dropdown-desc"><?php echo substr(get_field('description'), 0, 250) . ' [...] <a href="'. get_permalink() .'" class="read-more-btn"> Read more</a>'; ?></div>
				</div>
			</div>
		</div>
	</div>