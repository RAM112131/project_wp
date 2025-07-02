<?php
session_start();
include 'koneksi.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  if (empty($email) || empty($password)) {
    $error = 'Semua field harus diisi.';
  } else {
    // Cek email di database
    $query = mysqli_prepare($connection, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($query, "s", $email);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    if (mysqli_num_rows($result) === 1) {
      $user = mysqli_fetch_assoc($result);
      if (password_verify($password, $user['password'])) {
        // Simpan ke session
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        header("Location: 0dashboard.php");
        exit();
      } else {
        $error = "Password salah!";
      }
    } else {
      $error = "Email tidak ditemukan!";
    }

    mysqli_stmt_close($query);
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
</head>
<body>
  <div class="container">
    <!-- Left Section -->
    <div class="left-section">
      <div class="welcome-glass">
        <div class="welcome-content">
          <h1 class="welcome-title">
            Welcome To <br />
            <strong>Alas Jiwa</strong>
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

    <!-- Right Section -->
    <div class="right-section">
      <div class="login-container">
        <div class="login-header">
          <h2 class="login-title">Sign In</h2>
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="loginForm">
          <div class="form-group">
            <label for="email" class="form-label">Email address</label>
            <input 
              type="email" 
              id="email" 
              name="email" 
              class="form-input" 
              placeholder="Enter your email"
              value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
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

          <button type="submit" class="signin-btn">Sign In</button>

          <?php if (!empty($error)): ?>
            <div class="error-message">
              <?= htmlspecialchars($error); ?>
            </div>
          <?php endif; ?>
        </form>

        <div class="divider"><span>Or</span></div>

        <button type="button" class="google-btn" onclick="signInWithGoogle()">
          <svg class="google-icon" viewBox="0 0 24 24">
            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
          </svg>
          Continue with Google
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

    function signInWithGoogle() {
      alert("Google Sign In akan diimplementasikan");
    }
  </script>
</body>
</html>
