<?php

/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
$course_name = "Artificial Intelligence";
$box_notes = img(image_path('Box_Notes.png'), FALSE, 'class="img-rounded" width="150" alt="unilog logo"');
$box_pp = img(image_path('Box_PastPapers.png'), FALSE, 'class="img-rounded" width="150" alt="unilog logo"');
$box_quiz = img(image_path('Box_Quizzes.png'), FALSE, 'class="img-rounded" width="150" alt="unilog logo"');
$box_video = img(image_path('Box_Videos.png'), FALSE, 'class="img-rounded" width="150" alt="unilog logo"')

?>

<div class="col-md-12">
    <div style="background-color: white;min-height: 261px;padding: 20px;border-radius:5px" > 
        <h3><strong><?php echo $course_name ?></strong></h3>          
        <hr style="height:2px;background-color: gray"> 
        <div class="row">
            <div class="col-md-4">
                <?php echo $box_notes ?>
                <a href="#">Notes</a>
            </div>
            <div class="col-md-4">
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
    
    
</div>