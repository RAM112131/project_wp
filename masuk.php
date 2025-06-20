<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login ke Portal Pendakian Gunung Ciremai">
    <title>Masuk - Ciremai Nikreuh</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    
    <style>
        /* Gaya khusus untuk halaman login */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .kotak-login {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo-halaman {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin: 0 auto 20px;
        }

        .judul-halaman {
            color: #333;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .subjudul-halaman {
            color: #666;
            margin-bottom: 30px;
        }

        .kotak-input {
            position: relative;
            margin-bottom: 20px;
        }

        .kotak-input input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
        }

        .kotak-input input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .ikon-input {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 18px;
        }

        .tombol-masuk {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .tombol-masuk:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .link-daftar {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .link-daftar:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .tombol-kembali {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .tombol-kembali:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
        }

        .kotak-centang {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .kotak-centang input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #667eea;
        }

        .teks-lupa-sandi {
            text-align: right;
            margin-bottom: 20px;
        }

        .link-lupa-sandi {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }

        .link-lupa-sandi:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .kotak-login {
                margin: 20px;
                padding: 30px 20px;
            }
            
            .tombol-kembali {
                position: relative;
                top: auto;
                left: auto;
                margin-bottom: 20px;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Tombol Kembali -->
    <a href="0dashboard.html" class="tombol-kembali">
        <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
    </a>

    <!-- Kotak Login Utama -->
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="kotak-login p-4 p-md-5">
                    <!-- Logo dan Judul -->
                    <div class="text-center">
                        <div class="logo-halaman">
                            <i class="bi bi-mountain"></i>
                        </div>
                        <h2 class="judul-halaman">Selamat Datang Kembali</h2>
                        <p class="subjudul-halaman">Masuk ke akun Ciremai Nikreuh Anda</p>
                    </div>

                    <!-- Form Login -->
                    <form id="formLogin" action="#" method="POST">
                        <!-- Email atau Username -->
                        <div class="kotak-input">
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                placeholder="Email atau Username"
                                required
                            >
                            <i class="bi bi-person ikon-input"></i>
                        </div>

                        <!-- Password -->
                        <div class="kotak-input">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Password"
                                required
                            >
                            <i class="bi bi-lock ikon-input" id="ikonPassword" onclick="tampilkanPassword()"></i>
                        </div>

                        <!-- Ingat Saya dan Lupa Password -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="kotak-centang">
                                <input type="checkbox" id="ingatSaya" name="ingatSaya">
                                <label for="ingatSaya" class="mb-0">Ingat saya</label>
                            </div>
                            <a href="#" class="link-lupa-sandi">Lupa password?</a>
                        </div>

                        <!-- Tombol Login -->
                        <button type="submit" class="btn tombol-masuk">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Masuk Sekarang
                        </button>

                        <!-- Link Daftar -->
                        <div class="text-center">
                            <p class="mb-0">
                                Belum punya akun? 
                                <a href="daftar.html" class="link-daftar">Daftar di sini</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <script>
        // Fungsi untuk menampilkan/menyembunyikan password
        function tampilkanPassword() {
            const inputPassword = document.getElementById('password');
            const ikonPassword = document.getElementById('ikonPassword');
            
            if (inputPassword.type === 'password') {
                inputPassword.type = 'text';
                ikonPassword.className = 'bi bi-eye-slash ikon-input';
            } else {
                inputPassword.type = 'password';
                ikonPassword.className = 'bi bi-lock ikon-input';
            }
        }

        // Fungsi untuk menangani form login
        document.getElementById('formLogin').addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah form submit secara default
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Validasi sederhana
            if (!email || !password) {
                alert('Mohon isi semua kolom yang diperlukan!');
                return;
            }
            
            // Simulasi proses login
            const tombolMasuk = this.querySelector('.tombol-masuk');
            const teksAsli = tombolMasuk.innerHTML;
            
            // Tampilkan loading
            tombolMasuk.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Sedang masuk...';
            tombolMasuk.disabled = true;
            
            // Simulasi delay login (biasanya ini adalah request ke server)
            setTimeout(function() {
                // Reset tombol
                tombolMasuk.innerHTML = teksAsli;
                tombolMasuk.disabled = false;
                
                // Simulasi login berhasil
                alert('Login berhasil! Selamat datang di Ciremai Nikreuh.');
                
                // Redirect ke dashboard (dalam implementasi nyata)
                window.location.href = '0dashboard.html';
            }, 2000);
        });

        // Fungsi untuk efek visual saat input difokus
        document.querySelectorAll('.kotak-input input').forEach(function(input) {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Animasi loading saat halaman dimuat
        window.addEventListener('load', function() {
            document.querySelector('.kotak-login').style.animation = 'fadeInUp 0.6s ease-out';
        });
    </script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</body>
</html> 