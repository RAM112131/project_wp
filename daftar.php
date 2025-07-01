<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Daftar Akun</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style_daftar.css">
    </head>
    <body class="bg-primary ">
        <section class="container my-5 bg-black one-container">
            <div class="row">
                <div class="col-sm bg-white text-black one-container">
                    <img src="img/Copilot_20250630_171646.png" class="img-fluid" alt="Logo Gunung Ciremai">
                </div>

                <div class="col-sm p-5 text-white">
                    <div class="text-center">
                        <h1>Mari Bergabung!</h1>
                        <p>Daftar untuk mulai merencanakan pendakian ke Gunung Ciremai</p>
                    </div>
                    <form class="was-validated" method="POST" id="registrationForm" action="proses_daftar.php" novalidate>
                        
                        <!-- masukan usrname -->
                        <div class="mt-3">
                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required maxlength="10">
                            <div class="invalid-feedback">
                                Username maksimal 10 karakter dan wajib diisi
                            </div>
                            <div class="valid-feedback">
                                Username sudah benar!
                            </div>
                        </div>
                        
                        <!-- masukan nama lengkap -->
                        <div>
                            <label for="nama_lengkap" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan Nama Lengkap" required>
                            <div class="invalid-feedback">
                                Nama Lengkap belum di isi!
                            </div>
                            <div class="valid-feedback">
                                Nama sudah di isi dengan benar!
                            </div>
                        </div>
                        
                        <!-- masukan nomor hp -->
                        <div>
                            <label for="no_hp" class="form-label">No. HP <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No. HP" required pattern="[0-9]{10,12}">
                            <div class="invalid-feedback">
                                No.Hp wajib diisi dan harus 10-12 digit
                            </div>
                            <div class="valid-feedback">
                                No.Hp sudah diisi!
                            </div>
                        </div>

                        <!-- masukan email -->
                        <div>
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                            <div class="invalid-feedback">
                                Email wajib diisi
                            </div>
                            <div class="valid-feedback">
                                Email sudah benar!
                            </div>
                        </div>

                        <!-- memasukan kata sandi -->
                        <div>
                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required minlength="6">
                            <div class="invalid-feedback">
                                Password wajib diisi dan minimal 6 karakter.
                            </div>
                            <div class="valid-feedback">
                                Password memenuhi syarat!
                            </div>
                        </div>

                        <!-- konfirmasi sandi -->
                        <div>
                            <label for="confirm_password" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi password" required>
                            <div class="invalid-feedback" id="confirm_password_feedback">
                                Konfirmasi password tidak sesuai.
                            </div>
                            <div class="valid-feedback">
                                Konfirmasi password sesuai!
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button class="container-fluid btn btn-primary " type="submit">Daftar Sekarang</button>
                        </div>
                        <div class="mt-2 text-center">Sudah punya akun? 
                            <a href="masuk.php">Masuk disini</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const passwordField = document.getElementById('password');
                const confirmPasswordField = document.getElementById('confirm_password');
                const registrationForm = document.getElementById('registrationForm');

                function validatePasswordConfirmation() {
                    if (passwordField.value === confirmPasswordField.value) {
                        confirmPasswordField.classList.remove('is-invalid');
                        confirmPasswordField.classList.add('is-valid');
                    } else {
                        confirmPasswordField.classList.remove('is-valid');
                        confirmPasswordField.classList.add('is-invalid');
                    }
                }
                passwordField.addEventListener('keyup', validatePasswordConfirmation);
                confirmPasswordField.addEventListener('keyup', validatePasswordConfirmation);

                registrationForm.addEventListener('submit', function(event) {
                    validatePasswordConfirmation(); 

                    if (!registrationForm.checkValidity() || passwordField.value !== confirmPasswordField.value) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    registrationForm.classList.add('was-validated');
                }, false);
            });
        </script>
    </body>
</html>