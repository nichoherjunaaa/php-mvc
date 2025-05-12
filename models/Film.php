<?php
require_once('config/Database.php');

class Film
{
    /**
     * Mengambil semua film dari database.
     *
     * @return array Array berisi data film.
     */
    public static function getAllFilms()
    {
        // Membuat koneksi ke database
        $conn = Database::getConnection();

        // Query untuk mengambil semua data film
        $sql = "SELECT * FROM films";

        // Menjalankan query
        $result = mysqli_query($conn, $sql);

        // Membuat array untuk menyimpan data film
        $films = [];

        // Jika query berhasil dijalankan
        if ($result) {
            // Membaca data film satu per satu
            while ($row = mysqli_fetch_assoc($result)) {
                // Menambahkan data film ke array
                $films[] = $row;
            }
        }

        // Mengembalikan array berisi data film
        return $films;
    }

    /**
     * Mencari film berdasarkan keyword.
     *
     * @param string $keyword Keyword yang akan dicari.
     * @return array Array berisi data film yang sesuai dengan keyword.
     */
    public static function searchFilms($keyword)
    {
        // Membuat koneksi ke database
        $conn = Database::getConnection();

        // Meng-escape keyword agar tidak terjadi SQL injection
        $keyword = mysqli_real_escape_string($conn, $keyword);

        // Query untuk mencari film berdasarkan keyword
        $sql = "SELECT * FROM films WHERE title LIKE '%$keyword%'";

        // Menjalankan query
        $result = mysqli_query($conn, $sql);

        // Membuat array untuk menyimpan data film
        $films = [];

        // Jika query berhasil dijalankan
        if ($result) {
            // Membaca data film satu per satu
            while ($row = mysqli_fetch_assoc($result)) {
                // Menambahkan data film ke array
                $films[] = $row;
            }
        }

        // Mengembalikan array berisi data film yang sesuai dengan keyword
        return $films;
    }

    /**
     * Mengambil film berdasarkan genre dan tahun.
     *
     * @param string $genre Genre film yang akan diambil.
     * @param string $year Tahun film yang akan diambil.
     * @return array Array berisi data film yang sesuai dengan genre dan tahun.
     */
    public static function filterFilms($genre, $year)
    {
        // Membuat koneksi ke database
        $conn = Database::getConnection();

        // Membuat array untuk menyimpan kondisi WHERE
        $conditions = [];

        // Jika genre tidak kosong
        if ($genre) {
            // Meng-escape genre agar tidak terjadi SQL injection
            $genreEscaped = mysqli_real_escape_string($conn, $genre);

            // Menambahkan kondisi genre ke array
            $conditions[] = "genre LIKE '%$genreEscaped%'";
        }

        // Jika tahun tidak kosong
        if ($year) {
            // Meng-escape tahun agar tidak terjadi SQL injection
            $yearEscaped = mysqli_real_escape_string($conn, $year);

            // Menambahkan kondisi tahun ke array
            $conditions[] = "release_year = '$yearEscaped'";
        }

        // Membuat klausa WHERE berdasarkan kondisi-kondisi yang ada
        $whereClause = count($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

        // Query untuk mengambil film berdasarkan genre dan tahun
        $sql = "SELECT * FROM films $whereClause";

        // Menjalankan query
        $result = mysqli_query($conn, $sql);

        // Membuat array untuk menyimpan data film
        $films = [];

        // Jika query berhasil dijalankan
        if ($result) {
            // Membaca data film satu per satu
            while ($row = mysqli_fetch_assoc($result)) {
                // Menambahkan data film ke array
                $films[] = $row;
            }
        }

        // Mengembalikan array berisi data film yang sesuai dengan genre dan tahun
        return $films;
    }
}
?>
