<?php
namespace gs\Validators;

use gs\Table\Tableproduct;

class SaleValidator extends Validate{

    public function __construct(array $data, Tableproduct $table, string $product_ref)
    {
        parent::__construct($data);
        $this->v->rule('required', ['product_ref', 'quantity']);
        $this->v->rule('integer', 'quantity');
        $this->v->rule(function ($field, $value,) use ($table, $product_ref){
            return !$table->verifyQuantity($field, $value, $product_ref);
        }, ['quantity'], "depassed available quantity value");
        $this->v->rule(function ($field, $value,){
            return !is_float($value);
        }, ['retail_price', 'wholesale_price'], "must be numeric"); 
    }

}