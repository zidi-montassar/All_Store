<?php

namespace gs\Table;
use gs\Models\Reception;
use DateTime;

class Tablereception extends Table{

    protected $name = 'reception';
    protected $class_name = Reception::class;


    public function new (Reception $reception)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->name} SET product_ref= :product_ref, quantity= :quantity, purchase_price= :purchase_price, supplier= :supplier, details= :details, r_date= :r_date, username= :username");
        $query->execute([
            'product_ref' => $reception->getProduct_ref(),
            'quantity' => $reception->getQuantity(),
            'purchase_price' => $reception->getPurchase_price(),
            'supplier' => $reception->getSupplier(),
            'details' => $reception->getDetails(),
            'r_date' => (new DateTime())->format('Y-m-d H:m:s'),
            'username' => $reception->getUsername()
        ]);
    }

    
    
}