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
   <form action="signin.php" method="post">

      <label>Нікнейм або e-mail</label>
      <input type="text" name="nick" placeholder="Введіть нікнейм чи e-mail">

      <label for="">Пароль</label>
      <input type="password" name="pwd" placeholder="Введіть пароль">

      <button type="submit">Увійти</button>

      <p>Ще не зареєструвались? - <a href="register.php">зробіть це зараз!</a></p>

      <?php
      if ($_SESSION['message']) {
         echo '<p class="msg">' . $_SESSION['message'] . '</p>';
      }
      unset($_SESSION['message']);
      ?>
   </form>
</body>

</html>