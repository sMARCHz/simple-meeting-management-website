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

<title>Add Paticipants</title>
<link rel="icon" type="png" href="icon.png">

<head>
	<title> People </title>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv=Content-Type content="text/html; charset=tis-620">
	<script language="JavaScript">
		function toggle(source) {
			checkboxes = document.getElementsByName('userid[]');
			for (var i = 0, n = checkboxes.length; i < n; i++) {
				checkboxes[i].checked = source.checked;
			}
		}
	</script>

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
			font-size: 1.5vw;
		}

		.nav a:hover {
			background-color: #ddd;
			color: black;
		}

		.nav a.active {
			background-color: #172524;
			color: white;
			font-family: Cordia New;
		}

		a {
			text-decoration: none;
			color: black;
		}

		select {
			font-size: 1.5vw;
			font-family: Cordia New;
		}

		.nav-right {
			float: right;
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
	</script>

	<script language="javascript">
		>
		var foo = document.getElementById('btncheck');
		if (foo) {
			if (foo.selectedIndex == '1') {
				alert('Please select priority');
			}
		}
	</script>
</head>

<body>
	<div class="nav" id="bar">
		<a class="active" href="admin.php"> Home </a>
		<div class="nav-right">

			<input type="text" id="myInput" onkeyup="sbFunction()" placeholder="    Search for user">
			<a href="logout.php" onClick=\"return confirm('Are you sure to Logout?');\">Logout</a>
		</div>

	</div>
</body>

<body>
	<center>
		<h1> Add Participants</h1>
		<?php

		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		require 'PHPMailer-master/src/Exception.php';
		require 'PHPMailer-master/src/PHPMailer.php';
		require 'PHPMailer-master/src/SMTP.php';
		function displayRow($Name, $Last_Name, $Position, $Email)
		{
			if ($meetcon == 1) {
				echo "<tr><td></td><td></td><td>" . $Name . "</td><td>" . $Last_Name . "</td><td>" . $Position . "</td><td>" . $Email . "</td></tr>";
				return false;
			} elseif ($meetcon == 0) {
				return true;
			}
		}
		// ..........................................................................................................
		//.............................................................................................................
		// ..........................................................................................................
		//.............................................................................................................
		$emailnotsend = array();
		$allmail = array();
		$idprifix = array();
		$mailArray = array();
		$sqlSelectPrifix = "SELECT Name,Last_Name,Position,Email,UserID FROM AllUser WHERE UserID <> ALL (SELECT UserID FROM SelectedMeeting WHERE SelectedMeeting.MeetingID='" . $_POST["custId"] . "' AND (SelectedMeeting.MeetConf=0 OR SelectedMeeting.MeetConf=1) )";
		$resultSelectPrifix = mysqli_query($conn, $sqlSelectPrifix);
		if (mysqli_num_rows($resultSelectPrifix) > 0) {
			while ($rowprifix = mysqli_fetch_assoc($resultSelectPrifix)) {
				array_push($idprifix, $rowprifix["UserID"]);
				array_push($allmail, $rowprifix["Email"]);
			}
		}


		for ($i = 0; $i < count($_POST["userid"]); $i++) {
			for ($k = 0; $k < count($idprifix); $k++) {
				if ($_POST["userid"][$i] == $idprifix[$k] && $_POST["priority"][$k] == "0") array_push($emailnotsend, $allmail[$k]);
				if ($_POST["userid"][$i] == $idprifix[$k] && $_POST["priority"][$k] != "0") {
					array_push($emailnotsend, $allmail[$k]);
					$sqlSelect2 = "INSERT INTO `SelectedMeeting`(`MeetingID`,`UserID`, `Priority` ) VALUES ('" . $_POST["custId"] . "','" . $idprifix[$k] . "','" . $_POST["priority"][$k] . "')";
					if (mysqli_query($conn, $sqlSelect2));
				}
			}

			$sqlSelect8 = "SELECT AllUser.Email FROM SelectedMeeting INNER JOIN AllUser ON SelectedMeeting.UserID=AllUser.UserID WHERE SelectedMeeting.MeetingID='" . $_POST["custId"] . "' AND SelectedMeeting.UserID='" . $_POST["userid"][$i] . "'";
			$resultSelect8 = mysqli_query($conn, $sqlSelect8);
			$emailc = mysqli_fetch_assoc($resultSelect8);
			array_push($mailArray, $emailc["Email"]);
		}
		$sqlSelect5 = "SELECT `MeetingID`, `Topic`, `Date`, `Time`, `Host`, `Place`, `Doc_Link`, `Conclusion` FROM `AllMeeting` WHERE MeetingID='" . $_POST["custId"] . "'";
		$resultSelect5 = mysqli_query($conn, $sqlSelect5);
		$meetingIn = mysqli_fetch_assoc($resultSelect5);
		$totalMails = count($mailArray);
		$mail = new PHPMailer();
		$mail->CharSet = 'UTF-8';
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		for ($i = 0; $i < $totalMails; $i++) {
			$mail->isHTML();
			$mail->Username = 'netbean456@gmail.com';
			$mail->Password = 'zerissacgame';
			$mail->SetFrom('netbean456@gmail.com', 'Admin');
			$mail->Subject = 'HTML';
			$mail->Body = 'ท่านได้เข้าร่วมการประชุม   ' . $meetingIn["Topic"] . '  วันที่   ' . $meetingIn["Date"] . '  เวลา   ' . $meetingIn["Time"] . '  ที่  ' . $meetingIn["Place"] . '<a href="http://webtech2562.96.lt/s1g16/user.php";> Click Here to confirm';
			$mail_send = $mailArray[$i];
			$to = $mail_send;
			$mail->AddAddress($to);
			//$mail->Send();
			if (!$mail->Send()) {
				echo "<div id=\"MessageBox\">	
				<h4>MAIL OF USER " . $emailnotsend[$i] . " NOT SEND PLEASE CHECK PRIORITY</h4>
				<a onClick=\"this.parentElement.style.display='none';\" class=\"close\">OK</a>
				</div>";
			}
			$mail->ClearAddresses();
		}
		// ..........................................................................................................
		//.............................................................................................................
		// ..........................................................................................................
		//.............................................................................................................
		if (isset($_GET['variable'])) {
			$variable2 = $_GET['variable'];
			$variable1 = $variable2;
		}
		$sqlSelect = "SELECT Name,Last_Name,Position,Email,UserID FROM AllUser WHERE UserID <> ALL (SELECT UserID FROM SelectedMeeting WHERE SelectedMeeting.MeetingID='" . $variable1 . "' AND (SelectedMeeting.MeetConf=0 OR SelectedMeeting.MeetConf=1) )";
		$resultSelect = mysqli_query($conn, $sqlSelect);
		$meeting = $variable1;
		echo "<form f1.action=\"Add_user.php\" method=\"post\"  id=\"f1\" name=\"f1\" value=$meeting><table><tr><th><input type=\"checkbox\" onClick=\"toggle(this)\">All<br></th><th>Name</th><th>Last_Name</th><th>Position</th><th>Email</th><th>Priority</th>";
		if (mysqli_num_rows($resultSelect) > 0) {
			// output data of each row
			while ($row = mysqli_fetch_assoc($resultSelect)) {
				$userId = $row["UserID"];
				echo "<tr>
                    <td><input type=\"checkbox\" name=\"userid[]\" id=\"userid[]\" value=$userId ><input type=\"hidden\" id=\"custId\" name=\"custId\" value=$meeting></td>
                    <td>" . $row["Name"] . "</td><td>" . $row["Last_Name"] . "</td><td>" . $row["Position"] . "</td><td>" . $row["Email"] . "</td>
                    <td><select  name = \"priority[]\" >
						<option value = 0 > Select </option>
                        <option value = A > Chairman </option>
                        <option value = B > Director </option>
						<option value = C > Participant </option>
                    </select>
					</td>
					</tr>";
			}
			echo "</table>";
		} else {
			echo "No One to send";
		}
		echo "<br>
            <input onClick=\"return confirm('Are you sure to CONFIRM?');\" id=\"btncheck\" type=\"submit\" name=\"Send\" value=\"send\"/>&nbsp;";
		echo "<input type=\"button\" onclick=\"location.href='conference_userdata.php?variable=$variable2';\" value=\"Cancel\" />";
		echo "</form>";

		mysqli_close($conn);
		?>
	</center>
</body>
<script>
	if (window.history.replaceState) {
		window.history.replaceState(null, null, window.location.href);
	}
</script>

</html>