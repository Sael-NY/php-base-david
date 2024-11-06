<?php

require_once('../../config/config.php');

$isContactCreated = false;
$isFormValid = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
$isContactCreated = true;

if ($_POST['firstname'] &&
    $_POST['lastname'] &&
    $_POST['sujet'] &&
    $_POST['message'] &&
    mb_strlen($_POST['firstname']) > 3&&
    mb_strlen($_POST['lastname']) > 4 &&
    mb_strlen($_POST['sujet']) > 2 &&
    mb_strlen($_POST['message']) > 8

) {
    $isFormValid = true;

        // je créé un tableau contenant toutes mes valeurs
        // issues du formulaire
        $article = [
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "sujet" => $_POST['sujet'],
            "message" => $_POST['message']
        ];

        // je récupère le chemin du fichier json
        // qui servira à stocker les données
        $path = '../contact.json';

        // je convertis mon article en json
        $jsonString = json_encode($article,JSON_PRETTY_PRINT);

        // j'ouvre le fichier json, je stocke mon article
        // dedans et je ferme le fichier json
        $fp = fopen($path, 'w');
        fwrite($fp, $jsonString);
        fclose($fp);
    
    }
}

require_once('../../view/public/contact_view.php'); ?>
