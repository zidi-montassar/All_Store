<?php
namespace gs\Validators;


class ReceptionValidator extends Validate{

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->v->rule('required', ['product_ref', 'quantity']);
        $this->v->rule('integer', 'quantity');
        $this->v->rule(function ($field, $value,){
            return !is_float($value);
        }, ['purchase_price'], "must be numeric"); 
    }

}