<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

/*
 * This script is used to create the UniLog database in the MySQL server.
 * This script SHOULD NOT be placed accessable on the website as it will compromise its
 * security.
 * The tables created are as follows:
 *	user
 *	temp_user
 *	temp_student
 *  student
 *	student_auth
 *	instructor
 *	course
 *	upload
 *	post
 *	comment
 *	ci_session
 */

// Parameters.
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'unilog';


function runQuery() {
	global $query;
	mysql_query($query) or die('Query failed: ' . mysql_error()); 
}


mysql_connect($server, $user, $pass) or die('Unable to connect to MySQL server');
if (mysql_select_db($database)) {
	mysql_query('DROP DATABASE unilog');
}

mysql_query('CREATE DATABASE unilog') or die('Unable to create database');
mysql_select_db('unilog') or die('Unable to select database');


$query = <<<END
CREATE TABLE user (
	user_id					INT				UNSIGNED		NOT NULL	AUTO_INCREMENT,
	user_email				VARCHAR(255)					NOT NULL	UNIQUE,
	user_password			VARCHAR(64)						NOT NULL,
	user_first_name			VARCHAR(25)						NOT NULL,
	user_last_name			VARCHAR(25)						NOT NULL,
	user_type				ENUM(	'user_type_admin',
									'user_type_student',
									'user_type_instructor',
									'user_type_viewer')		NOT NULL	DEFAULT 'user_type_viewer',
	user_photo				LONGBLOB						NULL,
	user_secret_question	VARCHAR(255)					NULL,
	user_secret_answer		VARCHAR(255)					NULL,

	PRIMARY KEY	(user_id)
);
END;
runQuery();


$query = <<<END
CREATE TABLE temp_user (
	user_key			VARCHAR(64)						NOT NULL,
	user_email			VARCHAR(255)					NOT NULL	UNIQUE,
	user_password		VARCHAR(64)						NOT NULL,
	user_first_name		VARCHAR(25)						NOT NULL,
	user_last_name		VARCHAR(25)						NOT NULL,
	user_type			ENUM(	'user_type_admin',
								'user_type_student',
								'user_type_instructor',
								'user_type_viewer')		NOT NULL	DEFAULT 'user_type_viewer',
	PRIMARY KEY (user_key)
);
END;
runQuery();


$query = <<<END
CREATE TABLE temp_student (
	temp_user_key		VARCHAR(64)		NOT NULL,
	student_rollno		VARCHAR(12)		NOT NULL	UNIQUE,
	student_pin			SMALLINT(5)		NOT NULL	UNIQUE,

	FOREIGN KEY (temp_user_key) REFERENCES temp_user(user_key) ON DELETE CASCADE ON UPDATE NO ACTION,
	PRIMARY KEY (temp_user_key)
);
END;
runQuery();


$query = <<<END
CREATE TABLE student (
	user_id				INT				UNSIGNED	NOT NULL,
	student_rollno		VARCHAR(12)					NOT NULL	UNIQUE,
	
	FOREIGN KEY (user_id) REFERENCES user(user_id),
	PRIMARY KEY (user_id)
);
END;
runQuery();


$query = <<<END
CREATE TABLE student_auth (
	student_email		VARCHAR(255)	NOT NULL	UNIQUE,
	student_rollno		VARCHAR(12)		NOT NULL	UNIQUE,
	student_pin			SMALLINT(5)		NOT NULL	UNIQUE,
		
	PRIMARY KEY (student_email, student_rollno, student_pin)
);
END;
runQuery();


$query = <<<END
CREATE TABLE instructor (
	user_id			INT		UNSIGNED		NOT NULL,
		
	FOREIGN KEY (user_id) REFERENCES user(user_id),
	PRIMARY KEY (user_id)
);
END;
runQuery();


$query = <<<END
CREATE TABLE course (
	course_code			VARCHAR(6)							NOT NULL,
	course_term			ENUM('spring', 'fall')				NOT NULL,
	course_year			YEAR								NOT NULL,
	course_type			ENUM('th', 'pr')					NOT NULL,
	course_start_date	DATE								NOT NULL,
	course_end_date		DATE								NULL,
	course_name			VARCHAR(128)						NOT NULL,
	course_instructor	INT						UNSIGNED	NOT NULL,
		
	FOREIGN KEY	(course_instructor) REFERENCES user(user_id),
	PRIMARY KEY (course_code, course_term, course_year, course_type)
);
END;
runQuery();


$query = <<<END
CREATE TABLE upload (
	upload_id			INT			UNSIGNED	NOT NULL	AUTO_INCREMENT,
	upload_type			ENUM(	'upload_pdf',
								'upload_doc',
								'upload_image',
								'upload_video'
							)					NOT NULL,
	upload_timestamp	TIMESTAMP				NOT NULL,
	upload_caption		VARCHAR(64)				NOT NULL,
	upload_description	TEXT					NOT NULL,
	upload_altext		VARCHAR(128)			NOT NULL,
	upload_data			LONGBLOB				NOT NULL,
		
	PRIMARY KEY (upload_id)
);
END;
runQuery();


$query = <<<END
CREATE TABLE post (
	post_id				INT		UNSIGNED					NOT NULL	AUTO_INCREMENT,
	post_type			ENUM(	'post_admin_notification',
								'post_course_update',
								'post_discussion'
							)								NOT NULL,
	post_timestamp		TIMESTAMP							NOT NULL,
	post_title			VARCHAR(128)						NOT NULL,
	post_summary		TEXT								NOT NULL,
	post_text			TEXT								NOT NULL,
	post_author			INT		UNSIGNED					NOT NULL,
		
	FOREIGN KEY (post_author) REFERENCES user(user_id),
	PRIMARY KEY (post_id)
);
END;
runQuery();


$query = <<<END
CREATE TABLE comment (
	comment_id			INT			UNSIGNED	NOT NULL	AUTO_INCREMENT,
	post_id				INT			UNSIGNED	NOT NULL,
	comment_author		INT			UNSIGNED	NOT NULL,
	comment_timestamp	TIMESTAMP				NOT NULL,
	comment_text		TEXT					NOT NULL,
	
	FOREIGN KEY (post_id)			REFERENCES post(post_id),
	FOREIGN KEY (comment_author)	REFERENCES user(user_id),
	PRIMARY KEY (comment_id)
);
END;
runQuery();


$query = <<<END
CREATE TABLE ci_session (
	id			VARCHAR(40)							NOT NULL,
	ip_address	VARCHAR(45)							NOT NULL,
	timestamp	INT(10)		UNSIGNED	DEFAULT 0	NOT NULL,
	data		BLOB								NOT NULL,
		
	PRIMARY KEY (id),
	KEY ci_sessions_timestamp (timestamp)
);
END;
runQuery();