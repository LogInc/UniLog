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

	public function __construct() {
		parent::__construct();
	}

	/**
	 * The index page of the website.
	 */
	public function index() {
		if ($this->session->is_logged_in) {
			redirect('home');
		} else redirect('sign-in');
	}

	/**
	 * Displays the sign-in/up page. $signup flags dictates which form to show.
	 * @param int $signup 0 displays the sign-in form, 1 outputs sign-up.
	 */
	public function sign($signup = 0) {
		$this->load->helper('form');

		$data['page_title'] = $signup ? 'Sign Up' : 'Sign In';
		$data['signup'] = $signup;
		$this->load->view('templates/page_head', $data);
		$this->load->view('templates/brand');
		$this->load->view('sign', $data);
		$this->load->view('templates/page_foot');
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
		// Input valid?
		if ($this->validate_signup_fields()) {
			$data['page_title'] = 'Sign Up';
			$this->load->model('user');

			// Generate a unique key for the user.
			$key = password_hash(uniqid($this->input->post('email'), false), PASSWORD_BCRYPT);

			// Attempt to add the key to the temp_user table.
			if ($this->user->add_temp_user($key)) {				
				if ($this->send_mail($key))
					show_message('An email has been sent to you.', 'Thank You!');
				else
					show_message('Unable to send email. Please try again.', 'Email not sent');
			} else {
				// Unknown error here.
				$error = $this->db->error();
				show_message('An error has occured', '(' . $error['code'] . ') ' . $error['message']);
			}
			$data['page_title'] = 'Sign Up';
			$data['key'] = $key;
			$data['name'] = 'ab';
			$this->load->view('templates/signup_mail');
		} else {
			// Keep us on sign-up page in case the user input is invalid.
			$this->sign(1);
		}
	}

	/**
	 * Validates the fields in the signup form.
	 * @return boolean
	 */
	public function validate_signup_fields() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.user_email]|trim');
		$this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
		$this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
		$this->form_validation->set_rules('rollno', 'Roll No.', 'is_unique[user.user_rollno]|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');
		return $this->form_validation->run();
	}

	/**
	 * Registers a user in our database.
	 * 
	 * This method is called by the link that is sent in the email to the user.
	 * The link contains the key that was generated for the user and stored in the
	 * temp_user table.
	 */
	public function register_user() {
		$key = $_GET['id'];
		
		$this->load->model('user');

		if ($this->user->valid_key($key)) {
			if ($this->user->add_user($key)) {
				show_message('Congratulations! You are now a part of UniLog!', 'Success');
				//redirect('home');
			}
		} else show_message('Invalid key', 'Error');
	}

	/**
	 * Sends a mail to the user who just signed-up.
	 * 
	 * The mail contains the link to complete the registration process.
	 * @param string $key	the generated key for the user.
	 * @return boolean		true if the mail was sent successfully.
	 */
	private function send_mail($key) {
		$this->load->library('email', array('mailtype' => 'html'));
		
		$this->email->to($this->input->post('email'));
		$this->email->from('', 'Admin');

		// Setup the email message.
		$data['page_title'] = 'Sign Up';
		$data['key'] = $key;
		$data['name'] = $this->input->post('firstname');
		
		// Load the mail page as the message. The mail page is a dynamic page.
		// The TRUE argument returns the PHP output as a string instead of sending it
		// to the client.
		$message = $this->load->view('templates/signup_mail.php', $data, TRUE);
		$this->email->message($message);
		
		return $this->email->send();
	}
	
	/**
	 * Displays the terms of service page.
	 */
	public function terms_of_service() {
		$this->load->view('templates/page_head');
		$this->load->view('templates/brand');
		$this->load->view('terms_of_service');
		$this->load->view('templates/page_foot');
	}

}