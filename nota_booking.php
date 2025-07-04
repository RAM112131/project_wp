<?php
include 'koneksi.php';

$id_booking = isset($_GET['id_booking']) ? (int)$_GET['id_booking'] : 0;
$booking_info = null;

if ($id_booking > 0) {
    $stmt_nota = $koneksi->prepare("
        SELECT b.*, j.nama_jalur, m.nama_metode, p.jenis_porter, p.harga AS porter_harga
        FROM booking b
        JOIN jalur j ON b.id_jalur = j.id_jalur
        LEFT JOIN metode_pembayaran m ON b.id_metode_pembayaran = m.id_metode_pembayaran
        LEFT JOIN porter p ON b.id_porter = p.id_porter
        WHERE b.id_booking = ? AND b.status_pembayaran = 'Sudah Dibayar'
    ");
    $stmt_nota->bind_param("i", $id_booking);
    $stmt_nota->execute();
    $result_nota = $stmt_nota->get_result();
    if ($result_nota->num_rows > 0) {
        $booking_info = $result_nota->fetch_assoc();
    }
    $stmt_nota->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Booking Pendakian</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/jalur_pendakian.css">
    <style>
        .nota-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 30px auto;
            text-align: center;
        }
        .nota-header {
            margin-bottom: 20px;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
        }
        .nota-header h2 {
            color: #28a745;
            margin-bottom: 5px;
        }
        .nota-details p {
            font-size: 1.1em;
            margin-bottom: 10px;
            text-align: left;
            padding-left: 20%;
        }
        .nota-details strong {
            display: inline-block;
            width: 150px;
        }
        .total-amount {
            font-size: 1.8em;
            font-weight: bold;
            color: #007bff;
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
        .download-button {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
            margin-top: 30px;
            display: inline-block;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .download-button:hover {
            background-color: #218838;
        }
        .back-button {
            margin-top: 20px;
            display: block;
            text-decoration: none;
            color: #007bff;
        }
        .back-button:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <span class="logo-icon">🏔️</span>
                <span class="logo-text">Judul Website</span>
            </div>
            <nav class="nav-menu">
                <a href="jalur_pendakian.php" class="nav-item">Info Gunung</a>
                <a href="#" class="nav-item">Booking</a>
                <a href="#" class="nav-item">Panduan</a>
                <a href="#" class="nav-item">Blog</a>
                <a href="#" class="nav-item">Komunitas</a>
                <a href="#" class="nav-item">Kontak</a>
            </nav>
            <div class="auth-buttons">
                <button class="btn-login">Masuk</button>
                <button class="btn-register">Daftar</button>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-title">
                    <span class="mountain-icon">📄</span>
                    Nota Booking Pendakian
                </h1>
                <p class="page-subtitle">Detail booking Anda telah berhasil dibuat dan dibayar.</p>
            </div>

            <?php if ($booking_info): ?>
                <div class="nota-container">
                    <div class="nota-header">
                        <h2>Terima Kasih atas Booking Anda!</h2>
                        <p>Booking ID: #<?php echo $booking_info['id_booking']; ?></p>
                    </div>
                    <div class="nota-details">
                        <p><strong>Nama Ketua:</strong> <?php echo htmlspecialchars($booking_info['nama_ketua']); ?></p>
                        <p><strong>Nomor Telp/WA:</strong> <?php echo htmlspecialchars($booking_info['nomor_telp_wa']); ?></p>
                        <p><strong>Jalur Pendakian:</strong> <?php echo htmlspecialchars($booking_info['nama_jalur']); ?></p>
                        <p><strong>Jumlah Peserta:</strong> <?php echo htmlspecialchars($booking_info['jumlah_peserta']); ?></p>

                        <p><strong>Metode Pembayaran:</strong> <?php echo htmlspecialchars($booking_info['nama_metode']); ?></p>
                        <p class="total-amount">Total Biaya: Rp <?php echo number_format($booking_info['total_biaya'], 0, ',', '.'); ?></p>
                    </div>

                    <a href="#" class="download-button" onclick="downloadNota()">Download Nota PDF</a>
                    <a href="jalur_pendakian.php" class="back-button">Kembali ke Dashboard</a>
                </div>
            <?php else: ?>
                <p class="text-center">Nota booking tidak ditemukan atau pembayaran belum terverifikasi.</p>
                <p class="text-center"><a href="jalur_pendakian.php">Kembali ke Dashboard</a></p>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p class="footer-text">&copy; 2025 Judul Website. All rights reserved</p>
        </div>
    </footer>

    <script>
        function downloadNota() {
            
            alert('Fitur download PDF sedang dalam pengembangan.');
            <?php echo $id_booking; ?>';
        }
    </script>
</body>
</html>
<?php
$koneksi->close();
?>