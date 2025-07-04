<?php
session_start(); // Pastikan session_start() ada di paling atas setiap file yang menggunakan session

$site_title = "Ciremai Nikreuh";
$navigation_items = [
    'Info Gunung' => '1info_gunung.php',
    'Booking' => '3booking.php',
    'Panduan' => '4panduan.php',
    'Blog' => '5.blog.php',
    'Komunitas' => '6komunitas.php',
    'Kontak' => '7kontak.php'
];
$weather_data = [
    'location' => 'Jalur Apuy',
    'temperature' => '20°C',
    'condition' => 'Cerah Berawan',
    'humidity' => '66%',
    'wind_speed' => '3km/h',
    'visibility' => '8km',
    'rain_chance' => '16%'
];
$stats_data = [
    ['icon' => 'mountain', 'value' => '3078 MDPL', 'label' => 'Ketinggian'],
    ['icon' => 'route', 'value' => '5', 'label' => 'Jalur Resmi'],
    ['icon' => 'users', 'value' => '10K+', 'label' => 'Pendaki/Tahun'],
    ['icon' => 'star', 'value' => '4.8', 'label' => 'Rating']
];

function render_header($site_title, $navigation_items) {
    echo '<header id="main-header" class="header-container">';
    echo '<nav class="navbar-main">';
    echo '<div class="logo-container"><div class="logo-icon">CN</div><span class="logo-text">' . $site_title . '</span></div>';
    echo '<ul class="nav-menu">';
    foreach($navigation_items as $name => $link) {
        echo '<li><a href="' . $link . '" class="nav-link">' . $name . '</a></li>';
    }
    echo '</ul>';
    
    // Logika Kondisional untuk tombol login/daftar atau nama pengguna
    echo '<div class="nav-buttons">';
    if (isset($_SESSION['username'])) { // Cek apakah sesi 'username' ada (berarti pengguna sudah login)
        $display_name = $_SESSION['nama_lengkap'] ?? $_SESSION['username']; // Prioritaskan nama_lengkap, fallback ke username
        echo '<span class="logged-in-user">Halo, ' . htmlspecialchars($display_name) . '!</span>';
        // Tombol Logout DIHILANGKAN sesuai permintaan
    } else {
        // Jika belum login, tampilkan tombol Masuk dan Daftar
        echo '<a href="masuk.php" class="btn-masuk">Masuk</a>';
        echo '<a href="daftar.php" class="btn-daftar">Daftar</a>';
    }
    echo '</div>';
    
    echo '</nav>';
    echo '</header>';
}

function render_hero_section($weather_data) {
    echo '<section class="hero-section container">';
    echo '<div class="row align-items-center">';

    // Kolom kiri: Teks
    echo '<div class="col-md-8">';
    echo '<div class="hero-text">';
    echo '<h1 class="hero-title">Jelajahi Keindahan</h1>';
    echo '<h2 class="hero-subtitle">Gunung Ciremai</h2>';
    echo '<p class="hero-description">';
    echo 'Panduan lengkap pendakian dan eksplorasi gunung ciremai. ';
    echo 'Portal terpercaya untuk mendapatkan informasi mendaki, booking ';
    echo 'online, panduan lengkap, dan informasi terkini tentang ';
    echo 'petualangan di gunung tertinggi di Jawa Barat.';
    echo '</p>';
    echo '<div class="hero-buttons">';
    echo '<a href="3booking.php" class="btn-booking">📅 Booking Sekarang</a>';
    echo '<a href="1info_gunung.php" class="btn-info">ℹ️ Info Lengkap</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    // Kolom kanan: Info Cuaca
    echo '<div class="col-md-4">';
    render_weather_card($weather_data);
    echo '</div>';

    echo '</div>';
    echo '</section>';
}


function render_weather_card($data) {
    echo '<div class="weather-card"><h3 class="weather-title">Info Cuaca</h3>';
    echo '<div class="weather-location">' . $data['location'] . '</div>';
    echo '<div class="weather-temp">' . $data['temperature'] . '</div>';
    echo '<div class="weather-condition">☀️ ' . $data['condition'] . '</div>';
    echo '<div class="weather-details">';
    echo '<div class="weather-item"><span class="weather-label">Kelembapan:</span><span class="weather-value">' . $data['humidity'] . '</span></div>';
    echo '<div class="weather-item"><span class="weather-label">Angin:</span><span class="weather-value">' . $data['wind_speed'] . '</span></div>';
    echo '<div class="weather-item"><span class="weather-label">Visibilitas:</span><span class="weather-value">' . $data['visibility'] . '</span></div>';
    echo '<div class="weather-item"><span class="weather-label">Curah Hujan:</span><span class="weather-value">' . $data['rain_chance'] . '</span></div>';
    echo '</div></div>';
}

function render_stats_section($stats) {
    echo '<div class="stats-container">';
    foreach($stats as $stat) {
        echo '<div class="stats-card">';
        $icons = ['mountain' => '⛰️', 'route' => '🛤️', 'users' => '👥', 'star' => '⭐'];
        echo '<div class="stats-icon">' . $icons[$stat['icon']] . '</div>';
        echo '<div class="stats-value">' . $stat['value'] . '</div>';
        echo '<div class="stats-label">' . $stat['label'] . '</div>';
        echo '</div>';
    }
    echo '</div>';
}

function render_footer() {
    echo '<footer class="footer-section"><p class="footer-text">© 2025 Jelajahi Website. All rights reserved.</p></footer>';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Portal Pendakian Gunung Ciremai - Booking online, panduan lengkap, dan informasi terkini" />
    <title><?php echo $site_title; ?> - Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style_dasboard.css?v=1.2">
    <style>
        /* Gaya untuk teks nama pengguna yang login */
        .logged-in-user {
            color: #28a745; /* Warna hijau, bisa disesuaikan */
            font-weight: 600;
            /* Sesuaikan ukuran font dan padding agar proporsional dengan header lainnya */
            font-size: 1.15rem; /* Contoh: sedikit lebih besar */
            white-space: nowrap;
            padding: 0.6rem 0; /* Padding vertikal agar teks sejajar dengan tombol */
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2); /* Menambah sedikit bayangan untuk visibilitas */
        }
        /* Pastikan .nav-buttons memiliki gap yang tepat */
        .nav-buttons {
            display: flex;
            align-items: center;
            gap: 1rem; /* Memberi jarak antar elemen di dalam nav-buttons (jika ada lebih dari satu) */
        }
        /* Gaya tombol yang ada (btn-masuk, btn-daftar) */
        .btn-masuk, .btn-daftar {
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            font-weight: 500;
            text-decoration: none; /* Penting agar tidak ada underline */
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <?php render_header($site_title, $navigation_items); ?>
        <main class="main-content">
            <?php render_hero_section($weather_data); ?>
            <div class="content-container container">
                <section class="statistics-section mt-4">
                    <?php render_stats_section($stats_data); ?>
                </section>
            </div>
        </main>

        <?php render_footer(); ?>
    </div>

    <script>
        window.addEventListener('scroll', () => {
            const header = document.getElementById('main-header');
            header.classList.toggle('header-scrolled', window.pageYOffset > 100);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>