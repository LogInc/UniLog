<!DOCTYPE html>

<html>
    <head>
        <title>UniLog | Sign in </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo stylePath('bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo stylePath('bootstrap-theme.min.css') ?>">
		<script src="<?php echo scriptPath('jquery-2.1.1.min.js') ?>"></script>
        <script src="<?php echo scriptPath('bootstrap.min.js') ?>"></script>
        <style>
            body{
				font-family:"Calibri Light";
				font-size: 20px;
            }
			
			a:hover {
				text-decoration: none;
			}
        </style>
    </head>

    <body>
        <div class="container-fluid">
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
                    <img class="img-responsive" src="<?php echo imagePath('schoolbag.png') ?>" alt="bag sketch" >
                </div>

                <div class="col-md-5" id="signIn_form">
                    <form class="form-horizontal" role="form" method="post">
                        <h2>Sign In</h2>
                        <p>or <a href="#" id="signup">create an account</a></p>

						<div class="form-group form-group-lg">
							<label class="control-label col-lg-3 col-md-4 col-sm-2" for="username">Email:</label>
							<div class="col-md-8 col-sm-10">
								<input class="form-control" type="text" name="username" placeholder="Enter your email address">
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
                    </form>
                </div>      

                <div class="col-md-5" id="signUp_form" style="display:none">
                    <form class="form-horizontal" role="form" method="post">
                        <h2>Sign Up</h2>
                        <p> or <a href="#" id="signin_page">Sign In</a></p>

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
					</form>
				</div>
			</div>
		</div>
		<script>
			$(document).ready(function () {
				$("#signin_page").click(function () {
					$("#signUp_form").hide();
					$("#signIn_form").show();
					$('title').html("UniLog | Sign-In");
				});

			});
			$(document).ready(function () {
				$("#signup").click(function () {
					$("#signIn_form").hide();
					$("#signUp_form").show();
					$('title').html("UniLog | Sign-Up");
				});

			});
		</script>
	</body>
</html>
