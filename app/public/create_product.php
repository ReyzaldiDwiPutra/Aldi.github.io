<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../src/ProductRepository.php';

$product = new ProductRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $status = $_POST['status'];

    // --- Upload Gambar ---
    $image_path = null;

    if (!empty($_FILES['image']['name'])) {
        $folder = "uploads/";
        $filename = time() . "_" . basename($_FILES['image']['name']);
        $target_dir = __DIR__ . "/" . $folder;

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $target_file = $target_dir . $filename;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $folder . $filename;
        }
    }

    $product->create([
        'name' => $name,
        'price' => $price,
        'category' => $category,
        'status' => $status,
        'image_path' => $image_path
    ]);

    header("Location: index_product.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
    <h2>Tambah Product</h2>

    <form action="create_product.php" method="POST" enctype="multipart/form-data">
        <label>Nama Product:</label>
        <input type="text" name="name" required>

        <label>Harga Product:</label>
        <input type="number" name="price" required>

        <label>Kategori:</label>
        <input type="text" name="category" required>

        <label>Status:</label>
        <select name="status">
            <option value="ready">Ready</option>
            <option value="soldout">Sold Out</option>
        </select>

        <label>Pilih Gambar Product:</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit" class="btn btn-save">Simpan</button>
        <a href="index_product.php" class="btn btn-back">Kembali</a>
    </form>
</div>

</body>
</html>
