<?php

include 'db_connect.php';

doDB(); //connect to db

$user_id = $_GET["user_id"];

$contestant_id = $_GET["contestant_id"]; //get the contestant from the GET

mysqli_query($mysqliVar, "UPDATE test.contestants SET num_votes = num_votes + 1 WHERE id = '".$contestant_id."'");

?>

<html>
<body>
	<strong>Your vote has been successfully processed!</strong>
</body>

<p><a href="lounge.php?user_id=<?php echo $user_id ?>"><-- Go back to the Lounge</a></p>
</html>