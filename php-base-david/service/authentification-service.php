<?php

function redirectNotLoggedUser() {
    session_start();

    if (!key_exists('is_authenticated', $_SESSION)  ||
        !$_SESSION['is_authenticated']) {

        header('location: http://localhost:8888/php-base-david/controller/public/connection-controller.php');
    }

}