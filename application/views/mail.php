<?php

/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

require_once 'page_head.php';
require_once 'brand.php';
?>

<div>
	<p>Greetings from UniLog</p>
	<p>	We have received your request to sign up at UniLog.
		Please 
		<a href="<?php echo site_url('welcome/register_user') . '/' . urlencode($key); ?>">Click Here</a>
		to activate your account.
	</p>
	<br/>
	<br/>
	<p>
		If you did not sign-up for UniLog, please ignore this mail.
	</p>
</div>

<?php
require_once 'page_foot.php';
?>