<script>
	//console.log("This is the original value: ", counter.value);
</script>
<?php
//phpinfo();
// Create connection
//should be globally created now
//require_once('defineConnection.php');
$con=mysqli_connect('tryglancetk.ipagemysql.com',"tryglancetk","Codebunnies12!","encounters_1");
//$con = mysql_pconnect('mysql15.000webhost.com','a8474629_world','codebunnies1');

// Check connection
if (mysqli_connect_errno($con))
  {
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
//$counter = $_POST["int_counter"];
//$posts = $_POST["postsToLoad"];
$id = $_POST["postIdToFetch"];
$id = mysqli_real_escape_string($con, $id);
$result = mysqli_query($con, "SELECT * FROM Encounters WHERE post_id = '$id'");

/*if ($counter==0)
{
	$result = mysqli_query($con,"SELECT * FROM Country LIMIT 50");
	//$counter=$counter+50;
}
else
{
	$result = mysqli_query($con,"SELECT * FROM Country LIMIT $counter,15");	
	//$counter=$counter+5;
}*/
while($row = mysqli_fetch_array($result))
{

 /* 
	NEED TO SWAP IN FOR HUNTER'S ENCOUNTER CARD DESIGN 
 */
 /*
	echo "<html><body><center>ENCOUNTER</center></body></html>";
	echo "Post ID: " . $row['post_id'];
	echo "<br>";
	echo "Name: " . $row['name'];
	$name=$row['name'];
	echo "<br>";
	echo "Sex: " . $row['sex'];
	echo "<br>";
	echo "Text Location: " . $row['textloc'];
	echo "<br>";
	echo "Description: " . $row['desc'];
	echo "<br>";
	echo "Tags: " . $row['tags'];
	echo "<br>";
	$info_type=$row['info_type'];
	$info=$row['info'];
	//echo "<html><button type=\"button\" onclick=\"alert('This guys name is: $name')\">HEART</button></html>";
	echo "<html><button type=\"button\" onclick=\"alert('$info_type : $info')\">HEART</button></html>";
	//echo "---------------------------------------------";
	//echo "<br>";
 	*/
 	/*echo "
 		<!-- <div class=\"encounterCardDiv\"> -->
			<div class=\"wrap\">
				<div class=\"fleft\">
					<div><img id=\"boygirl\" border=\"0\" src=\"logo_white.png\" alt=\"boygirl\"></div>
					<div id=\"name\"> &nbsp;";
					echo $row['name'];
					echo "</div>
					<div id=\"location\">&nbsp;";
					echo $row['textloc'];
					echo "</div>
					<div id=\"date\"> &nbsp;Jul 29 </div>
				</div>
				<div class=\"fright\">
					<div><img id=\"heart\" border=\"0\" src=\"heart.png\" alt=\"heart\" onclick=\"alert('";
					echo $row['info_type'];
					echo " : ";
					echo $row['info'];
					echo"'";
					echo ")\" ></div>
				</div>
			</div>
			<div id=\"description\">";
			echo $row['desc'];
			echo "</div>
			<div id=\"tags2\">";
			echo $row['tags'];
			echo "</div>
		<!-- </div> -->
		";*/
		
		$gender="male";
	if($row['sex']=="female")
	{
		$gender="female";
	}
 	echo "
 		<!-- <div class=\"encounterCardDiv\"> -->
			<div class=\"wrap\">
				<div class=\"fleft\">
					<div><img id=\"boygirl\" border=\"0\" src=\"";
					if($gender=="male")
					{
						echo "boy.jpg";
					}
					if($gender=="female")
					{
						echo "girl.jpg";
					}
					echo "\" alt=\"boygirl\"></div>
					<div id=\"name\"> &nbsp;";
					echo $row['name'];
					echo "</div>
					<div id=\"location\">&nbsp;";
					echo $row['textloc'];
					echo "</div>
					<div id=\"date\"> &nbsp";
					echo $row['postdate'];
					echo "</div>
				</div>
				<div class=\"fright\">";
					//$outputSTR = str_replace("/", "/", $row['info']);
					//add if for facebeook type
					if($row['info_type']=="facebook" || $row['info_type']=="website")
					{
						echo "<div><img id=\"heart\" border=\"0\" src=\"heart.png\" alt=\"heart\" onclick=\"location.href='";
						$pieces = explode("/", $row['info']);
						for($x=0;$x<sizeof($pieces);$x++)
						{
							echo $pieces[$x];
							echo '/';
						}
						//echo $row['info'];
						echo "'\"></div>";
					}
					else
					{
						echo "<div><img id=\"heart\" border=\"0\" src=\"heart.png\" alt=\"heart\" onclick=\"alert('";
						echo $row['info_type'];
						echo " : ";
						echo $row['info'];
						echo"'";
						echo ")\" >";
					}
				echo"</div>
			</div>
			<div id=\"description\">";
			echo $row['desc'];
			echo "</div>
			<div id=\"tags2\">";
			echo $row['tags'];
			echo "</div>
		<!-- </div> -->
		";
	 
}
  
mysqli_close($con);
?>



<style>
	.encounterCardDiv 
	{
		position: relative;
		width: 500px;
		background-color: white;
		border: 1px solid #767171;
		word-wrap: break-word;
		color:#404040;
		/*overflow: auto;*/
		/*EMERGENCY. ALL ALIGNMET TAGS DO NOT WORK*/
		/*WELL SHIT. WE'RE SINKING CAPTAIN, WE'RE SINKINGGGGGGG *glub glub glub */
	}
	
	#boygirl
	{
		float:left;
		margin-top:20px;
		margin-left:20px;
		width:50px; /* you can use % */
    	height:auto;
	}
	
	#name
	{
		color:#404040;
		font-size:12pt;
		font-weight:bold;
		margin-top:18px;
	}
	
	#location
	{
		color:#767171;
		font-size:10pt;
	}
	
	#date
	{
		color:#767171;
		font-size:10pt;
	}
	
	#description
	{
		border-left: 20px solid #FFFFFF;
		border-right: 20px solid #FFFFFF;
		/*border-top: 20px solid #FFFFFF;*/
		font-size:12pt;
	}
	
	#tags2
	{
		border-left: 20px solid #FFFFFF;
		border-right: 20px solid #FFFFFF;
		border-bottom: 20px solid #FFFFFF;
		font-size:12pt;
		background:#FFFFFF;
		color:#339900;
	}
	
	#heart
	{
		float:right;
		padding-right: 20px;
		padding-top: 20px;
		width:30px; /* you can use % */
    	height:auto;
    	cursor:pointer;
    }
    
    .wrap 
	{
		width: 100%;
		overflow:auto;
	}
	
	.fleft 
	{
    	float:left; 
    	height: 80px;
		background:white;
    	width: 70%;
	}

	.fright 
	{
		float: right;
    	background:white;
    	height: 80px;
    	width: 30%;
	}
	
</style>