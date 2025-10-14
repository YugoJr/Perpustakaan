<?php
<<<<<<< HEAD
require_once __DIR__ . '/../app/Controller/bookController.php';


$controller = new bukuController();
$action = $_GET['action'] ?? 'index';

$id = $_GET['id'] ?? null;

switch ($action) {


    case 'create':
        $controller->create();
        break;

    case 'edit':
        $controller->edit($id);
        break;

    case 'delete':
        $controller->delete($id);
        break;

    default:
        $controller->index();
        break;
}
=======
session_start();
// Simple router: use ?page= to choose content; keep controller logic untouched.
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

function requireLogin() {
    if (empty($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <style>
        :root { --accent: #007BFF; --bg: #f7f9fc; --card: #fff; --muted:#666; }
        body { font-family: Arial, Helvetica, sans-serif; margin: 0; background: var(--bg); color: #222; }
        .container { max-width: 900px; margin: 24px auto; padding: 16px; }
        header { background: var(--card); padding: 12px 16px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); }
        nav a { margin-right: 12px; color: var(--accent); text-decoration: none; font-weight: 600; }
        nav .muted { color: var(--muted); font-weight: 400; }
        main { margin-top: 18px; }
        .hero { background: var(--card); padding: 18px; border-radius: 8px; }
        .actions { margin-top: 12px; }
        .btn { display: inline-block; padding: 8px 12px; border-radius: 6px; background: var(--accent); color: #fff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <nav>
                <a href="index.php">Beranda</a>
                <a href="index.php?page=books">Buku</a>
                <a href="index.php?page=book_create">Tambah Buku</a>
                <?php if (!empty($_SESSION['user'])): ?>
                    <span class="muted">Halo, <?php echo htmlspecialchars($_SESSION['user']['username'] ?? $_SESSION['user']['email']); ?></span>
                    <a href="index.php?page=logout">Logout</a>
                <?php else: ?>
                    <a href="index.php?page=login">Masuk</a>
                    <a href="index.php?page=register">Daftar</a>
                <?php endif; ?>
            </nav>
        </header>

        <main>
            <section class="hero">
                <?php if ($page === 'home'): ?>
                    <h1>Selamat Datang di Perpustakaan</h1> 
                    <p>Kelola buku dengan mudah: lihat daftar, tambah, ubah, atau hapus buku.</p>
                    <div class="actions">
                        <a class="btn" href="index.php?page=books">Lihat Buku</a>
                        <a class="btn" href="index.php?page=book_create">Tambah Buku</a>
                    </div>
                <?php elseif ($page === 'books'): ?>
                    <?php include_once __DIR__ . '/../app/controller/Bookcontroller.php'; $c = new BookController(); $c->index(); ?>
                <?php elseif ($page === 'book_create'): ?>
                    <?php include_once __DIR__ . '/../app/controller/Bookcontroller.php'; $c = new BookController(); $c->create(); ?>
                <?php elseif ($page === 'book_edit' && isset($_GET['id'])): ?>
                    <?php include_once __DIR__ . '/../app/controller/Bookcontroller.php'; $c = new BookController(); $c->edit(); ?>
                <?php elseif ($page === 'book_delete' && isset($_GET['id'])): ?>
                    <?php include_once __DIR__ . '/../app/controller/Bookcontroller.php'; $c = new BookController(); $c->delete(); ?>
                <?php elseif ($page === 'login'): ?>
                    <?php include_once __DIR__ . '/../app/controller/akuncontroller.php'; $a = new Akun(); $a->login(); ?>
                <?php elseif ($page === 'register'): ?>
                    <?php include_once __DIR__ . '/../app/controller/akuncontroller.php'; $a = new Akun(); $a->register(); ?>
                <?php elseif ($page === 'logout'): ?>
                    <?php include_once __DIR__ . '/../app/controller/akuncontroller.php'; $a = new Akun(); $a->logout(); ?>
                <?php else: ?>
                    <h2>Halaman tidak ditemukan</h2>
                    <p>Maaf, halaman yang Anda minta tidak tersedia.</p>
                <?php endif; ?>
            </section>
        </main>
    </div>
</body>
</html>
>>>>>>> 4fbdd005cd8c035196126f15eb542d4d1c9f5059
