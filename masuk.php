<?php
session_start();
include 'koneksi.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = 'Semua field harus diisi.';
    } else {
        $stmt = mysqli_prepare($connection, "SELECT * FROM users WHERE email = ?");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) === 1) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($password, $user['password'])) {
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['nama_lengkap'] = $user['nama_lengkap']; // Tambahkan ini
                    header("Location: 0dashboard.php");
                    exit();
                } else {
                    $error = "Password salah!";
                }
            } else {
                $error = "Email tidak ditemukan!";
            }

            mysqli_stmt_close($stmt);
        } else {
            $error = "Terjadi kesalahan saat menyiapkan query.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign In - Alas Jiwa</title>

  <link rel="stylesheet" href="./css/masuk.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <style>
    /* Styling untuk tombol Sign In dari form manual */
    /* diasumsikan .signin-btn memiliki lebar penuh dan tinggi tertentu */
    .signin-btn {
        width: 100%; /* Pastikan tombol manual juga lebar penuh */
        padding: 12px 20px; /* Contoh padding untuk tombol manual */
        font-size: 1rem; /* Contoh ukuran font untuk tombol manual */
        /* ... gaya lain dari masuk.css ... */
    }

    .google-btn-custom {
      display: flex;
      align-items: center;
      justify-content: center; /* Rata tengah konten (icon dan teks) */
      font-weight: 500;
      padding: 12px 20px; /* Menyesuaikan padding agar sejajar dengan .signin-btn */
      border: 1px solid #ccc;
      background-color: #fff;
      border-radius: 5px;
      cursor: pointer;
      gap: 10px; /* Jarak antara icon Google dan teks */
      font-family: 'Poppins', sans-serif;
      font-size: 1rem; /* Menyesuaikan ukuran font agar sejajar dengan .signin-btn */
      width: 100%; /* Penting: agar tombol Google selebar tombol Sign In */
      box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Sedikit bayangan untuk menonjol */
      transition: background-color 0.2s ease, box-shadow 0.2s ease;
    }
    .google-btn-custom:hover {
      background-color: #f5f5f5;
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    /* Mengatur ukuran icon Google */
    .google-btn-custom img {
        width: 20px; /* Ukuran icon Google */
        height: 20px; /* Ukuran icon Google */
    }

    /* CSS tambahan untuk divider "Atau" */
    .divider {
      display: flex;
      align-items: center;
      text-align: center;
      margin: 20px 0; /* Jarak atas bawah divider */
      color: #777; /* Warna teks "Atau" */
      font-size: 0.9rem;
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      border-bottom: 1px solid #eee; /* Warna garis */
    }

    .divider:not(:empty)::before {
      margin-right: .5em;
    }

    .divider:not(:empty)::after {
      margin-left: .5em;
    }

    /* Pastikan .login-container memiliki padding dan max-width yang tepat */
    .login-container {
      /* Contoh: */
      padding: 40px;
      max-width: 400px;
      width: 100%;
      /* ... gaya lain dari masuk.css ... */
    }

    /* Gaya untuk error message */
    .error-message {
        color: #dc3545; /* Merah untuk error */
        background-color: #f8d7da; /* Latar belakang merah muda */
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        padding: 10px 15px;
        margin-bottom: 15px;
        font-size: 0.9rem;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left-section">
      <div class="welcome-glass">
        <div class="welcome-content">
          <h1 class="welcome-title">
            Welcome To <br /><strong>Ciremai</strong>
          </h1>
          <p class="welcome-description">
            Di alam, kita tidak hanya menemukan jarak.<br />
            Kita menemukan diri kita sendiri.<br />
            Temukan alam, makna, dan jiwa bersama mereka<br />
            yang juga sedang berjalan seperti kamu.
          </p>
          <div style="margin-top: 40px">
            <span style="color: rgba(255, 255, 255, 0.8); font-size: 0.9rem">
              Don't have an account?
            </span>
            <a href="daftar.php" class="account-link">Create an account</a>
          </div>
        </div>
      </div>
    </div>

    <div class="right-section">
      <div class="login-container">
        <div class="login-header">
          <h2 class="login-title">Sign In</h2>
        </div>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" id="loginForm">
          <div class="form-group">
            <label for="email" class="form-label">Email address</label>
            <input 
              type="email" 
              id="email" 
              name="email" 
              class="form-input" 
              placeholder="Enter your email"
              value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" 
              required 
            />
          </div>

          <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <div class="password-container">
              <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-input" 
                placeholder="Enter password" 
                required 
              />
              <button type="button" class="show-password" onclick="togglePassword()">Show password</button>
            </div>
          </div>

          <?php if (!empty($error)): ?>
            <div class="error-message">
              <?= htmlspecialchars($error); ?>
            </div>
          <?php endif; ?>

          <button type="submit" class="signin-btn">Sign In</button>
        </form>

        <div class="divider"><span>Atau</span></div>

        <button type="button" class="google-btn-custom" onclick="signInWithGoogle()">
          <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google logo" /> Sign in with Google
        </button>
      </div>
    </div>
  </div>

  <script>
    function togglePassword() {
      const pass = document.getElementById("password");
      const btn = document.querySelector(".show-password");
      if (pass.type === "password") {
        pass.type = "text";
        btn.textContent = "Hide password";
      } else {
        pass.type = "password";
        btn.textContent = "Show password";
      }
    }
  </script>

  <script type="module">
    import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.23.0/firebase-app.js';
    import { getAuth, GoogleAuthProvider, signInWithPopup } from 'https://www.gstatic.com/firebasejs/9.23.0/firebase-auth.js';

    const firebaseConfig = {
      apiKey: "AIzaSyBOZo6R-FAF3KdoC3Xw28F6RiWL4qfx7XY",
      authDomain: "webproject-5f104.firebaseapp.com",
      projectId: "webproject-5f104",
      storageBucket: "webproject-5f104.appspot.com",
      messagingSenderId: "300144113544",
      appId: "1:300144113544:web:f35663fbf07deec1496c3d"
    };

    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);

    window.signInWithGoogle = async function () {
      try {
        const provider = new GoogleAuthProvider();
        const result = await signInWithPopup(auth, provider);
        const user = result.user; // Objek user dari Firebase

        // Mengirim email dan nama pengguna ke PHP
        const res = await fetch('google_login_handler.php', { // <-- PASTIKAN NAMA FILE INI BENAR
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({
              email: user.email,
              displayName: user.displayName || user.email // Gunakan display name atau email
          })
        });

        const data = await res.json();
        if (data.status === 'success') {
          window.location.href = '0dashboard.php';
        } else {
          alert("Gagal login: " + data.message);
          console.error("DETAIL:", data.detail || data.message); // Tampilkan detail error
        }

      } catch (error) {
        console.error("Google Login Error:", error);
        alert("Google Login Error: " + error.message);
      }
    };
  </script>
</body>
</html>