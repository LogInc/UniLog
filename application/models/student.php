<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

/**
 * Description of Student
 * 
 * A student is a special type of User.
 * 
 * When managing (insertion/deletion) students in the database, functions of this class
 * should only be called as they automatically manage the underlying user object.
 */
class Student extends User {
	
	/**
	 * Adds a student user to the database.
	 * @param type $key The user_key which exists in the temp_user table.
	 * @return int	id of the the newly added user if success, null otherwise.
	 */
	public function add_student($key) {
		// Look for the student in the temp_student table.
		$temp_student = $this->db->get_where('temp_student', array('temp_user_key' => $key));
		if (!$temp_student)
			return null;
		
		if ($temp_student->num_rows() != 1)
			return null;
		
		$user_added = parent::add_user($key);
		if (!$user_added)
			return null;
		
		$data = array(
			'user_id'			=> $user_added,
			'student_rollno'	=> $temp_student->student_rollno
			);
		
		$student_added = $this->db-insert('student', $data);
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
	public function add_temp_student($key) {
		parent::add_temp_user($key);
		
		$data = array(
			'temp_user_key'		=> clean_input($key),
			'student_rollno'	=> clean_input($this->input->post('rollno')),
			'student_pin'		=> clean_input($this->input->post('pin'))
			);

		$this->db->insert('temp_student', $data);
	}
}
