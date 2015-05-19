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
	 * Uploads a file for the course. Creates records in the upload, post and course_post
	 * tables.
	 * This method echos '1' for success as it is called through AJAX and its output
	 * is not displayed directly in the browser.
	 */
	public function upload($code, $term, $year, $type) {
		if ($this->session->is_logged_in) {
			$user = $this->user_model->get_user_by_email($this->session->email);
			if (!$user) {
				echo '0';
				return;
			}

			$path = 'course_material/' . $code . '/' . $term . '/' . $year . '/' . $type;
			$full_path = upload_path($path);
			if (!file_exists($full_path))
				mkdir($full_path, 0777, true);

			$config['upload_path'] = $full_path;
			$config['allowed_types'] = 'mp4|pdf|doc|docx|ppt|pptx|txt';
			$config['max_size'] = '5120000';
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('upload_file')) {

				$id = $this->db->query('SELECT MAX(post_id) as "m" FROM post')->result()[0]->m;
				$id = ($id == null) ? 1 : $id + 1;
				$post_data = array('post_id' => $id,
					'post_type' => 'post_course_upload',
					'post_author' => $this->session->user_id
				);

				$course_post_data = array('post_id' => $id,
					'course_code' => $code,
					'course_term' => $term,
					'course_year' => $year,
					'course_type' => $type
				);

				$ext = $this->upload->data('file_ext');
				switch ($ext) {
					case '.jpg':
						$ext = 'upload_image';
						break;
					case '.mp4':
						$ext = 'upload_video';
						break;
					case '.pdf':
						$ext = 'upload_doc';
						break;
					case '.txt':
						$ext = 'upload_doc';
						break;
					case '.doc':
						$ext = 'upload_doc';
						break;
					case '.docx':
						$ext = 'upload_doc';
						break;
				}
				$upload_data = array('post_id' => $id,
					'upload_type' => $ext,
					'upload_caption' => clean_input($this->input->post('caption')),
					'upload_description' => clean_input($this->input->post('description')),
					'upload_file' => $path . '/' . $this->upload->data('file_name')
				);

				$this->db->insert('post', $post_data);
				$this->db->insert('course_post', $course_post_data);
				$this->db->insert('upload', $upload_data);
				echo '1';
			} else
				echo '0';
		} else
			echo '0';
	}

	/**
	 * Inserts a post in to the database.
	 * @return type
	 */
	public function post() {
		if (!$this->session->is_logged_in || !is_string($this->session->course_code)) {
			echo '0';
			return;
		}

		$id = $this->db->query('SELECT MAX(post_id) as "m" FROM post')->result()[0]->m;
		$id = ($id == null) ? 1 : $id + 1;
		$post_data = array('post_id' => $id,
			'post_type' => 'post_course_discussion',
			'post_author' => $this->session->user_id,
			'post_title' => clean_input($this->input->post('title')),
			'post_text' => clean_input($this->input->post('text'))
		);

		$course_post_data = array('post_id' => $id,
			'course_code' => $this->session->course_code,
			'course_term' => $this->session->course_term,
			'course_year' => $this->session->course_year,
			'course_type' => $this->session->course_type
		);

		$this->db->insert('post', $post_data);
		$this->db->insert('course_post', $course_post_data);

		echo '1';
	}

	public function get_posts($limit = 10, $offset = 0) {
		if (!$this->session->is_logged_in || !is_string($this->session->course_code)) {
			echo '0';
			return;
		}

		$where = array('course_code' => $this->session->course_code,
			'course_term' => $this->session->course_term,
			'course_year' => $this->session->course_year,
			'course_type' => $this->session->course_type,
		);

		$this->db->select('user_first_name, user_last_name, post.*');
		$this->db->from('course_post');
		$this->db->join('post', 'post.post_id = course_post.post_id');
		$this->db->join('user', 'user.user_id = post.post_author');
		$this->db->where($where);
		$this->db->order_by('post_timestamp', 'DESC');
		$this->db->limit($limit, $offset);

		$query = $this->db->get();
		if ($query && $query->num_rows() > 0) {
			$result = $query->result();
			foreach ($result as $row) {
				$data['post'] = $row;
				$this->load->view('templates/post', $data);
			}
		} else
			return;
	}

	public function get_all_courses_posts($limit = 10, $offset = 0) {
		if (!$this->session->is_logged_in) {
			echo '0';
			return;
		}

		$this->db->select('user_first_name, user_last_name, post.*');
		$this->db->from('course_post');
		$this->db->join('post', 'post.post_id = course_post.post_id');
		$this->db->join('user', 'user.user_id = post.post_author');
		$this->db->order_by('post_timestamp', 'DESC');
		$this->db->limit($limit, $offset);

		$query = $this->db->get();
		if ($query && $query->num_rows() > 0) {
			$result = $query->result();
			foreach ($result as $row) {
				$data['post'] = $row;
				$this->load->view('templates/post', $data);
			}
		} else
			return;
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
		$code = clean_input($code);
		$term = clean_input($term);
		$year = clean_input($year);
		$type = clean_input($type);
		$data['course_data'] = $this->course_model->get_course($code, $term, $year, $type);
		if (!$data['course_data']) {
			show_error('Course not found.');
			return;
		}

		$this->session->course_code = $code;
		$this->session->course_term = $term;
		$this->session->course_year = $year;
		$this->session->course_type = $type;

		$data['doc'] = $this->course_model->get_uploads('upload_doc');
		$data['video'] = $this->course_model->get_uploads('upload_video');

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
