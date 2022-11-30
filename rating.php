<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';

$rating = $_POST['rating'];
$id_user = $_SESSION['id_user'];
$id_book = $_SESSION['id_book'];

$q = "SELECT * FROM books WHERE id_book = " . $id_book;
$ratings_count = mysqli_fetch_assoc(mysqli_query($link, $q));

$q = "SELECT rating FROM ratings WHERE id_book = " . $id_book;
$ratings = mysqli_fetch_all(mysqli_query($link, $q));
$book_rating = 0;
$i = 0;
for ($i = 0; $i < count($ratings); $i++) {
   $book_rating += $ratings[$i][0];
}

$q = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('$id_book', '$id_user', '$rating')";
mysqli_query($link, $q);

$ratings_count = $ratings_count['ratings_count'] + 1;
$book_rating = round(($book_rating + floatval($rating)) / floatval($ratings_count), 1);

$q = "UPDATE books SET rating = " . $book_rating . ", ratings_count = " . $ratings_count . " WHERE id_book = " . $id_book;
mysqli_query($link, $q);

$_SESSION['message'] = "Дякуємо за відгук!";

header('Location: book_page.php');
?>