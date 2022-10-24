<!DOCTYPE html>
<html>
    <head>
        <title>All data</title>
        <link href="css/data_output.css" rel="stylesheet">
    </head>
    <body>
    <table>
        <tr>
            <td>
            <table >
        <caption>Дані користуачів</caption>
            <tr>
                <td>id користувача</td>
                <td>Нік</td>
                <td>e-mail</td>
                <td>Пароль</td>
                <td>Аватар</td>
                <td>Про користувача</td>
                <td>Статус</td>
            </tr>

        <?php
        include 'cnct.php';

        //виведення даних користувачів з таблиці users
        echo "</br>";
        mysqli_select_db($link, 'itslibro1');
        $q = "SELECT * FROM users";
        $user = mysqli_query($link, $q);
        $user = mysqli_fetch_all($user);
        foreach ($user as $client) 
        { ?> 
            <tr>
            <td><?=   $client[0]  ?></td>
            <td><?=   $client[1]  ?></td>
            <td><?=   $client[2]  ?></td>
            <td><?=   $client[3]  ?></td>
            <td><?=   $client[4]  ?></td>
            <td><?=   $client[5]  ?></td>
            <td><?=   $client[6]  ?></td>
        </tr>
            <?php
        }
        ?>
    </table>
            </td>
        </tr>
    <tr>
        <td>
        <table >
        <caption>Дані книг</caption>
            <tr>
                <td>id книги</td>
                <td>id видавеця</td>
                <td>Назва книги</td>
                <td>Оригинальна назва</td>
                <td>Автор</td>
                <td>Обкладанка</td>
                <td>Дата написання</td>
                <td>Дата публікації</td>
                <td>Жанри</td>
                <td>Кількість сторінок</td>
                <td>Опис</td>
                <td>Категорія</td>
                <td>Кількість переглядів</td>
                <td>Кількість у списках</td>
                <td>Оцінка</td>
            </tr>

        <?php
        include 'cnct.php';

        //виведення даних користувачів з таблиці books
        echo "</br>";
        mysqli_select_db($link, 'itslibro1');
        $q = "SELECT * FROM books";
        $book = mysqli_query($link, $q);
        $book = mysqli_fetch_all($book);
        foreach ($book as $book) 
        { ?> 
            <tr>
            <td><?=   $book[0]  ?></td>
            <td><?=   $book[1]  ?></td>
            <td><?=   $book[2]  ?></td>
            <td><?=   $book[3]  ?></td>
            <td><?=   $book[5]  ?></td>
            <td><?=   $book[6]  ?></td>
            <td><?=   $book[7]  ?></td>
            <td><?=   $book[8]  ?></td>
            <td><?=   $book[9]  ?></td>
            <td><?=   $book[11]  ?></td>
            <td><?=   $book[12]  ?></td>
            <td><?=   $book[13]  ?></td>
            <td><?=   $book[14]  ?></td>
        </tr>
            <?php
        }
        ?>
    </table>
        </td>
    </tr>
  
    </body>
</html>
        