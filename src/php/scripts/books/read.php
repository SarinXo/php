<?php
require_once(realpath(dirname(__FILE__) . '/../../db.php'));

	if(isset($_REQUEST['offset']) && isset($_REQUEST['rowsCount']))
	{
		$fetchBooks = $connection->prepare("SELECT * FROM `books` ORDER BY `title` LIMIT :offset, :rowsCount");

		$fetchBooks->bindValue(':offset', (int) trim($_REQUEST['offset']), PDO::PARAM_INT);
		$fetchBooks->bindValue(':rowsCount', (int) trim($_REQUEST['rowsCount']), PDO::PARAM_INT);
	} else
	{
		$fetchBooks = $connection->prepare("SELECT * FROM `books` ORDER BY `title`");
	}
	$fetchBooks->execute() or die(print_r($fetchBooks->errorInfo()));

	$books = $fetchBooks->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($books);