<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

require_once 'page_head.php';
require_once 'brand.php';

echo '<p class="text-info">';
echo $message;
echo '<a href="' . base_url() . '">Go to Home</a>';
echo '</p>';

require_once 'page_foot.php';
?>