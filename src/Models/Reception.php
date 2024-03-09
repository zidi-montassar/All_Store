<?php

namespace gs\Models;

use DateTime;

class Reception{

    private $id;		
    private $product_ref;	
    private $quantity;		
    private $purchase_price;		
    private $supplier;		
    private $details;		
    private $r_date;
    private $username;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPurchase_price(): ?int
    {
        return $this->purchase_price;
    }
 
    public function setPurchase_price(?int $purchase_price): self
    {
        $this->purchase_price = $purchase_price;

        return $this;
    }

    public function getSupplier(): ?string
    {
        return $this->supplier;
    }

    public function setSupplier(?string $supplier): self
    {
        $this->supplier = $supplier;

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

    public function getR_date(): string
    {
        return $this->r_date;
    }

    public function setR_date(string $r_date): self
    {
        $this->r_date = $r_date;

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