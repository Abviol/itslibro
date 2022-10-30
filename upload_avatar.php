<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';

function avatarSecurity($avatar)
{
   $name = $_FILES['name'];
   $type = $_FILES['type'];
   $size = $_FILES['size'];
   $blacklist = array(".php", ".js", ".html", ".css");

   foreach ($blacklist as $row) {
      if (preg_match("/$row\$/i", $name))
         return false;
   }

   if ($type != "image/jpg")
      return false;

   if ($size > 5 * 1024 * 1024)
      return false;

   return true;
}
?>