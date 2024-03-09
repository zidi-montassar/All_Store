<?php

namespace gs\Models;

use DateTime;

class Sale{

    private $id;
    private $costumer;		
    private $product_ref;	
    private $quantity;		
    private $price;
    private $type;		
    private $details;
    private $username;		
    private $s_date;
    
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCostumer(): ?string
    {
        return $this->costumer;
    }

    public function setCostumer(?string $costumer): self
    {
        $this->costumer = $costumer;

        return $this;
    }
    
    public function getProduct_ref(): ?string
    {
        return $this->product_ref;
    }

    public function setProduct_ref(?string $product_ref): self
    {
        $this->product_ref = $product_ref;

        return $this;
    }

    public function getQuantity(): mixed
    {
        return $this->quantity;
    }

    public function setQuantity(mixed $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
 
    public function getPrice(): mixed
    {
        return $this->price;
    }

    public function setPrice(mixed $price): self
    {
        $this->price = $price;

        return $this;
    }


    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

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

    
    public function getS_date(): ?string
    {
        return $this->s_date;
    }

    public function setS_date(?string $s_date): self
    {
        $this->s_date = $s_date;

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
}