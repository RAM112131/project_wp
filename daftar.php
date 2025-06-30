<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Daftar Akun</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style_daftar.css">

    </head>
    <body class="bg-primary text">
        <section class="container my-5 bg-secondary one-container">
            
                <div class="row ">
                    <!-- tampilan tambahan di halaman daftar -->
                    <div class="col-sm p-5 bg-white text-black one-container">Gambar plus text</div>
                    
                    <!-- tampilan form daftar -->
                    <div class="col-sm p-5 text-white">
                        <h1>Mari Bergabung!</h1>
                        <p>Daftar untuk mulai merencanakan pendakian ke Gunung Ciremai</p>
                        <!-- buat form username, nama lengkap, no-hp/wa/telp, email, kata_sandi, konfirmasi kata sandi menggunakan boostrap yaitu supported elements-->
                        
                        <form class="was-validated">
                            <div class="mb-3">
                                <label for="validationUsername" class="form-label">Username</label>
                                <input type="text" autocomplete="username" class="form-control" id="validationUsername" placeholder="Buat Username..." required>
                                <div class="invalid-feedback">
                                Tolong Buat Username Anda
                                </div>
                            </div>

                            <!-- submit daftar -->
                             
                        </form>

                    </div>
                </div>
        </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    </body>
</html>