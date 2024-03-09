<?php

use gs\Connection;
use gs\Helpers\{Form, Objects, Auth};
use gs\Table\Tableuser;
use gs\Models\User;
use gs\Validators\UserValidator;


Auth::admincheck($match['name']);


$pdo = Connection::pdo();

$table_user = new Tableuser($pdo);

$v = new UserValidator($_POST, $table_user);

$user = new User();

$success = false;

$errors = [];

$param = 1;


if(!empty($_POST)){
    Objects::set($user, $_POST, ['username', 'password']);
    if($v->validate()){
        $table_user->new($_POST['username'], $_POST['password']);
        $success = true;
    }else{
        $errors[] = $v->errors();
    }
}


$form = new Form($user, $errors);



?>

<div class="container my-4">
    <h1>Sign Up</h1>
    <?php if ($success === true): ?>
        <div class="alert alert-success my-4">User account created successfully -__-</div>
    <?php elseif(!empty($errors)): ?>
        <div class="alert alert-danger my-4">Error!</div>
    <?php endif ?>
    <div class="form-control my-4">
        <form action="" method="POST">
            <?php if(!empty($_POST)): ?>
            <?= $form->input('username', 'Enter the username:') ?>
            <?php else: ?>
            <?= $form->input('username', 'Enter the username:', $param) ?>
            <?php endif ?>
            <?= $form->input('password', 'Enter the password:', $param) ?>
            <?= $form->input('confirmation password', 'Repeat the password', $param) ?>
            <button type="submit" class="btn btn-primary mt-4">Sing Up</button>
        </form>
    </div>
</div>