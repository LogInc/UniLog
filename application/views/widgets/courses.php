<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
?>

<div class="col-md-3 no-select post-div" style="background-color:white; border-radius:5px;" >
    <ul style="list-style-type: none;padding-top: 10%;font-size: 18px;min-height: 600px">
        <strong><a style="color:black" href="<?php echo base_url('course/current/' . $user_data->user_id) ?>">Current Courses</a></strong>
		<?php
		foreach ($courses as $course) {
			echo "<li><a href='#'>" . $course['course_name'] . '</a></li>';
		}
		?>
        <hr>
        <li><a href="#" style="color: black"><strong>Class Room</strong></a></li>
        <hr>
        <li><a href="<?php echo base_url('course/all/' . $user_data->user_id) ?>" style="color: black"><b>My Courses</b></a>
        <hr>
		<li><a href="<?php echo base_url('courses') ?>" style="color: black"><b>All Courses</b></a>
    </ul>
    
    
</div>
