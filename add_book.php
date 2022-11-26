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
   <link href="css/log.css" rel="stylesheet" />
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
   <title>Додати книгу</title>
</head>

<body>
   <div class="wrapper">
      <div class="_container">
         <form action="add_book_handle.php" method="post" enctype="multipart/form-data">
            <label>Назва книги</label>
            <input type="text" name="b_name" value="<?php echo $_SESSION['b_name']; ?>"
               placeholder="Вкажіть назву книги українською мовою">

            <label>Оригінальна назва</label>
            <input type="text" name="original_name" value="<?php echo $_SESSION['original_name']; ?>"
               placeholder="Вкажіть оригінальну назву книги">

            <label>Автор</label>
            <input type="text" name="author" value="<?php echo $_SESSION['author']; ?>"
               placeholder="Вкажіть ПІБ автора">

            <input type="hidden" name="id_book" value="<?php echo $_SESSION['id_book'] ?>">


            <label>Рік написання</label>
            <input type="text" name="data_writed" value="<?php echo $_SESSION['data_writed']; ?>"
               placeholder="Вкажість рік, коли автор закінчив книгу">

            <label>Жанри</label>
            <input type="text" name="genres" value="<?php echo $_SESSION['genres']; ?>"
               placeholder="Вкажіть жанри книги через кому">

            <label for="b_description">Опис</label>
            <textarea
               style="resize: none; margin: 10px 0; padding: 10px; border: unset; border: 2px solid #dddddd; outline: none; font-family: Roboto; border-radius: 10px;"
               name="b_description" id="b_description" cols="10" rows="5" placeholder="Коротко опишіть книгу"
               maxlength="1000"><?php echo $_SESSION['b_description']; ?></textarea>

            <label>Категорія</label>
            <label>
               <input type="radio" name="category"
                  <?php if (isset($_SESSION['category']) && $_SESSION['category']=="Для будь-якого віку") echo "checked"; ?>
                  value="Для будь-якого віку">Для
               будь-якого віку
            </label>
            <label for=""><input type="radio" name="category" <?php if (isset($_SESSION['category']) && $_SESSION['category'] == "12+")
                     echo
                  "checked"; ?> value="12+">12+
            </label>
            <label for=""><input type="radio" name="category" <?php if (isset($_SESSION['category']) && $_SESSION['category'] == "18+")
                     echo
                  "checked"; ?> value="18+">18+
            </label>
            <label>Обкладанка</label>
            <input type="file" name="cover" accept="image/png, image/jpeg">

            <label>Файл книги .txt</label>
            <input type="file" name="text" accept=".txt">

            <button type="submit">Опублікувати</button>

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
            /* unset($_SESSION['cover']);
            unset($_SESSION['text']); */
                        ?>

         </form>
      </div>
   </div>
</body>

</html>