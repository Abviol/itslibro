<?php
$dblocation = "localhost";
$dbuser = "root";
$dbpasswd = "";
// $dbuser = "id21257248_abviol";
// $dbpasswd = ":akYZ55B7#Ss";
$link = mysqli_connect($dblocation, $dbuser, $dbpasswd);
// include 'db.php';
mysqli_select_db($link, "itslibro1");
?>