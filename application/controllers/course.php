<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

/**
 * Description of course
 *
 * Course controller manages viewing, addition/deletion of courses from all points of
 * view including the general view of all courses present on site, courses in which a
 * student is enrolled and courses which are managed by a particular instructor.
 */
class Course extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('course_model');
	}

	public function index() {
		$this->all();
	}

	/**
	 * Displays a page containing tiles of all the courses hosted on the site.
	 * @param type $whose. The user whose courses to display. 0 means display irrespective of user.
	 */
	public function all($whose = '0') {
		if ($this->load_page_head("All Courses")) {
			$this->load->view('templates/nav');
			$this->current_courses_tiles($whose);
			$this->archived_courses_tiles($whose);
			$this->load->view('templates/page_foot');
		}
	}

	/**
	 * Displays a page containing tiles of all the current courses hosted on the site.
	 * @param type $whose. The user whose courses to display. 0 means display irrespective of user.
	 */
	public function current($whose = 0) {
		if ($this->load_page_head("Current Courses")) {
			$this->load->view('templates/nav');
			$this->current_courses_tiles($whose);
			$this->load->view('templates/page_foot');
		}
	}

	/**
	 * Displays a page containing tiles of all the archived courses hosted on the site.
	 * @param type $whose. The user whose courses to display. 0 means display irrespective of user.
	 */
	public function archived($whose = 0) {
		if ($this->load_page_head("Archived Courses")) {
			$this->load->view('templates/nav');
			$this->archived_courses_tiles($whose);
			$this->load->view('templates/page_foot');
		}
	}

	public function course_description($code, $term, $year, $type) {
		if ($this->load_page_head($code)) {
			$data['course_data']= $this->course_model->get_course($code, $term, $year, $type);
			$this->load->view('templates/nav');
			$this->load->view('course_page', $data);
			$this->load->view('templates/page_foot');
		}
	}

	public function my_course($code, $term, $year, $type) {
		if ($this->load_page_head($code)) {
			$data['course_data'] = $this->course_model->get_course($code, $term, $year, $type);
			//var_dump($data['course']);
			$this->load->view('templates/nav');
			//$this->load->view('course_page', $data);
			$this->load->view('templates/page_foot');
		}
	}

	/**
	 * Displays the tiles of all the current courses hosted on the site.
	 * @param type $whose. The user whose courses to display. 0 means display irrespective of user.
	 */
	protected function current_courses_tiles($whose) {
		$data['courses'] = $this->course_model->get_current_courses($whose);
		$data['title'] = 'Current Courses';
		$data['show_date'] = 'started';
		$this->load->view('templates/course_tiles', $data);
	}

	/**
	 * Displays the tiles of all the archived courses hosted on the site.
	 * @param type $whose. The user whose courses to display. 0 means display irrespective of user.
	 */
	protected function archived_courses_tiles($whose) {
		$data['courses'] = $this->course_model->get_archived_courses($whose);
		$data['title'] = 'Archived Courses';
		$data['show_date'] = 'ended';
		$this->load->view('templates/course_tiles', $data);
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
		$this->load->model('user_model');
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

}
