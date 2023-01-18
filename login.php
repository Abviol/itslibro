<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Вхід</title>
   <link href="css/log.css" rel="stylesheet" />
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
</head>

<body>
   <div class="wrapper">
      <!------------------- HEADER -------------------------->
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
                  <li class="menu__item">
                     <a href="login.php" class="menu__link">Увійти</a>
                  </li>
               </ul>
            </nav>
         </div>
      </header>
      <!------------------- PAGE -------------------------->
      <main class="page">
         <div class="_container">

            <div class="page__name">
               <h1 class=" page__name-text">Вхід</h1>
            </div>

            <form action="signin.php" method="post" class="form__action">

               <input class="input_info" type="text" name="nick" placeholder="Введіть нікнейм чи e-mail">

               <input class="input_info" type="password" name="pwd" placeholder="Введіть пароль">

               <button class="action" type="submit">Увійти</button>

               <?php
               if ($_SESSION['message']) {
                  echo '<p class="msg">' . $_SESSION['message'] . '</p>';
               }
               unset($_SESSION['message']);
               ?>

               <p>Ще не зареєструвались? - <a href="register.php" class="act_link">зробіть це зараз!</a></p>

            </form>
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
                  <a href="https://www.instagram.com/abviol999/"><img src="img/inst.svg" alt=""></a>
                  <a href="https://www.youtube.com/channel/UCC7NAPBjk0yZ4ee6WtH0ZCQ"><img src="img/yt.svg" alt=""></a>
                  <a href="https://t.me/abviol"><img src="img/tg.svg" alt=""></a>
                  <a href="https://www.facebook.com/profile.php?id=100059965062647"><img src="img/fb.svg" alt=""></a>
               </div>
            </div>
         </nav>
      </footer>
   </div>
   <script src="js/script.js"></script>
</body>

</html>