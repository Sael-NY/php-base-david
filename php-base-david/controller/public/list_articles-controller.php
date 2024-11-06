<?php

require_once('../../model/articles-repository.php');
require_once('../../config/config.php');

$articles = findArticles();

function isStringTooLong($stringToCheck) {
    return mb_strlen($stringToCheck, 'UTF-8') > 50;
}

function shortenString($stringToCut) {
    return substr($stringToCut, 0, 30);
}

require_once('../../view/public/list_articles-view.php');

?>