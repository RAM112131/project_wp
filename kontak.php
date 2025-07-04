<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami</title>
    <link rel="stylesheet" href="./css/kontak.css">
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
                <a href="#" class="nav-item active">Panduan</a> <a href="#" class="nav-item">Blog</a>
                <a href="#" class="nav-item">Komunitas</a>
                <a href="#" class="nav-item">Kontak</a>
            </nav>
            <div class="auth-buttons">
                <button class="btn-login">Masuk</button>
                <button class="btn-register">Daftar</button>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <div class="main-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1>
                <span class="page-header-icon">✉️</span>
                Hubungi Kami
            </h1>
            <p>Kami senang Anda ingin terhubung! Apakah Anda memiliki pertanyaan, ingin merencanakan pendakian, atau sekadar berbagi pengalaman? Tim kami siap membantu.</p>
        </div>

        <!-- Contact Form Section -->
        <div class="content-section">
            <div class="contact-form">
                <div class="section-title">Kirim Pesan Kepada Kami</div>
                <form id="contactForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" name="nama" placeholder="Tuliskan Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <input type="email" id="email" name="email" placeholder="Isi alamat email anda..." required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="telepon">Nomor Tlp/WA/Hp</label>
                            <input type="tel" id="telepon" name="telepon" placeholder="Isi nomor Telpon Anda ...">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="subjek">Subject Pesan</label>
                            <select id="subjek" name="subjek" required>
                                <option value="">Pilih Subject Pesan</option>
                                <option value="pertanyaan-umum">Pertanyaan Umum</option>
                                <option value="reservasi-pendakian">Reservasi Pendakian</option>
                                <option value="kerjasama-kemitraan">Kerjasama dan Kemitraan</option>
                                <option value="laporan-masalah">Laporan Masalah Website</option>
                                <option value="lain-lain">Dan Lain-Lain...</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="pesan">Pesan Anda</label>
                            <textarea id="pesan" name="pesan" placeholder="Tulis pesan Anda di sini..." required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">Kirim Pesan</button>
                </form>
            </div>

            <!-- Direct Contact Info -->
            <div class="contact-langsung">
                <div class="contact-langsung-content">
                    <h3>Kontak Langsung</h3>
                    <div class="contact-item">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-details">
                            <h4>Email :</h4>
                            <p><a href="mailto:info@pendakian_ciremai.gmail.com" style="color: #0066ff;">info@pendakian_ciremai.gmail.com</a><br>Respon dalam 1×24 jam</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div class="contact-details">
                            <h4>Telepon/WhatsApp:</h4>
                            <p><a href="tel:+6281234567890" style="color: #0066ff;">+62 812-3456-7890</a><br>Setiap Hari, 09.00 - 17.00 WIB</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div class="contact-details">
                            <h4>Kantor Pusat:</h4>
                            <p>Jl. Raya Palutungan No. 123, Desa Palutungan,<br>Kuningan, Jawa Barat 45571<br><a href="#" style="color: #0066ff;">lihat google maps</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="lokasi-kami">
                <div class="lokasi-kami-content">
                    <h3>Lokasi Kami</h3>
                    <div class="map-placeholder">
                        foo maps lokasi
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="tetap-terhubung">
            <div class="tetap-terhubung-content">
                <h3>Tetap Terhubung Dengan Kami</h3>
                <p>Ikuti kami di media sosial untuk mendapatkan informasi terbaru, tips pendakian, dan inspirasi visual dari keindahan Gunung Ciremai!</p>
            </div>
        </div>

        <!-- Final Message Section -->
        <div class="final-message">
            <div class="final-message-content">
                <h3>Kami Menantikan Pesan Anda!</h3>
                <p>Tim Pendakian Ciremai berdedikasi untuk memberikan pengalaman pendakian terbaik dan teraman bagi Anda. Jangan ragu untuk menjangkau kami dengan pertanyaan atau kebutuhan apa pun. Mari jelajahi keindahan Ciremai bersama!</p>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="copyright">
        © 2025 Judul Website. All rights reserved
    </div>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const data = Object.fromEntries(formData);
            
            // Simple validation
            if (!data.nama || !data.email || !data.subjek || !data.pesan) {
                alert('Mohon lengkapi semua field yang wajib diisi!');
                return;
            }
            
            // Simulate form submission
            alert('Terima kasih! Pesan Anda telah dikirim. Kami akan segera menghubungi Anda dalam 1-2x24 jam.');
            this.reset();
        });

        // Add some interactivity
        document.querySelectorAll('input, textarea, select').forEach(element => {
            element.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
                this.style.transition = 'transform 0.2s ease';
            });
            
            element.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>