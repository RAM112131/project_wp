<?php
session_start();
include 'koneksi.php'; // Pastikan file koneksi database Anda ada dan benar

header('Content-Type: application/json');

// Ambil data JSON dari request
$input = json_decode(file_get_contents('php://input'), true);

$email = $input['email'] ?? null;
$displayName = $input['displayName'] ?? 'Pengguna Google'; // Default nama jika tidak ada
$phoneNumber = '000000000000'; // Default value untuk no_hp (harus diisi karena NOT NULL)

// Pastikan email tidak kosong
if (empty($email)) {
    echo json_encode(['status' => 'error', 'message' => 'Email tidak diterima dari Google.']);
    exit();
}

try {
    // 1. Cek apakah email sudah ada di database
    $stmt = mysqli_prepare($connection, "SELECT username, email, nama_lengkap FROM users WHERE email = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) === 1) {
            // Pengguna sudah terdaftar di database, buat sesi login
            $user = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap']; // Tambahkan nama_lengkap ke sesi
            echo json_encode(['status' => 'success', 'message' => 'Login Google berhasil!']);
        } else {
            // Pengguna belum terdaftar, lakukan pendaftaran baru
            
            // Generate username unik (maksimal 10 karakter)
            $baseUsername = explode('@', $email)[0]; // Ambil bagian sebelum '@'
            $baseUsername = substr($baseUsername, 0, 8); // Potong untuk memberi ruang bagi angka
            $uniqueUsername = $baseUsername;
            $counter = 1;

            // Loop untuk memastikan username unik
            while (true) {
                // Periksa apakah username sudah ada
                $checkUsernameStmt = mysqli_prepare($connection, "SELECT COUNT(*) FROM users WHERE username = ?");
                mysqli_stmt_bind_param($checkUsernameStmt, "s", $uniqueUsername);
                mysqli_stmt_execute($checkUsernameStmt);
                mysqli_stmt_bind_result($checkUsernameStmt, $count);
                mysqli_stmt_fetch($checkUsernameStmt);
                mysqli_stmt_close($checkUsernameStmt);

                if ($count == 0) {
                    break; // Username unik, keluar dari loop
                }
                // Jika tidak unik, tambahkan angka dan coba lagi
                $uniqueUsername = $baseUsername . $counter;
                $counter++;
                // Batasi counter agar tidak terlalu panjang atau infinite loop (misal hingga 999)
                if ($counter > 999) {
                    $uniqueUsername = 'guser_' . uniqid(); // Fallback jika terlalu banyak duplikat
                    $uniqueUsername = substr($uniqueUsername, 0, 10); // Pastikan tetap 10 karakter
                    break;
                }
            }

            // Hash password placeholder (wajib karena kolom password NOT NULL)
            // Ini bukan password yang sebenarnya, hanya placeholder.
            $hashedPasswordPlaceholder = password_hash(uniqid('google_'), PASSWORD_DEFAULT);

            // Insert pengguna baru
            $insertStmt = mysqli_prepare($connection, "INSERT INTO users (username, nama_lengkap, no_hp, email, password) VALUES (?, ?, ?, ?, ?)");
            if ($insertStmt) {
                mysqli_stmt_bind_param($insertStmt, "sssss", $uniqueUsername, $displayName, $phoneNumber, $email, $hashedPasswordPlaceholder);
                if (mysqli_stmt_execute($insertStmt)) {
                    // Pendaftaran berhasil, buat sesi login
                    $_SESSION['username'] = $uniqueUsername;
                    $_SESSION['email'] = $email;
                    $_SESSION['nama_lengkap'] = $displayName;
                    echo json_encode(['status' => 'success', 'message' => 'Pendaftaran dan login Google berhasil!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal mendaftarkan pengguna ke database.', 'detail' => mysqli_error($connection)]);
                }
                mysqli_stmt_close($insertStmt);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyiapkan query pendaftaran.', 'detail' => mysqli_error($connection)]);
            }
        }
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyiapkan query pengecekan email.', 'detail' => mysqli_error($connection)]);
    }

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan pada server.', 'detail' => $e->getMessage()]);
} finally {
    mysqli_close($connection);
}
?>