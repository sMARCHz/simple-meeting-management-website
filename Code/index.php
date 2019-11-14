<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="png" href="icon.png">
    <style>
        body {
            margin: 0px;
            background-image: url("tower.gif");
            /*url("bgif1.gif");*/
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            width: 100%;
            z-index: -2;
            text-align: center;
        }

        form {
            display: inline-block;
        }

        h1 {
            font-size: 7vw;
            font-family: Gabriola;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .content {
            text-decoration: none;
            width: 70%;
            height: 70%;
            margin: 0px;
            font-size: 20px;
            background-color: rgba(197, 239, 247, .6);
            z-index: -1;
            border-radius: 40px 40px 40px 40px;
            box-shadow: 7px 7px 7px;
        }

        h3 {
            font-size: 2vw;
            font-family: Cordia New;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        td {
            font-size: 25px;
            font-family: Cordia New;
        }

        @media screen and (max-width: 380px) {
            td {
                font-size: 9px;
            }
        }
    </style>
</head>

<body><br><br>
    <center>
        <div class="content"><br><br>
            <img src="login6.gif" style="width:50%"><br><br>
            <?php
            echo "<form name=\"form1\" method=\"post\" action=\"check_login.php\">";
            //echo "<br><br>Login<br><br>";
            echo "<table style=\"width: 300px; border:0;\">
                <tbody>
                    <tr>
                        <td><label for=\"email\"><b>Email</b></label></td>
                        <td><input type=\"text\" placeholder=\"Enter Email\" name=\"txtEmail\" id=\"txtEmail\" required></td>
                    </tr>
                    <tr>
                        <td><label for=\"psw\"><b>Password</b></label></td>
                        <td><input type=\"password\" placeholder=\"Enter Password\" name=\"txtPassword\" required></td>
                    </tr>
                </tbody>
            </table>";
            echo "<br>";
            echo "<input type=\"submit\" name=\"Submit\" value=\"Login\"> &nbsp;";
            echo "<input type=\"reset\" name=\"Submit2\" value=\"Reset\">
    </form><br><br>";
            echo "<h3>If you haven't registered => Please contact admin -> <a href=\"contact.php\">Click Here</a></h3>";
            ?>
        </div>
    </center>
</body>

</html>