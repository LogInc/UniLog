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

	public function add() {
		if ($this->session->user_type != 'user_type_instructor') {
			show_message('Only an instructor can add a course.', 'Sorry!');
			return;
		}
		$course = $this->course_model->add_course();
		if ($course)
			redirect('user/course/' . $course['course_code'] . '/' . $course['course_term'] . '/' . $course['course_year'] . '/' . $course['course_type']);
		else
			show_message('Unable to add course.', 'Sorry!');
	}

	/**
	 * Enrolls a student user in the specified course.
	 * @param type $code
	 * @param type $term
	 * @param type $year
	 * @param type $type
	 * @return void
	 */
	public function enroll($code, $term, $year, $type) {
		$course = $this->course_model->get_course($code, $term, $year, $type);
		if ($course == null) {
			show_error("Course not found.");
			return;
		}

		if ($this->session->user_type != 'user_type_student') {
			show_message("Only students can enroll in a course.", "Ooops!");
			return;
		}

		$this->load->model('student_model');

		if ($this->student_model->is_enrolled_in_course($code, $term, $year, $type)) {
			show_message("You are already enrolled in this course.", "Ooops!");
			return;
		}

		$enrolled = $this->student_model->enroll_in_course($code, $term, $year, $type);
		if ($enrolled)
			redirect("user/course/$code/$term/$year/$type");
		else
			show_error("Unable to enroll in course.");
	}

	/**
	 * Uploads a file for the course.
	 */
	public function upload($code, $term, $year, $type) {
		$this->load->model('user_model');
		if ($this->session->is_logged_in) {
			$user = $this->user_model->get_user_by_email($this->session->email);
			if (!$user) {
				return;
			}

			$path = upload_path('course_material/' . $code . '/' . $term . '/' . $year . '/' . $type);
			if (!file_exists($path))
				mkdir($path, 0777, true);

			$config['upload_path'] = $path;
			$config['allowed_types'] = 'mp4|pdf|doc|docx|ppt|pptx|txt';
			$config['max_size'] = '5120000';
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('upload_file')) {
				echo '1';
			}
			else
				echo '0';
		}
	}

	/**
	 * Displays a page containing tiles of all the courses hosted on the site.
	 * @param type $whose. The user whose courses to display. 0 means display irrespective of user.
	 * A special case is 'home', this displays the tiles of the current signed in user
	 * and clicking the tiles direct the user to the course's home page. 	
	 */
	public function all($whose = '0') {
		if ($this->load_page_head($whose == 'home' ? 'My Courses' : "All Courses")) {
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

	/**
	 * Displays the introduction page of a course. This page gives a description of the
	 * course and an enroll button which a student user can click to enroll in that
	 * particular course.
	 * Access to this method is re-routed as follows:
	 * /course/code/term/year/type
	 * @param type $code	Course code
	 * @param type $term	Course term	(fall / spring)
	 * @param type $year	Course year
	 * @param type $type	Course type (th / pr)
	 */
	public function course_description($code, $term, $year, $type) {
		if ($this->load_page_head($code)) {
			$data['course_data'] = $this->course_model->get_course($code, $term, $year, $type);
			if ($this->session->user_type == 'user_type_student') {
				$this->load->model('student_model');
				if (!$this->student_model->is_enrolled_in_course($code, $term, $year, $type))
					$data['enroll_button'] = true;
			}
			$this->load->view('templates/nav');
			$this->load->view('course_page', $data);
			$this->load->view('templates/page_foot');
		}
	}

	/**
	 * Displays the course home page. This page is different for student and instructor
	 * user types.
	 * Access to this method is re-routed as follows:
	 * /user/course/code/term/year/type
	 * @param type $code
	 * @param type $term
	 * @param type $year
	 * @param type $type
	 */
	public function course_home($code, $term, $year, $type) {
		$data['course_data'] = $this->course_model->get_course($code, $term, $year, $type);
		if (!$data['course_data']) {
			show_error('Course not found.');
			return;
		}

		$this->session->course_code = $code;
		$this->session->course_term = $term;
		$this->session->course_year = $year;
		$this->session->course_type = $type;

		if ($this->load_page_head($code)) {
			$this->load->view('templates/nav');
			$this->display_left_nav();

			if ($this->session->user_type == 'user_type_instructor') {
				
			}
			$this->load->view('course_home', $data);

			$this->load->view('templates/page_foot');
		}
	}

	/**
	 * Displays the tiles of all the current courses hosted on the site.
	 * @param type $whose. The user whose courses to display. 0 means display irrespective of user.
	 * A special case is 'home', this displays the tiles of the current signed in user
	 * and clicking the tiles direct the user to the course's home page. 					
	 */
	protected function current_courses_tiles($whose) {
		if ($whose == 'home') {
			$data['course_home'] = 1;
			$whose = $this->session->user_id;
		}

		if ($this->session->user_type == 'user_type_instructor') {
			$this->load->model('instructor_model');
			$data['courses'] = $this->instructor_model->get_courses($whose, 'current');
		} else
			$data['courses'] = $this->course_model->get_current_courses($whose);

		$data['title'] = 'Current Courses';
		$data['show_date'] = 'started';
		$this->load->view('templates/course_tiles', $data);
	}

	/**
	 * Displays the tiles of all the archived courses hosted on the site.
	 * @param type $whose. The user whose courses to display. 0 means display irrespective of user.
	 * A special case is 'home', this displays the tiles of the current signed in user
	 * and clicking the tiles direct the user to the course's home page. 	
	 */
	protected function archived_courses_tiles($whose) {
		if ($whose == 'home') {
			$data['course_home'] = 1;
			$whose = $this->session->user_id;
		}
		if ($this->session->user_type == 'user_type_instructor') {
			$this->load->model('instructor_model');
			$data['courses'] = $this->instructor_model->get_courses($whose, 'archived');
		} else
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

	/**
	 * Outputs the appropriate left nav widget for the logged in user.
	 */
	protected function display_left_nav() {
		if ($this->user_data->user_type == 'user_type_student') {
			$this->load->model('student_model');
			$data['courses'] = $this->student_model->get_current_course_enrollments();
		} else if ($this->user_data->user_type == 'user_type_instructor') {
			$this->load->model('instructor_model');
			$data['courses'] = $this->instructor_model->get_courses(0, 'current');
		}
		$this->load->view('widgets/courses', $data);
	}

}
