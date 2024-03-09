<?php
use gs\Connection;
use gs\Table\{Tableproduct, Tableuser};
use gs\Helpers\{History, Auth};


Auth::check($match['name']);



if(isset($_SESSION['user'])){
    $username = $_SESSION['user']; 
}else{
    $username = 'admin';
}
 


$product_id = $params['id'];

$pdo = Connection::pdo();

$product_table = new Tableproduct($pdo);

$pdo->beginTransaction();
$product = $product_table->getOne($product_id);
$success = $product_table->delete($product_id);
History::deleting($pdo, $username, 'Product Ref: ' . $product->getRef());
$pdo->commit();

?>

<div class="mt-4"
    <?php if($success): ?>
        <div class="alert alert-success">Product deleted successfully!</div>
        <a href="<?= $root->url('Home') ?>" class="btn btn-primary">Go to home page</a>
    <?php endif; ?>
</div>

