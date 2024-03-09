<?php 

namespace gs\Table;

use PDO;
use gs\Connection;

abstract class Table{
    
    protected $pdo;
    protected $name = null;
    protected $class_name = null;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll(): array
    {
        $query = $this->pdo->query("SELECT * FROM {$this->name}");
        return $query->fetchall(PDO::FETCH_CLASS, $this->class_name);
    }

    public function getOne(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->name} WHERE id= :id");
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class_name);
        return $query->fetch();
    }

    
    public function exist(string $field, $value, ?int $except=null): bool
    {
        $sql = "SELECT COUNT(id) FROM {$this->name} WHERE $field= :field";
        $params = ['field' => $value];
        if($except !== null){
            $sql .= " AND id != :id";
            $params['id']= $except ;
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($params);
        return (int)$query->fetch(PDO::FETCH_NUM)[0] != 0;
    }

    protected function createSlug(string $sentence): string
    {
        
        return chunk_split($sentence, 1, '-');
    }

    
}