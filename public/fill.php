<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use gs\Connection;

$pdo = Connection::pdo();

//$pdo->exec("INSERT INTO user SET username= 'user', password= 'user'");

//$pdo->exec("UPDATE product SET category= '4' WHERE id= 6");

//$password = password_hash('admin', PASSWORD_BCRYPT);
//$pdo ->exec("INSERT INTO admin SET admin= 'admin', password= '{$password}'");

