<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use gs\Connection;

$pdo = Connection::pdo();

$pdo->exec('TRUNCATE TABLE product');
//$pdo->exec('TRUNCATE TABLE category');
//$pdo->exec('TRUNCATE TABLE reception');
//$pdo->exec('TRUNCATE TABLE sale');
//$pdo->exec('TRUNCATE TABLE user');

