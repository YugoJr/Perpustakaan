<h2>Tambah Data Siswa</h2>
<!-- Form untuk mengirim data perubahan ke server menggunakan metode POST -->
<form method="POST">
    <label>title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Author:</label><br>
    <input type="text" name="author" required><br><br>

    <label>Tahun:</label><br>
    <input type="number" name="year" required><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="index.php">Kembali</a>
<style>
    body { font-family: Arial, sans-serif; background: #f7f7f7; }
    .container { max-width: 400px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px #ccc; }
    h2 { text-align: center; color: #333; }
    input, button { width: 100%; padding: 10px; margin: 8px 0; border-radius: 4px; border: 1px solid #ccc; }
    button { background: #28a745; color: #fff; border: none; cursor: pointer; }
    button:hover { background: #218838; }
    .back { display: block; text-align: center; margin-top: 15px; color: #007bff; text-decoration: none; }
    .back:hover { text-decoration: underline; }