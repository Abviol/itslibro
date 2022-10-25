<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';


$nick = $_POST['nick'];
$pwd = $_POST['pwd'];

$check_user = mysqli_query($link, "SELECT * FROM users WHERE (email = '$nick' OR nick = '$nick') AND u_password = '$pwd'");
echo mysqli_num_rows($check_user) . "</br>";
echo "$nick" . "</br>";
echo "$pwd";

if (mysqli_num_rows($check_user) > 0) {

   $user = mysqli_fetch_assoc($check_user);

   $_SESSION['nick'] = $user['nick'];
   $_SESSION['email'] = $user['email'];
   $_SESSION['age'] = $user['age'];
   $_SESSION['u_status'] = $user['u_status'];
   $_SESSION['about_user'] = $user['about_user'];

   header('Location: profile.php');

} else {
   $_SESSION['message'] = 'Невірно введено логін або пароль!';
   header('Location: login.php');
}

/* if (!$email && !$nick && !$age && !$pwd && !$pwd_conf) {
 $_SESSION['message'] = 'Паролі на співпадають';
 } */
?>