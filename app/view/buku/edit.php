<h2>Edit Data Siswa</h2>
<form method="POST">
    <label>title:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($detail['title']); ?>" required><br><br>

    <label>author:</label><br>
    <input type="author" name="author" value="<?= htmlspecialchars($detail['author']); ?>" required><br><br>

    <label>Tahun:</label><br>
    <input type="number" name="year" value="<?= htmlspecialchars($detail['year']);
    ?>" required><br><br>

    <button type="submit">Perbarui</button>
</form>

<a href="index.php">Kembali</a>
<style>
    body { font-family: Arial, sans-serif; background: #f7f7f7; }
    .container { max-width: 400px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px #ccc; }
    h2 { text-align: center; color: #333; }
    input, button { width: 100%; padding: 10px; margin: 8px 0; border-radius: 4px; border: 1px solid #ccc; }
    button { background: #007bff; color: #fff; border: none; cursor: pointer; }
    button:hover { background: #0056b3; }
    .back { display: block; text-align: center; margin-top: 15px; color: #007bff; text-decoration: none; }
    .back:hover { text-decoration: underline; }