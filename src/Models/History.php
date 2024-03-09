<?php

namespace gs\Models;

class History{

    private $id;
    private $object;
    private $property;
    private $details;
    private $username;
    private $a_date;
    private $e_date;
    private $d_date;

    

    
    public function getId(): ?int
    {
        return $this->id;
    }
 
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    
    public function getObject(): ?string
    {
        return $this->object;
    }

    
    public function setObject(?string $object): self
    {
        $this->object = $object;

        return $this;
    }

   
    public function getProperty(): ?string
    {
        return $this->property;
    }


    public function setProperty(?string $property): self
    {
        $this->property = $property;

        return $this;
    }

   
    public function getUsername(): ?string
    {
        return $this->username;
    }

    
    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    
    public function getDetails(): ?string
    {
        return $this->details;
    }

    
    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    
    public function getA_date(): ?string
    {
        return $this->a_date;
    }

     
    public function setA_date(?string $a_date): self
    {
        $this->a_date = $a_date;

        return $this;
    }

    
    public function getE_date(): ?string
    {
        return $this->e_date;
    }

   
    public function setE_date(?string $e_date): self
    {
        $this->e_date = $e_date;

        return $this;
    }

    
    public function getD_date(): ?string
    {
        return $this->d_date;
    }

     
    public function setD_date(?string $d_date): self
    {
        $this->d_date = $d_date;

        return $this;
    }
}