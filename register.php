<?php
ini_set('session.save_path', getcwd() . '\sessions');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <title>Вхід</title>
   <link href="css/log.css" rel="stylesheet" />
</head>

<body>
   <!-- форма авторизации -->
   <form action="signup.php" method="post">

      <label>Ваш e-mail</label>
      <input type="e-mail" name="email" id="" placeholder="Вкажіть e-mail">

      <label>Нікнейм</label>
      <input type="text" name="nick" placeholder="Придумайте свій нікнейм">

      <!-- <label for="">Ім’я</label>
      <input type="text" name="name" placeholder="Вкажіть ваше ім’я">

      <label for="">Прізвище</label>
      <input type="text" name="email" placeholder="Вкажіть ваше прізвище"> -->

      <label>Вік</label>
      <input type="text" name="age" placeholder="Вкажіть ваш ік">

      <label>Пароль</label>
      <input type="password" name="pwd" placeholder="Придумайте пароль">

      <label>Підтвердження паролю</label>
      <input type="password" name="pwd_conf" placeholder="Ще раз введіть пароль">

      <button type="submit">Зареєструватися</button>
      <p>Вже маєте акаунт? - <a href="login.php">увійдіть у систему!</a></p>

      <?php
      if ($_SESSION['message']) {
         echo '<p class="msg">' . $_SESSION['message'] . '</p>';
      }
      unset($_SESSION['message']);
      ?>

   </form>
</body>

</html>