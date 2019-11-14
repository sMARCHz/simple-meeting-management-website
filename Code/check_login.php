<?php
session_start();
include("config.php");
$strSQL = "SELECT Name,Email,Password,Rank,UserID FROM AllUser WHERE Email = '" . mysqli_real_escape_string($conn, $_POST['txtEmail']) . "' AND Password = '" . mysqli_real_escape_string($conn, $_POST['txtPassword']) . "'";
$objQuery = mysqli_query($conn, $strSQL);
if (mysqli_num_rows($objQuery) > 0) {
    $objResult = mysqli_fetch_assoc($objQuery);
}
if (!$objResult) {
    echo "Email and Password Incorrect!";
} else {
    $_SESSION["UserID"] = $objResult["UserID"];
    $_SESSION["Rank"] = $objResult["Rank"];
    $_SESSION["Name"] = $objResult["Name"];
    session_write_close();
    if ($objResult["Rank"] == "ADMIN") {
        header("location:admin.php");
    } else {
        header("location:user.php");
    }
}
mysqli_close($conn);
?>
<html>

<head>
    <link rel="icon" type="png" href="icon.png">
</head>

</html>