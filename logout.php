<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
unset($_SESSION['nick']);
unset($_SESSION['email']);
unset($_SESSION['age']);
unset($_SESSION['u_status']);
unset($_SESSION['about_user']);
unset($_SESSION['u_password']);
unset($_SESSION['avatar']);
/* $_SESSION['nick'] = "";
 $_SESSION['email'] = "";
 $_SESSION['age'] = "";
 $_SESSION['u_status'] = "";
 $_SESSION['about_user'] = "";
 $_SESSION['pwd'] = "";
 $_SESSION['avatar'] = ""; */
header('Location: index.php');
?>