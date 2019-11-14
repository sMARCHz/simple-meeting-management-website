<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<style>
body{
	margin: 0;
    padding: 0;
    font-family: "Montserrat";}
    #MessageBox{
    	width: 500px;
        overflow: hidden;
        background: #f1f1f1;
        box-shadow: 0 0 15px black;
        border-radius: 8px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        z-index: 9999;
        padding: 10px;
        text-align: center;
        display : none;
    }
    .close{
    	font-size: 18px;
        color: white;
        padding: 10px 20px;
        cursor: pointer;
        background: #3AAFA9;
        display: inline-block;
        border-radius: 4px;
    }
    
</style>
<body>
	<script language="JavaScript">
		function pop(){
			if(document.getElementById("MessageBox").style.display=="none")
			document.getElementById("MessageBox").style.display = "block";
			else document.getElementById("MessageBox").style.display = "none";
		}
	</script>
</body>
</html>
<?php
	echo "<div id=\"MessageBox\">	
	<h1>Meeting's Priority Chairman has denied meeting</h1>
    <a onClick=\"pop()\" class=\"close\">OK</a>
</div>";
	echo "<a onClick=\"pop()\" class=\"close\">OPOPOPOPOPOP</a>";
?>

