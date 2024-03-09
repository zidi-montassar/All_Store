<?php

use gs\Connection;
use gs\Table\Tableuser;
use gs\Helpers\Auth;


Auth::admincheck($match['name']);



$pdo = Connection::pdo();

$table_user = new Tableuser($pdo);

$success = $table_user->delete($params['id']);

if($success){
    header('Location: ' . $root->url('Users') . '?delete=1');
    exit();
}