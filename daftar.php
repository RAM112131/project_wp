<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create Account - Alas Jiwa</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <!-- CSS -->
  <link rel="stylesheet" href="./css/daftar.css">
  <link rel="stylesheet" href="./css/google.register.css">
</head>

<body>
  <div class="hero-container position-relative min-vh-100 overflow-hidden">
    <div class="hero-bg position-absolute w-100 h-100" style="z-index: 0;"></div>
    <div class="overlay position-absolute w-100 h-100" style="z-index: 1;"></div>
    <div class="container-fluid h-100 position-relative" style="z-index: 2;">
      <div class="row h-100">
        <!-- Kiri -->
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

        <!-- Kanan -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center p-4">
          <div class="bg-white bg-opacity-10 backdrop-blur p-5 rounded-4 w-100" style="max-width: 450px;">
            
            <!-- Flash message -->
            <?php if (isset($_SESSION['error'])): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <!-- Judul Form -->
            <h2 class="text-white fw-bold text-center mb-4">Create an account</h2>

            <!-- Form pendaftaran -->
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
                <input type="password" class="form-control" id="password" name="password" placeholder="Password (min 6 karakter)" required minlength="6">
              </div>

              <div class="mb-4">
                <input type="password" class="form-control" name="confirm_password" placeholder="Konfirmasi Password" required>
              </div>

              <button type="submit" class="create-btn mb-3">Create Account</button>
            </form>

            <!-- Divider -->
            <div class="text-center text-white mb-3">
              <span class="px-3" style="background: rgba(255,255,255,0.1); border-radius: 20px;">Or</span>
            </div>

            <!-- Google Button -->
            <button type="button" class="btn btn-outline-light w-100 google-btn" id="googleSignInBtn" onclick="signInWithGoogle()">
              <i class="fab fa-google me-2"></i> Sign up with Google
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Firebase & JS -->
  <script type="module">
    import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js';
    import { getAuth, GoogleAuthProvider, signInWithPopup } from 'https://www.gstatic.com/firebasejs/9.23.0/firebase-auth.js';

    const firebaseConfig = {
      apiKey: "AIzaSyBOZo6R-FAF3KdoC3Xw28F6RiWL4qfx7XY",
      authDomain: "webproject-5f104.firebaseapp.com",
      projectId: "webproject-5f104",
      storageBucket: "webproject-5f104.appspot.com",
      messagingSenderId: "300144113544",
      appId: "1:300144113544:web:f35663fbf07deec1496c3d",
      measurementId: "G-DERMQJFLM8"
    };

    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);

    window.signInWithGoogle = async function() {
      try {
        const provider = new GoogleAuthProvider();
        const result = await signInWithPopup(auth, provider);
        const user = result.user;

        const btn = document.getElementById('googleSignInBtn');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
        btn.disabled = true;

        const res = await fetch('google_register.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
            email: user.email,
            first_name: user.displayName.split(' ')[0],
            last_name: user.displayName.split(' ').slice(1).join(' '),
            uid: user.uid,
            photo_url: user.photoURL,
            provider: 'google'
          })
        });

        const data = await res.json();
        if (data.status === 'success' || data.status === 'ok') {
          window.location.href = '0dashboard.php';
        } else {
          throw new Error(data.message || 'Gagal simpan user.');
        }

      } catch (err) {
        console.error("Google Sign-In error:", err);
        alert("Gagal login dengan Google. Silakan coba lagi.");
        document.getElementById('googleSignInBtn').innerHTML = '<i class="fab fa-google me-2"></i> Sign up with Google';
        document.getElementById('googleSignInBtn').disabled = false;
      }
    };
  </script>
</body>
</html>
