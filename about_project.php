<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
   <link href="css/index.css" rel="stylesheet">
   <title>Що таке Itslibro?</title>
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
            <h1 class="page__name-text">Що таке Itslibro?</h1>
         </div>
         <div class="_container">
            <div class="about__container">
               <p style="margin-bottom: 45px;">
                  <span style="  font-size: 28px;">Itslibro</span> — сайт онлайн-бібліотеки, який було
                  розроблено в процесі виконання випускної роботи за темою "Створення сайту онлайн-бібліотеки". <br>Ідея
                  проекту — створити український сайт із приємним, сучасним дизайном, зручним
                  інтерфейсом, де можна почитати книгу на будь-який смак.
               </p>

               <p>

               </p>
               <p>
                  <b>Автор:</b> Кисельов Назар Олексійович.
               </p>
               <p>
                  <b>Науковий керівник:</b> Пасько Анатолій Іванович.
               </p>
               <p style="margin-bottom: 45px;">
                  <b>Навчальний заклад:</b> Дніпровський ліцей інформаційних технологій при ДНУ ім. Олеся Гончара.
               </p>
               <p>
                  Цей сайт був створений з ціллю практики навичок з програмування і <b>не є комерційним</b>.
               </p>
               <p style="margin: 100px 0 0 0; font-size: 16px;">
                  2022 р.
               </p>
               <p style="font-size: 16px;">
                  Україна, Дніпро
               </p>
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
                  <a target="_blank" target="_blank" href="https://www.instagram.com/abviol999/"><img src="img/inst.svg"
                        alt=""></a>
                  <a target="_blank" href="https://www.youtube.com/channel/UCC7NAPBjk0yZ4ee6WtH0ZCQ"><img
                        src="img/yt.svg" alt=""></a>
                  <a target="_blank" href="https://t.me/kyselovn"><img src="img/tg.svg" alt=""></a>
                  <a target="_blank" href="https://www.facebook.com/profile.php?id=61550906368344"><img src="img/fb.svg"
                        alt=""></a>
               </div>
            </div>
         </nav>
      </footer>
   </div>
   <script src="js/script.js"></script>
   <script>
   if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
   }
   </script>
</body>

</html>