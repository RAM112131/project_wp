<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login ke Portal Pendakian Gunung Ciremai">
    <title>Login - Ciremai Nikreuh</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style_CN.css">
</head>
<body>
    <!-- Close Button -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <a href="0dashboard.html" class="btn btn-light btn-sm rounded-circle shadow" title="Kembali ke Dashboard">
            <i class="bi bi-x-lg"></i>
        </a>
    </div>

    <!-- Login Section -->
    <main class="py-5 min-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <!-- Brand Section -->
                    <div class="text-center mb-4">
                        <a href="0dashboard.html" class="text-decoration-none">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <img src="img/logo_CN.png" alt="logo CN" class="logo me-2" style="height: 40px;">
                                <i class="bi bi-mountain fs-2 text-primary me-2"></i>
                                <span class="h4 text-dark mb-0">Ciremai Nikreuh</span>
                            </div>
                        </a>
                        <p class="text-muted">Portal Pendakian Gunung Ciremai</p>
                    </div>

                    <div class="card shadow">
                        <div class="card-header text-center bg-primary text-white">
                            <h4 class="mb-0">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login ke Akun Anda
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <form id="loginForm">
                                <div class="mb-3">
                                    <label for="loginEmail" class="form-label">
                                        <i class="bi bi-envelope me-1"></i>Email
                                    </label>
                                    <input type="email" class="form-control" id="loginEmail" required>
                                </div>
                                <div class="mb-3">
                                    <label for="loginPassword" class="form-label">
                                        <i class="bi bi-lock me-1"></i>Password
                                    </label>
                                    <input type="password" class="form-control" id="loginPassword" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        Ingat saya selama 30 hari
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-3">
                                    <i class="bi bi-check-circle me-2"></i>Masuk
                                </button>
                            </form>
                            
                            <div class="text-center">
                                <p class="mb-2">Belum punya akun? 
                                    <a href="daftar.html" class="text-decoration-none">
                                        Daftar sekarang
                                    </a>
                                </p>
                                <p class="mb-0">
                                    <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                                        Lupa password?
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-key me-2"></i>Reset Password
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Masukkan email Anda dan kami akan mengirimkan link untuk reset password.
                    </div>
                    <form id="resetPasswordForm">
                        <div class="mb-3">
                            <label for="resetEmail" class="form-label">
                                <i class="bi bi-envelope me-1"></i>Email
                            </label>
                            <input type="email" class="form-control" id="resetEmail" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-send me-2"></i>Kirim Link Reset
                        </button>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="text-center">
                        <p class="mb-0">Ingat password? 
                            <button type="button" class="btn btn-link p-0" data-bs-dismiss="modal">
                                Kembali ke login
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; 2024 Ciremai Nikreuh. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Handle login form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            const remember = document.getElementById('rememberMe').checked;
            
            // Simple validation (you can expand this)
            if (email && password) {
                // Here you would typically send data to your backend
                alert('Login berhasil! (Demo)');
                // Redirect to dashboard
                window.location.href = '0dashboard.html';
            } else {
                alert('Mohon lengkapi semua field!');
            }
        });

        // Handle forgot password form submission
        document.getElementById('resetPasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('resetEmail').value;
            
            if (email) {
                alert('Link reset password telah dikirim ke email Anda! (Demo)');
                // Close modal
                bootstrap.Modal.getInstance(document.getElementById('forgotPasswordModal')).hide();
            } else {
                alert('Mohon masukkan email Anda!');
            }
        });
    </script>
</body>
</html>