<?php

class Order {
    public $id;
    public $customName;
    public $status = "cart";
    public $totalPrice;
    public $products = [];
    public $delete = 

    public function addProduct() {
        if ($this -> status === "card") {
            $this -> products []= "Pringles";
            $this -> totalPrice += 3;
        }
    }

    public function pay() {
        if ($this -> status === "card") {
            $this -> status = "paid";
        }
    }

    public function deleteProduct() {
        if ($this -> status === "card") {
            array_pop($this->products);
            $this -> totalPrice = -3
        }
    }
}

$order1 = newOrder();
$order1 -> addProduct();
$order1 -> addProduct();
$order1 -> addProduct();
$order1 -> pay();

var_dump($order1);
