<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type"
          content="text/html; charset=UTF-8">
    <title> Вас приветствует магазин "Буквофил"!</title>
    <?php
        include 'connect_db.php';
        $db = new Database();
    ?>
</head>
<body>
    <h1>Вас приветствует магазин "Буквофил"!</h1>
    <h2>Сегодня в продаже:</h2>
    <?php
        $db ->htmlAllBooks();
    ?>

</body>

</html>