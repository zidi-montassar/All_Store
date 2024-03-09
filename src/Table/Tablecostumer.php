<?php

namespace gs\Table;

use PDO;
use gs\Models\Costumer;

class Tablecostumer extends Table{

    protected $name = 'costumer';
    protected $class_name = Costumer::class;

    public static function check(PDO $pdo, string $costumer): bool
    {
        $sql = "SELECT COUNT(id) FROM costumer WHERE costumer= :costumer";
        $params = ['costumer' => $costumer];
        $query = $pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] != 0;
    }

    public static function add(PDO $pdo, string $costumer)
    {
        $query = $pdo->prepare("INSERT INTO costumer SET costumer= ?");
        $query->execute([$costumer]);
    }
}