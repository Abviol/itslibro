﻿<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';

if (isset($_SESSION['id_book'])) {
   $path_txt = 'books/'.strval($_SESSION['id_book']).'.txt';
}

$q = "SELECT * FROM books WHERE id_book = " . $_SESSION['id_book'];
$book = mysqli_fetch_assoc(mysqli_query($link, $q));
$views_count = $book['views_count'] + 1;
$q = "UPDATE books SET views_count = " . $views_count . " WHERE id_book = " . $_SESSION['id_book'];
mysqli_query($link, $q);

function wholeWordTruncate($s, $characterCount)
{
   $return = $s;

   if (preg_match("/^.{1,$characterCount}\b\W*/su", $s, $match))
      return $match[0];
   else
      return mb_substr($return, 0, $characterCount);

}

function read_txt($path, $page_number, $rows_on_page) // чтение .txt файла
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
            $match = wholeWordTruncate($str_in, 135); // чтение до первых 135 символов без разрыва слов
            $i = iconv_strlen($match); // кол-во символов в прочитанной строке
            $str_in = mb_substr($str_in, $i); // удаляем прочитанную строку
            if ($row_count <= $row_end && $row_count > $row_start) // проверка на принадлежность выбранной странице
               $str_out .= $match . '\n'; // конкотенация прочитанной строки к переменной со всем параграфом
            $row_count++;
         }
         $str_out = str_replace('\n', '<br>', $str_out);
         $str = str_replace('<b</p><p style="margin-bottom: 15px;">', '', $str);
         $row_bool = true;
         if ($str_out !== '' && $row_bool != false) {
            $text .= '<p style="margin-bottom: 15px;">' . substr($str_out, 0, -2) . '</p>';
            $row_bool = false;
         } else {
            $row_bool = true;
         }
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
            $match = wholeWordTruncate($str_in, 135);
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
   <link href="css/reading.css" rel="stylesheet">
   <title>
      <?php echo $_SESSION ['b_name'] ?>
   </title>
</head>

<?php
$page_count = ceil(check_row_count_txt($path_txt) / $rows_on_page);
if (isset($_GET['p'])) {
   $page = isset($_GET['p']) ? (int) $_GET['p'] : 0;
} else {
   $page = 1;
}
?>

<body>
   <div class="wrapper">
      <div class="_container">
         <div class="reading__top">
            <a href="index.php" class="controls">
               На головну
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
               <a <?php if ($i===$page) echo 'class="active"' ?> href="?p=<?= $i ?>">
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
            <a href="book_page.php" class="controls">
               Назад
            </a>
         </div>

         <div class="text__container">
            <?php
            echo read_txt($path_txt, $page, $rows_on_page); ?>
         </div>
         <div class="pagination" style="margin: 25px 0 40px 0;">
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
            <a <?php if ($i===$page) echo 'class="active"' ?> href="?p=<?= $i ?>">
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
   <script>
   if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
   }
   </script>
</body>

</html>