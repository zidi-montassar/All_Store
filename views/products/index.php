<?php

use gs\d_t_src\{LinkHelper, NumberHelper, QueryBuilder, TableHelper, TableBuilder, Table};
use gs\Connection;
use gs\Table\Tablecategory;
use gs\Models\Category;

$pdo = Connection::pdo();

$table_category = new Tablecategory($pdo);
$categories = $table_category->getCategories();




define('PER_PAGE', 3);

$query= (new QueryBuilder($pdo))->from('product');


//City Search
if (!empty($_GET['q'])){
    $query->where("ref Like :ref OR name LIKE :name")
            ->setParam('ref', '%' . $_GET['q'] . '%')
            ->setParam('name', '%' . $_GET['q'] . '%');
}


//Table Preparation
$Table = new TableBuilder($query, $_GET, [
    'ref' => 'Reference',
    'name' => 'Name',
    'brand' => 'Trademark',
    'category' => 'Category',
    'retail_price' => 'Sale price',
    'wholesale_price' => 'W.Price',
    'quantity' => 'Quantity'
], $categories, 'retail_price', 'ref');

?>

<div class="container mt-5">
<h1 style="color:white">Products</h1>

<div class="mt-5">
    <?php $Table->execute($root) ?>
</div>
</div>
