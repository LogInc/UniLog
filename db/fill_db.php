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

function runQuery() {
	global $query;
	mysql_query($query) or die('Query failed: ' . mysql_error()); 
}


$password_admin = password_hash("chateau", PASSWORD_BCRYPT);
$password_baig = password_hash("chateau", PASSWORD_BCRYPT);
$password_asad = password_hash("applemac", PASSWORD_BCRYPT);
$password_ahmar = password_hash("visionace", PASSWORD_BCRYPT);
$password_hassan = password_hash("smhri007", PASSWORD_BCRYPT);

$query = <<<END
INSERT INTO user (	user_email,
					user_password,
					user_first_name,
					user_last_name,
					user_type)
		
		VALUES (	"log.inc.827@gmail.com",
					"$password_admin",
					"Admin",
					"",
					"user_type_admin");
END;
runQuery();


$query = <<<END
INSERT INTO user (	user_email,
					user_password,
					user_first_name,
					user_last_name,
					user_type)
		
		VALUES (	"abdullahbaig456@gmail.com",
					"$password_baig",
					"Abdullah",
					"Baig",
					"user_type_student");
END;
runQuery();


$query = <<<END
INSERT INTO user (	user_email,
					user_password,
					user_first_name,
					user_last_name,
					user_type)
		
		VALUES (	"imamsb_007@hotmail.com",
					"$password_hassan",
					"Hassan",
					"Imam",
					"user_type_student");
END;
runQuery();

$query = <<<END
INSERT INTO user (	user_email,
					user_password,
					user_first_name,
					user_last_name,
					user_type)
		
		VALUES (	"asadazam93@gmail.com",
					"$password_asad",
					"Asad",
					"Azam",
					"user_type_student");
END;
runQuery();


$query = <<<END
INSERT INTO user (	user_email,
					user_password,
					user_first_name,
					user_last_name,
					user_type,
					user_photo)
		
		VALUES (	"ahmar_sultan@live.com",
					"$password_ahmar",
					"Ahmar",
					"Sultan",
					"user_type_student",
					"ahmar.jpg");
END;
runQuery();