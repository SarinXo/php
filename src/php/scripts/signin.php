<?php
require_once(realpath(dirname(__FILE__) . '/../db.php'));

	if(isset($_COOKIE['login']) && isset($_COOKIE['token']))
	{
		$login = $_COOKIE['login'];
		$redistoken = $redis->hget('authentication:' . $login, 'token');

		if($redistoken == $_COOKIE['token'] && $_COOKIE['login'] == $_REQUEST['login'])
		{
			$success['Message'] = "Success";
			die(print(json_encode($success)));
		}
	}

	if(isset($_REQUEST['login']) && isset($_REQUEST['password']))
	{
		$login = $_REQUEST['login'];
		$password = $_REQUEST['password'];

		$fetchUsers = $connection->prepare("SELECT `password` FROM `users` WHERE `login` = :userlogin");
		$fetchUsers->bindValue(':userlogin', $login, PDO::PARAM_STR);
		$fetchUsers->execute() or die(print_r($fetchUsers->errorInfo()));
		$existedUsers = $fetchUsers->fetchAll(PDO::FETCH_ASSOC);

		if(count($existedUsers) == 0)
		{
			$error['Message'] = "Wrong data";
			die(print(json_encode($error)));
		}

		if(password_verify($password, $existedUsers[0]['password']))
		{
			$auto_expire = 12 * 60; // 12 hours
			$token = password_hash(uniqid(), PASSWORD_DEFAULT);
			$redis->hset('authentication:' . $login, "token", $token);
			$redis->expire('authentication', $auto_expire);
			setcookie('login', $login, time() + $auto_expire, '/');
			setcookie('token', $token, time() + $auto_expire, '/');

			$success['Message'] = "Success";
			die(print(json_encode($success)));
		}
	}

	$error['Message'] = "Wrong data";
	die(print(json_encode($error)));