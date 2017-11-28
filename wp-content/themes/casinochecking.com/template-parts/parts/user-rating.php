<?php
$userVotes = get_field('user_votes');
//var_dump($userVotes);
for ($x = 1; $x <= $userVotes; $x++) { ?>
    <img src="<?php echo get_site_url(null, '/wp-content/uploads/2017/10/gold-star.png'); ?>">
<?php } ?>
<?php $remainingStars = 5 - $userVotes;
for ($x = 1; $x <= $remainingStars; $x++) { ?>
    <img src="<?php echo get_site_url(null, '/wp-content/uploads/2017/10/grey-star.png'); ?>">
<?php } ?>