<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();

$id_book = $_POST['id_book'];
$_SESSION['id_book'] = $id_book;

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="css/log.css" rel="stylesheet" />
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
   <title>Додати книгу</title>
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
                  $q = "SELECT * FROM books WHERE id_book = '" . $id_book . "'";
                  $book_q = mysqli_query($link, $q);
                  $book = mysqli_fetch_assoc($book_q);
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
      <!------------------- PAGE -------------------------->
      <main class="page">
         <div class="_container">

            <div class="page__name">
               <h1 class=" page__name-text">Оновити книгу</h1>
            </div>


            <form action="edit_book_handle.php" method="post" enctype="multipart/form-data" class="form__action">

               <input class="input_info" type="text" name="b_name" value="<?php echo $book['b_name']; ?>"
                  placeholder="Вкажіть назву книги українською мовою">

               <input class="input_info" type="text" name="original_name" value="<?php echo $book['original_name']; ?>"
                  placeholder="Вкажіть оригінальну назву книги">

               <input class="input_info" type="text" name="author" value="<?php echo $book['author']; ?>"
                  placeholder="Вкажіть ПІБ автора">

               <input class="input_info" type="text" name="data_writed" value="<?php echo $book['data_writed']; ?>"
                  placeholder="Вкажість рік, коли автор закінчив книгу">

               <input class="input_info" type="text" name="genres" value="<?php echo $book['genres']; ?>"
                  placeholder="Вкажіть жанри книги через кому">

               <textarea
                  style="width: 100%; resize: none; margin-bottom: 20px; padding: 10px 20px; border: unset; background-color: #f5f5f5; outline: none; font-family: Roboto; border-radius: 10px;"
                  name="b_description" id="b_description" cols="10" rows="5" placeholder="Коротко опишіть книгу"
                  maxlength="500"><?php echo $book['b_description']; ?></textarea>

               <label class="act_name">Категорія</label>
               <label class="option"><input type="radio" name="category"
                     <?php if ($book['category'] == "Для будь-якого віку" || isset($_SESSION['category']) && $_SESSION['category']=="Для будь-якого віку") echo "checked"; ?>
                     value="Для будь-якого віку">
                  <span class="radio"></span>Для будь-якого віку
               </label>
               <label class="option"><input type="radio" name="category" <?php if ($book['category'] == "12+" || isset($_SESSION['category']) && $_SESSION['category'] == "12+")
                     echo
                  "checked"; ?> value="12+">
                  <span class="radio"></span>12+
               </label>
               <label class="option" style="margin-bottom: 20px;"><input type="radio" name="category" <?php if ($book['category'] == "18+" || isset($_SESSION['category']) && $_SESSION['category'] == "18+")
                     echo
                  "checked"; ?> value="18+">
                  <span class="radio"></span>18+
               </label>

               <button class="action" type="submit">Оновити</button>

               <?php
            if ($_SESSION['message']) {
               echo '<p class="msg">' . $_SESSION['message'] . '</p>';
            }
            unset($_SESSION['message']);
            unset($_SESSION['b_name']);
            unset($_SESSION['original_name']);
            unset($_SESSION['author']);
            unset($_SESSION['data_writed']);
            unset($_SESSION['genres']);
            unset($_SESSION['category']);
            unset($_SESSION['b_description']);
            ?>

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