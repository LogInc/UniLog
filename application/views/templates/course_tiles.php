<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
?>

<div class="col-md-10">
	<div class="row">
		<div class="col-md-12" style=" margin-top:20px;background-color:#FFFFFF; min-height:500px ;padding: 25px;border-radius:5px" > 
			<h3><strong><?php echo $title ?></strong></h3>          
			<hr style="height:2px;background-color: gray"> 
			<div class='col-md-12'>
				<div class='row'>
					<?php
					if ($courses) {
						foreach ($courses as $course) {
							if ($course->course_photo != "")
								if (file_exists(upload_path('course_pics/' . $course->course_photo)))
									$photo = upload_uri('course_pics/' . $course->course_photo);
								else
									$photo = image_uri('rzi.jpg');
							else
								$photo = image_uri('rzi.jpg');

							$term = ucfirst($course->course_term);
							$name = ucwords($course->course_name);
							$type = $course->course_type == 'th' ? 'Theory' : 'Lab';
							if ($show_date == 'started')
								$date = 'Started ' . $course->course_start_date;
							else if ($show_date == 'ended')
								$date = 'Ended ' . $course->course_end_date;
							else
								$date = '';
							
							if (isset($my_course))
								$base = 'my-courses';
							else
								$base = 'course';
							$a = base_url("$base/$course->course_code/$course->course_term/$course->course_year/$course->course_type");
							$out = <<<END
            <a href="$a">
                <div class="col-md-4 thumbnail course-tile" style="min-height:450px;">                    
                    <div class="course-tile-pic-caption" >                        
                        <div style="margin-top:35%;color: white">
                            <i class="glyphicon glyphicon-book"></i><strong> Learn More</strong>
                        </div>                            
                    </div>                        
                    <div class="img-wrapper" style ='background-image:url($photo);'>
                    </div>
                    <div> 
                        <hr style="height:2px;background-color: gray"> 
                        <h4>$course->course_code $term $course->course_year</h4>
						<h3>$name</h3>
						<p>$type</p>
						<p>By $course->user_first_name $course->user_last_name</p>
						<h4>$date</h4>
                    </div> 
                </div>
            </a>
END;
							echo $out;
						}
					} else
						echo 'No courses found.';
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('.thumbnail').hover(
			function () {
				$(this).find('.course-tile-pic-caption').fadeIn(100);
			},
			function () {
				$(this).find('.course-tile-pic-caption').fadeOut(100);
			}

	);
</script>