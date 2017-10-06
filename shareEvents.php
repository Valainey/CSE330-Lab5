<?php
require 'database.php';
header("Content-Type: application/json");

if(empty($_SESSION))
{
	ini_set("session.cookie_httponly", 1);
	session_start();
}

if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}

if (!isset($_SESSION['user_id'])) {
	session_destroy();
	echo json_encode(array(
		"success"=>false,
		"message"=>"Please register a new account first"));
		exit;
	}


$username = $_SESSION['username'];
$eventID = $_POST['eventID'];
$userID = $_POST['userID'];
//$friendID = $_POST['friendID'];
$stmt = $mysqli->prepare("insert into user_events (eventID, userID) values (?, ?)");
if(!$stmt){
	echo json_encode(array(
		"success" => false,
	));
	exit;
}

$stmt->bind_param('ii', $eventID, $userID);
$stmt->execute();
$stmt->close();
echo json_encode(array(
		"success" => true
	));
exit;
?>


