<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of home
 *
 */
class Home extends CI_Controller {
	
	public function index() {
		$this->load->view('home_page');
	}
}