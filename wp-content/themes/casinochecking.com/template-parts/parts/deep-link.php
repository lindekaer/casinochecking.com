<?php 
$deepLinkEur = get_field('deep_link_eur');
$deepLinkDK = get_field('deep_link_dk');
$deepLinkGP = get_field('deep_link_gb');
$deepLinkUSA = get_field('deep_link_usa');
$deepLinkSE = get_field('deep_link_se');
$deepLinkDE = get_field('deep_link_de');
$deepLinkPL = get_field('deep_link_pl');
$deepLinkFI = get_field('deep_link_fi');
$deepLinkNO = get_field('deep_link_no');
$deepLinkPT = get_field('deep_link_pt');
$deepLinkCZ = get_field('deep_link_cz');
$deepLinkNL = get_field('deep_link_nl');
$deepLinkIT = get_field('deep_link_it');
$deepLinkGeneral = get_field('deep_link_general');

if($deepLinkEur) { echo 'data-deeplink-eur="' . $deepLinkEur . '"'; }
if($deepLinkDK){ echo 'data-deeplink-dk="' . $deepLinkDK . '"'; }
if($deepLinkGP){ echo 'data-deeplink-gb="' . $deepLinkGP . '"';  }
if($deepLinkUSA){ echo 'data-deeplink-us="' . $deepLinkUSA . '"';} 
if($deepLinkSE){ echo 'data-deeplink-se="' . $deepLinkSE . '"'; }
if($deepLinkDE){ echo 'data-deeplink-de="' . $deepLinkDE . '"'; }
if($deepLinkPL){ echo 'data-deeplink-pl="' . $deepLinkPL . '"'; }
if($deepLinkFI){ echo 'data-deeplink-fi="' . $deepLinkFI . '"';} 
if($deepLinkNO){ echo 'data-deeplink-no="' . $deepLinkNO . '"'; }
if($deepLinkPT){ echo 'data-deeplink-pt="' . $deepLinkPT . '"'; }
if($deepLinkCZ){ echo 'data-deeplink-cz="' . $deepLinkCZ . '"'; }
if($deepLinkNL){ echo 'data-deeplink-nl="' . $deepLinkNL . '"'; }
if($deepLinkIT){ echo 'data-deeplink-it="' . $deepLinkIT . '"'; }
else { echo 'data-deeplink-general="' . $deepLinkGeneral . '"'; }?>