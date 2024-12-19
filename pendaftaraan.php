<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = getenv('DB_PASSWORD'); 
$dbname = "dbuasweb";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Acara Organisasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-3">Pendaftaran Acara Organisasi</h1>
        <p class="text-center">Silakan isi form di bawah untuk mendaftarkan acara organisasi Anda:</p>

        <form action="proses_pendaftaran_organisasi.php" method="post">
            <div class="mb-3">
                <label for="nama_organisasi" class="form-label">Nama Organisasi:</label>
                <input type="text" class="form-control" id="nama_organisasi" name="nama_organisasi" required>
            </div>
            <div class="mb-3">
                <label for="nama_ketua" class="form-label">Nama Ketua:</label>
                <input type="text" class="form-control" id="nama_ketua" name="nama_ketua" required>
            </div>
            <div class="mb-3">
                <label for="email_ketua" class="form-label">Email Ketua:</label>
                <input type="email" class="form-control" id="email_ketua" name="email_ketua" required>
            </div>
            <div class="mb-3">
                <label for="nomor_telepon" class="form-label">Nomor Telepon:</label>
                <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <textarea class="form-control" id="alamat" name="alamat"></textarea>
            </div>
            <div class="mb-3">
                <label for="nama_acara" class="form-label">Nama Acara:</label>
                <input type="text" class="form-control" id="nama_acara" name="nama_acara" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_acara" class="form-label">Tanggal Acara:</label>
                <input type="date" class="form-control" id="tanggal_acara" name="tanggal_acara" required>
            </div>
            <div class="mb-3">
                <label for="metode_pembayaran" class="form-label">Metode Pembayaran:</label>
                <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                    <option value="Transfer">Transfer</option>
                    <option value="Tunai">Tunai</option>
                    <option value="Kartu Kredit">Kartu Kredit</option>
                    <option value="OVO">OVO</option>
                    <option value="GoPay">GoPay</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran:</label>
                <input type="number" class="form-control" id="jumlah_pembayaran" name="jumlah_pembayaran" required>
            </div>
            <button type="submit" class="btn btn-primary">Daftar</button>
            <div class="text-center mt-4">
            <a href="halamanutama.php" class="halamanutama.php">Kembali ke Beranda</a>
        </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>