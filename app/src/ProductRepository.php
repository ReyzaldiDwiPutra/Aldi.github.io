<?php
require_once __DIR__.'/Database.php';

class ProductRepository {
    private $db;

    public function __construct(){
        $this->db = (new Database())->pdo;
    }

    public function all(){
        $st = $this->db->query("SELECT * FROM products ORDER BY id DESC");
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id){
        $st = $this->db->prepare("SELECT * FROM products WHERE id=?");
        $st->execute([$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data){
        $st = $this->db->prepare("INSERT INTO products(name, price, category, status, image_path) VALUES(?,?,?,?,?)");
        return $st->execute([
            $data['name'],
            $data['price'],
            $data['category'],
            $data['status'],
            $data['image_path']
        ]);
    }

    public function update($id, $data){
        $st = $this->db->prepare("UPDATE products SET name=?, price=?, category=?, status=?, image_path=? WHERE id=?");
        return $st->execute([
            $data['name'],
            $data['price'],
            $data['category'],
            $data['status'],
            $data['image_path'],
            $id
        ]);
    }

    public function delete($id){
        $st = $this->db->prepare("DELETE FROM products WHERE id=?");
        return $st->execute([$id]);
    }
}
