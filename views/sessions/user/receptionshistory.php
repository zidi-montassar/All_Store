<?php
use gs\Models\{Reception, Product, User};
use gs\Connection;
use gs\Table\Tableproduct;
use gs\Helpers\Auth;



Auth::check($match['name']);


$pdo = Connection::pdo();


if(isset($_SESSION['user'])){
    $username = $_SESSION['user']; 
}else{
    $username = 'admin';
}

$references = [];
$opt = [];

//getting products references
$query = $pdo->query("SELECT ref FROM product");
$refs = $query->fetchAll(PDO::FETCH_OBJ);
$references[0] = 'All';
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

//getting suppliers:
$suppliers = [];
$opts = [];
$query = $pdo->query("SELECT supplier FROM supplier");
$splrs = $query->fetchAll(PDO::FETCH_OBJ);
$suppliers[0] = 'All';
foreach($splrs as $splr){
    $suppliers[] = $splr->supplier;
}
foreach($suppliers as $supplier){
    $selected = "";
    if(!empty($_POST)){
        if($_POST['supplier'] === $supplier){
            $selected = " selected";
        }
    }
    $opts[] = "<option value=\"$supplier\"$selected>$supplier</option>";
}
$suppliers_opts = implode('', $opts);


//getting users
/*
$users = [];
$query = $pdo->query("SELECT * FROM user");
$query->setFetchMode(PDO::FETCH_CLASS, User::class);
$usrs = $query->fetchAll();
foreach($usrs as $usr){
    $users[$usr->getId()] = $usr->getUsername();
}
*/



//data treatement:
if(!empty($_POST)){
    //dd($_POST);
    $min = $_POST['datemin']; $max = $_POST['datemax'];
    $msg = "SELECT * FROM reception WHERE r_date BETWEEN '{$min}' AND '{$max}'";
    
    if($_POST['product_ref'] !== 'All'){
        $msg .= " AND product_ref= {$_POST['product_ref']}";
    }
    if($_POST['supplier'] !== 'All'){
        $msg .= " AND supplier= {$_POST['supplier']}";
    }

    $query = $pdo->query($msg);
    $receptions = $query->fetchAll(PDO::FETCH_CLASS, Reception::class);
    //dd($sales);

}



$today = (new DateTime())->format('Y-m-d');
if($username === 'admin'){
    $columns = ['Quantity', 'Reference', 'Price', 'Date', 'Supplier', 'Details', 'User'];
}else{
    $columns = ['Quantity', 'Reference', 'Price', 'Date', 'Supplier', 'Details'];
}

?>


<h1 class="mt-4">Receptions History:</h1>

<div class="container">
    <div class="form-group mt-4">
        <form action="" method="POST">
            <div class="form-control" style="display:inline">
                    <label for="datemin">select date of start:</label>
                    <input type="date" id="datemin" name="datemin" max="<?=$today?>" required>
                    <label for="datemax">select date of end:</label>
                    <input type="date" id="datemax" name="datemax" max="<?=$today?>" required>  
                    <label for="ref">ID product:</label>
                    <select name="product_ref" id="ref"><?= $options ?></select>
                    <label for="splr">Supplier:</label>
                    <select name="supplier" id="splr"><?= $suppliers_opts ?></select>
            </div>   
                
            <button class="btn btn-primary" type="submit">Confirm</button>
            
        </form>
        
    </div>
</div>

<?php if(!empty($_POST)): ?>
<div class="mt-4">
    <table class="table table-stripped">
        <thead>
            <tr>
                <?php foreach($columns as $column): ?>
                    <th><?= $column ?></th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($receptions as $reception): ?>
                <tr>
                    <?php foreach($columns as $column):
                        $fct = 'get' . $column; 
                        if($column === 'Reference'): ?>
                            <td><?= $reception->getProduct_ref() ?></td>
                        <?php elseif($column === 'Price'): ?>
                            <td><?= $reception->getPurchase_price() === null ? '0.00' : $reception->getPurchase_price() ?> $</td>
                        <?php elseif($column === 'Date'): ?>
                            <td><?= $reception->getR_date() ?></td>
                        <?php elseif($column === 'User'): ?>
                            <td><?= $reception->getUsername() ?></td>  
                        <?php else: ?>
                            <td><?= $reception->$fct() ?></td>
                        <?php endif ?>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php endif ?>