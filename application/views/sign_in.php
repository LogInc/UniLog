<?php
/* 
* UniLog project.
* UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
* Copyright 2015 log inc.
*/
?>

<div class="col-md-5">
<?php echo form_open('welcome/sign_in', 'class="form-horizontal" role="form"') ?>
	<h2>Sign In</h2>
	<h4 class="text-danger"><?php echo validation_errors(); ?></h4>
	<p>or <a href="<?php echo site_url('welcome/sign/1'); ?>">create an account</a></p>

	<div class="form-group form-group-lg">
		<label class="control-label col-lg-3 col-md-4 col-sm-2" for="email">Email:</label>
		<div class="col-md-8 col-sm-10">
			<input class="form-control" type="text" name="email" placeholder="Enter your email address">
		</div>
	</div>

	<div class="form-group form-group-lg">
		<label class="control-label col-lg-3 col-md-4 col-sm-2" for="password">Password:</label>
		<div class="col-md-8 col-sm-10">
			<input class="form-control" type="text" name="password" placeholder="Enter your password">
		</div>
	</div>

	<div class="form-group form-group-lg form-inline">
		<div class="col-lg-4 col-lg-offset-3 col-md-5 col-md-offset-4 col-sm-3 col-sm-offset-2">
			<div class="checkbox">
				<label><input type="checkbox" name="remember_me"> Remember me</label>
			</div>
		</div>
		<div class="col-lg-3 col-lg-offset-1 col-md-3 col-md-offset-0 col-sm-2 col-sm-offset-5">
			<button class="btn btn-primary btn-lg btn-block" type="submit" name="submit_signin">Sign In</button>
		</div>
	</div>
<?php echo '</form>'; ?>
</div>