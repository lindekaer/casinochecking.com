<?php $logo = get_field('header_logo', 'options');
$size = 'full'; // (thumbnail, medium, large, full or custom size) 	
echo wp_get_attachment_image( $logo, $size ); ?>