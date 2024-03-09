<?php

use gs\Helpers\Auth;

Auth::check($match['name']);

?>


<div class="container my-4">

    <div class="form-control">
    <div class="row my-4">
        
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title">Sales :</h3>
                        <div class="my-4">
                            <p>
                                <a href= "<?= $root->url('Sell')?>" class="btn btn-success">New Sale</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3 class="card-title">Sales :</h3>
                        <div class="my-4">
                            <p>
                                <a href= "<?= $root->url('Sales_History')?>" class="btn btn-primary">History</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
    </div>    
    </div>
</div>