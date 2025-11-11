<?php
    include_once 'class/pelanggan.php'; 
    $pelanggan = new Pelanggan();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];

        if ($action === 'add') {
            $data = [
                'nama' => $_POST['nama'],
                'alamat' => $_POST['alamat'],
                'no_telepon' => $_POST['no_telepon'],
                'email' => $_POST['email']
            ];
            $pelanggan->addPelanggan($data);
            
            header("Location: ?page=pelanggan");
            exit;
        }

        if ($action === 'update') {
            $id = $_POST['id_pelanggan'];
            $data = [
                'nama' => $_POST['nama'],
                'alamat' => $_POST['alamat'],
                'no_telepon' => $_POST['no_telepon'],
                'email' => $_POST['email']
            ];
            $pelanggan->updatePelanggan($id, $data);
            header("Location: ?page=pelanggan");
            exit;
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $pelanggan->deletePelanggan($id);
        
        header("Location: ?page=pelanggan");
        exit;
    }
?>

<h3>Data Pelanggan</h3>
<button id="openAddModal">+ Tambah Pelanggan</button>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No. HP</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($pelanggan->getAllPelanggan() as $p): ?>
    <tr>
        <td><?= $p['id_pelanggan'] ?></td>
        <td><?= $p['nama'] ?></td>
        <td><?= $p['alamat'] ?></td>
        <td><?= $p['no_telepon'] ?></td>
        <td><?= $p['email'] ?></td>
        <td>
            <button 
                class="editBtn"
                data-id="<?= $p['id_pelanggan'] ?>"
                data-nama="<?= $p['nama'] ?>"
                data-alamat="<?= $p['alamat'] ?>"
                data-no_telepon="<?= $p['no_telepon'] ?>"
                data-email="<?= $p['email'] ?>"
            >Edit</button>
            <button onclick="if(confirm('Are you sure you want to delete this item?')) { window.location.href='?page=pelanggan&delete=<?= $p['id_pelanggan'] ?>'; }" class="btn-delete">Hapus</button>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<div id="addModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeAdd">&times;</span>
    <h3>Tambah Pelanggan</h3>
    <form action="" method="POST">
      <input type="hidden" name="action" value="add">

      <label>Nama:</label><br>
      <input type="text" name="nama" required><br>

      <label>Alamat:</label><br>
      <textarea name="alamat" required></textarea><br>

      <label>No. HP:</label><br>
      <input type="text" name="no_telepon" required><br>

      <label>Email:</label><br>
      <input type="email" name="email" required><br>

      <input type="submit" value="Simpan">
    </form>
  </div>
</div>

<div id="editModal" class="modal">
  <div class="modal-content">
    <span class="close" id="closeEdit">&times;</span>
    <h3>Edit Pelanggan</h3>
    <form action="" method="POST">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="id_pelanggan" id="edit_id">

      <label>Nama:</label><br>
      <input type="text" name="nama" id="edit_nama" required><br>

      <label>Alamat:</label><br>
      <input type="text" name="alamat" id="edit_alamat" required><br>

      <label>No. HP:</label><br>
      <input type="text" name="no_telepon" id="edit_no_telepon" required><br>

      <label>Email:</label><br>
      <input type="text" name="email" id="edit_email" required><br>

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
    document.getElementById("edit_nama").value = btn.dataset.nama;
    document.getElementById("edit_alamat").value = btn.dataset.alamat;
    document.getElementById("edit_no_telepon").value = btn.dataset.no_telepon;
    document.getElementById("edit_email").value = btn.dataset.email;
    editModal.style.display = "block";
  });
});
</script>
