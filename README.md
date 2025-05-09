# 🎬 Movie Collection App (PHP + MySQLi + MVC)
Aplikasi sederhana untuk menampilkan dan mencari koleksi film menggunakan PHP dan MySQLi dengan arsitektur MVC dasar.

---
## 📁 Struktur Direktori
.
├── config/
│ └── Database.php # Koneksi ke database
├── controllers/
│ └── FilmController.php # Controller utama
├── models/
│ └── Film.php # Model Film
├── views/
│ ├── film_list.php 
│ └── style.css
├── index.php
└── README.md # Catatan

---

## 🛠️ Persiapan

### 1. 📦 Requirements

- PHP 7.0 atau lebih baru  
- MySQL/MariaDB  
- Web server (XAMPP, Laragon, atau sejenisnya)

---

### 2. ⚙️ Setup Database

1. **Buat database** baru dengan nama `db_film`.
2. Jalankan SQL berikut untuk membuat tabel `films`:

```sql
CREATE DATABASE IF NOT EXISTS db_film;
USE db_film;

CREATE TABLE films (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    genre VARCHAR(100),
    director VARCHAR(100),
    release_year INT,
    studio VARCHAR(100),
    synopsis TEXT,
    image_url VARCHAR(255)
);
```
--- 

### 3. Import file CSV

Langkah-langkah:

- Buka **phpMyAdmin**
- Pilih database `db_film`
- Klik tabel `films`
- Masuk ke tab **Import**
- Upload file CSV yang berisi data film
- Pastikan urutan kolom sesuai dengan struktur tabel

### 4. Setup Program
- Unduh source code
- Ekstrak file zip ke direktori web server 

XAMPP
C:\xampp\htdocs\movie-collection

LARAGON 
C:\laragon\www\movie-collection 

- Jalankan web server
- Buka http://localhost/movie-collection/

