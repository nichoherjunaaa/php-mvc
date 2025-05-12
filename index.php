<?php
/**
 * index.php
 *
 * Titik masuk utama aplikasi. Skrip ini bertanggung jawab untuk
 * membuat instance dari kelas FilmController dan memanggil metode yang sesuai
 * berdasarkan apakah ada parameter GET atau tidak.
 */

// Memerlukan kelas FilmController
require_once('controllers/FilmController.php');

// Membuat instance dari kelas FilmController
$controller = new FilmController();

// Memeriksa apakah ada parameter GET
if (!empty($_GET)) {
    // Jika ada parameter GET, panggil metode showFilms()
    // Metode ini akan memfilter film berdasarkan parameter GET
    $controller->showFilms();
} else {
    // Jika tidak ada parameter GET, panggil metode showAllFilms()
    // Metode ini akan menampilkan semua film
    $controller->showAllFilms();
}
?>
