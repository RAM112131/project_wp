<?php
include 'koneksi.php';

// Fetch jalur data
$sql_jalur = "SELECT * FROM jalur";
$result_jalur = $koneksi->query($sql_jalur);

$jalur_data = [];
if ($result_jalur->num_rows > 0) {
    while ($row = $result_jalur->fetch_assoc()) {
        $jalur_data[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jalur Pendakian - Gunung Ciremai</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./css/jalur_pendakian.css">
    <style>
        /* Add basic styling for the new elements if needed, or integrate into your existing CSS */
        .difficulty-badge.easy { background-color: #4CAF50; }
        .difficulty-badge.medium { background-color: #FFC107; }
        .difficulty-badge.hard { background-color: #F44336; }
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
                <a href="#" class="nav-item">Info Gunung</a>
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
                    <span class="mountain-icon">🏔️</span>
                    Informasi Gunung Ciremai
                </h1>
                <p class="page-subtitle">Perdalam Wawasan dan Pengetahuan Anda Mengenai Gunung Ciremai</p>
            </div>

            <div class="tab-navigation">
                <button class="tab-btn">
                    <span>📍</span>
                    Tentang Gunung
                </button>
                <button class="tab-btn">
                    <span>🌋</span>
                    Vulkanologi & Geologi
                </button>
                <button class="tab-btn active">
                    <span>🥾</span>
                    Jalur Pendakian
                </button>
                <button class="tab-btn">
                    <span>🌿</span>
                    Keanekaragaman Hayati
                </button>
            </div>

            <div class="content-section">
                <div class="section-header">
                    <h2 class="section-title">
                        <span class="section-icon">🥾</span>
                        Jalur Pendakian
                    </h2>
                </div>

                <div class="content-card">
                    <?php foreach ($jalur_data as $jalur): ?>
                        <div class="trail-card">
                            <div class="trail-info">
                                <div class="trail-header">
                                    <h3 class="trail-title">Jalur <?php echo $jalur['nama_jalur']; ?></h3>
                                    <span class="difficulty-badge <?php echo strtolower(str_replace(' ', '', $jalur['level_kesulitan'])); ?>">
                                        <?php echo $jalur['level_kesulitan']; ?>
                                    </span>
                                </div>

                                <div class="trail-details">
                                    <div class="detail-item">
                                        <strong>Lokasi:</strong> <?php echo $jalur['lokasi']; ?>
                                    </div>
                                    <div class="detail-item">
                                        <strong>Waktu:</strong> <?php echo $jalur['waktu_tempuh']; ?> ke puncak
                                    </div>
                                    <div class="detail-item">
                                        <strong>Karakteristik:</strong> <?php echo $jalur['karakteristik']; ?>
                                    </div>
                                    <div class="detail-item">
                                        <strong>Rekomendasi:</strong> <?php echo $jalur['rekomendasi']; ?>
                                    </div>
                                </div>

                                <div class="trail-buttons">
                                    <a href="booking.php?id_jalur=<?php echo $jalur['id_jalur']; ?>" class="btn-booking">
                                        <span class="btn-icon">📅</span>
                                        Booking Sekarang
                                    </a>
                                    <button class="btn-maps">
                                        <span class="btn-icon">🗺️</span>
                                        Maps
                                    </button>
                                </div>
                            </div>

                            <div class="trail-image">
                                <div class="image-placeholder">
                                    <p class="image-text">Foto Tiap Pos di Jalur <?php echo $jalur['nama_jalur']; ?></p>
                                    <p class="image-subtext">Foto Jalur bisa di scroll horizontal</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="info-box">
                        <h3>📋 Informasi Penting</h3>
                        <ul>
                            <li><strong>Cuaca:</strong> Suhu di puncak berkisar 5-15°C, bawa jaket tebal</li>
                            <li><strong>Perizinan:</strong> Wajib registrasi di pos masuk masing-masing jalur</li>
                            <li><strong>Guide:</strong> Disarankan menggunakan guide lokal untuk keamanan</li>
                            <li><strong>Waktu Terbaik:</strong> April-Oktober (musim kemarau)</li>
                            <li><strong>Peralatan:</strong> Carrier, sleeping bag, kompor portable, headlamp</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p class="footer-text">&copy; 2025 Judul Website. All rights reserved</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabBtns = document.querySelectorAll('.tab-btn');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    tabBtns.forEach(tab => tab.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            const mapsBtns = document.querySelectorAll('.btn-maps');
            mapsBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    alert('Membuka peta jalur pendakian...');
                });
            });
        });
    </script>
</body>
</html>
<?php
$koneksi->close();
?>