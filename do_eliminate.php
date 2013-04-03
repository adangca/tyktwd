<?php

include 'db_connect.php';

doDB(); //connect to db
$user_id = $_GET["user_id"];

$contestant_id = $_GET["contestant_id"]; //get the contestant to delete

//Delete the contestant that was voted off
mysqli_query($mysqliVar, "DELETE FROM test.contestants WHERE id = $contestant_id;");

//Reset the voting tally for the 'Survivors'
mysqli_query($mysqliVar, "UPDATE test.contestants SET num_votes=0");

?>
<html>
<body>
<h1>Votes and Contestants have been reset for the next round.<h1>
<br>
<p><a href="setlist_random.php?user_id=<?php echo $user_id ?>">View the Setlist for the Next Round --></a></p>
</body>
</html>