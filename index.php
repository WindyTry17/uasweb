<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = getenv('DB_PASSWORD'); // Mengambil password dari environment variable
$dbname = "dbuasweb";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi Acara</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-3">Sistem Absensi Acara</h1>
        <p class="text-center">Silakan masukkan nama lengkap Anda untuk melakukan absensi.</p>

        <!-- Form Absensi -->
        <form action="index.php" method="POST" class="mx-auto mt-4" style="max-width: 400px;">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan nama Anda" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Absen</button>
        </form>

        <?php
        // Proses penyimpanan data absensi
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['name']) && !empty(trim($_POST['name']))) {
                $name = htmlspecialchars(trim($_POST['name']));
                $time = date('Y-m-d H:i:s');

                // Menggunakan prepared statement untuk keamanan
                $stmt = $conn->prepare("INSERT INTO tb_absensi (name, time) VALUES (?, ?)");
                $stmt->bind_param("ss", $name, $time);

                if ($stmt->execute()) {
                    echo "<div class='alert alert-success mt-4 text-center'>
                            Terima kasih, <b>" . htmlspecialchars($name) . "</b>. Kehadiran Anda telah dicatat pada <b>" . $time . "</b>.
                          </div>";
                } else {
                    echo "<div class='alert alert-danger mt-4 text-center'>
                            Terjadi kesalahan: " . $stmt->error . "
                          </div>";
                }
                $stmt->close();
            } else {
                echo "<div class='alert alert-warning mt-4 text-center'>
                        Nama tidak boleh kosong. Silakan isi form dengan benar.
                      </div>";
                      "<div class'alert alert-warning mt-4 text-center'>
                        Nama Acara tidak boleh kosong.silahkan isi form yang benar.
                        </div";
            }
        }
        ?>

        <!-- Tombol Lihat Kehadiran -->
        <div class="text-center mt-4">
            <a href="menampilakandata.php" class="btn btn-outline-info">Lihat Daftar Kehadiran</a>
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