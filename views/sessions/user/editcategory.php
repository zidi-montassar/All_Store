<?php
use gs\Helpers\{Form, Objects, History, Auth};
use gs\Models\{Category, Product, Admin};
use gs\Table\{Tablecategory, Tableuser};
use gs\Validators\CategoryValidator;
use gs\{Validator, Connection};
//use DateTime;


Auth::check($match['name']);


$pdo = Connection::pdo();

if(isset($_SESSION['user'])){
    $user_id = $_SESSION['user'];
    $table_user = new Tableuser($pdo);
    $username = ($table_user->getOne($user_id))->getUsername(); 
}else{
    $user_id = $_SESSION['admin'];
    $query = $pdo->prepare("SELECT * FROM admin WHERE id= :id");
        $query->execute(['id' => $user_id]);
        $query->setFetchMode(PDO::FETCH_CLASS, Admin::class);
    $username = ($query->fetch())->getAdmin();
}


$c_id = $params['id'];

$table_category = new Tablecategory($pdo);
$category = $table_category->getOne($c_id);

$errors = [];
$success = false;


if(!empty($_POST)){
    $changes = Objects::compare($category, $_POST, ['name']);

    Objects::set($category, $_POST, ['name']);
    $v = new CategoryValidator($_POST, $table_category);
    if($v->validate()){
        $pdo->beginTransaction();
        $table_category->update($category->getName(), $c_id);
        if(is_array($changes)){
            History::editing($pdo, $username, 'category', $changes);
        }
        $success = true;
        $pdo->commit();
    }else{
        $errors[] = $v->errors(); 
    }
}



$form = new Form($category, $errors);

?>

<div class="mt-4">
<h1 style="color:blue">Edit category: <?= $category->getName() ?></h1>

<?php if ($success === true): ?>
        <div class="alert alert-success">Category edited successfully -__-</div>
<?php elseif(!empty($errors)): ?>
        <div class="alert alert-danger">Error!</div>
<?php endif ?>
<?php
$param = null;
?> 
<form action="" method="POST" class="my-4">
    <?=$form->input('name', 'Category name', $param)?>

<button class="btn btn-primary my-2" type="submit">Edit</button>
<a href="<?=$root->url('Home')?>" class="btn btn-danger">cancel</a>
</form>
</div>