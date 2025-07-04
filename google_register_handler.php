<?php
session_start();
require __DIR__ . '/vendor/autoload.php'; // Pastikan path ini benar jika menggunakan Composer
include 'koneksi.php'; // Pastikan file koneksi database Anda ada dan benar

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Content-Type: application/json');

// Ganti dengan CLIENT ID Anda dari Google Cloud Console (Client ID Web Application)
// Ini harus sama dengan data-client_id di HTML Anda
const GOOGLE_CLIENT_ID = '300144113544-bh6c0tiodpnabmcitdnq5jpuvrfccrqi.apps.googleusercontent.com';

// URL untuk mendapatkan Google Public Keys (untuk verifikasi JWT)
const GOOGLE_CERTS_URL = 'https://www.googleapis.com/oauth2/v3/certs';

// Fungsi untuk mendapatkan public keys dari Google
function getGooglePublicKeys() {
    $keys = apcu_fetch('google_public_keys'); // Coba ambil dari cache jika ada APCu
    if ($keys === false) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, GOOGLE_CERTS_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200 && $response) {
            $data = json_decode($response, true);
            if (isset($data['keys'])) {
                $keys = [];
                foreach ($data['keys'] as $key) {
                    $keys[$key['kid']] = Key::createFromJWK($key);
                }
                apcu_add('google_public_keys', $keys, 3600); // Cache selama 1 jam
                return $keys;
            }
        }
        throw new Exception('Failed to fetch Google public keys.');
    }
    return $keys;
}

// Ambil input JSON dari request
$input = json_decode(file_get_contents('php://input'), true);

$idToken = $input['credential'] ?? null;

if (empty($idToken)) {
    echo json_encode(['status' => 'error', 'message' => 'Google ID Token tidak ditemukan.']);
    exit();
}

try {
    $publicKeys = getGooglePublicKeys();

    // Verifikasi ID Token
    $decoded = (array) JWT::decode($idToken, new KeySet($publicKeys)); // KeySet digunakan untuk array kunci

    // Pastikan token ditujukan untuk client ID kita
    if ($decoded['aud'] !== GOOGLE_CLIENT_ID) {
        throw new Exception('Invalid audience.');
    }
    // Pastikan token dikeluarkan oleh Google
    if ($decoded['iss'] !== 'https://accounts.google.com' && $decoded['iss'] !== 'accounts.google.com') {
        throw new Exception('Invalid issuer.');
    }

    $email = $decoded['email'] ?? null;
    $displayName = $decoded['name'] ?? explode('@', $email)[0]; // Fallback ke bagian email jika nama tidak ada
    $googleId = $decoded['sub'] ?? null; // Google user ID

    if (empty($email)) {
        throw new Exception('Email tidak ditemukan di token Google.');
    }

    // 2. Cek apakah email sudah ada di database kita
    $stmt = mysqli_prepare($connection, "SELECT id, username, email, nama_lengkap, password FROM users WHERE email = ?");
    if (!$stmt) {
        throw new Exception('Gagal menyiapkan query pengecekan email: ' . mysqli_error($connection));
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {
        // Pengguna sudah ada di database
        $user = mysqli_fetch_assoc($result);

        // Periksa apakah ini akun manual atau akun yang terdaftar via Google sebelumnya
        // Kita berasumsi akun Google memiliki password placeholder unik atau tidak ada
        // Jika akun punya password valid (di-hash dari input pengguna), mungkin ini akun manual.
        // Anda bisa menambahkan kolom 'provider' (e.g., 'google', 'manual') di tabel users untuk lebih jelas.
        
        // Untuk saat ini, kita akan selalu login jika email sudah terdaftar,
        // asumsikan jika login via Google, maka akun tersebut sah untuk diakses via Google.
        // Jika Anda ingin lebih ketat, Anda bisa cek apakah passwordnya adalah placeholder.
        
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        echo json_encode(['status' => 'success', 'message' => 'Login Google berhasil!']);
        
    } else {
        // Pengguna belum terdaftar, lakukan pendaftaran baru
        
        // Generate username unik (maksimal 10 karakter)
        $baseUsername = explode('@', $email)[0];
        $baseUsername = substr($baseUsername, 0, 8); // Potong untuk ruang angka
        $uniqueUsername = $baseUsername;
        $counter = 1;

        while (true) {
            $checkUsernameStmt = mysqli_prepare($connection, "SELECT COUNT(*) FROM users WHERE username = ?");
            if (!$checkUsernameStmt) {
                throw new Exception('Gagal menyiapkan query cek username unik: ' . mysqli_error($connection));
            }
            mysqli_stmt_bind_param($checkUsernameStmt, "s", $uniqueUsername);
            mysqli_stmt_execute($checkUsernameStmt);
            mysqli_stmt_bind_result($checkUsernameStmt, $count);
            mysqli_stmt_fetch($checkUsernameStmt);
            mysqli_stmt_close($checkUsernameStmt);

            if ($count == 0) {
                break; // Username unik
            }
            $uniqueUsername = $baseUsername . $counter;
            $counter++;
            if ($counter > 999) { // Batasi counter
                $uniqueUsername = 'g' . substr(uniqid(), 0, 9); // Fallback ke ID unik jika terlalu banyak duplikat
                break;
            }
        }
        
        // Default value untuk no_hp (harus diisi karena NOT NULL)
        $phoneNumber = '000000000000'; 

        // Password placeholder (wajib karena kolom password NOT NULL)
        // Ini bukan password yang sebenarnya, hanya penanda untuk akun Google
        $hashedPasswordPlaceholder = password_hash(uniqid('google_auth_'), PASSWORD_DEFAULT);

        // Insert pengguna baru
        $insertStmt = mysqli_prepare($connection, "INSERT INTO users (username, nama_lengkap, no_hp, email, password) VALUES (?, ?, ?, ?, ?)");
        if (!$insertStmt) {
            throw new Exception('Gagal menyiapkan query pendaftaran: ' . mysqli_error($connection));
        }
        mysqli_stmt_bind_param($insertStmt, "sssss", $uniqueUsername, $displayName, $phoneNumber, $email, $hashedPasswordPlaceholder);
        if (mysqli_stmt_execute($insertStmt)) {
            // Pendaftaran berhasil, buat sesi login
            $_SESSION['username'] = $uniqueUsername;
            $_SESSION['email'] = $email;
            $_SESSION['nama_lengkap'] = $displayName;
            echo json_encode(['status' => 'success', 'message' => 'Pendaftaran akun Google berhasil!']);
        } else {
            throw new Exception('Gagal mendaftarkan pengguna baru: ' . mysqli_error($connection));
        }
        mysqli_stmt_close($insertStmt);
    }
    mysqli_stmt_close($stmt);

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Kesalahan saat login/daftar Google.', 'detail' => $e->getMessage()]);
} finally {
    if (isset($connection)) {
        mysqli_close($connection);
    }
}

// Class helper untuk KeySet dari JWK
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

    public function offsetSet($offset, $value): void {
        throw new \BadMethodCallException('KeySet is read-only');
    }

    public function offsetUnset($offset): void {
        throw new \BadMethodCallException('KeySet is read-only');
    }
}
?>