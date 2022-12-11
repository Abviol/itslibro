<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
   <link href="css/reading.css" rel="stylesheet">
   <title>
      <?php 
      include 'db_connect.php';
      ini_set('session.save_path', getcwd() . '\sessions');
      session_start();
      echo '«' . $_SESSION ['b_name'] .'»'  ?>
   </title>
</head>

<?php
if (isset($_SESSION['id_book'])) {
   $path_txt = 'books/'.strval($_SESSION['id_book']).'.txt';
}

if (!empty($_POST['id_book'])) {
   $q = "SELECT * FROM books WHERE id_book = " . $_SESSION['id_book'];
   $book = mysqli_fetch_assoc(mysqli_query($link, $q));
   $views_count = $book['views_count'] + 1;
   $q = "UPDATE books SET views_count = " . $views_count . " WHERE id_book = " . $_SESSION['id_book'];
   mysqli_query($link, $q);
}

function wholeWordTruncate($s, $characterCount)
{
   $return = $s;

   if (preg_match("/^.{1,$characterCount}\b\W*/su", $s, $match))  //пояснити
      return $match[0];
   else
      return mb_substr($return, 0, $characterCount);

}

function read_txt($path, $page_number, $rows_on_page) // читання .txt файла
{
   $f = fopen($path, 'r');
   $text = '';
   $row_start = $rows_on_page * ($page_number - 1);
   $row_end = $rows_on_page * $page_number;
   $row_count = 1;
   while (!feof($f)) {
      $str = fgets($f); //получение строки
      if ($str != '') {
         $str_in = $str;
         $str_out = '';
         while ($str_in !== '') {
            $match = wholeWordTruncate($str_in, 105); // читання до первших 105 символів без разриву слів
            $i = iconv_strlen($match); // к-ть символів у прочитаному рядку
            $str_in = mb_substr($str_in, $i); // видаляємо прочитаний рядок
            if ($row_count <= $row_end && $row_count > $row_start) // перевірка на належність вибраної сторінки
               $str_out .= $match . '<br>'; // конкотенація прочитаного рядка до змінного з усім параграфом
            $row_count++;
         }
         $str = str_replace('<b</p><p style="margin-bottom: 15px;">', '', $str);
         $text .= '<p style="margin-bottom: 15px;">' . substr($str_out, 0, -4) . '</p>';
      }
   }
   fclose($f);
   return $text;
}

function check_row_count_txt($path) // получение количество строк во всем тексте
{
   $f = fopen($path, 'r');
   $row_count = 1;
   while (!feof($f)) {
      $str = fgets($f);
      if ($str !== '') {
         $str_in = $str;
         $str_out = '';
         while ($str_in !== '') {
            $match = wholeWordTruncate($str_in, 105);
            $i = iconv_strlen($match);
            $str_in = mb_substr($str_in, $i);
            $row_count++;
         }
         $str_out = str_replace('\n', '<br>', $str_out);
         $text .= '<p style="margin-bottom: 15px;">' . substr($str_out, 0, -2) . '</p>';
      }
   }
   return $row_count;
}
$rows_on_page = 100;

$page_count = ceil(check_row_count_txt($path_txt) / $rows_on_page);
if (isset($_GET['p'])) {
   if ($_GET['p'] > $page_count) {
      $page = $page_count;
   } else if ($_GET['p'] < $page_count) {
   $page = 1;
   }
} else {
   $page = 1;
}
?>

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
      <mane class="page">
         <div class="_container">
            <div class="reading__top">
               <a href="book_page.php" class="controls">
                  ←
               </a>
               <div class="pagination">
                  <?php
                        if ($page > 1) {?>
                  <a href="?p=<?= $page - 1 ?>">Попередня</a>
                  <?php }
                        if ($page > 3) { ?>
                  <a href="?p=1">1</a>
                  <?php
                        if ($page > 4) { ?> <a class="etc">...</a>
                  <?php }
                        }
                        $j = $page + 2;
                        $i = $page - 2;
                        if ($page < 3) {
                           $i = 1;
                        }
                        if ($page > $page_count - 2) {
                           $j = $page_count;
                        }
                        if ($page >= 3 && $page <= $page_count - 2) {
                           $j = $page + 2;
                           $i = $page - 2;
                        }
                        while ($i <= $j) { ?>
                  <a <?php if ($i==$page) echo 'class="active"' ?> href="?p=<?= $i ?>">
                     <?= $i ?>
                  </a>
                  <?php $i++;
                        }
                        if ($page < $page_count - 2) {
                           if ($page < $page_count - 3) ?>
                  <a class="etc">...</a>
                  <a href="?p=<?= $page_count ?>">
                     <?= $page_count ?>
                  </a>
                  <?php }
                        if ($page < $page_count) {?>
                  <a " href=" ?p=<?= $page + 1 ?>">Наступна</a>
                  <?php }?>
               </div>
               <form action="reading.php" method="get">
                  <input class="search-page__input" type="text" name="p" placeholder="Сторінка">
                  <button class="search-page__button" type="submit">Go</button>
               </form>
            </div>


            <div class="text__container">
               <?php
                  echo read_txt($path_txt, $page, $rows_on_page); 
               ?>
            </div>
            <div class="reading__bottom">
               <div class="pagination">
                  <?php
                                    if ($page > 1) {?>
                  <a href="?p=<?= $page - 1 ?>">Попередня</a>
                  <?php }
                                    if ($page > 3) { ?>
                  <a href="?p=1">1</a>
                  <?php
                                       if ($page > 4) { ?> <a class="etc">...</a>
                  <?php }
                                    }
                                    $j = $page + 2;
                                    $i = $page - 2;
                                    if ($page < 3) {
                                       $i = 1;
                                    }
                                    if ($page > $page_count - 2) {
                                       $j = $page_count;
                                    }
                                    if ($page >= 3 && $page <= $page_count - 2) {
                                       $j = $page + 2;
                                       $i = $page - 2;
                                    }
                                    while ($i <= $j) { ?>
                  <a <?php if ($i==$page) echo 'class="active"' ?> href="?p=<?= $i ?>">
                     <?= $i ?>
                  </a>
                  <?php $i++;
                                    }
                                    if ($page < $page_count - 2) {
                                       if ($page < $page_count - 3) ?>
                  <a class="etc">...</a>
                  <a href="?p=<?= $page_count ?>">
                     <?= $page_count ?>
                  </a>
                  <?php }
                                    if ($page < $page_count) {?>
                  <a " href=" ?p=<?= $page + 1 ?>">Наступна</a>
                  <?php }?>
               </div>
            </div>
         </div>
   </div>
   </mane>
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
   <script>
   f(window.history.replaceState) {
         indow.history.replaceState(null, null, window.location.href);
   </script>
</body>

</html>