<?php
	require_once("../../db.php");

	if(isset($_REQUEST['offset']) && isset($_REQUEST['rowsCount']))
	{
		$fetchBooks = $connection->prepare
		('
			SELECT `b`.`isbn`, `b`.`author`, `b`.`title`, `b`.`price` FROM
			(
				SELECT * FROM `books`
			) AS `b`
			INNER JOIN
			(
				SELECT `isbn`, COUNT(*) AS `count` FROM `order_items`
				GROUP BY `isbn`
			) AS `oi`
			ON `b`.`isbn` = `oi`.`isbn` ORDER BY `oi`.`count` LIMIT :offset, :rowsCount
		');
		
		$fetchBooks->bindValue(':offset', (int) trim($_REQUEST['offset']), PDO::PARAM_INT);
		$fetchBooks->bindValue(':rowsCount', (int) trim($_REQUEST['rowsCount']), PDO::PARAM_INT);
	} else
	{
		$fetchBooks = $connection->prepare
		('
			SELECT `b`.`isbn`, `b`.`author`, `b`.`title`, `oi`.`count` FROM
			(
				SELECT * FROM `books`
			) AS `b`
			INNER JOIN
			(
				SELECT `isbn`, COUNT(*) AS `count` FROM `order_items`
				GROUP BY `isbn`
			) AS `oi`
			ON `b`.`isbn` = `oi`.`isbn` ORDER BY `oi`.`count`
		');
	}
	$fetchBooks->execute() or die(print_r($fetchBooks->errorInfo()));

	$books = $fetchBooks->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($books);