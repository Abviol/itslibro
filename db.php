<meta charset="UTF-8">
<?php
include 'db_connect.php';
$q = "CREATE DATABASE IF NOT EXISTS itslibro1";
mysqli_query($link, $q);
mysqli_select_db($link, "itslibro1");

$q1 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`users` (
  `id_user` INT NOT NULL AUTO_INCREMENT,
  `nick` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NULL,
  `u_password` VARCHAR(45) NULL,
  `age` VARCHAR(45) NULL,
  `avatar` VARCHAR(500) NULL,
  `about_user` VARCHAR(256) NULL,
  `u_status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE INDEX `id_user_UNIQUE` (`id_user` ASC),
  UNIQUE INDEX `nick_UNIQUE` (`nick` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB CHARACTER SET cp1251";

$q2 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`books` (
  `id_book` INT NOT NULL AUTO_INCREMENT,
  `id_publisher` INT NOT NULL,
  `b_name` VARCHAR(100) NOT NULL,
  `original_name` VARCHAR(100) NULL,
  `author` VARCHAR(45) NOT NULL,
  `picture` VARCHAR(256) NULL,
  `data_writed` VARCHAR(50) NOT NULL,
  `data_published` VARCHAR(50) NULL,
  `genres` VARCHAR(256) NOT NULL,
  `words_count` INT NOT NULL,
  `b_description` VARCHAR(1000) NOT NULL,
  `category` VARCHAR(45) NOT NULL,
  `views_count` INT NULL,
  `in_list_count` INT NULL,
  `rating` INT NULL,
  `ratings_count` INT NULL,
  PRIMARY KEY (`id_book`),
  INDEX `publisher_idx` (`id_publisher` ASC),
  CONSTRAINT `publisher`
    FOREIGN KEY (`id_publisher`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB CHARACTER SET cp1251";

$q3 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`comments` (
  `id_comment` INT NOT NULL AUTO_INCREMENT,
  `id_commenter` INT NOT NULL,
  `id_book` INT NOT NULL,
  `date_comment` DATETIME NOT NULL,
  `c_comment` VARCHAR(256) NOT NULL,
  `likes` INT NULL,
  PRIMARY KEY (`id_comment`),
  INDEX `books_idx` (`id_book` ASC),
  INDEX `user_idx` (`id_commenter` ASC),
  CONSTRAINT `book_com`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `user_com`
    FOREIGN KEY (`id_commenter`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET cp1251";

$q4 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`ratings` (
  `id_book` INT NOT NULL,
  `id_user` INT NOT NULL,
  `rating` INT NOT NULL,
  `id_rating` INT NOT NULL,
  INDEX `book_idx` (`id_book` ASC),
  INDEX `user_idx` (`id_user` ASC),
  PRIMARY KEY (`id_rating`),
  CONSTRAINT `book_rate`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `user_rate`
    FOREIGN KEY (`id_user`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET cp1251";

$q5 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`list_favorite` (
  `id_user` INT NOT NULL,
  `id_book` INT NOT NULL,
  INDEX `user_idx` (`id_user` ASC),
  INDEX `book_idx` (`id_book` ASC),
  CONSTRAINT `book_fav`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `user_fav`
    FOREIGN KEY (`id_user`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET cp1251";

$q6 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`list_reading` (
  `id_user` INT NOT NULL,
  `id_book` INT NOT NULL,
  INDEX `user_idx` (`id_user` ASC),
  INDEX `book_idx` (`id_book` ASC),
  CONSTRAINT `user_read`
    FOREIGN KEY (`id_user`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `book_read`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET cp1251";

$q7 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`list_in_plans` (
  `id_user` INT NOT NULL,
  `id_book` INT NOT NULL,
  INDEX `user_idx` (`id_user` ASC),
  INDEX `book_idx` (`id_book` ASC),
  CONSTRAINT `user_plan`
    FOREIGN KEY (`id_user`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `book_plan`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET cp1251";

$q8 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`list_readed` (
  `id_user` INT NOT NULL,
  `id_book` INT NOT NULL,
  INDEX `user_idx` (`id_user` ASC),
  INDEX `book_idx` (`id_book` ASC),
  CONSTRAINT `user_readed`
    FOREIGN KEY (`id_user`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `book_readed`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB CHARACTER SET cp1251";

$q9 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`list_abandoned` (
  `id_user` INT NOT NULL,
  `id_book` INT NOT NULL,
  INDEX `user_idx` (`id_user` ASC),
  INDEX `book_idx` (`id_book` ASC),
  CONSTRAINT `user_abandoned`
    FOREIGN KEY (`id_user`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `book_abandoned`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)   
ENGINE = InnoDB CHARACTER SET cp1251";

for ($i = 1; $i <= 9; $i++) {
  $q = ${'q' . $i};
  mysqli_query($link, $q);
  echo '<br>';
}
echo '<br>';

//users
$q1 = "INSERT INTO users (nick, email, u_password, age, avatar, about_user, u_status) VALUES ('Abviol', 'kyselov_n@dlit.dp.ua', 'admin2006', '16', 'img/avatars/Abviol.jpg', 'Полюбляю наукову фантастику й бойовики', 'adm')";

$q2 = "INSERT INTO users (nick, email, u_password, age, avatar, about_user, u_status) VALUES ('Патріот', 'iloveuA@gmail.com', 'uawillwin', '21', '', '', 'user')";

$q3 = "INSERT INTO users (nick, email, u_password, age, avatar, about_user, u_status) VALUES ('Артур Пирожков', 'pyro2018@gmail.com', 'songpong11', '13', '3', 'Обожнюю бабусині приіжки', 'user')";

$q4 = "INSERT INTO users (nick, email, u_password, age, avatar, about_user, u_status) VALUES ('Іван', 'ivan_lit@gmail.com', '120934111', '19', '', '', 'user')";

$q5 = "INSERT INTO users (nick, email, u_password, age, avatar, about_user, u_status) VALUES ('про100ліцеїст', 'lyceum_best@gmail.com', '12341234', '17', '', 'про100ліцеїст, ЛІТ', 'user')";

for ($i = 1; $i <= 5; $i++) {
  $q = ${'q' . $i};
  mysqli_query($link, $q);
}
echo '<br>';

//books
$q1 = "INSERT INTO books (id_publisher, b_name, original_name, author, picture, data_writed, data_published, genres, words_count, b_description, category, views_count, in_list_count, rating, ratings_count) VALUES ('1', '451 градус за Фаренгейтом', 'Fahrenheit 451', 'Рей Дуглас Брeдбери', 'img/covers/1.png', '1953 рік', '2022-10-03', 'Новела, наукова фантастика, антиутопічна фантастика, політична фантастика', '224',  '«451 градус за Фаренгейтом» — науково-фантастичний роман Рея Бредбері, який входить до популярної серії «Класика для лінивих». Дія роману відбувається у тоталітарному суспільстві, яке забороняє своїм членам читати книги, які містять філософський зміст. Такі видання мають бути спалені, а ті, хто насмілився наблизитися до «шкідливої» літератури, називаються злочинцями. Головний герой Гай Монтег працює «пожежним», тобто спалює неугодні книги, поки в його житті не настає криза, яка змушує переосмислити основні цінності.', '16+', '0', '1', '5', '2')";

$q2 = "INSERT INTO books (id_publisher, b_name, original_name, author, picture, data_writed, data_published, genres, words_count,
b_description, category, views_count, in_list_count, rating, ratings_count) VALUES ('1', 'Красное и черное', 'Le Rouge et le Noirm', 'Стендаль (Марі-Анрі Бейль)', 'img/covers/2.jpg', '1830 рік', '2022-10-03', 'Новела, психологічна література', '598', '«Червоне та чорне» — це один із найвідоміших творів Стендаля. Книга розповість вам про честолюбство, про те, куди наводять надмірні амбіції та прагнення йти головами за своєю метою. Жюльєн Сорель розважливо будує кар`єру і прагне прославитися, як Наполеон. Зовні він холодний і цілеспрямований, проте в душі його роздирають сумніви та протиріччя, він кидається між честю і честолюбством. Його амбіції високі, але чи судилося їм втілитись? Синонімом червоного у романі виступає кохання, а чорне — це гординя та марнославство.', '16+', '0', '1', '5', '3')";

$q3 = "INSERT INTO books (id_publisher, b_name, original_name, author, picture, data_writed, data_published, genres, words_count, b_description, category, views_count, in_list_count, rating, ratings_count) VALUES ('1', 'Гобсек', 'Gobseck', 'Оноре де Бальзак', 'img/covers/3.jpg', '1830 рік', '2022-10-03', 'Повість', '158', '«Гобсек» – сцени з приватного життя лихваря, портрет робителя грошей із грошей.', '12+', '0', '1', '5', '1')";

for ($i = 1; $i <= 3; $i++) {
  $q = ${'q' . $i};
  mysqli_query($link, $q);
  echo '<br>';
}
echo '<br>';

//lists
$q1 = "INSERT INTO list_favorite VALUES ('1', '1')";

$q2 = "INSERT INTO list_favorite VALUES ('2', '1')";

$q3 = "INSERT INTO list_reading VALUES ('3', '2')";

$q4 = "INSERT INTO list_in_plans VALUES ('4', '3')";

$q5 = "INSERT INTO list_readed VALUES ('5', '2')";

for ($i = 1; $i <= 5; $i++) {
  $q = ${'q' . $i};
  mysqli_query($link, $q);
  echo '<br>';
}
echo '<br>';

//сomments
$q1 = "INSERT INTO comments (id_commenter, id_book, date_comment, c_comment, likes) VALUES ('1', '1', '2022-10-03 18:12:13', 'Краще цього нічого не читав', '2')";

$q2 = "INSERT INTO comments (id_commenter, id_book, date_comment, c_comment, likes) VALUES ('2', '1', '2022-10-03 18:12:13', 'Неймовірно', '0')";

$q3 = "INSERT INTO comments (id_commenter, id_book, date_comment, c_comment, likes) VALUES ('3', '2', '2022-10-03 18:12:13', 'Дуже красивий твір', '0')";

$q4 = "INSERT INTO comments (id_commenter, id_book, date_comment, c_comment, likes) VALUES ('4', '2', '2022-10-03 18:12:13', 'I like it', '0')";

$q5 = "INSERT INTO comments (id_commenter, id_book, date_comment, c_comment, likes) VALUES ('5', '3', '2022-10-03 18:12:13', 'Не можу підібрати слів', '0')";

$q6 = "INSERT INTO comments (id_commenter, id_book, date_comment, c_comment, likes) VALUES ('2', '3', '2022-10-03 18:12:13', '0_0', '0')";

for ($i = 1; $i <= 6; $i++) {
  $q = ${'q' . $i};
  mysqli_query($link, $q);
  echo '<br>';
}
echo '<br>';
?>