<?php

/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

function upload_path($file) {
	return base_url() . 'uploads/' . $file;
}

function image_path($file) {
	return base_url() . 'images/' . $file;
}

function style_path($file) {
	return base_url() . 'css/' . $file;
}

function script_path($file) {
	return base_url() . 'js/' . $file;
}

function show_message($message, $heading, $title='Message') {
	$data = array(
		'page_title'	=> $title,
		'message'		=> $message,
		'heading'		=> $heading
			);
	
	get_instance()->load->view('message', $data);
}

function clean_input($input) {
	return xss_clean(html_escape($input));
}