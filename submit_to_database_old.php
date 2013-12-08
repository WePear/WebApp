<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Processing Encounter</title>
</head>
<?php
	//$con=mysqli_connect("host", "uname", "pass", "db")
	$con=mysqli_connect("tryglancetk.ipagemysql.com", "tryglancetk", "Codebunnies12!", "encounters_1");
	if(mysqli_connect_errno())
	{
		echo "Failed to connec to mySQL: " . mysqli_connect_error();
	}
	
	$name = $_POST["name"];
	$sex = $_POST["sex"];
	$text_loc = $_POST["location"];
	$tags = $_POST["tags"];
	//$geo_loc = API SHIT TO $text_loc
	//$tags= $_Post["tags"];
	$desc = $_POST["description"];
	$desc = mysqli_real_escape_string($con, $desc);
	$tagsformatted = str_replace(' ', '', $tags);
	$tags_blasted = explode ("#", $tagsformatted);
	$tags_blasted = array_merge($tags_blasted, explode(" ",$text_loc));
	$info_type = $_POST["info_type"];
	$info = $_POST["info"];
	$sql = "INSERT INTO Encounters VALUES (DEFAULT,'testip','$name','$sex','$text_loc',0987,01234,'$desc','$tags','$info_type','$info')";
	/*for($c=0;$c<sizeof($tags_blasted);$c=$c+1)
	{
		//FIND INCREMENTATION
		$sql2 = "INSERT INTO Tags VALUES(DEFAULT,3,'$tags_blasted[$c]')";
	}*/
	//INSERT INTO Persons (field1,field2,etc) VALUES (value1,value2,value3)
	if(!mysqli_query($con,$sql))
	{
		die('Error: ' . mysqli_error($con));
	}
	$post_id = mysqli_insert_id($con);
	
	for($c=0;$c<sizeof($tags_blasted);$c=$c+1)
	{
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
	location.replace("index.html");
</script>

<body>
</body>
</html>