<!DOCTYPE html>
<!--
UniLog project.
UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
Copyright 2015 log inc.
-->

<div class="row" style="margin-top:20px">
	<div class="col-md-10 col-md-offset-1" style="background-color:#eee; padding:20px">
		<?php
		$diff = date_diff(new DateTime(), new DateTime($post->post_timestamp));
		if ($diff->y)
			$time = $diff->y . ' years';
		else if ($diff->m)
			$time = $diff->m . ' months';
		else if ($diff->d)
			$time = $diff->d . 'd';
		else if ($diff->h)
			$time = $diff->h . 'h';
		else if ($diff->i)
			$time = $diff->i . 'm';
		else
			$time = $diff->s . 's';

		if ($post->post_type == 'post_course_upload') {
			$upload = $this->course_model->get_upload_by_post_id($post->post_id);
			if ($row = $upload[0]) {
				$url = upload_uri($row->upload_file);
				echo "<h4 style = 'display:inline'><a href = '$url'><strong>$row->upload_caption</strong></a> uploaded by $post->user_first_name $post->user_last_name</h4>";
				echo '<h4 style="display:inline;float:right">' . $time . '</h4>';
				echo "<p>$row->upload_description</p>";
			}
		} else {
			echo '<h3 style="display:inline">' . $post->post_title . '</h3> ';
			echo '<h4 style="display:inline;float:right">' . $time . '</h4>';
			echo '<h5>' . $post->user_first_name . ' ' . $post->user_last_name . '</h5>';
			echo '<p>' . $post->post_text . '</p>';
		}
		?>
	</div>
</div>