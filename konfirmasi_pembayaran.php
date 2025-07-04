<?php
include 'koneksi.php';

$id_booking = isset($_GET['id_booking']) ? (int)$_GET['id_booking'] : 0;
$booking_info = null;
$metode_pembayaran_data = [];

if ($id_booking > 0) {
    // Fetch booking details
    $stmt_booking = $koneksi->prepare("
        SELECT b.*, j.nama_jalur, p.jenis_porter, p.harga AS porter_harga
        FROM booking b
        JOIN jalur j ON b.id_jalur = j.id_jalur
        LEFT JOIN porter p ON b.id_porter = p.id_porter
        WHERE b.id_booking = ?
    ");
    $stmt_booking->bind_param("i", $id_booking);
    $stmt_booking->execute();
    $result_booking = $stmt_booking->get_result();
    if ($result_booking->num_rows > 0) {
        $booking_info = $result_booking->fetch_assoc();
    }
    $stmt_booking->close();

    // metode pembayaran
    $sql_metode_pembayaran = "SELECT * FROM metode_pembayaran";
    $result_metode_pembayaran = $koneksi->query($sql_metode_pembayaran);
    if ($result_metode_pembayaran->num_rows > 0) {
        while ($row = $result_metode_pembayaran->fetch_assoc()) {
            $metode_pembayaran_data[] = $row;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $id_booking_post = $_POST['id_booking'];

    if ($action === 'bayar_sekarang') {
        $id_metode_pembayaran = $_POST['id_metode_pembayaran'];

        // Update booking status and payment method
        $stmt_update_booking = $koneksi->prepare("UPDATE booking SET id_metode_pembayaran = ?, status_pembayaran = 'Sudah Dibayar' WHERE id_booking = ?");
        $stmt_update_booking->bind_param("ii", $id_metode_pembayaran, $id_booking_post);
        if ($stmt_update_booking->execute()) {
            header("Location: nota_booking.php?id_booking=" . $id_booking_post);
            exit();
        } else {
            echo "Error updating payment status: " . $stmt_update_booking->error;
        }
        $stmt_update_booking->close();
    } elseif ($action === 'batal_booking') {
        // booking dibatalkan
        $stmt_cancel_booking = $koneksi->prepare("UPDATE booking SET status_pembayaran = 'Dibatalkan' WHERE id_booking = ?");
        $stmt_cancel_booking->bind_param("i", $id_booking_post);
        if ($stmt_cancel_booking->execute()) {
            header("Location: jalur_pendakian.php"); 
            exit();
        } else {
            echo "Error canceling booking: " . $stmt_cancel_booking->error;
        }
        $stmt_cancel_booking->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/jalur_pendakian.css">
    <style>
        .confirmation-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 30px auto;
            text-align: center;
        }
        .confirmation-details p {
            font-size: 1.1em;
            margin-bottom: 10px;
        }
        .confirmation-details strong {
            color: #333;
        }
        .payment-method-selection {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .payment-method-selection label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .payment-method-selection select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .action-buttons {
            margin-top: 30px;
            display: flex;
            justify-content: space-around;
            gap: 15px;
        }
        .btn-confirm, .btn-edit, .btn-cancel {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s ease;
            flex-grow: 1;
        }
        .btn-confirm {
            background-color: #007bff;
            color: white;
        }
        .btn-confirm:hover {
            background-color: #0056b3;
        }
        .btn-edit {
            background-color: #ffc107;
            color: #333;
        }
        .btn-edit:hover {
            background-color: #e0a800;
        }
        .btn-cancel {
            background-color: #dc3545;
            color: white;
        }
        .btn-cancel:hover {
            background-color: #c82333;
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
                <a href="index.php" class="nav-item">Info Gunung</a>
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
                    <span class="mountain-icon">💳</span>
                    Konfirmasi Pembayaran
                </h1>
                <p class="page-subtitle">Mohon cek kembali detail booking Anda dan pilih metode pembayaran</p>
            </div>

            <?php if ($booking_info): ?>
                <div class="confirmation-container">
                    <h2>Detail Booking Anda</h2>
                    <div class="confirmation-details">
                        <p><strong>ID Booking:</strong> <?php echo $booking_info['id_booking']; ?></p>
                        <p><strong>Jalur Pendakian:</strong> <?php echo $booking_info['nama_jalur']; ?></p>
                        <p><strong>Nama Ketua:</strong> <?php echo $booking_info['nama_ketua']; ?></p>
                        <p><strong>Jumlah Peserta:</strong> <?php echo $booking_info['jumlah_peserta']; ?></p>
                        
                        <p><strong>Status Pembayaran:</strong> <span style="color: <?php echo ($booking_info['status_pembayaran'] == 'Sudah Dibayar' ? 'green' : ($booking_info['status_pembayaran'] == 'Dibatalkan' ? 'red' : 'orange')); ?>; font-weight: bold;"><?php echo $booking_info['status_pembayaran']; ?></span></p>
                        <p style="font-size: 1.5em; font-weight: bold; color: #28a745;">Total Biaya: Rp <?php echo number_format($booking_info['total_biaya'], 0, ',', '.'); ?></p>
                    </div>

                    <?php if ($booking_info['status_pembayaran'] === 'Menunggu Pembayaran'): ?>
                        <form action="konfirmasi_pembayaran.php" method="POST">
                            <input type="hidden" name="id_booking" value="<?php echo $booking_info['id_booking']; ?>">
                            <div class="payment-method-selection">
                                <label for="id_metode_pembayaran">Pilih Metode Pembayaran:</label>
                                <select id="id_metode_pembayaran" name="id_metode_pembayaran" required>
                                    <?php foreach ($metode_pembayaran_data as $method): ?>
                                        <option value="<?php echo $method['id_metode_pembayaran']; ?>">
                                            <?php echo $method['nama_metode']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="action-buttons">
                                <button type="submit" name="action" value="bayar_sekarang" class="btn-confirm">Bayar Sekarang</button>
                                <button type="submit" name="action" value="batal_booking" class="btn-cancel" onclick="return confirm('Anda yakin ingin membatalkan booking ini?');">Batal Booking</button>
                            </div>
                        </form>
                    <?php else: ?>
                        <p style="margin-top: 20px; font-weight: bold; color: green;">Pembayaran Anda sudah diverifikasi.</p>
                        <div class="action-buttons">
                            <a href="nota_booking.php?id_booking=<?php echo $booking_info['id_booking']; ?>" class="btn-confirm">Lihat Nota Booking</a>
                            <a href="index.php" class="btn-edit">Kembali ke Dashboard</a>
                        </div>
                    <?php endif; ?>

                </div>
            <?php else: ?>
                <p class="text-center">Booking tidak ditemukan.</p>
                <p class="text-center"><a href="index.php">Kembali ke Dashboard</a></p>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p class="footer-text">&copy; 2025 Judul Website. All rights reserved</p>
        </div>
    </footer>
</body>
</html>
<?php
$koneksi->close();
?>