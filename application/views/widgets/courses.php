<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
?>

<div class="col-md-3 no-select" style="background-color:white; border-radius:5px;" >
    <ul style="list-style-type: none;padding-top: 10%;font-size: 18px;min-height: 600px">
        <strong>Courses Now</strong>
		<?php
		foreach ($courses as $course) {
			echo "<li><a href='#'>" . $course['course_name'] . '</a></li>';
		}
		?>
        <hr>
        <li><a href="#" style="color: black"><strong>Class Room</strong></a></li>
        <hr>
        <li><a href="#" style="color: black"><b>All Courses</b></a>
    </ul>
</div>