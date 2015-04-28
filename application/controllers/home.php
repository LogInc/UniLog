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
		$this->wall();
	}

	public function wall() {
		$this->load_page_head('Home');
		$this->load->view('templates/nav');
		$this->load->view('templates/left_nav');
		$this->load->view('user_wall');
		$this->load->view('templates/page_foot');
	}

	public function notice_board() {
		$this->load_page_head('Notice Board');
		$this->load->view('templates/nav');
		$this->load->view('templates/notice_board');
		$this->load->view('templates/page_foot');
	}

	public function profile() {
		$this->load_page_head('Profile');
		$this->load->view('templates/nav');
		$this->load->view('templates/left_nav');
		$this->load->view('user_profile');
		$this->load->view('templates/page_foot');
	}

	public function course() {
		$this->load_page_head('Course');
		$this->load->view('templates/nav');
		$this->load->view('course_page.php');
		$this->load->view('templates/page_foot');
	}

	protected function load_page_head($title) {
		$this->load->model('user');
		$user = $this->user->get_user_by_email($this->session->email);
		if (!$user) {
			show_message("Access denied!", 'Hey!');
			return;
		}
		
		$data['page_title'] = $title;
		$data['user_data'] = $user;
		$this->load->view('templates/page_head', $data);
	}

}
