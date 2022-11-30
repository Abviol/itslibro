<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equv="X-UA-Compatible" content="IE=edge">
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
   <link
      href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic"
      rel="stylesheet" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="css/index.css">
   <title>Itslibro</title>
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
      <!------------------- SLOGAN -------------------------->
      <div class="slogan">
         <div class="slogan__upper">
            <ul class="slogan__backgr">
               <li>
                  <img src="img/mmm1.svg" alt="mmm1">
               </li>
               <li>
                  <img src="img/mmm2.svg" alt="mmm1">
               </li>
            </ul>
            <div class="slogan_container">
               <p class="slogan__text">
                  Itslibro — сайт,<br>
                  де ви знайдете будь-яку книгу на ваш смак
               </p>
            </div>
         </div>
      </div>
      <!------------------- PAGE -------------------------->
      <main class="page">
         <div class="page__books books">
            <div class="books__container _container">
               <div class="books__books">
                  <ul>
                     <li>
                        <h2 class="books__paragraaph">Популярні книжки</h2>
                     </li>
                     <li>
                        <a href="#">
                           <div class="books__more">
                              <div class="books__more-text">Ще</div>
                              <div class="books__more-arrow">
                                 <img src="img/arrow_right.svg" alt="">
                              </div>
                           </div>
                        </a>
                     </li>
                  </ul>
                  <div class="books__body">
                     <div class="books__list">
                        <div class="books__columun">
                           <div class="books__item item-book">
                              <div class="item-book__cover">
                                 <a href="#"><img src="img/covers/1.png" alt="Обкладанка"></a>
                              </div>
                              <div class="item-book__stars">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                              </div>
                              <a href="#">
                                 <h3 class="item-book__name">451 градус за Фаренгейтом</h3>
                              </a>
                              <a href="#">
                                 <h3 class="item-book__author">Рей Бредбері</h3>
                              </a>
                           </div>
                        </div>
                        <div class="books__columun">
                           <div class="books__item item-book">
                              <div class="item-book__cover">
                                 <a href="#"><img src="img/covers/1.png" alt="Обкладанка"></a>
                              </div>
                              <div class="item-book__stars">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                              </div>
                              <a href="#">
                                 <h3 class="item-book__name">451 градус за Фаренгейтом</h3>
                              </a>
                              <a href="#">
                                 <h3 class="item-book__author">Рей Бредбері</h3>
                              </a>
                           </div>
                        </div>
                        <div class="books__columun">
                           <div class="books__item item-book">
                              <div class="item-book__cover">
                                 <a href="#"><img src="img/covers/1.png" alt="Обкладанка"></a>
                              </div>
                              <div class="item-book__stars">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                              </div>
                              <a href="#">
                                 <h3 class="item-book__name">451 градус за Фаренгейтом</h3>
                              </a>
                              <a href="#">
                                 <h3 class="item-book__author">Рей Бредбері</h3>
                              </a>
                           </div>
                        </div>
                        <div class="books__columun">
                           <div class="books__item item-book">
                              <div class="item-book__cover">
                                 <a href="#"><img src="img/covers/1.png" alt="Обкладанка"></a>
                              </div>
                              <div class="item-book__stars">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                              </div>
                              <a href="#">
                                 <h3 class="item-book__name">451 градус за Фаренгейтом</h3>
                              </a>
                              <a href="#">
                                 <h3 class="item-book__author">Рей Бредбері</h3>
                              </a>
                           </div>
                        </div>
                        <div class="books__columun">
                           <div class="books__item item-book">
                              <div class="item-book__cover">
                                 <a href="#"><img src="img/covers/1.png" alt="Обкладанка"></a>
                              </div>
                              <div class="item-book__stars">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                              </div>
                              <a href="#">
                                 <h3 class="item-book__name">451 градус за Фаренгейтом</h3>
                              </a>
                              <a href="#">
                                 <h3 class="item-book__author">Рей Бредбері</h3>
                              </a>
                           </div>
                        </div>
                        <div class="books__columun">
                           <div class="books__item item-book">
                              <div class="item-book__cover">
                                 <a href="#"><img src="img/covers/1.png" alt="Обкладанка"></a>
                              </div>
                              <div class="item-book__stars">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                              </div>
                              <a href="#">
                                 <h3 class="item-book__name">451 градус за Фаренгейтом</h3>
                              </a>
                              <a href="#">
                                 <h3 class="item-book__author">Рей Бредбері</h3>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="page__books books">
            <div class="books__container _container">
               <div class="books__books">
                  <ul>
                     <li>
                        <h2 class="books__paragraaph">Новинки</h2>
                     </li>
                     <li>
                        <a href="#">
                           <div class="books__more">
                              <div class="books__more-text">Ще</div>
                              <div class="books__more-arrow">
                                 <img src="img/arrow_right.svg" alt="">
                              </div>
                           </div>
                        </a>
                     </li>
                  </ul>
                  <div class="books__body">
                     <div class="books__list">
                        <div class="books__columun">
                           <div class="books__item item-book">
                              <div class="item-book__cover">
                                 <a href="#"><img src="img/covers/1.png" alt="Обкладанка"></a>
                              </div>
                              <div class="item-book__stars">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                              </div>
                              <a href="#">
                                 <h3 class="item-book__name">451 градус за Фаренгейтом</h3>
                              </a>
                              <a href="#">
                                 <h3 class="item-book__author">Рей Бредбері</h3>
                              </a>
                           </div>
                        </div>
                        <div class="books__columun">
                           <div class="books__item item-book">
                              <div class="item-book__cover">
                                 <a href="#"><img src="img/covers/1.png" alt="Обкладанка"></a>
                              </div>
                              <div class="item-book__stars">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                              </div>
                              <a href="#">
                                 <h3 class="item-book__name">451 градус за Фаренгейтом</h3>
                              </a>
                              <a href="#">
                                 <h3 class="item-book__author">Рей Бредбері</h3>
                              </a>
                           </div>
                        </div>
                        <div class="books__columun">
                           <div class="books__item item-book">
                              <div class="item-book__cover">
                                 <a href="#"><img src="img/covers/1.png" alt="Обкладанка"></a>
                              </div>
                              <div class="item-book__stars">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                              </div>
                              <a href="#">
                                 <h3 class="item-book__name">451 градус за Фаренгейтом</h3>
                              </a>
                              <a href="#">
                                 <h3 class="item-book__author">Рей Бредбері</h3>
                              </a>
                           </div>
                        </div>
                        <div class="books__columun">
                           <div class="books__item item-book">
                              <div class="item-book__cover">
                                 <a href="#"><img src="img/covers/1.png" alt="Обкладанка"></a>
                              </div>
                              <div class="item-book__stars">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                              </div>
                              <a href="#">
                                 <h3 class="item-book__name">451 градус за Фаренгейтом</h3>
                              </a>
                              <a href="#">
                                 <h3 class="item-book__author">Рей Бредбері</h3>
                              </a>
                           </div>
                        </div>
                        <div class="books__columun">
                           <div class="books__item item-book">
                              <div class="item-book__cover">
                                 <a href="#"><img src="img/covers/1.png" alt="Обкладанка"></a>
                              </div>
                              <div class="item-book__stars">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                              </div>
                              <a href="#">
                                 <h3 class="item-book__name">451 градус за Фаренгейтом</h3>
                              </a>
                              <a href="#">
                                 <h3 class="item-book__author">Рей Бредбері</h3>
                              </a>
                           </div>
                        </div>
                        <div class="books__columun">
                           <div class="books__item item-book">
                              <div class="item-book__cover">
                                 <a href="#"><img src="img/covers/1.png" alt="Обкладанка"></a>
                              </div>
                              <div class="item-book__stars">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                                 <img src="img/star.svg" height="18px" alt="Зірка">
                              </div>
                              <a href="#">
                                 <h3 class="item-book__name">451 градус за Фаренгейтом</h3>
                              </a>
                              <a href="#">
                                 <h3 class="item-book__author">Рей Бредбері</h3>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="page__all-books _container">
            <a href="all_books.php">
               <div class="books__more">
                  <div class="books__more-text">Всі книги</div>
                  <div class="books__more-arrow">
                     <img src="img/arrow_right.svg" alt="">
                  </div>
               </div>
            </a>
         </div>

      </main>
      <!------------------- FOOTER -------------------------->
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
   <script src="js/script.js"></script>
</body>

</html>