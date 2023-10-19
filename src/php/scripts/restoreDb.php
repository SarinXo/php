<?php
    require_once(realpath(dirname(__FILE__) . '/../db.php'));
    header('Refresh: 2; URL=http://localhost/pages/homepage/homepage.php');
    echo '<senter>Успешный бекап. Возврат на главную страницу...</senter> ';

	$redis->flushdb();

	$deleteDb = $connection->prepare
	('
		DROP DATABASE `firsova`;
	');

	$deleteDb->execute() or die(print_r($deleteDb->errorInfo()));

	$initDb = $connection->prepare
	('
		SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
		START TRANSACTION;
		SET time_zone = "+00:00";
		CREATE DATABASE IF NOT EXISTS `firsova` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
		USE `firsova`;
		CREATE TABLE `books` (
		`isbn` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
		`author` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
		`title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
		`price` decimal(6,2) DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
		INSERT INTO `books` (`isbn`, `author`, `title`, `price`) VALUES
		(\'0-672-09876-3\', \'Чайников В.\', \'PHP для чайников\', 100.90),
		(\'0-672-23456-6\', \'Браун Д.\', \'PHP для студентов кооперативного института\', 1500.40),
		(\'0-672-23769-8\', \'Александров Л.\', \'Зачет по электронной коммерции за 5 минут\', 1.01),
		(\'0-672-31697-8\', \'Чайников В.\', \'MySQL для чайников\', 120.90),
		(\'0-672-45637-4\', \'Профи С.\', \'PHP для профессионалов\', 300.50),
		(\'0-672-56743-2\', \'Браун Д.\', \'MySQL для студентов кооперативного института\', 1500.00),
		(\'0-672-89765-6\', \'Профи С.\', \'MySQL для профессионалов\', 432.70);
		CREATE TABLE `book_reviews` (
		`isbn` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
		`review` text COLLATE utf8mb4_unicode_ci
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
		INSERT INTO `book_reviews` (`isbn`, `review`) VALUES
		(\'0-672-09876-3\', \'Ничего не понял из написанного. Пишите проще.\'),
		(\'0-672-23456-6\', \'Вся книга посвящена описанию оператора ECHO в его различных модификациях. В конце обучения обычно этот оператор пишут без ошибок.\'),
		(\'0-672-23769-8\', \'С помощью книги вся наша группа сдала зачет досрочно.\'),
		(\'0-672-31697-8\', \'Увлекательное чтение гарантировано!\'),
		(\'0-672-45637-4\', \'Рассматриваются вопросы создания электронного магазина на PHP. Достаточно легко читается и можно списать PHP-сценарии для личного использования.\'),
		(\'0-672-56743-2\', \'В книге полностью раскрыта проблематика изучения MySQL в кооперативном институте. Приведены принципиальные отличия обучаемости студентов в МУПК от студентов других ВУЗов.\'),
		(\'0-672-89765-6\', \'Очень нужная и полезная книга. Полностью оправдывает свое название.\');
		CREATE TABLE `customers` (
		`id` bigint UNSIGNED NOT NULL,
		`name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
		`address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
		`city` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
		INSERT INTO `customers` (`id`, `name`, `address`, `city`) VALUES
		(1, \'Иванов Иван Иванович\', \'Транспортная, 23-45\', \'Саранск\'),
		(2, \'Петров Петр Петрович\', \'Московская, 12-4\', \'Саранск\'),
		(3, \'Сидоров Сидор Сидорович\', \'Советская, 7-5\', \'Саранск\'),
		(4, \'Григорьев Григорий Григорьевич\', \'Ленина, 34-45\', \'Рузаевка\'),
		(5, \'Денисов Денис Денисович\', \'Пролетарская, 90-67\', \'Рузаевка\');
		CREATE TABLE `orders` (
		`id` bigint UNSIGNED NOT NULL,
		`customer_id` bigint UNSIGNED NOT NULL,
		`amount` decimal(8,2) DEFAULT NULL,
		`date` date NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
		INSERT INTO `orders` (`id`, `customer_id`, `amount`, `date`) VALUES
		(1, 1, 101.00, \'2006-10-02\'),
		(2, 2, 3000.80, \'2006-08-12\'),
		(3, 2, 1500.40, \'2006-06-13\'),
		(4, 3, 3.03, \'2006-07-23\'),
		(5, 4, 201.80, \'2006-08-24\'),
		(6, 4, 3000.00, \'2006-07-09\'),
		(7, 5, 362.70, \'2006-10-12\'),
		(8, 5, 605.40, \'2006-09-15\'),
		(9, 5, 6001.60, \'2006-09-27\'),
		(10, 5, 20.20, \'2006-09-30\');
		CREATE TABLE `order_items` (
		`order_id` bigint UNSIGNED NOT NULL,
		`isbn` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
		`quantity` smallint DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
		INSERT INTO `order_items` (`order_id`, `isbn`, `quantity`) VALUES
		(1, \'0-672-23769-8\', 100),
		(2, \'0-672-23456-6\', 2),
		(3, \'0-672-23456-6\', 1),
		(3, \'0-672-56743-2\', 2),
		(4, \'0-672-23769-8\', 3),
		(4, \'0-672-31697-8\', 8),
		(4, \'0-672-45637-4\', 3),
		(5, \'0-672-09876-3\', 2),
		(5, \'0-672-23769-8\', 1),
		(5, \'0-672-89765-6\', 3),
		(6, \'0-672-56743-2\', 2),
		(7, \'0-672-31697-8\', 3),
		(8, \'0-672-09876-3\', 6),
		(8, \'0-672-45637-4\', 5),
		(9, \'0-672-23456-6\', 4),
		(10, \'0-672-23769-8\', 20);
		CREATE TABLE `users` (
		`customer_id` bigint UNSIGNED NOT NULL,
		`login` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
		`password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
		INSERT INTO `users` (`customer_id`, `login`, `password`) VALUES
		(1, \'user1\', \'$2y$10$lEMYhdKMfZ46r9DTZ3Jx4.UCjoNLa7NrlRUNThDr6GQiKAR7ehQK2\'),
		(2, \'user2\', \'$2y$10$GyZcuTwDvWzZdN2KEGAITeM.DiY5NbeogZ0DFc477uhbd4NL.tEEa\'),
		(3, \'user3\', \'$2y$10$Mm6TJ7h19UwypkW9/xjvcuk9Nns24Kes5dqWCrORW3xdzKTUP3mgC\'),
		(4, \'user4\', \'$2y$10$T1xsT67n9Rsrbq1/8WkSRup5OfNdWLnE1M6y9V3yGnlBgm/p1v63q\'),
		(5, \'user5\', \'$2y$10$zEmYesI9n6Z0v5XW5TzQluSzoN8Kvr93XhZYyWi6HuHSzvA8gFnKe\');
		ALTER TABLE `books`
		ADD PRIMARY KEY (`isbn`);
		ALTER TABLE `book_reviews`
		ADD PRIMARY KEY (`isbn`);
		ALTER TABLE `customers`
		ADD PRIMARY KEY (`id`),
		ADD UNIQUE KEY `id` (`id`);
		ALTER TABLE `orders`
		ADD PRIMARY KEY (`id`),
		ADD UNIQUE KEY `id` (`id`),
		ADD KEY `customer_id` (`customer_id`);
		ALTER TABLE `order_items`
		ADD PRIMARY KEY (`order_id`,`isbn`),
		ADD KEY `isbn` (`isbn`);
		ALTER TABLE `users`
		ADD PRIMARY KEY (`login`),
		ADD KEY `customer_id` (`customer_id`);
		ALTER TABLE `customers`
		MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
		ALTER TABLE `orders`
		MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
		ALTER TABLE `book_reviews`
		ADD CONSTRAINT `book_reviews_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE;
		ALTER TABLE `orders`
		ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
		ALTER TABLE `order_items`
		ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
		ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`) ON DELETE CASCADE ON UPDATE CASCADE;
		ALTER TABLE `users`
		ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
		COMMIT;
	');

	$initDb->execute() or die(print_r($initDb->errorInfo()));

	echo 'Успех';