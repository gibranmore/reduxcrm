<?php
/* Donwloaded from production on Sep 26 2017  */

/* File   : dbconnect.php
   Subject: Bonus Homeworkd
   Authors: Swathi Kotturu
   Version: 1.0.2
   Date   : Nov 9, 2014
   Description: create database connection to the selected database
*/


	// connect to database
	$dbhost = 'localhost';
	$dbuser = 'gibranmo';
	$dbpass = '5876leonardo';
	$mydb = 'reduxdb';

	/*
	$mysql_host = "mysql2.000webhost.com";
	$mysql_database = "a9012814_db";
	$mysql_user = "a9012814_gibran";
	$mysql_password = "5876leonardo";
	*/

	

	$conn = new mysqli($dbhost, $dbuser, $dbpass, $mydb);
	
	/*
	ALTERNATE STYLE:
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $mydb);
	*/
	
	if ($conn->connect_errno)
  	{
  		  echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
  	}

  	/*
	ORIGINAL: 
	>Dont need it(?)
	mysqli_select_db($conn, 'youthcyb_kotturu');
	
	*/

?>