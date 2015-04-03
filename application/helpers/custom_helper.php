<?php

/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

function imagePath($file) {
	return base_url() . 'images/' . $file;
}

function stylePath($file) {
	return base_url() . 'css/' . $file;
}

function scriptPath($file) {
	return base_url() . 'js/' . $file;
}