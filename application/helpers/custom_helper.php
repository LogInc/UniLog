<?php

/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

function upload_uri($file) {
	return base_url() . 'uploads/' . $file;
}

function image_uri($file) {
	return base_url() . 'images/' . $file;
}

function style_uri($file) {
	return base_url() . 'css/' . $file;
}

function script_uri($file) {
	return base_url() . 'js/' . $file;
}

function upload_path($file) {
	return './uploads/' . $file;
}

function show_message($message, $heading, $title='Message') {
	$data = array(
		'page_title'	=> $title,
		'message'		=> $message,
		'heading'		=> $heading,
		'white'			=> 1
			);
	
	get_instance()->load->view('message', $data);
}

function clean_input($input) {
	return xss_clean(html_escape($input));
}