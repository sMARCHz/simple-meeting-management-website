<?php
include("config.php");
session_start();
$idOfUser = $_SESSION['UserID'];
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
<title>Delete Conference</title>
<meta http-equiv=Content-Type content="text/html; charset=tis-620">
<link rel="icon" type="png" href="icon.png">
<?php
if (isset($_POST['meet'])) {
	// sql to delete a record
	foreach ($_POST['meet'] as $meet) {
		//mysqli_query($conn,"DELETE FROM SelectedMeeting  WHERE  MeetingID = $meet");

		$sqlPr1 = "SELECT SelectedMeeting.MeetingID, SelectedMeeting.UserID, SelectedMeeting.Priority, AllMeeting.Topic FROM AllMeeting INNER JOIN SelectedMeeting WHERE SelectedMeeting.MeetingID=$meet AND AllMeeting.MeetingID=$meet";
		$result2 = mysqli_query($conn, $sqlPr1);
		if (mysqli_num_rows($result2) > 0) {
			while ($rowZ1 = mysqli_fetch_assoc($result2)) {
				$sqlUse1 = "INSERT INTO `Message`(`SenderID`, `ReceiverID`,  `Head`,  `MeetingID`, `Topic`) VALUES ('" . $idOfUser . "','" . $rowZ1["UserID"] . "',\"ADMINSEND\",$meet,'" . $rowZ1["Topic"] . "')";
				$a1 = mysqli_query($conn, $sqlUse1);
			}
		}
		$strSQL = "DELETE FROM SelectedMeeting WHERE  MeetingID =$meet";
		$strSQL2 = "DELETE FROM AllMeeting WHERE  MeetingID =$meet";
		$objQuery = mysqli_query($conn, $strSQL);
		$objQuery2 = mysqli_query($conn, $strSQL2);
	}
}
if (mysqli_query($conn, $strSQL) and mysqli_query($conn, $strSQL2)) {

	echo "<head><meta http-equiv='Refresh'content = '0; URL =Remove_conference.php'></head>";
} else {
	echo "<br>";
	echo "Error deleting record : Please choose a conference you want to delete. ";
	echo "<head><meta http-equiv='Refresh'content = '5; URL =Remove_conference.php'></head>";
	mysqli_error($conn);
}

mysqli_close($conn);
?>

</html>