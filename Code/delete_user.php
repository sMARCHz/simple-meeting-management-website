<?php
include("config.php");
session_start();
if ($_SESSION['UserID'] == "") {
	echo "Please Login!<br>";
	echo "Go login page <a href=\"login.php\">Click Here</a>";
	exit();
}
if ($_SESSION['Rank'] != "ADMIN") {
	echo "This page for Admin only!";
	echo "Go login page <a href=\"login.php\">Click Here</a>";
	exit();
}
?>
<html>
<title>Delete User</title>
<meta http-equiv=Content-Type content="text/html; charset=tis-620">
<link rel="icon" type="png" href="icon.png">
<?php
if (isset($_POST['user'])) {
	// sql to delete a record
	$checker = 0;
	foreach ($_POST['user'] as $user) {
		$strSQL = "DELETE FROM SelectedMeeting WHERE  UserID =$user";
		$objQuery = mysqli_query($conn, $strSQL);
		$checker = 1;
	}
}
if ($checker == 1) {
	echo "<head><meta http-equiv='Refresh'content = '0; URL =admin.php'></head>";
} else if ($checker == 0) {
	echo "<br>";
	echo "Error deleting record : Please choose a user you want to delete. ";
	echo "<head><meta http-equiv='Refresh'content = '5; URL =admin.php'></head>";
	mysqli_error($conn);
}

mysqli_close($conn);
?>

</html>