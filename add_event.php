<?php
session_start();
header("Content-Type: application/json");
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

	if(isset($_SESSION['user_id'])){
		require 'database.php';
		$userID = $_SESSION['user_id'];
		$eventName =$_POST['eventName'];
		$eventDate = $_POST['eventDate'];
		$eventTime = $_POST['eventTime'];
		$stmt = $mysqli->prepare("insert into events (eventName, eventDate, eventTime) values (?, ?, ?)");
		$stmt->bind_param('sss', $eventName, $eventDate, $eventTime);

		$stmt->execute();
		$eventID = $mysqli->insert_id;
		$stmt->close();

		$stmt = $mysqli->prepare("insert into user_events (userID, eventID, eventName, eventDate, eventTime) values (?, ?, ?, ?, ?)");
		$stmt->bind_param('sssss', $userID, $eventID, $eventName, $eventDate, $eventTime);

		$stmt->execute();

		$stmt->close();


		echo json_encode(array(
			"success" => true
		));
		exit;
	}
	?>