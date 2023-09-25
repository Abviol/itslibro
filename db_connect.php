<?php
$dblocation = "localhost";
$dbuser = "root";
<<<<<<< HEAD
$dbpasswd = "";
// $dbuser = "id21257248_abviol";
// $dbpasswd = ":akYZ55B7#Ss";
$link = mysqli_connect($dblocation, $dbuser, $dbpasswd);
// include 'db.php';
=======
$dbpasswd = "dlit";
$link = mysqli_connect($dblocation, $dbuser, $dbpasswd);
>>>>>>> parent of 81ceab9 (reserv)
mysqli_select_db($link, "itslibro1");
?>