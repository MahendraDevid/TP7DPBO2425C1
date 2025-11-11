<?php
    include_once 'class/transaksi.php'; 
    $transaksi = new Transaksi();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];

        if ($action === 'add') {
            $data = [
                'id_mobil' => $_POST['id_mobil'],
                'id_pelanggan' => $_POST['id_pelanggan'],
                'tanggal_transaksi' => $_POST['tanggal_transaksi'],
                'jumlah' => $_POST['jumlah'],
                'total_harga' => $_POST['total_harga'],
                'metode_pembayaran' => $_POST['metode_pembayaran']
            ];
            $transaksi->addTransaksi($data);
            
            header("Location: ?page=transaksi");
            exit;
        }

        if ($action === 'update') {
            $id = $_POST['id_transaksi'];
            $data = [
                'id_mobil' => $_POST['id_mobil'],
                'id_pelanggan' => $_POST['id_pelanggan'],
                'tanggal_transaksi' => $_POST['tanggal_transaksi'],
                'jumlah' => $_POST['jumlah'],
                'total_harga' => $_POST['total_harga'],
                'metode_pembayaran' => $_POST['metode_pembayaran']
            ];
            $transaksi->updateTransaksi($id, $data);
            header("Location: ?page=transaksi");
            exit;
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $transaksi->deleteTransaksi($id);
        
        header("Location: ?page=transaksi");
        exit;
    }
    
    include_once 'class/mobil.php';
    include_once 'class/pelanggan.php';

    $mobil = new Mobil();
    $pelanggan = new Pelanggan();

    $daftarMobil = $mobil->getAllMobil();
    $daftarPelanggan = $pelanggan->getAllPelanggan();


?>


<h3>Daftar Transaksi</h3>

<button id="openAddModal">+ Tambah Transaksi</button>

<table border="1">
        <tr>
        <th>ID</th>
        <th>Pelanggan</th>         
        <th>Mobil</th>         
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Total Harga</th>
        <th>Metode Pembayaran</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($transaksi->getAllTransaksi() as $t): ?>
    <tr>
        <td><?= $t['id_transaksi'] ?></td>
        <td><?= $t['nama_pelanggan'] ?></td>
        <td><?= $t['merk'] . ' ' . $t['model'] ?></td>  
        <td><?= $t['tanggal_transaksi'] ?></td>
        <td><?= $t['jumlah'] ?></td>
        <td><?= $t['total_harga'] ?></td>
        <td><?= $t['metode_pembayaran'] ?></td>
        <td>
            <button 
                class="editBtn"
                data-id="<?= $t['id_transaksi'] ?>"
                data-pelanggan="<?= $t['id_pelanggan'] ?>"
                data-mobil="<?= $t['id_mobil'] ?>"
                data-tanggal="<?= $t['tanggal_transaksi'] ?>"
                data-jumlah="<?= $t['jumlah'] ?>"
                data-total="<?= $t['total_harga'] ?>"
                data-metode="<?= $t['metode_pembayaran'] ?>"
            >Edit</button>
            <button onclick="if(confirm('Are you sure you want to delete this item?')) { window.location.href='?page=transaksi&delete=<?= $t['id_transaksi'] ?>'; }" class="btn-delete">Hapus</button>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div id="addModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeAdd">&times;</span>
    <h3>Tambah Transaksi</h3>
    <form action="" method="POST">
      <input type="hidden" name="action" value="add">
      
      <label>Pelanggan:</label><br>
      <select name="id_pelanggan" required>
        <option value="">-- Pilih Pelanggan --</option>
        <?php foreach ($daftarPelanggan as $p): ?>
            <option value="<?= $p['id_pelanggan'] ?>"><?= $p['nama'] ?></option>
        <?php endforeach; ?>
      </select><br>

      <label>Mobil:</label><br>
      <select name="id_mobil" id="add_mobil" required>
        <option value="">-- Pilih Mobil --</option>
        <?php foreach ($daftarMobil as $m): ?>
            <option value="<?= $m['id_mobil'] ?>" data-harga="<?= $m['harga'] ?>">
                <?= $m['merk'] . ' ' . $m['model'] ?>
            </option>
        <?php endforeach; ?>
      </select><br>

      <label>Tanggal Transaksi:</label><br>
      <input type="date" name="tanggal_transaksi" required><br>

      <label>Jumlah:</label><br>
      <input type="number" name="jumlah" id="add_jumlah" required><br>

      <label>Total Harga:</label><br>
      <input type="number" name="total_harga" id="add_total" required readonly><br>

      <label>Metode Pembayaran:</label><br>
      <input type="text" name="metode_pembayaran" required><br><br>

      <input type="submit" value="Simpan">
    </form>
  </div>
