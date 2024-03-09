<?php
use gs\Helpers\{Form, Objects, History, Auth};
use gs\Models\{Category, Product, Admin};
use gs\Table\{Tablecategory, Tableuser};
use gs\Validators\CategoryValidator;
use gs\{Validator, Connection};



Auth::check($match['name']);

$pdo = Connection::pdo();

if(isset($_SESSION['user'])){
    $user_id = $_SESSION['user'];
    $table_user = new Tableuser($pdo);
    //$username = ($table_user->getOne($user_id))->getUsername(); 
}else{
    //dd($_SESSION);
    $user_id = $_SESSION['admin'];
    $query = $pdo->prepare("SELECT * FROM admin WHERE admin= :id");
        $query->execute(['id' => $user_id]);
        $query->setFetchMode(PDO::FETCH_CLASS, Admin::class);
        //dd($query->fetch());
    $username = ($query->fetch())->getAdmin();
}



$category = new Category();

$errors = [];
$success = false;

if(!empty($_POST)){
    Objects::set($category, $_POST, ['name']);
    $pdo = Connection::pdo();
    $table_category = new Tablecategory($pdo);
    $v = new CategoryValidator($_POST, $table_category);
    if($v->validate()){
        $pdo->beginTransaction();
        $table_category->create($category->getName());
        History::adding($pdo, $user_id, 'Category: ' . $category->getName());
        $success = true;
        $pdo->commit();
    }else{
        $errors[] = $v->errors(); 
    }
}



$form = new Form($category, $errors);

?>


<h1 style="color:blue">Add New Category</h1>

<?php if ($success === true): ?>
        <div class="alert alert-success">Category created successfully -__-</div>
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
    <?=$form->input('name', 'Category name', $param)?>

<button class="btn btn-primary my-2" type="submit">Save</button>
<a href="<?=$root->url('Home')?>" class="btn btn-danger">cancel</a>
</form>
</div>