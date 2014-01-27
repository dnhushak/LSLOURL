<?php
//IP location lookup (country, region, city, zipcode etc.)	
	$apikey = yourapikey;
	$iptolocation = FALSE;


//Browser and OS information tracking
	$browsertrack = FALSE;
	
//Default page for null or invalid slugs
	$homepage = 'http://www.example.com';

//Fill in your specific database variables here
	$database='dbase';
	$username='user';
	$password='pass';
	$hostname='host url or ip';
	$db = new mysqli($hostname, $username, $password, $database);
	if($db->connect_errno > 0){
		die('Unable to connect to database [' . $db->connect_error . ']');
	}
?>