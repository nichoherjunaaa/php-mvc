<?php
/**
 * Kelas untuk mengelola koneksi ke database.
 */
class Database {
    /**
     * Metode untuk mendapatkan koneksi ke database.
     * 
     * Metode ini akan mengembalikan objek koneksi MySQLi.
     * 
     * @return mysqli Koneksi ke database.
     */
    public static function getConnection() {
        // Membuat koneksi ke database dengan menggunakan MySQLi
        $conn = mysqli_connect("localhost", "root", "", "db_film");
        
        // Jika koneksi gagal, maka akan menampilkan pesan kesalahan
        if (!$conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }
        
        // Mengembalikan objek koneksi ke database
        return $conn;
    }
}
?>

