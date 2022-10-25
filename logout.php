<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
unset($_SESSION['nick']);
unset($_SESSION['email']);
unset($_SESSION['age']);
unset($_SESSION['u_status']);
unset($_SESSION['about_user']);
header('Location: main.html');
?>