<?php
//phpinfo();
// Create connection
$con = mysqli_connect('tryglancetk.ipagemysql.com', "tryglancetk", "Codebunnies12!", "encounters_1");

// Check connection
if (mysqli_connect_errno($con)) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$tags = $_POST['tags'];
$location = $_POST['location'];
$location = mysqli_real_escape_string($con,$location);
$mahIDS = array();
$locationIDS = array();

if (sizeof($tags) > 0) {
	for ($i = 0; $i < sizeof($tags); $i++) {
		$tags[$i] = mysqli_real_escape_string($con, $tags[$i]);	
		$str = "SELECT post_id FROM Tags WHERE tag = '$tags[$i]'";
		$result = mysqli_query($con, $str);
		while ($row = mysqli_fetch_array($result)) {
			array_push($mahIDS, $row['post_id']);
		}
	}
} else {	
	$str = "SELECT post_id FROM Encounters";
	$result = mysqli_query($con, $str);
	while ($row = mysqli_fetch_array($result)) {
		array_push($mahIDS, $row['post_id']);
	}
}

if (strlen($location) > 1) {
	$location = mysqli_real_escape_string($location); //preventing SQl injections?	
	$str = "SELECT post_id FROM Encounters WHERE textloc LIKE '%{$location}%'";//the %'s are so anything can be around the location
	$result = mysqli_query($con, $str);
	while ($row = mysqli_fetch_array($result)) {
		array_push($locationIDS, $row['post_id']);
	}
	$pairedIDS = array_intersect($mahIDS, $locationIDS);
} else {
	$pairedIDS = $mahIDS;
}

sort($pairedIDS, SORT_NUMERIC);
$resultArray = array_unique($pairedIDS, SORT_NUMERIC);
//array unique doesn't like comparing strings when the array is full of numbers
echo json_encode($resultArray);
mysqli_close($con);
?>