<?php
require_once 'class/Mobil.php';
require_once 'class/Pelanggan.php';
require_once 'class/Transaksi.php';

$mobil = new Mobil();
$pelanggan = new Pelanggan();
$transaksi = new Transaksi();

if (isset($_POST['beli'])) {
    $transaksi->buatTransaksi($_POST['id_mobil'], $_POST['id_pelanggan']);
}
if (isset($_GET['hapus_transaksi'])) {
    $transaksi->hapusTransaksi($_GET['hapus_transaksi']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dealer Mobil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'view/header.php'; ?>

    <main>
        <h2>Dealer Mobil</h2>
        <nav>
            <a href="?page=mobil">Data Mobil</a> |
            <a href="?page=pelanggan">Data Pelanggan</a> |
            <a href="?page=transaksi">Transaksi</a>
        </nav>

        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            if ($page == 'mobil') include 'view/mobil.php';
            elseif ($page == 'pelanggan') include 'view/pelanggan.php';
            elseif ($page == 'transaksi') include 'view/transaksi.php';
        } else {
            echo "<p>Selamat datang di Dealer Mobil!</p>";
        }
        ?>
    </main>

    <?php include 'view/footer.php'; ?>
</body>
</html>
