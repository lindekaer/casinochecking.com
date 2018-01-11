<?php
if( have_rows('flexible_content', 'option') ):
	while ( have_rows('flexible_content', 'option') ) : the_row(); ?>
	<?php
	$headline = get_sub_field('headline', 'option');
	$text = get_sub_field('text', 'option');
	$imagePosition = get_sub_field('image_position', 'option');
	$image = get_sub_field('background_image', 'option'); 
	$bgColor = get_sub_field('bg_color', 'option');
	$headlineColor = get_sub_field('headline_color', 'option');
	?>
	<section class="section <?php echo get_row_layout(); ?>" style="background-color:<?php echo $bgColor; ?>">
		<div class="row collapse">
			<?php if($imagePosition == 'Left') : ?>
				<?php include(locate_template('template-parts/parts/bg-img.php')); ?>
			<?php endif; ?>
			<div class="small-12 medium-12 large-6 columns">
				<div class="text">
					<h2 class="cursive-headline text-left" style="color:<?php echo $headlineColor; ?>"><?php echo $headline; ?></h2>
					<?php echo $text; ?>
				</div>
			</div>
			<?php if($imagePosition == 'Right') : ?>
				<?php include(locate_template('template-parts/parts/bg-img.php')); ?>
			<?php endif; ?>
		</div>
	</section>			
<?php endwhile;
endif;?>