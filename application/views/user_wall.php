<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
date_default_timezone_set("Asia/Karachi");
$time = date("h:i:sa");
?>

<div class="col-md-9">
	<?php
	foreach ($courses as $c) {
		$term = ucfirst($c->course_term);
		$type = ($c->course_type == 'th') ? 'Theory' : 'Practical';
		$html = <<<END
					<div class="col-md-12" style="background-color:white; padding:20px; margin-bottom:20px">
					<h3>$c->course_code $type $c->course_year $type</h3><h3>$c->course_name</h3>
END;
		echo $html;


		$code = $c->course_code;
		$t = $c->course_term;
		$y = $c->course_year;
		$type = $c->course_type;
		$result = $this->course_model->get_course_posts($code, $t, $y, $type, 20);
		if ($result)
			foreach ($result as $post)
				include 'templates/post.php';

		$html = <<<END
					<hr>
					</div>
END;
		echo $html;
	}
	?>
</div>

<script>
	$('#data').load("<?php echo base_url('course/get_all_courses_posts'); ?>" + '/' + 20);
</script>