<?php
// Class Database digunakan untuk membuat koneksi ke database menggunakan PDO.
// File ini akan dipanggil oleh Model (misalnya Siswa.php) agar bisa mengakses database.

class Database {
    // Properti (variabel) untuk menyimpan informasi koneksi database.
    private $host = "localhost";    // Nama host, biasanya localhost
    private $dbname = "perpustakaan";    // Nama database
    private $username = "root";     // Username MySQL
    private $password = "";         // Password MySQL (kosong di XAMPP)
    private $pdo;                   // Objek PDO yang akan digunakan untuk koneksi

    // Konstruktor otomatis dijalankan saat class Database dibuat (new Database()).
    public function __construct() {
        try {
            // Membuat koneksi PDO dengan format:
            // mysql:host=nama_host;dbname=nama_database
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );

            // Mengatur agar jika terjadi error, PDO akan menampilkan pesan error 		(mode exception)
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // (Opsional) menonaktifkan emulasi prepared statements agar lebih 			aman
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            // echo "Koneksi berhasil!"; // bisa diaktifkan untuk uji coba
        } catch (PDOException $e) {
            // Jika gagal terkoneksi, tampilkan pesan error
            die("Koneksi ke database gagal: " . $e->getMessage());
        }
    }

    // Fungsi untuk mengambil koneksi PDO agar bisa digunakan oleh Model lain
    public function getConnection() {
        return $this->pdo;
    }
}
?>
<?php