<?php

/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
$course_name = "Artificial Intelligence";
$box = img(image_path('box-sketch.png'), FALSE, 'class="img-rounded" width="150" alt="unilog logo"')

?>

<div class="col-md-12">
    <div style="background-color: white;min-height: 261px;padding: 20px;border-radius:5px" > 
        <h3><strong><?php echo $course_name ?></strong></h3>          
        <hr style="height:2px;background-color: gray"> 
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <p><a href="" class="label label-default" rel="tooltip" title="Upload-post">Upload File</a>
                </p>
            </div>
            <div class="col-md-4">
                <p><a href="http://localhost/unilog/home/notice_board?post=" class="label label-warning" rel="tooltip" title="Upload-nb">Update NB</a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php echo $box ?>
                <a href="#">Notes</a>
            </div>
            <div class="col-md-4">
                <?php echo $box ?>
                <a href="#">Quizzes</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php echo $box ?>
                <a href="#">Videos</a>
            </div>
            <div class="col-md-4">
                <?php echo $box ?>
                <a href="#">Past Papers</a>
            </div>
        </div>
            
        
    </div>
    
    
</div>
