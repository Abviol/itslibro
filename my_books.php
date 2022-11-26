<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
setcookie("id_book", "");
include 'db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
   <link href="css/all_books.css" rel="stylesheet">
   <title>Мої книги</title>
</head>

<body>
   <div class="wrapper">
      <div class="_container">

         <form class="lists" method="post" action="my_books.php">
            <button class="list" name="selected_list" value="list_reading" type="submit">Читаю</button>
            <button class="list" name="selected_list" value="list_favorite" type="submit">Улюблене</button>
            <button class="list" name="selected_list" value="list_in_plans" type="submit">У планах</button>
            <button class="list" name="selected_list" value="list_readed" type="submit">Прочитано</button>
            <button class="list" name="selected_list" value="list_abandoned" type="submit">Покинуто</button>
         </form>

         <?php
         if (empty($_POST['selected_list'])) {
            $list = 'list_reading';
         } else {
            $list = $_POST['selected_list'];
         }
         $id_user = $_SESSION['id_user'];
         $q = "SELECT id_book FROM " . $list . " WHERE id_user = " . $id_user;
         $books = mysqli_query($link, $q);
         $book = mysqli_fetch_all($books);
         if (mysqli_num_rows($books) > 0) {
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
         } else { ?>
         <div class="list-nothing">
            <p>У цьому списку усто :`(</p>
         </div>
         <?php } ?>

      </div>
</body>

</html>