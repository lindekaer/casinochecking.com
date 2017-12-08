<div class="hide-for-small-only medium-4 bg-sidebar columns wrapper-casino-comparison slide-up minus-row-margin">
	<div class="casino-sidebar">
		<div class="row">
			<div class="small-12 columns">
				<h4 class="headline-casino-h4">Filters</h4>
			</div>
		</div>
		<?php if(get_field('activate_country', 'options')): ?>
			<div class="filter-inner-wrapper">
				<?php	
				$countries_available = get_field('available_countries');
				if( $countries_available ): ?>
				<p>Country</p>
				<select id="countrySelect">
					<?php foreach( $countries_available as $country_available): ?>
						<option value="<?php echo $country_available['value']; ?>"><?php echo $country_available['label']; ?></option>
					<?php endforeach; ?>
				</select>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<?php
	 if(get_field('activate_category', 'options')): 
		$categories = get_field('categories_casino');
		if( $categories ): ?>
		<div class="filter-inner-wrapper categories">
			<p>I like to play</p>
			<form>
			<?php foreach( $categories as $category ): ?>
				<div class="category-input"><input id="checkbox-input" type="checkbox" name="category" value="<?php echo $category; ?>" checked><p><?php echo $category; ?></p></div>
			<?php endforeach; ?>
			</form>
		</div>
	<?php endif; ?>
	<?php endif; ?>
	<!-- Our score -->
	<?php if(get_field('activate_user_votes', 'options')): ?>
		<div class="filter-inner-wrapper">
			<?php $user_votes = get_field_object('user_votes'); ?>
			<p><label class="<?php echo $user_votes['name'];?>" data-filter-type="<?php echo $user_votes['name'];?>" data-min="<?php echo $user_votes['min'];?>" data-max="<?php echo $user_votes['max'];?>" for="<?php echo $user_votes['name'];?>"><?php echo $user_votes['label'];?></label></p>
			<div id="slider-range-user-votes"></div>
			<input type="text" id="<?php echo $user_votes['name'];?>" readonly>
		</div>
	<?php endif; ?>
	<?php if(get_field('activate_our_score', 'options')): ?>
		<div class="filter-inner-wrapper">
			<?php $our_score = get_field_object('our_score'); ?>
			<p><label class="<?php echo $our_score['name'];?>" data-filter-type="<?php echo $our_score['name'];?>" data-min="<?php echo $our_score['min'];?>" data-max="<?php echo $our_score['max'];?>" for="<?php echo $our_score['name'];?>"><?php echo $our_score['label'];?></label></p>
			<div id="slider-range-our-score"></div>
			<input type="text" id="<?php echo $our_score['name'];?>" readonly>
		</div>
	<?php endif; ?>
	<!-- Signup bonus -->
	<?php if(get_field('activate_signup_bonus', 'options')): ?>
		<div class="filter-inner-wrapper">
			<?php $signup_bonus = get_field_object('signup_bonus'); ?>
			<p><label class="<?php echo $signup_bonus['name'];?>" data-filter-type="<?php echo $signup_bonus['name'];?>" for="<?php echo $signup_bonus['name'];?>"><?php echo $signup_bonus['label'];?>
			</label></p>
			<div id="slider-range-signup-bonus"></div>
			<input type="text" id="<?php echo $signup_bonus['name'];?>" readonly>
		</div>
	<?php endif; ?>
	<!-- Minimum deposit -->
	<?php if(get_field('activate_minimum_deposit_filter', 'options')): ?>
		<div class="filter-inner-wrapper no-borders">
			<?php $min_deposit = get_field_object('minimum_deposit'); ?>
			<p><label class="<?php echo $min_deposit['name'];?>" data-filter-type="<?php echo $min_deposit['name'];?>" for="<?php echo $min_deposit['name'];?>"><?php echo $min_deposit['label'];?>
			</label></p>
			<div id="slider-range-min-deposit"></div>
			<input type="text" id="<?php echo $min_deposit['name'];?>" readonly>
		</div>
	<?php endif; ?>
	<div class="search-ajax">
		<a class="button">Search casinos</a>
	</div>
	<div class="reset-filter">
		<p>Reset search</p>
	</div>
</div>
</div>