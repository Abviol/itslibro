<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
include 'db_connect.php';


function wholeWordTruncate($s, $characterCount)
{
   $return = $s;

   if (preg_match("/^.{1,$characterCount}\b\W*/su", $s, $match))
      return $match[0];
   else
      return mb_substr($return, 0, $characterCount);

}

function count_words_in_txt($path)
{
   $f = fopen($path, 'r');
   $text = '';
   $row_count = 1;
   while (!feof($f)) {
      $str = fgets($f);
      if ($str != '') {
         $str_in = $str;
         $str_out = '';
         while ($str_in !== '') {
            $match = wholeWordTruncate($str_in, 135);
            $i = iconv_strlen($match);
            $str_in = mb_substr($str_in, $i);
            $str_out .= $match . '\n';
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
   return str_word_count($text);
}

$b_name = $_POST['b_name'];
$original_name = $_POST['original_name'];
$author = $_POST['author'];
$data_writed = $_POST['data_writed'];
$genres = $_POST['genres'];
$category = $_POST['category'];
$b_description = $_POST['b_description'];
$cover = $_FILES['cover'];
$text = $_FILES['text'];
$date_published = date("d.m.20y");

$_SESSION['b_name'] = $b_name;
$_SESSION['original_name'] = $original_name;
$_SESSION['author'] = $author;
$_SESSION['data_writed'] = $data_writed;
$_SESSION['genres'] = $genres;
$_SESSION['category'] = $category;
$_SESSION['b_description'] = $b_description;
/* $_SESSION['cover'] = pathinfo($cover['tmp_name'], PATHINFO_DIRNAME) . $cover['name'];
$_SESSION['text'] = $text['tmp_name']; */

if ($b_name == "" || $original_name == "" || $data_writed == "" || $author == "" || $genres == "" || $b_description == "" || $category == "" || empty($cover['tmp_name']) || empty($text['tmp_name'])) { //все ли поля  заполнены?
   $_SESSION['message'] = 'Усі поля повинні бути заповнені!';
   header('Location: add_book.php');
} else {
   if (!is_numeric($data_writed)) {
      $_SESSION['message'] = "Рік написання має бути числом";
      header('Location: add_book.php');
   } else {
      $check_book = mysqli_query($link, "SELECT * FROM books WHERE b_name = '$b_name' AND original_name = '$original_name' AND author = '$author'");
      if (mysqli_num_rows($check_book) > 0) { //есть ли уже на сайте такая книга?
         $_SESSION['message'] = "Така книга вже є на сайті!";
         header('Location: add_book.php');
      } else {
         $q = "SELECT * FROM books";
         $id_book = mysqli_num_rows(mysqli_query($link, $q)) + 1;

         //получение данных о загруженной картинке
         $cover_info = pathinfo($cover['name']);
         $cover_ext = $cover_info['extension'];
         $path_cover = 'img/covers/' . $id_book . '.' . $cover_ext;
         move_uploaded_file($cover['tmp_name'], $path_cover);

         echo $cover_ext, '<br>';
         echo $path_cover, '<br><br>';

         //получение данных о загруженом .txt файле
         $id_publisher = $_SESSION['id_user'];
         $text_info = pathinfo($text['name']);
         $text_ext = $text_info['extension'];
         $word_count = count_words_in_txt($text['tmp_name']);
         $path_book = 'books/' . $id_book . '.txt';
         move_uploaded_file($text['tmp_name'], $path_book);

         echo $id_publisher, '<br>';
         echo $text_ext, '<br>';
         echo $word_count, '<br>';
         echo $path_book, '<br>';

         //добавление книги в базу данных
         $q = "INSERT INTO books (id_publisher, b_name, original_name, author, picture, data_writed, data_published, genres, words_count, b_description, category, views_count, in_list_count, rating, ratings_count) VALUES ('" . $id_publisher . "', '" . $b_name . "', '" . $original_name . "', '" . $author . "', '" . $path_cover . "', '" . $data_writed . "', '" . $date_published . "', '" . $genres . "', '" . $word_count . "', '" . $b_description . "', '" . $category . "', '0', '0', '0', '0')";

         echo '<br>' . $q . '<br>';
         var_dump(mysqli_query($link, $q));

         header('Location: admin_page.php');
         $_SESSION['message'] = "Книгу успішно додано до бази даних сайту!";
      }
   }
}
?>