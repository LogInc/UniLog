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

		$data = array('course_code' => $course_code,
			'course_term' => $course_term,
			'course_year' => $course_year,
			'course_type' => $course_type,
			'course_name' => $course_title,
			'course_intro' => $course_desc,
			'course_start_date' => date('Y-m-d'),
			'course_instructor' => $this->session->user_id
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
		$data = array(
			'course_code' => clean_input($code),
			'course_term' => clean_input($term),
			'course_year' => clean_input($year),
			'course_type' => clean_input($type)
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

	/**
	 * Retrieves all the uploads related to a course.
	 * @param string $type The type of uploads to retrieve. NULL means all types.
	 * @return array Array of uploads if any found, NULL otherwise. 
	 */
	public function get_uploads($type = null) {
		$where = array('course_code' => $this->session->course_code,
			'course_term' => $this->session->course_term,
			'course_year' => $this->session->course_year,
			'course_type' => $this->session->course_type,
		);
		if ($type)
			$where['upload.upload_type'] = $type;

		$this->db->select('*');
		$this->db->from('course_post');
		$this->db->join('post', 'post.post_id = course_post.post_id');
		$this->db->join('upload', 'upload.post_id = post.post_id');
		$this->db->join('user', 'user.user_id = post.post_author');
		$this->db->where($where);

		$query = $this->db->get();
		if ($query && $query->num_rows() > 0)
			return $query->result();
		else
			return null;
	}

	/**
	 * Retrieves posts posted on a course's page.
	 * 
	 * @param string $code Course code.
	 * @param string $term Course term (fall / spring).
	 * @param string $year Course year.
	 * @param string $type Course type (th / pr)
	 * @param int $limit No. of posts to retrieve. 0 for all.
	 * @param int $offset Offset of the first post to retrieve.
	 * @param string $post_type Type of posts. null for all.
	 * @return html.
	 */
	public function get_course_posts($code, $term, $year, $type, $limit = 10, $offset = 0, $post_type = null) {
		$where = array(
			'course_code' => $code,
			'course_term' => $term,
			'course_year' => $year,
			'course_type' => $type,
		);

		$this->db->select('user_first_name, user_last_name, post.*');
		$this->db->from('course_post');
		$this->db->join('post', 'post.post_id = course_post.post_id');
		$this->db->join('user', 'user.user_id = post.post_author');
		$this->db->where($where);
		
		if ($post_type)
			$this->db->where(array('post.post_type' => $post_type));

		$this->db->order_by('post_timestamp', 'DESC');

		if ($limit)
			$this->db->limit($limit, $offset);

		$query = $this->db->get();
		if ($query && $query->num_rows() > 0)
			return $query->result();
		else
			return null;
	}

	/**
	 * Retrieves the upload records of a post.
	 * @param type $post_id The id of the post.
	 * @return object Query result if any found, null otherwise.
	 */
	public function get_upload_by_post_id($post_id) {
		$query = $this->db->get_where('upload', array('post_id' => clean_input($post_id)));
		if ($query && $query->num_rows() > 0)
			return $query->result();
		else
			return null;
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
