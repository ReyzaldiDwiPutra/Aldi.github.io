<?php
require_once __DIR__ . '/../src/ProductRepository.php';

if (!isset($_GET['id'])) {
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
    header("Location: index_product.php"); // redirect ke kelola product
    exit;
}
?>

<h2>Edit Product</h2>
<form method="POST">
    <label>Nama:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br>
    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']) ?>" required><br>
    <label>Category:</label>
    <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" required><br>
    <label>Status:</label>
    <input type="text" name="status" value="<?= htmlspecialchars($product['status']) ?>" required><br>
    <label>Image Path:</label>
    <input type="text" name="image_path" value="<?= htmlspecialchars($product['image_path']) ?>"><br><br>
    <button type="submit" name="submit">Simpan Perubahan</button>
</form>

<p>
    <a href="index_product.php">Kembali ke Daftar Product</a> |
    <a href="index_user.php">Kelola User</a> |
    <a href="index.php">Dashboard</a>
</p>
