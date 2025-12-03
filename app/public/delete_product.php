<?php
require_once __DIR__ . '/../src/ProductRepository.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID product tidak ditemukan!");
}

$id = $_GET['id'];
$repo = new ProductRepository();
$product = $repo->find($id);

if (!$product) {
    die("Product dengan ID $id tidak ditemukan!");
}

// Hapus product
$repo->delete($id);
header("Location: index_product.php");
exit;
