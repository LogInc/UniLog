<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Welcome
 * 
 * Home controller manages the user's home page, i.e. the wall.
 *
 */
class Home extends CI_Controller {

	public function index() {
		$this->wall();
	}

	public function wall() {
		$data = $this->load_page_head('Home');
		if ($data != null) {
			$this->load->view('templates/nav');
			
			if ($data->user_type == 'user_type_student') {
				$this->load->model('student');
				$courses['courses'] = $this->student->get_current_course_enrollments();
				$this->load->view('widgets/courses.php', $courses);
			}
			else
				$this->load->view('templates/left_nav.php');
			
			$this->load->view('user_wall');
			$this->load->view('templates/page_foot');
		}
	}

	public function notice_board() {
		if ($this->load_page_head('Notice Board')) {
			$this->load->view('templates/nav');
			$this->load->view('templates/notice_board');
			$this->load->view('templates/page_foot');
		}
	}

	public function course() {
		if ($this->load_page_head('Course')) {
			$this->load->view('templates/nav');
			$this->load->view('course_page.php');
			$this->load->view('templates/page_foot');
		}
	}

	/**
	 * Logs out the user from the website and returns to home page.
	 */
	public function log_out() {
		session_destroy();
		redirect('/');
	}

	/**
	 * Checks if the user is logged on and returns his/her record from the db.
	 * 
	 * This method should be called first in all the public methods and they should exit
	 * if this methods returns null to prevent access to unlogged users.
	 * @param string $title	The title of the page in the browser tab.
	 * @return object	associated array containing user record, null if user not logged in.
	 */
	protected function load_page_head($title) {
		$this->load->model('user');
		$user = $this->user->get_user_by_email($this->session->email);
		if (!$user) {
			show_message("You must be logged in to access this page.", 'Access denied');
			return null;
		}

		$data['page_title'] = $title;
		$data['user_data'] = $user;
		$this->load->view('templates/page_head', $data);
		return $data['user_data'];
	}

}
