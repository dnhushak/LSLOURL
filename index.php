<?php
//Include the configure file
include('config.php');


//Building variables for the hit counter data

//Refering site
$referer = $_SERVER['HTTP_REFERER'];

//User's IP address
$usersip = $_SERVER['REMOTE_ADDR'];

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
	//Load the class
	$ipLite = new ip2location_lite;
	//Apply the API key
	$ipLite->setKey($apikey);
	
	//Look up IP info
	$locations = $ipLite->getCity($usersip);
	if (!empty($locations) && is_array($locations)) { 
		//If IP info is valid, parse out the various fields we want
		$country = $locations['countryName'];
		$region = $locations['regionName'];
		$city = $locations['cityName'];
		$zip = $locations['zipCode'];
		$lat = $locations['latitude'];
		$lon = $locations['longitude'];	
	}
}
else{
	$country = null;
	$region = null;
	$city = null;
	$zip = null;
	$lat = null;
	$lon = null;
}



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
	addHit($link_id, $referer, $usersip, $browser, $version, $operats, $contry, $region, $city, $zip, $lat, $lon, $db);	
	
	//clean up connections
	$result->free();
	$db->close();
	
	//Forward the page
	header('Location: ' . $url);
}





function addHit($link_id, $referer, $usersip, $browser, $version, $operats, $contry, $region, $city, $zip, $lat, $lon, $db){

	//Create the SQL 'INSERT INTO' query to log a hit
	$sql = "INSERT INTO hits (link_id, refer, user_ip, browser, browser_version, os, country, region, city, zipcode, lat, lon)
	VALUES ('" . $link_id . "', '" . $referer . "', '" . $usersip . "', '" . $browser . "', '" . $version . "', '" . $operats . "', '" . $country . "', '" . $region  . "', '" . $city . "', '" . $zip . "', '" . $lat . "', '" . $lon ."')";
	
	//Log the hit and check for successful query
	if(!$result = $db->query($sql)){
    	die('There was an error running the query [' . $db->error . ']');
	}
	
}
?>