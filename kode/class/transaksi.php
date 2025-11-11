<?php
require_once __DIR__ . '/../config/db.php';


class Transaksi {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllTransaksi() {
        //query join dengan tabel pelanggan dan mobil
        $stmt = $this->db->query("
            SELECT 
                t.*, 
                p.nama AS nama_pelanggan, 
                m.merk, 
                m.model
            FROM 
                transaksi t
            JOIN 
                pelanggan p ON t.id_pelanggan = p.id_pelanggan
            JOIN 
                mobil m ON t.id_mobil = m.id_mobil
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTransaksi($data) {
        $stmt = $this->db->prepare("INSERT INTO transaksi (id_mobil, id_pelanggan, tanggal_transaksi, jumlah, total_harga, metode_pembayaran) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$data['id_mobil'], $data['id_pelanggan'], $data['tanggal_transaksi'], $data['jumlah'], $data['total_harga'], $data['metode_pembayaran']]);
    }

    public function updateTransaksi($id, $data) {
        $stmt = $this->db->prepare("UPDATE transaksi SET id_mobil = ?, id_pelanggan = ?, tanggal_transaksi = ?, jumlah = ?, total_harga = ?, metode_pembayaran = ? WHERE id_transaksi = ?");
        return $stmt->execute([$data['id_mobil'], $data['id_pelanggan'], $data['tanggal_transaksi'], $data['jumlah'], $data['total_harga'], $data['metode_pembayaran'], $id]);
    }

    public function deleteTransaksi($id) {
        $stmt = $this->db->prepare("DELETE FROM transaksi WHERE id_transaksi = ?");
        return $stmt->execute([$id]);
    }
};

?>