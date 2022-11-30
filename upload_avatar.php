<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';

if ($_FILES['avatar']['error'] == 0) {
   $new_avatar = $_FILES['avatar'];
   $avatar_info = pathinfo($new_avatar['name']);
   $avatar_ext = $avatar_info['extension'];

   $path_avatar = 'img/avatars/' . $_SESSION['id_user'] . '.' . $avatar_ext;
   move_uploaded_file($new_avatar['tmp_name'], $path_avatar);

   if ($avatar_ext != substr($_SESSION['avatar'], -3)) {
      $old_avatar = $_SESSION['avatar'];
      unlink($old_avatar);
      $_SESSION['avatar'] = $path_avatar;
   }

   $q = "UPDATE users SET avatar = '$path_avatar' WHERE id_user = '" . $_SESSION['id_user'] . "'";

   mysqli_query($link, $q);
}
header('Location: profile.php');
?>