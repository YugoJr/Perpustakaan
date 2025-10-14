<?php
// Memanggil file model Siswa.php agar controller dapat menggunakan fungsi-fungsi di dalamnya.
// __DIR__ menunjuk ke folder saat ini (Controllers), lalu naik satu level ke folder Models.
require_once __DIR__ . '/../model/book.php';

// Membuat kelas controller bernama SiswaController
// Kelas ini akan mengatur alur logika antara model (data) dan view (tampilan).
class bukuController {

    // Property $model digunakan untuk menyimpan objek dari kelas Siswa.
    private $model;

    // Konstruktor dijalankan otomatis ketika objek SiswaController dibuat.
    // Di sini kita membuat objek Siswa dan menyimpannya ke dalam $model.
    public function __construct() {
        $this->model = new buku();
    }

    // Method index() bertugas untuk menampilkan semua data siswa.
    // Biasanya ini adalah halaman utama (daftar siswa).
    public function index() {
        // Memanggil fungsi tampilSiswa() dari model untuk mengambil semua data dari database.
        $data = $this->model->tampilbuku();

        // Menyertakan (include) file tampilan siswa_list.php untuk menampilkan data ke pengguna.
        include __DIR__ . '/../View/buku/listbuku.php';
    }

    // Method create() digunakan untuk menambah data baru.
    // Method ini menangani dua hal:
    // 1. Menampilkan form input (jika request = GET)
    // 2. Menyimpan data baru (jika request = POST)
    public function create() {
        // Mengecek apakah form dikirim dengan metode POST (artinya user sudah menekan tombol "Simpan").
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Memanggil fungsi tambahSiswa() dari model untuk menyimpan data ke database.

            echo $_POST['title'];
            $this->model->tambahbuku($_POST['title'], $_POST['author'], $_POST['year']);

            // Setelah data berhasil disimpan, arahkan pengguna kembali ke halaman utama (index.php).
            header("Location: index.php");
        }

        // Jika bukan POST (berarti GET), tampilkan form tambah data siswa.
        include __DIR__ . '/../view/buku/create.php';
    }

    // Method edit() digunakan untuk mengubah data siswa berdasarkan ID.
    // Sama seperti create(), method ini menangani dua kondisi:
    // 1. Jika request = GET → tampilkan form edit
    // 2. Jika request = POST → proses pembaruan data
    public function edit($id) {
        // Jika form dikirim (POST), berarti user sudah menekan tombol "Perbarui".
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Panggil fungsi ubahSiswa() di model dengan parameter dari form.
            $this->model->editbuku($id, $_POST['title'], $_POST['author'], $_POST['year']);

            // Setelah update selesai, arahkan kembali ke halaman utama.
            header("Location: index.php");
        } 
        // Jika request bukan POST (artinya user baru saja mengklik tombol "Edit"),
        // maka ambil data siswa dengan ID tertentu dan tampilkan di form edit.
        else {
            // Ambil semua data siswa dari database.
            $buku = $this->model->tampilbuku();

            // Cari data siswa yang memiliki ID sesuai parameter $id.
            // array_filter digunakan untuk menyaring array berdasarkan kondisi 			tertentu.
 		$filtered = array_filter($buku, fn($s) => $s['id'] == $id);
            $detail = array_values($filtered)[0];

            // Sertakan tampilan form edit (siswa_edit.php), dan tampilkan data yang akan diedit.
            include __DIR__ . '/../view/buku/edit.php';
        }
    }

    // Method delete() digunakan untuk menghapus data siswa berdasarkan ID.
    public function delete($id) {
        // Memanggil fungsi hapusSiswa() dari model untuk menghapus data dari database.
        $this->model->hapusbuku($id);

        // Setelah data dihapus, arahkan kembali ke halaman utama (index.php).
        header("Location: index.php");
    }
}
