<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Processing Encounter</title>
</head>
<?php
	error_reporting(-1);
	ini_set('error_reporting', E_ALL);
	
	//$con=mysqli_connect("host", "uname", "pass", "db")
	$con=mysqli_connect("tryglancetk.ipagemysql.com", "tryglancetk", "Codebunnies12!", "encounters_1");
	if(mysqli_connect_errno())
	{
		echo "Failed to connec to mySQL: " . mysqli_connect_error();
	}
	
	$name = $_POST["name"];
	$name = mysqli_real_escape_string($con, $name);
	$name = strip_tags($name);
	
	$sex = $_POST["sex"];
	$sex = mysqli_real_escape_string($con, $sex);
	$sex = mysqli_real_escape_string($con, $sex);
	
	$text_loc = $_POST["location"];
	$text_loc = mysqli_real_escape_string($con, $text_loc);
	$text_loc = strip_tags($text_loc);
	
	$oldDate = $_POST["date"];
	//DONT FORGET TO SET THE DATE TO TODAYS DATE IF NO DATE IS SUBMITTED. CANT FIGURE THIS OUT
	if(strlen((string)$oldDate) > 0)
	{
		$myDate = date("M d", strtotime($oldDate));
	}
	else
	{
		$myDate = date("M d");
	}
	$myDate = mysqli_real_escape_string($con, $myDate);
	$myDate = strip_tags($myDate);
	
	$desc = $_POST["description"];
	$desc = mysqli_real_escape_string($con, $desc);
	$desc = strip_tags($desc);
	
	$tags = $_POST["tags"];
	$tags = trim($tags);
	$tagsformatted = str_replace(' ', '', $tags);
	$tags_blasted = explode ("#", $tagsformatted);
	$tags_blasted = array_merge($tags_blasted, explode(" ",$text_loc));
	$tags = mysqli_real_escape_string($con, $tags);
	$tags = strip_tags($tags);
	
	switch($_POST["info_type"])
	{
		case "email":
			$info_type = "email";
		break;
		
		case "facebook":
			$info_type = "facebook";
		break;
		
		case "website":
			$info_type = "website";
		break;
		
		default:
			$info_type = "other";
		break;
	}
	$info_type = mysqli_real_escape_string($con, $info_type);
	$info = $_POST["info"];
	$info = mysqli_real_escape_string($con,$info);
	$info = strip_tags($info);
	
	
	$sql = "INSERT INTO Encounters VALUES (DEFAULT,'testip','$name','$sex','$myDate','$text_loc',0987,01234,'$desc','$tags','$info_type','$info')";
	
	if(!mysqli_query($con,$sql))
	{
		die('Error: ' . mysqli_error($con));
	}
	$post_id = mysqli_insert_id($con);
	
	for($c=0;$c<sizeof($tags_blasted);$c=$c+1)
	{
		$tags_blasted[$c] = mysqli_real_escape_string($con,$tags_blasted[$c]);
		$sql2 = "INSERT INTO Tags VALUES(DEFAULT,'$post_id','$tags_blasted[$c]')";		
		
		if(!mysqli_query($con,$sql2))
		{
			die('Error: ' . mysqli_error($con));
		}
	}
	mysqli_close($con);
	//and hopefully this should have added a record
?>

<!--This is where it refreshes to the success page-->
<script language="javascript">
	location.replace("livestream2.html");
</script>

<body>
</body>
</html>