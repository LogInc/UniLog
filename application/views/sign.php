<?php

/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
?>

<div class="row">
	<div class="col-md-12">
		Welcome to <b style="color:#4472c4" >UniLog</b>, we hope you enjoy the experience.
	</div>
</div>

<div class="row">
	<div class="col-md-5 col-md-offset-1">
		<img class="img-responsive" style="margin-top: 5%" src="<?php echo imagePath('schoolbag.png') ?>" alt="bag sketch" >
	</div>
	
	<?php
	if ($signup) {
		require_once 'sign_up.php';
	} else {
		require_once 'sign_in.php';
	}
	?>
</div>