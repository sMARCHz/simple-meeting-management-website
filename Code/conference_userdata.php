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
include("notifi.php");
$sqlSelectE = "SELECT SenderID, ReceiverID, SendingTime, Head, MSID, MeetingID FROM Message WHERE ReceiverID='" . $_SESSION['UserID'] . "'";
$resultSelectE = mysqli_query($conn, $sqlSelectE);
if (mysqli_num_rows($resultSelectE) > 0) {
	while ($rowX = mysqli_fetch_assoc($resultSelectE)) {
		if ($rowX["Head"] == "CENCEL_PRIORITY" || $rowX["Head"] == "CANCEL_TO_ADMIN") {
			$sqlUser = "SELECT Topic,Date,Time,Place FROM AllMeeting WHERE MeetingID='" . $rowX["MeetingID"] . "'";
			$resultUser = mysqli_query($conn, $sqlUser);
			if (mysqli_num_rows($resultUser) > 0) {
				$obj = mysqli_fetch_assoc($resultUser);
			}
			$sqlUser1 = "SELECT UserID,Name,Last_Name FROM AllUser WHERE UserID='" . $rowX["SenderID"] . "'";
			$resultUser1 = mysqli_query($conn, $sqlUser1);
			if (mysqli_num_rows($resultUser1) > 0) {
				$obj1 = mysqli_fetch_assoc($resultUser1);
			}
			echo "<div id=\"MessageBox\">	
				<h4>Meeting's Priority Chairman  '" . $obj1["Name"] . " " . $obj1["Last_Name"] . "' has denied meeting'" . $obj["Topic"] . " " . $obj["Date"] . " " . $obj["Time"] . " " . $obj["Place"] . "' Please Check The Meeting</h4>
				<a onClick=\"this.parentElement.style.display='none';\" class=\"close\">OK</a>
				</div>";
			//echo "<script>alert(\"Meeting's Priority Chairman '".$obj1["Name"]." ".$obj1["Last_Name"]."' has denied meeting '".$obj["Topic"]." ".$obj["Date"]." ".$obj["Time"]." ".$obj["Place"]."' Please Check The Meeting \")</script>";
			$sqlUser2 = "DELETE FROM Message WHERE MSID='" . $rowX["MSID"] . "'";
			$resultUser2 = mysqli_query($conn, $sqlUser2);
		}
		if ($rowX["Head"] == "CANCEL_TO_ADMIN_B") {
			$sqlUser = "SELECT Topic,Date,Time,Place FROM AllMeeting WHERE MeetingID='" . $rowX["MeetingID"] . "'";
			$resultUser = mysqli_query($conn, $sqlUser);
			if (mysqli_num_rows($resultUser) > 0) {
				$obj = mysqli_fetch_assoc($resultUser);
			}
			$sqlUser1 = "SELECT UserID,Name,Last_Name FROM AllUser WHERE UserID='" . $rowX["SenderID"] . "'";
			$resultUser1 = mysqli_query($conn, $sqlUser1);
			if (mysqli_num_rows($resultUser1) > 0) {
				$obj1 = mysqli_fetch_assoc($resultUser1);
			}
			echo "<div id=\"MessageBox\">	
				<h4>Meeting's Priority Director  '" . $obj1["Name"] . " " . $obj1["Last_Name"] . "' has denied meeting'" . $obj["Topic"] . " " . $obj["Date"] . " " . $obj["Time"] . " " . $obj["Place"] . "' Please Check The Meeting</h4>
				<a onClick=\"this.parentElement.style.display='none';\" class=\"close\">OK</a>
				</div>";
			//echo "<script>alert(\"Meeting's Priority Chairman '".$obj1["Name"]." ".$obj1["Last_Name"]."' has denied meeting '".$obj["Topic"]." ".$obj["Date"]." ".$obj["Time"]." ".$obj["Place"]."' Please Check The Meeting \")</script>";
			$sqlUser2 = "DELETE FROM Message WHERE MSID='" . $rowX["MSID"] . "'";
			$resultUser2 = mysqli_query($conn, $sqlUser2);
		}
	}
}
?>
<html>
<title>Participants</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv=Content-Type content="text/html; charset=tis-620">
<link rel="icon" type="png" href="icon.png">

