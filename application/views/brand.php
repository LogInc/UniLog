<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
?>

<div class="row page-header">
	<div class="col-md-12">
		<?php
		$a = '<a href="' . base_url() . '">';
		$a .= img(imagePath('unilog_logo.png'), FALSE, 'width="150" alt="unilog logo"');
		echo $a . '</a>';
		?>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		Welcome to <b style="color:#4472c4" >UniLog</b>, we hope you enjoy the experience.
	</div>
</div>

<div class="row">
	<div class="col-md-5 col-md-offset-1">
		<img class="img-responsive" style="margin-top: 5%" src="<?php echo imagePath('schoolbag.png') ?>" alt="bag sketch" >
	</div>