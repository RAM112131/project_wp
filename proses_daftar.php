<?php
// Sertakan file koneksi database
include 'koneksi.php';

// Cek apakah form disubmit dengan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil data dari form dan lakukan sanitasi
    $username = trim($_POST['username']);
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $no_hp = trim($_POST['no_hp']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Array untuk menyimpan error
    $errors = array();
    
    // Validasi input
    if (empty($username)) {
        $errors[] = "Username wajib diisi";
    } elseif (strlen($username) > 10) {
        $errors[] = "Username maksimal 10 karakter";
    }
    
    if (empty($nama_lengkap)) {
        $errors[] = "Nama lengkap wajib diisi";
    }
    
    if (empty($no_hp)) {
        $errors[] = "Nomor HP wajib diisi";
    } elseif (!preg_match('/^[0-9]{10,12}$/', $no_hp)) {
        $errors[] = "Nomor HP harus berisi 10-12 digit angka";
    }
    
    if (empty($email)) {
        $errors[] = "Email wajib diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }
    
    if (empty($password)) {
        $errors[] = "Password wajib diisi";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Konfirmasi password tidak sesuai";
    }
    
    // Cek apakah username sudah ada
    if (empty($errors)) {
        $check_username = mysqli_prepare($connection, "SELECT id FROM users WHERE username = ?");
        mysqli_stmt_bind_param($check_username, "s", $username);
        mysqli_stmt_execute($check_username);
        $result = mysqli_stmt_get_result($check_username);
        
        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Username sudah digunakan, silakan pilih username lain";
        }
        mysqli_stmt_close($check_username);
    }
    
    // Cek apakah email sudah ada
    if (empty($errors)) {
        $check_email = mysqli_prepare($connection, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($check_email, "s", $email);
        mysqli_stmt_execute($check_email);
        $result = mysqli_stmt_get_result($check_email);
        
        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Email sudah terdaftar, silakan gunakan email lain";
        }
        mysqli_stmt_close($check_email);
    }
    
    // Jika tidak ada error, lakukan insert data
    if (empty($errors)) {
        // Hash password untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $insert_query = mysqli_prepare($connection, "INSERT INTO users (username, nama_lengkap, no_hp, email, password) VALUES (?, ?, ?, ?, ?)");
        
        if ($insert_query) {
            mysqli_stmt_bind_param($insert_query, "sssss", $username, $nama_lengkap, $no_hp, $email, $hashed_password);
            
            if (mysqli_stmt_execute($insert_query)) {
                echo "<script>
                        alert('Pendaftaran berhasil! Akun Anda telah dibuat.');
                        window.location.href = 'masuk.php'; 
                      </script>";
            } else {
                echo "<script>
                        alert('Terjadi kesalahan saat mendaftar. Silakan coba lagi.');
                        window.history.back();
                      </script>";
            }
            
            mysqli_stmt_close($insert_query);
        } else {
            echo "<script>
                    alert('Terjadi kesalahan sistem. Silakan coba lagi.');
                    window.history.back();
                  </script>";
        }
    } else {
        $error_message = implode("\\n", $errors);
        echo "<script>
                alert('$error_message');
                window.history.back();
              </script>";
    }
    
    mysqli_close($connection);
} else {
    header("Location: daftar.html");
    exit();
}
?>