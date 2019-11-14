<?php
session_start();
include("config.php");
$sqlSelect = "SELECT Email FROM AllUser WHERE Rank='Admin'";
$resultSelect = mysqli_query($conn, $sqlSelect);
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="icon" type="png" href="icon.png">
    <style>
        body {
            margin: 0px;
            background-image: url("con11.jpg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            width: 100%;
            z-index: -2;
        }

        table {
            background: #dfd6cd;
            border-collapse: collapse;
            font-size: 1.2vw;
        }

        td,
        th {
            text-align: center;
            padding: 10px;
            width: 30%;
            border: 1px solid black;
        }

        span {
            display: inline;
            margin-left: 10px;
            position: relative;
            font-size: 1.2vw;
        }

        .i {
            vertical-align: middle;
            float: left;
        }

        .h {
            font-size: 1.2vw;
        }

        .v {
            float: left;
            width: 50%;
            height: 100%;
        }

        .v2 {
            float: right;
            width: 45%;
            height: 100%;
            margin-right: 5%;
        }
    </style>
</head>

<body>
    <?php
    echo "<div class=\"v\">";
    if ($_SESSION['UserID'] == "") {
        echo "<div class=\"i\"><a href=\"login.php\"><img src=\"arrow_left.png\" style=\"width: 4%; height:auto; cursor: pointer;\"></a>&nbsp;&nbsp;<span>Please click this back button to go back!</span></div>";
    } else {
        echo "<div class=\"i\"><a href=\"user.php\"><img src=\"arrow_left.png\" style=\"width: 4%; height:auto; cursor: pointer;\"></a>&nbsp;&nbsp;<span>Please click this back button to go back!</span></div>";
    }
    echo "</div>";
    $message = "Any problem => contact Admin";
    /*echo "<script type='text/javascript'>alert('$message');</script>";*/
    echo "<div class=\"v2\">";
    echo "<center><br><br><br><img src=\"con7.png\" width=\"90%\" height=\"auto\"><br>";
    echo "<br><br><div class=\"h\">Here are the contacts info of administrators. If they don't reply to you immediately, don't worry and please wait..</div><br><br>";
    echo "<table><tr><th>Order</th><th>Email</th></tr>";
    $count = 1;
    if (mysqli_num_rows($resultSelect) > 0) {
        while ($row = mysqli_fetch_assoc($resultSelect)) {
            echo "<tr><td>$count</td><td>" . $row["Email"] . "</td>";
            $count += 1;
        }
        echo "</table><br>";
    } else {
        echo "<tr><td colspan=\"2\">0 results</td></tr></table><br>";
    }
    echo "</center>";
    echo "</div>";
    ?>
</body>

</html>