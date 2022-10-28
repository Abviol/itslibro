<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';


$email = $_POST['email'];
$nick = $_POST['nick'];
$age = $_POST['age'];
$pwd = $_POST['pwd'];
$pwd_conf = $_POST['pwd_conf'];

$_SESSION['email'] = $_POST['email'];
$_SESSION['nick'] = $_POST['nick'];
$_SESSION['age'] = $_POST['age'];


if ($nick == "" || $pwd == "" || $age == "" || $email == "" || $pwd_conf == "") {
   $_SESSION['message'] = 'Всі поля повинно бути заповнено!';
   header('Location: register.php');
} else {

   $check_user = mysqli_query($link, "SELECT * FROM users WHERE email = '$email'");

   if (mysqli_num_rows($check_user) > 0) {
      $_SESSION['message'] = 'Такий e-mail вже використувується!';
      header('Location: register.php');
   } else {

      $check_user = mysqli_query($link, "SELECT * FROM users WHERE nick = '$nick'");
      if (mysqli_num_rows($check_user) > 0) {
         $_SESSION['message'] = 'Такий нікнейм вже використувується!';
         header('Location: register.php');
      } else {

         if (strlen($pwd) < 8) {
            $_SESSION['message'] = 'Пароль повинен містити не менше за 8 символів';
            header('Location: register.php');
         } else {
            if ($pwd === $pwd_conf) {



               $q = "INSERT INTO users (nick, email, age, u_password, u_status) VALUES ('" . $nick . "', '" . $email . "', '" . $age . "', '" . $pwd . "', 'user')";

               mysqli_query($link, $q);

               $_SESSION['message'] = 'Дякуємо за рееєстрацію!';
               header('Location: login.php');


            } else {
               $_SESSION['message'] = 'Паролі на співпадають';
               header('Location: register.php');
            }
         }
      }
   }
}


/* if (!$email && !$nick && !$age && !$pwd && !$pwd_conf) {
 $_SESSION['message'] = 'Паролі на співпадають';
 } */
?>