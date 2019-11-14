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
		if($_SESSION['UserID'] == ""){
			echo "Please Login!<br>";
			echo "Go login page <a href=\"login.php\">Click Here</a>";
			exit();
		}

		if($_SESSION['Rank'] != "User"){
			echo "This page for User only!";
			echo "Go login page <a href=\"login.php\">Click Here</a>";
			exit();
		}	
		if(isset($_GET["m"]) && isset($_GET["u"])){
			$MeetingID = $_GET["m"];
			$UserID = $_GET["u"];
		}
		$sqlPr1 = "SELECT MeetingID, UserID, Priority FROM SelectedMeeting WHERE SelectedMeeting.MeetingID='".$MeetingID."'";
		$sqlPr = "SELECT MeetingID, UserID, Priority FROM SelectedMeeting WHERE SelectedMeeting.MeetingID='".$MeetingID."' and SelectedMeeting.UserID='".$UserID."'";
		$sqlPr13 = "SELECT UserID FROM AllUser WHERE Rank=\"ADMIN\"";
		$result1 = mysqli_query($conn, $sqlPr);
		$result2 = mysqli_query($conn, $sqlPr1);
		$result23 = mysqli_query($conn, $sqlPr13);
		if (mysqli_num_rows($result1)>0) 		
		$rowX = mysqli_fetch_assoc($result1);
		if($rowX["Priority"]=="A"){
			if (mysqli_num_rows($result2)>0){ 		
				while($rowZ = mysqli_fetch_assoc($result2)){
					$sqlUse = "INSERT INTO `Message`(`SenderID`, `ReceiverID`,  `Head`,  `MeetingID`) VALUES ($UserID,'".$rowZ["UserID"]."',\"CANCEL_PRIORITY\",$MeetingID)";
					$a=mysqli_query($conn, $sqlUse);
				}
			}
			if (mysqli_num_rows($result23)>0){ 		
				while($rowZ1 = mysqli_fetch_assoc($result23)){
					$sqlUse1 = "INSERT INTO `Message`(`SenderID`, `ReceiverID`,  `Head`,  `MeetingID`) VALUES ($UserID,'".$rowZ1["UserID"]."',\"CANCEL_TO_ADMIN\",$MeetingID)";
					$a1=mysqli_query($conn, $sqlUse1);
				}
			}
			$sqlDL = "DELETE FROM SelectedMeeting WHERE SelectedMeeting.MeetingID='".$MeetingID."'";
		    if(mysqli_query($conn, $sqlDL));
		}
		if($rowX["Priority"]=="B"){
			if (mysqli_num_rows($result23)>0){ 		
				while($rowZ1 = mysqli_fetch_assoc($result23)){
					$sqlUse1 = "INSERT INTO `Message`(`SenderID`, `ReceiverID`,  `Head`,  `MeetingID`) VALUES ($UserID,'".$rowZ1["UserID"]."',\"CANCEL_TO_ADMIN_B\",$MeetingID)";
					$a1=mysqli_query($conn, $sqlUse1);
				}
			}
		}
		$sql = "UPDATE SelectedMeeting SET SelectedMeeting.MeetConf=-1 WHERE SelectedMeeting.MeetingID='".$MeetingID."' and SelectedMeeting.UserID='".$UserID."'";
		if(mysqli_query($conn, $sql)){
			/*echo "Record updated successfully<br>";
			echo "<a href=\"user.php\">Back</a>";*/
			echo"<head><meta http-equiv='Refresh'content = '0; URL =user.php'></head>";
			//header("location:user.php");
			echo "<script>alert(\"Record updated successfully!\")</script>";
    		exit;
		} 
		else{
			echo "Error updating record: " . mysqli_error($conn);
		}
		mysqli_close($conn);
	?>
</body>
</html>