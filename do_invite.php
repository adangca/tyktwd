<?php

include 'db_connect.php';

doDB(); //connect to db

$user_id = $_GET["user_id"]; //get the user_id from the GET
$contestant_name = $_GET["contestant"];
$video_url = $_GET["video_url"];

//$sql_insert = "INSERT INTO test.contestants (name, num_votes, video_url) VALUES (' $contestant_name ', 0, ' $video_url ');";

mysqli_query($mysqliVar, "INSERT INTO test.contestants (name, num_votes, video_url) VALUES (' $contestant_name ', 0, ' $video_url ');");

mysqli_query($mysqliVar, "INSERT INTO test.users_contestants (user_id, contestant_id) VALUES ($user_id, LAST_INSERT_ID());");  //dirty hack

?>

<html>
<body>
	<strong>Invite successfully granted to: <font color="green"><?php echo $contestant_name ?></font></strong>
	<br><br>
	<a href="lounge.php?user_id=<?php echo $user_id ?>"><-- Go back to the Lounge</a><br>

</body>
</html>