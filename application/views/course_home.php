<!DOCTYPE html>
<!--
UniLog project.
UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
Copyright 2015 log inc.
-->

<?php
if (!isset($active_tab))
	$active_tab = 'home';
//$display_upload_form = true;
?>

<div class='col-md-9'>
	<div class="col-md-12" style="background-color: white;min-height: 600px;padding: 20px;border-radius:5px" >
		<div class="row">
			<div class="col-md-8">
				<h3><strong>
						<p>
							<?php echo $course_data->course_code . ' ' . $course_data->course_term . ' ' . $course_data->course_year . ' ' . ($course_data->course_type == 'th' ? 'Theory' : 'Practical'); ?>
						</p>
						<p>
							<?php echo $course_data->course_name; ?>
						</p>
					</strong></h3>
			</div>
		</div>
		<hr>
		<ul class='nav nav-tabs no-select' id='course-nav'>
			<?php
			$tabs = array('Home', 'Uploads', 'Course Info');
			$refs = array('home', 'uploads', 'info');
			for ($i = 0; $i < 3; $i++) {
				$html = '<li';
				if ($active_tab == $refs[$i])
					$html .= ' class="active"';
				$html .= '><a href="#' . $refs[$i] . '">' . $tabs[$i] . '</a></li>';
				echo $html;
			}
			?>

		</ul>

		<div class='tab-content'>
			<div id='home' class='tab-pane fade in <?php $v = (($active_tab == 'home') ? 'active' : '');
			echo $v ?>'>
				home
			</div>

			<div id='uploads' class='tab-pane fade in <?php $v = (($active_tab == 'uploads') ? 'active' : '');
			echo $v ?>'>
				<div class='row' style='margin-top: 10px'>
					<form id="upload-form" method="post" enctype="multipart/form-data" action="<?php echo base_url('user/course').'/'.$course_data->course_code.'/'.$course_data->course_term.'/'.$course_data->course_year.'/'.$course_data->course_type.'/upload'; ?>">
						<div class='col-md-3'>
							<button class='form-control btn btn-block btn-success' id="upload-file" type="button">Upload a file</button>
						</div>

						<div class='col-md-12' id="upload-panel" style="<?php if (!isset($display_upload_form)) echo 'display:none'; ?>">
							<div class='panel panel-default'>
								<div class='panel-body'>
									<div class='col-md-8 form-group'>
										<input class='form-control form-control-static' type='text' name="caption" placeholder="Caption" required="">
									</div>

									<div class='col-md-8 form-group'>
										<input class='form-control form-control-static' type='text' name="description" placeholder="Description" required="">
									</div>

									<div class='col-md-8 form-group'>
										<input class='form-control form-control-static' id="file-name" type='text' placeholder="Please select a file" readonly="">
									</div>

									<div class='col-md-2'>
										<button type="button" id="select-file" class="form-control btn btn-danger">Select File</button>
										<input type="file" id="input-file" name="upload_file" style="display:none" accept=".txt,.mp4,.pdf,.doc,.docx" required="">
									</div>

									<div class='col-md-2'>
										<button type="submit" id="upload-submit" class="form-control btn btn-danger">Upload</button>
									</div>

									<div class='col-md-12'>
										<div class="progress">
											<div class="progress-bar progress-bar-striped" id="upload-progress" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div id='info' class='tab-pane fade in <?php $v = (($active_tab == 'info') ? 'active' : '');
			echo $v ?>'>
				Course Info
			</div>
		</div>
	</div>
</div>

<script src="<?php echo script_uri('jquery.form.js'); ?>"></script>
<script>
	var options = {
		beforeSubmit : function() {
			$('#upload-progress').width('0%').addClass('active');
		},
		
		uploadProgress : function(event, position, total, percentComplete) {
			$('#upload-progress').width(percentComplete+'%');
			$('#upload-progress').html('<strong>' + percentComplete + '%</strong>');
		},
		
		success : function() {
		},
		
		complete : function(xhr) {
			$('#upload-progress').width('100%').removeClass('active');
			alert(xhr.responseText);
			if (xhr.responseText != '1')
				alert('Upload failed.');
		}
	};
	$('#upload-form').ajaxForm(options);
	
	$('#course-nav a').click(function () {
		$(this).tab('show');
		//return false;
	});

	$('#upload-file').click(function () {
		$('#upload-panel').slideToggle();
	});

	$('#select-file').click(function () {
		$('#input-file').click();
	});

	$('#input-file').change(function () {
		var file = this.files[0];
		var type = file.type;
		var match = ['application/pdf',
			'video/mp4',
			'text/plain',
			'application/vnd.ms-powerpoint',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
		];
		if (!((type == match[0]) || (type == match[1]) || (type == match[2]) || (type == match[3]) || (type == match[4]))) {
			$('#file-name').val(file.name + " can not be uploaded.");
			return false;
		}

		$('#file-name').val(file.name);
	});


</script>