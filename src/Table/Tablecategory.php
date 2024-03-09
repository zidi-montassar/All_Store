<?php

namespace gs\Table;

use Exception;
use PDO;
use gs\Models\Category;

class Tablecategory extends Table{

    protected $name = 'category';
    protected $class_name = Category::class;

 

    public function create(string $name)
    {
        $slug = $this->createSlug($name);
        $this->pdo->exec("INSERT INTO {$this->name} SET name='{$name}', slug='{$slug}'");
    }

    public function update(string $name, int $c_id)
    {
        $slug = $this->createSlug($name);
        $this->pdo->exec("UPDATE {$this->name} SET name='{$name}', slug='{$slug}' WHERE id= $c_id");
    }

    public function delete(int $category_id)
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->name} WHERE id= ?");
        $result = $query->execute([$category_id]);
        if($result === false){
            throw new Exception('can not delete this category!');
        }
    }

    public function getCategories(): array
    {
        $categories = [];
        $query = $this->pdo->query("SELECT * FROM {$this->name}");
        foreach(($query->fetchAll(PDO::FETCH_CLASS, $this->class_name)) as $category){
            $categories[$category->getId()] = $category->getName();
        }
        return $categories;
    }

    public function getOneCategory(string $name)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->name} WHERE name= :name");
        $query->execute(['name' => $name]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class_name);
        return $query->fetch();
    }

 
}