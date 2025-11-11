# Janji
Saya Mahendra Devid Putra Anwar mengerjakan evaluasi Tugas Praktikum 7 dalam mata kuliah Desain Pemrograman Berbasis Objek untuk keberkahan-Nya, maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Tema Website
Tema website yang saya gunakan ada Dealship Mobil Management yang dimana website ini mengelola mobil, pelanggan dan trasansaksi agar memudahkan dalam mengelola usaha dealship mobil.

# Penjelasan Database

**Diagram ERD**

<img width="906" height="507" alt="image" src="https://github.com/user-attachments/assets/34c82af1-dfef-4f24-bb62-bbd616d0b327" />

**Table Mobil**
1. Id_Mobil : Untuk menyimpan id mobil, dan idnya sudah auto increment
2. Merk : Merk dari mobil tersebut
3. Model : Model dari mobil
4. Tahun : Untuk tahun produksi mobil
5. Warna : Warna Mobil
6. Harga : Harga Dari mobil
7. Stok : Stok persediaan Mobil

**Table Pelanggan**
1. Id_pelanggan : untuk menyimpan id pelanggan, sudah auto increment
2. Nama : nama dari pelanggan
3. Alamat : alamat dari pelanggan
4. No_telepon : no telepon pelanggan
5. Email : email pelanggan

**Table Transaksi**
1. id_transaksi : untuk menyimpan id transaksi, sudah auto increment
2. id_mobil : mengambil data mobil yang dipesan
3. id_pelanggan : mengambil data pelanggan yang memesan
4. tanggal_transaksi : tanggal transaksi
5. jumlah : jumlah yang dibeli
6. total_harga : total harga dari jumlah yang dibeli dan harga mobil
7. Metode_pembayaran : metode pembayaran yang digunakan

# Penjelasan Alur Program
1. Halaman Utama (index.php)
- Menampilkan navigasi ke menu **Mobil**, **Pelanggan**, dan **Transaksi**.
- Meng-include *header*, *footer*, dan konten halaman (tampilan) sesuai nilai `$_GET['page']`.

2. CRUD Mobil
- **Create:** Form tambah mobil baru (merk, model, tahun, harga, stok) yang tampil dalam *modal pop-up*.
- **Read:** Menampilkan tabel berisi semua data mobil yang ada di database.
- **Update:** Form edit data mobil yang juga tampil dalam *modal pop-up*.
- **Delete:** Tombol hapus data mobil untuk setiap baris di tabel.

3. CRUD Pelanggan

- **Create:** Form tambah pelanggan baru (nama, alamat, telepon, email) dalam *modal pop-up*.
- **Read:** Menampilkan tabel berisi semua data pelanggan.
- **Update:** Form edit data pelanggan dalam *modal pop-up*.
- **Delete:** Tombol hapus data pelanggan untuk setiap baris.

4. CRUD Transaksi

- **Create:** Form tambah transaksi baru dalam *modal pop-up*.
    - Memilih pelanggan dari *dropdown* (data diambil dari tabel pelanggan).
    - Memilih mobil dari *dropdown* (data diambil dari tabel mobil).
    - **Total Harga** dihitung dan diisi secara otomatis oleh JavaScript (Harga Mobil x Jumlah).
- **Read:** Menampilkan tabel riwayat semua transaksi.
    * Nama pelanggan dan nama mobil ditampilkan (menggunakan `JOIN` SQL), bukan hanya ID.
- **Update:** Form edit data transaksi dalam *modal pop-up*.
- **Delete:** Tombol hapus data transaksi untuk setiap baris.

# Dokumentasi
https://github.com/user-attachments/assets/13c5cfce-4bec-40a7-8ad0-120930bab584

