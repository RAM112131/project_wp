<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'pendakian_ciremai';

$connection = mysqli_connect($host, $user, $pass, $db);

if (!$connection) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
