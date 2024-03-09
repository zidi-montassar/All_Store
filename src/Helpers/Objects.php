<?php
namespace gs\Helpers;
use app\Models\{Category, Post};

class Objects{


    public static function set(Object $object, array $data, array $properties): void
    {
        foreach($properties as $property){
            $function = 'set' . ucfirst($property);
            if(is_array($data["$property"])){
                $object->$function($data["$property"][0]);
            }elseif($data["$property"] === ""){
                $object->$function(null);
            }else{
                $object->$function($data["$property"]);
            }
        }
    }

    public static function compare(Object $object, array $data, array $properties): bool|array
    {
        $changes = [];
        foreach($properties as $property){
            
            $function = 'get' . ucfirst($property);
            $old_value = $object->$function();   
            if(is_array($data["$property"])){
                $new_value = $data["$property"][0];
            }elseif($data["$property"] === ""){
                $new_value = null;
            }else{
                $new_value = $data["$property"];
            }
            
            if($new_value <> $old_value){
                $changes[$property] = "Changed from:  '{$old_value}'  into  '{$new_value}'";
            }
        }

        if(!empty($changes)){
            return $changes;
        }else{
            return false;
        }
    }


}