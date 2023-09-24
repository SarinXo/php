<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type"
          content="text/html; charset=UTF-8">
    <title> Вас приветствует магазин "Буквофил"!</title>
</head>

<body>

<script> </script>
    <?php
        include './src/scripts/connect_db.php';
        $db = new Database();
    ?>

    <h1>Вас приветствует магазин "Буквофил"!</h1>
    <h2>Сегодня в продаже:</h2>

<?php
    $result = $db->getAllEntities("books");
    foreach ($result as $row)
    {
        echo "<p><strong>.($row[0]). Название:";
        echo  stripslashes($row[2]);
        echo '</strong><br />Автор:
        echo stripslashes($row[1]);
        echo '<br />ISBN: echo stripslashes($row[0]);
        echo '<br />Цена:
        echo stripslashes($row[3]); echo '</p>';
        $i=$i+1;
    }
?>


</body>

</html>