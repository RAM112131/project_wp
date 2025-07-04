<?php
session_start(); // Pastikan session_start() ada di paling atas, sebelum output HTML apapun!
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create Account - Alas Jiwa</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

  <script src="https://accounts.google.com/gsi/client" async defer></script>

  <link rel="stylesheet" href="./css/daftar.css" />
  <link rel="stylesheet" href="./css/google.register.css" /> 
  
  <style>
    /* Mengatur lebar tombol Create Account agar konsisten */
    .create-btn {
        width: 100%; /* Pastikan tombol mengambil lebar penuh container */
        padding: 12px 20px; /* Sesuaikan padding agar terlihat proporsional */
        font-size: 1rem; /* Sesuaikan ukuran font */
        /* Pastikan background-color, color, border-radius, dll. sesuai dengan desain kamu di daftar.css */
    }

    /* Mengatur container untuk tombol Google agar sejajar dan selebar tombol lain */
    /* Google GSI button (g_id_signin) adalah iframe, jadi kita styling parent-nya atau wrap dengan div */
    .google-signin-wrapper {
        width: 100%; /* Agar wrapper mengambil lebar penuh */
        display: flex; /* Untuk merata-tengahkan tombol Google di dalamnya */
        justify-content: center; /* Merata-tengahkan horizontal */
        margin-bottom: 15px; /* Jarak bawah jika perlu */
    }

    /* Menyesuaikan teks "Or" sebagai divider */
    .divider-text {
      display: flex;
      align-items: center;
      text-align: center;
      color: rgba(255, 255, 255, 0.7); /* Warna teks putih transparan */
      margin: 25px 0; /* Jarak atas dan bawah */
      font-size: 0.95rem; /* Ukuran font yang pas */
    }

    .divider-text::before,
    .divider-text::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid rgba(255, 255, 255, 0.3); /* Garis putih transparan */
    }

    .divider-text:not(:empty)::before {
      margin-right: .75em;
    }

    .divider-text:not(:empty)::after {
      margin-left: .75em;
    }
    
    /* Gaya untuk pesan error/success dari sesi */
    .alert {
        margin-bottom: 1rem; /* Jarak bawah pesan alert */
        border-radius: .5rem; /* Sudut membulat */
    }
  </style>
</head>

<body>
  <div class="hero-container position-relative min-vh-100 overflow-hidden">
    <div class="hero-bg position-absolute w-100 h-100" style="z-index: 0;"></div>
    <div class="overlay position-absolute w-100 h-100" style="z-index: 1;"></div>
    <div class="container-fluid h-100 position-relative" style="z-index: 2;">
      <div class="row h-100">
        <div class="col-lg-6 d-flex flex-column justify-content-between text-white p-5">
          <div>
            <h2 class="mb-2">Welcome To</h2>
            <h1 class="display-4 fw-bold">Alas Jiwa</h1>
          </div>
          <div class="mt-auto">
            <p class="fs-5 lh-lg">
              Di alam, kita tidak hanya menempuh jarak.<br>
              Kita menempuh diri kita sendiri.<br>
              Temukan arah, makna, dan jati dirimu bersama mereka<br>
              yang juga sedang berjalan seperti kamu.
            </p>
            <div class="mt-4">
              <span>Already have an account?</span>
              <a href="masuk.php" class="text-white fw-bold text-decoration-none">Sign in</a>
            </div>
          </div>
        </div>

        <div class="col-lg-6 d-flex align-items-center justify-content-center p-4">
          <div class="bg-white bg-opacity-10 backdrop-blur p-5 rounded-4 w-100" style="max-width: 450px;">
            
            <?php // session_start(); // Baris ini sudah dipindahkan ke paling atas ?> 
            <?php if (isset($_SESSION['error'])): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <h2 class="text-white fw-bold text-center mb-4">Create an account</h2>

            <form action="proses_daftar.php" method="POST" novalidate>
              <div class="row mb-3">
                <div class="col-md-6 mb-3 mb-md-0">
                  <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" required>
                </div>
              </div>

              <div class="mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email address" required>
              </div>

              <div class="mb-3">
                <input type="tel" class="form-control" name="no_hp" placeholder="Nomor HP" required>
              </div>

              <div class="mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password (min 6 karakter)" required minlength="6">
              </div>

              <div class="mb-4">
                <input type="password" class="form-control" name="confirm_password" placeholder="Konfirmasi Password" required>
              </div>

              <button type="submit" class="create-btn mb-3">Create Account</button>
            </form>

            <div class="divider-text">
              <span>Or</span>
            </div>

            <div class="google-signin-wrapper">
                <div id="g_id_onload"
                  data-client_id="300144113544-bh6c0tiodpnabmcitdnq5jpuvrfccrqi.apps.googleusercontent.com"
                  data-context="signup"
                  data-ux_mode="popup"
                  data-callback="handleCredentialResponse"
                  data-auto_prompt="false" 
                  data-auto_select="false"> 
                </div>

                <div class="g_id_signin"
                  data-type="standard"
                  data-size="large"
                  data-theme="outline"
                  data-text="sign_up_with"
                  data-shape="pill"
                  data-logo_alignment="left">
                </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function handleCredentialResponse(response) {
      fetch('google_register_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ credential: response.credential })
      })
      .then(res => res.json())
      .then(data => {
        if (data.status === 'success') {
          window.location.href = '0dashboard.php';
        } else {
          alert('Gagal daftar/login dengan Google: ' + (data.message || 'Terjadi kesalahan tidak diketahui.'));
          console.error("DETAIL ERROR DARI SERVER:", data.detail || data.message);
        }
      })
      .catch(err => {
        console.error("Google Sign-In fetch error:", err);
        alert("Terjadi kesalahan jaringan saat mencoba login dengan Google.");
      });
    }
  </script>
</body>
</html>