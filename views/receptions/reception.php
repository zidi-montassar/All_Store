<?php

use gs\Connection;
use gs\Models\Reception;
use gs\Helpers\{Objects, Form, Auth};
use gs\Table\{Tableproduct, Tablereception, Tablesupplier, Tableuser};
use gs\Validators\ReceptionValidator;

Auth::check($match['name']);

$pdo = Connection::pdo();

if(isset($_SESSION['user'])){
    $username = $_SESSION['user']; 
}else{
    $username = 'admin';
}



$references = [];
$opt = [];

$query = $pdo->query("SELECT ref FROM product");
$refs = $query->fetchAll(PDO::FETCH_OBJ);
foreach($refs as $ref){
    $references[] = $ref->ref;
}
foreach($references as $reference){
    $opt[] = "<option value=\"$reference\">$reference</option>";
}
$options = implode('', $opt);

$reception = new Reception();
$errors = [];
$success = false;
$param = 1;

if(!empty($_POST)){
    $table_product = new Tableproduct($pdo);
    $table_reception = new Tablereception($pdo);
    $r_validator = new ReceptionValidator($_POST);
    if($r_validator->validate()){
        $_POST['username'] = $username;
        Objects::set($reception, $_POST, ['product_ref', 'quantity', 'purchase_price', 'supplier', 'details', 'username']);
        $param = null;
        $pdo->beginTransaction();
        $table_reception->new($reception);
        $table_product->recieve($reception->getProduct_ref(), $reception->getQuantity());
        if($_POST['supplier'] !== ""){
            if(!Tablesupplier::check($pdo, $_POST['supplier'])){
                Tablesupplier::add($pdo, $_POST['supplier']);
            }
        }
        $pdo->commit();
        $success = true;
    }else{
        $errors[]= $r_validator->errors();
    }
}

$form = new Form($reception, $errors);

?>

<div class="form-group mt-4">
    <h1>Reception</h1>
    <?php if($success === true): ?>
        <div class="alert alert-success">Product reception saved successfully</div>
    <?php endif ?>
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">Error!</div>
    <?php endif ?>
    <div class="form-control mt-4">
        <form action="" method="POST">
            <div class="form-group mt-4">
                <label for="reference">Reference</label>
                <select id="reference" name="product_ref" class="form-control"><?=$options?></select>
            </div>
            <?=$form->input('quantity', 'Quantity', $param)?>
            <?=$form->input('purchase_price', 'Purchase Price ($)', $param)?>
            <?=$form->input('supplier', 'Supplier', $param)?>
            <div class="form-group mt-4">
                <label for="details">Details</label>
                <textarea name="details" id="details" class="form-control" placeholder="Add any details here"></textarea>
            </div>
            <button class="btn btn-primary mt-2" type="submit">Save</button>
            <a href="<?= $root->url('Home') ?>" class="btn btn-danger mt-2">Cancel</a>
        </form>
    </div>
</div>

