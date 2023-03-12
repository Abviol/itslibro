<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';


$nick = $_POST['nick'];
$pwd = md5($_POST['pwd']);
$_SESSION['delete_nick'] = $nick;

$check_user = mysqli_query($link, "SELECT * FROM users WHERE (email = '$nick' OR nick = '$nick')");
/* echo mysqli_num_rows($check_user) . "</br>";
echo "$nick" . "</br>";
echo "$pwd"; */

if ($nick == "" || $pwd == "7215ee9c7d9dc229d2921a40e899ec5f") {

   $_SESSION['message'] = 'Всі поля повинно бути заповнено';
   header('Location: delete_admin.php');

} else {
   if (mysqli_num_rows($check_user) > 0) {

      $check_admin = mysqli_query($link, "SELECT * FROM users WHERE id_user = '" . $_SESSION['id_user'] . "' AND u_password = '" . $pwd . "'");

      if (mysqli_num_rows($check_admin) > 0) {

         $check_is_admin = mysqli_query($link, "SELECT * FROM users WHERE (email = '$nick' OR nick = '$nick') AND u_status='user'");

         if (mysqli_num_rows($check_is_admin) > 0) {
            $_SESSION['message'] = 'Не можна позбавити прав aдміністратора того, хто їх не має';
            header('Location: add_admin.php');
         } else {
            $q = "UPDATE users SET u_status = 'user' WHERE nick='" . $nick . "'";
            mysqli_query($link, $q);
            $_SESSION['message'] = 'Успішно видалено адміністратора';
            unset($_SESSION['delete_nick']);
            header('Location: admin_page.php');

         }

      } else {
         $_SESSION['message'] = 'Невірно введено пароль!';
         header('Location: delete_admin.php');
      }

   } else {

      $_SESSION['message'] = 'Такого користувачаа не існує';
      header('Location: delete_admin.php');

   }
}
?>