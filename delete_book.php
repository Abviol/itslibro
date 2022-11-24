<?php

include 'db_connect.php';

$id_book = $_POST['id_book'];

$path_book = 'books/' . $id_book . '.txt';
$path_cover = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM books WHERE id_book = '$id_book'"));
unlink($path_book);
unlink($path_cover['picture']);
$q = "DELETE FROM books WHERE id_book = '$id_book'";
mysqli_query($link, $q);

header('Location: list_books.php');

?>