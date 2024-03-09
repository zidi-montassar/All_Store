<?php
use gs\Connection;
use gs\Table\Tablecategory;
use gs\Helpers\Auth;

Auth::check($match['name']);



$category_id = $params['id'];

$pdo = Connection::pdo();

$category_table = new Tablecategory($pdo);

//$category_table->delete($category_id);

header('Location: ' . $root->url('Categories') . '?delete=1');

