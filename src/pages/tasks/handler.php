<?php
    require_once("../../php/db.php");

    $searchType = $_REQUEST["searchType"];

    switch ($searchType) {
        case "task1":
            $query = $connection->prepare("
                UPDATE firsova.orders orders
                    SET amount = orders.amount*0.9
                        WHERE orders.date >= '2006-07-01'
                        AND orders.date <= '2006-09-20';
                ");
            $query ->execute();
            $query = $connection->prepare("
               SELECT orders.date, orders.amount, orders.id
                    FROM firsova.orders orders
                    WHERE orders.date >= '2006-07-01'
                        AND orders.date <= '2006-09-20';
                ");
            $query ->execute();

            while ($row = $query->fetch(PDO::FETCH_ASSOC))
            {
                echo '<p><strong> Дата:';
                echo  stripslashes($row['date']);

                echo '</strong><br/>Сумма: ';
                echo stripslashes($row['amount']);

                echo '<br/>ID заказа: ';
                echo stripslashes($row['id']);

                echo '</p>';

            }
            break;
        case "task2":
            $q = $connection->prepare("
                       SELECT * FROM firsova.books WHERE isbn = (
 SELECT s.isbn
    FROM(
        SELECT isbn, SUM(quantity) AS q
        FROM firsova.order_items
        GROUP BY isbn
    ) AS s
    WHERE s.q =(
        SELECT MIN(q)
        FROM (
            SELECT SUM(quantity) AS q
                FROM firsova.order_items
                GROUP BY isbn
        ) AS i
     )
);
                ");
            $q ->execute();

            while ($row = $q->fetch(PDO::FETCH_ASSOC))
            {
                echo '<p><strong> Название:';
                echo  stripslashes($row['title']);

                echo '</strong><br/>Автор: ';
                echo stripslashes($row['author']);

                echo '<br/>ISBN: ';
                echo stripslashes($row['isbn']);

                echo '<br/>Цена: ';
                echo stripslashes($row['price']);
                echo '</p>';

                $q2 = $connection->prepare("DELETE FROM firsova.books WHERE isbn = :isbn");
                $q2->bindParam(':isbn', $row['isbn']);
                $q2->execute();
            }

            break;
        case "task3":
            $qu = $connection->prepare("
             SELECT orders.*, sub_total.s AS sub_total
FROM firsova.orders orders
JOIN (
    SELECT oi.order_id, SUM(oi.quantity * b.price) s
    FROM firsova.order_items oi
    JOIN firsova.books b ON b.isbn = oi.isbn
    GROUP BY oi.order_id
) sub_total ON sub_total.order_id = orders.id
WHERE orders.amount != sub_total.s;
                ");
            $qu ->execute();
            while ($row = $qu->fetch(PDO::FETCH_ASSOC)) {
                echo '<p><strong>ID заказа:';
                echo stripslashes($row['id']);

                echo '</strong><br/>ID покупателя: ';
                echo stripslashes($row['customer_id']);

                echo '<br/>Сумма заказа: ';
                echo stripslashes($row['amount']);

                echo '<br/>Дата: ';
                echo stripslashes($row['date']);

                echo '<br/>Реальная суммма ';
                echo stripslashes($row['sub_total']);
                echo '</p>';

            }
            break;
    }
