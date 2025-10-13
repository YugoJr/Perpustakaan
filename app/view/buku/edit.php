<h2>Edit Buku</h2>
<form method="POST">
    <input type="text" name="title" value="<?= $book['title'] ?>" required><br>
    <input type="text" name="author" value="<?= $book['author'] ?>"><br>
    <input type="number" name="year" value="<?= $book['year'] ?>"><br>
    <button type="submit">Update</button>
</form>
<a href="index.php">Kembali</a>