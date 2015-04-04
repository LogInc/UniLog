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
 * This controller also handles user sign-up.
 */
class Welcome extends CI_Controller {

	/**
	 * The index page of the website.
	 */
	public function index() {
		if ($this->session->is_logged_in) {
			redirect('home');
		}
		$this->sign(0);
	}

	/**
	 * Displays the sign-in/up page. $signup flags dictates which form to show.
	 * @param int $signup 0 displays the sign-in form, 1 outputs sign-up.
	 */
	public function sign($signup = 0) {
		$this->load->helper('form');

		$data['page_title'] = $signup ? 'Sign Up' : 'Sign In';
		$data['signup'] = $signup;
		$this->load->view('page_head', $data);
		$this->load->view('brand');
		$this->load->view('sign', $data);
		$this->load->view('page_foot');
	}

	public function sign_in() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run()) {
			$this->sign();
		} else {
			$this->sign();
		}
	}

	/**
	 * Prepares a user to sign-up for the website. The process is completed by the
	 * register_user method which is called from the link in the email sent to the user.
	 * 
	 * This method is called by the sign-up button in the sign-up form.
	 * 
	 * Perform the sign-up operation which includes the following steps:
	 * 
	 * 	1- Validate user input.
	 * 
	 * 	2- Generate a unique key for the signee and store it in temp_user table.
	 * 
	 * 	3- Send an email to the user to complete the registration process.
	 * 
	 * 	4- Report any errors back to the user.
	 */
	public function sign_up() {
		// Validate the user input.
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|is_unique[user.user_email]');
		$this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
		$this->form_validation->set_rules('rollno', 'Roll No.', 'trim|is_unique[user.user_rollno]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		// Input valid?
		if ($this->form_validation->run()) {
			$this->load->model('user');

			// Generate a unique key for the user.
			$key = password_hash(uniqid($this->input->post('email'), true), PASSWORD_BCRYPT);
			$data['page_title'] = 'Sign Up';

			// Attempt to add the key to the temp_user table.
			// Success?
			if ($this->user->add_temp_user($key)) {
				// Send a mail to the user.
				$this->sendMail($key);
				$data['message'] = 'An email has been sent to you.';
			} else {
				
				$error = $this->db->error();
				
				if ($error['code'] == 1062) {
					$this->sendMail($key);
					$data['message'] = 'An email has been sent to you.';
				} else {
					$data['message'] = 'An error has occured. (' . $error['code'] . ') ' . $error['message'];
				}
			}
			$this->load->view('error', $data);
		} else {
			$this->sign(1);
		}
	}

	private function sendMail($key) {
		$this->load->library('email', array('mailtype' => 'html'));
		$this->email->to($this->input->post('email'));
		$this->email->from('', 'Admin');
	}

}
