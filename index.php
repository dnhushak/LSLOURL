<?php

//Connect to database
include('connect2db.php');


//Building variables for the hit counter data
//$browserinfo = get_browser($HTTP_USER_AGENT,true);
//$browser = mysql_real_escape_string($browswerinfo[browser]);
//$version = mysql_real_escape_string($browswerinfo[version]);
//$operats = mysql_real_escape_string($browswerinfo[platform]);
$browser = "Chrome";
$version = "37";
$operats = "Mac OS X Mavericks";
$referer = $_SERVER['HTTP_REFERER'];
$usersip = $_SERVER['REMOTE_ADDR'];

//Check if a url slug is given
if(isset($_GET['l'])){

	//Find all entries with given slug
	$sql = "SELECT * FROM links
    WHERE short = '" . $_GET['l'] .
	"'";

	if(!$result = $db->query($sql)){
    	die('There was an error running the query [' . $db->error . ']');
	}

	//Either no slug was given, or slug was invalid
	if($result->num_rows==0){

		$link_id = 0;
		addHit($link_id, $referer, $usersip, $browser, $version, $operats, $db);
 		header('Location: http://www.ellesello.com' );
	}
	else{
		$row = $result->fetch_assoc();
		$link_id = $row['id'];
		addHit($link_id, $referer, $usersip, $browser, $version, $operats, $db);
		header('Location: ' . $row['long']);
	}
	$result->free();
}




$db->close();

function addHit($link_id, $referer, $usersip, $browser, $version, $operats, $db){

	//Create the SQL INSERT INTO query to log a hit
	$sql = "INSERT INTO hits (link_id, refer, user_ip, browser, browser_version, os)
	VALUES ('" . $link_id . "', '" . $referer . "', '" . $usersip . "', '" . $browser . "', '" . $version . "', '" . $operats . "')";
	
	//Log the hit and check for successful query
	if(!$result = $db->query($sql)){
    	die('There was an error running the query [' . $db->error . ']');
	}
	
}
?>