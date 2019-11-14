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
<title>Delete Document</title>
<meta http-equiv=Content-Type content="text/html; charset=tis-620">
<link rel="icon" type="png" href="icon.png">
<?php
$checker = 0;
if (isset($_POST['doc'])) {
	// sql to delete a record
	foreach ($_POST['doc'] as $doc) {
		//mysqli_query($conn,"DELETE FROM SelectedMeeting  WHERE  MeetingID = $meet");

		$strSQL2 = "UPDATE AllMeeting SET `Doc_Link`=NULL WHERE MeetingID=$doc";
		$objQuery2 = mysqli_query($conn, $strSQL2);
		$checker = 1;
	}
}
if ($checker == 1) {

	echo "<head><meta http-equiv='Refresh'content = '0; URL =Add_remove_Document.php'></head>";
} else if ($checker == 0) {
	echo "<br>";
	echo "Error deleting record : Please choose a document you want to delete. ";
	echo "<head><meta http-equiv='Refresh'content = '5; URL =Add_remove_Document.php'></head>";
	mysqli_error($conn);
}

mysqli_close($conn);
?>

</html>