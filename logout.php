<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
$_SESSION['nick'] = "";
$_SESSION['email'] = "";
$_SESSION['age'] = "";
$_SESSION['u_status'] = "";
$_SESSION['about_user'] = "";
header('Location: index.php');
?>