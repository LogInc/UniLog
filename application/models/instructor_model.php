<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

require_once 'user_model.php';

/**
 * Description of Instructor
 * 
 * Instructor is a subclass of user. For now instructor contains no additional functionality.
 */
class Instructor_Model extends User_Model {

	/**
	 * Adds an instructor user to the database.
	 * @param type $key The user_key which exists in the temp_user table.
	 * @return int	id of the the newly added user if success, null otherwise.
	 */
	public function add_user($key) {
		// Look for the teacher in the temp_user table.
		$temp_user = $this->db->get_where('temp_user', array('user_key' => $key));
		if (!$temp_user)
			return null;

		if ($temp_user->num_rows() != 1)
			return null;

		$row = $temp_user->row();
		if ($row->user_type != 'user_type_instructor')
			return null;

		$user_added = parent::add_user($key);
		if (!$user_added)
			return null;

		$data = array(
			'user_id' => $user_added,
		);

		$instructor_added = $this->db->insert('instructor', $data);
		if (!$instructor_added)
			return null;

		return $user_added;
	}

	/**
	 * Returns the courses in which the instructor is currently teaching.
	 * @param string $which 'current' returns currently running courses. 'archived' returns
	 * archived courses only. Any other value returns all the courses.
	 * @return array
	 */
	public function get_courses($id=0, $which='all') {
		if (!$id)
			$id = $this->session->user_id;
		
		$query = <<<END
			SELECT *
			FROM course
			JOIN instructor ON instructor.user_id = course.course_instructor
			JOIN user ON user.user_id = instructor.user_id
			WHERE user.user_id = '$id'
END;
		switch ($which) {
			case 'current':
				$query .= 'AND course.course_end_date IS NULL';
				break;
			case 'archived':
				$query .= 'AND course.course_end_date IS NOT NULL';
				break;
		}
		
		$result = $this->db->query($query);
		if (!$result)
			return null;
		
		return $result->result();
	}
}
