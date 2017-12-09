<?php 
$deepLinkEur = get_field('deep_link_eur');
$deepLinkDK = get_field('deep_link_dk');
$deepLinkGP = get_field('deep_link_gb');
$deepLinkUSA = get_field('deep_link_usa');
$deepLinkSE = get_field('deep_link_se');
$deepLinkDE = get_field('deep_link_de');
$deepLinkPL = get_field('deep_link_pl');
$deepLinkFI = get_field('deep_link_fi');
$deepLinkNO = get_field('deep_link_no');?> 

<?php if($deepLinkEur): echo 'data-deeplink-eur="' . $deepLinkEur . '"'; endif; ?>
<?php if($deepLinkDK): echo 'data-deeplink-dk="' . $deepLinkDK . '"'; endif; ?>
<?php if($deepLinkGP): echo 'data-deeplink-gb="' . $deepLinkGP . '"'; endif; ?>
<?php if($deepLinkUSA): echo 'data-deeplink-us="' . $deepLinkUSA . '"'; endif; ?>
<?php if($deepLinkSE): echo 'data-deeplink-se="' . $deepLinkSE . '"'; endif; ?>
<?php if($deepLinkDE): echo 'data-deeplink-de="' . $deepLinkDE . '"'; endif; ?>
<?php if($deepLinkPL): echo 'data-deeplink-pl="' . $deepLinkPL . '"'; endif; ?>
<?php if($deepLinkFI): echo 'data-deeplink-fi="' . $deepLinkFI . '"'; endif; ?>
<?php if($deepLinkNO): echo 'data-deeplink-no="' . $deepLinkNO . '"'; endif; ?>