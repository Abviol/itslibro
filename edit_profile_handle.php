<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';

$nick = $_POST['nick'];
$age = $_POST['age'];
$pwd = $_POST['pwd'];
$new_pwd = $_POST['new_pwd'];
$id_user = $_SESSION['id_user'];
$about_user = $_POST['about_user'];


if ($age == "") {
   $_SESSION['message'] = 'Вкажіть свій вік!';
   header('Location: edit_profile.php');
} else {

   $check_user = mysqli_query($link, "SELECT * FROM users WHERE nick = '$nick' AND id_user != '$id_user'");
   if (mysqli_num_rows($check_user) > 0) {
      $_SESSION['message'] = 'Такий нікнейм вже використувується!';
      header('Location: edit_profile.php');
   } else {

      if (strlen($nick) < 4 || strlen($nick) > 16) {
         $_SESSION['message'] = 'Нікнейм повинен містити від 4 до 16 символів!';
         header('Location: edit_profile.php');
      } else {

         $check_pwd = mysqli_query($link, "SELECT * FROM users WHERE u_password = '$pwd' AND id_user = '$id_user'");
         if (mysqli_num_rows($check_pwd) > 0) {
            if (empty($new_pwd)) {
               $q = "UPDATE users SET nick = '$nick', age = '$age', about_user = '$about_user' WHERE id_user = '$id_user'";
               mysqli_query($link, $q);
            } else if ($pwd == $new_pwd) {
               $_SESSION['message'] = 'Придумайте новий пароль"';
               header('Location: edit_profile.php');
            } else {
               $q = "UPDATE users SET nick = '$nick', age = '$age', u_password = '$new_pwd', about_user = '$about_user' WHERE id_user = '$id_user'";
               mysqli_query($link, $q);
            }

            $_SESSION['message'] = 'Профіль успішно оновлено!';
            $_SESSION['nick'] = $nick;
            $_SESSION['age'] = $age;
            $_SESSION['about_user'] = $about_user;

            header('Location: profile.php');
         } else {
            $_SESSION['message'] = 'Невірний пароль!';
            header('Location: edit_profile.php');
         }
      }
   }
}
?>