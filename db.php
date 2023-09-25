<?php
include 'db_connect.php';
$q = "CREATE DATABASE IF NOT EXISTS itslibro1";
mysqli_query($link, $q);
mysqli_select_db($link, "itslibro1");
  echo mysqli_select_db($link, "itslibro1") . "1213";
  if (mysqli_select_db($link, "itslibro1")) {
    mysqli_select_db($link, "itslibro1");
  }

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
  `data_published` DATE NOT NULL,
  `genres` VARCHAR(256) NOT NULL,
  `words_count` INT NOT NULL,
  `b_description` VARCHAR(1000) NOT NULL,
  `category` VARCHAR(45) NOT NULL,
  `views_count` INT NULL,
  `in_list_count` INT NULL,
  `rating` FLOAT NULL,
  `ratings_count` INT NULL,
  PRIMARY KEY (`id_book`),
  INDEX `publisher_idx` (`id_publisher` ASC),
  CONSTRAINT `publisher`
    FOREIGN KEY (`id_publisher`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB CHARACTER SET cp1251";

$q3 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`ratings` (
  `id_book` INT NOT NULL,
  `id_user` INT NOT NULL,
  `rating` INT NOT NULL,
  INDEX `book_idx` (`id_book` ASC),
  INDEX `user_idx` (`id_user` ASC),
  CONSTRAINT `book_rate`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `user_rate`
    FOREIGN KEY (`id_user`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB CHARACTER SET cp1251";

$q4 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`list_favorite` (
  `id_user` INT NOT NULL,
  `id_book` INT NOT NULL,
  INDEX `user_idx` (`id_user` ASC),
  INDEX `book_idx` (`id_book` ASC),
  CONSTRAINT `book_fav`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `user_fav`
    FOREIGN KEY (`id_user`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB CHARACTER SET cp1251";

$q5 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`list_reading` (
  `id_user` INT NOT NULL,
  `id_book` INT NOT NULL,
  INDEX `user_idx` (`id_user` ASC),
  INDEX `book_idx` (`id_book` ASC),
  CONSTRAINT `user_read`
    FOREIGN KEY (`id_user`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `book_read`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB CHARACTER SET cp1251";

$q6 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`list_in_plans` (
  `id_user` INT NOT NULL,
  `id_book` INT NOT NULL,
  INDEX `user_idx` (`id_user` ASC),
  INDEX `book_idx` (`id_book` ASC),
  CONSTRAINT `user_plan`
    FOREIGN KEY (`id_user`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `book_plan`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB CHARACTER SET cp1251";

$q7 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`list_readed` (
  `id_user` INT NOT NULL,
  `id_book` INT NOT NULL,
  INDEX `user_idx` (`id_user` ASC),
  INDEX `book_idx` (`id_book` ASC),
  CONSTRAINT `user_readed`
    FOREIGN KEY (`id_user`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `book_readed`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB CHARACTER SET cp1251";

$q8 = "CREATE TABLE IF NOT EXISTS `itslibro1`.`list_abandoned` (
  `id_user` INT NOT NULL,
  `id_book` INT NOT NULL,
  INDEX `user_idx` (`id_user` ASC),
  INDEX `book_idx` (`id_book` ASC),
  CONSTRAINT `user_abandoned`
    FOREIGN KEY (`id_user`)
    REFERENCES `itslibro1`.`users` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `book_abandoned`
    FOREIGN KEY (`id_book`)
    REFERENCES `itslibro1`.`books` (`id_book`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)   
ENGINE = InnoDB CHARACTER SET cp1251";

for ($i = 1; $i <= 8; $i++) {
  $q = ${'q' . $i};
  mysqli_query($link, $q);
}

//users
$q1 = "INSERT INTO users (nick, email, u_password, age, avatar, about_user, u_status) VALUES ('Abviol', 'kyselov_n@dlit.dp.ua', 'admin2006', '16', 'img/avatars/1.jpg', 'Полюбляю наукову фантастику й бойовики', 'adm')";

$q2 = "INSERT INTO users (nick, email, u_password, age, avatar, about_user, u_status) VALUES ('Патріот', 'iloveuA@gmail.com', 'uawillwin', '21', 'img/avatars/2.jpg', '', 'user')";

$q3 = "INSERT INTO users (nick, email, u_password, age, avatar, about_user, u_status) VALUES ('Артур Пирожков', 'pyro2018@gmail.com', 'songpong11', '13', 'img/avatars/3.jpg', 'Обожнюю бабусині приіжки', 'user')";

$q4 = "INSERT INTO users (nick, email, u_password, age, avatar, about_user, u_status) VALUES ('Іван', 'ivan_lit@gmail.com', '120934111', '19', 'img/avatars/4.jpg', '', 'user')";

$q5 = "INSERT INTO users (nick, email, u_password, age, avatar, about_user, u_status) VALUES ('про100ліцеїст', 'lyceum_best@gmail.com', '12341234', '17', 'img/avatars/5.jpg', 'про100ліцеїст, ЛІТ', 'user')";

for ($i = 1; $i <= 5; $i++) {
  $q = ${'q' . $i};
  mysqli_query($link, $q);
}
echo '<br>';

//books
$q1 = "INSERT INTO books (id_publisher, b_name, original_name, author, picture, data_writed, data_published, genres, words_count, b_description, category, views_count, in_list_count, rating, ratings_count) VALUES ('1', '451 градус за Фаренгейтом', 'Fahrenheit 451', 'Рей Дуглас Брeдбери', 'img/covers/1.png', '1953', '2022-10-30', 'Новела, наукова фантастика, антиутопічна фантастика, політична фантастика', '38551',  '«451 градус за Фаренгейтом» — науково-фантастичний роман Рея Бредбері, який входить до популярної серії «Класика для лінивих». Дія роману відбувається у тоталітарному суспільстві, яке забороняє своїм членам читати книги, які містять філософський зміст. Такі видання мають бути спалені, а ті, хто насмілився наблизитися до «шкідливої» літератури, називаються злочинцями. Головний герой Гай Монтег працює «пожежним», тобто спалює неугодні книги, поки в його житті не настає криза, яка змушує переосмислити основні цінності.', '12+', '0', '2', '5', '2')";

$q2 = "INSERT INTO books (id_publisher, b_name, original_name, author, picture, data_writed, data_published, genres, words_count,
b_description, category, views_count, in_list_count, rating, ratings_count) VALUES ('1', 'Червоне і чорне', 'Le Rouge et le Noirm', 'Стендаль (Марі-Анрі Бейль)', 'img/covers/2.jpg', '1830', '2022-10-29', 'Новела, психологічна література', '152440', '«Червоне та чорне» — це один із найвідоміших творів Стендаля. Книга розповість вам про честолюбство, про те, куди наводять надмірні амбіції та прагнення йти головами за своєю метою. Жюльєн Сорель розважливо будує кар`єру і прагне прославитися, як Наполеон. Зовні він холодний і цілеспрямований, проте в душі його роздирають сумніви та протиріччя, він кидається між честю і честолюбством. Його амбіції високі, але чи судилося їм втілитись? Синонімом червоного у романі виступає кохання, а чорне — це гординя та марнославство.', '12+', '0', '2', '5', '3')";

$q3 = "INSERT INTO books (id_publisher, b_name, original_name, author, picture, data_writed, data_published, genres, words_count, b_description, category, views_count, in_list_count, rating, ratings_count) VALUES ('1', 'Гобсек', 'Gobseck', 'Оноре де Бальзак', 'img/covers/3.jpg', '1830', '2022-11-10', 'Повість', '17570', '«Гобсек» – сцени з приватного життя лихваря, портрет робителя грошей із грошей.', '12+', '0', '1', '5', '1')";

$q4 = "INSERT INTO books (id_publisher, b_name, original_name, author, picture, data_writed, data_published, genres, words_count, b_description, category, views_count, in_list_count, rating, ratings_count) VALUES ('1', 'Код Да Вінчі', 'The Da Vinci Code', 'Ден Браун', 'img/covers/4.jpg', '2003', '2022-11-12', 'Трилер, детектив, містика, кримінал', '118276', 'Містичний детектив американського письменника Дена Брауна, виданий у 2003 році. Головний герой — професор симвології Гарвардського університету Роберт Ленгдон. Разом з парижанкою Софі Неве йому вдається розкрити вбивство та відгадати загадку, яку століттями оберігало братство «Пріорат Сіону». Роберт знаходить таємні матеріали, які вказують на справжнє походження християнства та життя Ісуса Христа.', '18+', '0', '0', '1', '1')";

$q5 = "INSERT INTO books (id_publisher, b_name, original_name, author, picture, data_writed, data_published, genres, words_count, b_description, category, views_count, in_list_count, rating, ratings_count) VALUES ('1', 'Робінзон Крузо', 'Robinson Crusoe', 'Данієль Дефо', 'img/covers/5.jpg', '1719 ', '2022-11-18', 'Пригоди, новела', '90681', 'Робінзон Крузо — найвідоміший твір англійського письменника Данієля Дефо (1661–1731), де розповідається про дивовижні та надзвичайні пригоди моряка з Йорка, який потрапив на безлюдний острів і прожив там 28 років. Книжка, знайома нам з дитинства, цікава і для дорослих читачів, її герой — людина сильної волі, мужня й винахідлива — з честю вніс випробування, що випали на його долю: нелегку боротьбу з природою, самотністю і самим собою.', '12+', '0', '0', '2', '1')";

$q6 = "INSERT INTO books (id_publisher, b_name, original_name, author, picture, data_writed, data_published, genres, words_count, b_description, category, views_count, in_list_count, rating, ratings_count) VALUES ('1', 'Капітанська дочка', 'Капитанская дочка', 'Олександр Пушкін', 'img/covers/6.jpg', '1836', '2022-11-20', 'Повість, роман, драма', '32774', 'У романі «Капітанська дочка» А.С.Пушкін намалював яскраву картину стихійного селянського повстання під проводом Омеляна Пугачова.', '12+', '0', '0', '3', '1')";

$q7 = "INSERT INTO books (id_publisher, b_name, original_name, author, picture, data_writed, data_published, genres, words_count, b_description, category, views_count, in_list_count, rating, ratings_count) VALUES ('1', 'Чума', 'The Plague', 'Альбер Камю', 'img/covers/7.jpg', '1947', '2022-11-25', 'Роман, філософія, притча', '70230', '«Чума» Альбера Камю - це роман-притча. До міста приходить страшна хвороба – і люди починають вмирати. Батьки міста, приховуючи правду, роблять мешканців заручниками епідемії. І кожен стоїть перед вибором: боротися за життя, шукати вихід чи змиритися з пануванням чуми, з неминучою смертю.', '12+', '0', '0', '4', '1')";

$q8 = "INSERT INTO books (id_publisher, b_name, original_name, author, picture, data_writed, data_published, genres, words_count, b_description, category, views_count, in_list_count, rating, ratings_count) VALUES ('1', 'Енеїда', 'Енеїда', 'Котляревський Іван', 'img/covers/8.jpg', '1798', '2022-11-26', 'Поема', '73012', '«Енеїда» — енциклопедія життя українського народу. Легко і невимушено вплітаються у сюжет поеми описи різних аспектів життя українця. У поемі зібрано велику й цінну етнографічну, етнологічну і фольклорну інформацію. У структурі поеми описано народні вірування, звичаї, ігри, обряди, справи, побут, кухню й одяг. І. Котляревський з гумором описує порядки в судах, війську, канцеляріях. Місце у поемі знайдено й розповіді про влаштування українських шкіл.', '12+', '0', '0', '5', '1')";

for ($i = 1; $i <= 8; $i++) {
  $q = ${'q' . $i};
  var_dump(mysqli_query($link, $q));
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

$q1 = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('1', '1', '5')";

$q2 = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('1', '2', '5')";

$q3 = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('2', '3', '5')";

$q4 = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('2', '5', '5')";

$q5 = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('2', '4', '5')";

$q6 = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('3', '1', '5')";

$q7 = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('4', '2', '1')";

$q8 = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('5', '3', '2')";

$q9 = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('6', '5', '3')";

$q10 = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('7', '4', '4')";

$q11 = "INSERT INTO ratings (id_book, id_user, rating) VALUES ('8', '1', '5')";

for ($i = 1; $i <= 11; $i++) {
  $q = ${'q' . $i};
  mysqli_query($link, $q);
  echo '<br>';
}
?>