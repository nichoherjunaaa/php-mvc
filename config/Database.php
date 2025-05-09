<?php
class Database {
    public static function getConnection() {
        $conn = mysqli_connect("localhost", "root", "", "db_film");
        if (!$conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
        return $conn;
    }
}
?>
