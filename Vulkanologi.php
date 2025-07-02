<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Gunung Ciremai</title>
    <link rel="stylesheet" href="./css/info_gunung.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="main-header">
        <div class="header-content container">
            <div class="logo">
                <i class="fas fa-mountain logo-icon"></i>
                <span class="logo-text">Ciremai Nikreuh</span> </div>
            <nav class="main-nav">
                <a href="#" class="nav-link nav-item">Info Gunung</a>
                <a href="#" class="nav-link nav-item">Booking</a>
                <a href="#" class="nav-link nav-item">Panduan</a>
                <a href="#" class="nav-link nav-item">Blog</a>
                <a href="#" class="nav-link nav-item">Komunitas</a>
                <a href="#" class="nav-link nav-item">Kontak</a>
            </nav>
            <div class="auth-buttons">
                <button class="btn-login auth-btn">Masuk</button>
                <button class="btn-register auth-btn">Daftar</button>
            </div>
        </div>
    </header>

    <main class="main-content slide-2" id="slide2">
        <div class="container">
            <div class="info-header">
                <i class="fas fa-mountain icon-mountain"></i>
                <h1>Informasi Gunung Ciremai</h1>
                <p class="subtitle">Perdalam Wawasan dan Pengetahuan Anda Mengenai Gunung Ciremai</p>
            </div>

            <div class="info-tags">
                <span class="tag active" onclick="showSlide(2)"><i class="fas fa-mountain"></i> Tentang Gunung</span>
                <span class="tag" onclick="showSlide(3)"><i class="fas fa-fire"></i> Vulkanologi & Geologi</span>
                <span class="tag" onclick="showSlide(4)"><i class="fas fa-route"></i> Jalur Pendakian</span>
                <span class="tag" onclick="showSlide(5)"><i class="fas fa-leaf"></i> Keanekaragaman Hayati</span>
            </div>

            <div class="info-cards">
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>Tentang Gunung Ciremai</h3>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <main class="main-content slide-3" id="slide3" style="display: none;">
        <div class="container">
            <div class="info-header">
                <i class="fas fa-mountain icon-mountain"></i>
                <h1>Informasi Gunung Ciremai</h1>
                <p class="subtitle">Perdalam Wawasan dan Pengetahuan Anda Mengenai Gunung Ciremai</p>
            </div>

            <div class="info-tags">
                <span class="tag" onclick="showSlide(2)"><i class="fas fa-mountain"></i> Tentang Gunung</span>
                <span class="tag active" onclick="showSlide(3)"><i class="fas fa-fire"></i> Vulkanologi & Geologi</span>
                <span class="tag" onclick="showSlide(4)"><i class="fas fa-route"></i> Jalur Pendakian</span>
                <span class="tag" onclick="showSlide(5)"><i class="fas fa-leaf"></i> Keanekaragaman Hayati</span>
            </div>

            <div class="vulkanologi-section info-card"> <div class="section-header card-header"> <i class="fas fa-fire"></i>
                    <h2>Vulkanologi & Geologi</h2>
                </div>

                <div class="volcano-info card-grid"> <div class="volcano-card card-item"> <h3>Sejarah Vulkanisme</h3>
                        <p>Gunung Ciremai merupakan hasil vulkanisme generasi ketiga yang telah aktif sejak masa Holosen. Proses pembentukan gunung ini dimulai sekitar 7.000 tahun yang lalu dengan aktivitas erupsi yang membentuk bentuk kerucut yang khas hingga saat ini.</p>
                    </div>

                    <div class="volcano-card card-item"> <h3>Riwayat Letusan</h3>
                        <p>Catatan sejarah letusan pertama yang tercatat terjadi pada tahun 1772-1775. Sejak itu, beberapa letusan kecil telah tercatat hingga saat ini.</p>
                    </div>
                </div>

                <div class="timeline-section">
                    <h3 class="card-header-title">Timeline Aktivitas Vulkanik</h3> <div class="timeline">
                        <div class="timeline-item detail-item"> <div class="timeline-year">1772-1805</div>
                            <div class="timeline-content">
                                <p>Erupsi bersejarah terbesar tercatat (1772-1775). Aktivitas vulkanik kecil sporadis hingga awal abad ke-19.</p>
                            </div>
                        </div>

                        <div class="timeline-item detail-item"> <div class="timeline-year">1817-1824</div>
                            <div class="timeline-content">
                                <p>Letusan yang terkonsentrasi pada kawahnya yang ditandai dengan asap tebal.</p>
                            </div>
                        </div>

                        <div class="timeline-item detail-item"> <div class="timeline-year">1851-1936</div>
                            <div class="timeline-content">
                                <p>Beberapa erupsi kecil dan periode kawah pusat yang relatif tenang dibandingkan periode sebelumnya.</p>
                            </div>
                        </div>

                        <div class="timeline-item detail-item"> <div class="timeline-year">1947-2001</div>
                            <div class="timeline-content">
                                <p>Periode relatif tenang dengan hanya aktivitas fumarol kecil dari kawah Gunung Ciremai.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="geology-features card-grid"> <div class="feature-card card-item"> <h4>Komposisi Batuan</h4>
                        <p>Sebagian besar tersusun dari batuan andesit dengan kandungan silika tinggi yang terbentuk dari aktivitas vulkanik.</p>
                    </div>

                    <div class="feature-card card-item"> <h4>Aktivitas Geotermal</h4>
                        <p>Terdapat sumber air panas di lereng selatan gunung yang merupakan indikasi aktivitas magma di bawah permukaan.</p>
                    </div>

                    <div class="feature-card card-item"> <h4>Struktur Kawah</h4>
                        <p>Memiliki dua kawah aktif - kawah barat dengan radius 400m dan kawah timur dengan radius 600m.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <main class="main-content slide-4" id="slide4" style="display: none;">
        <div class="container">
            <div class="info-header">
                <i class="fas fa-route icon-mountain"></i>
                <h1>Informasi Gunung Ciremai</h1>
                <p class="subtitle">Jalur Pendakian Gunung Ciremai</p>
            </div>
            <div class="info-tags">
                <span class="tag" onclick="showSlide(2)"><i class="fas fa-mountain"></i> Tentang Gunung</span>
                <span class="tag" onclick="showSlide(3)"><i class="fas fa-fire"></i> Vulkanologi & Geologi</span>
                <span class="tag active" onclick="showSlide(4)"><i class="fas fa-route"></i> Jalur Pendakian</span>
                <span class="tag" onclick="showSlide(5)"><i class="fas fa-leaf"></i> Keanekaragaman Hayati</span>
            </div>
            <div class="info-cards">
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-info-circle"></i>
                        <h3>Informasi Jalur Pendakian</h3>
                    </div>
                    <p>Konten untuk Jalur Pendakian akan ditambahkan di sini.</p>
                </div>
            </div>
        </div>
    </main>

    <main class="main-content slide-5" id="slide5" style="display: none;">
        <div class="container">
            <div class="info-header">
                <i class="fas fa-leaf icon-mountain"></i>
                <h1>Informasi Gunung Ciremai</h1>
                <p class="subtitle">Keanekaragaman Hayati Gunung Ciremai</p>
            </div>
            <div class="info-tags">
                <span class="tag" onclick="showSlide(2)"><i class="fas fa-mountain"></i> Tentang Gunung</span>
                <span class="tag" onclick="showSlide(3)"><i class="fas fa-fire"></i> Vulkanologi & Geologi</span>
                <span class="tag" onclick="showSlide(4)"><i class="fas fa-route"></i> Jalur Pendakian</span>
                <span class="tag active" onclick="showSlide(5)"><i class="fas fa-leaf"></i> Keanekaragaman Hayati</span>
            </div>
            <div class="info-cards">
                <div class="info-card">
                    <div class="card-header">
                        <i class="fas fa-info-circle"></i>
                        <h3>Informasi Keanekaragaman Hayati</h3>
                    </div>
                    <p>Konten untuk Keanekaragaman Hayati akan ditambahkan di sini.</p>
                </div>
            </div>
        </div>
    </main>


    <script>
        // Simple navigation between slides
        function showSlide(slideNumber) {
            document.querySelectorAll('.main-content').forEach(slide => {
                slide.style.display = 'none';
            });
            document.getElementById('slide' + slideNumber).style.display = 'block';

            // Update active tag
            document.querySelectorAll('.info-tags .tag').forEach(tag => {
                tag.classList.remove('active');
            });
            // Find the tag corresponding to the slideNumber and add 'active' class
            // Adjust index as tags are 0-indexed in querySelectorAll but slides start from 2
            const tags = document.querySelectorAll('.info-tags .tag');
            if (slideNumber >= 2 && slideNumber <= tags.length + 1) { 
                tags[slideNumber - 2].classList.add('active');
            }
        }
        
        // Show slide 2 by default
        showSlide(2);
    </script>
</body>
</html>