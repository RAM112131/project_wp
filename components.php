<?php
// components.php

// Definisi Judul Situs
$site_title = "Alas Jiwa"; // Ganti dengan nama situs yang sesuai

// Definisi Item Navigasi
// Kunci => Teks yang ditampilkan, Nilai => URL file PHP
$navigation_items = [
    'Info Gunung' => '1info_gunung.php',
    'Booking'     => 'booking.php', // Menggunakan 'booking.php' secara konsisten
    'Panduan'     => '4panduan.php', // Ini akan menjadi halaman utama panduan
    'Blog'        => '5.blog.php',   // Pastikan nama file ini benar
    'Komunitas'   => '6komunitas.php',
    'Kontak'      => 'kontak.php'    // Menggunakan 'kontak.php' secara konsisten
];

/**
 * Fungsi untuk merender bagian header situs.
 * Menggunakan struktur HTML yang diminta dengan tag <a> langsung untuk navigasi.
 * Membutuhkan Bootstrap CSS dan Font Awesome CSS di-link di halaman utama.
 *
 * @param string $site_title Judul situs yang akan ditampilkan di logo.
 * @param array $navigation_items Array asosiatif dari item navigasi (teks => url).
 */
function render_header($site_title, $navigation_items) {
    // Mendapatkan nama file halaman saat ini untuk menentukan link aktif
    // Perhatikan bahwa untuk 'panduan_tektok.php', kita perlu logika tambahan
    // jika ingin link 'Panduan' aktif ketika berada di halaman sub-panduan.
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <header class="main-header">
        <div class="header-content container">
            <a href="index.php" class="logo">
                <i class="fas fa-mountain logo-icon"></i> <span class="logo-text"><?php echo htmlspecialchars($site_title); ?></span>
            </a>

            <nav class="main-nav">
                <?php foreach ($navigation_items as $text => $url): ?>
                    <?php
                        // Menentukan apakah link ini adalah halaman yang sedang aktif
                        // Untuk 'Panduan', jika $current_page adalah 'panduan_tektok.php', maka '4panduan.php' juga dianggap aktif.
                        $is_active = (basename($url) === $current_page || ($text === 'Panduan' && $current_page === 'panduan_tektok.php')) ? 'active' : '';
                    ?>
                    <a href="<?php echo htmlspecialchars($url); ?>" class="nav-link <?php echo htmlspecialchars($is_active); ?>">
                        <?php echo htmlspecialchars($text); ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <div class="auth-buttons">
                <a href="masuk.php" class="btn-login auth-btn">Masuk</a>
                <a href="daftar.php" class="btn-register auth-btn">Daftar</a>
            </div>

            <div class="menu-toggle" id="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const mainNav = document.querySelector('.main-nav'); 

            if (menuToggle && mainNav) {
                menuToggle.addEventListener('click', function() {
                    mainNav.classList.toggle('active'); 
                    menuToggle.classList.toggle('active'); 
                });
            }
            const navLinks = document.querySelectorAll('.main-nav .nav-link'); 
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 768) { 
                        mainNav.classList.remove('active');
                        menuToggle.classList.remove('active');
                    }
                });
            });
        });
    </script>
    <?php
}

// Fungsi render_footer() tidak diubah, tetap seperti sebelumnya (dengan UL/LI)
function render_footer() {
    ?>
    <footer class="main-footer">
        <div class="container footer-content">
            <h4>Alas Jiwa</h4>
            <div class="footer-links">
                <ul>
                    <li><a href="1info_gunung.php">Info Gunung</a></li>
                    <li><a href="booking.php">Booking</a></li>       <li><a href="4panduan.php">Panduan</a></li>      <li><a href="5.blog.php">Blog</a></li>
                    <li><a href="6komunitas.php">Komunitas</a></li>
                    <li><a href="kontak.php">Kontak</a></li>         </ul>
            </div>
            <div class="social-media">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <p class="copyright">&copy; <?php echo date("Y"); ?> Ciremai Nikreuh. All rights reserved.</p>
        </div>
    </footer>
    <?php
}
?>