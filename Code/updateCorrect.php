<?php
session_start();
include("config.php");
?>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update</title>
	<link rel="icon" type="png" href="icon.png">
</head>

<body>
	<?php
	if ($_SESSION['UserID'] == "") {
		echo "Please Login!<br>";
		echo "Go login page <a href=\"login.php\">Click Here</a>";
		exit();
	}
	if ($_SESSION['Rank'] != "User") {
		echo "This page for User only!";
		echo "Go login page <a href=\"login.php\">Click Here</a>";
		exit();
	}
	if (isset($_GET["m"]) && isset($_GET["u"])) {
		$MeetingID = $_GET["m"];
		$UserID = $_GET["u"];
	}
	$sql = "UPDATE SelectedMeeting SET SelectedMeeting.MeetConf=1 WHERE SelectedMeeting.MeetingID=$MeetingID and SelectedMeeting.UserID=$UserID ";
	if (mysqli_query($conn, $sql)) {
		//echo "Record updated successfully<br>";
		echo "<script>alert(\"Record updated successfully!\")</script>";
		echo "<head><meta http-equiv='Refresh'content = '0; URL =user.php'></head>";
		//echo "<a href=\"user.php\">Back</a>";
		//header("location:user.php");
		//$_SESSION['vuc']=1;
		exit;
		echo "<script>alert(\"Record updated successfully!55\")</script>";
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}
	mysqli_close($conn);
	?>
</body>

</html>