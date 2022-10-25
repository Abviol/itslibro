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
   <!-- форма профиля -->
   <form action="signin.php" method="post">
      <p>
         <?= $_SESSION['nick'] ?>
      </p>
      <p>
         <?= $_SESSION['email'] ?>
      </p>
      <p>
         <?= $_SESSION['age'] ?>
      </p>
      <p>
         <?= $_SESSION['u_status'] ?>
      </p>
      <p>
         <?= $_SESSION['about_user'] ?>
      </p>

      <a href="logout.php">Вийти</a>
   </form>
</body>

</html>