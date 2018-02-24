<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package checkmate
 */

get_header(); 
$img = get_stylesheet_directory_uri() . '/img/bg.jpg'; ?>
<section class="bg-img casinos" style="background: url(<?php echo $img; ?>)">
	<div class="container mobile-full-width">
		<div class="row mobile-bg" style="background: url(<?php echo $img; ?>)">
			<div class="small-12 columns fade-in-slow">
				<h1><?php echo _e('Oh. This is embarrassing.', 'checkmate'); ?></h1>
				<h1><?php echo _e('You found our 404-page', 'checkmate'); ?></h1>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
