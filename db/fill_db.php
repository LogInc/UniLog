<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

/*
 * This script is used to fill some test data in to the database
 * This script SHOULD NOT be placed accessable on the website as it will compromise its
 * security.
 */

// Parameters.
$server = 'localhost';
$user = 'root';
$pass = '';
$database = 'unilog';

mysql_connect($server, $user, $pass) or die('Unable to connect to MySQL server');
mysql_select_db($database) or die('Unable to select database');

/*
function runQuery() {
	global $query;
	mysql_query($query) or die('Query failed: ' . mysql_error());
}
 */

$password_admin = password_hash("chateau", PASSWORD_BCRYPT);
$password_baig = password_hash("chateau", PASSWORD_BCRYPT);
$password_asad = password_hash("applemac", PASSWORD_BCRYPT);
$password_ahmar = password_hash("visionace", PASSWORD_BCRYPT);
$password_hassan = password_hash("smhri007", PASSWORD_BCRYPT);
$password_teacher = password_hash("abc123", PASSWORD_BCRYPT);

$query = <<<END
INSERT INTO user (	user_id,
					user_email,
					user_password,
					user_first_name,
					user_last_name,
					user_type)
		
	VALUES	(1, "log.inc.827@gmail.com", "$password_admin", "Admin", "", "user_type_admin"),
			(2, "abdullahbaig456@gmail.com", "$password_baig", "Abdullah", "Baig", "user_type_student"),
			(3, "imamsb_007@hotmail.com", "$password_hassan", "Hassan", "Imam", "user_type_student"),
			(4, "asadazam93@gmail.com", "$password_asad", "Asad", "Azam", "user_type_student"),
			(5, "ahmar_sultan@live.com", "$password_ahmar", "Ahmar", "Sultan", "user_type_student"),
			(6, "ysaleem@gmail.com", "$password_teacher", "Yasir", "Saleem", "user_type_instructor"),
			(7, "kk@gmail.com", "$password_teacher", "Khuldoon", "Khurshid", "user_type_instructor"),
			(8, "faisal@gmail.com", "$password_teacher", "Faisal", "Hayat", "user_type_instructor"),
			(9, "taniya@gmail.com", "$password_teacher", "Tania", "Habib", "user_type_instructor"),
			(10, "asim@gmail.com", "$password_teacher", "Asim", "Rehmat", "user_type_instructor"),
			(11, "amjad@gmail.com", "$password_teacher", "Amjad", "Farooq", "user_type_instructor"),
			(12, "shahbaz@gmail.com", "$password_teacher", "Muhammad", "Shahbaz", "user_type_instructor"),
			(13, "ammar@gmail.com", "$password_teacher", "Ammar", "Khalid", "user_type_instructor");
END;
runQuery();


$query = <<<END
INSERT into student (	user_id,
						student_rollno)
					VALUES	(2, '2012-CE-27'),
							(3, '2012-CE-26'),
							(4, '2012-CE-11'),
							(5, '2012-CE-08');
END;
runQuery();


$query = <<<END
INSERT into instructor (user_id) VALUES (6), (7), (8), (9), (10), (11), (12), (13);
END;
runQuery();


$query = <<<END
INSERT INTO course (	course_code,
						course_term,
						course_year,
						course_type,
						course_start_date,
						course_end_date,
						course_name,
						course_instructor,
						course_photo
					)
	VALUES	('CS101', 'spring', '2013', 'th', '2013-9-15', '2014-1-1', 'Digital Logic Design', 6, ''),
			('CS102', 'spring', '2014', 'th', '2014-9-15', '2015-1-1', 'Database and Management', 7, ''),
			('CS103', 'fall', '2015', 'th', '2015-1-3', null, 'Computer Networks', 8, 'fixed_cn.jpg'),
			('CS104', 'fall', '2015', 'th', '2015-1-3', null, 'Artificial Intelligence', 12, 'fixed_ai.png'),
			('CS104', 'fall', '2015', 'pr', '2015-1-3', null, 'Artificial Intelligence', 13, 'fixed_ai.png'),
			('CS105', 'fall', '2015', 'th', '2015-1-3', null, 'Control Systems', 9, 'fixed_cs.jpg'),
			('CS106', 'fall', '2015', 'th', '2015-1-3', null, 'Embedded Systems Design', 10, 'fixed_esd.jpg'),
			('CS107', 'fall', '2015', 'th', '2015-1-3', null, 'Web Technologies', 11, 'fixed_wt.jpg');
END;
runQuery();


$query = <<<END
INSERT INTO course_enrollment	(
									user_id,
									course_code,
									course_term,
									course_year,
									course_type
								)
						VALUES	( 2, 'CS101', 'spring', '2013', 'th' ),
								( 3, 'CS101', 'spring', '2013', 'th' ),
								( 4, 'CS101', 'spring', '2013', 'th' ),
								( 5, 'CS101', 'spring', '2013', 'th' ),
								
								( 2, 'CS102', 'spring', '2014', 'th' ),
								( 3, 'CS102', 'spring', '2014', 'th' ),
								( 4, 'CS102', 'spring', '2014', 'th' ),
								( 5, 'CS102', 'spring', '2014', 'th' ),
								
								( 2, 'CS103', 'fall', '2015', 'th' ),
								( 3, 'CS103', 'fall', '2015', 'th' ),
								( 4, 'CS103', 'fall', '2015', 'th' ),
								( 5, 'CS103', 'fall', '2015', 'th' ),
		
								( 2, 'CS104', 'fall', '2015', 'th' ),
								( 3, 'CS104', 'fall', '2015', 'th' ),
								( 4, 'CS104', 'fall', '2015', 'th' ),
								( 5, 'CS104', 'fall', '2015', 'th' ),
		
								( 3, 'CS104', 'fall', '2015', 'pr' );
END;
runQuery();
