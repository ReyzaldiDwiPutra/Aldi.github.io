<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../src/ProductRepository.php';

$repo = new ProductRepository();
$products = $repo->all();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Daftar Product</h2>

<a class="btn btn-add" href="create_product.php">Tambah Product</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Kategori</th>
        <th>Status</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>

    <?php if (!empty($products)): ?>
        <?php foreach ($products as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['price']) ?></td>
            <td><?= htmlspecialchars($p['category']) ?></td>
            <td><?= htmlspecialchars($p['status']) ?></td>
            <td>
                <?php if (!empty($p['image_path']) && file_exists(__DIR__ . '/' . $p['image_path'])): ?>
                    <img src="<?= $p['image_path'] ?>" alt="<?= htmlspecialchars($p['name']) ?>">
                <?php else: ?>
                    <div class="no-image">(Tidak ada gambar)</div>
                <?php endif; ?>
            </td>
            <td>
                <a class="btn btn-edit" href="edit_product.php?id=<?= $p['id'] ?>">Edit</a>
                <a class="btn btn-delete" href="delete_product.php?id=<?= $p['id'] ?>" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="7" style="text-align:center;">Belum ada product</td></tr>
    <?php endif; ?>
</table>

<div style="margin-top:20px;">
    <a class="btn btn-back" href="index.php">Kembali ke Dashboard</a>
</div>

</body>
</html>
