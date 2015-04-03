<?php

/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Welcome
 * This controller class is the starting point of the website. The controller checks if
 * a user is already logged on. If that is the case, then the site is redirected to the
 * home controller. Otherwise the sign-in page is displayed.
 */
class Welcome extends CI_Controller {
	
	public function index() {
		if ($this->session->is_logged_in) {
			redirect('home');
		}
		$this->sign(0);
	}
	
	public function sign($signup = 0) {
		$this->load->helper('form');
		
		$data['page_title'] = $signup ? 'Sign Up' : 'Sign In';
		$this->load->view('page_head', $data);
		$this->load->view('brand');
		$this->load->view($signup ? 'sign_up' : 'sign_in', $data);
		$this->load->view('page_foot');
	}
	
	public function signin() {
	}
}