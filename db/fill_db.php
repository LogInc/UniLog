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


$password = password_hash("chateau", PASSWORD_BCRYPT);

$query = <<<END
INSERT INTO user (	user_email,
					user_password,
					user_first_name,
					user_last_name,
					user_type)
		
		VALUES (	"log.inc.827@gmail.com",
					"$password",
					"Admin",
					"",
					"user_type_admin");
END;
runQuery();