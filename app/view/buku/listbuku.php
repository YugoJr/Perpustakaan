<h2>Daftar Buku</h2>
<a href="../public/index.php?action=create">Tambah dfgdfgfggfBuku</a>
<table border="1" cellpadding="6">
    <tr><th>ID</th><th>Buku</th><th>Author</th></th>Tahun<th><th>Aksi</th></tr>
    <?php foreach ($data as $row): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['title']; ?></td>
            <td><?= $row['author']; ?></td>
            <td><?= $row['year']; ?></td>
            <td>
                <a href="index.php?action=edit&id=<?= $row['id']; ?>">Edit</a> | 
                <a href="index.php?action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Yakin?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; }
    h2 { color: #333; }
    a { text-decoration: none; color: #007BFF; }
    a:hover { text-decoration: underline; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #fff; }
    th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
    th { background-color: #f2f2f2; }
    tr:hover { background-color: #f1f1f1; }