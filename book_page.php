﻿<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
if (isset($_POST['id_book'])) {
   $_SESSION['id_book'] = $_POST['id_book'];
}
if (isset($_POST['b_name'])) {
   $_SESSION['b_name'] = $_POST['b_name'];
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
   <link href="css/book_page.css" rel="stylesheet">
   <title>
      <?php echo '«' . $_SESSION['b_name'] . '»' ?>
   </title>
</head>

<body>
   <div class="wrapper">
      <!-- -------------------- HEADER ----------------------- -->
      <header class="header">
         <div class="header__container _container">
            <a href="index.php"><img class="header__logo" src="img/logo.svg"></img></a>
            <form action="all_books.php" method="post">
               <ul class="menu__search">
                  <li class="menu__item">
                     <input type="search" name="search_key" class="input__search" placeholder="Пошук...">
                  </li>
                  <li class="menu__item">
                     <button style="background-color: rgba(0, 0, 0, 0); cursor: pointer   ;" type="submit"><img
                           src="img/search.svg" height="20" alt="Кнопка «input»"></button>
                  </li>
               </ul>
            </form>
            <div class="menu__icon">
               <span></span>
            </div>
            <nav class="header__menu menu">
               <ul class="menu__list">
                  <li class="menu__item">
                     <a href="all_books.php" class="menu__link">Бібліотека</a>
                  </li>
                  <li class="menu__item">
                     <a href="about_project.php" class="menu__link">Про сайт</a>
                  </li>
                  <?php include 'db_connect.php';
                  $id_book = $_SESSION['id_book'];
                  $q = "SELECT * FROM books WHERE id_book = '" . $id_book . "'";
                  $book_q = mysqli_query($link, $q);
                  $book = mysqli_fetch_assoc($book_q);
                  $_SESSION['b_name'] = $book['b_name'];

                  if (!empty($_SESSION['nick'])) { ?>
                  <li class="menu__item">
                     <a href="my_books.php" class="menu__link">Мої книжки</a>
                  </li>
                  <?php } ?>
                  <li class="menu__item">
                     <?php if (empty($_SESSION['nick'])) { ?>
                     <a href="login.php" class="menu__link">Увійти</a>
                     <?php } else { ?>
                     <a class="menu__link menu__login">
                        <?php echo $_SESSION['nick']; ?>
                     </a>
                     <span class="menu__arrow"></span>
                     <ul class="menu__sub-list">
                        <li>
                           <a href="profile.php" class="menu__sub-link">Профіль</a>
                        </li>
                        <li>
                           <a href="my_books.php" class="menu__sub-link">Мої книжки</a>
                        </li>
                        <?php if ($_SESSION['u_status'] == 'adm') { ?>
                        <li>
                           <a href="admin_page.php" class="menu__sub-link">Панель адміністратора</a>
                        </li>
                        <?php } ?>
                        <li>
                           <a href="logout.php" class="menu__sub-link">Вийти з акаунту</a>
                        </li>
                     </ul>
                     <?php } ?>
                  </li>
               </ul>
            </nav>
         </div>
      </header>
      <!-- ----------------------- PAGE ------------------ -->
      <main class="page">
         <div class="page__name">
            <h1 class="page__name-text">Про книгу</h1>
         </div>
         <div class="_container">
            <div class="book__info__container">
               <div class="cover__container">
                  <img src=<?php echo $book['picture'] ?> alt="Обкладанка" class="cover" width="200">
               </div>
               <div class="book-page__book__info">
                  <div class="stastics-align">
                     <div class="book__statistics">
                        <div class="info__views">
                           <img src="img/eye.svg" alt="" height="24" style="margin-right: 7px">
                           <?php echo $book['views_count'] ?>
                        </div>
                        <div class="info__rating">
                           <img src="img/star.svg" alt="" height="24" style="margin-right: 7px">
                           <p>
                              <?php echo $book['rating'] ?> <span
                                 style="font-size: 16px; color: rgba(0, 0, 0, 0.5); margin-right: 50px;">
                                 <?php echo $book['ratings_count'] ?>
                              </span>
                              <?php
                              if (isset($_SESSION['id_user'])) {
                                 $q = "SELECT * FROM ratings WHERE id_user = " . $_SESSION['id_user'] . " AND id_book = " . $_SESSION['id_book'];
                                 $user_rating = mysqli_query($link, $q);
                                 if (mysqli_num_rows($user_rating) > 0) {
                                    $user_rating = mysqli_fetch_assoc($user_rating); ?>
                              <span style="font-size: 16px; color: rgba(0, 0, 0, 0.5);">
                                 <?php echo "Ваша оцінка: " . $user_rating['rating'] ?>
                              </span>
                              <?php }
                              } ?>
                           </p>
                        </div>
                     </div>
                     <p class="info__in-list-count">
                        У списках у
                        <?php echo $book['in_list_count'] ?> людей
                     </p>
                  </div>
                  <div class="main__info">
                     <h3 class="info__name">
                        <?php echo $book['b_name'] ?>
                     </h3>
                     <h3 class="info__original-name">
                        <?php echo $book['original_name'] ?>
                     </h3>
                     <h3 class="info__author">
                        <?php echo $book['author'] ?>
                     </h3>
                  </div>
                  <div class="actions">
                     <form action="reading.php" method="post">
                        <input type="hidden" name="id_book" value=<?php echo $_SESSION['id_book']; ?>>
                        <input class="action" type="submit" value="Читати">
                     </form>
                     <?php if (!empty($_SESSION['nick'])) { ?>
                     <li class="action">
                        Додати до списку</a>
                        <ul class="action__ul">
                           <li>
                              <form action="add_book_to_list.php" method="post" class="form__action">
                                 <input type="hidden" name="list" value="list_reading">
                                 <input class="btn" type="submit" value="Читаю">
                              </form>
                              <form action="add_book_to_list.php" method="post" class="form__action">
                                 <input type="hidden" name="list" value="list_favorite">
                                 <input class="btn" type="submit" value="Улюблене">
                              </form>
                              <form action="add_book_to_list.php" method="post" class="form__action">
                                 <input type="hidden" name="list" value="list_in_plans">
                                 <input class="btn" type="submit" value="У планах">
                              </form>
                              <form action="add_book_to_list.php" method="post" class="form__action">
                                 <input type="hidden" name="list" value="list_readed">
                                 <input class="btn" type="submit" value="Прочитано">
                              </form>
                              <form action="add_book_to_list.php" method="post" class="form__action">
                                 <input type="hidden" name="list" value="list_abandoned">
                                 <input class="btn" type="submit" value="Покинуто">
                              </form>
                              <?php
                                 $delete = ['list_reading', 'list_favorite', 'list_in_plans', 'list_readed', 'list_abandoned'];
                                 $is_in_list = false;
                                 foreach ($delete as $delete_list) {
                                    $q = "SELECT * FROM " . $delete_list . " WHERE (id_user = '" . $_SESSION['id_user'] . "' AND id_book = '$id_book')";
                                    if (mysqli_num_rows(mysqli_query($link, $q)) > 0) {
                                       $is_in_list = true;
                                    }
                                 }
                                 if ($is_in_list) {
                                    ?>
                              <form action="add_book_to_list.php" method="post" class="form__action">
                                 <input type="hidden" name="list" value="delete">
                                 <input class="btn" style="color: #C10000;" type="submit" value="Видалити">
                              </form>
                              <?php } ?>
                           </li>
                        </ul>
                     </li>
                     <?php
                        $q = "SELECT * FROM ratings WHERE id_user = " . $_SESSION['id_user'] . " AND id_book = " . $_SESSION['id_book'];
                        if (mysqli_num_rows(mysqli_query($link, $q)) > 0) {
                        } else {
                           ?>
                     <li class="action">
                        <a>Оцінити</a>
                        <ul>
                           <li>
                              <?php
                                    for ($i = 1; $i <= 5; $i++) { ?>
                              <form action="rating.php" method="post" class="form__action">
                                 <input type="hidden" name="rating" value=<?php echo $i; ?>>
                                 <input style="color: #000;" class="btn" type="submit" value=<?php echo $i ?>>
                              </form>
                              <?php } ?>
                           </li>
                        </ul>
                     </li>
                     <?php }
                     } ?>
                  </div>
                  <div class="info__about">
                     <h3 class="info__about-name" style="font-size: 20px;">Опис</h3>
                     <h3 class="info__about-info">
                        <?php echo $book['b_description'] ?>
                     </h3>
                  </div>

                  <div class="info__about">
                     <h3 class="info__about-name">Опублікував</h3>
                     <h3 class="info__about-info">
                        <?php
                        $q = "SELECT * FROM users WHERE id_user=" . $book['id_publisher'];
                        $y = mysqli_query($link, $q);
                        $publisher = mysqli_fetch_assoc($y);
                        echo $publisher['nick'];
                        ?>
                     </h3>
                  </div>

                  <div class="info__about">
                     <h3 class="info__about-name">Дата написання</h3>
                     <h3 class="info__about-info">
                        <?php echo $book['data_writed'] . " рік" ?>
                     </h3>
                  </div>

                  <div class="info__about">
                     <h3 class="info__about-name">Дата опублікування</h3>
                     <h3 class="info__about-info">
                        <?php
                        $year = mb_substr($book['data_published'], 0, 4);
                        $month = mb_substr($book['data_published'], 5, 2);
                        $day = mb_substr($book['data_published'], 8, 2);
                        echo $date = $day . '.' . $month . '.' . $year; ?>
                     </h3>
                  </div>

                  <div class="info__about">
                     <h3 class="info__about-name">Жанри</h3>
                     <h3 class="info__about-info">
                        <?php echo $book['genres'] ?>
                     </h3>
                  </div>

                  <div class="info__about">
                     <h3 class="info__about-name">Обсяг</h3>
                     <h3 class="info__about-info">
                        <?php echo number_format($book['words_count'], 0, ".", " ") . " слів" ?>
                     </h3>
                  </div>

                  <div class="info__about">
                     <h3 class="info__about-name">Вікова категорія</h3>
                     <h3 class="info__about-info">
                        <?php echo $book['category'] ?>
                     </h3>
                  </div>
               </div>
            </div>
         </div>
      </main>
      <!------------------- FOOTER -------------------------->
      <footer class="footer">
         <nav class="footer__container _container">
            <div class="footer__column">
               <h5>Про проект</h5>
               <ul>
                  <li><a href="about_project.php">Що таке Itslibro?</a></li>
               </ul>
            </div>
            <div class="footer__column">
               <h5>Служба підтримки</h5>
               <ul>
                  <li><a href="">+(38) 095 489 16 59</a></li>
                  <li><a href="">libhelp@gmail.com</a></li>
               </ul>
            </div>
            <div class="footer__column">
               <h5>Слідкуйте за новинами</h5>
               <div class="footer__icons">
                  <a target="_blank" href="https://www.instagram.com/abviol999/"><img src="img/inst.svg" alt=""></a>
                  <a target="_blank" href="https://www.youtube.com/channel/UCC7NAPBjk0yZ4ee6WtH0ZCQ"><img
                        src="img/yt.svg" alt=""></a>
                  <a target="_blank" href="https://t.me/kyselovn"><img src="img/tg.svg" alt=""></a>
                  <a target="_blank" href="https://www.facebook.com/profile.php?id=61550906368344"><img src="img/fb.svg"
                        alt=""></a>
               </div>
            </div>
         </nav>
      </footer>
      </footer>
   </div>
   <script src="js/script.js"></script>
   <script src="js/book_page.js"></script>
   <script>
   if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
   }
   </script>
</body>

</html>

<?php
if (isset($_SESSION['message'])) {
   echo "<script>alert('" . $_SESSION['message'] . "')</script>";
   unset($_SESSION['message']);
}
?>