<?php

require_once('../model/Order.php');


class IndexController{
    public function index() {

        $message = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            if (key_exists('customerName', $_POST)) {
        
                try {
                    $order = new Order($_POST['customerName']);
                    $message = 'Commande créée';
                } catch (Exception $exception) {
                    $message = $exception->getMessage();
                }
        
            }
        }

        require_once('../views/index-view.php');

    }
    

}
