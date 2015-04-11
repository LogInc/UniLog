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
	 * Adds a user in the database.
	 * @param string $key	The user_key which exists in the temp_user table.
	 * @return int id of the newly added user if success, null otherwise.
	 */
	public function add_user($key) {
		$key = clean_input($key);
		
		// Look for the user in the temp_user table.
		$temp_user = $this->db->get_where('temp_user', array('user_key' => $key));
		if (!$temp_user)
			return null;
		
		if ($temp_user->num_rows() != 1)
			return null;
		
		// Found? Move it to the user table where our permanent users reside.
		$row = $temp_user->row();
		$data = array(
			'user_email'		=> $row->user_email,
			'user_password'		=> $row->user_password,
			'user_first_name'	=> $row->user_first_name,
			'user_last_name'	=> $row->user_last_name,
			'user_type'			=> $row->user_type
			);
		
		// Add the entry.
		$user_added = $this->db->insert('user', $data);
		if (!$user_added)
			return null;
		
		// Drop the entry from the temporary table.
		$this->db->delete('temp_user', array('user_key' => $key));
		
		$query = $this->db->get_where('user', array('user_email' => $data['user_email']));
		
		return $query->row()->user_id;
	}

	/**
	 * Adds a temporary user to the temp_user table.
	 * @param string $key A unique key.
	 * @return true if user added.
	 *
	 */
	public function add_temp_user($key) {
		$key = xss_clean(html_escape($key));
		$password = password_hash($this->input->post('pasword'), PASSWORD_BCRYPT);
		$email = clean_input($this->input->post('email'));
		$data = array(
			'user_key' => $key,
			'user_first_name' => clean_input($this->input->post('firstname')),
			'user_last_name' => clean_input($this->input->post('lastname')),
			'user_email' => $email,
			'user_password' => $password,
			'user_type' => clean_input($this->input->post('user_type'))
		);
		
		// Delete any previous temp_user with the same email address.
		$this->db->where('user_email', $email);
		$this->db->delete('temp_user');
		
		$inserted = $this->db->insert('temp_user', $data);
		
		return $inserted;
	}
	
	/**
	 * Deletes a user's record from the temp_user table.
	 * 
	 * This is used when a user signs up multiples time. We need to delete the old
	 * record in the temp_user.
	 * @param string $mail	The email address of the user.
	 */
	public function delete_temp_user($mail) {
		$mail = clean_input($mail);
		$this->db->delete('temp_user', array('user_email' => $mail));
	}

	/**
	 * Checks if the given key exists in the temp_user table.
	 * 
	 * This implies that whether a user exists who signed up on our site and was
	 * given this key to complete the registration process.
	 * @param string $key	the key value to check.
	 * @return true if the key is found in the database.
	 */
	public function valid_key($key) {
		$key = clean_input($key);

		$query = $this->db->get_where('temp_user', array('user_key' => $key));
		if ($query) {
			return ($query->num_rows() == 1);
		}
		return false;
	}

	/**
	 * Returns they key associated with the temporary user.
	 * 
	 * If the same user signs up twice, we need to given him the same key the 2nd time
	 * which we gave him the first time.
	 * @return string The user key if one found, otherwise null.
	 */
	public function get_temp_user_key() {
		$query = $this->db->get_where('temp_user', array('user_email' => clean_input($this->input->post('email'))));

		if ($query && $query->num_rows() == 1) {
			return $query->row()->user_key;
		}
		return null;
	}

}
