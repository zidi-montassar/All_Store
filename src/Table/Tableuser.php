<?php
namespace gs\Table;

use gs\Models\User;
use Exception;
use PDO;

class Tableuser extends Table{

    protected $name = 'user';
    protected $class_name = User::class;


    public function new(string $username, string $password)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->name} SET username= :username, password= :password");
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $query->execute([
            'username' => $username,
            'password' => $hashed_password
        ]);
    }

    public function delete(int $id): bool
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->name} WHERE id= ?");
        $result = $query->execute([$id]);
        if($result === false){
            throw new Exception('can not delete this item');
        }else{
           return true;
        }
    }

    public function auth(string $username, string $password): string|bool
    {
        $query = $this->pdo->query("SELECT * FROM user");
        $users = $query->fetchall(PDO::FETCH_CLASS, $this->class_name);
        foreach($users as $user){
            if($username === $user->getUsername()){
                if(password_verify($password, $user->getPassword())){
                    return $user->getUsername();
                }
            }
        }
        return false;
    }

}