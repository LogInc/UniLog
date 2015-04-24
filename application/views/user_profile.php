<?php
    
/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
$profile_image = img(image_path('profile_pic.jpg'), FALSE, 'class="img-rounded" width="200" alt="unilog logo"')
?>

<div class="col-md-9 " >
    <div class="col-md-11" style="background-color: white;min-height: 261px;padding: 20px;border-radius:5px" >       
        <h3><strong>Your Profile</strong></h3>          
        <hr style="height:2px;background-color: gray"> 
        
        <div class="pull-right">
            <?php echo $profile_image ?> 
            <div style="text-align: center">
                <a href="#" style="font-size: 15px;">Change photo</a>
            </div>
        </div>
        <div class="col-md-6" style="font-size: 17px">
            <h2><strong><?php echo "Ahmar Sultan" ?></strong></h2>
            <h3><?php echo "Computer Engineering- University of Engineering and Technology" ?></h3>
            <h4><?php echo "ahmar_sultan@live.com" ?></h4>
            <p><strong>Session:</strong> <?php echo "2012" ?></p>
            <p><strong>Currently:</strong> <?php echo "2015/Fall/CE" ?></p>
        </div>
        
        
    </div>
    
    <div class="col-md-11" style="background-color: white;min-height: 261px;padding: 20px;border-radius:5px;margin-top: 15px" >       
        <h3><strong>A brief description</strong></h3>          
        <hr style="height:2px;background-color: gray">            
        <div class="col-md-12" style="font-size: 17px">
            <form role="form">
                <div class="form-group">
                    <label for="comment"></label>
                    <textarea class="form-control" rows="8" id="comment" placeholder="write something about you and your goals in life"></textarea>
                    <div class="pull-right" style="margin-top:10px">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-group-justified" type="submit" name="submit_post">Save</button>                           
                            </div>
                            <div class="col-md-6 col-md">
                                <button class="btn btn-default btn-group-justified" type="cancel" name="cancel_post">Cancel</button>                           
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>            
    </div>
</div>
