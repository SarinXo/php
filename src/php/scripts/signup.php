<?php
	require_once("../db.php");

	if(!isset($_REQUEST['login']) || !isset($_REQUEST['password']))
	{
		die(print_r('No data set.'));
	}

	if(!isset($_REQUEST['name']) || !isset($_REQUEST['address']) || !isset($_REQUEST['city']))
	{
		die(print_r('No data set.'));
	}

	$login = $_REQUEST['login'];
	$password = $_REQUEST['password'];
	$name = $_REQUEST['name'];
	$address = $_REQUEST['address'];
	$city = $_REQUEST['city'];

	$fetchUsers = $connection->prepare("SELECT `customer_id` FROM `users` WHERE `login` = ?");
	$fetchUsers->execute(array($login)) or die(print_r($fetchUsers->errorInfo()));
	$existedUsers = $fetchUsers->fetchAll(PDO::FETCH_ASSOC);
	
	if(count($existedUsers) != 0)
	{
		$already_exist['Message'] = "Already exist";
		die(print(json_encode($already_exist)));
	}

	$fetchLastUserId = $connection->prepare("SELECT MAX(`id`) AS `id` FROM `customers`");
	$fetchLastUserId->execute() or die(print_r($fetchLastUserId->errorInfo()));
	$lastUserId = $fetchLastUserId->fetch(PDO::FETCH_ASSOC);

	$newId = $lastUserId['id'] + 1;

	$createCustomer = $connection->prepare
	('
		INSERT INTO `customers`
		(`id`, `name`, `address`, `city`)
		VALUES (?, ?, ?, ?)
	');
	$createCustomer->bindParam(1, $newId, PDO::PARAM_INT);
	$createCustomer->bindParam(2, $name, PDO::PARAM_STR);
	$createCustomer->bindParam(3, $address, PDO::PARAM_STR);
	$createCustomer->bindParam(4, $city, PDO::PARAM_STR);
	$createCustomer->execute() or die(print_r($createCustomer->errorInfo()));

	$createUser = $connection->prepare
	('
		INSERT INTO `users`
		(`customer_id`, `login`, `password`)
		VALUES (?, ?, ?)
	');

	$password_hash = password_hash($password, PASSWORD_DEFAULT);
	$createUser->execute(array($newId, $login, $password_hash)) or die(print_r($task1->createUser()));

	$auto_expire = 12 * 60; // 12 hours
	$token = password_hash(uniqid(), PASSWORD_DEFAULT);
	$redis->hset('authentication:' . $login, "token", $token);
	$redis->expire('authentication', $auto_expire);
	setcookie('login', $login, time() + $auto_expire, '/');
	setcookie('token', $token, time() + $auto_expire, '/');

	$success['Message'] = "Success";
	print(json_encode($success));