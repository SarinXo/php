<?php
$host = 'mysql';
$dbname = 'firsova';
$charset = 'utf8mb4';
$dbuser = 'root';
$dbpass = 'root';
@$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $dbuser, $dbpass);

require 'libs/autoload.php';

@$redis = new Predis\Client([
    'scheme' => 'tcp',
    'host' => 'redis',
    'port' => 6379,
]);