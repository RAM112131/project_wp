<?php
include 'koneksi.php';

$selected_jalur_id = isset($_GET['id_jalur']) ? (int)$_GET['id_jalur'] : 0;
$jalur_info = null;
$porter_data = [];

if ($selected_jalur_id > 0) {
    // menyesuaikan jalur pendakian yang dipilih
    $stmt_jalur = $koneksi->prepare("SELECT * FROM jalur WHERE id_jalur = ?");
    $stmt_jalur->bind_param("i", $selected_jalur_id);
    $stmt_jalur->execute();
    $result_jalur = $stmt_jalur->get_result();
    if ($result_jalur->num_rows > 0) {
        $jalur_info = $result_jalur->fetch_assoc();
    }
    $stmt_jalur->close();

    // mengambil data porter
    $sql_porter = "SELECT * FROM porter";
    $result_porter = $koneksi->query($sql_porter);
    if ($result_porter->num_rows > 0) {
        while ($row = $result_porter->fetch_assoc()) {
            $porter_data[] = $row;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_jalur = $_POST['id_jalur'];
    $status_kewarganegaraan = $_POST['status_kewarganegaraan'];
    $tanggal_pendakian = $_POST['tanggal_pendakian'];
    $jumlah_peserta = $_POST['jumlah_peserta'];
    $jenis_pendakian = $_POST['jenis_pendakian'];
    $id_porter = (isset($_POST['id_porter']) && $jenis_pendakian == 'Camp') ? $_POST['id_porter'] : NULL;
    $nama_ketua = $_POST['nama_ketua'];
    $nomor_telp_wa = $_POST['nomor_telp_wa'];

    // variabel total biaya awal
    $total_biaya = 0;

    // biaya pendakian menurut jalur, jenis pendakian, dan kewarganegaraan
    $stmt_biaya = $koneksi->prepare("SELECT harga FROM biaya_pendakian WHERE id_jalur = ? AND jenis_pendakian = ? AND kewarganegaraan = ?");
    $stmt_biaya->bind_param("iss", $id_jalur, $jenis_pendakian, $status_kewarganegaraan);
    $stmt_biaya->execute();
    $result_biaya = $stmt_biaya->get_result();
    if ($result_biaya->num_rows > 0) {
        $biaya_base = $result_biaya->fetch_assoc()['harga'];
        $total_biaya += ($biaya_base * $jumlah_peserta);
    }
    $stmt_biaya->close();

    // biaya porter jika ada
    if ($id_porter !== NULL) {
        $stmt_porter_harga = $koneksi->prepare("SELECT harga FROM porter WHERE id_porter = ?");
        $stmt_porter_harga->bind_param("i", $id_porter);
        $stmt_porter_harga->execute();
        $result_porter_harga = $stmt_porter_harga->get_result();
        if ($result_porter_harga->num_rows > 0) {
            $porter_harga = $result_porter_harga->fetch_assoc()['harga'];
            $total_biaya += $porter_harga;
        }
        $stmt_porter_harga->close();
    }

    // File Upload (basic encryption for filename)
    $file_persyaratan = null;
    if (isset($_FILES['file_persyaratan']) && $_FILES['file_persyaratan']['error'] == UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES['file_persyaratan']['tmp_name'];
        $original_filename = $_FILES['file_persyaratan']['name'];
        $file_extension = pathinfo($original_filename, PATHINFO_EXTENSION);
        $encrypted_filename = md5(uniqid(rand(), true)) . '.' . $file_extension;
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_persyaratan_path = $upload_dir . $encrypted_filename;

        if (move_uploaded_file($file_tmp_name, $file_persyaratan_path)) {
            $file_persyaratan = $encrypted_filename;
        } else {
            echo "Failed to upload file.";
        }
    }

    // masukan data booking ke database
    $stmt_booking = $koneksi->prepare("INSERT INTO booking (id_jalur, status_kewarganegaraan, tanggal_pendakian, jumlah_peserta, jenis_pendakian, id_porter, nama_ketua, nomor_telp_wa, total_biaya, file_persyaratan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_booking->bind_param("isiiiissds", $id_jalur, $status_kewarganegaraan, $tanggal_pendakian, $jumlah_peserta, $jenis_pendakian, $id_porter, $nama_ketua, $nomor_telp_wa, $total_biaya, $file_persyaratan);

    if ($stmt_booking->execute()) {
        $id_booking = $koneksi->insert_id;

        // masukan data ke tabel detail_booking
        $stmt_detail_booking = $koneksi->prepare("INSERT INTO detail_booking (id_booking, nama_ketua, tanggal_booking, jumlah_peserta, total_bayar) VALUES (?, ?, NOW(), ?, ?)");
        $stmt_detail_booking->bind_param("isid", $id_booking, $nama_ketua, $jumlah_peserta, $total_biaya);
        $stmt_detail_booking->execute();
        $stmt_detail_booking->close();

        header("Location: konfirmasi_pembayaran.php?id_booking=" . $id_booking);
        exit();
    } else {
        echo "Error: " . $stmt_booking->error;
    }
    $stmt_booking->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Pendakian - Gunung Ciremai</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/jalur_pendakian.css"> <style>
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 700px;
            margin: 30px auto;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        .form-group input[type="text"],
        .form-group input[type="date"],
        .form-group input[type="number"],
        .form-group select,
        .form-group input[type="file"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }
        .form-group input[type="radio"] {
            margin-right: 10px;
        }
        .form-actions {
            text-align: right;
            margin-top: 30px;
        }
        .btn-submit {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        .btn-submit:hover {
            background-color: #218838;
        }
        .trail-details-summary {
            background-color: #e9f5e9;
            border: 1px solid #d4edda;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .trail-details-summary h3 {
            margin-top: 0;
            color: #28a745;
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
                    <span class="mountain-icon">📅</span>
                    Form Booking Pendakian
                </h1>
                <p class="page-subtitle">Isi detail booking Anda untuk pendakian Gunung Ciremai</p>
            </div>

            <?php if ($jalur_info): ?>
                <div class="form-container">
                    <div class="trail-details-summary">
                        <h3>Jalur Terpilih: <?php echo $jalur_info['nama_jalur']; ?> (Level: <?php echo $jalur_info['level_kesulitan']; ?>)</h3>
                        <p>Lokasi: <?php echo $jalur_info['lokasi']; ?></p>
                        <p>Waktu Tempuh: <?php echo $jalur_info['waktu_tempuh']; ?></p>
                    </div>

                    <form action="booking.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_jalur" value="<?php echo $jalur_info['id_jalur']; ?>">

                        <div class="form-group">
                            <label for="nama_ketua">Nama Ketua Tim:</label>
                            <input type="text" id="nama_ketua" name="nama_ketua" required>
                        </div>

                        <div class="form-group">
                            <label for="nomor_telp_wa">Nomor Telepon (WhatsApp):</label>
                            <input type="text" id="nomor_telp_wa" name="nomor_telp_wa" required>
                        </div>

                        <div class="form-group">
                            <label for="status_kewarganegaraan">Status Kewarganegaraan:</label>
                            <select id="status_kewarganegaraan" name="status_kewarganegaraan" required>
                                <option value="WNI">WNI</option>
                                <option value="WNA">WNA</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pendakian">Tanggal Pendakian:</label>
                            <input type="date" id="tanggal_pendakian" name="tanggal_pendakian" required min="<?php echo date('Y-m-d'); ?>">
                        </div>

                        <div class="form-group">
                            <label for="jumlah_peserta">Jumlah Peserta (termasuk Ketua Tim):</label>
                            <input type="number" id="jumlah_peserta" name="jumlah_peserta" min="1" required>
                        </div>

                        <div class="form-group">
                            <label>Jenis Pendakian:</label>
                            <input type="radio" id="camp" name="jenis_pendakian" value="Camp" checked onchange="togglePorter()">
                            <label for="camp">Camp</label>
                            <input type="radio" id="tektok" name="jenis_pendakian" value="TekTok" onchange="togglePorter()">
                            <label for="tektok">TekTok</label>
                        </div>

                        <div class="form-group" id="porter_selection">
                            <label for="id_porter">Pilih Porter (khusus Camp):</label>
                            <select id="id_porter" name="id_porter">
                                <option value="">Tidak Menggunakan Porter</option>
                                <?php foreach ($porter_data as $porter): ?>
                                    <option value="<?php echo $porter['id_porter']; ?>">
                                        <?php echo $porter['jenis_porter']; ?> (Rp <?php echo number_format($porter['harga'], 0, ',', '.'); ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="file_persyaratan">Upload File Persyaratan KTP/SIM/identitas lainnya:</label>
                            <input type="file" id="file_persyaratan" name="file_persyaratan" accept=".pdf, .jpg, .jpeg, .png" required>
                            <small>Max file size: 2MB</small>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Lanjutkan Booking</button>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <p class="text-center">Jalur pendakian tidak ditemukan. Silakan kembali ke halaman <a href="index.php">Jalur Pendakian</a>.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p class="footer-text">&copy; 2025 Judul Website. All rights reserved</p>
        </div>
    </footer>

    <script>
        function togglePorter() {
            const jenisPendakian = document.querySelector('input[name="jenis_pendakian"]:checked').value;
            const porterSelection = document.getElementById('porter_selection');
            const idPorterSelect = document.getElementById('id_porter');

            if (jenisPendakian === 'Camp') {
                porterSelection.style.display = 'block';
                idPorterSelect.removeAttribute('disabled');
            } else {
                porterSelection.style.display = 'none';
                idPorterSelect.setAttribute('disabled', 'disabled');
                idPorterSelect.value = ''; 
            }
        }

        document.addEventListener('DOMContentLoaded', togglePorter);
    </script>
</body>
</html>
<?php
$koneksi->close();
?>