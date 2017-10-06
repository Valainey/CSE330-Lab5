<?php
include_once('database.php');
header("Content-Type: application/json");


if(isset($_POST['username']) && isset($_POST['password'])){
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
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

  $stmt->bind_param('ss', $username, $password);

  $stmt->execute();
  $stmt->close();

  echo json_encode(array(
    "success" => true,
  ));
  exit;
  }
?>