<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Profile controller manages the user profile page.
 *
 */
class Profile extends CI_Controller {

	public function index() {
		$this->profile_page();
	}

	/**
	 * Displays the user's profile page.
	 * @return void
	 */
	public function profile_page() {
		if (!$this->load_page_head('Profile'))
			return;

		$this->load->view('templates/nav');
		$this->load->view('templates/left_nav');
		$this->load->view('user_profile');
		$this->load->view('templates/page_foot');
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
	 * Loads the head of the page.
	 * @param type $title Title of the page to set.
	 * @return boolean true if successful.
	 */
	protected function load_page_head($title) {
		$this->load->model('user');
		$user = $this->user->get_user_by_email($this->session->email);
		if (!$user) {
			show_message("Access denied!", 'Hey!');
			return false;
		}

		$data['page_title'] = $title;
		$data['user_data'] = $user;
		$this->load->view('templates/page_head', $data);
		return true;
	}

}
