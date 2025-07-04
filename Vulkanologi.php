<?php
include 'components.php'; // Pastikan ini di-include

// Jika Anda ingin menggunakan judul spesifik untuk halaman ini, Anda bisa override
// $site_title = "Ciremai Nikreuh - Vulkanologi & Geologi"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_title; ?> - Informasi Gunung Ciremai</title>
    <link rel="stylesheet" href="./css/info_gunung.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="page-wrapper">
        <?php render_header($site_title, $navigation_items); ?>

        <main class="main-content container">
            <div class="info-header">
                <i class="fas fa-mountain icon-mountain"></i>
                <h1>Informasi Gunung Ciremai</h1>
                <p class="subtitle">Perdalam Wawasan dan Pengetahuan Anda Mengenai Gunung Ciremai</p>
            </div>

            <nav class="tab-navigation">
                <a href="#tentang-gunung" class="tab-btn" data-target="about-section">
                    <i class="fas fa-info-circle"></i> Tentang Gunung
                </a>
                <a href="#vulkanologi-geologi" class="tab-btn active" data-target="vulkanologi-section">
                    <i class="fas fa-fire"></i> Vulkanologi & Geologi
                </a>
                <a href="#jalur-pendakian" class="tab-btn" data-target="jalur-pendakian-section">
                    <i class="fas fa-route"></i> Jalur Pendakian
                </a>
                <a href="#keanekaragaman-hayati" class="tab-btn" data-target="keanekaragaman-section">
                    <i class="fas fa-leaf"></i> Keanekaragaman Hayati
                </a>
            </nav>

            <div class="content-container">
                <div id="about-section" class="info-section about-section content-card" style="display: none;">
                    <div class="section-header">
                        <i class="fas fa-map-marker-alt section-icon"></i>
                        <h2 class="section-title">Tentang Gunung Ciremai</h2>
                    </div>
                    <div class="card-grid">
                        <div class="card-item">
                            <h4>Lokasi Geografis</h4>
                            <p>Terletak di perbatasan Kabupaten Kuningan dan Majalengka, Jawa Barat. Koordinat: 6° 53' 30" LS dan 108° 24' 00" BT</p>
                        </div>
                        <div class="card-item">
                            <h4>Tipe Gunung Api</h4>
                            <p>Stratovolcano aktif tipe A dengan kawah ganda. Kawah barat berradius 400 m dan kawah timur 600 m</p>
                        </div>
                        <div class="card-item">
                            <h4>Taman Nasional</h4>
                            <p>Bagian dari Taman Nasional Gunung Ciremai (TNGC) dengan luas total sekitar 15.000 hektar</p>
                        </div>
                    </div>
                    <div class="detail-grid">
                        <div class="detail-item">
                            <h4>Nama Asal</h4>
                            <p>Berasal dari kata "ciremai" (thymalus acidus), sejenis tumbuhan perdu berbau kecil dengan rasa masam</p>
                        </div>
                        <div class="detail-item">
                            <h4>Status</h4>
                            <p>Gunung api aktif kuarter, generasi ketiga yang terbentuk sekitar 7.000 tahun lalu</p>
                        </div>
                        <div class="detail-item">
                            <h4>Karakteristik Unik</h4>
                            <p>Gunung api soliter yang terpisah dari rangkaian gunung api Jawa Barat lainnya</p>
                        </div>
                        <div class="detail-item">
                            <h4>Goa Walet</h4>
                            <p>Bekas tikus telah di ketinggian 2.900 meter di atas permukaan laut selatan</p>
                        </div
                    </div>
                </div>

                <div id="vulkanologi-section" class="info-section vulkanologi-section content-card">
                    <div class="section-header">
                        <i class="fas fa-fire section-icon"></i>
                        <h2 class="section-title">Vulkanologi & Geologi</h2>
                    </div>
                    <div class="volcano-info card-grid">
                        <div class="volcano-card card-item">
                            <h3>Sejarah Vulkanisme</h3>
                            <p>Gunung Ciremai merupakan hasil vulkanisme generasi ketiga yang telah aktif sejak masa Holosen. Proses pembentukan gunung ini dimulai sekitar 7.000 tahun yang lalu dengan aktivitas erupsi yang membentuk bentuk kerucut yang khas hingga saat ini.</p>
                        </div>
                        <div class="volcano-card card-item">
                            <h3>Riwayat Letusan</h3>
                            <p>Catatan sejarah letusan pertama yang tercatat terjadi pada tahun 1772-1775. Sejak itu, beberapa letusan kecil telah tercatat hingga saat ini.</p>
                        </div>
                    </div>

                    <div class="timeline-section content-card"> <h3 class="section-subtitle">Timeline Aktivitas Vulkanik</h3> <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-year">1772-1805</div>
                                <div class="timeline-content">
                                    <p>Erupsi bersejarah terbesar tercatat (1772-1775). Aktivitas vulkanik kecil sporadis hingga awal abad ke-19.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-year">1817-1824</div>
                                <div class="timeline-content">
                                    <p>Letusan yang terkonsentrasi pada kawahnya yang ditandai dengan asap tebal.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-year">1851-1936</div>
                                <div class="timeline-content">
                                    <p>Beberapa erupsi kecil dan periode kawah pusat yang relatif tenang dibandingkan periode sebelumnya.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-year">1947-2001</div>
                                <div class="timeline-content">
                                    <p>Periode relatif tenang dengan hanya aktivitas fumarol kecil dari kawah Gunung Ciremai.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="geology-features card-grid">
                        <div class="feature-card card-item">
                            <h4>Komposisi Batuan</h4>
                            <p>Sebagian besar tersusun dari batuan andesit dengan kandungan silika tinggi yang terbentuk dari aktivitas vulkanik.</p>
                        </div>
                        <div class="feature-card card-item">
                            <h4>Aktivitas Geotermal</h4>
                            <p>Terdapat sumber air panas di lereng selatan gunung yang merupakan indikasi aktivitas magma di bawah permukaan.</p>
                        </div>
                        <div class="feature-card card-item">
                            <h4>Struktur Kawah</h4>
                            <p>Memiliki dua kawah aktif - kawah barat dengan radius 400m dan kawah timur dengan radius 600m.</p>
                        </div>
                    </div>
                </div>

                <div id="jalur-pendakian-section" class="info-section jalur-pendakian-section content-card" style="display: none;">
                    <div class="section-header">
                        <i class="fas fa-route section-icon"></i>
                        <h2 class="section-title">Jalur Pendakian</h2>
                    </div>
                    <p>Informasi Jalur Pendakian akan ditempatkan di sini.</p>
                </div>

                <div id="keanekaragaman-section" class="info-section keanekaragaman-section content-card" style="display: none;">
                    <div class="section-header">
                        <i class="fas fa-leaf section-icon"></i>
                        <h2 class="section-title">Keanekaragaman Hayati</h2>
                    </div>
                    <p>Informasi Keanekaragaman Hayati akan ditempatkan di sini.</p>
                </div>
            </div>
        </main>

        <?php render_footer(); ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const infoSections = document.querySelectorAll('.info-section');

            tabButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault(); // Mencegah perilaku default link (scroll ke id)

                    // Hapus kelas 'active' dari semua tombol
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    // Tambahkan kelas 'active' ke tombol yang diklik
                    button.classList.add('active');

                    // Sembunyikan semua bagian info
                    infoSections.forEach(section => section.style.display = 'none');

                    // Tampilkan bagian yang sesuai berdasarkan data-target
                    const targetId = button.dataset.target;
                    document.getElementById(targetId).style.display = 'block';
                });
            });

            // Tampilkan bagian 'Vulkanologi & Geologi' secara default saat halaman dimuat
            // Karena ini adalah halaman vulkanologi, kita ingin tab ini yang aktif saat dimuat.
            const initialTabButton = document.querySelector('.tab-btn.active');
            if (initialTabButton) {
                const initialTargetId = initialTabButton.dataset.target;
                document.getElementById(initialTargetId).style.display = 'block';
            }
        });
    </script>
</body>
</html>