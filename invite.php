<?php 
	$user_id = $_GET["user_id"]; //get the user_id from the GET
?>
<html>
<head>
<title>Invite</title>
</head>
<body>
<a href="lounge.php?user_id=<?php echo $user_id ?>"><-- Go back to the Lounge</a><br><br>
<form action="do_invite.php" method="get">
	<input type="hidden" name="user_id" value="<?php echo $user_id ?>"><br><br>
	<strong>Name of Guest:</strong>
		<input type="text" name="contestant" value=""></br></br>
	<strong>Link to Video(YouTube):</strong>
		<input type="text" name="video_url" value=""></br></br>
	<input type='submit' value='Invite' /><br /> 
</form>
</body>
</html>