<?php

require_once('../model/Order.php');
require_once('../model/OrderRepository.php');

class OrderController {


    public function createOrder() {
        $message = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (key_exists('customerName', $_POST)) {

                try {
                    // je créer une instance de la classe Order
                    // avec ces propriétés par défaut (date de création, client, montant etc)
                    $order = new Order($_POST['customerName']);
                    // je stocke la commande créée (ici dans la session, mais pourrait être en BDD)
                    // en utilisant la classe OrderRepository
                    // pour ça je l'instancie et j'utilise la méthode persist
                    $orderRepository = new OrderRepository();
                    $orderRepository->persistOrder($order);
                    
                    $message = 'Commande créée';
                } catch (Exception $exception) {
                    $message = $exception->getMessage();
                }

            }
        }

        require_once('../views/IndexView.php');
    }

    public function addProduct() {

        // récupère la commande en BDD

        $message = null;

        // j'instancie l'OrderRepository
        // et j'appelle la méthode findOrder qui me
        // permet de récupérer la commande actuellement en session pour l'utilisateur
        $orderRepository = new OrderRepository();
        $order = $orderRepository->findOrder();


        try {
            // j'ajoute un produit à la commande
            $order->addProduct();
            // et je la sauvegarde en BDD
            $orderRepository -> persistOrder($order);
            $message = "Produit ajouté";

        } catch (Exception $exception) {
            $message = $exception -> getMessage();
        }

        require_once('../views/add-product-view.php');

    }

    public function removeProduct () {

        $message = null;

        $orderRepository = new OrderRepository();
        $order = $orderRepository->findOrder();

        try {
            // je retire un produit à la commande
            $order -> removeProduct();
            // et je la sauvegarde dans une nouvelle session
            $orderRepository -> persistOrder($order);
            $message = "Produit supprimé";

        } catch (Exception $exception) {
            $message = $exception -> getMessage();
        }

        require_once('../views/removeProduct.php');


    }

    public function setShippingAddress() {
        // Récupère mon order stockée en session avec findOrder
        $orderRepository = new OrderRepository();
        $order = $orderRepository->findOrder();

        $message = null;
        // J'accéde à la session
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Quelle verbe va me donner et je verifie
            if (key_exists('shippingAddress', $_POST)) {

                try {
                    // Je donne la valeur form
                    $order->setShippingAddress($_POST['shippingAddress']);
                    // j'affiche le message
                    $message = "Adresse ajoutée";

                } catch (Exception $exception) {
                    // En cas d'erreur, j'affiche un message
                  $message = $exception->getMessage();
                }


            }
        }


        require_once('../views/set-shipping-address-view.php');
    }
    

}