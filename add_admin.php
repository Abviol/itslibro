<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <link href="css/log.css" rel="stylesheet" />
   <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
   <link rel="icon" href="img/favicon.ico" type="image/x-icon">
   <title>Додати адміністратора</title>
</head>

<body>
   <form action="add_admin_handle.php" method="post">

      <label>Нікнейм або e-mail</label>
      <input type="text" name="nick" placeholder="Введіть нікнейм чи e-mail">

      <label for="">Пароль</label>
      <input type="password" name="pwd" placeholder="Вкажіть ВАШ пароль">

      <button type="submit">Додати</button>

      <?php
      if ($_SESSION['message']) {
         echo '<p class="msg">' . $_SESSION['message'] . '</p>';
      }
      unset($_SESSION['message']);
      ?>
   </form>
</body>

</html>