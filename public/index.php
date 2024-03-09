<?php 

use gs\Router;

require '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$rooter = new gs\Router(dirname(__DIR__) . '/views');

$rooter
    //listings
    ->get('/', 'products/index', 'Home')
    ->get('/categories', 'categories/index', 'Categories')
    ->both('/login', 'auth/login', 'Login')
    ->both('/logout', 'auth/logout', 'Logout')
    //shoW
    ->get('/show-product/[*:slug][i:id]', 'products/show', 'Show_Product')
    ->get('/show-category/[*:slug][i:id]', 'categories/show', 'Show_Category')
    //User
    ->both('/newproduct', 'sessions/user/newproduct', 'New_Product')
    ->both('/newcategory', 'sessions/user/newcategory', 'New_Category')
    ->both('/editproduct/[*:slug][i:id]', 'sessions/user/editproduct', 'Edit_Product')
    ->both('/editcategory/[*:slug]id-[i:id]', 'sessions/user/editcategory', 'Edit_Category')
    ->both('/deleteproduct/[i:id]', 'sessions/user/deleteproduct', 'Delete_Product')
    //->both('/deletecategory/[i:id]', 'sessions/user/deletecategory', 'Delete_Category')
    ->both('/inventory', 'sessions/user/inventory', 'Inventory')
    ->both('/saleshistory', 'sessions/user/saleshistory', 'Sales_History')
    ->both('/receptionshistory', 'sessions/user/receptionshistory', 'Receptions_History')
    ->both('/recieve', 'receptions/reception', 'Recieve')
    ->both('/receptions', 'receptions/index', 'Receptions')
    ->both('/sell', 'Sales/sale', 'Sell')
    ->both('/sales', 'sales/index', 'Sales')
    //admin
    ->both('/admin', 'sessions/admin/index', 'Admin')
    ->both('/admin/history', 'sessions/admin/history', 'History')
    ->both('/admin/users', 'sessions/admin/users', 'Users')
    ->both('/admin/deleteuser/[i:id]', 'sessions/admin/deleteuser', 'Delete_User')
    ->both('/admin/createuser', 'sessions/admin/createuser', 'Create_User')
    ->run();