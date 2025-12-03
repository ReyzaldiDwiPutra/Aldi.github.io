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

if (isset($_POST['submit'])) {
    $data = [
        $_POST['name'],
        $_POST['price'],
        $_POST['category'],
        $_POST['status'],
        $_POST['image_path']
    ];
    $repo->update($id, $data);
    header("Location: index_product.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit Product</title>
</head>
<body>
<div class="container">
    <h2>Edit Product</h2>
    <form method="POST">
        <label>Nama:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

        <label>Harga:</label>
        <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required>

        <label>Kategori:</label>
        <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>

        <label>Status:</label>
        <input type="text" name="status" value="<?= htmlspecialchars($product['status']) ?>" required>

        <label>Path Gambar:</label>
        <input type="text" name="image_path" value="<?= htmlspecialchars($product['image_path']) ?>">

        <?php if(!empty($product['image_path'])): ?>
            <img class="preview" src="<?= htmlspecialchars($product['image_path']) ?>" alt="Preview">
        <?php endif; ?>

        <button type="submit" name="submit">Simpan Perubahan</button>
    </form>

    <div class="nav">
        <a href="index_product.php">Kembali ke Daftar Product</a> |
        <a href="index_user.php">Kelola User</a> |
        <a href="index.php">Dashboard</a>
    </div>
</div>
</body>
</html>
