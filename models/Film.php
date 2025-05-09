<?php
require_once('config/Database.php');

class Film {
    public static function getAllFilms() {
        $conn = Database::getConnection();
        $sql = "SELECT * FROM films";
        $result = mysqli_query($conn, $sql);

        $films = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $films[] = $row;
            }
        }
        return $films;
    }

    public static function searchFilms($keyword) {
        $conn = Database::getConnection();
        $keyword = mysqli_real_escape_string($conn, $keyword);
        $sql = "SELECT * FROM films WHERE title LIKE '%$keyword%'";
        $result = mysqli_query($conn, $sql);

        $films = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $films[] = $row;
            }
        }
        return $films;
    }

    public static function filterFilms($genre, $year, $studio) {
        $conn = Database::getConnection();
        $conditions = [];
        if ($genre) $conditions[] = "genre = '" . mysqli_real_escape_string($conn, $genre) . "'";
        if ($year) $conditions[] = "release_year = '" . mysqli_real_escape_string($conn, $year) . "'";
        if ($studio) $conditions[] = "studio = '" . mysqli_real_escape_string($conn, $studio) . "'";

        $whereClause = count($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";
        $sql = "SELECT * FROM films $whereClause";
        $result = mysqli_query($conn, $sql);

        $films = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $films[] = $row;
            }
        }
        return $films;
    }
}
?>
