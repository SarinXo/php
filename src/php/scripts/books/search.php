<?php
require_once(realpath(dirname(__FILE__) . '/../../db.php'));

	if(!isset($_REQUEST['searchType']) || !isset($_REQUEST['searchQuery']))
	{
		die(print_r("No data fields."));
	}

	if(!($_REQUEST['searchType'] == "author" || $_REQUEST['searchType'] == "title" || $_REQUEST['searchType'] == "isbn"))
	{
		die(print_r("SQL injection aborted."));
	}

	if(isset($_REQUEST['offset']) && isset($_REQUEST['rowsCount']))
	{
		$fetchBooks = $connection->prepare("SELECT * FROM `books` WHERE `{$_REQUEST['searchType']}` LIKE :searchQuery ORDER BY `title` LIMIT :offset, :rowsCount");

		$fetchBooks->bindColumn(':searchType', $_REQUEST['searchType']);
		$fetchBooks->bindValue(':searchQuery', '%'.$_REQUEST['searchQuery'].'%', PDO::PARAM_STR);
		$fetchBooks->bindValue(':offset', (int) trim($_REQUEST['offset']), PDO::PARAM_INT);
		$fetchBooks->bindValue(':rowsCount', (int) trim($_REQUEST['rowsCount']), PDO::PARAM_INT);
	} else
	{
		$fetchBooks = $connection->prepare("SELECT * FROM `books` WHERE `{$_REQUEST['searchType']}` LIKE :searchQuery ORDER BY `title`");

		$fetchBooks->bindValue(':searchQuery', '%'.$_REQUEST['searchQuery'].'%', PDO::PARAM_STR);
	}
	$fetchBooks->execute() or die(print_r($fetchBooks->errorInfo()));

	$books = $fetchBooks->fetchAll(PDO::FETCH_ASSOC);
	echo json_encode($books);