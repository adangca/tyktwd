<?php 
include 'db_connect.php';

doDB();  //make the DB connection

$get_users_sql = "SELECT id, login FROM Users ORDER BY login";
$get_users_res = mysqli_query($mysqliVar, $get_users_sql);

$display_users_block = ""; //use this variable to hold our html

while ($items = mysqli_fetch_array($get_users_res)) {
  $user_id = $items['id'];
  $user_login = $items['login'];
  $display_users_block .= "<option value=" .$items['id']. ">" .$items['login'];
}
  
$curYear = date('Y');

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login</title>
</head>
<body>
<form action="lounge.php" method="get">
	<strong>Login</strong></br></br>
	<strong>User:</strong>
	<select name="user_id">
		<?php echo $display_users_block; ?>
	</select>
	</br></br>

	<input type='submit' value='Login' /><br /> 
</form>
<p>
	<iframe width="420" height="345"
		src="http://www.youtube.com/embed/9bZkp7q19f0">
	</iframe>
</p>
</body>
</html>