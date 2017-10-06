<!DOCTYPE html>

<html>
<head><title>home</title>
</head>
<body>
<?php
session_start();
require 'database.php';
if(isset($_SESSION['user_id']))
{
	echo "Welcome to your calendar, ".$_SESSION['user_id']."!";
}else{
	echo "You need to sign in first to create a new event";
	header("Location: register.php");
}
?>


<div class = "addEvent">
<form name = "AddEvent"  id = "addEvent">
    eventname: <input type= "text" name = "eventname"><br>
    eventtime: <input type= "text" name = "eventtime"><br>
    eventday: <input type= "text" name = "eventday"><br>
    <button id="addEvent_btn">Add Event</button>
</form>
</div>

<div class = "editEvent">
<form name = "EditEvent" id = "editEvent"><br>
     id: <input type= "number" name = "id"><br>
     eventname: <input type= "text" name = "editname"><br>
     eventtime: <input type= "text" name = "edittime"><br>
	 eventday: <input type= "text" name = "editday"><br>
	 <button id="editEvent_btn">Edit Event</button>
</form>
</div>

</body>
</html>







