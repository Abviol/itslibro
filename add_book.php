<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="css/log.css" rel="stylesheet" />
   <title>Document</title>
</head>

<body>
   <div class="wrapper">
      <div class="_container">
         <form action="add_book_handle.php" method="post" enctype="multipart/form-data">
            <label>Назва книги</label>
            <input type="text" name="b_name" placeholder="Вкажіть назву книги українською мовою">

            <label>Оригінальна назва</label>
            <input type="text" name="original_name" placeholder="Вкажіть оригінальну назву книги">

            <label>Автор</label>
            <input type="text" name="author" placeholder="Вкажіть ПІБ автора">

            <label>Дата написання</label>
            <input type="text" name="data_writed" placeholder="Вкажість рік, коли автор закінчив книгу">

            <label>Жанри</label>
            <input type="text" name="genres" placeholder="Вкажіть жанри книги через кому">

            <label for="b_description">Опис</label>
            <textarea
               style="resize: none; margin: 10px 0; padding: 10px; border: unset; border: 2px solid #dddddd; outline: none; font-family: Roboto;"
               name="b_description" id="b_description" cols="10" rows="5" placeholder="Коротко опишіть книгу"
               maxlength="500"></textarea>

            <label>Категорія</label>
            <label for=""><input type="radio" name="category" <?php if (isset($_POST['category']) && $_POST['category']=="Для
                  будь-якого віку") echo "checked"; ?> value="Для
                  будь-якого віку">Для
               будь-якого віку
            </label>
            <label for=""><input type="radio" name="category" <?php if (isset($_POST['category']) && $_POST['category'] == "12+")
                     echo
                  "checked"; ?> value="12+">12+
            </label>
            <label for=""><input type="radio" name="category" <?php if (isset($_POST['category']) && $_POST['category'] == "18+")
                     echo
                  "checked"; ?> value="18+">18+
            </label>
            <label>Обкладанка</label>
            <input type="file" name="cover">

            <label>Файл книги .txt</label>
            <input type="file" name="text">

            <button type="submit">Опублікувати</button>
         </form>
      </div>
   </div>
</body>

</html>