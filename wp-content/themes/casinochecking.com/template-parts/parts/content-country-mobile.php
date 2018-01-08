<?php if(get_field('activate_country', 'options')): ?>
<div class="filter-inner-wrapper">
		<?php	
		$countries_available = get_field_object('available_countries');
		if( $countries_available ): ?>
		<p><?php echo _e('Country', 'checkmate'); ?></p>
		<select id="countrySelect-mobile">
			<option value="all"><?php echo _e('All countries', 'checkmate'); ?></option>
			<?php foreach($countries_available['choices'] as $key => $country_available): ?>
				<option value="<?php echo $key; ?>"><?php echo $country_available; ?></option>
			<?php endforeach; ?>
		</select>
	<?php endif; ?>
</div>
<?php endif; ?>