﻿<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';


$nick = $_POST['nick'];
$pwd = $_POST['pwd'];
$_SESSION['add_nick'] = $nick;

$check_user = mysqli_query($link, "SELECT * FROM users WHERE (email = '$nick' OR nick = '$nick')");
echo mysqli_num_rows($check_user) . "</br>";
echo "$nick" . "</br>";
echo "$pwd";

if ($nick == "" || $pwd == "") {

   $_SESSION['message'] = 'Всі поля повинно бути заповнено!';
   header('Location: add_admin.php');

} else {
   if (mysqli_num_rows($check_user) > 0) {

      $check_admin = mysqli_query($link, "SELECT * FROM users WHERE id_user = '" . $_SESSION['id_user'] . "' AND u_password = '" . $pwd . "'");

      if (mysqli_num_rows($check_admin) > 0) {

         $check_is_admin = mysqli_query($link, "SELECT * FROM users WHERE (email = '$nick' OR nick = '$nick') AND u_status='adm'");

         if (mysqli_num_rows($check_is_admin) > 0) {
            $_SESSION['message'] = 'Цей користувач вже є адміністратором сайту!';
            header('Location: add_admin.php');
         } else {
            $q = "UPDATE users SET u_status = 'adm' WHERE nick='" . $nick . "'";
            mysqli_query($link, $q);
            $_SESSION['message'] = 'Успішно додано нового адміністратора!';
            unset($_SESSION['add_nick']);
            header('Location: admin_page.php');

         }

      } else {
         $_SESSION['message'] = 'Невірно введено пароль!';
         header('Location: add_admin.php');
      }

   } else {

      $_SESSION['message'] = 'Такого користувачаа не існує!';
      header('Location: add_admin.php');

   }
}
?>