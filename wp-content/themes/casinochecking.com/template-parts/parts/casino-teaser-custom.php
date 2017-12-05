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

	<div class="small-6 columns border-right my-align-center">
		<div style="width: 100%;">
			<div class="image section-padding">
				<?php echo wp_get_attachment_image($image['id'], $imageSize); ?>
			</div>
			<div class="user-rating section-padding-bottom">
				<div class="row">
					<div class="small-6">
						<p><span class="hide-for-small-only">Signup </span>Bonus</p>
						<h5 class="inline"><?php echo $signUpBonus; ?>%</h5><p class="inline up-to hide-for-small-only">up to</p><h5 class="inline hide-for-small-only"><span class="numeric_currency"><?php echo $upToBonus; ?></span><span class="currency-type"></span></h5>
						</div>
						<div class="small-6">
							<p><span class="hide-for-small-only">Minimum </span>Deposit</p>
							<h5><span class="numeric_currency"><?php echo $minimumDeposit; ?></span><span class="currency-type"></span></h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="small-6 columns my-align-center">
			<div style="width: 100%;">
				<div class="image-ratings section-padding">
					<div class="row">
						<div class="small-6 border-right">
							<p><span class="hide-for-small-only">User </span>rating</p>
							<?php include(locate_template('template-parts/parts/user-rating.php')); ?>
						</div>
						<div class="small-6 columns">
							<p><span class="hide-for-small-only">Our </span>score</p>
							<h4><?php echo $ourScore; ?>/10</h4>
						</div>
					</div>
				</div>
				<div class="bonus-info button-padding-bottom">
					<a target="_blank" href="<?php echo $deepUrl; ?>" class="button">Get Bonus</a>
				</div>
			</div>
		</div>
		<div class="small-12 hide-custom desc columns">
			<div class="row">
				<div class="small-12 columns">
					<?php echo substr(get_field('description'), 0, 250) . ' [...] <a href="'. get_permalink() .'" class="read-more-btn"> Read more</a>'; ?>
				</div>
			</div>
		</div>
	</div>