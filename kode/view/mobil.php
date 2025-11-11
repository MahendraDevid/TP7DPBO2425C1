<?php
    include_once 'class/mobil.php'; 
    $mobil = new Mobil();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];

        if ($action === 'add') {
            $data = [
                'merk' => $_POST['merk'],
                'model' => $_POST['model'],
                'tahun' => $_POST['tahun'],
                'warna' => $_POST['warna'],
                'harga' => $_POST['harga'],
                'stok' => $_POST['stok']
            ];
            $mobil->addMobil($data);
            
            header("Location: ?page=mobil");
            exit;
        }

        if ($action === 'update') {
            $id = $_POST['id_mobil'];
            $data = [
                'merk' => $_POST['merk'],
                'model' => $_POST['model'],
                'tahun' => $_POST['tahun'],
                'warna' => $_POST['warna'],
                'harga' => $_POST['harga'],
                'stok' => $_POST['stok']
            ];
            $mobil->updateMobil($id, $data);
            header("Location: ?page=mobil");
            exit;
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mobil->deleteMobil($id);
        
        header("Location: ?page=mobil");
        exit;
    }
?>

<h3>Daftar Mobil</h3>

<!-- Tombol Tambah -->
<button id="openAddModal">+ Tambah Mobil</button>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Merk</th>
        <th>Model</th>
        <th>Tahun</th>
        <th>Warna</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($mobil->getAllMobil() as $m): ?>
    <tr>
        <td><?= $m['id_mobil'] ?></td>
        <td><?= $m['merk'] ?></td>
        <td><?= $m['model'] ?></td>
        <td><?= $m['tahun'] ?></td>
        <td><?= $m['warna'] ?></td>
        <td><?= $m['harga'] ?></td>
        <td><?= $m['stok'] ?></td>
        <td>
            <button 
                class="editBtn"
                data-id="<?= $m['id_mobil'] ?>"
                data-merk="<?= $m['merk'] ?>"
                data-model="<?= $m['model'] ?>"
                data-tahun="<?= $m['tahun'] ?>"
                data-warna="<?= $m['warna'] ?>"
                data-harga="<?= $m['harga'] ?>"
                data-stok="<?= $m['stok'] ?>"
            >Edit</button>
            <button onclick="if(confirm('Are you sure you want to delete this item?')) { window.location.href='?page=mobil&delete=<?= $m['id_mobil'] ?>'; }" class="btn-delete">Hapus</button>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<!-- modal tambah -->
<div id="addModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeAdd">&times;</span>
    <h3>Tambah Mobil</h3>
    <form action="" method="POST">
      <input type="hidden" name="action" value="add">

      <label>Merk:</label><br>
      <input type="text" name="merk" required><br>

      <label>Model:</label><br>
      <input type="text" name="model" required><br>

      <label>Tahun:</label><br>
      <input type="date" name="tahun" required><br>

      <label>Warna:</label><br>
      <input type="text" name="warna" required><br>

      <label>Harga:</label><br>
      <input type="number" name="harga" required><br>

      <label>Stok:</label><br>
      <input type="number" name="stok" required><br><br>

      <input type="submit" value="Simpan">
    </form>
  </div>
</div>

<!-- modal edit -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeEdit">&times;</span>
    <h3>Edit Mobil</h3>
    <form action="" method="POST">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="id_mobil" id="edit_id">

      <label>Merk:</label><br>
      <input type="text" name="merk" id="edit_merk" required><br>

      <label>Model:</label><br>
      <input type="text" name="model" id="edit_model" required><br>

      <label>Tahun:</label><br>
      <input type="date" name="tahun" id="edit_tahun" required><br>

      <label>Warna:</label><br>
      <input type="text" name="warna" id="edit_warna" required><br>

      <label>Harga:</label><br>
      <input type="number" name="harga" id="edit_harga" required><br>

      <label>Stok:</label><br>
      <input type="number" name="stok" id="edit_stok" required><br><br>

      <input type="submit" value="Perbarui">
    </form>
  </div>
</div>

<!-- =================== SCRIPT =================== -->
<script>
const addModal = document.getElementById("addModal");
const editModal = document.getElementById("editModal");
const openAdd = document.getElementById("openAddModal");
const closeAdd = document.getElementById("closeAdd");
const closeEdit = document.getElementById("closeEdit");
const editButtons = document.querySelectorAll(".editBtn");

openAdd.onclick = () => addModal.style.display = "block";
closeAdd.onclick = () => addModal.style.display = "none";
closeEdit.onclick = () => editModal.style.display = "none";

window.onclick = (e) => {
  if (e.target == addModal) addModal.style.display = "none";
  if (e.target == editModal) editModal.style.display = "none";
};

editButtons.forEach(btn => {
  btn.addEventListener("click", () => {
    document.getElementById("edit_id").value = btn.dataset.id;
    document.getElementById("edit_merk").value = btn.dataset.merk;
    document.getElementById("edit_model").value = btn.dataset.model;
    document.getElementById("edit_tahun").value = btn.dataset.tahun;
    document.getElementById("edit_warna").value = btn.dataset.warna;
    document.getElementById("edit_harga").value = btn.dataset.harga;
    document.getElementById("edit_stok").value = btn.dataset.stok;
    editModal.style.display = "block";
  });
});
</script>
