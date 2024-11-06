<?php

$isAutenthicatedSuccessful = false;
$isFromSubmited = false;


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $isFromSubmited = true;
    if ($_POST['email'] === "hattab840@hotmail.fr" &&
        $_POST['password'] === "test"
    ) {

        session_start();

        $_SESSION['is_authenticated'] = true;

        $isAutenthicatedSuccessful = true;
        header('location: http://localhost:8888/php-base-david/controller/admin/dashboard.php');
    }

}

require_once('../../view/public/connection-view.php');

