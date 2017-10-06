<?php
session_start();
require 'database.php';
header("Content-Type: application/json"); 
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
if (!isset($_SESSION['user_id'])) {
session_destroy();
echo json_encode(array(
		"success"=>false,
		"message"=>"Please register the new account first"));
	exit;
}

if(isset($_SESSION['user_id'])){				
    $stmt = $mysqli->prepare("delete from events where events= 'eventname'?");
         if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
        }
        $stmt->bind_param('s', $eventname);
        $stmt->execute();
        $stmt->close();
        echo json_encode(array(
		"success" => true
	));
	exit;

//header("Location: home.php");
}
?>