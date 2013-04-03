<?php 
include 'db_connect.php';

doDB();  //make the DB connection

$user_id = $_GET["user_id"]; //get the user_id from the GET
$get_users_sql = "SELECT id, name FROM contestants ORDER BY name";
$get_users_res = mysqli_query($mysqliVar, $get_users_sql);

$display_contestants_block = ""; //use this variable to hold our html

while ($items = mysqli_fetch_array($get_users_res)) {
  $contestant_id = $items['id'];
  $contestant_name = $items['name'];
  $display_contestants_block .= "<option value=" .$items['id']. ">" .$items['name'];
}
  
$curYear = date('Y');

?>

<html>
<head>
<title>Vote</title>
</head>
<body>
<!--- <a href="lounge.php"><-- Back to The Lounge</a> --->
<p>
<form action="process_vote.php" method="get">
	<strong>Who would you like to vote off?:</strong>
	<input type="hidden" name="user_id" value="<?php echo $user_id ?>"><br><br>
	<select name="contestant_id">
		<?php echo $display_contestants_block; ?>
	</select>
	<input type='submit' value='Vote Off' /><br /> 
</form>
</p>
</body>
</html>