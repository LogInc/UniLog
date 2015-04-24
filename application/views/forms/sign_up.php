<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

// To avoid error output.
if (!isset($initial_form))
	$initial_form = "0";

// After submitting the form with incorrect information
$us_checked = $initial_form == '1' ? 'checked' : '';
$os_checked = $initial_form == '2' ? 'checked' : '';
?>

<?php echo form_open('sign-up', 'class="form-horizontal" role="form"') ?>
<div class="col-md-5">
    <h2><b>Sign Up</b></h2>

    <p> or <a href="<?php echo site_url('sign-in'); ?>">Sign In</a></p>

    <div id="form_type" class="form-inline">    
        <p> Select account type </p>
        <div class ="col-lg-10 col-md-9">
            <div class="radio">
                <label><input id ="U-S" type="radio" name="type" value="1" <?php echo $us_checked; ?>> University Student</label>
            </div>
        </div>

        <div class ="col-lg-10 col-md-9">
            <div class="radio">
                <label><input type="radio" name="type" value=2 <?php echo $os_checked; ?>> Open Course Student</label>
            </div>
        </div>

        <div class="form-group form-group-lg">
            <br>
            <div class="col-lg-offset-10 col-md-10 col-md-offset-8 col-sm-9 col-sm-offset-5 pull-right">
                <button class="btn btn-primary moveOn" type="button">Ok, next!</button>
            </div>
        </div>

    </div>
</div>

<div class="col-md-5">
    <h4 class="text-danger"><?php echo validation_errors(); ?></h4>    
	<div class="Student-form" style="display:none">
		<div class="form-group form-group-lg ">
			<label class="control-label col-lg-1 col-md-4 col-sm-0 sr-only" for="firstname">First Name:</label>
			<div class="col-md-10 col-sm-9">
				<input class="form-control" type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" placeholder="Enter your first name">
			</div>
		</div>

		<div class="form-group form-group-lg">
			<label class="control-label col-lg-1 col-md-4 col-sm-0 sr-only" for="lastname">Last Name:</label>
			<div class="col-md-10 col-sm-9">
				<input class="form-control" type="text" name="lastname" value="<?php echo set_value('lastname'); ?>" placeholder="Enter your last name">
			</div>
		</div>

		<div id='rollno' class="form-group form-group-lg" style = "display:none">
			<label class="control-label col-lg-1 col-md-4 col-sm-0 sr-only" for="rollno">Roll No:</label>
			<div class="col-md-10 col-sm-9">
				<input class="form-control" type="text" name="rollno" value="<?php echo set_value('rollno'); ?>" placeholder="Enter your Roll No.">
			</div>
		</div>

		<div id='pin' class="form-group form-group-lg" style="display:none">
			<label class="control-label col-lg-1 col-md-4 col-sm-0 sr-only" for="email">PIN:</label>
			<div class="col-md-10 col-sm-9">
				<input class="form-control" type="text" name="email" value="<?php echo set_value('pin'); ?>" placeholder="Enter your 5 digit PIN">
			</div>
		</div>

		<div class="form-group form-group-lg">
			<label class="control-label col-lg-1 col-md-4 col-sm-0 sr-only" for="email">Email:</label>
			<div class="col-md-10 col-sm-9">
				<input class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="Enter your email address">
			</div>
		</div>

		<div class="form-group form-group-lg">
			<label class="control-label col-lg-1 col-md-4 col-sm-0 sr-only" for="password">Password:</label>
			<div class="col-md-10 col-sm-9">
				<input class="form-control" type="password" name="password" placeholder="Enter your password">
			</div>
		</div>

		<div class="form-group form-group-lg">
			<div class="col-lg-offset-1 col-md-10 col-md-offset-0 col-sm-9 col-sm-offset-0">
				<button class="btn btn-primary btn-lg btn-block" type="submit" name="submit_signup">Sign Up</button>
			</div>
		</div>

		<div class="form-group form-group-lg">
			<div class="col-md-9 col-md-offset-1 col-sm-8 col-sm-offset-0">
				<label class="form-control-static">By signing up, you agree to UniLog's
					<a href='terms'>Terms of Service</a></label>
			</div>
		</div>
	</div>
</div>
<?php echo '</form>'; ?>

<script>
	function update(value) {
		if (value === "1")
		{
			$("#form_type").hide();
			$(".Student-form").fadeIn();
			$("#rollno").fadeIn();
			$("#pin").fadeIn();
		}
		else if (value == "2")
		{
			$("#form_type").hide();
			$(".Student-form").fadeIn();
		}
	}
	
	$(document).ready(function () {
		$(".moveOn").click(function () {
			var value = $('input[name=type]:checked', '#form_type').val()
			update(value);
		});
		
		var initialValue = "<?php echo $initial_form; ?>";
		update(initialValue);
	});
</script>