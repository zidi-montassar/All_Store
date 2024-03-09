<?php

namespace gs\d_t_src;

class NumberHelper 

    {
       public static function price (?float $x): string

            {
                if($x !== null){
                    return number_format($x, 2, '.', ' ') . " $" ;
                }else{
                    return "0.00 $";
                }
                
            }


        
    }