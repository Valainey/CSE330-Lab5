<?php
require 'database.php';
header("Content-Type: application/json");

if(isset($_POST['username']) && isset($_POST['password'])){

  $stmt = $mysqli->prepare("SELECT COUNT(*), id, password FROM users WHERE username=?");
  // Bind the parameter
  $username = $_POST['username'];
  $stmt->bind_param('s', $username);
  $stmt->execute();
  // Bind the results
  $stmt->bind_result($cnt, $user_id, $pwd_hash);
  $stmt->fetch();
  $pwd_guess = $_POST['password'];
  // Compare the submitted password to the actual password hash

  if($cnt == 1 && password_verify($pwd_guess, $pwd_hash)){
    session_start();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['token'] = substr(md5(rand()), 0, 10);

    echo json_encode(array(
      "success" => true,
      "username" => $_SESSION['user_id']
    ));
    exit;
  } else {
    echo json_encode(array(
      "success" => false,
      "message" => "Incorrect Username or Password"
    ));
    exit;
  }
}
?>