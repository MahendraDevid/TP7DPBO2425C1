<?php
require_once __DIR__ . '/../config/db.php';

class Pelanggan {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllPelanggan() {
        $stmt = $this->db->query("SELECT * FROM pelanggan");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPelanggan($data) {
        $stmt = $this->db->prepare("INSERT INTO pelanggan (nama, alamat, no_telepon, email) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$data['nama'], $data['alamat'], $data['no_telepon'], $data['email']]);
    }

    public function updatePelanggan($id, $data) {
        $stmt = $this->db->prepare("UPDATE pelanggan SET nama = ?, alamat = ?, no_telepon = ?, email = ? WHERE id_pelanggan = ?");
        return $stmt->execute([$data['nama'], $data['alamat'], $data['no_telepon'], $data['email'], $id]);
    }

    public function deletePelanggan($id) {
        $stmt = $this->db->prepare("DELETE FROM pelanggan WHERE id_pelanggan = ?");
        return $stmt->execute([$id]);
    }
};

?>