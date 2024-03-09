<?php

namespace gs\Table;

use PDO;

class Tablesupplier extends Table{


    public static function check(PDO $pdo, string $supplier): bool
    {
        $sql = "SELECT COUNT(id) FROM supplier WHERE supplier= :supplier";
        $params = ['supplier' => $supplier];
        $query = $pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] != 0;
    }

    public static function add(PDO $pdo, string $supplier)
    {
        $query = $pdo->prepare("INSERT INTO supplier SET supplier= ?");
        $query->execute([$supplier]);
    }
}