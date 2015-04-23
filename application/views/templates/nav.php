<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

$bag_image = image_path('schoolbag.png');
?>

<style>
	#search{
		background: url(<?php echo $bag_image; ?>) no-repeat 2px 2px;
		background-size: 30px;
		padding-left:35px;
	}
	
	#nav li {
		padding-left:30px;
	}
</style>

<nav class="row navbar navbar-default" style='padding:10px'>
	<div class="col-md-2 navbar-header">
		<?php
		$a = '<a href="' . base_url() . '" >';
		$a .= img(image_path('unilog_logo.png'), FALSE, 'width="100" alt="unilog logo"');
		echo $a . '</a>';
		?>
	</div>

	<div class='col-md-6'>
		<form class="form-inline" role="form">
			<div class="col-md-12 col-sm-6 input-group">
					<input id="search" type="text" class="form-control" placeholder="Search my bag" name="serch-term">
				<div class="input-group-btn">
					<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				</div>
			</div>
		</form>
	</div>

	<div class="col-md-4" style="font-size:17px">
		<ul id="nav" class="navbar-nav navbar-right" style="list-style-type:none; padding-top:5px" >
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<strong>Ahmar Sultan</strong> <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="#">Profile</a></li>
					<li><a href="#">Help</a></li>
					<li><a href="#">Log Out</a></li>
				</ul>
			</li>
			<li><a href="#"><strong>Notice Board</strong></a></li>
		</ul>
	</div>
</nav>

