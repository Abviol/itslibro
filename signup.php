<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';


$email = $_POST['email'];
$nick = $_POST['nick'];
$age = $_POST['age'];
$pwd = $_POST['pwd'];
$pwd_conf = $_POST['pwd_conf'];

if ($pwd === $pwd_conf) {


   mysqli_query($link, "INSERT INTO 'user's ('id', 'nick', 'email', 'age', 'u_password', 'u_status') VALUES (NULL, '$nick', '$email', '$age', '$pwd', 'user')");


   $_SESSION['message'] = 'Дякуємо за рееєстрацію!';
   header('Location: login.php');

} else {
   $_SESSION['message'] = 'Паролі на співпадають';
   header('Location: register.php');
}
?>