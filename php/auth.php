<?php
include "common.php";
$pattern = "/\\?(.*$)/i";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_errno) {
	die('Could not connect: ' . $conn->connect_error);
}

if(empty($_GET['name']) || empty($_GET['swfurl']))
{
	http_response_code(401);
	die();
}
else
{
	$name = mysqli_real_escape_string($conn, $_GET['name']);
	preg_match($pattern, $_GET['swfurl'], $matches);
}

$query = "SELECT idhash FROM $usertablename WHERE username = '$name'";
$result = $conn->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);

if ($matches[1] == $row['idhash']){
	http_response_code(200);
	die();
}
else{
	http_response_code(402);
	die();
}
?>
