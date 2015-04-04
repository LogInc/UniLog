<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

require_once 'page_head.php';
require_once 'brand.php';
$link = site_url('welcome/register_user') . '/a?id=' . urlencode($key);
?>

<div class='row'>
	<div class='col-xs-12'>
		<p>Greetings from UniLog.</p>
		<p>Dear <?php echo $name; ?>,</p>
		<p>We have received your request to sign up at UniLog.
			Please 
			<a href="<?php echo $link; ?>">Click Here</a>
			to activate your account.
		</p>
		<br/>
		<br/>
		<p>
			If you did not sign-up for UniLog, please ignore this mail.
		</p>
	</div>
</div>

<?php
require_once 'page_foot.php';
?>