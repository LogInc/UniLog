<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

require_once 'user.php';

/**
 * Description of Instructor
 * 
 * Instructor is a subclass of student. For now instructor contains no additional functionality.
 */
class Instructor extends User {

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

}
