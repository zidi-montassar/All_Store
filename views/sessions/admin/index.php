<?php

use gs\Helpers\Auth;


Auth::admincheck($match['name']);



$tasks = ['History', 'Users']




?>

<div class="container my-4">
    <h1>Admin space</h1>


    <div class="row my-4">
        
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title">History</h4>
                        <div class="my-4s">
                            <p>
                                <a href= "<?= $root->url('History')?>" class="btn btn-primary">Consult</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4 class="card-title">Users</h4>
                        <div class="my-4s">
                            <p>
                                <a href= "<?= $root->url('Users')?>" class="btn btn-primary">Consult</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</div>