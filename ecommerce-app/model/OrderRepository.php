<?php

class OrderRepository
{
// Je commence à sauvegarder mon order dans la session
    public function persistOrder($order) {
        session_start();
        $_SESSION['order'] = $order;
    }

// je récupère une commande qui est en session
    public function findOrder() {
        session_start();
        return $_SESSION['order'];
    }

}