<?php
namespace gs\Models;

class Admin{

    private $id;
    private $admin;
    private $password;

    

   
    public function getId(): ?int
    {
        return $this->id;
    }

  
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    
    public function getAdmin(): ?string
    {
        //dd($this->admin);
        return $this->admin;
    }

   
    public function setAdmin(?string $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    
    public function getPassword(): ?string
    {
        return $this->password;
    }

   
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }
}