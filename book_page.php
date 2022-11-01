<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';

$id_book = $_POST['id_book'];

$q = "SELECT * FROM books WHERE id_book = '" . $id_book . "'";
$book_q = mysqli_query($link, $q);
$book = mysqli_fetch_assoc($book_q);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
   <link href="css/book_page.css" rel="stylesheet">
   <title>Сторінка книжки</title>
</head>

<body>
   <div class="wrapper">
      <div class="_container">
         <div class="book__info__container">
            <div class="cover__container">
               <img src=<?php echo $book['picture'] ?> alt="Обкладанка">
            </div>
            <div class="book-page__book__info">

               <div class="book__statistics">
                  <h3 class="info__views">
                     <?php echo "Кількість переглядів: " . $book['views_count'] ?>
                  </h3>

                  <h3 class="info__rating">
                     <?php echo "Оцінка: " . $book['rating'] . " (кількість оцінок: " . $book['ratings_count'] . ")" ?>
                  </h3>
               </div>

               <h3 class="info__name">
                  <?php echo "\"" . $book['b_name'] . "\"" ?>
               </h3>

               <h3 class="info__author">
                  <?php echo $book['author'] ?>
               </h3>

               <h3 class="info__about">
                  <?php echo '<b>Опис:</b> ' . $book['b_description'] ?>
               </h3>

               <h3 class="info__about">
                  <?php
                  $q = "SELECT * FROM users WHERE id_user=" . $book['id_publisher'];
                  $y = mysqli_query($link, $q);
                  $publisher = mysqli_fetch_assoc($y);
                  echo "<b>Опублікував: </b>" . $publisher['nick'];
                  ?>
               </h3>

               <h3 class="info__about">
                  <?php echo "<b>Дата написання: </b>" . $book['data_writed']; ?>
               </h3>

               <h3 class="info__about">
                  <?php echo "<b>Дата опублікування: </b>" . mb_substr($book['data_published'], 8, 2) . "." . mb_substr($book['data_published'], 5, 2) . "." . mb_substr($book['data_published'], 0, 4) ?>
               </h3>

               <h3 class="info__about">
                  <?php echo "<b>Жанри: </b>" . $book['genres'] ?>
               </h3>

               <h3 class="info__about">
                  <?php echo "<b>Кількість сторінок: </b>" . $book['page_count'] ?>
               </h3>

               <h3 class="info__about">
                  <?php echo "<b>Вікова категорія: </b>" . $book['category'] ?>
               </h3>
               <!-- <form action="book_page.php" method="post">
               </form> -->
            </div>
         </div>
      </div>
</body>