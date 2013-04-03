 <?php 
include 'db_connect.php';

doDB();  //make the DB connection


  $user_id = $_GET["user_id"]; //get the user_id from the GET

  
  //flag for when Elimination results are ready to be posted
  $ready_to_eliminate = true;  //will change this later ....
  

  //$display_block = "<h1>The Council Has Spoken</h1>";
  $display_block = ""; //the html table to be constructed
					
  $get_items_sql = "SELECT id, name, num_votes, video_url FROM test.contestants ORDER by num_votes ASC;";
								
  $get_items_res = mysqli_query($mysqliVar, $get_items_sql);
				
  if (mysqli_num_rows($get_items_res)<1) {
	$display_block = "<p><em>No Contestants have been invited.</em></p>";	
  }
  else {
	$count = 0;
	
	while ($items = mysqli_fetch_array($get_items_res)) {
		$count = $count + 1;
		
		$item_id = $items['id'];
		$item_name = $items['name'];
		$item_num_votes = $items['num_votes'];
		$item_video_url = $items['video_url'];
		
		
		$display_block .= "<tr>";
		$display_block .= "<td>" . "" . $count . "<td>" . "<a href=\"" .$item_video_url. "\" target=\"_blank\">".$item_name."</a>";
		$display_block .= "<td>" . "&nbsp;".$item_num_votes;
	
		$display_block .= "<br>";
	}
	

	//free results
	mysqli_free_result($get_items_res);

}

//close connection to MySQL
mysqli_close($mysqliVar);

?>
<html>
<head>
<title>The LOUNGE</title>
</head>
<body>
<h1>The Lounge</h1>
<?php if($user_id!=-1) : ?>
	<p><h2><a href="invite.php?user_id=<?php echo $user_id ?>">Invite a Guest --></a><h2></p>
<?php endif; ?>
<h2><font color="green">Voting So Far</font></h2>

<table border="1">
  <tr>
	<td><b>Rank</b></td>
	<td><b><center>Contestant Name</center></b></td>
	<td><b>Number of Haters</b></td>
	<!--- <td><b> - </b></td> !--->
	<!--- <td><b> - </b></td> !--->
	
  </tr>
<?php echo $display_block; ?>
</table>
<p>
	<a href="./setlist_random.php?user_id=<?php echo $user_id ?>">View the Setlist</a><br>
</p>

<?php if($ready_to_eliminate) : ?>
   <h1>All votes have been cast!</h1>
   <p><a href="elimination.php?user_id=<?php echo $user_id ?>">Go to Tribal Council --></a></p>
<?php else : ?>
   There are Still Votes to be Cast.
<?php endif; ?>

</body>
</html>