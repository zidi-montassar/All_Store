<?php

use gs\Helpers\Auth;
use gs\Connection;
use gs\Table\Tableuser;


Auth::admincheck($match['name']);


$pdo = Connection::pdo();

$table_user = new Tableuser($pdo);

$users = $table_user->getAll();











?>

<div class="container my-4">
    <h1>Users Management</h1>
    <?php if(isset($_GET['delete'])): ?>
        <div class="alert alert-success">user account deleted successfully</div>
    <?php endif ?>
    <div class="container my-4">
        <div class="content" align='right'>
            <a href="<?= $root->url('Create_User') ?>" class="btn btn-primary">New user</a>
        </div>
        
        <h3>Users:</h3>
        <div class="form-control my-2">
            <?php foreach($users as $user): ?>
               <ul >
                    <li>
                        <?= $user->getUsername() ?>
                        <form action="<?=$root->url('Delete_User', ['id' => $user->getId()])?>" method="POST"
                            onsubmit="return confirm('Do you really want to delete this user ?')" style="display:inline" style="justify-content:space-between">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </li>
                    
               </ul>
            <?php endforeach ?>    
        </div>
    </div>
</div>