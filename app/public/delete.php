<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/ProductRepository.php';

// Pastikan ada parameter id
if (!isset($_GET['id'])) {
    die("ID product tidak ditemukan!");
}

$id = $_GET['id'];

// Inisialisasi repository
$repo = new ProductRepository();

// Hapus product
$deleted = $repo->delete($id);

if ($deleted) {
    // Redirect ke halaman kelola product
    header("Location: index_product.php");
    exit;
} else {
    die("Gagal menghapus product dengan ID $id");
}
