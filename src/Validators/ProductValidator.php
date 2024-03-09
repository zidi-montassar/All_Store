<?php
namespace gs\Validators;

use gs\Table\Tableproduct;
use gs\Validators\Validate;

final class ProductValidator extends Validate{

    

    public function __construct(array $data, Tableproduct $table, array $categories, ?int $product_id=null)
    {
        parent::__construct($data);
        $this->v->rule('required', ['ref', 'name', 'category', 'quantity', 'a_quantity']);
        $this->v->rule('integer', ['quantity', 'a_quantity', 'reg_temp']);
        $this->v->rule('min', 'a_quantity', 1);
        $this->v->rule('subset', 'category', $categories);
        $this->v->rule('dateFormat', 'validity_date', 'd-m-Y');
        $this->v->rule(function ($field, $value,) use ($table, $product_id){
            return !$table->exist($field, $value, $product_id);
        }, ['ref', 'name'], "Content already exists");
        $this->v->rule(function ($field, $value,){
            return is_numeric($value);
        }, ['purchase_price', 'retail_price', 'wholesale_price'], "must be numeric");  
    }

}