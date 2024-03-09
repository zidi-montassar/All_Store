<?php

namespace gs\Models;

use DateTime;

class Product{

    private $id;		
    private $ref;	
    private $name;	
    private $slug;		
    private $description;	
    private $brand;		
    private $category;		
    private $supplier;		
    private $quantity;		
    private $a_quantity;		
    private $purchase_price;		
    private $retail_price;		
    private $wholesale_price;		
    private $validity_date;	
    private $reg_temp;	
    private $details;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }
 
    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(?string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }
 
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description=null): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand=null): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }
 
    public function getSupplier(): ?string
    {
        return $this->supplier;
    }

    public function setSupplier(?string $supplier=null): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity=null): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getA_quantity(): ?int
    {
        return $this->a_quantity;
    }

    public function setA_quantity(?int $a_quantity): self
    {
        $this->a_quantity = $a_quantity;

        return $this;
    }

    public function getPurchase_price(): mixed
    {
        return $this->purchase_price;
    }
 
    public function setPurchase_price(mixed $purchase_price=null): self
    {
        $this->purchase_price = $purchase_price;

        return $this;
    }
 
    public function getRetail_price(): mixed
    {
        return $this->retail_price;
    }
 
    public function setRetail_price(mixed $retail_price=null): self
    {
        $this->retail_price = $retail_price;

        return $this;
    }

    public function getWholesale_price(): mixed
    {
        return $this->wholesale_price;
    }

    public function setWholesale_price(mixed $wholesale_price=null): self
    {
        $this->wholesale_price = $wholesale_price;

        return $this;
    }
 
    public function getValidity_date(): ?string
    {
        return $this->validity_date;
    }
 
    public function setValidity_date(?string $validity_date=null): self
    {
        $this->validity_date = $validity_date;
     
        return $this;
    }

    public function getReg_temp(): ?int
    {
        return $this->reg_temp;
    }

    public function setReg_temp(?int $reg_temp=null): self
    {
        $this->reg_temp = $reg_temp;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }
 
    public function setDetails(?string $details=null): self
    {
        $this->details = $details;

        return $this;
    }
}