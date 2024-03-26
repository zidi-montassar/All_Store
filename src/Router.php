<?php

namespace gs;

use AltoRouter;
use app\Security\ForbiddenException;
use gs\exceptions\ForbiddenException as ExceptionsForbiddenException;
use PhpParser\Node\Stmt\TryCatch;

class Router {

    /**
     * @var string
     */
    private $views_path;

    /**
     * @var AltoRouter
     */
    private $root;


    public function __construct(string $views_path)
    {
        $this->views_path = $views_path;
        $this->root = new AltoRouter();        
    }

    public function get(string $url, string $directory, ?string $name = null): self
    {
        $this->root->map('GET', $url, $directory, $name);
        
        return $this;
    }

    public function post(string $url, string $directory, ?string $name = null): self
    {
        $this->root->map('POST', $url, $directory, $name);
        
        return $this;
    }

    public function both(string $url, string $directory, ?string $name = null): self
    {
        $this->root->map('POST|GET', $url, $directory, $name);
        
        return $this;
    }

    public function run(): self
    {   
        $match = $this->root->match();
        //dd($match);
        $params = $match['params'];
        $target = $match['target'] ?: "e404";
        $root = $this;
        $pagetitle = $match['name'];
        //var_dump($match);
        try{
            ob_start();
            require $this->views_path . DIRECTORY_SEPARATOR . $target . '.php';
            $require = ob_get_clean();
            require $this->views_path . DIRECTORY_SEPARATOR . 'elements/layouts.php';
        }catch(ExceptionsForbiddenException $e){
            $msg = $e->getMessage();
            header('Location: ' . $this->url('Login') . '?previous=' . $msg);
            exit();
        }
      
        return $this;
    }

    public function url(string $root_name, array $params=[]): ?string
    {
        return $this->root->generate($root_name, $params);
    }

}