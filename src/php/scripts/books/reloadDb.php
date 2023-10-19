<?php
require_once(realpath(dirname(__FILE__) . '/../../db.php'));
    header('Refresh: 3; URL=http://localhost/pages/homepage/homepage.php');
    echo '<senter>Успешный бекап. Возврат на главную страницу...</senter> ';

    $query = $connection->prepare("drop database lab1");
    $query ->execute();

    $query = $connection->prepare("CREATE DATABASE IF NOT EXISTS lab1;");
    $query ->execute();

$query = $connection->prepare("
CREATE TABLE IF NOT EXISTS firsova.books
(
    isbn VARCHAR(13) NOT NULL PRIMARY KEY,
    author VARCHAR(50),
    title VARCHAR(100),
    price NUMERIC(6, 2)
);");
$query ->execute();

$query = $connection->prepare("
CREATE TABLE IF NOT EXISTS firsova.customers
(
    id SERIAL PRIMARY KEY ,
    name VARCHAR(60) NOT NULL ,
    address VARCHAR(100) NOT NULL,
    city VARCHAR(30)
);");
$query ->execute();

$query = $connection->prepare("
CREATE TABLE IF NOT EXISTS firsova.book_reviews
(
    isbn VARCHAR(13) NOT NULL
        REFERENCES lab1.books(isbn) ON DELETE CASCADE,
    review TEXT
);");
$query ->execute();

$query = $connection->prepare("
CREATE TABLE IF NOT EXISTS lab1.orders
(
    id SERIAL PRIMARY KEY ,
    customer_id int NOT NULL
        REFERENCES lab1.customers(id) ON DELETE CASCADE,
    amount NUMERIC(8, 2),
    date DATE NOT NULL
);");
$query ->execute();

$query = $connection->prepare("
CREATE TABLE IF NOT EXISTS lab1.order_items
(
    order_id INT NOT NULL
        REFERENCES lab1.orders(id) ON DELETE CASCADE,
    isbn VARCHAR(13) NOT NULL
        REFERENCES lab1.books(isbn) ON DELETE CASCADE,
    quantity SMALLINT,

    PRIMARY KEY (order_id, isbn)
);");
$query ->execute();

$query = $connection->prepare("
INSERT INTO lab1.books (isbn, author, title, price)
VALUES
    ('0-672-31697-8', 'Чайников В.', 'MySQL для чайников', 120.90),
    ('0-672-89765-6', 'Профи С.', 'MySQL для профессионалов', 432.70),
    ('0-672-56743-2', 'Браун Д.', 'MySQL для студентов кооперативного института', 1500.00),
    ('0-672-09876-3', 'Чайников В.', 'PHP для чайников', 100.90),
    ('0-672-45637-4', 'Профи С.', 'PHP для профессионалов', 300.50),
    ('0-672-23456-6', 'Браун Д.', 'PHP для студентов кооперативного института', 1500.40),
    ('0-672-23769-8', 'Александров Л.', 'Зачет по электронной коммерции за 5 минут', 1.01);");
$query ->execute();

$query = $connection->prepare("INSERT INTO lab1.book_reviews (isbn, review)
VALUES
    ('0-672-31697-8', 'Увлекательное чтение гарантировано!'),
    ('0-672-89765-6', 'Очень нужная и полезная книга. Полностью оправдывает свое название.'),
    ('0-672-56743-2', 'В книге полностью раскрыта проблематика изучения MySQL в кооперативном институте. Приведены принципиальные отличия обучаемости студентов в МУПК от студентов других ВУЗов.'),
    ('0-672-09876-3', 'Ничего не понял из написанного. Пишите проще.'),
    ('0-672-45637-4', 'Рассматриваются вопросы создания электронного магазина на PHP. Достаточно легко читается и можно списать PHP-сценарии для личного использования.'),
    ('0-672-23456-6', 'Вся книга посвящена описанию оператора ECHO в его различных модификациях. В конце обучения обычно этот оператор пишут без ошибок.'),
    ('0-672-23769-8', 'С помощью книги вся наша группа сдала зачет досрочно.'); ");
$query ->execute();

$query = $connection->prepare("INSERT INTO lab1.customers (name, address, city)
VALUES ('Иванов Иван Иванович', 'Транспортная, 23-45', 'Саранск'),
       ('Петров Петр Петрович', 'Московская, 12-4', 'Саранск'),
       ('Сидоров Сидор Сидорович', 'Советская, 7-5', 'Саранск'),
       ('Григорьев Григорий Григорьевич', 'Ленина, 34-45', 'Рузаевка'),
       ('Денисов Денис Денисович', 'Пролетарская, 90-67', 'Рузаевка'); ");
$query ->execute();

$query = $connection->prepare("INSERT INTO lab1.orders (customer_id, amount, date)
VALUES (1, 101.00, '2006-10-02'),
       (2, 3000.80, '2006-08-12'),
       (2, 4500.40, '2006-06-13'),
       (3, 1871.73, '2006-07-23'),
       (4, 1500.91, '2006-08-24'),
       (4, 3000.00, '2006-07-09'),
       (5, 362.70, '2006-10-12'),
       (5, 2107.90, '2006-09-15'),
       (5, 6001.60, '2006-09-27'),
       (5, 20.20, '2006-09-30');");
$query ->execute();

$query = $connection->prepare("INSERT INTO lab1.order_items (order_id, isbn, quantity)
VALUES
    (1, '0-672-23769-8', 100),
    (2, '0-672-23456-6', 2),
    (3, '0-672-23456-6', 1),
    (3, '0-672-56743-2', 2),
    (4, '0-672-23769-8', 3),
    (4, '0-672-31697-8', 8),
    (4, '0-672-45637-4', 3),
    (5, '0-672-09876-3', 2),
    (5, '0-672-89765-6', 3),
    (5, '0-672-23769-8', 1),
    (6, '0-672-56743-2', 2),
    (7, '0-672-31697-8', 3),
    (8, '0-672-09876-3', 6),
    (8, '0-672-45637-4', 5),
    (9, '0-672-23456-6', 4),
    (10, '0-672-23769-8', 20);");
$query ->execute();
exit;



