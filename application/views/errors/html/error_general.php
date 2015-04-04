<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

$base = config_item('base_url');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>UniLog</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $base; ?>/css/bootstrap-theme.css">
        <script src="<?php echo $base; ?>/js/jquery-2.1.1.min.js'"></script>
        <script src="<?php echo $base; ?>/js/bootstrap.min.js"></script>
        <style>
            body{
                font-family:"Calibri Light";
                font-size: 20px;
            }

            a:hover, a:focus {
                text-decoration: none;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div style="min-height:100px">
				<div class="row page-header">
					<div class="col-md-12">
						<a href="/">
							<img src="<?php echo $base; ?>/images/unilog_logo.png" width="150" alt="unilog logo" />
						</a>
					</div>
				</div>

				<?php
				echo "<h2>$heading</h2>";
				echo '<p class="text-info">';
				echo $message;
				echo "<a href='$base'>Go to Home</a>";
				echo '</p>';
				?>
			</div>
			<footer class="text-center text-info"><br>Copyright &copy; 2015 log inc. All rights reserved.</footer>
		</div>
	</body>
</html>