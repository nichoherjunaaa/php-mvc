<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Collection</title>
    <!-- Tautkan ke stylesheet lokal -->
    <link rel="stylesheet" href="views/style.css"> 
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="container"> <!-- Kontainer utama untuk konten halaman -->
        <header>
            <h1>Movie Collection</h1> <!-- Judul halaman -->
            <p>Cari, temukan, dan nikmati film terbaik pilihanmu di satu tempat!</p> <!-- Subjudul -->
        </header>
        <form method="GET" action=""> <!-- Formulir untuk pencarian dan penyaringan -->
            <div class="search-container"> <!-- Kontainer input pencarian -->
                <input type="text" id="searchInput" name="search" placeholder="Search for movies..."> <!-- Kotak pencarian -->
                <button id="searchButton" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                <!-- Tombol pencarian dengan ikon -->
            </div>

            <div class="filter-container"> <!-- Filter untuk genre dan tahun -->
                <label for="genreFilter">Genre:</label>
                <select id="genreFilter" name="genre"> <!-- Dropdown untuk pemilihan genre -->
                    <option value="">Semua Genre</option> <!-- Opsi default -->
                    <?php
                    // Array genre
                    $genres = [
                        'Aksi',
                        'Komedi',
                        'Drama',
                        'Horor',
                        'Romantis',
                        'Thriller',
                        'Fantasi',
                        'Animasi',
                        'Petualangan',
                    ];
                    // Loop untuk setiap genre dan buat elemen option
                    foreach ($genres as $genre) {
                        echo "<option value=\"{$genre}\">{$genre}</option>";
                    }
                    ?>
                </select>

                <label for="yearFilter">Tahun:</label>
                <select id="yearFilter" name="year"> <!-- Dropdown untuk pemilihan tahun -->
                    <option value="">Semua Tahun</option> <!-- Opsi default -->
                    <?php
                    // Array tahun
                    $years = [
                        "2020" => "2020",
                        "2019" => "2019",
                        "2018" => "2018",
                        "2017" => "2017",
                        "2016" => "2016",
                        "2015" => "2015"
                    ];
                    // Loop untuk setiap tahun dan buat elemen option
                    foreach ($years as $year) {
                        echo "<option value=\"$year\">$year</option>";
                    }
                    ?>
                </select>
            </div>
        </form>

        <div class="movie-grid" id="movieGrid"> <!-- Kontainer grid untuk menampilkan film -->
            <?php if (count($films) > 0): ?> <!-- Cek jika ada film untuk ditampilkan -->
                <?php foreach ($films as $film): ?> <!-- Iterasi untuk setiap film -->
                    <div class="movie-card"> <!-- Kartu untuk setiap film -->
                        <div class="movie-poster"> <!-- Bagian poster film -->
                            <img src="<?php echo $film['image_url']; ?>" alt="Poster"> <!-- Gambar poster film -->
                        </div>
                        <div class="movie-info"> <!-- Bagian informasi film -->
                            <div class="movie-title"> <!-- Judul film dan tahun -->
                                <?php echo $film['title']; ?> <span
                                    class="movie-year">(<?php echo $film['release_year']; ?>)</span>
                            </div>
                            <div class="movie-details"> <!-- Detail tambahan film -->
                                <span class="tag"><?php echo $film['genre']; ?></span>
                                <span class="tag"> <?php echo $film['director']; ?></span>
                            </div>
                            <div class="movie-synopsis"> <!-- Sinopsis film -->
                                <?php echo $film['synopsis']; ?>
                            </div>
                            <div class="movie-actions"> <!-- Tombol aksi -->
                                <button class="view-details" data-id="<?php echo $film['id']; ?>">View Details</button>
                            </div>
                            <div class="movie-extra" style="display: none;"> <!-- Info tambahan yang disembunyikan -->
                                <span class="movie-cast"><?php echo $film['cast']; ?></span>
                                <span class="movie-studio"><?php echo $film['studio']; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No movies found.</p> <!-- Pesan jika tidak ada film yang ditemukan -->
            <?php endif; ?>
        </div>
    </div>

    <div class="movie-modal" id="movieModal"> <!-- Modal untuk menampilkan info film yang lebih detail -->
        <div class="modal-content"> <!-- Konten modal -->
            <button class="close-modal" id="closeModal">✕</button> <!-- Tombol untuk menutup modal -->
            <div class="modal-poster"> <!-- Bagian poster film di modal -->
                <img id="modalPoster" src="" alt="Movie poster"> <!-- Elemen gambar dengan src dinamis -->
            </div>
            <div class="modal-info"> <!-- Bagian untuk informasi detail film -->
                <h2 id="modalTitle"></h2> <!-- Judul film -->
                <div class="modal-details"> <!-- Detail tambahan film -->
                    <p><strong>Year:</strong> <span id="modalYear"></span></p>
                    <p><strong>Genre:</strong> <span id="modalGenre"></span></p>
                    <p><strong>Director:</strong> <span id="modalDirector"></span></p>
                    <p><strong>Studio:</strong> <span id="modalStudio"></span></p>
                    <p><strong>Cast:</strong> <span id="modalCast"></span></p>
                </div>
            </div>
            <div class="modal-synopsis"> <!-- Bagian sinopsis film -->
                <h3>Synopsis</h3>
                <p id="modalSynopsis"></p>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll('.view-details'); // Pilih semua tombol "view details"
            const modal = document.getElementById('movieModal'); // Elemen modal

            // Menambahkan event listener klik ke setiap tombol
            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const card = button.closest('.movie-card'); // Dapatkan kartu film terdekat
                    // Isi modal dengan data film
                    document.getElementById('modalTitle').textContent = card.querySelector('.movie-title').textContent;
                    document.getElementById('modalPoster').src = card.querySelector('img').src;
                    document.getElementById('modalYear').textContent = card.querySelector('.movie-year').textContent;
                    document.getElementById('modalGenre').textContent = card.querySelector('.tag').textContent;
                    document.getElementById('modalDirector').textContent = card.querySelectorAll('.tag')[1].textContent;
                    document.getElementById('modalSynopsis').textContent = card.querySelector('.movie-synopsis').textContent;
                    document.getElementById('modalCast').textContent = card.querySelector('.movie-cast').textContent;
                    document.getElementById('modalStudio').textContent = card.querySelector('.movie-studio').textContent;
                    modal.style.display = 'block'; // Tampilkan modal
                });
            });

            // Menambahkan event listener untuk tombol tutup modal
            document.getElementById('closeModal').addEventListener('click', () => {
                modal.style.display = 'none'; // Sembunyikan modal
            });
        });
    </script>
</body>

</html>
