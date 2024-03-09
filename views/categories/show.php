<?php
use gs\Connection;
use gs\Table\{Tableproduct, Tablecategory};
use gs\Models\{Category, Product};
use gs\d_t_src\{QueryBuilder, TableBuilder};

$c_id = $params['id'];
$c_slug = $params['slug'];

$pdo = Connection::pdo();



$table_category = new Tablecategory($pdo);
$categories = $table_category->getCategories();
$category = $categories[$c_id];


$query= (new QueryBuilder($pdo));
$query->from('product');
$query->where("category= '{$category}'");

/*
//City Search
if (!empty($_GET['q'])){
    $query->where("city Like :city")->setParam('city', '%' . $_GET['q'] . '%');
}
*/

//Table Preparation
$Table = new TableBuilder($query, $_GET, [
    'ref' => 'Reference',
    'name' => 'Name',
   'brand' => 'Trademark',
   'retail_price' => 'Sell price',
   'wholesale_price' => 'W.Price',
   'quantity' => 'Quantity'
], $categories, 'retail_price', 'ref');




if(session_status() === PHP_SESSION_NONE){
    session_start();
}



?>

<div class="container my-4">
    <h1 style="color:blue">Category: <?= $category ?></h1>
    <?php if(isset($_SESSION['user']) || isset($_SESSION['admin'])): ?>
    <div class="content" align="right">
            <a href="<?= $root->url('Edit_Category', ['slug' => $c_slug, 'id' => $c_id]) ?>" class="btn btn-primary">Edit</a>
            <?php /*<form action="<?= $root->url('Delete_Category', ['id' => $c_id]) ?>" method="POST" onsubmit="return confirm('Do you really want to delete this category?')" style="display:inline">
            <button class="btn btn-danger" type="submit">Delete</button>
            </form>*/ ?>
    </div>
    <?php endif ?>
    <div class="p-4">
        <?php $Table->execute($root) ?>
    </div>
</div>