<?php
// Koneksi ke database jika diperlukan
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
    <title>Halaman Utama</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://i.pinimg.com/736x/24/c9/34/24c934bca17da43d4bd158ab7749827a.jpg" rel="stylesheet">
    <style>
        body {
            background-image: url('https://i.pinimg.com/736x/12/1e/c4/121ec46b9aa46b85196326968313095f.jpg'); /* Pastikan file background tersedia */
            background-size: 30;/*mengatur ukuran gambar 30% dari elemen gambar*/
            background-position: center;
            background-attachment: fixed;
            color: #fff;
        }
        .main-content {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 30px;
            margin: 50px auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5);
            max-width: 800px;
        }
        h1, p {
            color: #fff;
        }
        .btn-custom {
            margin: 10px 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-content text-center">
            <h1>Selamat Datang di Sistem Absensi Acara</h1>
            <p>Silakan pilih salah satu menu di bawah ini untuk melanjutkan.</p>

            <div class="mt-4">
                <!-- Tombol Navigasi -->
                <a href="pendaftaraan.php" class="btn btn-primary btn-custom">Formulir Pendaftaran</a>
                <a href="menampilakandata.php" class="btn btn-success btn-custom">Daftar Kehadiran</a>
                <a href="tb_acara.php" class="btn btn-info btn-custom">Tentang Acara</a>
                <a href="contact.php" class="btn btn-warning btn-custom">Hubungi Kami</a>
            </div>
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