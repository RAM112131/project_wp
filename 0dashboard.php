<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal Pendakian Gunung Ciremai - Booking online, panduan lengkap, dan informasi terkini">
    <title>Ciremai Nikreuh - Portal Pendakian Gunung Ciremai</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style_dasboard.css">
</head>
<body>
     <!-- Bagian Atas Website -->
    <header class="navbar navbar-expand-lg navbar-dark fixed-top bagian-atas">
        <div class="container">
            <!-- Logo dan Nama -->
            <a href="0dashboard.html" class="navbar-brand d-flex align-items-center">
                <img src="img/logo_CN.png" alt="logo CN" class="logo-situs">
                <i class="bi bi-mountain fs-3 me-2"></i>
                <span class="nama-situs">Ciremai Nikreuh</span>
            </a>

            <!-- Tombol Menu Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Navigasi -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link link-menu" href="#info">
                            <i class="bi bi-info-circle me-1"></i>Info Gunung
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-menu" href="#jalur">
                            <i class="bi bi-map me-1"></i>Jalur
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-menu" href="#booking">
                            <i class="bi bi-calendar-check me-1"></i>Booking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-menu" href="#panduan">
                            <i class="bi bi-book me-1"></i>Panduan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-menu" href="#blog">
                            <i class="bi bi-journal-text me-1"></i>Blog
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-menu" href="#komunitas">
                            <i class="bi bi-people me-1"></i>Komunitas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-menu" href="#kontak">
                            <i class="bi bi-envelope me-1"></i>Kontak
                        </a>
                    </li>
                </ul>

                <!-- Tombol Login dan Daftar -->
                <div class="d-flex gap-2">
                    <a href="masuk.php" class="btn tombol-masuk">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        <span class="d-none d-sm-inline">Login</span>
                    </a>
                    <a href="daftar.php" class="btn tombol-daftar">
                        <i class="bi bi-person-plus me-1"></i>
                        <span class="d-none d-sm-inline">Daftar</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Isi Utama Website -->
    <main>
        <!-- Bagian Sambutan Utama -->
        <section class="bagian-utama">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 judul-utama">
                            Jelajahi Keindahan <span class="teks-biru">Gunung Ciremai</span>
                        </h1>
                        <p class="lead deskripsi-utama">
                            Portal terpercaya untuk pendakian Gunung Ciremai. Booking online, panduan lengkap, dan informasi terkini untuk petualangan Anda.
                        </p>
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="#booking" class="btn tombol-biru btn-lg">
                                <i class="bi bi-calendar-check me-2"></i>Booking Sekarang
                            </a>
                            <a href="#info" class="btn tombol-outline btn-lg">
                                <i class="bi bi-info-circle me-2"></i>Info Lengkap
                            </a>
                        </div>
                    </div>
                    
                    <!-- Gambar Gunung -->
                    <div class="col-lg-6">
                        <div class="gambar-gunung">
                            <div class="kotak-gunung">
                                <i class="bi bi-mountain"></i>
                                <p class="text-muted mb-0">Gunung Ciremai</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Bagian Angka-Angka Penting -->
        <section class="bagian-statistik">
            <div class="container">
                <div class="row g-4">
                    <div class="col-6 col-md-3">
                        <div class="kartu-statistik text-center">
                            <i class="bi bi-mountain display-6"></i>
                            <h3 class="angka-statistik">3,078m</h3>
                            <p class="label-statistik">Ketinggian</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="kartu-statistik text-center">
                            <i class="bi bi-signpost-2 display-6"></i>
                            <h3 class="angka-statistik">5</h3>
                            <p class="label-statistik">Jalur Pendakian</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="kartu-statistik text-center">
                            <i class="bi bi-people display-6"></i>
                            <h3 class="angka-statistik">10K+</h3>
                            <p class="label-statistik">Pendaki/Tahun</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="kartu-statistik text-center">
                            <i class="bi bi-star-fill display-6"></i>
                            <h3 class="angka-statistik">4.8</h3>
                            <p class="label-statistik">Rating</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Bagian Bawah Website -->
    <footer class="bagian-bawah">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2024 Ciremai Nikreuh. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>