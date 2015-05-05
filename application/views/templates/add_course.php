<?php
    
/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
?>
<div id="addcourseScreen"> 
    <div class="formScreen col-md-12">
        <a href="#" class="cancel">&times;</a>
        <h3><strong>Add a Course</strong></h3>
        <hr style="height:2px;background-color: gray"> 
        
        <div class="row">
            <div class="col-md-12 form-group form-group-lg">
                <label class="control-label col-lg-1 col-md-4 col-sm-0 sr-only" for="course_title">Title:</label>
                <div class="col-md-12 col-sm-9">
                    <input class="form-control" type="text" name="course_title" placeholder='Enter Course Title e.g. "Artificial Intelligence" '>
                </div>            
            </div> 
            
            <div class="col-md-12 form-group form-group-lg">
                <label class="control-label col-lg-1 col-md-4 col-sm-0 sr-only" for="course_code">Course Code:</label>
                <div class="col-md-12 col-sm-9">
                    <input class="form-control" type="text" name="course_code" placeholder='Enter Course Code e.g."CS104" '>
                </div>            
            </div>
            <div class ="col-md-12 form-group form-group-lg form-inline" style="margin-left: auto;margin-right: auto">
                <div class="radio col-md-2">
                    <label><input type="radio" name="course_type" value="fall"> <strong>Fall</strong></label>
                </div>
                <div class="radio col-md-4">
                    <label><input type="radio" name="course_type" value="spring"><strong>Spring</strong></label>                    
                </div>
            </div>            
            <div class="col-md-12">
                <div style="margin-left: 12px;margin-right: 12px">
                <label for="comment"></label>
                <textarea class="form-control" rows="6" id="input_post" name="course-description" placeholder="Write Course Description..."></textarea>
                <div class="pull-right" style="margin-top:10px">
                    <button class="btn btn-primary btn-group-justified post-button" type="submit">Add Course</button>
                </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div id="cover"> 
</div>

