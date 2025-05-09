<?php
require_once('models/Film.php');

class FilmController {
    public function showAllFilms() {
        $films = Film::getAllFilms();
        include('views/film_list.php');
    }

    public function showFilms() {
        $genre = $_GET['genre'] ?? null;
        $year = $_GET['year'] ?? null;
        $studio = $_GET['studio'] ?? null;
        $search = $_GET['search'] ?? null;

        if ($search) {
            $films = Film::searchFilms($search);
        } else {
            $films = Film::filterFilms($genre, $year, $studio);
        }

        include('views/film_list.php');
    }
}
?>
