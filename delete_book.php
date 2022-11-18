<?php

include 'db_connect.php';

$id_book = $_POST['id_book'];
echo $id_book;

$q = "DELETE FROM books WHERE id_book = '$id_book'";
mysqli_query($link, $q);

header('Location: list_books.php');

?>