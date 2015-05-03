<?php
    
/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
$total_courses = 4;
$CN = image_path('computer-networks.jpg');
$AI = image_path('artificial-intelligence.png');
$WT = image_path('web_tech.jpg');
$ES = image_path('embedded-systems.jpg');
$CS = image_path('control-systems.jpg');
?>
<div class="col-md-8">
    <h1> <strong> Viewing all <?php echo $total_courses ?> courses </strong></h1>    
</div>
    
<div class="col-md-10" style=" margin-top: 20px;background-color: #D0D0D0;min-height: 500px ;padding: 25px;border-radius:5px" > 
    <h3><strong><?php echo "All Courses" ?></strong></h3>          
    <hr style="height:2px;background-color: gray"> 
    <div class='col-md-12'>
        <div class='row'>
            <a href="#">
                <div class="col-md-4 thumbnail courses">                    
                    <div class="pic-caption" >                        
                        <div style="margin-top:60%;color: white">
                            <i class="glyphicon glyphicon-book"></i><strong> Learn More</strong>
                        </div>                            
                    </div>                        
                    <div class="img-wrapper" style ='background-image:url(<?php echo $CN; ?>);'>
                    </div>                        
                    <div>   
                        <hr style="height:2px;background-color: gray"> 
                        <h3> <?php echo "Computer Networks" ?></h3>
                        <div>
                            <p>Started On </p>
                            <h4> 23-May-2012 </h4>                            
                        </div>                        
                    </div> 
                </div>
            </a>
            <a href="#">
                <div class="col-md-4 thumbnail courses">                    
                    <div class="pic-caption" >                        
                        <div style="margin-top:60%;color: white">
                            <i class="glyphicon glyphicon-book"></i><strong> Learn More</strong>
                        </div>                            
                    </div>                        
                    <div class="img-wrapper "style ='background-image:url(<?php echo $AI; ?>);'>
                    </div>                        
                    <div>   
                        <hr style="height:2px;background-color: gray"> 
                        <h3> <?php echo "Artificial Intellignece" ?></h3>
                        <div>
                            <p>Started On</p>
                            <h4> 23-May-2012 </h4>                            
                        </div>                        
                    </div> 
                </div>
            </a>
            <a href="#">
                <div class="col-md-4 thumbnail courses">
                    
                    <div class="pic-caption" >
                        
                        <div style="margin-top:60%;color: white">
                            <i class="glyphicon glyphicon-book"></i><strong> Learn More</strong>
                        </div>
                            
                    </div>
                        
                    <div class="img-wrapper" style ='background-image:url(<?php echo $WT; ?>);'>
                    </div>                        
                    <div>   
                        <hr style="height:2px;background-color: gray"> 
                        <h3> <?php echo "Web Technologies" ?></h3>
                        <div>
                            <p>Started On </p>
                            <h4> 23-May-2012 </h4>                            
                        </div>                        
                    </div> 
                </div>
            </a> 
                
            <a href="#">
                <div class="col-md-4 thumbnail courses">
                    
                    <div class="pic-caption" >
                        
                        <div style="margin-top:60%;color: white">
                            <i class="glyphicon glyphicon-book"></i><strong> Learn More</strong>
                        </div>
                            
                    </div>
                        
                    <div class="img-wrapper" style ='background-image:url(<?php echo $ES; ?>);'>
                    </div>                        
                    <div>   
                        <hr style="height:2px;background-color: gray"> 
                        <h3> <?php echo "Embedded Systems" ?></h3>
                        <div>
                            <p>Started On </p>
                            <h4> 23-May-2012 </h4>                            
                        </div>                        
                    </div> 
                </div>
            </a>
            <a href="#">
                <div class="col-md-4 thumbnail courses">                    
                    <div class="pic-caption" >                        
                        <div style="margin-top:60%;color: white">
                            <i class="glyphicon glyphicon-book"></i><strong> Learn More</strong>
                        </div>                            
                    </div>                        
                    <div class="img-wrapper" style ='background-image:url(<?php echo $CS; ?>);'>
                    </div>                        
                    <div>   
                        <hr style="height:2px;background-color: gray"> 
                        <h3> <?php echo "Control Systems" ?></h3>
                        <div>
                            <p>Started On </p>
                            <h4> 23-May-2012 </h4>                            
                        </div>                        
                    </div> 
                </div>
            </a>
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