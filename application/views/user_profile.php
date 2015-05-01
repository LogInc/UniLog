<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

if ($user_data->user_photo == null || $user_data->user_photo == "")
	$profile_image_path = image_path('default_profile_200x.png');
else
	$profile_image_path = upload_path('profile_pics/' . $user_data->user_photo);

$profile_image = img($profile_image_path, FALSE, 'class="img-rounded" width="200" alt="unilog logo"');
?>



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
        <div class="col-md-8" style="font-size: 17px;padding:10px">  
            <h2><strong><?php echo $user_data->user_first_name . ' ' . $user_data->user_last_name ?></strong></h2>
            <h3><?php echo "Computer Engineering- University of Engineering and Technology" ?></h3>
            <h4><?php echo $user_data->user_email ?></h4>
        </div>
    </div>

    <div class="col-md-11" 
         style="background-color:white; min-height:261px; padding:20px; border-radius:5px; margin-top: 15px" >       
        <h3><strong>Summary</strong></h3>          
        <hr style="height:2px;background-color: gray">            
        <div class="col-md-12" id="summary-edit" style="font-size: 17px">
            <form role="form">
                <div class="form-group">
                    <label for="aims-form"></label>
                    <textarea class="form-control" id="aims-form" rows="8" placeholder="write something about you and your goals in life...">
<?php echo trim($user_data->user_summary); ?></textarea>
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
		
        <div  class="col-md-12" id="summary-display" style="font-size: 17px">
            <div class="caption">                    
                <p><a class="label label-default" id="#edit-label" rel="tooltip" title="Zoom">Edit</a>
                </p>
            </div>
            <p id="aims-paragraph"><?php echo trim($user_data->user_summary); ?></p>                
        </div>
    </div>


</div>

<script>
	$(document).ready(function () {
		var aims = $("#aims-form").val();
		if (aims.length !== 0) {
			$("#summary-edit").hide();
			$("#summary-display").show();
		} else {
			$("#summary-edit").show();
			$("#summary-display").hide();
		}
		
		$(".save-button").click(function () {
			var aims = $("#aims-form").val();
			document.getElementById("aims-paragraph").innerHTML = aims;
			$.post('<?php echo base_url(); ?>profile/update_summary', { summary: aims });

			if (aims.length !== 0) {
				$("#summary-edit").hide();
				$("#summary-display").fadeIn();
			}
		});
		$("#edit-label").click(function () {
			$("#summary-display").hide();
			$("#summary-edit").fadeIn();
		});
	});
	$('#summary-display').hover(
			function () {
				$(this).find('.caption').slideDown(250);
			},
			function () {
				$(this).find('.caption').slideUp(250);
			}

	);
</script>