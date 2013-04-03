 <?php 
include 'db_connect.php';

doDB();  //make the DB connection

$user_id = $_GET["user_id"]; //get the user_id from the GET

  //$contestant_eliminated_hater_count = -1;  //init
  //$contestant_eliminated_name = ""; //init
  
  //$display_block = "<h1>The Council Has Spoken</h1>";
  $display_block = ""; //the html table to be constructed
					
  $get_items_sql = "SELECT id, name, num_votes FROM test.contestants ORDER by num_votes DESC;";
								
  $get_items_res = mysqli_query($mysqliVar, $get_items_sql);
  
  //get the row containing the eliminated contestant (i.e the first row)
  mysqli_data_seek($get_items_res, 0);
  $first_row = mysqli_fetch_assoc($get_items_res);
  $contestant_eliminated_id = $first_row['id'];
  $contestant_eliminated_name = $first_row['name'];
  $contestant_eliminated_hater_count =$first_row['num_votes'];
				
  if (mysqli_num_rows($get_items_res)<1) {
	$display_block = "<p><em>No Contestants have been invited.</em></p>";	
  }
  else {
	while ($items = mysqli_fetch_array($get_items_res)) {
	
		$item_id = $items['id'];
		$item_name = $items['name'];
		$item_num_votes = $items['num_votes'];
		
		//$item_date = $items['testcase_date'];
		
		$display_block .= "<tr>";
		$display_block .= "<td>" . "ID: " . $item_id . "<td>" . "<a href=\"http://pdgtestlink/lib/testcases/archiveData.php?id=".$item_id. "<td>" . "&edit=testcase&allow_edit=0\">".$item_name."</a>";
		$display_block .= "<td>" . "&nbsp;".$item_num_votes;
		

		//$display_block .= "<td>";
		//	foreach ($fbcase_list as $value) {
		//		$display_block .= "<a href=\"http://pdg.claritysystems.com/default.asp?".trim($value)."\">".trim($value)."</a>&nbsp";
		//	}
			
		//$display_block .= "<td>" . "&nbsp;";
		//$display_block .= "<td>" . "&nbsp;".$item_date;
		
		//} else {
		//	$display_block .= "<td>" . "&nbsp;<a href=\"http://pdg.claritysystems.com/default.asp?".$item_fogbugz."\">".$item_fogbugz."</a>";
		//}
		
		
		
		
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
<title>Elimination</title>
</head>
<body>
<a href="lounge.php?user_id=<?php echo $user_id ?>"><- Back to The Lounge</a>
<h1>The Council Has Spoken</h1>
<h1><font color="red">"<?php echo $contestant_eliminated_name ?>"</font> has been hated OUT with <font color="red"><?php echo $contestant_eliminated_hater_count ?></font> Haters!!!</h1>
<h2><font color="green">LUCKY SURVIVORS</font></h2>

<table border="1">
  <tr>
	<td><b>ID</b></td>
	<td><b><center>Contestant Name</center></b></td>
	<td><b>Number of Haters</b></td>
	<!--- <td><b> - </b></td> !--->
	<!--- <td><b> - </b></td> !--->
	
  </tr>
<?php echo $display_block; ?>
</table>

<?php


?>

<p><a href="do_eliminate.php?user_id=<?php echo $user_id ?>&contestant_id=<?php echo $contestant_eliminated_id ?>">Start The Next Round!</a></p>
</body>
</html>