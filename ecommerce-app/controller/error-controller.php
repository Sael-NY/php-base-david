<?php


class ErrorController {

    public function notFound() {
        require "../views/error-view.php";
    }
}

require_once('../views/error-view.php');