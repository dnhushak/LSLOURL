<?php
include('connect2db.php');
/*$links = parse_ini_file('links.ini');

if(isset($_GET['l']) && array_key_exists($_GET['l'], $links)){
    header('Location: ' . $links[$_GET['l']]);
}
else{
    header('Location: http://www.ellesello.com' );
}*/


if(isset($_GET['l'])){

$sql2 = "SELECT * FROM links
    WHERE short = '" . $_GET['l'] .
"'";

if(!$result2 = $db->query($sql2)){
    die('There was an error running the query [' . $db->error . ']');
}

if($result2->num_rows==0){
 header('Location: http://www.ellesello.com' );
}
else{
$row2 = $result2->fetch_assoc();
header('Location: ' . $row2['long']);
}

	
}



$result2->free();

$db->close();
?>