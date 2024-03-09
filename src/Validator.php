<?php
namespace gs;

use Valitron\Validator as valval;

class Validator extends valval{
    
    protected function checkAndSetLabel($field, $message, $params)
    {
        return str_replace('{field}', '', $message);
    }
}