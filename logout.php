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
unset($_SESSION['id_user']);
unset($_SESSION['id_book']);
unset($_SESSION['selected_list']);
header('Location: index.php');
?>