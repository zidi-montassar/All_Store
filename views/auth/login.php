<?php

use gs\Connection;
use gs\Helpers\Form;
use gs\Models\User;
use gs\Table\Tableuser;




$pdo = Connection::pdo();

$table_user = new Tableuser($pdo);

$errors = [];

if(!empty($_POST['username']) && !empty($_POST['password'])){
    if($_POST['username'] === 'admin'){
        $query = $pdo->query("SELECT * FROM admin");
        $admin = $query->fetch(PDO::FETCH_OBJ);
        $password = $admin->password;
        if(password_verify($_POST['password'], $password)){
            session_start();
            $_SESSION['admin'] = 'admin';
            
            /*if(isset($_GET['previous'])){
                header('Location: ' . $root->url($_GET['previous']));
                exit();
            }else{
                header('Location: ' . $root->url('Admin'));
                exit();
            }*/

            header('Location: ' . $root->url('Admin'));
            exit();
        }
    }elseif($table_user->auth($_POST['username'], $_POST['password']) !== false){
            session_start();
            $_SESSION['user'] = $table_user->auth($_POST['username'], $_POST['password']);
            
            /*if(isset($_GET['previous'])){
                header('Location: ' . $root->url($_GET['previous']));
                exit();
            }else{
                header('Location: ' . $root->url('Home'));
                exit();
            }*/

            header('Location: ' . $root->url('Home'));
                exit();
        
    }else{
        $errors['username'] = 'Invalid username or password!';
    }
}









$user = new User();

$form = new Form($user, $errors);

?>

<h1 class="mt-4">Login</h1>

<div class="mt-4">
    <form action="" method="POST">
        <div class="form-group">
            <?= $form->input('username', 'Username') ?>
            <?= $form->input('password', 'Password') ?>
        </div>
        <button class="btn btn-primary my-2" type="submit">Login</button>
    </form>
</div>