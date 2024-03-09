<?php
namespace gs\Helpers;

class Form {

    private $data;
    private $errors;

    public function __construct($data, array $errors)
    {
        $this->data = $data;
        $this->errors = $errors;
    }

    public function input(string $key, string $label, ?int $val=null): string
    {
        if(($key === 'password') || ($key === 'confirmation password')){
            $type = 'password';
        }elseif(in_array($key, ['quantity', 'a_quantity', 'reg_temp'])){
            $type = 'number';
        }else{
            $type = 'text';
        }
        [$class, $invalid_feedback] = $this->getClass($key);
        $value = null;
        if($val === null){
            $value = $this->getvalue($key);
        }    
                return <<<HTML
                        <div class="form-group ">
                            <label for="field {$key}"><h4>{$label}</h4></label>
                            <input type="{$type}" id="field {$key}" class="{$class}" name="{$key}" value="{$value}">
                            {$invalid_feedback}
                        </div>
HTML;
    }

    private function getClass(string $key)
    {
        $class = 'form-control';
        $invalid_feedback = '';
        if(isset($this->errors[0][$key])){
            if(is_array($this->errors[0][$key])){
                $invalid_feedback = '<div class="invalid-feedback">' . implode('<br>', $this->errors[0][$key]) . '</div>';
            }else{
                $invalid_feedback = '<div class="invalid-feedback">' . $this->errors[0][$key] . '</div>';
            }
            $class .= ' is-invalid';
        }elseif(isset($this->errors[$key])){
                $class .= ' is-invalid';
                if(is_array($this->errors[$key])){
                    $invalid_feedback = '<div class="invalid-feedback">' . implode('<br>', $this->errors[$key]) . '</div>';
                }else{
                    $invalid_feedback = '<div class="invalid-feedback">' . $this->errors[$key] . '</div>';
                }
        }
        return [$class, $invalid_feedback];
    }

    private function getvalue(string $key): mixed
    {
        if(is_array($this->data)){
            return $this->data[$key];
        }
        
        $value_name = 'get' . ucfirst($key);
        return $this->data->$value_name();
    }

    public function textarea(string $key, string $label, ?int $val=null)
    {
        [$class, $invalid_feedback] = $this->getClass($key);
        $value = null;
        if($val === null){
            $value = $this->getvalue($key);
        }
                return <<<HTML
                        <div class="form-group ">
                            <label for="field {$key}"><h4>{$label}</h4></label>
                            <textarea type="text" id="field {$key}" class="{$class}" name="{$key}">{$value}</textarea>
                            {$invalid_feedback}
                        </div>
HTML;   
    }

    public function select($key, string $label,string $msg, mixed $options): string
    {
        [$class, $invalid_feedback] = $this->getClass($key);

        $val = $this->getvalue($key);
        $opt = [];
        if($options === null){
            $opt[] = "<option value=''>No Categories</option>";
        }else{
            foreach($options as $option){
                $selected = $option === $val ? " selected" : "";
                $opt[] = "<option value=\"$option\"$selected>$option</option>";
            }
        }
        
        $opt = implode('', $opt);
            return <<<HTML
                        <div class="form-group ">
                            <label for="field {$key}"><h4>{$label}</h4></label>
                            <select id="field {$key}" class="{$class}" name="{$key}[]" required><option value="">{$msg}</option>{$opt}</select>
                            {$invalid_feedback}
                        </div>
HTML;
    }
}