<?php

namespace gs\d_t_src;

use Exception;
use PDO;


use PhpParser\Node\Expr\Throw_;

class QueryBuilder{

    private $from;

    private $w;
   
    private $order = [];

    private $l;

    private $o;

    private $p;

    private $ch = ["*"];

    private $params = [];

    private $pdo;


    public function __construct(?PDO $pdo = null)
    {
        $this->pdo= $pdo; 
    }
  

    public function select(...$ch): self
    {
        if(is_array($ch[0])){
            $ch = $ch[0];
        }
        if($this->ch === ["*"]){
            $this->ch = $ch;
        } else {
            $this->ch = array_merge($this->ch, $ch);
        }        
        return $this;
    }
   

    public function from(string $x1, string $x2 = null): self
    {
        $this->from = $x2 === null ? $x1 : "$x1 $x2";
        return $this;
    }


    public function where(string $w): self
    {
        $this->w = $w;
        return $this;
    }

    public function setParam(string $param, $value): self
    {
        $this->params[$param] = $value;
        return $this;
    }


    public function orderBy(string $y1, string $y2): self
    {
        $y2 = strtoupper ($y2);
        if (in_array($y2, ['ASC', 'DESC'])){
            $this->order[] = "$y1 $y2";
        }else{
            $this->order[] = $y1;
        }
        return $this;
    }


    public function limit(int $l): self
    {
        $this->l = $l;
        return $this;
    }

    public function offset(int $o): self
    {
        if($this->l === null){
            throw new Exception("Impossible d'avoir un offset sans preciser une limite");
        }
        $this->o = $o;
        return $this;
    }

    public function page(int $p): self
    {
        $this->p = $p;
        return $this;
    }

    public function toSQL(): string
    {
            $k = implode(', ', $this->ch); 
            $msg = "SELECT $k FROM {$this->from}";
        
        if($this->w){
            $msg .= " WHERE " . $this->w;
        }
        if(!empty($this->order)){
            $msg .= " ORDER BY " . implode(', ', $this->order);
        }
        if($this->l > 0){
            $msg .= " LIMIT {$this->l}";
        }
        if($this->o !== null){
            $msg .= " OFFSET {$this->o}";
        }else if(!empty($this->p)){
            $v = ($this->p * $this->l) - $this->l;
            $msg .= " OFFSET $v";
        }
        return $msg;
    }

    public function fetch(string $column): ? string
    {
        $query= $this->pdo->prepare($this->toSQL());
        $query->execute($this->params);
        $result = $query->fetch();
        if($result === false){
            return null;
        } else {
            return $result[$column] ?? null;
        }
    }

    public function fetchAll(?string $className = null): array
    {
        try {
            $query= $this->pdo->prepare($this->toSQL());
        $query->execute($this->params);
        return $query->fetchAll(PDO::FETCH_CLASS, $className);
        } catch (Exception $e) {
            throw new Exception ("Impossible d'effectuer la requete " . $this->toSQL() . ":" . $e->getMessage());
        }       
    }

    public function count(): int
    {
        return (int)(clone $this)->select('COUNT(id) count')->fetch('count');
    }
    
}