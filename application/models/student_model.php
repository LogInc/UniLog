<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

require_once 'user_model.php';

/**
 * Description of Student
 * 
 * A student is a special type of User.
 * 
 * When managing (insertion/deletion) students in the database, functions of this class
 * should only be called as they automatically manage the underlying user object.
 */
class Student_Model extends User_Model {

	/**
	 * Adds a student user to the database.
	 * @param type $key The user_key which exists in the temp_user table.
	 * @return int	id of the the newly added user if success, null otherwise.
	 */
	public function add_user($key) {
		// Look for the student in the temp_student table.
		$temp_student = $this->db->get_where('temp_student', array('temp_user_key' => $key));
		if (!$temp_student)
			return null;

		if ($temp_student->num_rows() != 1)
			return null;

		$row = $temp_student->row();
		$rollno = $row->student_rollno;

		$user_added = parent::add_user($key);
		if (!$user_added)
			return null;

		$data = array(
			'user_id' => $user_added,
			'student_rollno' => $rollno
		);

		$student_added = $this->db->insert('student', $data);
		if (!$student_added)
			return null;

		return $user_added;
	}

	/**
	 * Adds a temporary student to the database.
	 * @param string $key A unique key.
	 * @return true if student added.
	 *
	 */
	public function add_temp_user($key) {
		parent::add_temp_user($key);

		$data = array(
			'temp_user_key' => clean_input($key),
			'student_rollno' => clean_input($this->input->post('rollno'))
		);

		return $this->db->insert('temp_student', $data);
	}

	/**
	 * Returns the courses in which the user is currently enrolled and the instructor
	 * of that course.
	 * @return array
	 */
	public function get_current_course_enrollments() {
		$id = $this->session->user_id;
		
		$query = <<<END
			SELECT teacher.*, course.*
			FROM user student
			JOIN course_enrollment ON student.user_id = course_enrollment.user_id
			JOIN course ON	(
								course.course_code = course_enrollment.course_code AND
								course.course_term = course_enrollment.course_term AND
								course.course_year = course_enrollment.course_year AND
								course.course_type = course_enrollment.course_type
							)
			JOIN user teacher ON teacher.user_id = course.course_instructor
			WHERE student.user_id = '$id'
			AND course.course_end_date IS NULL
END;
		$result = $this->db->query($query);
		if (!$result)
			return null;
		
		return $result->result_array();
	}
	
	/**
	 * Returns true if the student is enrolled in the given course.
	 * @param type $code
	 * @param type $term
	 * @param type $year
	 * @param type $type
	 * @return boolean
	 */
	public function is_enrolled_in_course($code, $term, $year, $type) {
		$data = array(	'user_id'		=> $this->session->user_id,
						'course_code'	=> $code,
						'course_term'	=> $term,
						'course_year'	=> $year,
						'course_type'	=> $type
						);
		
		$result = $this->db->get_where('course_enrollment', $data);
		if ($result && $result->num_rows() == 1)
			return true;
		
		return false;
	}
	
	/**
	 * Enrolls a student in the given course.
	 * @param type $code
	 * @param type $term
	 * @param type $year
	 * @param type $type
	 * @return boolean
	 */
	public function enroll_in_course($code, $term, $year, $type) {
		$data = array(	'user_id'		=> $this->session->user_id,
						'course_code'	=> $code,
						'course_term'	=> $term,
						'course_year'	=> $year,
						'course_type'	=> $type
						);
		
		return $this->db->insert('course_enrollment', $data);
	}

	/**
	 * Adds a student authentication pin to the database.
	 * 
	 * Student users who attempt to sign-up must have a secret pin entry corresponding
	 * to their email and roll no. in the database. This method adds that entry.
	 * @param smallint $pin A unique pin identifying the student.
	 * @return boolean True if the entry was successfully added.
	 */
	public function add_student_pin($pin) {
		$data = array(
			'student_email' => clean_input($this->input->post('email')),
			'student_rollno' => clean_input($this->input->post('rollno')),
			'student_pin' => $pin
		);

		$inserted = $this->db->insert('student_auth', $data);
		return $inserted;
	}

	/**
	 * Validates a student input when signing up.
	 * 
	 * A student user when signing up must provide a valid pin allotted to him secretly.
	 * This key must be present in the database corresponding to his email and roll no.
	 * This method verifies the existence of the pin.
	 * @return boolean	True if the a valid entry exists in the database.
	 */
	public function valid_student_pin() {
		$email = clean_input($this->input->post('email'));
		$rollno = clean_input($this->input->post('rollno'));
		$pin = clean_input($this->input->post('pin'));

		$query = $this->db->get_where('student_auth', array('student_email' => $email,
			'student_rollno' => $rollno,
			'student_pin' => $pin));
		if ($query)
			return ($query->num_rows() == 1);
		else
			return false;
	}

	/**
	 * Generates a unique student pin for student authentication.
	 * @return int A unique pin.
	 */
	public function generate_unique_pin() {
		$found = false;
		$pin = 0;
		while (!found) {
			$pin = rand(10000, 99999);
			$query = $this->db->get_where('student_auth', array('student_pin' => $pin));
			$found = ($query != null) && ($query->num_rows() == 0);
		}
		return $pin;
	}

}
