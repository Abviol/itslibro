<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';

if (!empty($_POST['search_key'])) {
   $_SESSION['search_key'] = $_POST['search_key'];
}
$search_key = $_SESSION['search_key'];
$count = strlen($search_key);
if ($search_key[$count] == "") {
   $search_key = rtrim($search_key, ' ');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
   <link href="css/all_books.css" rel="stylesheet">
   <title>Всі книги</title>
</head>

<body>
   <div class="wrapper">
      <div class="_container">
         <?php
         if ($search_key != "") {
            $search = explode(" ", $search_key);
            $count = count($search);
            $array = array();
            $i = 0;
            foreach ($search as $key) {
               $i++;
               if ($key != "") {
                  if ($i < $count) {
                     $array[] = "CONCAT (`b_name`, `original_name`, `author`, `genres`) LIKE '%" . $key . "%' OR ";
                  } else {
                     $array[] = "CONCAT (`b_name`, `original_name`, `author`, `genres`) LIKE '%" . $key . "%'";
                  }
               }
            }
            $q = "SELECT * FROM `books` WHERE " . implode("", $array) . " ORDER BY `b_name`";
            unset($_SESSION['search_key']);
         } else {
            $q = "SELECT * FROM books";
         }
         $book = mysqli_query($link, $q);
         $book = mysqli_fetch_all($book);
         foreach ($book as $book) {
            $q1 = "SELECT * FROM books WHERE id_book=" . $book[0];
            $y = mysqli_query($link, $q1);
            $books = mysqli_fetch_assoc($y); ?>

         <div class="all-books__book">
            <a href="#">
               <div class="cover__container">
                  <img src=<?php echo $books['picture'] ?> alt="Обкладанка" height="150" width="100">
               </div>
            </a>
            <div class="all-books__book__info">
               <a href="#">
                  <h3 class="info__name">
                     <?php echo "\"" . $books['b_name'] . "\"" ?>
                  </h3>
               </a>
               <a href="#">
                  <h3 class="info__author">
                     <?php echo $books['author'] ?>
                  </h3>
               </a>
               <h3 class="info__rating">
                  <?php echo "Оцінка: " . $books['rating'] ?>
               </h3>
               <a href="#">
                  <h3 class="info__about">
                     <?php echo mb_substr($books['b_description'], 0, 250) . "..." ?>
                  </h3>
               </a>
               <form action="book_page.php" method="post">
                  <input type="hidden" name="id_book" value=<?php echo $book[0]; ?>>
                  <input class="btn" type="submit" value="Детальніше">
               </form>
            </div>
         </div>

         <?php
         }
         ?>

      </div>
      <script>
      if (window.history.replaceState) {
         window.history.replaceState(null, null, window.location.href);
      }
      </script>
</body>

</html>