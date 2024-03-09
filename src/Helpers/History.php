<?php

namespace gs\Helpers;

use PDO;
use DateTime;

class History{



    public static function editing(PDO $pdo, string $username, string $object, array $changes)
    {
        foreach($changes as $property => $change){
            $query = $pdo->prepare("INSERT INTO editing SET object= :object, property= :property, details= :details, username= :username, e_date= :e_date");
            $query->execute([
                'object' => $object,
                'property' => $property,
                'details' => $change,
                'username' => $username,
                'e_date' => (new DateTime())->format('Y-m-d')
            ]);
        }
    }

    public static function deleting(PDO $pdo, string $username, string $object)
    {
            $query = $pdo->prepare("INSERT INTO deletion SET object= :object, username= :username, details= :details, d_date= :d_date");
            $query->execute([
                'object' => $object,
                'username' => $username,
                'details' => 'Item deleted',
                'd_date' => (new DateTime())->format('Y-m-d')
            ]);
        
    }

    public static function adding(PDO $pdo, string $username, string $object)
    {
            $query = $pdo->prepare("INSERT INTO addition SET username= :username, object= :object, details= :details, a_date= :a_date");
            $query->execute([
                'username' => $username,
                'object' => $object,
                'details' => 'Item added',
                'a_date' => (new DateTime())->format('Y-m-d')
            ]);
        
    }

}