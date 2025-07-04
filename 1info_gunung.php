<?php
// Pastikan components.php di-include terlebih dahulu
include 'components.php';

/**
 * File: 1info_gunung.php
 * Deskripsi: Halaman Informasi Gunung Ciremai
 * Author: Developer
 * Created: 2025
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_title; ?> - Informasi Gunung Ciremai</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OerWvWaRBCkA3bAVzjqWwUaXpGgKqC6b5N1FmQd30z4Xo" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="./css/keanekaragaman.css"> 
    <link rel="stylesheet" href="./css/info_gunung.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="page-wrapper">
        <?php 
        // Memanggil fungsi render_header dari components.php
        render_header($site_title, $navigation_items); 
        ?>

        <main class="main-content container">
            <header class="info-header">
                <i class="fas fa-mountain icon-mountain"></i>
                <h1>Informasi Gunung Ciremai</h1>
                <p class="subtitle">Perdalam Wawasan dan Pengetahuan Anda Mengenai Gunung Ciremai</p>
            </header>

            <nav class="tab-navigation">
                <a href="#tentang-gunung" class="tab-btn active" data-target="tentang-gunung">
                    <i class="fas fa-info-circle"></i> Tentang Gunung
                </a>
                <a href="#vulkanologi-geologi" class="tab-btn" data-target="vulkanologi-geologi">
                    <i class="fas fa-fire"></i> Vulkanologi & Geologi
                </a>
                <a href="#jalur-pendakian" class="tab-btn" data-target="jalur-pendakian">
                    <i class="fas fa-route"></i> Jalur Pendakian
                </a>
                <a href="#keanekaragaman-hayati" class="tab-btn" data-target="keanekaragaman-hayati">
                    <i class="fas fa-leaf"></i> Keanekaragaman Hayati
                </a>
            </nav>

            <div class="content-container">
                <section id="tentang-gunung" class="info-section about-section content-card">
                    <div class="section-header">
                        <i class="fas fa-map-marker-alt section-icon"></i>
                        <h2 class="section-title">Tentang Gunung Ciremai</h2>
                    </div>

                    <div class="card-grid">
                        <div class="card-item">
                            <h3>Lokasi Geografis</h3>
                            <p>Terletak di perbatasan Kabupaten Kuningan dan Majalengka, Jawa Barat. Koordinat: 6° 53' 30" LS dan 108° 24' 00" BT.</p>
                        </div>
                        <div class="card-item">
                            <h3>Tipe Gunung Api</h3>
                            <p>Stratovolcano aktif tipe A dengan kawah ganda. Kawah barat berdiameter sekitar 400 m dan kawah timur sekitar 600 m.</p>
                        </div>
                        <div class="card-item">
                            <h3>Taman Nasional</h3>
                            <p>Merupakan bagian dari Taman Nasional Gunung Ciremai (TNGC) dengan luas total sekitar 15.000 hektar.</p>
                        </div>
                    </div>

                    <div class="detail-grid">
                        <div class="detail-item">
                            <h3>Nama Asal</h3>
                            <p>Berasal dari kata "ciremai" (thymalus acidus), sejenis tumbuhan perdu berbau kecil dengan rasa masam.</p>
                        </div>
                        <div class="detail-item">
                            <h3>Status</h3>
                            <p>Gunung api aktif kuarter, generasi ketiga yang terbentuk sekitar 7.000 tahun lalu.</p>
                        </div>
                        <div class="detail-item">
                            <h3>Karakteristik Unik</h3>
                            <p>Gunung api soliter yang terpisah dari rangkaian gunung api Jawa Barat lainnya.</p>
                        </div>
                        <div class="detail-item">
                            <h3>Goa Walet</h3>
                            <p>Bekas terowongan atau goa alami telah ditemukan di ketinggian 2.900 meter di atas permukaan laut sisi selatan.</p>
                        </div>
                    </div>
                </section>

                <section id="vulkanologi-geologi" class="info-section vulkanologi-section content-card" style="display: none;">
                    <div class="section-header">
                        <i class="fas fa-fire section-icon"></i>
                        <h2 class="section-title">Vulkanologi & Geologi</h2>
                    </div>

                    <div class="volcano-info card-grid">
                        <div class="volcano-card card-item full-width-card">
                            <h3>Sejarah Vulkanisme</h3>
                            <p>Gunung Ciremai merupakan hasil vulkanisme generasi ketiga yang terjadi pada masa Holosen. Proses pembentukan dimulai dari vulkanisme Plio-Plistosen di atas batuan Tersier, dilanjutkan dengan pembentukan Gunung Gegeralang yang kemudian runtuh membentuk Kaldera Gegeralang, dan akhirnya terbentuk Gunung Ciremai di sisi utara kaldera tersebut sekitar 7.000 tahun yang lalu.</p>
                        </div>
                    </div>

                    <div class="timeline-section content-card">
                        <h3 class="section-subtitle">Riwayat Letusan</h3>
                        <div class="timeline">
                            <div class="timeline-item">
                                <div class="timeline-year">1689</div>
                                <div class="timeline-content">
                                    <p>Catatan letusan pertama yang tercatat dalam sejarah.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-year">1772-1805</div>
                                <div class="timeline-content">
                                    <p>Tiga letusan berturut-turut (1772, 1775, 1805) di kawah pusat tanpa kerusakan berarti.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-year">1917-1924</div>
                                <div class="timeline-content">
                                    <p>Letusan uap belerang dan munculnya fumarola baru di dinding kawah pusat.</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-year">1937-1938</div>
                                <div class="timeline-content">
                                    <p>Letusan freatik terakhir di kawah pusat dan celah radial. Sebaran abu mencapai 52.500 km².</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-year">1947-2001</div>
                                <div class="timeline-content">
                                    <p>Periode gempa tektonik yang melanda daerah barat daya Gunung Ciremai.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="geology-features card-grid">
                        <div class="feature-card card-item">
                            <h3>Selang Waktu Letusan</h3>
                            <p>Istirahat terpendek 3 tahun, terpanjang 112 tahun.</p>
                        </div>
                        <div class="feature-card card-item">
                            <h3>Struktur Geologi</h3>
                            <p>Dipisahkan oleh Zona Sesar Cilacap-Kuningan dari kelompok gunung api lainnya.</p>
                        </div>
                        <div class="feature-card card-item">
                            <h3>Aktivitas Seismik</h3>
                            <p>Gempa merusak terjadi tahun 1990 dan 2001 di daerah Meja dan Talaga.</p>
                        </div>
                        <div class="feature-card card-item">
                            <h3>Aktivitas Letusan</h3>
                            <p>Letusan freatik dengan sebaran abu yang luas pada aktivitas terakhir.</p>
                        </div>
                    </div>
                </section>

                <section id="jalur-pendakian" class="info-section jalur-pendakian-section content-card" style="display: none;">
                    <div class="section-header">
                        <i class="fas fa-route section-icon"></i>
                        <h2 class="section-title">Jalur Pendakian</h2>
                    </div>

                    <div class="hiking-trails-grid">
                        <div class="trail-card card-item">
                            <h3>Jalur Apuy</h3>
                            <p class="difficulty">Menengah</p>
                            <ul>
                                <li><strong>Lokasi:</strong> Desa Argamukti, Kecamatan Argapura, Kab. Majalengka</li>
                                <li><strong>Estimasi Waktu:</strong> 6-8 jam ke puncak</li>
                                <li><strong>Karakteristik Trek:</strong> Relatif landai, banyak pos istirahat</li>
                                <li><strong>Cocok untuk:</strong> Pendaki pemula hingga menengah</li>
                            </ul>
                            <div class="trail-gallery">
                                <div class="gallery-inner">
                                    <img src="./img/apuy1.webp" alt="Jalur Apuy Pos 1">
                                    <img src="./img/apuy2.webp" alt="Jalur Apuy Pos 2">
                                    <img src="./img/apuy3.webp" alt="Jalur Apuy Pos 3">
                                </div>
                                <p class="gallery-hint">Geser untuk melihat foto pos lainnya</p>
                            </div>
                            <div class="trail-actions">
                                <a href="#" class="btn btn-booking"><i class="fas fa-calendar-alt"></i> Booking Sekarang</a>
                                <a href="#" class="btn btn-maps"><i class="fas fa-map-marked-alt"></i> Lihat di Maps</a>
                            </div>
                        </div>

                        <div class="trail-card card-item">
                            <h3>Jalur Palutungan</h3>
                            <p class="difficulty">Menengah</p>
                            <ul>
                                <li><strong>Lokasi:</strong> Desa Cisantana, Kecamatan Cigugur, Kabupaten Kuningan</li>
                                <li><strong>Estimasi Waktu:</strong> 7-9 jam ke puncak</li>
                                <li><strong>Karakteristik Trek:</strong> Terdapat sumber mata air, pemandangan indah</li>
                                <li><strong>Cocok untuk:</strong> Pendaki menengah</li>
                            </ul>
                            <div class="trail-gallery">
                                <div class="gallery-inner">
                                    <img src="./img/palutungan1.jpg" alt="Jalur Palutungan Pos 1">
                                    <img src="./img/palutungan2.jpg" alt="Jalur Palutungan Pos 2">
                                </div>
                                <p class="gallery-hint">Geser untuk melihat foto pos lainnya</p>
                            </div>
                            <div class="trail-actions">
                                <a href="#" class="btn btn-booking"><i class="fas fa-calendar-alt"></i> Booking Sekarang</a>
                                <a href="#" class="btn btn-maps"><i class="fas fa-map-marked-alt"></i> Lihat di Maps</a>
                            </div>
                        </div>

                        <div class="trail-card card-item">
                            <h3>Jalur Linggasanan</h3>
                            <p class="difficulty">Menengah</p>
                            <ul>
                                <li><strong>Lokasi:</strong> Desa Linggasanan, Kecamatan Cilimus, Kabupaten Kuningan</li>
                                <li><strong>Estimasi Waktu:</strong> 7-9 jam ke puncak</li>
                                <li><strong>Karakteristik Trek:</strong> Jalur alternatif, lebih sunyi dan alami</li>
                                <li><strong>Cocok untuk:</strong> Pendaki menengah yang mencari ketenangan</li>
                            </ul>
                            <div class="trail-gallery">
                                <div class="gallery-inner">
                                    <img src="./img/linggasaran1.png" alt="Jalur Linggasanan Pos 1">
                                    <img src="./img/linggasaran2.png" alt="Jalur Linggasanan Pos 2">
                                </div>
                                <p class="gallery-hint">Geser untuk melihat foto lainnya</p>
                            </div>
                            <div class="trail-actions">
                                <a href="#" class="btn btn-booking"><i class="fas fa-calendar-alt"></i> Booking Sekarang</a>
                                <a href="#" class="btn btn-maps"><i class="fas fa-map-marked-alt"></i> Lihat di Maps</a>
                            </div>
                        </div>

                        <div class="trail-card card-item">
                            <h3>Jalur Trisakti Sadarehe</h3>
                            <p class="difficulty">Menengah</p>
                            <ul>
                                <li><strong>Lokasi:</strong> Desa Payung, Kecamatan Rajagaluh, Kabupaten Majalengka</li>
                                <li><strong>Estimasi Waktu:</strong> 8-10 jam ke puncak</li>
                                <li><strong>Karakteristik Trek:</strong> Menawarkan pemandangan sunrise & sunset terbaik</li>
                                <li><strong>Titik Tertinggi:</strong> Pos 7 di 2.670 mdpl</li>
                                <li><strong>Cocok untuk:</strong> Pendaki berpengalaman</li>
                            </ul>
                            <div class="trail-gallery">
                                <div class="gallery-inner">
                                    <img src="./img/sadahere1.jpeg" alt="Jalur Trisakti Sadarehe Pos 1">
                                    <img src="./img/sadahere2.jpg" alt="Jalur Trisakti Sadarehe Pos 2">
                                </div>
                                <p class="gallery-hint">Geser untuk melihat foto pos lainnya</p>
                            </div>
                            <div class="trail-actions">
                                <a href="#" class="btn btn-booking"><i class="fas fa-calendar-alt"></i> Booking Sekarang</a>
                                <a href="#" class="btn btn-maps"><i class="fas fa-map-marked-alt"></i> Lihat di Maps</a>
                            </div>
                        </div>

                        <div class="trail-card card-item">
                            <h3>Jalur Linggarjati</h3>
                            <p class="difficulty">Sulit</p>
                            <ul>
                                <li><strong>Lokasi:</strong> Desa Linggarjati, Kecamatan Cilimus, Kabupaten Kuningan</li>
                                <li><strong>Estimasi Waktu:</strong> 8-10 jam ke puncak</li>
                                <li><strong>Karakteristik Trek:</strong> Terjal, menantang, melewati hutan lebat dan tanjakan curam</li>
                                <li><strong>Cocok untuk:</strong> Pendaki berpengalaman dengan fisik prima</li>
                            </ul>
                            <div class="trail-gallery">
                                <div class="gallery-inner">
                                    <img src="./img/linggajati1.jpg" alt="Jalur Linggarjati Pos 1">
                                    <img src="./img/linggajati2.jpg" alt="Jalur Linggarjati Pos 2">
                                </div>
                                <p class="gallery-hint">Geser untuk melihat foto lainnya</p>
                            </div>
                            <div class="trail-actions">
                                <a href="#" class="btn btn-booking"><i class="fas fa-calendar-alt"></i> Booking Sekarang</a>
                                <a href="#" class="btn btn-maps"><i class="fas fa-map-marked-alt"></i> Lihat di Maps</a>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="keanekaragaman-hayati" class="info-section keanekaragaman-section content-card" style="display: none;">
                    <div class="section-header">
                        <i class="fas fa-leaf section-icon"></i>
                        <h2 class="section-title">Keanekaragaman Hayati</h2>
                    </div>

                    <div class="biodiversity-content">
                        <div class="content-subsection">
                            <h3>Vegetasi</h3>
                            <p>Hutan alam di lereng Gunung Ciremai masih berfungsi sangat baik sebagai ekosistem alami. Berdasarkan ketinggian, vegetasi di Gunung Ciremai dapat dibagi menjadi beberapa zona:</p>
                            
                            <h4>1. Hutan Pegunungan Bawah (Submontane Forest)</h4>
                            <p>Ditemukan pada ketinggian sekitar 1.000 - 1.500 mdpl. Zona ini didominasi oleh jenis pohon besar dengan kanopi rapat.</p>
                            <ul>
                                <li><strong>Pohon Utama:</strong> Puspa (<em>Schima walichii</em>), Saninten (<em>Castanea argentea</em>), Kihoho (<em>Engelhardtia roxburghiana</em>), Pasang (<em>Lithocarpus sundaicus</em>).</li>
                                <li><strong>Tumbuhan Bawah & Epifit:</strong> Rasamala (<em>Altingia excelsa</em>), Kibaung (<em>Castanopsis javanica</em>), berbagai jenis Rotan (<em>Calamus spp.</em>), serta Pakis (<em>Cyathea spp.</em>) yang tumbuh subur.</li>
                                <li><strong>Tumbuhan Obat & Langka:</strong> Beberapa spesies tumbuhan obat seperti Jahe hutan (<em>Zingiber officinale</em>) dan Kunyit (<em>Curcuma longa</em>) dapat ditemukan. Juga terdapat spesies langka seperti Anggrek tanah (<em>Paphiopedilum javanicum</em>) dan Kantong semar (<em>Nepenthes gymnamphora</em>).</li>
                            </ul>

                            <h4>2. Hutan Pegunungan Atas (Montane Forest)</h4>
                            <p>Ditemukan pada ketinggian sekitar 1.500 - 2.000 mdpl. Ketinggian ini ditandai dengan perubahan jenis vegetasi yang beradaptasi dengan kondisi iklim yang lebih dingin dan kelembaban tinggi.</p>
                            <ul>
                                <li><strong>Pohon Dominan:</strong> Pinus (<em>Pinus merkusii</em>) dan Cemara gunung (<em>Casuarina junghuhniana</em>).</li>
                                <li><strong>Tumbuhan Khas:</strong> Bunga Edelweis (<em>Anaphalis javanica</em>) yang sering disebut "bunga abadi" dapat ditemukan di area terbuka, serta berbagai jenis lumut yang menutupi pohon dan tanah.</li>
                            </ul>

                            <h4>3. Hutan Lumut (Mossy Forest)</h4>
                            <p>Ditemukan pada ketinggian di atas 2.000 mdpl, mendekati puncak. Zona ini dicirikan oleh kelembaban yang sangat tinggi, membuat pepohonan dan tanah diselimuti lumut tebal.</p>
                        </div>

                        <div class="content-subsection">
                            <h3>Margasatwa</h3>
                            <p>Keanekaragaman margasatwa di Gunung Ciremai sangat tinggi, menjadikannya habitat penting bagi berbagai spesies. Diperkirakan ada lebih dari 100 jenis burung, 20 jenis mamalia, dan 10 jenis reptil dan amfibi yang mendiami area ini.</p>
                            
                            <h4>Mamalia:</h4>
                            <ul>
                                <li><strong>Endemik & Dilindungi:</strong> Macan tutul jawa (<em>Panthera pardus melas</em>), Lutung jawa (<em>Trachypithecus auratus</em>), Trenggiling (<em>Manis javanica</em>), Kukang (<em>Nycticebus coucang</em>).</li>
                                <li><strong>Umum Ditemukan:</strong> Kijang (<em>Muntiacus muntjak</em>), Babi hutan (<em>Sus scrofa</em>), Landak (<em>Hystrix javanica</em>), Musang (<em>Paradoxurus hermaphroditus</em>).</li>
                            </ul>
                            
                            <h4>Burung:</h4>
                            <ul>
                                <li><strong>Elang:</strong> Elang jawa (<em>Nisaetus bartelsi</em>), spesies endemik yang menjadi lambang negara Indonesia.</li>
                                <li><strong>Berbagai Jenis Burung:</strong> Cekakak sungai (<em>Todiramphus chloris</em>), Kacamata gunung (<em>Zosterops montanus</em>), Jalak suren (<em>Gracupica contra</em>), Takur toktok (<em>Megalaima lineata</em>), Trocok (<em>Pycnonotus zeylanicus</em>), Jalak hitam (<em>Sturnus contra</em>), Burung hantu (<em>Bubo sumatranus</em>), dan Walet (<em>Aerodramus fuciphagus</em>).</li>
                            </ul>
                            
                            <h4>Reptil & Amfibi:</h4>
                            <ul>
                                <li><strong>Beberapa Spesies:</strong> Ular hijau (<em>Trimeresurus insularis</em>), Bunglon (<em>Chamaeleo calyptratus</em>), Kadal (<em>Mabuya multifasciata</em>), serta various jenis katak dan kodok.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="gallery-selection-grid">
                        <div class="gallery-option-card">
                            <div class="gallery-inner">
                                <img src="./img/vegetasi_1.png" alt="Galeri Vegetasi 1">
                                <img src="./img/vegetasi_2.png" alt="Galeri Vegetasi 2">
                            </div>
                            <p class="gallery-hint">Geser untuk melihat foto lainnya</p>
                            <h4>Galeri Vegetasi</h4>
                        </div>
                        <div class="gallery-option-card">
                            <div class="gallery-inner">
                                <img src="./img/margasatwa_1.png" alt="Galeri Margasatwa 1">
                                <img src="./img/margasatwa_2.png" alt="Galeri Margasatwa 2">
                            </div>
                            <p class="gallery-hint">Geser untuk melihat foto lainnya</p>
                            <h4>Galeri Margasatwa</h4>
                        </div>
                    </div>
                </section>
            </div>
        </main>

        <?php render_footer(); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
                    const targetId = button.dataset.target; // Mengambil nilai dari atribut data-target
                    document.getElementById(targetId).style.display = 'block';
                });
            });

            // Tampilkan bagian pertama ('Tentang Gunung') secara default saat halaman dimuat
            const initialTabButton = document.querySelector('.tab-btn.active');
            if (initialTabButton) {
                const initialTargetId = initialTabButton.dataset.target;
                document.getElementById(initialTargetId).style.display = 'block';
            }

            // JavaScript untuk scrolling horizontal pada galeri
            document.querySelectorAll('.trail-gallery, .gallery-option-card').forEach(galleryContainer => {
                const galleryInner = galleryContainer.querySelector('.gallery-inner');
                // Ini hanya untuk memastikan elemen ada. Fungsi scrolling horizontal diatur via CSS
            });
        });
    </script>
</body>
</html>