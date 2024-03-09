<?php
namespace gs\Validators;
use gs\Table\Tableuser;



class UserValidator extends Validate{

    public function __construct(array $data, Tableuser $table)
    {
        parent::__construct($data);
        $this->v->rule('required', ['username', 'password', 'confirmation_password']);
        $this->v->rule(function ($field, $value,) use ($table){
            return !$table->exist($field, $value);
        }, ['username'], "Content already exists");
        $this->v->rule(function ($field, $value,){
            return $value !== 'All';
        }, ['username'], "Invalid Content! can't be considered as a username");
        $this->v->rule('equals', 'password', 'confirmation_password');
        $this->v->rule('lengthMin', 'username', 3);
        $this->v->rule('lengthMin', 'password', 5);
        
    }

}