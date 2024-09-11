<?php

use gs\Helpers\Auth;


Auth::admincheck($match['name']);



$tasks = ['History', 'Users']




?>

<div class="container mt-5">
    <h1 style="color: white;">Admin space</h1>


    <div class="row mt-5">
        
            <div class="col-md-3">
                <div class="card mb-3" style="background: transparent; border-width: 2em;">
                    <div class="card-body">
                        <h4 class="card-title" style="color: white;">History</h4>
                        <div class="my-4s">
                            <p class="mt-3">
                                <a href= "<?= $root->url('History')?>" class="btn btn-primary">Consult</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3" style="background: transparent; border-width: 2em;">
                    <div class="card-body">
                        <h4 class="card-title" style="color: white;">Users</h4>
                        <div class="my-4s">
                            <p class="mt-3">
                                <a href= "<?= $root->url('Users')?>" class="btn btn-primary">Consult</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</div>