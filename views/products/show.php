<?php
use gs\Connection;
use gs\d_t_src\NumberHelper;
use gs\Models\{Product, Category};
use gs\Table\{Tableproduct, Tablecategory};

$id = $params['id'];
$slug = $params['slug'];

$pdo = Connection::pdo();

$table_product = new Tableproduct($pdo);
$product = $table_product->getOne($id);


$table_category = new Tablecategory($pdo);
$category = $table_category->getOneCategory($product->getCategory());


if(session_status() === PHP_SESSION_NONE){
    session_start();
}



?>

<div class="form-group mt-4">
    <h1 style="color:blue">Product: <?= $product->getName() ?></h1>
    <?php  //dd($_SESSION) ?>
    <div class="form-control mt-4">
        <?php if(isset($_SESSION['user']) || isset($_SESSION['admin'])): ?>
            <div class="content" align="right">
                <a href="<?= $root->url('Edit_Product', ['slug' => $slug, 'id' => $id]) ?>" class="btn btn-primary">Edit</a>
                <form action="<?= $root->url('Delete_Product', ['id' => $id]) ?>" method="POST" onsubmit="return confirm('Do you really want to delete this product?')" style="display:inline">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        <?php endif ?>
        
        <p><h5 style="display:inline">Reference:</h5> <?= $product->getRef() ?></p>
        
        <p><h5 style="display:inline">Name:</h5> <?= $product->getName() ?></p>
        
        <p><h5 style="display:inline">Description:</h5> <?= $product->getDescription() ?></p>
        
        <p><h5 style="display:inline">Brand:</h5> <?= $product->getBrand() ?></p>
        
        <p><h5 style="display:inline">Category:</h5> <a href="<?= $root->url('Show_Category', ['slug' => $category->getSlug(), 'id' => $category->getId()]) ?>"><?= $category->getName() ?></a></p>
        
        <p><h5 style="display:inline">Supplier:</h5> <?= $product->getSupplier() ?></p>
        
        <p><h5 style="display:inline">Quantity:</h5> <?= $product->getQuantity() ?></p>
        
        <p><h5 style="display:inline">Purchase Price:</h5> <?= NumberHelper::price($product->getPurchase_price()) ?></p>

        <p><h5 style="display:inline">Retail Price:</h5> <?= NumberHelper::price($product->getRetail_price()) ?></p>
        
        <p><h5 style="display:inline">Wholesale Price:</h5> <?= NumberHelper::price($product->getWholesale_price()) ?></p>
        
        <?php if($product->getValidity_date() !== null): ?>
            <p><h5 style="display:inline">Validity Date:</h5> <?= $product->getValidity_date() ?></p>
        <?php endif ?>

        <?php if($product->getReg_temp() !== null): ?>
            <p><h5 style="display:inline">Regular Conservation Temperature:</h5> <?= $product->getReg_temp() ?></p>
        <?php endif ?>

        <?php if($product->getDetails() !== null): ?>
            <p><h5 style="display:inline">Details:</h5> <?= $product->getDetails() ?></p>
        <?php endif ?>
    </div>
</div>
