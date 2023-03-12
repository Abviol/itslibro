<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();

if (!empty($_POST['search_key'])) {
   $_SESSION['search_key'] = $_POST['search_key'];
}
$search_key = $_SESSION['search_key'];
$count = strlen($search_key);
if ($search_key[$count] == "") {
   $search_key = rtrim($search_key, ' ');
}

function wholeWordTruncate($s, $characterCount)
{
   $return = $s;

   if (preg_match("/^.{1,$characterCount}\b\W*/su", $s, $match))
      return $match[0];
   else
      return mb_substr($return, 0, $characterCount);

}

$order = '`b_name`';
if ($_POST['sorting_option'] == 'newest') {
   $order = '`data_published`';
} else if ($_POST['sorting_option'] == 'popular') {
   $order = '`views_count`';
} else if ($_POST['sorting_option'] == 'best') {
   $order = '`rating`';
} else if ($_POST['sorting_option'] == 'biggest') {
   $order = '`words_count`';
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
      <!-- -------------------- HEADER ----------------------- -->
      <header class="header">
         <div class="header__container _container">
            <a href="index.php"><img class="header__logo" src="img/logo.svg"></img></a>
            <form action="all_books.php" method="post">
               <ul class="menu__search">
                  <li class="menu__item">
                     <input type="search" name="search_key" class="input__search" placeholder="Пошук..." value=<?php
                     echo "\"" . $search_key . "\"" ?>\">
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
            <h1 class="page__name-text">Бібліотека</h1>
         </div>
         <div class="_container">
            <div class="all-books__container">
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
                  $q = "SELECT * FROM `books` WHERE " . implode("", $array) . " ORDER BY " . $order . " DESC";
                  unset($_SESSION['search_key']);
                  if (mysqli_num_rows(mysqli_query($link, $q)) == 0) { ?>
               <div class="list-nothing">
                  <p>Нічого не знайдено :'(</p>
               </div>
               <?php }
               } else {
                  $q = "SELECT * FROM books ORDER BY " . $order . " DESC";
               }
               $book = mysqli_query($link, $q);
               $book = mysqli_fetch_all($book);
               foreach ($book as $book) {
                  $q1 = "SELECT * FROM books WHERE id_book=" . $book[0];
                  $y = mysqli_query($link, $q1);
                  $books = mysqli_fetch_assoc($y);
                  $age_limit = 0;
                  if ($books['category'] == '12+') {
                     $age_limit = 12;
                  } else if ($books['category'] == '18+') {
                     $age_limit = 18;
                  }
                  if (!empty($_SESSION['id_user'])) {
                     $q2 = "SELECT * FROM users WHERE id_user = '" . $_SESSION['id_user'] . "'";
                     $current_user = mysqli_fetch_assoc(mysqli_query($link, $q2));
                     $age_user = $current_user['age'];
                  } else {
                     $age_user = 18;
                  }

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
               ?>
            </div>
            <div class="sort-books">
               <h3 class="sort-text">Сортування</h3>
               <form class="sorting-options" action="all_books.php" method="post">
                  <label class="sorting-option">
                     <input type="radio" name="sorting_option" value="newest" <?php if (
                        empty($_POST['sorting_option'])
                        || $_POST['sorting_option'] == "newest"
                     )
                        echo "checked"; ?>>
                     <span class="radio"></span>за новизною
                  </label>
                  <label class="sorting-option">
                     <input type="radio" name="sorting_option" value="popular" <?php if (
                        $_POST['sorting_option'] == "popular"
                     )
                        echo "checked"; ?>>
                     <span class="radio"></span>за популярністю
                  </label>
                  <label class="sorting-option">
                     <input type="radio" name="sorting_option" value="best" <?php if (
                        $_POST['sorting_option'] == "best"
                     )
                        echo "checked"; ?>>
                     <span class="radio"></span>за рейтингом
                  </label>
                  <label class="sorting-option">
                     <input type="radio" name="sorting_option" value="biggest" <?php if (
                        $_POST['sorting_option'] == "biggest"
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
   <script>
   if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
   }
   </script>
</body>

</html>