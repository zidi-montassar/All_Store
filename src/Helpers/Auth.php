<?php

namespace gs\Helpers;

use gs\exceptions\ForbiddenException;

class Auth {


    public static function check(?string $msg)
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
            throw new ForbiddenException($msg);            
        }
    }

    public static function admincheck(?string $msg)
    {
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if(!isset($_SESSION['admin'])){
            throw new ForbiddenException($msg);            
        }
    }
}