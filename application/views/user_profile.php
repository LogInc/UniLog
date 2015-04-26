<?php
    
/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
$profile_image = img(image_path('profile_pic.jpg'), FALSE, 'class="img-rounded" width="200" alt="unilog logo"')
?>

<style>
    .thumbnail {
        position:inherit;
        overflow:hidden;
    }
    
    .caption {
        position:initial;          
        display: none;
        text-align:center;
        color:#fff;
    }
</style>

<div class="col-md-9 " >
    <div class="col-md-11" style="background-color: white;min-height: 261px;padding: 20px;border-radius:5px" >       
        <h3><strong>Your Profile</strong></h3>          
        <hr style="height:2px;background-color: gray"> 
        
        <div class="pull-right">
            <div class="thumbnail">
                <div class="caption">                    
                    <p><a href="" class="label label-default" rel="tooltip" title="Zoom">Update Photo</a>
                    </p>
                </div>
                <?php echo $profile_image ?> 
            </div>
            
        </div>
        <div class="col-md-8 thumbnail" style="font-size: 17px;padding:10px">  
            <div class="caption">                    
                <p><a href="" class="label label-default" rel="tooltip" title="Zoom">Update Info</a>
                </p>
            </div>
            <h2><strong><?php echo "Ahmar Sultan" ?></strong></h2>
            <h3><?php echo "Computer Engineering- University of Engineering and Technology" ?></h3>
            <h4><?php echo "ahmar_sultan@live.com" ?></h4>
            <p><strong>Session:</strong> <?php echo "University Student" ?></p>
            <p><strong>Session:</strong> <?php echo "2012" ?></p>
            <p><strong>Currently:</strong> <?php echo "2015/Fall/CE" ?></p>
        </div>
    </div>
    
    <div class="col-md-11" 
         style="background-color: white;min-height: 261px;padding: 20px;border-radius:5px;margin-top: 15px" >       
        <h3><strong>A brief description</strong></h3>          
        <hr style="height:2px;background-color: gray">            
        <div class="col-md-12 a-brief-description" style="font-size: 17px">
            <form role="form">
                <div class="form-group">
                    <label for="comment"></label>
                    <textarea class="form-control" id="aims-form" rows="8"  id="comment" placeholder="write something about you and your goals in life..."></textarea>
                    <div class="pull-right" style="margin-top:10px">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-group-justified save-button" type="button">Save</button>                           
                            </div>
                            <div class="col-md-6 col-md">
                                <button class="btn btn-default btn-group-justified cancel-button" type="button" name="cancel_post">Cancel</button>                           
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div  class="col-md-12 aims-div thumbnail" style="display:none;font-size: 17px">
            
            <div class="caption">                    
                <p><a class="label label-default edit-label" type="button" rel="tooltip" title="Zoom">Edit</a>
                </p>
            </div>
            <p id="aims-paragraph"></p>                
        </div>
    </div>
    
    
</div>

<script>
    $(document).ready(function(){
        $(".save-button").click(function(){
            var aims = $("#aims-form").val();
            
            document.getElementById("aims-paragraph").innerHTML = aims;
            
            if(aims.length !== 0){                
                $(".a-brief-description").hide();
                $(".aims-div").fadeIn();        
            }
        });
        $(".edit-label").click(function(){            
            $(".aims-div").hide();
            $(".a-brief-description").fadeIn();
        });        
    }); 
    $('.thumbnail').hover(
            
            function(){
                $(this).find('.caption').slideDown(250); 
    },
    function(){
        $(this).find('.caption').slideUp(250); 
    }
    
            );
</script>
