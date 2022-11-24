<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';

$list = $_POST['list'];
$id_user = $_SESSION['id_user'];
$id_book = $_SESSION['id_book'];

$delete = ['list_reading', 'list_favorite', 'list_in_plans', 'list_readed', 'list_abandoned']; //всі списки
if ($list == "list_reading") { //визначаємо, у який список додаємо книгу, а з яких - видаляємо
   $list_name = "Читаю";
} else if ($list == "list_favorite") {
   $list_name = "Улюблене";
} else if ($list == "list_in_plans") {
   $list_name = "У планах";
} else if ($list == "list_readed") {
   $list_name = "Прочитано ";
} else if ($list == "list_abandoned") {
   $list_name = "Покинуто";
}

if ($list == "delete") { //видаляємо книгу з усіх списків
   foreach ($delete as $delete_list) {
      $q = "DELETE FROM " . $delete_list . " WHERE (id_user = '$id_user' AND id_book = '$id_book')";
      mysqli_query($link, $q);

      $_SESSION['message'] = "Книгу \"" . $_SESSION['b_name'] . "\" видалено зі списку";
      header('Location: book_page.php');
   }
} else {
   $q = "SELECT * FROM " . $list . " WHERE id_user = '$id_user' AND id_book = '$id_book'";
   $is_added = mysqli_query($link, $q);

   if (mysqli_num_rows($is_added) > 0) { //чи є ця книга в обраному списку?

      $_SESSION['message'] = "Книга \"" . $_SESSION['b_name'] . "\" вже є в списку Читаю";
      header('Location: book_page.php');

   } else {

      $q = "INSERT INTO " . $list . " (id_user, id_book) VALUES ('$id_user', '$id_book')"; // Додаємо книгу до обраного списку й видаляємо зі інших
      mysqli_query($link, $q);

      foreach ($delete as $delete_list) {
         if ($delete_list != $list) {
            $q = "DELETE FROM " . $delete_list . " WHERE (id_user = '$id_user' AND id_book = '$id_book')";
            mysqli_query($link, $q);
         }
      }
      $_SESSION['message'] = "Книгу \"" . $_SESSION['b_name'] . "\" додано до списку " . $list_name;
      header('Location: book_page.php');

   }
}
?>