<head>
	<style>
		body {
			margin: 0px;
			background-color: #FEFFFF;
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			background-attachment: fixed;
			width: 100%;
			z-index: -2;
		}

		table {
			margin-top: 20px;
			font-family: Cordia New;
			border-collapse: collapse;
			background-color: white;
			width: 60vw;
		}

		td,
		th {
			border: 1px solid #dddddd;
			text-align: center;
			padding: 8px;
			width: 10%;
			height: 30%;
			font-size: 1.5vw;
			font-family: Cordia New;
		}

		input {
			font-size: 1.5vw;
			font-family: Cordia New;
		}

		button {
			font-size: 1.5vw;
			font-family: Cordia New;
		}

		tr:nth-child(even) {
			background-color: #DEF2F1;
		}

		.icon {
			width: 20%;
			height: auto;
			cursor: pointer;
		}

		.nav {
			overflow: hidden;
			background-color: #3AAFA9;
			width: 100%;
			position: sticky;
			top: 0px;
		}

		.nav a {
			float: left;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
			font-family: Cordia New;
			font-size: 1.5vw;

		}

		.nav a:hover {
			background-color: #ddd;
			color: black;
			font-family: Cordia New;
			font-size: 1.5vw;
		}

		.nav a.active {
			background-color: #172524;
			color: white;
			font-family: Cordia New;
			font-family: Cordia New;
			font-size: 1.5vw;
		}

		a {
			text-decoration: none;
			color: black;
			font-family: Cordia New;
			font-size: 1.5vw;
		}

		.nav-right {
			float: right;
			font-family: Cordia New;
			font-size: 1.5vw;
		}

		h1 {
			font-family: Cordia New;
			font-size: 5vw;
			margin: 4px;
		}

		#myInput {
			background-image: url('searchicon.png');
			/* Add a search icon to input */
			background-position: 10px 10px;
			/* Position the search icon */
			background-repeat: no-repeat;
			/* Do not repeat the icon image */
			background-size: 1.5vw;
			width: 70%;
			/* Full-width */
			font-size: 1.5vw;
			/* Increase font-size */
			padding: 6px 10px 6px 20px;
			/* Add some padding */
			border: 1px solid #ddd;
			/* Add a grey border */
			margin-top: 5px;
			margin-right: 5px;
			float: right;

		}

		@media only screen and (min-width : 150px) and (max-width : 780px) {

			table {
				margin-top: 20px;
				font-family: Cordia New;
				border-collapse: collapse;
				background-color: white;
				width: 100%;

			}

			#myInput {
				background-image: url('searchicon.png');
				/* Add a search icon to input */
				background-position: 10px 10px;
				/* Position the search icon */
				background-repeat: no-repeat;
				/* Do not repeat the icon image */
				background-size: 1.5vw;
				width: 60%;
				/* Full-width */
				font-size: 1.5vw;
				/* Increase font-size */
				padding: 6px 10px 6px 20px;
				/* Add some padding */
				border: 1px solid #ddd;
				/* Add a grey border */
				margin-top: 5px;
				float: right;
			}
		}
	</style>

	<script language="JavaScript">
		function toggle(source) {
			checkboxes = document.getElementsByName('user[]');
			for (var i = 0, n = checkboxes.length; i < n; i++) {
				checkboxes[i].checked = source.checked;
			}
		}
	</script>
	<script>
		function sbFunction() {
			// Declare variables 
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput");
			filter = input.value.toUpperCase();
			table = document.getElementById("r");
			tr = table.getElementsByTagName("tr");

			// Loop through all table rows, and hide those who don't match the search query
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[2];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}
	</script>
</head>

<body>
	<div class="nav" id="bar">
		<a class="active" href="admin.php"> Home </a>
		<div class="nav-right">
			<input type="text" id="myInput" onkeyup="sbFunction()" placeholder="    Search conference">
			<a href="logout.php" onClick=\"return confirm('Are you sure to Logout?');\">Logout</a>
		</div>
	</div>
</body>

<body>
	<center>
		<h1> Participants</h1>

		<?php

		function idont($something)
		{ }
		if (isset($_GET['variable'])) {
			$variable2 = $_GET['variable'];
			echo "Your MeetingID = " . $variable2;
		}
		$sqlSelect = "SELECT AllUser.UserID,AllUser.Email,
		AllUser.Name,AllUser.Last_Name,AllUser.Position,
		SelectedMeeting.Priority,SelectedMeeting.MeetConf 
		FROM `SelectedMeeting` 
		INNER JOIN AllUser ON AllUser.UserID=SelectedMeeting.UserID 
		WHERE SelectedMeeting.MeetingID=$variable2 AND SelectedMeeting.MeetConf=1";
		$resultSelect = mysqli_query($conn, $sqlSelect);

		echo "<form  action=\"delete_user.php\" method=\"post\" > 
	<table id=\"r\"><tr><th><input type=\"checkbox\" onClick=\"toggle(this)\">All<br></th><th>UserID</th><th>Name</th><th>Last Name</th><th>Email</th><th>Position</th><th>Priority</th>";
		if (mysqli_num_rows($resultSelect) > 0) {
			// output data of each Message
			while ($Message = mysqli_fetch_assoc($resultSelect)) {
				if ($Message["Priority"] == "A") {
					$priority = "Chairman";
				} else if ($Message["Priority"] == "B") {
					$priority = "Director";
				} else if ($Message["Priority"] == "C") {
					$priority = "Participant";
				}
				echo "<tr>
						<td>
						<input type=\"hidden\" name=\"id\" value=" . $Message["UserID"] . ">
						<input type=\"checkbox\" name=\"user[]\" id=\"userid\" value=" . $Message["UserID"] . "></td>
						
						<td>" . $Message["UserID"] . "</td><td>" . $Message["Name"] . "</td><td>" . $Message["Last_Name"] . "</td><td>" . $Message["Email"] . "</td><td>" . $Message["Position"] . "</td><td>" . $priority . "</td></tr>";
			}
			echo "</table>";
		}
		echo "<br>";
		echo "<input align=\"bottom\" id=\"somebutton\"  type=\"button\" onclick=\"location.href='Add_user.php?variable=$variable2';\" value=\"ADD\" />";
		echo "<button align=\"bottom\" type=\"submit\"  name=\"Submit\" value=\"submit\" onClick=\"return confirm('Are you sure to REMOVE?')\">Remove</button>";
		echo "</form>";


		mysqli_close($conn);
		?>
	</center>
</body>

</html>