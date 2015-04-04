<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
?>
    
<div class="col-md-5">
	<?php echo form_open('welcome/sign_up', 'class="form-horizontal" role="form"') ?>
    <h2><b>Sign Up</b></h2>
    <h4 class="text-danger"><?php echo validation_errors(); ?></h4>
    <p> or <a href="<?php echo site_url('welcome/sign/0'); ?>">Sign In</a></p>
            
    <div class="form-group form-group-lg">
        <label class="control-label col-lg-1 col-md-4 col-sm-2 sr-only" for="firstname">First Name:</label>
        <div class="col-md-8 col-sm-10">
            <input class="form-control" type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" placeholder="Enter your first name">
        </div>
    </div>
            
    <div class="form-group form-group-lg">
        <label class="control-label col-lg-1 col-md-4 col-sm-2 sr-only" for="lastname">Last Name:</label>
        <div class="col-md-8 col-sm-10">
            <input class="form-control" type="text" name="lastname" value="<?php echo set_value('lastname'); ?>" placeholder="Enter your last name">
        </div>
    </div>
            
    <div class="form-group form-group-lg">
        <label class="control-label col-lg-1 col-md-4 col-sm-2 sr-only" for="rollno">Roll No:</label>
        <div class="col-md-8 col-sm-10">
            <input class="form-control" type="text" name="rollno" value="<?php echo set_value('rollno'); ?>" placeholder="Enter your roll no.">
        </div>
    </div>
            
    <div class="form-group form-group-lg">
        <label class="control-label col-lg-1 col-md-4 col-sm-2 sr-only" for="email">Email:</label>
        <div class="col-md-8 col-sm-10">
            <input class="form-control" type="text" name="email" value="<?php echo set_value('email'); ?>" placeholder="Enter your email address">
        </div>
    </div>
            
    <div class="form-group form-group-lg">
        <label class="control-label col-lg-1 col-md-4 col-sm-2 sr-only" for="password">Password:</label>
        <div class="col-md-8 col-sm-10">
            <input class="form-control" type="text" name="password" placeholder="Enter your password">
        </div>
    </div>
            
    <div class="form-group form-group-lg">
        <div class="col-lg-offset-1 col-md-8 col-md-offset-4 col-sm-10 col-sm-offset-2">
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit_signup">Sign Up</button>
        </div>
    </div>
            
    <div class="form-group form-group-lg">
        <div class="col-lg-offset-1 col-md-8 col-md-offset-4 col-sm-4 col-sm-offset-2">
            <label class="form-control-static">By signing up, you agree to UniLog's
                <a href='#'>Terms of Service</a></label>
        </div>
    </div>
	<?php echo '</form>'; ?>
</div>