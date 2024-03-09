<?php

use gs\Connection;
use gs\Models\Sale;
use gs\Helpers\{Objects, Form, Auth};
use gs\Models\Costumer;
use gs\Table\{Tableproduct, Tablesale, Tablecostumer, Tableuser};
use gs\Validators\SaleValidator;


Auth::check($match['name']);


$pdo = Connection::pdo();
$references = [];
$opt = [];

$query = $pdo->query("SELECT ref FROM product");
$refs = $query->fetchAll(PDO::FETCH_OBJ);
foreach($refs as $ref){
    $references[] = $ref->ref;
}
foreach($references as $reference){
    $selected = "";
    if(!empty($_POST)){
        if($_POST['product_ref'] === $reference){
            $selected = " selected";
        }
    }
    $opt[] = "<option value=\"$reference\"$selected>$reference</option>";
}
$options = implode('', $opt);

$sale = new Sale();
$errors = [];
$success = false;
$param = 1;


if(isset($_SESSION['user'])){
    $username = $_SESSION['user']; 
}else{
    $username = 'admin';
}

 

if(!empty($_POST)){
    $_POST['username'] = $username;
    Objects::set($sale, $_POST, ['costumer', 'product_ref', 'quantity', 'price', 'type', 'details', 'username']);
    $param = null;
    $table_product = new Tableproduct($pdo);
    $table_sale = new Tablesale($pdo);
    $s_validator = new SaleValidator($_POST, $table_product, $sale->getProduct_ref());
    if($s_validator->validate()){
        $pdo->beginTransaction();
        $table_sale->new($sale);
        $table_product->sell($sale->getProduct_ref(), $sale->getQuantity());
        if(!Tablecostumer::check($pdo, $_POST['costumer'])){
            Tablecostumer::add($pdo, $_POST['costumer']);
        }
        $pdo->commit();
        $success = true;
    }else{
        $errors[]= $s_validator->errors();
    }
}

$form = new Form($sale, $errors);

?>


<div class="form-group mt-4">
    <h1>Sale</h1>
    <?php if($success === true): ?>
        <div class="alert alert-success">Product sale saved successfully</div>
    <?php endif ?>
    <?php if(!empty($errors)): ?>
        <div class="alert alert-danger">Error!</div>
    <?php endif ?>
    <div class="form-control mt-4">
        <form action="" method="POST">
            <?=$form->input('costumer', 'For Mr/Ms:', $param)?>
            <div class="form-group mt-4">
                <label for="reference">Reference</label>
                <select id="reference" name="product_ref" class="form-control"><?=$options?></select>
            </div>
            <?=$form->input('quantity', 'Quantity', $param)?>
            <div class="form-group mt-2 mb-2">
                
                Choose the type of sale:
                    
                        <div class="form-control">
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" value="Retail"> Retail sales transaction
                            </label>
                        </div>
                        
                        <div class="radio">
                            <label>
                                <input type="radio" name="type" value="Wholesale"> Wholesale operation
                            </label>
                        </div>    
                        </div>
                        <?=$form->input('price', 'Price ($):', $param)?>
                    
                
            </div>
            <div class="form-group mt-4">
                <?php $value = $param === null ? $sale->getDetails() : null ?>
                <label for="details">Details</label>
                <textarea name="details" id="details" class="form-control" placeholder="Add any details here"><?= $value ?></textarea>
            </div>
            <button class="btn btn-primary mt-2" type="submit">Save</button>
            <a href="<?= $root->url('Home') ?>" class="btn btn-danger mt-2">Cancel</a>
        </form>
    </div>
</div>

