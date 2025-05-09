    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Movie Collection</title>
        <link rel="stylesheet" href="views/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    </head>

    <body>
        <div class="container">
            <header>
                <h1>Movie Collection</h1>
                <p>Discover and explore amazing films</p>
            </header>
            <form method="GET" action="">
                <div class="search-container">
                    <input type="text" id="searchInput" name="search" placeholder="Search for movies...">
                    <button id="searchButton" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>

                <div class="filter-container">
                    <label for="genreFilter">Genre:</label>
                    <select id="genreFilter" name="genre">
                        <option value="">All Genres</option>
                        <?php
                        $genres = array_unique(array_column($films, 'genre'));
                        foreach ($genres as $genre) {
                            echo "<option value=\"$genre\">$genre</option>";
                        }
                        ?>
                    </select>

                    <label for="yearFilter">Year:</label>
                    <select id="yearFilter" name="year">
                        <option value="">All Years</option>
                        <?php
                        $years = array_unique(array_column($films, 'release_year'));
                        foreach ($years as $year) {
                            echo "<option value=\"$year\">$year</option>";
                        }
                        ?>
                    </select>

                    <label for="studioFilter">Studio:</label>
                    <select id="studioFilter" name="studio">
                        <option value="">All Studios</option>
                        <?php
                        $studios = array_unique(array_column($films, 'studio'));
                        foreach ($studios as $studio) {
                            echo "<option value=\"$studio\">$studio</option>";
                        }
                        ?>
                    </select>
                </div>
            </form>


            <div class="movie-grid" id="movieGrid">
                <?php if (count($films) > 0): ?>
                    <?php foreach ($films as $film): ?>
                        <div class="movie-card">
                            <div class="movie-poster">
                                <img src="<?php echo $film['image_url']; ?>" alt="Poster">
                            </div>
                            <div class="movie-info">
                                <div class="movie-title">
                                    <?php echo $film['title']; ?> <span
                                        class="movie-year">(<?php echo $film['release_year']; ?>)</span>
                                </div>
                                <div class="movie-details">
                                    <span class="tag"><?php echo $film['genre']; ?></span>
                                    <span class="tag"> <?php echo $film['director']; ?></span>
                                </div>
                                <div class="movie-synopsis">
                                    <?php echo $film['synopsis']; ?>
                                </div>
                                <div class="movie-actions">
                                    <button class="view-details" data-id="<?php echo $film['id']; ?>">View Details</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No movies found.</p>
                <?php endif; ?>
            </div>
        </div>
        </div>

        <div class="movie-modal" id="movieModal">
            <div class="modal-content">
                <button class="close-modal" id="closeModal">✕</button>
                <div class="modal-poster">
                    <img id="modalPoster" src="" alt="Movie poster">
                </div>
                <div class="modal-info">
                    <h2 id="modalTitle"></h2>
                    <div class="modal-details">
                        <p><strong>Year:</strong> <span id="modalYear"></span></p>
                        <p><strong>Genre:</strong> <span id="modalGenre"></span></p>
                        <p><strong>Director:</strong> <span id="modalDirector"></span></p>
                        <p><strong>Studio:</strong> <span id="modalStudio"></span></p>
                        <p><strong>Cast:</strong> <span id="modalCast"></span></p>
                    </div>
                </div>
                <div class="modal-synopsis">
                    <h3>Synopsis</h3>
                    <p id="modalSynopsis"></p>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const buttons = document.querySelectorAll('.view-details');
                const modal = document.getElementById('movieModal');

                buttons.forEach(button => {
                    button.addEventListener('click', () => {
                        const card = button.closest('.movie-card');
                        document.getElementById('modalTitle').textContent = card.querySelector('.movie-title').textContent;
                        document.getElementById('modalPoster').src = card.querySelector('img').src;
                        document.getElementById('modalYear').textContent = card.querySelector('.movie-year').textContent;
                        document.getElementById('modalGenre').textContent = card.querySelector('.tag').textContent;
                        document.getElementById('modalDirector').textContent = card.querySelectorAll('.tag')[1].textContent;
                        document.getElementById('modalSynopsis').textContent = card.querySelector('.movie-synopsis').textContent;
                        modal.style.display = 'block';
                    });
                });

                document.getElementById('closeModal').addEventListener('click', () => {
                    modal.style.display = 'none';
                });
            });
        </script>
    </body>

    </html>