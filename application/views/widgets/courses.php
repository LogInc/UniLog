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
			$url = base_url('user/course/' . $course->course_code . '/' . $course->course_term . '/' . $course->course_year . '/' . $course->course_type);
			echo "<li><a href='$url'>" . $course->course_name . ' (' . ucfirst($course->course_type) . ')' . "</a></li>";
		}
		?>
        <hr>
        <li><a href="<?php echo base_url('user/my-courses') ?>" style="color: black"><b>My Courses</b></a></li>
        <hr>
		<?php
		if ($user_data->user_type == 'user_type_student') {
			echo '<li><a href="' . base_url('courses') . '" style="color:black"><b>All Courses</b></a></li>';
			echo '<hr>';
		}

		if ($user_data->user_type != 'user_type_student') {
			echo '<li><a href="' . base_url('#addcourseScreen') . '" style="color:black"><b>Add Course</b></a></li>';
			echo '<hr>';
		}
		?>
    </ul>
</div>
