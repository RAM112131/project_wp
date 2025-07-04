<?php
session_start();
require __DIR__ . '/vendor/autoload.php'; // Pastikan path ini benar jika menggunakan Composer
include 'koneksi.php'; // Pastikan file koneksi database Anda ada dan benar, dan membuat variabel $koneksi

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

// Ganti dengan CLIENT ID Anda dari Google Cloud Console (Client ID Web Application)
// Ini harus sama dengan data-client_id di HTML Anda
const GOOGLE_CLIENT_ID = '300144113544-bh6c0tiodpnabmcitdnq5jpuvrfccrqi.apps.googleusercontent.com';

// URL untuk mendapatkan Google Public Keys (untuk verifikasi JWT)
const GOOGLE_CERTS_URL = 'https://www.googleapis.com/oauth2/v3/certs';

/**
 * Fungsi untuk mendapatkan public keys dari Google.
 * Menggunakan APCu cache jika tersedia untuk performa.
 * @return array Kumpulan objek Firebase\JWT\Key dengan 'kid' sebagai kunci array.
 * @throws Exception Jika gagal mengambil kunci publik Google.
 */
function getGooglePublicKeys() {
    // Coba ambil dari cache jika ada APCu dan sudah terinstal
    if (function_exists('apcu_fetch') && apcu_fetch('google_public_keys') !== false) {
        return apcu_fetch('google_public_keys');
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, GOOGLE_CERTS_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Tambahkan opsi untuk mengabaikan verifikasi SSL jika Anda mengalami masalah di lingkungan pengembangan lokal
    // Namun, HINDARI ini di PRODUKSI.
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200 && $response) {
        $data = json_decode($response, true);
        if (isset($data['keys'])) {
            $keys = [];
            foreach ($data['keys'] as $key) {
                // Pastikan untuk membuat objek Key dari setiap JWK
                $keys[$key['kid']] = Key::createFromJWK($key);
            }
            // Cache selama 1 jam jika APCu tersedia
            if (function_exists('apcu_add')) {
                apcu_add('google_public_keys', $keys, 3600);
            }
            return $keys;
        }
    }
    throw new Exception('Gagal mengambil kunci publik Google. Kode HTTP: ' . $httpCode . ', Respon: ' . ($response ?: 'Tidak ada respon'));
}

// Ambil input JSON dari request POST
$input = json_decode(file_get_contents('php://input'), true);

$idToken = $input['credential'] ?? null;

if (empty($idToken)) {
    echo json_encode(['status' => 'error', 'message' => 'Google ID Token tidak ditemukan.']);
    exit();
}

