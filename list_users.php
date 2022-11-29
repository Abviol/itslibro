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
   <link href="css/index.css" rel="stylesheet" />
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
   <title>Список користувачів</title>
</head>

<body>
   <div class="wrapper">
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
                     <a href="" class="menu__link">Про сайт</a>
                  </li>
                  <!-- <li class="menu__item">
                              <a href="" class="menu__link">Підписка</a>
                              <span class="menu__arrow"></span>
                              <ul class="menu__sub-list">
                                 <li>
                                    <a href="" class="menu__sub-link">Оформити підписку</a>
                                 </li>
                                 <li>
                                    <a href="" class="menu__sub-link">Ввести промокод</a>
                                 </li>
                              </ul>
                           </li> -->
                  <?php include 'db_connect.php';

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
                           <a href="admin_page.php" class="menu__sub-link">Сторінка адміністратора</a>
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
      <!------------------- Page -------------------------->
      <main class="page">
         <div class="page__name">
            <h1 class="page__name-text">Список користувачів</h1>
         </div>
         <div class="_container">
            <div class="admin__panel" style="flex-direction: row;">
               <table class="panel__table">
                  <thead>
                     <tr>
                        <th>id користувача</th>
                        <th>Нік</th>
                        <th>e-mail</th>
                        <th>Пароль</th>
                        <th>Вік</th>
                        <th>Аватар</th>
                        <th>Про користувача</th>
                        <th>Статус</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     include 'db_connect.php';

                     //виведення даних користувачів з таблиці users
                     mysqli_select_db($link, 'itslibro1');
                     $q = "SELECT * FROM users";
                     $user = mysqli_query($link, $q);
                     $user = mysqli_fetch_all($user);
                     foreach ($user as $client) { ?>
                     <tr>
                        <td>
                           <?= $client[0] ?>
                        </td>
                        <td>
                           <?= $client[1] ?>
                        </td>
                        <td>
                           <?= $client[2] ?>
                        </td>
                        <td>
                           <?= $client[3] ?>
                        </td>
                        <td>
                           <?= $client[4] ?>
                        </td>
                        <td>
                           <?= $client[5] ?>
                        </td>
                        <td>
                           <?= $client[6] ?>
                        </td>
                        <td>
                           <?= $client[7] ?>
                        </td>
                     </tr>
                     <?php } ?>
                  </tbody>
               </table>
            </div>
      </main>
      <!------------------- Footer -------------------------->
      <footer class="footer">
         <nav class="footer__container _container">
            <div class="footer__column">
               <h5>Про проект</h5>
               <ul>
                  <li><a href="">Що таке Itslibro?</a></li>
               </ul>
            </div>
            <div class="footer__column">
               <h5>Підписка</h5>
               <ul>
                  <li><a href="">Оформити підписку</a></li>
                  <li><a href="">Ввести промокод</a></li>
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
</body>
<script src="js/script.js"></script>

</html>