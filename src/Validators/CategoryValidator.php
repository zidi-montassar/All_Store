<?php
namespace gs\Validators;

use gs\Table\Tablecategory;
use gs\Validators\Validate;

final class CategoryValidator extends Validate{

    

    public function __construct(array $data, Tablecategory $table, ?int $category_id = null)
    {
        parent::__construct($data);
        $this->v->rule('required', ['name']);
        $this->v->rule(function ($field, $value,) use ($table, $category_id){
            return !$table->exist($field, $value, $category_id);
        }, ['name'], "content already exists");
        
    }

}