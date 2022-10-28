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
      <input type="e-mail" name="email" id="" placeholder="Вкажіть e-mail" value=<?php echo $_SESSION['email']; ?>>

      <label>Нікнейм</label>
      <input type="text" name="nick" placeholder="Придумайте свій нікнейм" value=<?php echo $_SESSION['nick']; ?>>

      <label>Вік</label>
      <input type="text" name="age" placeholder="Вкажіть ваш ік" value=<?php echo $_SESSION['age']; ?>>

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

         unset($_SESSION['email']);
         unset($_SESSION['nick']);
         unset($_SESSION['age']);
      ?>

   </form>
</body>

</html>