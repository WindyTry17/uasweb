<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = getenv('DB_PASSWORD');
$dbname = "dbuasweb";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Proses pengiriman pesan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['nama']) && isset($_POST['email']) && isset($_POST['pesan'])) {
        $nama = htmlspecialchars(trim($_POST['nama']));
        $email = htmlspecialchars(trim($_POST['email']));
        $pesan = htmlspecialchars(trim($_POST['pesan']));
        
        // Menyimpan data ke database
        $stmt = $conn->prepare("INSERT INTO tb_hubungi_kami (nama, email, pesan) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $pesan);

        if ($stmt->execute()) {
            $successMessage = "Terima kasih, pesan Anda telah dikirim!";
        } else {
            $errorMessage = "Terjadi kesalahan, silakan coba lagi.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Sistem Manajemen Acara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Hubungi Kami</h1>
        <p class="text-center">Silakan isi formulir di bawah ini untuk menghubungi kami. Kami akan segera merespons pesan Anda.</p>

        <?php
        if (isset($successMessage)) {
            echo "<div class='alert alert-success'>$successMessage</div>";
        } elseif (isset($errorMessage)) {
            echo "<div class='alert alert-danger'>$errorMessage</div>";
        }
        ?>

        <!-- Form Hubungi Kami -->
        <form action="hubungi_kami.php" method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
            </div>
            <div class="mb-3">
                <label for="pesan" class="form-label">Pesan</label>
                <textarea id="pesan" name="pesan" class="form-control" rows="4" placeholder="Tulis pesan Anda" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
        </form>

        <div class="text-center mt-4">
            <a href="halamanutama.php" class="halamanutama.php">Kembali ke Beranda</a>
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