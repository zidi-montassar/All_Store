<?php
use gs\Connection;
use gs\Helpers\{Form, Auth};
use gs\Table\Tablecategory;
use gs\Models\{Product, Category};



Auth::check($match['name']);



$pdo = Connection::pdo();

$table_category = new Tablecategory($pdo);
$categories = $table_category->getCategories();
$categories[0] = 'All';
//dd($_POST['category']);
$opt = [];
foreach($categories as $k => $category){
    $selected = $_POST['category'] == $k ? " selected" : "";
    $opt[] = "<option value=\"$k\"$selected>$category</option>";
}
$options = implode('', $opt);


//dd($_POST);
$columns = ['Ref', 'Name', 'Category', 'Quantity'];

if(!empty($_POST)){
    
    $msg = "SELECT ref, name, category, quantity FROM product";
    if($_POST['category'] !== '0'){
        $c = $categories[$_POST['category']];
        $msg .= " WHERE category= '{$c}'";
    }
    $query = $pdo->query($msg);
    $products = $query->fetchAll(PDO::FETCH_CLASS, Product::class);
    //dd($products);
    $total_quantity = 0;
    foreach($products as $product){
        $total_quantity = $total_quantity + $product->getQuantity();
    }
    
}



















?>

<div class="mt-5">
    <h1 style="color: white;">Inventory</h1>
    <div class="form-group mt-5">
        <form action="" method="POST">
                <div class="form-group ">
                            <label for="cat" style="color: white;">Select Category</label>
                            <select id="cat" class="ms-4" name="category" required><?= $options ?></select>
                            <button class="btn btn-primary ms-2" type="submit" style="display:inline">Select</button>
                </div>
            
        </form>
    </div>
</div>

<?php if(!empty($_POST)): ?>

<div class="mt-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <?php foreach($columns as $column): ?>
                    <th style="font-size: 22px;"><?= $column ?></th>
                <?php endforeach ?> 
            </tr>   
        </thead>
        <tbody>
            <?php foreach($products as $product): ?>
                <tr>
                    <?php foreach($columns as $column):
                        $command = 'get' . $column; ?>
                         
                        <td style="font-size: 18px;"><?= $product->$command() ?></td>
                        
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
            <tr>
                <td><strong>Total</strong></td>
                <td>***</td>
                <td>***</td>
                <td><strong><?= $total_quantity ?></strong></td>
            </tr>
        </tbody>
    </table>
</div>

<?php endif ?>