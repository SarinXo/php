<?php
require_once(realpath(dirname(__FILE__) . '/../../php/db.php'));

if(!isset($_COOKIE['login']) || !isset($_COOKIE['token']))
{
    header('Location: http://localhost/pages/signupin.html');
}

$login = $_COOKIE['login'];

if($_COOKIE['token'] != $redis->hget('authentication:' . $login, 'token'))
{
    header('Location: http://localhost/pages/signupin.html');
}
?>

<?php
require_once("../php/db.php");

if(!isset($_COOKIE['login']) || !isset($_COOKIE['token']))
{
    header('Location: http://localhost/pages/signupin.html');
}

$login = $_COOKIE['login'];

if($_COOKIE['token'] != $redis->hget('authentication:' . $login, 'token'))
{
    header('Location: http://localhost/pages/signupin.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/libs/bootstrap.min.css">

    <link rel="stylesheet" href="/css/styles/personal/main.css">
    <title>Книжный магазин</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Личная страница <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/personal/task1.php">Задание 1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/personal/task2.php">Задание 2</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/personal/task3.php">Задание 3</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main>
    <h2>Добро пожаловать в лчный кабинет, <i id="name"></i></h2>
    <div class="history">
        <p>История ваших покупок:</p>
        <div id="orders">
        </div>
    </div>
</main>

<script type="text/javascript" src="/js/libs/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="/js/libs/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/libs/bootstrap.bundle.min.js"></script>

<script type="module" src="/js/scripts/personal/main.js"></script>
</body>
</html>