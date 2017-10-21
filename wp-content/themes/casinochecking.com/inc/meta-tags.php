<?php 	
	function limit_text($x, $length)
	{
	  if(strlen($x)<=$length)
	  {
	    return $x;
	  }
	  else
	  {
	    $y=substr($x,0,$length) . '...';
	    return $y;
	  }
	}
	
	global $post;
	if($post) {
		$postobject = get_post($post->ID);
	}
	$description = '';

 	if( !class_exists('acf') ) {
 		function get_field($string) {
 			return false;
 		}
 	}
	switch (true) {
	    case (get_field('meta_description')):
	        $description = limit_text(get_field('meta_description'), 157);
	        break;
	    case (get_field('teaser_text')):
	    	$description = limit_text(get_field('teaser_text'), 157);
	    	break;
	    case (is_404()):
	    	$description = __( 'Oops! That page can&rsquo;t be found.', 'frankly-textdomain' );
	    	break;
	   	case (category_description()):
	   		$description = category_description();
	   		break;
	    default:
	    	if($post) {
	    		$content = $postobject->post_content;
		     	$description = strip_tags($content);
		     	$description = limit_text($description, 157);
	    	}
	    	else {
	    		$description = '';
	    	}
	    	
	}
?>

<meta name="description" content="<?php echo $description; ?>" />
<meta name="author" content="<?php echo get_bloginfo('name'); ?>" />

<?php 
/****************************************
*	// OPEN GRAPH 
****************************************/
?>
<meta property="og:title" content="<?php wp_title('|', true, 'right'); ?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<?php if($post) : ?>
<?php $thumb = get_the_post_thumbnail_url( $post->ID, 'open-graph-size' ); 
	if($thumb) {
		$seoimage = $thumb;
	}
	elseif(get_field('seo_fallback_image', 'options')) {
		// add default image
		$seoimage = get_field('seo_fallback_image', 'options');
	}
	else {
		$seoimage = '';
	}
?>
<?php else : ?>
	<?php $seoimage = ''; ?>
<?php endif; ?>
<meta property="og:image" content="<?php echo $seoimage; ?>" />