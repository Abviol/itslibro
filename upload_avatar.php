<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();

$new_avatar = $_FILES['avatar'];
$avatar_info = pathinfo($new_avatar['name']);
$avatar_ext = $avatar_info['extension'];

$path_avatar = 'img/avatars/' . $_SESSION['id_user'] . '.' . $avatar_ext;
echo $path_avatar;
move_uploaded_file($new_avatar['tmp_name'], $path_avatar);
?>