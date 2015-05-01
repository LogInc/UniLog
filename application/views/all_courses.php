<?php
    
/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
$total_courses = 100;
$CN = img(image_path('computer-networks.jpg'), FALSE, 'class="img-rounded" width="250" alt="unilog logo"');
$AI = img(image_path('artificial-intelligence.jpg'), FALSE, 'class="img-rounded" width="800" alt="unilog logo"');
?>
<div class="col-md-8">
    <h1> <strong> Viewing all <?php echo $total_courses ?> courses </strong></h1>    
</div>
    
<div class="col-md-12" style=" margin-top: 20px;background-color: #D0D0D0;min-height: 500px ;padding: 25px;border-radius:5px" > 
    <h3><strong><?php echo "All Courses" ?></strong></h3>          
    <hr style="height:2px;background-color: gray"> 
    <div class='col-md-12'>
        <div class='row'>
            <div class="col-md-3 thumbnail courses">
                <div class="pic-caption">
                    <div style="margin-top:50%;color: white">
                        <a href="#" style="color:white;"><i class="glyphicon glyphicon-book"></i> Learn More </a>
                    </div>
                </div>
            <?php echo $CN ?>
                <div>   
                    <hr style="height:2px;background-color: gray"> 
                    <h3> <?php echo "Computer Networks" ?></h3>
                    <div>
                        <p>Started On </p>
                        <h4> 23-May-2012 </h4>
                        
                    </div>
                    
                </div>            
            </div>
        </div>
    
    
    
    
        <script>
            $('.thumbnail').hover(
                    function () {
                        $(this).find('.pic-caption').fadeIn();
            },
            function () {
                $(this).find('.pic-caption').fadeOut();
            }
            
                    );
        </script>