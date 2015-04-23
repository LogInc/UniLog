<?php
    
/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
$profile_image = img(image_path('profile_pic.jpg'), FALSE, 'class="img-rounded" width="200" alt="unilog logo"')
?>
    
<div class="col-md-8 " >
    <div class="col-md-11" style="background-color: white;min-height: 261px;padding: 20px;border-radius:5px" >       
        <b>Your Profile</b>          
        <hr style="height:2px;background-color: gray">
            
        <div class="col-md-4">
            <?php echo "Ahmar Sultan" ?>
            <?php echo "ahmar_sultan@live.com" ?>
            <?php echo "Session 2012" ?>
            <?php echo "2015/Fall/CE" ?>
        </div>
        <div class="pull-right">
            <?php echo $profile_image ?> 
            <div >
                <a href="#" style="font-size: 15px"> Update display picture </a>
            </div>
        </div>
            
    </div>
</div>