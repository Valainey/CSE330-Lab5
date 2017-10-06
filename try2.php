<?php
require 'database.php';
header("Content-Type: application/json");
if(isset($_POST['username']) && isset($_POST['password'])){
	
$username = $_POST['username'];
$password = $_POST['password'];
$passwordHash = crypt($password);
$stmt = $mysqli->prepare("insert into user (username, hashpass) values (?, ?)");
  if(!$stmt){
	echo json_encode(array(
		"success" => false,
		"message" => "Incorrect Username or Password"
	));
	exit;
	}
  $stmt->bind_param('ss', $username, $passwordHash);
 
 
    $stmt->execute();
  
  $stmt->close();
  session_start();
$_SESSION['user_id'] = $username;
$_SESSION['token'] = substr(md5(rand()), 0, 10);
echo json_encode(array(
		"success" => true
	));
	exit;
    
    
}
?>
    
    
    
    