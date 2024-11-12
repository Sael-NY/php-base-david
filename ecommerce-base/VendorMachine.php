<?php

class VendorMachine
{
    public $snacks;

    public $cashAmount;

    public $isOn;

    public function __construct() {
        $this->isOn = true;
        $this->cashAmount = 0.00;
        $this->snacks = [
            [
                "name" => "Snickers",
                "price" => 1,
                "quantity" => 5
            ],
            [
                "name" => "Mars",
                "price" => 1.5,
                "quantity" => 5
            ],
            [
                "name" => "Twix",
                "price" => 2,
                "quantity" => 5
            ],
            [
                "name" => "Bounty",
                "price" => 2.5,
                "quantity" => 5
            ]
        ];

    }

    public function turnOn() {
        $this->isOn = true;
    }

    public function turnOff() {
        $currentDate = new DateTime();
        $currentHour = $currentDate->format('H');

       if ($currentHour >= 10) {
           $this->isOn = false;
       } else {
           throw new Exception('Vous ne pouvez pas éteindre la machine avant 18h');
       }
    }

    public function buySnack($selectedSnack) {
        if ($this->isOn) {

            // on initialise une variable "flag" à false
            $snackFound = false;

            foreach ($this->snacks as $index => $snack) {
                if ($snack['name'] === $selectedSnack) {

                    if ($snack['quantity'] > 0) {
                        $this->cashAmount += $snack['price'];
                        $this->removeSnackQuantity($index);
                    } else {
                        throw new Exception('snack trouvé mais pas de quantité suffisante');
                    }
                    // si le snack a été trouvé dans la boucle,
                    // on modifie la variable "flag"
                    $snackFound = true;
                    break;
                }

            }

            // après la boucle, on regarde la valeur de
            // la variable flag
            // et on lance une exception si le snack n'a pas été trouvé
            if (!$snackFound) {
                throw new Exception('snack non trouvé');
            }

        }
    }

    public function shootWithFoot() {
        if ($this->isOn) {
            $randomIndex = rand(0, count($this->snacks) - 1);
            $randomSnack = $this->snacks[$randomIndex];

            if ($randomSnack['quantity'] > 0) {
                $this->removeSnackQuantity($randomIndex);
            }

            $randomInsideCash =  rand(0, $this->cashAmount * 100) / 100;
            $this->cashAmount -= $randomInsideCash;
        }
    }

    private function removeSnackQuantity($index) {
        $this->snacks[$index]['quantity'] -= 1;
    }

}

$vendorMachine = new VendorMachine();
$vendorMachine->buySnack('Snickers');
$vendorMachine->buySnack('Twix');
$vendorMachine->buySnack('Twix');

$vendorMachine->shootWithFoot();