<?php
session_start();
require 'database.php';
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
$id = $_POST['id'];
$username = $_SESSION['user_id'];
$eventName= $_POST['eventName'];
$eventDate = $_POST['eventDate'];
$eventTime = $_POST['eventTime'];
$stmt = $mysqli->prepare("update events set eventName=?, eventDate =?, eventTime=? where id =?");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->bind_param('sssi', $eventName, $eventDate, $eventTime, $id);

$stmt->execute();
$stmt->close();
echo json_encode(array(
	"success" => true
));
exit;
?>