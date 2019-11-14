<?php
session_start();
include("config.php");
if ($_SESSION['UserID'] == "") {
	echo "Please Login!<br>";
	echo "Go login page <a href=\"login.php\">Click Here</a>";
	exit();
}
if ($_SESSION['Rank'] != "User") {
	echo "This page for Admin only!";
	echo "Go login page <a href=\"login.php\">Click Here</a>";
	exit();
}
$sqlSelectA = "SELECT AllMeeting.MeetingID, AllMeeting.Topic, AllMeeting.Date, AllMeeting.Time, AllMeeting.Host, AllMeeting.Place, AllMeeting.Doc_Link, AllMeeting.Conclusion, SelectedMeeting.MeetConf, SelectedMeeting.UserID,SelectedMeeting.Priority FROM SelectedMeeting INNER JOIN AllMeeting ON AllMeeting.MeetingID=SelectedMeeting.MeetingID WHERE SelectedMeeting.UserID = '" . $_SESSION['UserID'] . "' AND SelectedMeeting.MeetConf=0 AND CURRENT_DATE()<=AllMeeting.Date";
$resultSelectA = mysqli_query($conn, $sqlSelectA);
$sqlSelectB = "SELECT AllMeeting.MeetingID, AllMeeting.Topic, AllMeeting.Date, AllMeeting.Time, AllMeeting.Host, AllMeeting.Place, AllMeeting.Doc_Link, AllMeeting.Conclusion, SelectedMeeting.MeetConf, SelectedMeeting.UserID,SelectedMeeting.Priority FROM SelectedMeeting INNER JOIN AllMeeting ON AllMeeting.MeetingID=SelectedMeeting.MeetingID WHERE SelectedMeeting.UserID = '" . $_SESSION['UserID'] . "' AND SelectedMeeting.MeetConf=1 AND CURRENT_DATE()<=AllMeeting.Date";
$resultSelectB = mysqli_query($conn, $sqlSelectB);
$sqlSelectC = "SELECT AllMeeting.MeetingID, AllMeeting.Topic, AllMeeting.Date, AllMeeting.Time, AllMeeting.Host, AllMeeting.Place, AllMeeting.Doc_Link, AllMeeting.Conclusion, SelectedMeeting.MeetConf, SelectedMeeting.UserID,SelectedMeeting.Priority  FROM SelectedMeeting INNER JOIN AllMeeting ON AllMeeting.MeetingID=SelectedMeeting.MeetingID WHERE SelectedMeeting.UserID = '" . $_SESSION['UserID'] . "' AND SelectedMeeting.MeetConf=1 AND CURRENT_DATE()>AllMeeting.Date";
$resultSelectC = mysqli_query($conn, $sqlSelectC);
$sqlSelectE = "SELECT SenderID, ReceiverID, SendingTime, Head, MSID, MeetingID, Topic FROM Message WHERE ReceiverID='" . $_SESSION['UserID'] . "'";
$resultSelectE = mysqli_query($conn, $sqlSelectE);
?>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Meeting</title>
	<link rel="icon" type="png" href="icon.png">
	<style>
		body {
			margin: 0px;
			background-color: #FEFFFF;
		}

		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 85%;
			align: center;
			table-layout: fixed;
		}

		td,
		th {
			border: 1px solid #dddddd;
			text-align: center;
			padding: 8px;
			width: 10%;
			font-size: 1vw;
			overflow: hidden;
			text-overflow: ellipsis;
			white-space: nowrap;
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

		tr:nth-child(odd) {
			background-color: #FEFFFF;
		}

		tr:nth-child(even) {
			background-color: #DEF2F1;
		}

		.icon {
			width: 25%;
			height: auto;
			cursor: pointer;
		}

		/* Style the tab */
		.tab {
			overflow: hidden;
			border: 1px solid #ccc;
			background-color: #3AAFA9;
			width: 80%;
		}

		/* Style the buttons that are used to open the tab content */
		.tab button {
			background-color: inherit;
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			padding: 14px 16px;
			width: 33.3333333333333333333%;
			transition: 0.3s;
		}

		/* Change background color of buttons on hover */
		.tab button:hover {
			background-color: #ddd;
		}

		/* Create an active/current tablink class */
		.tab button.active {
			background-color: #2B7A78;
		}

		/* Style the tab content */
		.tabcontent {
			display: none;
			padding: 6px 12px;
			border: 1px solid #3AAFA9;
			border-top: none;
			animation: fadeEffect 1s;
			width: 75%;
		}

		@keyframes fadeEffect {
			from {
				opacity: 0;
			}

			to {
				opacity: 1;
			}
		}

		/* Add a black background color to the top navigation */
		.topnav {
			background-color: #3AAFA9;
			opacity: 1;
			overflow: hidden;
			position: fixed;
			width: 100%;
		}

		/* Style the links inside the navigation bar */
		.topnav a {
			float: left;
			color: #17252A;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
			font-size: 1.5vw;
			font-family: Cordia New;
		}

		/* Change the color of links on hover */
		.topnav a:hover {
			background-color: #ccc;
			animation: fadeEffect 1s;
			color: black;
		}

		/* Add a color to the active/current link */
		.topnav a.active {
			background-color: #17252A;
			animation: fadeEffect 1s;
			color: #FEFFFF;
		}

		/* Right-aligned section inside the top navigation */
		.topnav-right {
			float: right;
		}

		h1 {
			font-family: Cordia New;
			font-size: 3vw;
		}

		h3 {
			font-family: Cordia New;
			font-size: 2vw;
		}

		span {
			font-size: 1.5vw;
			font-family: Cordia New;
		}

		p {
			font-size: 1.5vw;
			font-family: Cordia New;
		}

		@media screen and (max-width: 575px) {
			.tab button {
				font-size: 10px;
			}

			h1,
			h3 {
				font-size: 70%;
			}

			span {
				font-size: 2vw;
			}

			p {
				font-size: 2vw;
			}

			table {
				width: 100%;
			}
		}

		@media screen and (max-width: 469px) {
			.tab button {
				font-size: 8px;
			}
		}

		@media screen and (max-width: 460px) {
			.tab button {
				font-size: 6px;
			}
		}

		@media screen and (max-width: 485px) {

			td,
			th {
				padding: 4px;
			}
		}
	</style>
	<script>
		function TableTab(evt, tabName) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tabcontent");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("tablinks");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace(" active", "");
			}
			document.getElementById(tabName).style.display = "block";
			evt.currentTarget.className += " active";
		}
		window.onload = function() {
			document.getElementById("defaultOpen").click();
		};
	</script>
