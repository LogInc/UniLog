<?php
    
/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

?>
    

    <div class="row">
        <div class="col-md-12">
            Welcome to <b style="color:#4472c4" >UniLog</b>, we hope you enjoy the experience.
        </div>
    </div>
        
    <div class="row">
        <div class="col-md-6 ">
            <img class="img-responsive" style="margin-top: 10%" src="<?php echo image_path('schoolbag.png') ?>" alt="bag sketch" >
        </div>
            
	<?php
	if ($signup) {
		require_once 'forms/sign_up.php';
	} else {
		require_once 'forms/sign_in.php';
	}
	?>
    </div>
