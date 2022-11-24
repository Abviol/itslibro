<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';

$id_book = $_SESSION['id_book'];
$b_name = $_POST['b_name'];
$original_name = $_POST['original_name'];
$author = $_POST['author'];
$data_writed = $_POST['data_writed'];
$genres = $_POST['genres'];
$category = $_POST['category'];
$b_description = $_POST['b_description'];

$_SESSION['b_name'] = $b_name;
$_SESSION['original_name'] = $original_name;
$_SESSION['author'] = $author;
$_SESSION['data_writed'] = $data_writed;
$_SESSION['genres'] = $genres;
$_SESSION['category'] = $category;
$_SESSION['b_description'] = $b_description;


if ($b_name == "" || $original_name == "" || $data_writed == "" || $author == "" || $genres == "" || $b_description == "" || $category == "" /* || empty($cover['tmp_name']) */) { //все ли поля  заполнены?
   $_SESSION['message'] = 'Усі поля повинні бути заповнені!';
   header('Location: edit_book.php');
} else {
   if (!is_numeric($data_writed)) {
      $_SESSION['message'] = "Рік написання має бути числом";
      header('Location: edit_book.php');
   } else {
      $check_book = mysqli_query($link, "SELECT * FROM books WHERE b_name = '$b_name' AND original_name = '$original_name' AND author = '$author' AND id_book != '$id_book'");
      if (mysqli_num_rows($check_book) > 0) { //есть ли уже на сайте такая книга?
         $_SESSION['message'] = "Така книга вже є на сайті!";
         header('Location: edit_book.php');
      } else {

         $q = "UPDATE books SET b_name = '$b_name', original_name = '$original_name', author = '$author', data_writed = '$data_writed', genres = '$genres', b_description = '$b_description', category = '$category' WHERE id_book = '$id_book'";

         echo '<br>' . $q . '<br>';
         var_dump(mysqli_query($link, $q));

         echo $id_book;

         header('Location: list_books.php');
         $_SESSION['message'] = "Книгу успішно оновлено!";
      }
   }
}
?>