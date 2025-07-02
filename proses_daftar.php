<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username         = trim($_POST['username']);
    $nama_lengkap     = trim($_POST['nama_lengkap']);
    $no_hp            = trim($_POST['no_hp']);
    $email            = trim($_POST['email']);
    $password         = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $errors = [];

    // Validasi
    if (empty($username)) $errors[] = "Username wajib diisi";
    elseif (strlen($username) > 10) $errors[] = "Username maksimal 10 karakter";

    if (empty($nama_lengkap)) $errors[] = "Nama lengkap wajib diisi";

    if (empty($no_hp)) $errors[] = "Nomor HP wajib diisi";
    elseif (!preg_match('/^[0-9]{10,12}$/', $no_hp)) $errors[] = "Nomor HP harus 10-12 digit angka";

    if (empty($email)) $errors[] = "Email wajib diisi";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Format email tidak valid";

    if (empty($password)) $errors[] = "Password wajib diisi";
    elseif (strlen($password) < 6) $errors[] = "Password minimal 6 karakter";

    if ($password !== $confirm_password) $errors[] = "Konfirmasi password tidak sesuai";

    // Cek username atau email sudah ada
    if (empty($errors)) {
        $stmt = mysqli_prepare($connection, "SELECT id FROM users WHERE username = ? OR email = ?");
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $errors[] = "Username atau email sudah digunakan";
        }
        mysqli_stmt_close($stmt);
    }

    // Insert ke database jika tidak ada error
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $insert = mysqli_prepare($connection, "INSERT INTO users (username, nama_lengkap, no_hp, email, password) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($insert, "sssss", $username, $nama_lengkap, $no_hp, $email, $hashed_password);

        if (mysqli_stmt_execute($insert)) {
            $_SESSION['success'] = "Akun berhasil dibuat! Silakan login.";
            header("Location: masuk.php");
            exit();
        } else {
            $_SESSION['error'] = "Gagal menyimpan data. Silakan coba lagi.";
            header("Location: daftar.php");
            exit();
        }

        mysqli_stmt_close($insert);
    } else {
        // Kirim error dalam session
        $_SESSION['error'] = implode("<br>", $errors);
        header("Location: daftar.php");
        exit();
    }

} else {
    header("Location: daftar.php");
    exit();
}
