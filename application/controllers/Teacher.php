<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

require_once 'user.php';

/**
 * Description of Teacher
 * 
 * Teacher is a subclass of student. For now teacher contains no additional functionality.
 */
class Teacher extends User {

	/**
	 * Adds a tacher user to the database.
	 * @param type $key The user_key which exists in the temp_user table.
	 * @return int	id of the the newly added user if success, null otherwise.
	 */
	public function add_teacher($key) {
		// Look for the teacher in the temp_student table.
		$temp_user = $this->db->get_where('temp_user', array('temp_user_key' => $key));
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
