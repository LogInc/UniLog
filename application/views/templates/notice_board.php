<?php

/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

$notice_board = img(image_path('notice.jpg'), FALSE, 'class="img-rounded" width="200" alt="noticeboard"')
?>
</div>
<div class="col-md-6" >
   
    <div class="jumbotron" style="background-color: white; min-height: 200px; padding: 20px;border-radius:5px" >
    <form class='form-group'>
        Post on the notice board:<br>
        <input type="text" name="post" >
        <button type="button">Submit</button>
        <br>
    </form>
    
    </div>
    
    <div class="col-md-12" style=" background-image: <?php echo $notice_board?>; min-height: 200px;padding: 20px;border-radius:5px" >
        asad
    </div>
    
    

</div>

