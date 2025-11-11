<?php
require_once __DIR__ . '/../config/db.php';

class Mobil {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllMobil() {
        $stmt = $this->db->query("SELECT * FROM mobil");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMobil($data) {
        $stmt = $this->db->prepare("INSERT INTO mobil (merk, model, tahun, warna, harga, stok) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$data['merk'], $data['model'], $data['tahun'], $data['warna'], $data['harga'], $data['stok']]);
    }

    public function updateMobil($id, $data) {
        $stmt = $this->db->prepare("UPDATE mobil SET merk = ?, model = ?, tahun = ?, warna = ?, harga = ?, stok = ? WHERE id_mobil = ?");
        return $stmt->execute([$data['merk'], $data['model'], $data['tahun'], $data['warna'], $data['harga'], $data['stok'], $id]);
    }

    public function deleteMobil($id) {
        $stmt = $this->db->prepare("DELETE FROM mobil WHERE id_mobil = ?");
        return $stmt->execute([$id]);
    }
};