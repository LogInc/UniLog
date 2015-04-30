<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

/**
 * Description of user
 * 
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
		$key = clean_input($key);
		$password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		$email = clean_input($this->input->post('email'));
		$type = clean_input($this->input->post('type'));
		$type = 'user_type_' . $type;
		
		$data = array(
			'user_key' => $key,
			'user_first_name' => clean_input($this->input->post('firstname')),
			'user_last_name' => clean_input($this->input->post('lastname')),
			'user_email' => $email,
			'user_password' => $password,
			'user_type' => $type
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
	 * Gets a user from the database.
	 * @param type $email
	 * @return user if found, null otherwise.
	 */
	public function get_user_by_email($email) {
		$query = $this->db->get_where('user', array('user_email' => clean_input($email)));
		if (!$query || $query->num_rows() != 1)
			return null;
		else
			return $query->row();
	}
	
	/**
	 * Gets a user from the database.
	 * @param type $id
	 * @return user if found, null otherwise.
	 */
	public function get_user_by_id($id) {
		$query = $this->db->get_where('user', array('user_id' => $id));
		if (!$query || $query->num_rows() != 1)
			return null;
		else
			return $query->row();
	}
	
	/**
	 * Authenticates a user given his/her email and password and returns the data.
	 * @return true if user if user is authenticated, false otherwise.
	 */
	public function authenticate_user() {
		$password = clean_input($this->input->post('password'));
		$data = array('user_email' => clean_input($this->input->post('email')));
		$user = $this->db->get_where('user', $data);
		
		if (!$user || $user->num_rows() != 1)
			return false;
		else
			return password_verify($password, $user->row()->user_password);
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
	
	/**
	 * Returns a temp user record provided its key.
	 * @param type $key the key.
	 * @return array if a record is found, null otherwise.
	 */
	public function get_temp_user($key) {
		$query = $this->db->get_where('temp_user', array('user_key' => $key));

		if ($query && $query->num_rows() == 1) {
			return $query->row();
		}
		return null;
	}
	
	public function update_summary() {
		$email = $this->session->email;
		$summary = $this->input->post('summary');
		if ($this->session->is_logged_in)
			$this->db->query("UPDATE user SET user_summary='$summary' WHERE user_email='$email'");
	}

}