 <?php 
include 'db_connect.php';

/*
* parse_youtube_url() PHP function
* Author: takien
* URL: http://takien.com
*
* @param string $url URL to be parsed, eg:
* http://youtu.be/zc0s358b3Ys,
* http://www.youtube.com/embed/zc0s358b3Ys
* http://www.youtube.com/watch?v=zc0s358b3Ys
* @param string $return what to return
* - embed, return embed code
* - thumb, return URL to thumbnail image
* - hqthumb, return URL to high quality thumbnail image.
* @param string $width width of embeded video, default 560
* @param string $height height of embeded video, default 349
* @param string $rel whether embeded video to show related video after play or not.
 
*/
 
function parse_youtube_url($url,$return='embed',$width='',$height='',$rel=0){
    $urls = parse_url($url);
 
    //url is http://youtu.be/xxxx
    if(false){ 
        $id = ltrim($urls['path'],'/');
    }
    //url is http://www.youtube.com/embed/xxxx
    else if(strpos($urls['path'],'embed') == 1){ 
        $id = end(explode('/',$urls['path']));
    }
     //url is xxxx only
    else if(strpos($url,'/')===false){
        $id = $url;
    }
    //http://www.youtube.com/watch?feature=player_embedded&v=m-t4pcO99gI
    //url is http://www.youtube.com/watch?v=xxxx
    else{
        parse_str($urls['query']);
        $id = $v;
        if(!empty($feature)){
            $id = end(explode('v=',$urls['query']));
        }
    }
    //return embed iframe
    if($return == 'embed'){
        return '</pre>
<iframe src="http://www.youtube.com/embed/'.$id.'" frameborder="0" width="'.($width?$width:560).'" height="'.($height?$height:349).'"></iframe>
<pre>';
    }
    //return normal thumb
    else if($return == 'thumb'){
        return 'http://i1.ytimg.com/vi/'.$id.'/default.jpg';
    }
    //return hqthumb
    else if($return == 'hqthumb'){
        return 'http://i1.ytimg.com/vi/'.$id.'/hqdefault.jpg';
    }
    // else return id
    else{
        return $id;
    }
}

doDB();  //make the DB connection

  $user_id = $_GET["user_id"]; //get the user_id from the GET

  $display_block = ""; //the html table to be constructed
  $display_videos = ""; //the html script for the embedded videos
					
  $get_items_sql = "SELECT id, name, num_votes, video_url FROM test.contestants ORDER by RAND();"; //be careful using RAND() if table gets large => Performance hit
								
  $get_items_res = mysqli_query($mysqliVar, $get_items_sql);
  
  //IF ONLY one contestant left, set the WINNERFOUND==true
  if (mysqli_num_rows($get_items_res)==1) {
	$display_block = "<p><em>A winner has been determined.</em></p>";	
  }
  else {
	$row_count = 0;
	while ($items = mysqli_fetch_array($get_items_res)) {
	
		$row_count = $row_count + 1;
		$item_id = $items['id'];
		$item_name = $items['name'];
		$item_num_votes = $items['num_votes'];
		$item_video_url = $items['video_url'];
		
		//$item_date = $items['testcase_date'];
		
		$display_block .= "<tr>";
		$display_block .= "<td>" . "ID: " . $row_count . "<td>" . "<a href=\"http://pdgtestlink/lib/testcases/archiveData.php?id=".$item_id. "<td>" . "&edit=testcase&allow_edit=0\">".$item_name."</a>";
		$display_block .= "<td>" . "&nbsp;".$item_num_votes;
		
		$display_block .= "<br>";
		
		//generate the embedded videos if URL exists:
		if($item_video_url!=null) {
			$display_videos .= parse_youtube_url($item_video_url);
		}
		
	}
	

	//free results
	//mysqli_free_result($get_items_res);

}

//close connection to MySQL
mysqli_close($mysqliVar);

?>
<html>
<head>
<title>Elimination</title>
</head>
<body>
<!DOCTYPE HTML>

<a href="lounge.php?user_id=<?php echo $user_id ?>"><-- Back to The Lounge</a>
<h2><font color="green">Setlist for This Round</font></h2>

<table border="1">
  <tr>
	<td><b>Position</b></td>
	<td><b><center>Contestant Name</center></b></td>
	<td><b>Haters</b></td>
	<!--- <td><b> - </b></td> !--->
	<!--- <td><b> - </b></td> !--->
	
  </tr>
<?php echo $display_block; ?>
</table>

<?php if($user_id!=-1) : ?>
	<p><a href="vote.php?user_id=<?php echo $user_id ?>">Vote Now!</a></p>
<?php endif; ?>

<?php echo $display_videos; ?>

</body>
</html>