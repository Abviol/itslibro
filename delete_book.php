<?php
include 'db_connect.php';
ini_set('session.save_path', getcwd() . '\sessions');
session_start();

$id_book = $_POST['id_book'];
$id_user = $_SESSION['id_user'];

$path_book = 'books/' . $id_book . '.txt';
$path_cover = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM books WHERE id_book = '$id_book'"));
unlink($path_book);
unlink($path_cover['picture']);

$delete = ['list_reading', 'list_favorite', 'list_in_plans', 'list_readed', 'list_abandoned'];

foreach ($delete as $delete_list) {
   $q = "DELETE FROM " . $delete_list . " WHERE (id_user = '$id_user' AND id_book = '$id_book')";
   echo $q . '</br>';
   var_dump(mysqli_query($link, $q));
   echo '</br>';
}

$q = "DELETE FROM ratings WHERE id_book = '$id_book'";
echo $q . '</br>';
var_dump(mysqli_query($link, $q));
echo '</br>';

$q = "DELETE FROM books WHERE id_book = '$id_book'";
echo $q . '</br>';
mysqli_query($link, $q) or die(mysqli_error($link));

$_SESSION['message'] = 'Книгу успішно видалено';

header('Location: list_books.php');

?>