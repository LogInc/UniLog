<!DOCTYPE html>
<!--
UniLog project.
UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
Copyright 2015 log inc.
-->

<div class='col-md-9'>
	<div class="col-md-12" style="background-color: white;min-height: 600px;padding: 20px;border-radius:5px" >
		<div class="row">
			<div class="col-md-8">
				<h3><strong>
						<p>
							<?php echo $course_data->course_code . ' ' . $course_data->course_term . ' ' . $course_data->course_year . ' ' . ($course_data->course_type == 'th' ? 'Theory' : 'Practical'); ?>
						</p>
						<p>
							<?php echo $course_data->course_name; ?>
						</p>
					</strong></h3>
			</div>
		</div>
		<hr>
		<ul class='nav nav-tabs no-select' id='course-nav'>
			<li class='active'><a href='#home'>Home</a></li>
			<li><a href='#uploads'>Uploads</a></li>
			<li><a href='#info'>Course Info</a></li>
		</ul>

		<div class='tab-content'>
			<div id='home' class='tab-pane fade in active'>
				home
			</div>

			<div id='uploads' class='tab-pane fade'>
				Uploads
			</div>

			<div id='info' class='tab-pane fade'>
				Course Info
			</div>
		</div>
	</div>
</div>

<script>
	$('#course-nav a').click(function () {
		$(this).tab('show');
		return false;
	});
</script>