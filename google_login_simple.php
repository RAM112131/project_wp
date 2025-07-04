<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi database sudah ada

header('Content-Type: application/json');

// Ambil input JSON dari request
$input = json_decode(file_get_contents('php://input'), true);

$email = $input['email'] ?? null;
$displayName = $input['displayName'] ?? 'Pengguna Google'; // Default jika display name tidak ada
$phoneNumber = 'N/A'; // Default value for no_hp, atau bisa string kosong jika kolom memungkinkan

if (empty($email)) {
    echo json_encode(['status' => 'error', 'message' => 'Email tidak diterima.']);
    exit();
}

try {
    // Cek apakah pengguna sudah ada di database kita berdasarkan email
    $stmt = mysqli_prepare($connection, "SELECT * FROM users WHERE email = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) === 1) {
            // Pengguna sudah ada, login mereka
            $user = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap']; // Tambahkan ini agar lengkap
            echo json_encode(['status' => 'success', 'message' => 'Login berhasil!']);
        } else {
            // Pengguna belum ada, daftarkan mereka
            // Kita perlu membuat username unik. Contoh: ambil bagian sebelum '@' dari email.
            $potentialUsername = explode('@', $email)[0];
            $baseUsername = substr($potentialUsername, 0, 10); // Batasi 10 karakter sesuai DB
            $uniqueUsername = $baseUsername;
            $counter = 1;

            // Pastikan username unik (cek di database)
            while (true) {
                $checkUsernameStmt = mysqli_prepare($connection, "SELECT COUNT(*) FROM users WHERE username = ?");
                mysqli_stmt_bind_param($checkUsernameStmt, "s", $uniqueUsername);
                mysqli_stmt_execute($checkUsernameStmt);
                mysqli_stmt_bind_result($checkUsernameStmt, $count);
                mysqli_stmt_fetch($checkUsernameStmt);
                mysqli_stmt_close($checkUsernameStmt);

                if ($count == 0) {
                    break; // Username unik
                }
                // Jika tidak unik, tambahkan angka di belakangnya
                $uniqueUsername = substr($baseUsername, 0, 10 - strlen($counter)) . $counter;
                $counter++;
                if ($counter > 9999) { // Batasi agar tidak infinite loop dan username terlalu panjang
                    $uniqueUsername = uniqid('guser'); // Fallback ke ID unik
                    break;
                }
            }

            // Password untuk pengguna Google bisa string kosong atau hash dari string khusus
            // Karena kolom 'password' NOT NULL, kita harus isi.
            // Misalnya, kita bisa pakai 'google_auth_password_placeholder' dan hash itu.
            $googleAuthPlaceholderPassword = password_hash('google_auth_password_placeholder_' . $email, PASSWORD_DEFAULT);


            $insertStmt = mysqli_prepare($connection, "INSERT INTO users (username, nama_lengkap, no_hp, email, password) VALUES (?, ?, ?, ?, ?)");
            if ($insertStmt) {
                // Perhatikan urutan dan jumlah parameter harus sesuai dengan kolom
                mysqli_stmt_bind_param($insertStmt, "sssss", $uniqueUsername, $displayName, $phoneNumber, $email, $googleAuthPlaceholderPassword);
                if (mysqli_stmt_execute($insertStmt)) {
                    $_SESSION['username'] = $uniqueUsername;
                    $_SESSION['email'] = $email;
                    $_SESSION['nama_lengkap'] = $displayName;
                    echo json_encode(['status' => 'success', 'message' => 'Pendaftaran dan login Google berhasil!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal mendaftarkan pengguna ke database: ' . mysqli_error($connection)]);
                }
                mysqli_stmt_close($insertStmt);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyiapkan query pendaftaran: ' . mysqli_error($connection)]);
            }
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyiapkan query pengecekan pengguna: ' . mysqli_error($connection)]);
    }

} catch (\Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan server: ' . $e->getMessage()]);
}

mysqli_close($connection);
?>