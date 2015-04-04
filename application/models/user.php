<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

/**
 * Description of user
 * This model represents a UniLog user.
 * Includes functionality to create new users, verify a user's existence.
 */
class User extends CI_Model {
	
	/**
	 * Adds a temporary user to the temp_user table.
	 * @param string $key A unique key.
	 * @return true if user added.
	 *
	 */
	public function add_temp_user($key) {
		$data = array(
			'user_key' => $key,
			'user_first_name' => $this->input->post('firstname'),
			'user_last_name' => $this->input->post('lastname'),
			'user_rollno' => $this->input->post('rollno'),
			'user_email' => $this->input->post('email'),
			'user_password' => sha1($this->input->post('password'))
			);
		$inserted = $this->db->insert('temp_user', $data);
		return $inserted;
	}
}
