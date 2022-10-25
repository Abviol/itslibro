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



   $q = "INSERT INTO users (nick, email, age, u_password, u_status) VALUES ('" . $nick . "', '" . $email . "', '" . $age . "', '" . $pwd . "', 'user')";

   mysqli_query($link, $q);

   $_SESSION['message'] = 'Дякуємо за рееєстрацію!';
   header('Location: login.php');


} else {
   $_SESSION['message'] = 'Паролі на співпадають';
   header('Location: register.php');
}

/* if (!$email && !$nick && !$age && !$pwd && !$pwd_conf) {
 $_SESSION['message'] = 'Паролі на співпадають';
 } */
?>