</head>

<body>
	<?php
	include("notifi.php");
	if (mysqli_num_rows($resultSelectE) > 0) {
		while ($rowX = mysqli_fetch_assoc($resultSelectE)) {
			if ($rowX["Head"] == "CANCEL_PRIORITY") {
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
				<h4>Meeting's Priority Chairman '" . $obj1["Name"] . " " . $obj1["Last_Name"] . "' has denied meeting '" . $rowX["Topic"] . "'</h4>
				<a onClick=\"this.parentElement.style.display='none';\" class=\"close\">OK</a>
				</div>";
				//echo "<script>alert(\"Meeting's Priority A '".$obj1["Name"]." ".$obj1["Last_Name"]."' has denied meeting '".$obj["Topic"]." ".$obj["Date"]." ".$obj["Time"]." ".$obj["Place"]."' \")</script>";
				$sqlUser2 = "DELETE FROM Message WHERE MSID='" . $rowX["MSID"] . "'";
				$resultUser2 = mysqli_query($conn, $sqlUser2);
			}
			if ($rowX["Head"] == "ADMINSEND") {
				echo "<div id=\"MessageBox\">	
				<h4>Meeting '" . $rowX["Topic"] . "' has been denied </h4>
				<a onClick=\"this.parentElement.style.display='none';\" class=\"close\">OK</a>
				</div>";
				//echo "<script>alert(\"Meeting '".$rowX["MeetingID"]."' has been denied \")</script>";
				$sqlUser25 = "DELETE FROM Message WHERE MSID='" . $rowX["MSID"] . "'";
				$resultUser25 = mysqli_query($conn, $sqlUser25);
			}
		}
	}
	echo "<div class=\"topnav\">
				<a class=\"active\" href=\"user.php\"><b>Home</b></a>
				<a href=\"contact.php\"><b>Contact Admin</b></a>
				<div class=\"topnav-right\">
					<a href=\"logout.php\" onClick=\"return confirm('Are you sure to Logout?');\"><b>Logout</b></a>
				</div>
	  		  </div>";
	echo "<br><br><br><br><center><h1>Welcome to your site!<br>";
	echo $_SESSION['Name'];
	echo "</h1>";
	echo "<p>This page show meetings that assosiated with you.(i.e. you were invited, you confirmed to join, the meeting you attended which has passed.)</p>" . "<br><br>";
	echo "<div class=\"tab\">
				<button class=\"tablinks\" onclick=\"TableTab(event,'A')\" id=\"defaultOpen\"><b>NOT CONFIRMED</b></button>
				<button class=\"tablinks\" onclick=\"TableTab(event,'B')\"><b>CONFIRMED</b></button>
				<button class=\"tablinks\" onclick=\"TableTab(event,'C')\"><b>PASSED</b></button>
			  </div>";
	echo "<div id=\"A\" class=\"tabcontent\">";
	echo "<h3>Not yet confirmed!</h3><br><span>This tab show you the meetings that you were invited.</span><br><span>**Check the correct button if you want to join this meeting(confirm)! and Check the wrong button if you want to decline!</span><br>";
	echo "<br><br><table id=\"search\"><tr><th>Confirm</th><th>Decline</th><th>Topic</th><th>Date</th><th>Time</th><th>Place</th><th>Host</th><th>Status</th><th>Priority</th>";
	if (mysqli_num_rows($resultSelectA) > 0) {
		// output data of each row
		while ($rowA = mysqli_fetch_assoc($resultSelectA)) {
			if (displayRow2($rowA["Topic"], $rowA["Date"], $rowA["Time"], $rowA["Place"], $rowA["Host"], $rowA["MeetConf"], "Waiting..", 0, 0, $rowA["Priority"]) == true) {
				$MeetingID = $rowA["MeetingID"];
				$UserID = $rowA["UserID"];
				if ($rowA["Priority"] == "A") {
					$priority = "Chairman";
				} else if ($rowA["Priority"] == "B") {
					$priority = "Director";
				} else if ($rowA["Priority"] == "C") {
					$priority = "Participant";
				}
				echo "<tr><td><a href=\"./updateCorrect.php?m=$MeetingID&u=$UserID\" onClick=\"return confirm('Are you sure to CONFIRM?');\"><img src=\"correct icon.png\" class=\"icon\"></a></td><td><a href=\"./updateWrong.php?m=$MeetingID&u=$UserID\" onClick=\"return confirm('Are you sure to DECLINE?');\"><img src=\"wrong icon.png\" class=\"icon\"></a></td><td>" . $rowA["Topic"] . "</td><td>" . $rowA["Date"] . "</td><td>" . $rowA["Time"] . "</td><td>" . $rowA["Place"] . "</td><td>" . $rowA["Host"] . "</td><td>Waiting..</td><td>" . $priority . "</td></tr>";
			}
		}
		echo "</table><br>";
	} else {
		echo "<tr><td colspan=\"9\">0 results</td></tr></table><br>";
	}
	echo "</div>";
	echo "<div id=\"B\" class=\"tabcontent\">";
	echo "<h3>Already confirmed!</h3><br>";
	echo "<span>This tab show you the meetings that you're going to join.</span><br><span>";
	echo "<br><table id=\"search\"><tr><th>Topic</th><th>Date</th><th>Time</th><th>Place</th><th>Host</th><th>Status</th><th>Handout</th><th>Report</th>";
	if (mysqli_num_rows($resultSelectB) > 0) {
		// output data of each row
		while ($rowB = mysqli_fetch_assoc($resultSelectB)) {
			$linkdocB = $rowB["Doc_Link"];
			$linkconB = $rowB["Conclusion"];
			if (displayRow($rowB["Topic"], $rowB["Date"], $rowB["Time"], $rowB["Place"], $rowB["Host"], $rowB["MeetConf"], "Join", $rowB["Doc_Link"], $rowB["Conclusion"]) == true) {
				echo "<tr><tr><td>" . $rowB["Topic"] . "</td><td>" . $rowB["Date"] . "</td><td>" . $rowB["Time"] . "</td><td>" . $rowB["Place"] . "</td><td>" . $rowB["Host"] . "</td><td>Join</td><td><a href=\"$linkdocB\" target=\"_blank\">" . $rowB["Doc_Link"] . "</a></td><td><a href=\"$linkconB\" target=\"_blank\" >" . $rowB["Conclusion"] . "</a></td></tr>";
			}
		}
		echo "</table><br>";
	} else {
		echo "<tr><td colspan=\"8\">0 results</td></tr></table><br>";
	}
	echo "</div>";

	echo "<div id=\"C\" class=\"tabcontent\">";
	echo "<h3>Already join these conference!</h3><br>";
	echo "<span>This tab show you the meetings you attended which has passed.</span><br><span>";
	echo "<br><table id=\"search\"><tr><th>Topic</th><th>Date</th><th>Time</th><th>Place</th><th>Host</th><th>Status</th><th>Handout</th><th>Report</th>";
	if (mysqli_num_rows($resultSelectC) > 0) {
		// output data of each row
		while ($rowC = mysqli_fetch_assoc($resultSelectC)) {
			$linkdocC = $rowC["Doc_Link"];
			$linkconC = $rowC["Conclusion"];
			if (displayRow($rowC["Topic"], $rowC["Date"], $rowC["Time"], $rowC["Place"], $rowC["Host"], $rowC["MeetConf"], "Expired", $rowC["Doc_Link"], $rowC["Conclusion"]) == true) {
				echo "<tr><tr><td>" . $rowC["Topic"] . "</td><td>" . $rowC["Date"] . "</td><td>" . $rowC["Time"] . "</td><td>" . $rowC["Place"] . "</td><td>" . $rowC["Host"] . "</td><td>Expired</td><td><a href=\"$linkdocC\" target=\"_blank\" >" . $rowC["Doc_Link"] . "</a></td><td><a  href=\"$linkconC\" target=\"_blank\" >" . $rowC["Conclusion"] . "</a></td></tr>";
			}
		}
		echo "</table><br>";
	} else {
		echo "<tr><td colspan=\"8\">0 results</td></tr></table><br>";
	}
	echo "</div><br>";
	echo "</center>";
	function displayRow($name, $date, $time, $place, $host, $meetcon, $status, $doc, $conclusion)
	{
		if ($meetcon == 1) {
			echo "<tr><td>" . $name . "</td><td>" . $date . "</td><td>" . $time . "</td><td>" . $place . "</td><td>" . $host . "</td><td>$status</td><td><a href=\"$doc\" target=\"_blank\">" . $doc . "</a></td><td><a href=\"$conclusion\" target=\"_blank\">" . $conclusion . "</a></td></tr>";
			return false;
		} elseif ($meetcon == 0) {
			return true;
		}
	}
	function displayRow2($name, $date, $time, $place, $host, $meetcon, $status, $doc, $conclusion, $priority)
	{
		if ($meetcon == 1) {
			echo "<tr><td>" . $name . "</td><td>" . $date . "</td><td>" . $time . "</td><td>" . $place . "</td><td>" . $host . "</td><td>$status</td><td>" . $doc . "</td><td>" . $conclusion . "</td><td>" . $priority . "</td></tr>";
			return false;
		} elseif ($meetcon == 0) {
			return true;
		}
	}
	$expireAfter = 30;
	if (isset($_SESSION['last_action'])) {

		//Figure out how many seconds have passed
		//since the user was last active.
		$secondsInactive = time() - $_SESSION['last_action'];

		//Convert our minutes into seconds.
		$expireAfterSeconds = $expireAfter * 60;

		//Check to see if they have been inactive for too long.
		if ($secondsInactive >= $expireAfterSeconds) {
			//User has been inactive for too long.
			//Kill their session.
			session_unset();
			session_destroy();
		}
	}
	$_SESSION['last_action'] = time();
	mysqli_close($conn);
	?>
</body>

</html>