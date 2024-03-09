<?php

namespace gs\Table;

use Exception;
use gs\Models\Product;

class Tableproduct extends Table{

    protected $name = 'product';
    protected $class_name = Product::class;

    public function create(Product $product)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->name} SET
        ref= :ref, name= :name, slug= :slug,
        description= :description, brand= :brand, category= :category,
        supplier= :supplier, quantity= :quantity, a_quantity= :a_quantity,
        purchase_price= :purchase_price, retail_price= :retail_price, wholesale_price= :wholesale_price,
        validity_date= :validity_date, reg_temp= :reg_temp, details= :details");

        $reg_temp = null;
        if($product->getReg_temp() !== ""){
            $reg_temp = $product->getReg_temp();
        }
        $query->execute([
            'ref' => $product->getRef(), 'name' => $product->getName(), 'slug' => $this->createSlug($product->getName()),
            'description' => $product->getDescription(), 'brand' => $product->getBrand(), 'category' => $product->getCategory(),
            'supplier' => $product->getSupplier(), 'quantity' => $product->getQuantity(), 'a_quantity' => $product->getA_quantity(),
            'purchase_price' => $product->getPurchase_price(), 'retail_price' => $product->getRetail_price(), 'wholesale_price' => $product->getWholesale_price(),
            'validity_date' => $product->getValidity_date(), 'reg_temp' => $reg_temp, 'details' => $product->getDetails()
        ]);
    }


    public function update(Product $product, int $p_id)
    {
        $query = $this->pdo->prepare("UPDATE {$this->name} SET
        ref= :ref, name= :name, slug= :slug,
        description= :description, brand= :brand, category= :category,
        supplier= :supplier, quantity= :quantity, a_quantity= :a_quantity,
        purchase_price= :purchase_price, retail_price= :retail_price, wholesale_price= :wholesale_price,
        validity_date= :validity_date, reg_temp= :reg_temp, details= :details WHERE id= :id");

        $reg_temp = null;
        if($product->getReg_temp() !== ""){
            $reg_temp = $product->getReg_temp();
        }
        $query->execute([
            'ref' => $product->getRef(), 'name' => $product->getName(), 'slug' => $this->createSlug($product->getName()),
            'description' => $product->getDescription(), 'brand' => $product->getBrand(), 'category' => $product->getCategory(),
            'supplier' => $product->getSupplier(), 'quantity' => $product->getQuantity(), 'a_quantity' => $product->getA_quantity(),
            'purchase_price' => $product->getPurchase_price(), 'retail_price' => $product->getRetail_price(), 'wholesale_price' => $product->getWholesale_price(),
            'validity_date' => $product->getValidity_date(), 'reg_temp' => $reg_temp, 'details' => $product->getDetails(), 'id' => $p_id
        ]);
    }

    public function delete(int $product_id): bool
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->name} WHERE id= ?");
        $result = $query->execute([$product_id]);
        if($result === false){
            throw new Exception('can not delete this item');
        }else{
           return true;
        }
    }

    private function getOldQuantity(string $ref): ?int
    {
        $query = $this->pdo->query("SELECT quantity FROM {$this->name} WHERE ref= $ref");
        return $query->fetch()[0];
    }

    public function verifyQuantity(string $field, $value, string $ref): bool
    {
        $old_quantity = $this->getOldQuantity($ref);
        return $value > $old_quantity;
    }

    public function recieve(string $ref, int $quantity)
    {
        $q = $this->getOldQuantity($ref) + $quantity;
        $this->pdo->exec("UPDATE {$this->name} SET quantity= $q WHERE ref= '{$ref}'");
    }

    public function sell(string $ref, int $quantity)
    {
        $q = $this->getOldQuantity($ref) - $quantity;
        $this->pdo->exec("UPDATE {$this->name} SET quantity= $q WHERE ref= '{$ref}'");
    }

    public function getProductName(string $ref): string
    {
        $query = $this->pdo->query("SELECT name FROM {$this->name} WHERE ref= {$ref}");
        return ($query->fetch())[0];
    }

}