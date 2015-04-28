<?php

/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
$notice = image_path('NoticeBoard.png');
$image = image_path('sticky.png');
?>

<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}
</script>

<div class="col-md-6" >
   
    <div class="jumbotron" style="background-color: white; min-height: 100px; padding: 20px;border-radius:5px" >
    <form class='form-group'>
        <b>Notice Board</b>          
        <hr style="height:2px;background-color: gray">
            
        <input type="text" name="post" >
        <button type="button" class="btn btn-primary">Submit</button>
        <button class="dropdown btn btn-primary" type="button">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle" style="color:white">
                Color <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Green</a></li>
                    <li><a href="#">Pink</a></li>
                    <li><a href="#">Blue</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Yellow</a></li>
                </ul>
        </button>
        <br>
    </form>
    
    </div>
    
    <img id="drag1" src="<?php echo $image; ?>" draggable="true"
         ondragstart="drag(event)" style="width:125px;height:125px" >
    
    <div class="col-md-12" id="div1" ondrop="drop(event)" ondragover="allowDrop(event)" style="background-color: white;
         background: url(<?php echo $notice; ?>) no-repeat 2px 2px; background-size: 100% 100%; min-height: 500px;padding: 20px;border-radius:5px" >
        
    </div>
    
    

</div>

