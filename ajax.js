


function loginAjax(event){
	event.preventDefault();

	var username = document.getElementById("username").value; // Get the username from the form
	var password = document.getElementById("password").value; // Get the password from the form


	// Make a URL-encoded string for passing POST data:
	var dataString = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);

	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "login_ajax.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.addEventListener("load", function(event) {
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		console.log(jsonData);
		if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
		alert("You've been Logged In!");
		$('#addEvent').removeClass("hide");
		$('#logout_btn').removeClass("hide");
		$('#login').addClass("hide");
		$('#register').addClass("hide");
		console.log("login success");
	}
	else{
		alert("You were not logged in.  " + jsonData.message);
		console.log("login failure");
	}
}, false); // Bind the callback to the load event
xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
xmlHttp.send(dataString); // Send the data
}

$("#login_btn").click(loginAjax);

function registerAjax(event){
	event.preventDefault();

	var new_username = document.getElementById("new_username").value; // Get the username from the form
	var new_password = document.getElementById("new_password").value; // Get the password from the form

	// Make a URL-encoded string for passing POST data:
	var dataString = "username=" + encodeURIComponent(new_username) + "&password=" + encodeURIComponent(new_password);

	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "register.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.addEventListener("load", function(event) {
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if (jsonData.success) { // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
		alert("You are registered!");
		console.log('registration success');
	} else {
		alert("You were not registered.  " + jsonData.message);
		console.log('registration failure');
	}
}, false); // Bind the callback to the load event
xmlHttp.send(dataString); // Send the data
}

document.getElementById("register_btn").addEventListener("click", registerAjax, false);


function addEventAjax(event){
	event.preventDefault();

	var eventName = document.getElementById("eventName").value;
	var eventDate = document.getElementById("eventDate").value;
	var eventTime = document.getElementById("eventTime").value;
	var token = document.getElementById('token').value;

	// Make a URL-encoded string for passing POST data:
	var dataString = "eventName=" + encodeURIComponent(eventName) + "&eventDate=" + encodeURIComponent(eventDate) + "&eventTime=" + encodeURIComponent(eventTime) + "&token=" + encodeURIComponent(token);
	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("POST", "add_event.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
	xmlHttp.addEventListener("load", function(event) {
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if (jsonData.success) { // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
		alert("You create a event successfully!");
		return true;
		 //console.log();
	} else {
		alert("Please check your event information again" + jsonData.message);
		return false;
	}
}, false); // Bind the callback to the load event
xmlHttp.send(dataString); // Send the data
}

document.getElementById("addEvent_btn").addEventListener("click", addEventAjax, false);

/*
function editEventAjax(event){
event.preventDefault();
var id = document.getElementById("id").value;
var eventName = document.getElementById("editName").value;
var eventDate = document.getElementById("editDate").value;
var	eventTime =  document.getElementById("editTime").value;

// Make a URL-encoded string for passing POST data:
var dataString = "id=" + encodeURIComponent(id) "&editName=" + encodeURIComponent(editName) + "&editDate=" + encodeURIComponent(editDate) + "&editTime=" + encodeURIComponent(editTime);
var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
xmlHttp.open("POST", "edit_event.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
xmlHttp.addEventListener("load", function(event) {
var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
if (jsonData.success) { // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
alert("You edit your event successfully!");
return true;
} else {
alert("Your event can not be edited" + jsonData.message);
return false;
}
}, false); // Bind the callback to the load event
xmlHttp.send(dataString); // Send the data
}

document.getElementById("editEvent_btn").addEventListener("click", editEventAjax, false);
*/

function logoutAjax(event){
	event.preventDefault();

	var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
	xmlHttp.open("GET", "logout.php", true);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
	xmlHttp.send(null); 
	xmlHttp.addEventListener("load", function(event) {
		var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
		if(jsonData.success){  // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
			console.log("logout success");
			$('#login').addClass("hide");
			$('#addEvent').addClass("hide");
			$('#logout_btn').addClass("hide");
			alert("You've been Logged Out!");
		}
		else{
			alert("You were not logged out.  " + jsonData.message);
		}
	}, false);
}


document.getElementById("logout_btn").addEventListener("click", logoutAjax, false);