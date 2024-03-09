<?php

namespace gs\Table;

use gs\Models\Sale;
use DateTime;

class Tablesale extends Table{

    protected $name = 'sale';
    protected $class_name = Sale::class;



    public function new (Sale $sale)
    {
        $query = $this->pdo->prepare("INSERT INTO {$this->name} SET costumer= :costumer, product_ref= :product_ref, quantity= :quantity, price= :price, type= :type, details= :details, username= :username, s_date= :s_date");
        $query->execute([
            'costumer' => $sale->getCostumer(),
            'product_ref' => $sale->getProduct_ref(),
            'quantity' => $sale->getQuantity(),
            'price' => $sale->getPrice(),
            'type' => $sale->getType(),
            'details' => $sale->getDetails(),
            'username' => $sale->getUsername(),
            's_date' => (new DateTime())->format('Y-m-d')
        ]);
    }

}