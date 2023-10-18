<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/libs/bootstrap.min.css">

	<link rel="stylesheet" href="/css/styles/main.css">
	<title>Книжный магазин</title>
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<button class="navbar-toggler" type="button"
					data-toggle="collapse"
					data-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent"
					aria-expanded="false"
					aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">

				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">Все товары <span class="sr-only">(current)</span></a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="/pages/search.html">Поиск товаров</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="/pages/sort.html">Сортировка товаров</a>
					</li>

                    <li class="nav-item">
                        <a class="nav-link" href="/pages/tasks/tasks.php">Задания</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/php/scripts/books/reloadDb.php">Восстановить базу данных</a>
                    </li>

				</ul>
			</div>
		</nav>
	</header>


    <main>
        <h1>Приветствуем в магазине "Буквофил"!</h1>
        <h2>Сегодня в продаже:</h2>
        <?php
        require_once("connect_db.php");
        $db = new Database();
        $db -> htmlAllBooks();
        ?>
    </main>


</body>
</html>