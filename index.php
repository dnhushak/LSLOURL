<?php
//Include the configure file
include('config.php');



//Building variables for the hit counter data
//If browser and OS tracking is turned on
if($browswertrack){
	$browserinfo = get_browser($HTTP_USER_AGENT,true);
	$browser = $browswerinfo[browser];
	$version = $browswerinfo[version];
	$operats = $browswerinfo[platform];
	}
else{
	$browserinfo = null;
	$browser = null;
	$version = null;
	$operats = null;
}

//If IP location lookup is turned on
if($iptolocation){
	include('ip2locationlite.class.php');
}

$referer = $_SERVER['HTTP_REFERER'];
$usersip = $_SERVER['REMOTE_ADDR'];

//Check if a url slug is given
if(isset($_GET['l'])){

	//Find all entries with given slug
	$sql = "SELECT * FROM links WHERE short = '" . $_GET['l'] . "'";

	//Run the query
	if(!$result = $db->query($sql)){
    	die('There was an error running the query [' . $db->error . ']');
	}
	
	//Check if any results
	if($result->num_rows==0){
		//Either no slug was given, or slug was invalid
		$link_id = 0;
		$url = $homepage;
	}
	else{
		//Grab the row that contains the slug
		$row = $result->fetch_assoc();
		$link_id = $row['id'];
		$url = $row['long'];
	}
	
	//Log the hit
	addHit($link_id, $referer, $usersip, $browser, $version, $operats, $db);
	
	//clean up connections
	$result->free();
	$db->close();
	
	//Forward the page
	header('Location: ' . $url);
}





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