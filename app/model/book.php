  <?php
// Memanggil file Database.php agar model dapat terhubung ke database.
// __DIR__ menunjukkan folder saat ini (Models), lalu naik dua level ke folder config.
require_once __DIR__ . '/../../config/Database.php';

// Membuat kelas Siswa sebagai representasi tabel "siswa" di database.
// Kelas ini bertugas berinteraksi langsung dengan database (CRUD).
class buku {
    
    // Properti $pdo digunakan untuk menyimpan objek koneksi database (PDO instance).
    private $pdo;

    // Konstruktor dijalankan otomatis setiap kali objek Siswa dibuat.
   // Tujuannya: membuat koneksi ke database.
    public function __construct() {
        // Membuat objek dari kelas Database.
        $db = new Database();

        // Menyimpan koneksi PDO dari kelas Database ke dalam properti $pdo.
        // Jadi, $this->pdo bisa digunakan oleh seluruh method di kelas ini.
        $this->pdo = $db->getConnection();
    }

    // ---------------------------------------------
    // METHOD 1: TAMBAH DATA SISWA
    // ---------------------------------------------
    // Method ini digunakan untuk menambah data baru ke tabel "siswa".
    public function tambahbuku($title, $author, $year) {
        // Menulis query SQL dengan parameter (:nama dan :kelas) agar aman dari 		SQL Injection.
        $sql = "INSERT INTO buku (title, author, year) VALUES (:title, :author, :year)";

        // Mempersiapkan query untuk dieksekusi oleh PDO.
        $stmt = $this->pdo->prepare($sql);

        // Mengikat parameter agar nilai dari variabel PHP dimasukkan ke query 		SQL.
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":year", $year);

        // Menjalankan query dan mengembalikan hasilnya (true jika berhasil, 	false jika gagal).
        return $stmt->execute();
    }

    // ---------------------------------------------
    // METHOD 2: TAMPILKAN SEMUA DATA SISWA
    // ---------------------------------------------
    // Method ini digunakan untuk mengambil semua data dari tabel "siswa".
    public function tampilbuku() {
        // Menjalankan query langsung tanpa parameter karena hanya mengambil 	semua data.
        $stmt = $this->pdo->query("SELECT * FROM buku");

        // Mengambil semua baris hasil query dan mengembalikannya dalam bentuk 	array asosiatif.
        // PDO::FETCH_ASSOC artinya hasil berupa ['nama' => 'Syahid', 'kelas' => 	'10A'] dst.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ---------------------------------------------
    // METHOD 3: UBAH DATA SISWA
    // ---------------------------------------------
    // Method ini digunakan untuk memperbarui data berdasarkan ID siswa.
    public function editbuku($id, $title, $author, $year) {
        // Query UPDATE dengan parameter agar aman dari SQL Injection.
        $sql = "UPDATE buku SET title=:title, author=:author, year=:year WHERE id=:id";

        // Mempersiapkan query untuk dijalankan.
        $stmt = $this->pdo->prepare($sql);

        // Mengikat parameter ke nilai variabel.
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":author", $author);
        $stmt->bindParam(":year", $year);
        $stmt->bindParam(":id", $id);

        // Menjalankan query dan mengembalikan hasilnya (true/false).
        return $stmt->execute();
    }

    // ---------------------------------------------
    // METHOD 4: HAPUS DATA SISWA
    // ---------------------------------------------
    // Method ini digunakan untuk menghapus data siswa berdasarkan ID.
    public function hapusbuku($id) {
        // Menulis query DELETE dengan parameter ID.
        $stmt = $this->pdo->prepare("DELETE FROM buku WHERE id=:id");

        // Mengikat nilai parameter ID.
        $stmt->bindParam(":id", $id);

        // Menjalankan query DELETE dan mengembalikan hasilnya (true/false).
        return $stmt->execute();
    }
}   
?>