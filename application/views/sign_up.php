<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
?>

<div class="col-md-5">
<?php echo form_open('welcome/signup', 'class="form-horizontal" role="form"') ?>
	<h2>Sign Up</h2>
	<p> or <a href="<?php echo site_url('welcome/sign/0'); ?>">Sign In</a></p>

	<div class="form-group form-group-lg">
		<label class="control-label col-lg-3 col-md-4 col-sm-2" for="firstname">First Name:</label>
		<div class="col-md-8 col-sm-10">
			<input class="form-control" type="text" name="firstname" placeholder="Enter your first name">
		</div>
	</div>

	<div class="form-group form-group-lg">
		<label class="control-label col-lg-3 col-md-4 col-sm-2" for="lastname">Last Name:</label>
		<div class="col-md-8 col-sm-10">
			<input class="form-control" type="text" name="lastname" placeholder="Enter your last name">
		</div>
	</div>

	<div class="form-group form-group-lg">
		<label class="control-label col-lg-3 col-md-4 col-sm-2" for="email">Email:</label>
		<div class="col-md-8 col-sm-10">
			<input class="form-control" type="text" name="email" placeholder="Enter your email address">
		</div>
	</div>

	<div class="form-group form-group-lg">
		<label class="control-label col-lg-3 col-md-4 col-sm-2" for="rollno">Roll No:</label>
		<div class="col-md-8 col-sm-10">
			<input class="form-control" type="text" name="rollno" placeholder="Enter your roll no.">
		</div>
	</div>

	<div class="form-group form-group-lg form-inline">
		<div class="col-lg-5 col-lg-offset-3 col-md-6 col-md-offset-2 col-sm-4 col-sm-offset-2">
			<div class="checkbox">
				<label><input type="checkbox" name="agree"> I agree to<a href="#" class="brand"> UniLog terms</a></label>
			</div>
		</div>

		<div class="col-lg-3 col-lg-offset-0 col-md-4 col-md-offset-0 col-sm-2 col-sm-offset-4">
			<button class="btn btn-primary btn-lg btn-block" type="submit" name="submit_signup">Sign Up</button>
		</div>
	</div>
<?php echo '</form>'; ?>
</div>
</div>