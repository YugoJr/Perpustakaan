<h2>Daftar Buku</h2>
<a href="index.php?page=create">Tambah Buku</a> | 
<a href="index.php?page=logout">Logout</a>
<table border="1" cellpadding="5">
    <tr><th>Judul</th><th>Penulis</th><th>Tahun</th><th>Aksi</th></tr>
    <?php foreach ($books as $b): ?>
    <tr>
        <td><?= $b['title'] ?></td>
        <td><?= $b['author'] ?></td>
        <td><?= $b['year'] ?></td>
        <td>
            <a href="index.php?page=edit&id=<?= $b['id'] ?>">Edit</a> |
            <a href="index.php?page=delete&id=<?= $b['id'] ?>" onclick="return confirm('Hapus buku ini?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>