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
<title>Add conference</title>

<head>
    <title> จัดการประชุมใหม่ </title>
    <meta charset="UTF-8">
    <meta http-equiv=Content-Type content="text/html; charset=tis-620">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="png" href="icon.png">
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

        td,
        th {
            font-size: 1.5vw;
            font-family: Cordia New;
        }


        h1 {
            font-family: Cordia New;
            font-size: 5vw;
            margin: 4px;
        }

        table {
            font-family: Cordia New;
            border: 1px;
            width: 400px;
        }

        .box {
            background-color: white;
            width: 50%;
            height: auto;

            opacity: 1;
            color: black;
            border-radius: 30px 30px 30px 30px;
            border: 1px solid black;
            border-collapse: collapse;
            z-index: -1;
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

        .nav .icon {
            display: none;
        }

        @media only screen and (min-width : 150px) and (max-width : 780px) {

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


        }
    </style>
    <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

    <!-- Javascript -->
    <script>
        $(function() {
            $("#datepicker-3").datepicker({

                changeMonth: true,
                changeYear: true,

                dateFormat: "yy-mm-dd",
                altField: "#datepicker-4",
                altFormat: "DD, d MM, yy"
            });
        });

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

        }
    </script>
</head>

<body>
    <div class="nav" id="bar">
        <a href="admin.php"> Home </a>
        <a class="active" href="add_conferenceform.php"> Add conference</a>
        <a href="Remove_conference.php"> Remove conference </a>
        <a href="Add_remove_Document.php"> Add/Remove Document </a>
        <a href="Add_remove_Conclusion.php"> Add/Remove Conclusion </a>
        <div class="nav-right" id="bar1">
            <a href="logout.php" onClick=\"return confirm('Are you sure to Logout?');\">Logout</a>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="resFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</body>

<body>
    <br>
    <center>
        <h1> Add Conference</h1>

        <div class="box">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <center><br>
                    <table>
                        <tbody>
                            <tr>
                                <td>&nbsp;Topic :</td>
                            </tr>
                            <tr>
                                <td>
                                    <input name="txtTopic" type="text" id="txtTopic" style="width:45vw">
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;Date :</td>
                            </tr>
                            <tr>
                                <td>
                                    <input name="txtDate" type="text" id="datepicker-3" style="width:45vw" placeholder="yy-mm-dd">
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;Time :</td>
                            </tr>
                            <tr>
                                <td>
                                    <input name="txtTime" type="time" id="txtTime" style="width:45vw">
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;Place :</td>
                            </tr>
                            <tr>
                                <td>
                                    <input name="txtPlace" type="text" id="txtPlace" style="width:45vw">
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;Host :</td>
                            </tr>
                            <tr>
                                <td>
                                    <input name="txtHost" type="text" id="txtHost" style="width:45vw">
                                </td>
                            </tr>
                        </tbody>
                    </table><br>
                    <input type="submit" name="submit" value="Submit" onClick="return confirm('Are you sure to ADD?')"> &nbsp;
                    <input type="reset" name="Submit2" value="Reset">

                </center>
            </form><br>
        </div>
    </center>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $strSQL = "INSERT INTO `AllMeeting`(`Topic`, `Date`, `Time`, `Host`, `Place`) VALUES('" . $_POST["txtTopic"] . "','" . $_POST["txtDate"] . "','" . $_POST["txtTime"] . "','" . $_POST["txtHost"] . "','" . $_POST["txtPlace"] . "')";
    $objQuery = mysqli_query($conn, $strSQL);
}
mysqli_close($conn);
?>