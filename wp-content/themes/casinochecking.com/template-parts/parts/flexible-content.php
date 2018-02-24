<?php
if( have_rows('flexible_content', 'option') ):
	$i = 1;?>
	<?php while ( have_rows('flexible_content', 'option') ) : the_row(); ?>
		<?php $bgColor = get_sub_field('bg_color', 'option'); ?>
		<section class="<?php echo get_row_layout(); ?>" style="background-color:<?php if($bgColor): echo $bgColor; endif; ?>">
			<?php if(get_row_layout() == 'split_image_and_text'): ?>
				<div class="row collapse">
					<?php
					$headline = get_sub_field('headline', 'option');
					$text = get_sub_field('text', 'option');
					$imagePosition = get_sub_field('image_position', 'option');
					$image = get_sub_field('background_image', 'option'); 
					
					$headlineColor = get_sub_field('headline_color', 'option');
					$size = 'flexible-content';
					?>
					<?php if($imagePosition == 'Left') : ?>
						<?php include(locate_template('template-parts/parts/bg-img.php')); ?>
					<?php endif; ?>
					<div class="small-12 medium-12 large-6 columns">
						<div class="text">
							<h3 class="cursive-headline text-left" style="color:<?php echo $headlineColor; ?>"><?php echo $headline; ?></h3>
							<?php echo $text; ?>
						</div>
					</div>
					<?php if($imagePosition == 'Right') : ?>
						<?php include(locate_template('template-parts/parts/bg-img.php')); ?>
					<?php endif; ?>
				</div>
				<?php $i++; ?>
			<?php elseif(get_row_layout() == 'text_one_column'): ?>
				<?php 
				$bgColor = get_sub_field('bg_color', 'option');
				$heading = get_sub_field('heading', 'option');
				$headingColor = get_sub_field('heading_color', 'option');
				$text = get_sub_field('text', 'option');
				?>
				<div class="container section-compare-casino">
					<div class="small-12 columns">
						<h3 class="cursive-headline text-left section-heading" style="color: <?php echo $headingColor; ?>"><?php echo $heading; ?></h3>
						<?php echo $text; ?>
					</div>
				</div>
			<?php elseif(get_row_layout() == 'text_faq'): ?>
				<?php 
				$bgColor = get_sub_field('bg_color', 'option');
				$heading = get_sub_field('heading', 'option');
				$headingColor = get_sub_field('heading_color', 'option');
				$text = get_sub_field('text', 'option');
				$faqHeading = get_sub_field('faq_heading', 'option');
				?>
				<div class="container section-compare-casino">
					<div class="row">
						<div class="small-12 columns">							
							<h3 class="cursive-headline color-red text-left section-heading" style="color:<?php echo $headingColor; ?>"><?php echo $heading; ?></h3>
						</div>
						<div class="medium-6 small-12 columns">
							<?php echo $text; ?>
						</div>
						<div class="small-12 medium-6 columns">
							<?php if(isset($faqHeading)): ?><h3 class="cursive-headline text-left" style="color:<?php echo $headingColor; ?>"><?php echo $faqHeading; ?></h3><?php endif; ?>
							<?php if( have_rows('faq', 'option') ): ?>
								<?php while ( have_rows('faq', 'option') ) : the_row(); ?>
									<?php 
									$textFaq = get_sub_field('text_faq', 'option');
									$headlineFaq = get_sub_field('headline_faq', 'option');
									$headingColor = get_sub_field('heading_color', 'option'); ?>
									<div class="faq-element row collapse">
										<div class="small-2 medium-1 columns faq-icon align-justify-center">
											<img src="<?php echo get_template_directory_uri() . '/img/plus-faq.svg'; ?>" class="active-icon plus-faq">
											<img src="<?php echo get_template_directory_uri() . '/img/minus-faq.svg'; ?>" class="minus-faq">
										</div>
										<div class="small-10 medium-11 columns desc-wrapper">
											<h6 class="text-left transform-initial" style="color:<?php echo $headingColor; ?>"><?php echo $headlineFaq; ?></h6>
											<div class="desc"><p class="hide-custom"><?php echo $textFaq; ?></p></div>
										</div>
									</div>
								<?php endwhile; ?>
							<?php endif; ?>
						</div>
					</div>
				<?php endif;?>
			</section>
		<?php endwhile; ?>		
	<?php endif;?>