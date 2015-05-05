<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

$notice = image_uri('NoticeBoard.png');
$sticky_blue = image_uri('sticky-blue.png');
$sticky_pink = image_uri('sticky-pink.png');
$sticky_yellow = image_uri('sticky-yellow.png');
$sticky_green = image_uri('sticky-green.png');
?>

<script>
    function showInput() {
        var message_entered = document.getElementById("user_input").value;

        document.getElementById('drag1').innerHTML = message_entered;
    }
    function changeColor()
    {
        var e = document.getElementById("color_id");
        var strUser = e.options[e.selectedIndex].text;
        document.getElementById('drag1').innerHTML = strUser;
        if (strUser === "blue")
        {
            
            document.getElementById('drag1').body.style.backgroundImage = 'url(<?php echo $sticky_blue; ?>)';
        }
        if (strUser ===  "yellow")
        {
            document.getElementById('drag1').innerHTML = "i should change";
            document.getElementById('drag1').body.style.backgroundImage = 'url(<?php echo $sticky_yellow; ?>)';
        }
    }
    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("text", ev.target.id);
    }

    function drop(ev) {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        /* If you use DOM manipulation functions, their default behaviour it not to 
         copy but to alter and move elements. By appending a ".cloneNode(true)", 
         you will not move the original element, but create a copy. */
        var nodeCopy = document.getElementById(data).cloneNode(true);
        nodeCopy.id = "newId"; /* We cannot use the same ID */
        ev.target.appendChild(nodeCopy);
    }
</script>

<div class="col-md-12" >

    <div class="jumbotron" style="background-color: white; min-height: 100px; padding: 20px;border-radius:5px" >

        <b>Notice Board</b>          
        <hr style="height:2px;background-color: gray">
        <form class='form-group' >
            <div class="row">
                <div class="col-md-4">                
                    <input class="form-control" type="text" name="post" id="user_input" placeholder="write your notice here..." >
                </div>
                <div class="col-md-4">                  
                    <button type="button"  onclick="showInput();"class="btn btn-primary">Submit</button>
                    <form action="">
                    <select id="color_id" name="patient[color_id]" onchange="changeColor()">
                        <option selected="selected" value="blue">blue</option>
                        <option value="yellow">yellow</option>
                        <option value="3">green</option>
                        <option value="4">red</option>
                    </select>
                    </form>
                    
                </div>          
            </div>
        </form>

    </div>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>

    <div class="col-md-2"id="drag1" draggable="true"
         ondragstart="drag(event)" style="width:200px;height:225px; padding-left: 25px; padding-bottom: 5px; padding-top: 18px; padding-right: 10px;
         background-image: url(<?php echo $sticky_blue; ?>) no-repeat 2px 2px; background-size: 100% 100%; ">
        <p>
            asad
        </p>
    </div>


    <div class="col-md-12" id="div1" ondrop="drop(event)" ondragover="allowDrop(event)" style="background-color: white;
         background: url(<?php echo $notice; ?>); no-repeat 2px 2px;
         background-size: 100% 100%; min-height: 700px;padding-left: 70px; padding-top:60px;
         border-radius:5px" >
    </div>



</div>

