<?php

class Order {
    public $id;
    public $customName;
    public $status = "cart";
    public $totalPrice;
    public $products = [];
    public $address;

    public function __construct($customName, $address) {
        {
            $this -> customName = $customName;
            $this -> $address = $address;
            $this -> id = uniqid();
        }
    }



    public function __construct($customName) {
        $this -> customName = $customName;
        $this -> id = uniqid();
    }
    

    // J'ajoute un produit avec le prix
    public function addProduct() {
        if ($this -> status === "card") {
            $this -> products []= "Pringles";
            $this -> totalPrice += 3;
        }
    }

    // J'ajoute le mode de paiement
    public function pay() {
        if ($this -> status === "card") {
            $this -> status = "paid";
        }
    }

    // Je supprime mon produit
    public function deleteProduct() {
        if ($this -> status === "card") {
            array_pop($this->products);
            $this -> totalPrice = -3;
        }
    }
}

$order1 = new Order("Salim");
$order1 -> addProduct();
$order1 -> addProduct();
$order1 -> addProduct();
$order1 -> pay();

$order2 = new Order("Timal");
$order2->addProduct();
$order2 -> pay();


var_dump($order1);