try {
    $publicKeys = getGooglePublicKeys();

    // Verifikasi ID Token menggunakan array kunci publik yang sudah disiapkan
    $decoded = (array) JWT::decode($idToken, $publicKeys); 

    // Pastikan token ditujukan untuk client ID kita
    if ($decoded['aud'] !== GOOGLE_CLIENT_ID) {
        throw new Exception('Invalid audience. Token audience: ' . $decoded['aud'] . ', Expected: ' . GOOGLE_CLIENT_ID);
    }
    // Pastikan token dikeluarkan oleh Google
    if ($decoded['iss'] !== 'https://accounts.google.com' && $decoded['iss'] !== 'accounts.google.com') {
        throw new Exception('Invalid issuer. Token issuer: ' . $decoded['iss']);
    }

    $email = $decoded['email'] ?? null;
    $displayName = $decoded['name'] ?? explode('@', $email)[0]; // Fallback ke bagian email jika nama tidak ada
    $googleId = $decoded['sub'] ?? null; // Google user ID (unique ID for the user from Google)

    if (empty($email)) {
        throw new Exception('Email tidak ditemukan di token Google.');
    }

    // 2. Cek apakah email sudah ada di database kita
    // Menggunakan $koneksi sesuai asumsi nama variabel dari koneksi.php
    $stmt = mysqli_prepare($koneksi, "SELECT id, username, email, nama_lengkap, password FROM users WHERE email = ?");
    if (!$stmt) {
        throw new Exception('Gagal menyiapkan query pengecekan email: ' . mysqli_error($koneksi));
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {
        // Pengguna sudah ada di database, login saja
        $user = mysqli_fetch_assoc($result);
        
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        echo json_encode(['status' => 'success', 'message' => 'Login Google berhasil!', 'redirect' => 'index.php']);
        
    } else {
        // Pengguna belum terdaftar, lakukan pendaftaran baru

        // Generate username unik (maksimal 10 karakter)
        $baseUsername = explode('@', $email)[0];
        // Hapus karakter non-alphanumeric dari username dasar
        $baseUsername = preg_replace('/[^a-zA-Z0-9]/', '', $baseUsername);
        $baseUsername = substr($baseUsername, 0, 8); // Potong untuk ruang angka
        if (empty($baseUsername)) {
            $baseUsername = 'user'; // Fallback jika email tidak punya bagian nama yang valid
        }
        $uniqueUsername = $baseUsername;
        $counter = 1;

        while (true) {
            $checkUsernameStmt = mysqli_prepare($koneksi, "SELECT COUNT(*) FROM users WHERE username = ?");
            if (!$checkUsernameStmt) {
                throw new Exception('Gagal menyiapkan query cek username unik: ' . mysqli_error($koneksi));
            }
            mysqli_stmt_bind_param($checkUsernameStmt, "s", $uniqueUsername);
            mysqli_stmt_execute($checkUsernameStmt);
            mysqli_stmt_bind_result($checkUsernameStmt, $count);
            mysqli_stmt_fetch($checkUsernameStmt);
            mysqli_stmt_close($checkUsernameStmt);

            if ($count == 0) {
                break; // Username unik ditemukan
            }
            // Tambahkan angka di akhir jika username sudah ada
            $uniqueUsername = $baseUsername . $counter;
            $counter++;
            if ($counter > 9999) { // Batasi counter untuk mencegah loop tak terbatas
                $uniqueUsername = 'g' . substr(md5(uniqid()), 0, 9); // Fallback yang lebih kuat
                $checkUsernameStmt = mysqli_prepare($koneksi, "SELECT COUNT(*) FROM users WHERE username = ?");
                mysqli_stmt_bind_param($checkUsernameStmt, "s", $uniqueUsername);
                mysqli_stmt_execute($checkUsernameStmt);
                mysqli_stmt_bind_result($checkUsernameStmt, $count);
                mysqli_stmt_fetch($checkUsernameStmt);
                mysqli_stmt_close($checkUsernameStmt);
                if ($count == 0) break; // Jika fallback unik, keluar
            }
        }
        
        // Default value untuk no_hp (harus diisi karena kolom NOT NULL)
        $phoneNumber = '000000000000'; // Atau set ke NULL jika kolom memungkinkan NULL

        // Password placeholder (wajib karena kolom password NOT NULL)
        // Ini bukan password sebenarnya, hanya penanda untuk akun yang didaftarkan via Google.
        // Gunakan hash yang kuat untuk placeholder.
        $hashedPasswordPlaceholder = password_hash(uniqid('google_auth_'), PASSWORD_DEFAULT);

        // Insert pengguna baru
        $insertStmt = mysqli_prepare($koneksi, "INSERT INTO users (username, nama_lengkap, no_hp, email, password) VALUES (?, ?, ?, ?, ?)");
        if (!$insertStmt) {
            throw new Exception('Gagal menyiapkan query pendaftaran: ' . mysqli_error($koneksi));
        }
        mysqli_stmt_bind_param($insertStmt, "sssss", $uniqueUsername, $displayName, $phoneNumber, $email, $hashedPasswordPlaceholder);
        if (mysqli_stmt_execute($insertStmt)) {
            // Pendaftaran berhasil, buat sesi login
            $_SESSION['username'] = $uniqueUsername;
            $_SESSION['email'] = $email;
            $_SESSION['nama_lengkap'] = $displayName;
            echo json_encode(['status' => 'success', 'message' => 'Pendaftaran akun Google berhasil!', 'redirect' => 'index.php']);
        } else {
            throw new Exception('Gagal mendaftarkan pengguna baru: ' . mysqli_error($koneksi));
        }
        mysqli_stmt_close($insertStmt);
    }
    // Tutup statement pengecekan email pertama
    mysqli_stmt_close($stmt);

} catch (Exception $e) {
    // Tangani error dan berikan detail lebih lanjut di respon JSON
    echo json_encode([
        'status' => 'error', 
        'message' => 'Kesalahan saat login/daftar Google.', 
        'detail' => $e->getMessage()
    ]);
} finally {
    // Pastikan koneksi database ditutup
    if (isset($koneksi) && $koneksi) {
        mysqli_close($koneksi);
    }
}

// Hapus definisi kelas KeySet ini karena sudah tidak dibutuhkan
/*
class KeySet implements \ArrayAccess {
    private $keys;

    public function __construct(array $keys) {
        $this->keys = $keys;
    }

    public function offsetExists($offset): bool {
        return isset($this->keys[$offset]);
    }

    public function offsetGet($offset): mixed {
        return $this->keys[$offset];
    }

    public function offsetSet($offset, $value): void { // Perbaikan parameter $value
        throw new \BadMethodCallException('KeySet is read-only');
    }

    public function offsetUnset($offset): void {
        throw new \BadMethodCallException('KeySet is read-only');
    }
}
*/
?>