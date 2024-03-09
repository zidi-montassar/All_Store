<?php
use gs\Models\Sale;
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

//getting costumers:
$costumers = [];
$opts = [];
$query = $pdo->query("SELECT costumer FROM costumer");
$cstmrs = $query->fetchAll(PDO::FETCH_OBJ);
$costumers[0] = 'All';
foreach($cstmrs as $cstmr){
    $costumers[] = $cstmr->costumer;
}
foreach($costumers as $costumer){
    $selected = "";
    if(!empty($_POST)){
        if($_POST['costumer'] === $costumer){
            $selected = " selected";
        }
    }
    $opts[] = "<option value=\"$costumer\"$selected>$costumer</option>";
}
$costumers_opts = implode('', $opts);



//data treatement:
if(!empty($_POST)){
    //dd($_POST);
    $min = $_POST['datemin']; $max = $_POST['datemax'];
    $msg = "SELECT * FROM sale WHERE s_date BETWEEN '{$min}' AND '{$max}'";
    
    if($_POST['product_ref'] !== 'All'){
        $msg .= " AND product_ref= {$_POST['product_ref']}";
    }
    if($_POST['costumer'] !== 'All'){
        $msg .= " AND costumer= {$_POST['costumer']}";
    }

    $query = $pdo->query($msg);
    $sales = $query->fetchAll(PDO::FETCH_CLASS, Sale::class);
    //dd($sales);

}



$today = (new DateTime())->format('Y-m-d');

if($username === 'admin'){
    $columns = ['Quantity', 'Reference', 'Type', 'Price', 'Date', 'Costumer', 'Details', 'User'];
}else{
    $columns = ['Quantity', 'Reference', 'Type', 'Price', 'Date', 'Costumer', 'Details'];
}


?>


<h1 class="mt-2">Sales History:</h1>

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
                    <label for="cstmr">Costumer:</label>
                    <select name="costumer" id="cstmr"><?= $costumers_opts ?></select>
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
            <?php foreach($sales as $sale): ?>
                <tr>
                    <?php foreach($columns as $column):
                        $fct = 'get' . $column; 
                        if($column === 'Reference'): ?>
                            <td><?= $sale->getProduct_ref() ?></td>
                        <?php elseif($column === 'Price'): ?>
                            <td><?= $sale->$fct() === null ? '0.00' : $sale->$fct() ?> $</td>
                        <?php elseif($column === 'Date'): ?>
                            <td><?= $sale->getS_date() ?></td>
                        <?php elseif($column === 'User'): ?>
                            <td><?= $sale->getUsername() ?></td>    
                        <?php else: ?>
                            <td><?= $sale->$fct() ?></td>
                        <?php endif ?>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php endif ?>