<?php
session_start();
require_once __DIR__ . '/../admin/connect.php';

// Cek apakah user sudah login dan ada dalam session
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

// Mendapatkan data role untuk user yang sedang login
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM user JOIN roles ON user.role_id = roles.role_id WHERE user.user_id = '$user_id'";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();
    // Jika nama role bukan admin atau bukan penjual maka dialihkan ke ../index.php
    if ($data['name'] != 'admin' && $data['name'] != 'penjual') {
        header("Location: ../index.php");
        exit;
    }
} else {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<!-- Sidebar -->
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Riwayat Pembelian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Produk</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Produk</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDataModal">
                    Tambah Data
                </button>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Email Pengguna</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Menggunakan query SQL untuk menampilkan data produk dan join ke tabel user
                    $query_produk = "SELECT * FROM produk LEFT JOIN user ON produk.user_id = user.user_id";
                    $result_produk = $conn->query($query_produk);

                    if ($result_produk && $result_produk->num_rows > 0) {
                        while ($data_produk = $result_produk->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $data_produk['email'] ?></td>
                            <td><?= $data_produk['nama'] ?></td>
                            <td><?= $data_produk['harga'] ?></td>
                            <td><?= $data_produk['stok'] ?></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editDataModal<?= $data_produk['produk_id'] ?>">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusDataModal<?= $data_produk['produk_id'] ?>">Hapus</button>
                            </td>
                        </tr>
                        <!-- Modal ubah data -->
                        <div class="modal fade" id="editDataModal<?= $data_produk['produk_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editDataModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editDataModalLabel">Ubah Data Produk</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="produk/ubah.php">
                                        <div class="modal-body">
                                            <input type="hidden" name="produk_id" value="<?= $data_produk['produk_id'] ?>">
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input required type="text" class="form-control" id="nama" name="nama" value="<?= $data_produk['nama'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input required type="number" class="form-control" id="harga" name="harga" value="<?= $data_produk['harga'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="stok">Stok</label>
                                                <input required type="number" class="form-control" id="stok" name="stok" value="<?= $data_produk['stok'] ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Hapus Data -->
                        <div class="modal fade" id="hapusDataModal<?= $data_produk['produk_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusDataModalLabel<?= $data_produk['produk_id'] ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="hapusDataModalLabel<?= $data_produk['produk_id'] ?>">Konfirmasi Penghapusan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus data produk ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <a href="produk/hapus.php?id=<?= $data_produk['produk_id'] ?>" class="btn btn-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    } else {
                        echo "Tidak ada produk yang ditemukan.";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Modal tambah data -->
<div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataModalLabel">Tambah Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="produk/tambah.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input required type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input required type="number" class="form-control" id="harga" name="harga">
                    </div>
                    <div class="form-group">
                        <label for="stok">Stok</label>
                        <input required type="number" class="form-control" id="stok" name="stok">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
