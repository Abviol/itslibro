<?php
$dblocation = "localhost";
$dbuser = "root";
$dbpasswd = "dlit";
$link = mysqli_connect($dblocation, $dbuser, $dbpasswd);
mysqli_select_db($link, "itslibro1");
?>