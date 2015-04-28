<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
$bag_image = image_path('schoolbag.png');

if ($user_data->user_photo == null)
	$profile_image_path = image_path('default_profile.png');
else
	$profile_image_path = upload_path ('profile_pics' . $user_data->user_photo);
	
	$profile_photo = img($profile_image_path, FALSE, 'class="img-circle"');
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

    #nav > div {
        padding:5px;
    }

    ul#nav {
        list-style-type:none;
        padding-top:5px;
    }
</style>

<nav id='nav' class="navbar navbar-default no-select" style='padding:5px'>
    <div class="col-sm-2 navbar-header ">
		<?php
		$a = '<a href="' . base_url() . '" >';
		$a .= img(image_path('unilog_logo.png'), FALSE, 'width="100" alt="unilog logo"');
		echo $a . '</a>';
		?>
    </div>

    <div class='col-md-6 col-sm-4'>
        <form class="form-horizontal" role="form">
            <div class="col-sm-12 input-group">
                <input id="search" type="text" class="form-control" placeholder="Search my bag" name="serch-term">
                <div class="input-group-btn">
                    <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div style="font-size:17px;">
        <ul id="nav" class="navbar-nav pull-right">
            <li class="dropdown" style="padding-bottom:10px"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<?php echo $profile_photo ?>
                    <strong>
						<?php echo $user_data->user_first_name; ?>
					</strong> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url('home/profile') ?>">Profile</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Log Out</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url('home/notice-board?postid=') ?>"><strong>Notice Board</strong></a></li>
        </ul>
    </div>
</nav>
