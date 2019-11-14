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
<title>Conclusion</title>
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
			width: 63vw;
			table-layout: fixed;
		}

		td,
		th {
			border: 1px solid #dddddd;
			text-align: center;
			padding: 8px;
			width: 10%;
			font-size: 1.5vw;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
		}

		td.red {
			border: 1px solid #dddddd;
			text-align: center;
			padding: 8px;
			width: 10%;
			font-size: 1.5vw;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
			background-color: #e8a0a3;
		}

		td a:hover {
			overflow: visible;
			text-overflow: inherit;
			word-break: break-all;
			white-space: normal;
		}

		td:hover {
			overflow: visible;
			text-overflow: inherit;
			word-break: break-word;
			white-space: normal;
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

		}

		.nav a.active {
			background-color: #172524;
			color: white;
		}

		.nav-right {
			float: right;
			font-family: Cordia New;
			font-size: 1.5vw;
		}

		.nav-right1 {
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
			width: 90%;
			/* Full-width */
			font-size: 1.5vw;
			/* Increase font-size */
			padding: 6px 10px 6px 20px;
			/* Add some padding */
			border: 1px solid #ddd;
			/* Add a grey border */
			margin-top: 5px;
			float: left;

		}

		.nav .icon {
			display: none;
		}

		@media only screen and (min-width : 150px) and (max-width : 780px) {

			table {
				margin-top: 20px;
				font-family: Cordia New;
				border-collapse: collapse;
				background-color: white;
				width: 100%;

			}

			.nav a:not(:first-child) {
				display: none;
			}

			.nav a.icon {
				float: right;
				display: block;
			}

			.nav.responsive {
				position: relative;
			}

			.nav.responsive a.icon {
				position: absolute;
				right: 0;
				top: 0;
			}

			.nav.responsive a {
				float: none;
				display: block;
				text-align: left;
			}

			.nav-right {
				display: none;
			}

			.nav-right.responsive {
				position: relative;
			}

			.nav-right.responsive {
				float: none;
				display: block;
				text-align: left;
			}

			.nav-right1.responsive {

				display: none;

			}

			#myInput {
				background-image: url('searchicon.png');
				/* Add a search icon to input */
				background-position: 10px 10px;
				/* Position the search icon */
				background-repeat: no-repeat;
				/* Do not repeat the icon image */
				background-size: 1.5vw;
				width: 100%;
				/* Full-width */
				font-size: 1.5vw;
				/* Increase font-size */
				padding: 6px 10px 6px 20px;
				/* Add some padding */
				border: 1px solid #ddd;
				/* Add a grey border */
				margin-top: 5px;
				float: left;
			}
		}
	</style>
	<script language="JavaScript">
		function toggle(source) {
			checkboxes = document.getElementsByName('con[]');
			for (var i = 0, n = checkboxes.length; i < n; i++) {
				checkboxes[i].checked = source.checked;
			}
		}

		function sbFunction() {
			// Declare variables 
			var input, filter, table, tr, td, i, txtValue;
			input = document.getElementById("myInput");
			filter = input.value.toUpperCase();
			table = document.getElementById("r");
			tr = table.getElementsByTagName("tr");

			// Loop through all table rows, and hide those who don't match the search query
			for (i = 0; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[1];
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

		function resFunction() {
			var x = document.getElementById("bar");
			if (x.className === "nav") {
				x.className += " responsive";
			} else {
				x.className = "nav";
			}
			var y = document.getElementById("bar1");
			if (y.className === "nav-right") {
				y.className += " responsive";
			} else {
				y.className = "nav-right";
			}
			var y = document.getElementById("bar2");
			if (y.className === "nav-right1") {
				y.className += " responsive";
			} else {
				y.className = "nav-right1";
			}
		}
	</script>

</head>

<body>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<center>

		<div class="nav" id="bar">
			<a href="admin.php"> Home </a>
			<a href="add_conferenceform.php"> Add conference</a>
			<a href="Remove_conference.php"> Remove conference </a>
			<a href="Add_remove_Document.php"> Add/Remove Document </a>
			<a class="active" href="Add_remove_Conclusion.php"> Add/Remove Conclusion </a>
			<div class="nav-right1" id="bar2">
				<input type="text" id="myInput" onkeyup="sbFunction()" placeholder="    Search conference">
			</div>
			<div class="nav-right" id="bar1">
				<a href="logout.php" onClick=\"return confirm('Are you sure to Logout?');\">Logout</a>
			</div>
			<a href="javascript:void(0);" class="icon" onclick="resFunction()">
				<i class="fa fa-bars"></i>
			</a>
		</div>
</body>

<body>
	<h1> Conclusion</h1>
	<?php



	$sqlSelect = "SELECT MeetingID,Topic,
		Date,Time,Place,Host,Doc_Link,Conclusion
		FROM `AllMeeting` WHERE CURRENT_DATE()<=AllMeeting.Date;";
	$sqlSelect2 = "SELECT MeetingID,Topic,
	Date,Time,Place,Host,Doc_Link,Conclusion
	FROM `AllMeeting` WHERE CURRENT_DATE()>AllMeeting.Date; ";
	$resultSelect = mysqli_query($conn, $sqlSelect);
	$resultSelect2 = mysqli_query($conn, $sqlSelect2);
	echo "<form  action=\"delete_Conclusion.php\" method=\"post\" >
		<table  id=\"r\"><tr><th>
		<input type=\"checkbox\" onClick=\"toggle(this)\">All<br></th>
		<th>Topic</th><th>Date</th><th>Time</th><th>Place</th><th>Host</th><th>Document</th><th>Conclusion</th><th>Status</th>";
	if (mysqli_num_rows($resultSelect) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($resultSelect2)) {

			$link = $row["Doc_Link"];
			$linkc = $row["Conclusion"];
			echo "<tr>
					
						<td  class=\"red\">
						<input type=\"hidden\" name=\"id\" value=" . $row["MeetingID"] . ">
						<input type=\"checkbox\" name=\"con[]\" id=\"document\" value=" . $row["MeetingID"] . "></td>
						
												<td class=\"red\">" . $row["Topic"] . "</td>
												<td  class=\"red\">" . $row["Date"] . "</td>
												<td class=\"red\">" . $row["Time"] . "</td>
												<td class=\"red\">" . $row["Place"] . "</td>
												<td class=\"red\">" . $row["Host"] . "</td>
												<td class=\"red\"><a  href=\"$link\" target=\"_blank\" >" . $row["Doc_Link"] . "</a></td>
												<td class=\"red\"><a  href=\"$linkc\" target=\"_blank\" >" . $row["Conclusion"] . "</a></td>
												<td class=\"red\">Expired</td></tr>";
		}
		while ($row = mysqli_fetch_assoc($resultSelect)) {

			$link = $row["Doc_Link"];
			$linkc = $row["Conclusion"];
			echo "<tr>
	
		<td>
		<input type=\"hidden\" name=\"id\" value=" . $row["MeetingID"] . ">
		<input type=\"checkbox\" name=\"con[]\" id=\"document\" value=" . $row["MeetingID"] . "></td>
		
								<td>" . $row["Topic"] . "</td><td>" . $row["Date"] . "</td><td>" . $row["Time"] . "</td><td>" . $row["Place"] . "</td><td>" . $row["Host"] . "</td>
								<td><a  href=\"$link\" target=\"_blank\" >" . $row["Doc_Link"] . "</a></td><td><a  href=\"$linkc\" target=\"_blank\" >" . $row["Conclusion"] . "</a></td>
								<td >Ongoing..</td></tr>";
		}
		echo "</table>";
	} else {
		echo "0 results";
	}
	echo "<br>";
	echo "<input type=\"button\" onclick=\"location.href='Add_Conclusion.php?variable=$variable2';\" value=\"ADD\" />";
	echo "<button type=\"submit\"  name=\"Submit\" value=\"submit\" onClick=\"return confirm('Are you sure to REMOVE?')\">Remove</button>"
		. "</form>";
	mysqli_close($conn);
	?>
	</center>
</body>

</html>