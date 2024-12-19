<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = getenv('DB_PASSWORD'); // Password dari environment variable
$dbname = "dbuasweb";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Hapus data jika parameter delete diberikan
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']); // Validasi input ID
    $sql_delete = "DELETE FROM tb_absensi WHERE id = $id";
    if ($conn->query($sql_delete) === TRUE) {
        $success_message = "Data berhasil dihapus!";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// Ambil data dari database
$sql = "SELECT * FROM tb_absensi ORDER BY time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kehadiran</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-3">Daftar Kehadiran</h1>
        <p class="text-center">Berikut adalah daftar kehadiran peserta acara.</p>

        <!-- Pesan Sukses/Error -->
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?= $success_message; ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger"><?= $error_message; ?></div>
        <?php endif; ?>

        <!-- Tabel Kehadiran -->
        <table class="table table-striped table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Waktu Kehadiran</th>
                    <th>Status Kehadiran</th>
                    <th>Keterangan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        // Menentukan Status Kehadiran secara dinamis
                        $time = strtotime($row['time']);
                        $status = (date('H', $time) < 12) ? 'Hadir Pagi' : 'Hadir Siang';
                        $keterangan = (date('H', $time) < 12) ? 'Tepat Waktu' : 'Terlambat';

                        echo "<tr>
                                <td>{$no}</td>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>{$row['time']}</td>
                                <td>{$status}</td>
                                <td>{$keterangan}</td>
                                <td>
                                    <a href='?delete_id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a>
                                </td>
                              </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Belum ada data kehadiran.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tombol Kembali -->
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-outline-primary">Kembali ke Halaman Absensi</a>
            <a href="halamanutama.php" class="btn-outlinr-primary">Kembali ke Halaman Utama</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Tutup koneksi database
$conn->close();
?>