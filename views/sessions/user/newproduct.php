<?php
use gs\Helpers\{Form, Objects, Auth, History};
use gs\Models\{Category, Product};
use gs\Connection;
use gs\Table\{Tablecategory, Tableproduct, Tableuser};
use gs\Validators\ProductValidator;


Auth::check($match['name']);

$pdo = Connection::pdo();

if(isset($_SESSION['user'])){
    $username = $_SESSION['user']; 
}else{
    $username = 'admin';
}

$product = new Product();
$errors = [];
$success = false;

$table_category = new Tablecategory($pdo);
$categories = [];
foreach(($table_category->getAll()) as $category){
    $categories[] = $category->getName();
}

if(!empty($_POST)){
    Objects::set($product, $_POST, [
        'ref', 'name', 'description', 'brand', 'category', 'supplier', 'quantity', 'a_quantity', 'purchase_price',
         'retail_price', 'wholesale_price', 'validity_date', 'reg_temp', 'details'
    ]);
    $table_product = new Tableproduct($pdo);
    $v = new ProductValidator($_POST, $table_product, $categories);
    if($v->validate()){
        $pdo->beginTransaction();
            $table_product->create($product);
            History::adding($pdo, $username, 'Product reference: ' . $product->getRef());
            $success = true;
        $pdo->commit();
    }else{
        $errors[] = $v->errors();
    }
}



$form = new Form($product, $errors);

?>

<div class="container my-4">
<h1 style="color:blue">Add New Product</h1>

<?php if ($success === true): ?>
        <div class="alert alert-success">Product created successfully</div>
<?php elseif(!empty($errors)): ?>
        <div class="alert alert-danger">Error!</div>
<?php endif ?>
<?php
$param = 1;
if(!empty($_POST)){
    //dd($_POST);
    $param  = null;
}
?> 
<form action="" method="POST" class="my-4">
    <?=$form->input('ref', 'Reference', $param)?>
    <?=$form->input('name', 'Product Name', $param)?>
    <?=$form->textarea('description', 'Description', $param)?>
    <?=$form->input('brand', 'Mark', $param)?>
    <?=$form->select('category', 'Category', 'Select Category', $categories)?>
    <?=$form->input('purchase_price', 'Purchase Price ($)', $param)?>
    <?=$form->input('retail_price', 'Retail Price ($)', $param)?>
    <?=$form->input('wholesale_price', 'Wholesale Price ($)', $param)?>
    <?=$form->input('quantity', 'Quantity', $param)?>
    <?=$form->input('a_quantity', 'Limit-Alert Qyantity', $param)?>
    <?=$form->input('supplier', 'Supplier', $param)?>
    <?=$form->input('validity_date', 'Validity Date (dd-mm-yyyy)', $param)?>
    <?=$form->input('reg_temp', 'Conservation Regular Temperature (°C)', $param)?>
    <?=$form->textarea('details', 'Details', $param)?>

<button class="btn btn-primary my-2" type="submit">Save</button>
<a href="<?=$root->url('Home')?>" class="btn btn-danger">cancel</a>
</form>
</div>
