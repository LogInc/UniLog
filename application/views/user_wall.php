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
    <div class="jumbotron col-md-12 no-select post-div" style="text-align:center;"> 
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <p><a href="#" class="label label-default uploadpost" rel="tooltip" title="Upload-post">Upload Post</a>
                </p>
            </div>
            <div class="col-md-4">
                <p><a href="#" class="label label-warning uploadfile" rel="tooltip" title="Upload-file">Upload file</a>
                </p>
            </div>
        </div>
            
        <form role="form" class="post-text-area">
            <div class="form-group post-form">
                <label for="comment"></label>
                <textarea class="form-control" rows="5" id="input_post" placeholder="Write a post or share information..."></textarea>
                <div class="pull-right" style="margin-top:10px">
                    <button class="btn btn-primary btn-group-justified post-button" type="button">Post</button>
                </div>
            </div>
        </form>
            
        <div class="upload-file-area"  style="display: none">            
                <a href="#">
                    <div class="thumbnail" style="display:centre" >
                        <div class="pic-caption" >                        
                            <div style="color: white">
                            </div>                            
                        </div>                        
                        <div class="img-wrapper" style=" min-height: 10px;">                              
                            <p><strong>Upload File</strong></p>
                        </div>                        
                    </div>
                </a>
            <div class="pull-right" style="margin-top:10px">
                <button class="btn btn-primary btn-group-justified post-button" type="button">Post</button>
            </div>
        </div>
    </div>
    <b>News Feed</b>
    <hr style="height:2px;background-color: gray"> 
    <div class="col-md-12" >
        
        <div class="post-div" id = "user-post">
            Welcome to UniLog
            All your posts will be displayed here!
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
                $('#user-post').before("<div class='post-div' id = 'user-post'>" + "<div id = 'user-post'>"+ name + time + 
                        "</p></div>"+ post + "</div>");
                
                $('#input_post').val("");
            }
        });
    }); 
    
    $(document).ready(function(){
        $(".uploadpost").click(function(){
            $(".upload-file-area").hide();
            $(".post-text-area").fadeIn();
            
        });
        $(".uploadfile").click(function(){
            $(".post-text-area").hide();
            $(".upload-file-area").fadeIn();
            
        });
    });
    
    $('.thumbnail').hover(
            
            function(){
                $(this).find('.pic-caption').fadeIn(); 
    },
    function(){
        $(this).find('.pic-caption').fadeOut(); 
    }
            
            );
    
</script>