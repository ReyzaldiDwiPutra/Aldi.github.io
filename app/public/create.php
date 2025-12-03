<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/User.php';  // untuk User
require_once __DIR__ . '/../src/ProductRepository.php'; // untuk Product


$db = new Database();
$user = new User($db->pdo);

if(isset($_POST['submit'])){
    $user->create($_POST['name'], $_POST['email']);
    header("Location: index.php");
    exit;
}
?>

<h2>Tambah User</h2>
<form method="POST">
    <label>Nama:</label>
    <input type="text" name="name" required>
    <br>
    <label>Email:</label>
    <input type="email" name="email" required>
    <br>
    <button name="submit">Tambah</button>
</form>
<a href="index.php">Kembali</a>

<form action="store.php" method="post" enctype="multipart/form-data">
    Nama: <input name="name" required><br><br>

    Harga: <input name="price" type="number" step="0.01" required><br><br>

    Kategori:
    <select name="category" required>
        <option value="A">A</option>
        <option value="B">B</option>
    </select>
    <br><br>

    Status:
    <select name="status" required>
        <option value="active">active</option>
        <option value="inactive">inactive</option>
    </select>
    <br><br>

    Gambar:
    <input type="file" name="image" accept="image/*"><br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="index.php">← Kembali</a>

</body>
</html>
