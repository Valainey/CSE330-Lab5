<?php
    require 'database.php';
header("Content-Type: application/json"); 
 if(isset($_POST['username']) && isset($_POST['password'])){
// Check to see if the username and password are valid.  (You learned how to do this in Module 3.)
    $stmt = $mysqli->prepare("SELECT COUNT(*), id, password FROM users WHERE username=?");
    $username = $_POST['username'];
    $stmt->bind_param('s', $username);
	$stmt->execute();
	$stmt->bind_result($cnt, $user_id, $pwd_hash );
	$stmt->fetch();
	$pwd_guess = $_POST['password'];
if( $cnt == 1 && crypt($pwd_guess, $pwd_hash)==$pwd_hash ){
//	session_start();
	$_SESSION['username'] = $username;
	$_SESSION['token'] = substr(md5(rand()), 0, 10);
      // $("p2").show();
	echo json_encode(array(
		"success" => true,
	"username" =>	$username
	)
	//	$username;			 
					 );
	exit;
}else{
	echo json_encode(array(
		"success" => false,
		"message" => "Incorrect Username or Password",
		"username" =>"guest"
	));
	exit;
}
 }
?>
    
    