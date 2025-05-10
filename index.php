<?php
require_once('controllers/FilmController.php');

$controller = new FilmController();

if (!empty($_GET)) {
    $controller->showFilms();
} else {
    $controller->showAllFilms();
}
?>