<?php
// Pastikan file components.php di-include untuk menggunakan fungsi render_header dan render_footer
include 'components.php'; 

// Jika perlu sesi, tambahkan session_start() di sini
// session_start(); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - <?php echo htmlspecialchars($site_title); ?></title>
    <link rel="stylesheet" href="./css/kontak.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php
    // Memanggil fungsi render_header dari components.php
    // Ini akan otomatis menampilkan navigasi dan tombol auth sesuai definisi
    // di components.php. Link 'Kontak' akan otomatis aktif.
    render_header($site_title, $navigation_items); 
    ?>

    <div class="main-container">
        <div class="page-header">
            <h1>
                <span class="page-header-icon">✉️</span>
                Hubungi Kami
            </h1>
            <p>Kami senang Anda ingin terhubung! Apakah Anda memiliki pertanyaan, ingin merencanakan pendakian, atau sekadar berbagi pengalaman? Tim kami siap membantu.</p>
        </div>

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
                            <p>Jl. Raya Palutungan No. 123, Desa Palutungan,<br>Kuningan, Jawa Barat 45571<br><a href="https://maps.app.goo.gl/YOUR_Maps_LINK_HERE" target="_blank" style="color: #0066ff;">lihat google maps</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lokasi-kami">
                <div class="lokasi-kami-content">
                    <h3>Lokasi Kami</h3>
                    <div class="map-placeholder">
                        [Embed Google Maps Anda di sini]
                    </div>
                </div>
            </div>
        </div>

        <div class="tetap-terhubung">
            <div class="tetap-terhubung-content">
                <h3>Tetap Terhubung Dengan Kami</h3>
                <p>Ikuti kami di media sosial untuk mendapatkan informasi terbaru, tips pendakian, dan inspirasi visual dari keindahan Gunung Ciremai!</p>
                <div class="social-icons">
                    </div>
            </div>
        </div>

        <div class="final-message">
            <div class="final-message-content">
                <h3>Kami Menantikan Pesan Anda!</h3>
                <p>Tim Pendakian Ciremai berdedikasi untuk memberikan pengalaman pendakian terbaik dan teraman bagi Anda. Jangan ragu untuk menjangkau kami dengan pertanyaan atau kebutuhan apa pun. Mari jelajahi keindahan Ciremai bersama!</p>
            </div>
        </div>
    </div>

    <?php
    // Memanggil fungsi render_footer dari components.php
    render_footer();
    ?>

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
            
            // Simulate form submission (Anda bisa mengganti ini dengan AJAX request ke backend PHP)
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