<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of User
 * 
 * User controller manages the user specific pages, e.g. the wall, profile, etc.
 *
 */
class User extends CI_Controller {

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

			$this->load->view('templates/add_course');
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
		$this->load->view('templates/add_course');
		$this->load->view('templates/page_foot');
	}

	public function notice_board() {
		if ($this->load_page_head('NB')) {
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

	public function course_doc() {
		if ($this->load_page_head('Course_doc')) {
			$this->load->view('templates/nav');
			$this->load->view('course_doc.php');
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
		$this->load->model('user_model');
		if ($this->session->is_logged_in) {
			$user = $this->user_model->get_user_by_email($this->session->email);
			if (!$user) {
				return;
			}
			$this->user_model->update_summary();
		}
	}

	public function update_photo() {
		$this->load->model('user_model');
		if ($this->session->is_logged_in) {
			$user = $this->user_model->get_user_by_email($this->session->email);
			if (!$user) {
				return;
			}

			$config['upload_path'] = './uploads/profile_pics/';
			$config['allowed_types'] = 'gif|jpg|png|mp4|pdf|doc|docx|ppt|pptx|';
			$config['max_size'] = '512000';
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('photo')) {
				$user = $this->user_model->get_user_by_id($this->session->user_id);

				$old = './uploads/profile_pics/' . $user->user_photo;
				if (file_exists($old))
					unlink('./uploads/profile_pics/' . $user->user_photo);

				$this->user_model->update_photo($this->upload->data('file_name'));
			}
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
		$user = $this->user_model->get_user_by_email($this->session->email);
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
	 * Outputs the courses left nav widget for the logged in user.
	 */
	protected function display_left_nav() {
		if ($this->user_data->user_type == 'user_type_student') {
			$this->load->model('student_model');
			$data['courses'] = $this->student_model->get_current_course_enrollments();
		} else {
			$this->load->model('instructor_model');
			$data['courses'] = $this->instructor_model->get_courses('current');
		}
		$this->load->view('widgets/courses', $data);
	}

}