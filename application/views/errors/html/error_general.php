<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

require  __DIR__ . '../../../templates/page_head.php';
require __DIR__ . '../../../templates/brand.php';

echo heading($heading, 2);
echo '<p class="text-info">';
echo $message;
echo ' <a href="' . base_url() . '">Go to Home</a>';
echo '</p>';

require __DIR__ . '../../../templates/page_foot.php';
?>