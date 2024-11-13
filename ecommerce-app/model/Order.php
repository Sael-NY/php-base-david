<?php


class Order
{
    private $id;
    private $customerName;
    private $status;
    private $totalPrice;
    private $products = [];
    private $shippingAddress;

    public function __construct($customerName)
    {   
        if (mb_strlen($customerName) < 3) {
            throw new Exception('Merci de remplir un nom correct');
        }
        $this->status = 'cart';
        $this->totalPrice = 0;
        $this->customerName = $customerName;
        $this->id = uniqid();
    }

    public function addProduct()
    {
        if ($this->status === "cart") {
            $this->products[] = "Pringles";
            $this->totalPrice += 3;
        }
    }

    public function removeProduct()
    {
        if ($this->status === "cart" && !empty($this->products)) {
            array_pop($this->products);
            $this->totalPrice -= 3;
        }
    }

    public function setShippingAddress($shippingAddress)
    {
        if ($this->status === "cart") {
            $this->shippingAddress = $shippingAddress;
            $this->status === "shippingAddressSet";
        }
    }

    public function pay()
    {
        if ($this->status === "shippingAddressSet" && !empty($this->products)) {
            $this->status = "paid";
        } else {
            throw new Exception('Vous ne pouvez pas payer, merci de remplir votre adresse d\'abord');
        }

    }

    // private or public


    public function ship()
    {
        if ($this->status === 'paid') {
            $this->status = "shipped";
        } else {
            throw new Exception("La commande ne peux pas être expédiée. elle n'est pas encore payée");
        }
    }

    public function getId() {
        return $this -> id;
    }
    
    public function getProducts() {
       return $this -> products;
    }

    public function getTotalPrice() {
        return $this -> totalPrice;
    }

    public function getAddress() {
        return $this -> shippingAdress;
    }
}