<?php
require 'database.php';

if(isset($_POST['username']) && isset($_POST['password'])){
	$username = $_POST['username'];
    $password = crypt($_POST['password']);
	//to prevent mysql injection
	$username= mysql_real_escape_string($username);
	$password= mysql_real_escape_string($password);
	$stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");
	if(!$stmt)
	{
		 echo json_encode(array(
		    "success" => false,
		    "message" => "Incorrect Username or Password"
	    ));
	exit;	
	}
	//echo $password;
	header("Location: login_ajax.php");
}

else{
	header("Location: register.php");
	exit;
}




 
$stmt->bind_param('ss', $username, $password);
 
$stmt->execute();
 
$stmt->close();
session_start();
$_SESSION['user_id'] = $username;
$_SESSION['token'] = substr(md5(rand()), 0, 10);
echo json_encode(array(
	    "success" => true,
		"user" => $_SESSION['user_id']
		));
		exit;



?>