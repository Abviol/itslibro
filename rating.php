<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';

$rating = $_POST['rating'];
$id_user = $_SESSION['id_user'];
$id_book = $_SESSION['id_book'];

echo $rating;
echo $id_user;
echo $id_book;

$q = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('$id_book', '$id_user', '$rating')";
mysqli_query($link, $q);

$q = "SELECT * FROM books WHERE id_book = " . $id_book;
$book_rating = mysqli_fetch_assoc(mysqli_query($link, $q));
$ratings_count = $book_rating['ratings_count'] + 1;
$book_rating = ($book_rating['rating'] + $rating) / $ratings_count;

$q = "UPDATE books SET ratings = " . $book_rating . ", ratings_count = " . $ratings_count . " WHERE id_book = " . $id_book;
mysqli_query($link, $q);

$_SESSION['message'] = "Дякуємо за відгук!";

header('Location: book_page.php');
?>