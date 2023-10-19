<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="/css/libs/bootstrap.min.css">
  <link rel="stylesheet" href="/css/styles/main.css">
  <link rel="stylesheet" href="/css/styles/search.css">
  <title>Книжный магазин</title>
</head>
<body>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler"
            type="button"
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
          <a class="nav-link" href="/pages/homepage/homepage.php">Все товары</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"> Поиск товаров <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pages/sort.html">Сортировка товаров</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/pages/tasks.html">Задания</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/php/scripts/restoreDb.php">Восстановить базу данных</a>
        </li>
      </ul>
    </div>
  </nav>
</header>
<main>
  <h2>Задания:</h2>
  <form id="search-books">
    <div class="search-control">
      <label for="searchType">Тип поиска</label>
      <select name="searchType" class="form-control" id="searchType">
        <option value="task1">скидка 10% на заказы 01.07 по 20.09 2006</option>
        <option value="task2">Удалить наименее продаваемую книгу</option>
        <option value="task3">Вывести заказы с неправильной суммой</option>
      </select>
    </div>
    <input type="submit"
           value="Поиск"
           class="form-control btn btn-success">
  </form>
  <div id ="popa"></div>
</main>


<script type="text/javascript" src="/js/libs/jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="/js/libs/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/libs/bootstrap.bundle.min.js"></script>

<script type="module" src="/js/scripts/tasks.js"></script>
</body>
</html>