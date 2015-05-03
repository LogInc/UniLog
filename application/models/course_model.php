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
	

	public function get_current_courses($limit=null, $offset=null) {
		$this->db->where('course_end_date !=', null);
		
		if ($limit)
			$query = $this->db->get('course', $limit, $offset);
		else
			$query = $this->db->get('course');
		
		if (!$query || $query->num_rows() == 0)
			return null;
		else
			return $query->result();
	}

}
