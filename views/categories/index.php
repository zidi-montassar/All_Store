<?php

use gs\Models\Category;
use gs\Table\Tablecategory;
use gs\Connection;

$pdo = Connection::pdo();
$table_category = new Tablecategory($pdo);
/**
 * @var Category[]
 */
$categories = $table_category->getAll();





?>

<div class="container mt-5">
    <h1 style="color:white;">Categories</h1>

    <?php if(isset($_GET['delete'])): ?>
        <div class="alert alert-success mt-4">Category deleted successfully!</div>
    <?php endif ?>

    <div class="row mt-5">
        <?php foreach($categories as $category) : ?>
            <div class="col-md-3">
                <div class="card mb-3" style="background: transparent; border-width: 2em;">
                    <div class="card-body" style="">
                        <h5 class="card-title" style="font-size: 22px;"><strong><?= $category->getName() ?></strong></h5>
                        <div class="my-4s">
                            <p>
                                <a href= "<?= $root->url('Show_Category', ['id' => $category->getId(), 'slug' => $category->getSlug()])?>" class="btn btn-primary">Open</a>
                                <?php if(isset($_SESSION['user']) || isset($_SESSION['admin'])): ?>
                                    <a href= "<?= $root->url('Edit_Category', ['id' => $category->getId(), 'slug' => $category->getSlug()])?>" class="btn btn-success">Edit</a>
                                <?php endif ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>