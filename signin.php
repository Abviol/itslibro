<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';


$nick = $_POST['nick'];
$pwd = $_POST['pwd'];

$check_user = mysqli_query($link, "SELECT * FROM users WHERE (email = '$nick' OR nick = '$nick') AND u_password = '$pwd'");
if ($nick == "" || $pwd == "") {
   $_SESSION['message'] = 'Всі поля повинно бути заповнено!';
   header('Location: login.php');
} else {
   if (mysqli_num_rows($check_user) > 0) {
      $user = mysqli_fetch_assoc($check_user);
      $_SESSION['id_user'] = $user['id_user'];
      $_SESSION['nick'] = $user['nick'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['age'] = $user['age'];
      $_SESSION['u_status'] = $user['u_status'];
      $_SESSION['about_user'] = $user['about_user'];
      $_SESSION['u_password'] = $user['u_password'];
      $_SESSION['avatar'] = $user['avatar'];
      header('Location: index.php');
   } else {
      $_SESSION['message'] = 'Невірно введено логін або пароль!';
      header('Location: login.php');
   }
}
?>