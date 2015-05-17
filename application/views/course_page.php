<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

$box_notes = img(image_uri('Box_Notes.png'), FALSE, 'class="img-rounded" width="150" alt="Notes"');
$box_pp = img(image_uri('Box_PastPapers.png'), FALSE, 'class="img-rounded" width="150" alt="Past Papers"');
$box_quiz = img(image_uri('Box_Quizzes.png'), FALSE, 'class="img-rounded" width="150" alt="Quizzes"');
$box_video = img(image_uri('Box_Videos.png'), FALSE, 'class="img-rounded" width="150" alt="Videos"');
?>

<div class="col-md-12">
    <div class="row">
        <div class="jumbotron" style="background-color: white">  
            <div class="row">
                <div class="col-md-8">
                    <h3><strong><?php echo $course_data->course_name ?></strong></h3>
                </div>
				<?php
				if ($course_data->course_end_date == null && isset($enroll_button)) {
					$url = base_url("course/enroll/$course_data->course_code/$course_data->course_term/$course_data->course_year/$course_data->course_type");
					$html = <<<END
                <div class="col-md-4" style="float: right;margin-top: 10px">
					<form method='post' action='$url'>
						<button class="btn btn-primary btn-lg btn-block" type="submit" name="submit_signin">Enroll!</button>
					</form>
				</div>
END;
					echo $html;
				}
				?>
            </div>
            <hr style="height:2px;background-color: gray"> 
            <h3><?php echo $course_data->course_intro ?></h3>

        </div>
    </div>

<!--    <div class="row">
        <div style="background-color: white;min-height: 261px;padding: 20px;border-radius:5px;">        
            <div class="row">
                <div class="col-md-4" style="margin-left: auto;margin-right: auto">
					<?php echo $box_notes ?>
                    <a href="http://localhost/unilog/user/course_doc">Notes</a>
                </div>
                <div class="col-md-8">
					<?php echo $box_quiz ?>
                    <a href="#">Quizzes</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
					<?php echo $box_video ?>
                    <a href="#">Videos</a>
                </div>
                <div class="col-md-4">
					<?php echo $box_pp ?>
                    <a href="#">Past Papers</a>
                </div>
            </div>
        </div>
    </div>-->
</div>