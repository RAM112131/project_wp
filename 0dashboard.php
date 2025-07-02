<?php
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
    echo '<div class="nav-buttons">';
    echo '<a href="masuk.php" class="btn-masuk">Masuk</a>';
    echo '<a href="daftar.php" class="btn-daftar">Daftar</a>';
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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Font Poppins Google -->
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style_dasboard.css?v=1.2">
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
