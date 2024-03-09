<?php

namespace gs;

use PDO;

class Connection{

    public static function pdo (): PDO
    {
        return new PDO('mysql:dbname=All_store;host=localhost', 'root', 'rasta',[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}