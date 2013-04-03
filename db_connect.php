<?php
//$display_string = "<p>\"Connecting to DB\"</p>";

function doDB() {
	
	global $mysqliVar;
	$mysqliVar = mysqli_connect("localhost", "root", "", "test");
	mysqli_select_db($mysqliVar, "test");
	
	//if connection fails, stop script execution
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	else {
		//printf("Success!!!");
	}
	
}


?>
