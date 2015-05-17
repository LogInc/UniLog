<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

/**
 * Description of course_model
 * 
 * The course model handles all the course related information, including adding/removing
 * courses, and acquiring students/instructors/posts associated with a course.
 */
class course_model extends CI_Model {

	/**
	 * Adds a course in the database.
	 * @return object array if course added, null otherwise
	 */
	public function add_course() {
		$course_code = clean_input($this->input->post('course_code'));
		$course_title = clean_input($this->input->post('course_title'));
		$course_term = clean_input($this->input->post('course_term'));
		$course_year = date('Y');
		$course_type = clean_input($this->input->post('course_type'));
		$course_desc = clean_input($this->input->post('course_description'));
		
		$data = array(	'course_code'			=> $course_code,
						'course_term'			=> $course_term,
						'course_year'			=> $course_year,
						'course_type'			=> $course_type,
						'course_name'			=> $course_title,
						'course_intro'			=> $course_desc,
						'course_start_date'		=> date('Y-m-d'),
						'course_instructor'		=> $this->session->user_id
						);
		
		if ($this->db->insert('course', $data))
			return $data;
		else
			return null;
	}

	/**
	 * Retrieves a course from the db.
	 * @param string $code
	 * @param string $term
	 * @param string $year
	 * @param string $type
	 * @return object	course if found, null otherwise.
	 */
	public function get_course($code, $term, $year, $type) {
		$data = array('course_code' => $code,
			'course_term' => $term,
			'course_year' => $year,
			'course_type' => $type
		);
		$query = $this->db->get_where('course', $data);
		if (!$query || $query->num_rows() != 1)
			return null;
		else
			return $query->row();
	}

	/**
	 * Retrieves the current courses i.e. courses which are currently being carried out.
	 * @param type $user_id Optional user id. If non-zero retrieves courses of the specified user.
	 * @param type $limit. Optional limit on the number of records to retrieve.
	 * @param type $offset. Optional offset on the starting record to retrieve.
	 * @return array of objects containing all the fields.
	 */
	public function get_current_courses($user_id = 0, $limit = null, $offset = null) {
		$this->db->select('*');

		if ($user_id) {
			$this->make_student_course_query($user_id);
		} else
			$this->db->from('course');

		$this->db->join('instructor', 'instructor.user_id = course.course_instructor');
		$this->db->join('user', 'user.user_id = instructor.user_id');

		$this->db->where('course_end_date', null);

		if ($limit)
			if ($offset)
				$this->db->limit($limit, $offset);
			else
				$this->db->limit($limit);

		$query = $this->db->get();
		if (!$query || $query->num_rows() == 0)
			return null;
		else
			return $query->result();
	}

	/**
	 * Retrieves the archived courses i.e. courses which have been completed.
	 * @param type $user_id Optional user id. If non-zero retrieves courses of the specified user.
	 * @param type $limit. Optional limit on the number of records to retrieve.
	 * @param type $offset. Optional offset on the starting record to retrieve.
	 * @return array of objects containing all the fields.
	 */
	public function get_archived_courses($user_id = 0, $limit = null, $offset = null) {
		$this->db->select('*');

		if ($user_id)
			$this->make_student_course_query($user_id);
		else
			$this->db->from('course');

		$this->db->join('instructor', 'instructor.user_id = course.course_instructor');
		$this->db->join('user', 'user.user_id = instructor.user_id');
		$this->db->where('course_end_date !=', null);

		if ($limit)
			if ($offset)
				$this->db->limit($limit, $offset);
			else
				$this->db->limit($limit);

		$query = $this->db->get();
		if (!$query || $query->num_rows() == 0)
			return null;
		else
			return $query->result();
	}

	protected function get_user_type($user_id) {
		$query = $this->db->get_where(array('user' => $user_id));
		if (!$query || $query->num_rows() != 1)
			return '';
		else
			return $query->row()['user_type'];
	}

	/**
	 * Makes a query that joins the courses table with the students table so that all the
	 * courses in which a student has enrolled can be retrieved.
	 * @param int $user_id The user_id of the student in the db.
	 */
	protected function make_student_course_query($user_id) {
		$course_on = <<<END
					course_enrollment.course_code = course.course_code AND
					course_enrollment.course_term = course.course_term AND
					course_enrollment.course_year = course.course_year AND
					course_enrollment.course_type = course.course_type
END;
		$this->db->from('student');
		$this->db->where('student.user_id', $user_id);
		$this->db->join('course_enrollment', 'course_enrollment.user_id = student.user_id');
		$this->db->join('course', $course_on);
	}

}
