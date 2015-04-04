<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

require 'templates/page_head.php';
require 'templates/brand.php';

if (isset($heading))
	echo heading($heading, 2);
else
	echo heading('Message', 2);

echo '<p class="text-info">';
echo $message;
echo '<p><a href="' . base_url() . '">Go to Home</a></p>';
echo '</p>';

require 'templates/page_foot.php';
?>