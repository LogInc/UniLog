<?php

/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */

mysql_connect('localhost', 'root', '') or die('Unable to connect to MySQL server');
if (mysql_select_db('unilog')) {
	mysql_query('DROP DATABASE unilog');
}

mysql_query('CREATE DATABASE unilog') or die('Unable to create database');
mysql_select_db('unilog') or die('Unable to select database');

$query = <<<END
		CREATE TABLE user (
			user_email			VARCHAR(255)	NOT NULL,
			user_rollno			VARCHAR(12)		NULL		UNIQUE,
			user_password		VARCHAR(64)		NOT NULL,
			user_first_name		VARCHAR(25)		NOT NULL,
			user_last_name		VARCHAR(25)		NOT NULL,
		
			PRIMARY KEY (user_email)
		);
END;
mysql_query($query) or die('Query failed: ' . mysql_error()); 


$query = <<<END
		CREATE TABLE temp_user (
			user_key			VARCHAR(64)		NOT NULL,
			user_email			VARCHAR(255)	NOT NULL	UNIQUE,
			user_rollno			VARCHAR(12)		NULL		UNIQUE,
			user_password		VARCHAR(64)		NOT NULL,
			user_first_name		VARCHAR(25)		NOT NULL,
			user_last_name		VARCHAR(25)		NOT NULL,
		
			PRIMARY KEY (user_key)
		);
END;
mysql_query($query) or die('Query failed: ' . mysql_error()); 