</div>

<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeEdit">&times;</span>
    <h3>Edit Transaksi</h3>
    <form action="" method="POST">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id_transaksi" id="edit_id">

        <label>Pelanggan:</label><br>
        <select name="id_pelanggan" id="edit_pelanggan" required>
        <option value="">-- Pilih Pelanggan --</option>
        <?php foreach ($daftarPelanggan as $p): ?>
            <option value="<?= $p['id_pelanggan'] ?>"><?= $p['nama'] ?></option>
        <?php endforeach; ?>
        </select><br>

        <label>Mobil:</label><br>
        <select name="id_mobil" id="edit_mobil" required>
        <option value="">-- Pilih Mobil --</option>
        <?php foreach ($daftarMobil as $m): ?>
            <option value="<?= $m['id_mobil'] ?>" data-harga="<?= $m['harga'] ?>">
                <?= $m['merk'] . ' ' . $m['model'] ?>
            </option>
        <?php endforeach; ?>
        </select><br>

        <label>Tanggal Transaksi:</label><br>
        <input type="date" name="tanggal_transaksi" id="edit_tanggal" required><br>

        <label>Jumlah:</label><br>
        <input type="number" name="jumlah" id="edit_jumlah" required><br>

        <label>Total Harga:</label><br>
        <input type="number" name="total_harga" id="edit_total" required readonly><br>

        <label>Metode Pembayaran:</label><br>
        <input type="text" name="metode_pembayaran" id="edit_metode" required><br><br>

        <input type="submit" value="Perbarui">
    </form>
  </div>
</div>

<script>
const addModal = document.getElementById("addModal");
const editModal = document.getElementById("editModal");
const openAdd = document.getElementById("openAddModal");
const closeAdd = document.getElementById("closeAdd");
const closeEdit = document.getElementById("closeEdit");
const editButtons = document.querySelectorAll(".editBtn");

const addMobilSelect = document.getElementById("add_mobil");
const addJumlahInput = document.getElementById("add_jumlah");
const addTotalInput = document.getElementById("add_total");

const editMobilSelect = document.getElementById("edit_mobil");
const editJumlahInput = document.getElementById("edit_jumlah");
const editTotalInput = document.getElementById("edit_total");

function hitungTotal(mobilSelect, jumlahInput, totalInput) {
    const selectedOption = mobilSelect.options[mobilSelect.selectedIndex];
    const harga = parseFloat(selectedOption.dataset.harga) || 0;
    const jumlah = parseFloat(jumlahInput.value) || 0;
    totalInput.value = harga * jumlah;
}

openAdd.onclick = () => addModal.style.display = "block";
closeAdd.onclick = () => addModal.style.display = "none";
closeEdit.onclick = () => editModal.style.display = "none";

window.onclick = (e) => {
    if (e.target == addModal) addModal.style.display = "none";
    if (e.target == editModal) editModal.style.display = "none";
};

addMobilSelect.addEventListener("change", () => {
    hitungTotal(addMobilSelect, addJumlahInput, addTotalInput);
});
addJumlahInput.addEventListener("input", () => {
    hitungTotal(addMobilSelect, addJumlahInput, addTotalInput);
});

editMobilSelect.addEventListener("change", () => {
    hitungTotal(editMobilSelect, editJumlahInput, editTotalInput);
});
editJumlahInput.addEventListener("input", () => {
    hitungTotal(editMobilSelect, editJumlahInput, editTotalInput);
});

editButtons.forEach(btn => {
    btn.addEventListener("click", () => {
        document.getElementById("edit_id").value = btn.dataset.id;
        document.getElementById("edit_pelanggan").value = btn.dataset.pelanggan;
        document.getElementById("edit_mobil").value = btn.dataset.mobil;
        document.getElementById("edit_tanggal").value = btn.dataset.tanggal;
        document.getElementById("edit_jumlah").value = btn.dataset.jumlah;
        document.getElementById("edit_total").value = btn.dataset.total;
        document.getElementById("edit_metode").value = btn.dataset.metode;
        editModal.style.display = "block";
        
        hitungTotal(editMobilSelect, editJumlahInput, editTotalInput);
    });
});
</script>