<?php
namespace gs\Models;

class Addition{


    private $id;
    private $object;
    private $user_id;
    private $details;
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

    public function getUser_id(): ?int
    {
        return $this->user_id;
    }

     
    public function setUser_id(?int $user_id): self
    {
        $this->user_id = $user_id;

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
