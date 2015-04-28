<?php
    
/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
    date_default_timezone_set("Asia/Karachi");
    $user_name = "<a>Ahmar Sultan</a> shared a post at ";
    $time = date("h:i:sa");
?>
    
<div class="col-md-6">
    <div class="jumbotron no-select " style="background-color: white"> 
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <p><a href="" class="label label-default" rel="tooltip" title="Upload-post">Upload Post</a>
                </p>
            </div>
            <div class="col-md-4">
                <p><a href="" class="label label-warning" rel="tooltip" title="Upload-file">Upload file</a>
                </p>
            </div>
        </div>
            
        <form role="form">
            <div class="form-group" style="margin-top:10px">
                <label for="comment">Write your post</label>
                <textarea class="form-control" rows="5" id="input_post" placeholder="Write a post or share information..."></textarea>
                <div class="pull-right" style="margin-top:10px">
                    <button class="btn btn-primary btn-group-justified post-button" type="button">Post</button>
                </div>
            </div>
        </form>
    </div>
        
    <div class="col-md-12" style="background-color: white;min-height: 350px;padding: 20px;border-radius:5px" >
        <b>News Feed</b>
        <hr style="height:2px;background-color: gray">
        <div >
            <div id = "user-post">
                Welcome to UniLog
                All your posts will be displayed here!
            </div>
                
        </div>
    </div>
</div>
    
    
<script>
    $(document).ready(function(){
        $(".post-button").click(function(){
            var post = $("#input_post").val();             
            var name = '<?php echo $user_name; ?>';
            var time = '<?php echo $time; ?>';
            if(post !== "") {          
                $('#user-post').before("<div id = 'user-post'>"  + post + "</div><hr>");
                $('#user-post').before("<div id = 'user-post'>"+ name + time + "</p></div>"); 
                
                $('#input_post').val("");
            }
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