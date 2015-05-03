<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
?>

<!--<pre><?php var_dump($courses); ?></pre>-->
<div class="col-md-9">
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
							$out = <<<END
            <a href="#">
                <div class="col-md-6 thumbnail courses" style="min-height:500px;">                    
                    <div class="pic-caption" >                        
                        <div style="margin-top:60%;color: white">
                            <i class="glyphicon glyphicon-book"></i><strong> Learn More</strong>
                        </div>                            
                    </div>                        
                    <div class="img-wrapper" style ='background-image:url($photo);'>
                    </div>                        
                    <div>   
                        <hr style="height:2px;background-color: gray"> 
                        <h3>$course->course_code $term $course->course_year</h3>
						<h2>$name</h2>
						<h4>$type</h4>
						<h3>By $course->user_first_name $course->user_last_name</h3>
						<h4>Started $course->course_start_date</h4>
                    </div> 
                </div>
            </a>
END;
							echo $out;
						}
					} else echo 'No courses found.';
					?>
				</div>
			</div>
		</div>
	</div>
</div>