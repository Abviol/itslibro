<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();

if (!isset($_SESSION['nick'])) {
   header('Location: index.php');
}

if (!empty( $_SESSION['search_key'])) {
   $search_key = $_SESSION['search_key'];
   $count = strlen($search_key);
   if ($search_key[$count]) {
      $search_key = rtrim($search_key, ' ');
   }
} else {
   $search_key = '';
}

function wholeWordTruncate($s, $characterCount)
{
   $return = $s;

   if (preg_match("/^.{1,$characterCount}\b\W*/su", $s, $match))
      return $match[0];
   else
      return mb_substr($return, 0, $characterCount);

}

$order;
$selected_option;

if (!empty($_POST['sorting_option'])) {
      if ($_POST['sorting_option'] == 'newest') {
      $order = '`data_published`';
      $selected_option = 'newest';
   } else if ($_POST['sorting_option'] == 'popular') {
      $order = '`views_count`';
      $selected_option = 'popular';
   } else if ($_POST['sorting_option'] == 'best') {
      $order = '`rating`';
      $selected_option = 'best';
   } else if ($_POST['sorting_option'] == 'biggest') {
      $order = '`words_count`';
      $selected_option = 'biggest';
   }
} else {
   // $order = '`b_name`';
   $order = '`data_published`';
   $selected_option = 'newest';
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
   <title>Мої книги</title>
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
      <!-- ----------------------- PAGE ------------------ -->
      <main class="page">
         <?php
         if (empty($_SESSION['selected_list'])) {
            $_SESSION['selected_list'] = 'list_reading';
         }
         if (empty($_POST['selected_list'])) {
            $list = $_SESSION['selected_list'];
         } else {
            $list = $_POST['selected_list'];
            $_SESSION['selected_list'] = $list;
         }
         ?>
         <div class="page__name">
            <h1 class="page__name-text">Мої книжки</h1>
         </div>
         <form class="lists" method="post" action="my_books.php">
            <button <?php if ($_SESSION['selected_list'] == 'list_reading') {
               echo 'class="list_selected"';
            } else {
               echo
                  'class="list"';
            } ?> name="selected_list" value="list_reading" type="submit">Читаю 📖</button>
            <button <?php if ($_SESSION['selected_list'] == 'list_favorite') {
               echo 'class="list_selected"';
            } else {
               echo
                  'class="list"';
            } ?> name="selected_list" value="list_favorite" type="submit">Улюблене 😍</button>
            <button <?php if ($_SESSION['selected_list'] == 'list_in_plans') {
               echo 'class="list_selected"';
            } else {
               echo
                  'class="list"';
            } ?> name="selected_list" value="list_in_plans" type="submit">У планах 📅</button>
            <button <?php if ($_SESSION['selected_list'] == 'list_readed') {
               echo 'class="list_selected"';
            } else {
               echo
                  'class="list"';
            } ?> name="selected_list" value="list_readed" type="submit">Прочитано ✅</button>
            <button <?php if ($_SESSION['selected_list'] == 'list_abandoned') {
               echo 'class="list_selected"';
            } else {
               echo 'class="list"';
            } ?> name="selected_list" value="list_abandoned" type="submit">Покинуто🥱</button>
         </form>
         <div class="_container">
            <div class="all-books__container">
               <?php


               $id_user = $_SESSION['id_user'];
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
                  $q = "SELECT * FROM `books` WHERE " . implode("", $array) . " ORDER BY " . $order . " DESC";
                  unset($_SESSION['search_key']);
               } else {
                  $q = "SELECT * FROM books ORDER BY " . $order . " DESC";
               }
               $books = mysqli_query($link, $q);
               $book = mysqli_fetch_all($books);
               $id_user = $_SESSION['id_user'];
               $q1 = "SELECT id_book FROM " . $list . " WHERE id_user = " . $id_user;
               $books_in_list = mysqli_query($link, $q1);
               $book_in_list = mysqli_fetch_all($books_in_list);
               if (mysqli_num_rows($books_in_list) > 0) {
                  foreach ($book as $book) {
                     $check = "SELECT * FROM " . $list . " WHERE id_book = " . $book[0] . " AND id_user = " . $id_user;
                     if (mysqli_num_rows(mysqli_query($link, $check)) > 0) {
                        $q1 = "SELECT * FROM books WHERE id_book=" . $book[0];
                        $y = mysqli_query($link, $q1);
                        $books = mysqli_fetch_assoc($y);
                        $age_limit = 0;
                        if ($books['category'] == '12+') {
                           $age_limit = 12;
                        } else if ($books['category'] == '18+') {
                           $age_limit = 18;
                        }
                        $q2 = "SELECT * FROM users WHERE id_user = '" . $_SESSION['id_user'] . "'";
                        $current_user = mysqli_fetch_assoc(mysqli_query($link, $q2));
                        $age_user = $current_user['age'];
                        if ($age_user >= $age_limit) {
                           ?>
               <div class="all-books__book">
                  <div class="cover__container">
                     <img src=<?php echo $books['picture'] ?> alt="Обкладанка" height="150" width="100"
                        style="border-radius: 10px;">
                     <form action="book_page.php" method="post">
                        <input type="hidden" name="id_book" value=<?php echo $book[0]; ?>>
                        <input type="hidden" name="b_name" value=<?php echo $books['b_name']; ?>>
                        <input class="learn-more" type="submit" value="Детальніше" style="width: 100px;">
                     </form>
                  </div>
                  <div class="all-books__book__info">
                     <h3 class="info__name">
                        <?php echo $books['b_name'] ?>
                     </h3>
                     <h3 class="info__author">
                        <?php echo $books['author'] ?>
                     </h3>
                     <div class="info__rating">
                        <img src="img/star.svg" alt="" height="16" style="margin-right: 4px">
                        <p>
                           <?php echo $books['rating'] ?>
                        </p>
                     </div>
                     <h3 class="info__about">
                        <?php
                                    $desc = $books['b_description'];
                                    if (strlen($desc) > 320) {
                                       echo wholeWordTruncate($books['b_description'], 320) . "...";
                                    } else {
                                       echo $desc;
                                    }
                                    ?>
                     </h3>
                  </div>
               </div>
               <?php
                        }
                     }
                  }
               } else { ?>
               <div class="list-nothing">
                  <p>У цьому списку пусто :'(</p>
               </div>
               <?php } ?>
            </div>
            <div class="sort-books">
               <h3 class="sort-text">Сортування</h3>
               <form class="sorting-options" action="all_books.php" method="post">
                  <label class="sorting-option">
                     <input type="radio" name="sorting_option" value="newest" <?php if (
                       $selected_option == "newest"
                     )
                        echo "checked"; ?>>
                     <span class="radio"></span>за новизною
                  </label>
                  <label class="sorting-option">
                     <input type="radio" name="sorting_option" value="popular" <?php if (
                        $selected_option == "popular"
                     )
                        echo "checked"; ?>>
                     <span class="radio"></span>за популярністю
                  </label>
                  <label class="sorting-option">
                     <input type="radio" name="sorting_option" value="best" <?php if (
                        $selected_option == "best"
                     )
                        echo "checked"; ?>>
                     <span class="radio"></span>за рейтингом
                  </label>
                  <label class="sorting-option">
                     <input type="radio" name="sorting_option" value="biggest" <?php if (
                        $selected_option == "biggest"
                     )
                        echo "checked"; ?>>
                     <span class="radio"></span>за обсягом
                  </label>
                  <input class="learn-more" type="submit" value="Сортувати" style="margin-top: 5px; font-size: 16px;">
               </form>
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
   </div>
   <script src="js/script.js"></script>
   <script>
   if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
   }
   </script>
</body>

</html>