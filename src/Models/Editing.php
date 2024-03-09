<?php
namespace gs\Models;

class Editing{

    private $id;
    private $object;
    private $property;
    private $details;
    private $user_id;
    private $e_date;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }
 
    public function getProperty(): string
    {
        return $this->property;
    }

    public function setProperty(string $property): self
    {
        $this->property = $property;

        return $this;
    }

    public function getDetails(): string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }
 
    public function getUser_id(): int
    {
        return $this->user_id;
    }

    public function setUser_id(string $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getE_date(): string
    {
        return $this->e_date;
    }

    public function setE_date(string $e_date): self
    {
        $this->e_date = $e_date;

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
}