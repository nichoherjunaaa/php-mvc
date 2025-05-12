<?php
require_once('models/Film.php');

// Kelas FilmController menangani logika yang terkait dengan data film
class FilmController {

    // Metode untuk menampilkan semua film
    public function showAllFilms() {
        // Ambil semua data film menggunakan model Film
        $films = Film::getAllFilms();

        // Sertakan view untuk menampilkan daftar film
        include('views/film_list.php');
    }

    // Metode untuk menampilkan film berdasarkan filter atau pencarian
    public function showFilms() {
        // Ambil parameter filter dari permintaan GET
        $genre = $_GET['genre'] ?? null; // Ambil genre, jika tersedia
        $year = $_GET['year'] ?? null;   // Ambil tahun, jika tersedia
        $search = $_GET['search'] ?? null; // Ambil kueri pencarian, jika tersedia

        // Periksa apakah kueri pencarian diberikan
        if ($search) {
            // Lakukan pencarian menggunakan model Film
            $films = Film::searchFilms($search);
        } else {
            // Filter film berdasarkan genre dan tahun menggunakan model Film
            $films = Film::filterFilms($genre, $year);
        }

        // Sertakan view untuk menampilkan daftar film
        include('views/film_list.php');
    }
}
?>
