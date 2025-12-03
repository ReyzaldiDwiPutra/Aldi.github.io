<?php
require_once __DIR__ . '/../src/Database.php';
require_once __DIR__ . '/../src/User.php';  // untuk User
require_once __DIR__ . '/../src/ProductRepository.php'; // untuk Product
$repo=new ProductRepository();
$p=$repo->find($_GET['id']);

$img=$p['image_path'];
if(!empty($_FILES['image']['name'])){
    $img=time().'_'.$_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/".$img);
}

$repo->update($_GET['id'], [$_POST['name'],$_POST['price'],$_POST['category'],$_POST['status'],$img]);
header('Location: index.php');
