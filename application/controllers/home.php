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

	private $user_data;
	
	public function index() {
		$this->wall();
	}

	/**
	 * Displays the user's wall.
	 */
	public function wall() {
		if ($this->load_page_head('Home')) {
			$this->load->view('templates/nav');
			$this->display_left_nav();
			$this->load->view('user_wall');
			$this->load->view('templates/page_foot');
		}
	}
	
	/**
	 * Displays the user's profile page.
	 * @return void
	 */
	public function profile() {
		if (!$this->load_page_head('Profile'))
			return;

		$this->load->view('templates/nav');
		$this->display_left_nav();
		$this->load->view('user_profile');
		$this->load->view('templates/page_foot');
	}

	
	public function notice_board() {
		if ($this->load_page_head('Home')) {
			$this->load->view('templates/nav');
			$this->load->view('templates/notice_board');
			$this->load->view('templates/page_foot');
		}
	}

	public function course() {
		if ($this->load_page_head('Home')) {
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
	 * Updates the user's summary field.
	 * @return void
	 */
	public function update_summary() {
		$this->load->model('user');
		if ($this->session->is_logged_in) {
			$user = $this->user->get_user_by_email($this->session->email);
			if (!$user) {
				return;
			}
			$this->user->update_summary();
		}
	}
	
	/**
	 * Checks if the user is logged on and returns his/her record from the db.
	 * 
	 * This method should be called first in all the public methods and they should exit
	 * if this methods returns null to prevent access to unlogged users.
	 * @param string $title	The title of the page in the browser tab.
	 * @return boolean.
	 */
	protected function load_page_head($title) {
		$this->load->model('user');
		$user = $this->user->get_user_by_email($this->session->email);
		if (!$user) {
			show_message("You must be logged in to access this page.", 'Access denied');
			return false;
		}

		$data['page_title'] = $title;
		$data['user_data'] = $user;
		$this->load->view('templates/page_head', $data);
		$this->user_data = $data['user_data'];
		
		return true;
	}

	/**
	 * Outputs the appropriate left nav widget for the logged in user.
	 */
	protected function display_left_nav() {
		if ($this->user_data->user_type == 'user_type_student') {
			$this->load->model('student');
			$courses['courses'] = $this->student->get_current_course_enrollments();
			$this->load->view('widgets/courses.php', $courses);
		} else
			$this->load->view('templates/left_nav.php');
	}

}
